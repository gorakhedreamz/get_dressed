<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;
$baseUrl = str_replace('/admin/', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-backend',
    'name'=>'Get Dressed',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    
    'modules' => [

        'adminsubadmin' => [
            'class' => 'backend\modules\adminsubadmin\adminsubadmin',
        ],

        'banner' => [
            'class' => 'backend\modules\banner\banner',
        ],

        'brand' => [
            'class' => 'backend\modules\brand\brand',
        ],

        'category' => [
            'class' => 'backend\modules\category\category',
        ],

        'newsfashion' => [
            'class' => 'backend\modules\newsfashion\newsfashion',
        ],

        'occasion' => [
            'class' => 'backend\modules\occasion\occasion',
        ],

        'size' => [
            'class' => 'backend\modules\size\size',
        ],

        'style' => [    
            'class' => 'backend\modules\style\style',
        ],

        'subcategory' => [
            'class' => 'backend\modules\subcategory\subcategory',
        ],

        'countries' => [
            'class' => 'backend\modules\countries\countries',
        ],

        'user' => [
            'class' => 'backend\modules\user\user',
        ],

        'userstyles' => [
            'class' => 'backend\modules\userstyles\userstyles',
        ],
        
        'cms' => [
            'class' => 'backend\modules\cms\cms',
        ],
        
        'faq' => [
            'class' => 'backend\modules\faq\faq',
        ],
    ],


    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'class' => 'common\components\Request',
            'web'=> '/backend/web',
            'adminUrl' => '/admin',
            'baseUrl' => $baseUrl
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];
