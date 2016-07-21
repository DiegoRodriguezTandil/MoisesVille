<?php

use kartik\datecontrol\Module;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],  
    'language'=>'es',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],

        'admin' => [
            'class' => 'mdm\admin\Module',
                'layout' => 'left-menu',
        ], 

        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',

        //  'admin' => [
        //         'class' => 'mdm\admin\Module',
        //         'layout' => 'left-menu', // it can be '@path/to/your/layout'.
        //         'controllerMap' => [
        //             'assignment' => [
        //                 'class' => 'mdm\admin\controllers\AssignmentController',
        //                 'userClassName' => 'app\models\User',
        //                 'idField' => 'id'
        //             ],
        //             'other' => [
        //                 'class' => 'path\to\OtherController', // add another controller
        //             ],
        //         ],
        // 'menus' => [
        //     'assignment' => [
        //         'label' => 'Grand Access' // change label
        //     ],
        //     'route' => null, // disable menu route 
        //     ]
        // ],
            
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd/MM/yyyy',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd/MM/yyyy hh:mm:ss a', 
            ],            

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d', 
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            
            // set your display timezone
            'displayTimezone' => 'America/Argentina/Buenos_Aires',

            // set your timezone for date saved to db
            'saveTimezone' => 'America/Argentina/Buenos_Aires',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,           

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => true,
        ]        
    ],
    'sourceLanguage'=>'en-US',    
    
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-M-Y',
            'datetimeFormat' => 'php:d-M-Y H:i:s',
            'timeFormat' => 'php:H:i:s',
        ], 
      'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'class' =>'app\controllers\userController',
        ],
        // 'authManager' => [
        //     'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        // ],
        // 'user' => [
        //     'identityClass' => 'mdm\admin\models\User',
        //     'loginUrl' => ['admin/user/login'],
        // ],

        'request' => [
            'cookieValidationKey' => 'dfsdfhsdfhsduhfsduihf2364asd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [/*
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,*/
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,//If you don't have authKey column in your DB, set enableAutoLogin field to false
            'enableSession' => true,
            
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'yii' => [  
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@yii/messages',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
       /* 'params' => [
            'uploadPath' => basePath . '/uploads/';,
            'uploadUrl' => Yii::$app->urlManager->baseUrl . '/uploads/',
            'thumbnail.size' => [128, 128],
            
        ],*/

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            // 'acervo/*'
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
