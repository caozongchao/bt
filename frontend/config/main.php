<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ]
                ],
                // 'yii\bootstrap\BootstrapAsset' => [
                //     'css' => []
                // ],
                // 'yii\bootstrap\BootstrapPluginAsset' => [
                //     'js'=>[]
                // ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'index.php' => '',
                '<id:\d+>' => 'site/detail',
                's' => 'site/search',
                'new' => 'site/new',
                'mzsm' => 'site/declare',
                'zz' => 'site/assistance',
                't' => 'topic/index',
                't/<id:\d+>' => 'topic/detail',
            ],
        ],
    ],
    'params' => $params,
];
