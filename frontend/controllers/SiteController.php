<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Info;
use yii\data\Pagination;
use common\models\Keyword;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $connection = \Yii::$app->db;
        $timeBegin = date('Y-m-d',time());
        $cache = Yii::$app->cache;
        if ($cache->exists('total')) {
            $total = $cache->get('total');
            $totalTime = $cache->get('totalTime');
        }else{
            $total = $connection->createCommand("select count(*) from info")->queryScalar();
            $totalTime = date('H:i:s',time());
            $cache->set('total',$total,3600);
            $cache->set('totalTime',date('H:i:s',time()),3600);
        }
        if ($cache->exists('today')) {
            $today = $cache->get('today');
        }else{
            $today = $connection->createCommand("select count(*) from info where time>='".$timeBegin."'")->queryScalar();
            $cache->set('today',$today,3600);
        }
        return $this->render('index',['total' => $total,'today' => $today,'totalTime' => $totalTime]);
    }

    public function actionSearch()
    {
        $pageSize = 20;
        $currentPage = Yii::$app->request->get('page');
        if (!isset($currentPage)) {
            $currentPage = 1;
        }
        $key = Yii::$app->request->get('k');
        if (!$key) {
            Yii::$app->session->setFlash('error','请输入搜索内容');
            return $this->redirect(['site/index']);
        }
        Keyword::add($key);
        $sphinx = new \SphinxClient();
        $sphinx->SetServer ('localhost',9312);
        $sphinx->SetArrayResult (true);
        //$sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "id");
        $sphinx->SetLimits((($currentPage - 1) * $pageSize),$pageSize,1000);
        $sphinx->SetMaxQueryTime(10);
        $index = 'bt';
        $results = $sphinx->query ($key, $index);
        //判断sphinx中是否取出数据，如果为空，再从mysql通过like取数据
        if ($results['total'] != 0) {
            $pagination = new Pagination(['totalCount' => $results['total'],'pageSize' => $pageSize]);
            $ids = [];
            foreach ($results['matches'] as $value) {
                $ids[] = $value['id'];
            }
            $datas = Info::find()->where(['in','id',$ids])->all();
            return $this->render('search',['pagination' => $pagination,'datas' => $datas,'k' => $key,'type' => '快速']);
        }else{
            $query = Info::find()->where(['like','name',$key])->orderBy(['id' => SORT_DESC]);
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
            $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
            return $this->render('search',['pagination' => $pagination,'datas' => $datas,'k' => $key,'type' => '慢速']);
        }
    }

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        if (!$id) {
            Yii::$app->session->setFlash('error','参数错误');
            return $this->redirect(['site/index']);
        }
        $cache = Yii::$app->cache;
        if ($cache->exists('detail_'.$id)) {
            $type = '缓存';
            $data = $cache->get('detail_'.$id);
        }else{
            $type = '实时';
            $data = Info::find()->where(['id' => $id])->one();
            $cache->set('detail_'.$id,$data,1314000);
        }
        $data = Info::find()->where(['id' => $id])->one();
        $data->hot = $data->hot + 1;
        $data->save();
        return $this->render('detail',['data' => $data,'type' => $type]);
    }

    public function actionNew()
    {
        $cache = Yii::$app->cache;
        $pageSize = 50;
        $query = Info::find()->orderBy(['id' => SORT_DESC]);
        $count = $cache->get('total');
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('new',['pagination' => $pagination,'datas' => $datas]);
    }

    public function actionDeclare()
    {
        return $this->render('declare');
    }

    public function actionAssistance()
    {
        return $this->render('assistance');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
