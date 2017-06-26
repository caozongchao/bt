<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'redactor' => [
            'class' => 'common\components\RedactorModule',
            'uploadDir' => '@frontend/web/uploads',
            'uploadUrl' => 'http://images.bt.yssousuo.com',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=127.0.0.1;port=9306;',
            'username' => '',
            'password' => '',
        ],
    ],
];
