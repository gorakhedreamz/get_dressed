<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    //'timezone' => 'Asia/Kolkata',
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'Utility' => [
            'class' => 'common\components\Utility',
        ],
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],

        'authManager' => [
             'class' => 'yii\rbac\DbManager',
        ],

    ],

    'modules' => [
        'rbac' =>  [
            'class' => 'johnitvn\rbacplus\Module',
            'userModelClassName'=>null,
            'userModelIdField'=>'id',
            'userModelLoginField'=>'username',
            'userModelLoginFieldLabel'=>null,
            'userModelExtraDataColumls'=>null,
            'beforeCreateController'=>null,
            'beforeAction'=>null
        ],

        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]       
    ]
];
