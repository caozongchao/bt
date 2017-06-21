<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Topic;
use yii\data\Pagination;

/**
 * Site controller
 */
class TopicController extends Controller
{
    public function actionIndex()
    {
        $query = Topic::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 20]);
        $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',['datas' => $datas]);
    }

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        if (!$id) {
            Yii::$app->session->setFlash('error','参数错误');
            return $this->redirect(['topic/index']);
        }
        $cache = Yii::$app->cache;
        if ($cache->exists('topic_'.$id)) {
            $type = '缓存';
            $data = $cache->get('topic_'.$id);
        }else{
            $type = '实时';
            $data = Topic::find()->where(['id' => $id])->one();
            $cache->set('topic_'.$id,$data,1314000);
        }
        $data = Topic::find()->where(['id' => $id])->one();
        $data->click = $data->click + 1;
        $data->save();
        return $this->render('detail',['data' => $data,'type' => $type]);
    }
}
