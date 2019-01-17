<?php
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
        'link' => 'modules\link\Module'
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
        'mailer' => [
            'class' => 'app\components\AppMailer'
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
    ]
];

return $config;
