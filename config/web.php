<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'geetask',
    'name' => 'GeeTask',
    'version' => 'beta',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log'
    ],

    'language' => 'zh-CN',
    'aliases' => [
        '@modules' => '@app/modules',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset'
    ],
    'modules' => [
        'space' => 'modules\space\Module',
        'member' => 'modules\member\Module',
        'meet' => 'modules\meet\Module',
        'change' => 'modules\change\Module',
        'sprint' => 'modules\sprint\Module',
        'backlog' => 'modules\backlog\Module',
        'robot' => 'modules\robot\Module',
        'myproject' => 'modules\myproject\Module',
        'aliyun-log' => 'modules\aliyunlog\Module',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'geetasksecret'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache'
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ]
            ]
        ],
        'db' => $db,
        'authManager' => [
            'class' => 'app\core\CoreAuthManager',
            // uncomment if you want to cache RBAC items hierarchy
            'cache' => 'cache'
        ],

        'formatter' => [
            'timeZone' => 'Asia/Shanghai',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'dateFormat' => 'yyyy-MM-dd',
            'timeFormat' => 'HH:mm:ss'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'baseUrl' => '@web/css/',
                    'css' => [
                        'bootstrap-united.min.css'
                    ], // 去除 bootstrap.css
                    'sourcePath' => null // 防止在 frontend/web/asset 下生产文件
                ]
            ]
        ]
        // 'mailer' => [
        // 'class' => 'yii\swiftmailer\Mailer',
        // 'useFileTransport' => false,
        // 'transport' => [
        // 'class' => 'Swift_SmtpTransport',
        // 'host' => 'smtp.ndabooking.com',
        // 'username' => '',
        // 'password' => '',
        // 'port'=>25,
        // // 'port' => '465',
        // // 'encryption' => 'ssl'
        // ]
        // ]

        // 'urlManager' => [
        // 'enablePrettyUrl' => true,
        // 'showScriptName' => false,

        // 'rules' => [
        // ],
        // ],
    ],
    'params' => $params
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module'
        // uncomment the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'geetask' => dirname(dirname(__FILE__)) . '/generators/crud/default'
                ]
            ],
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'baseClass' => 'app\core\BaseModel',
                'ns' => 'app\models',
                'queryNs' => 'app\models'
            ]
        ]
        // uncomment the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
