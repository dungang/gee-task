<?php
$db = require __DIR__ . '/db-dev.php';

$config = [
    'components' => [
        'db' => $db,
        'authManager' => [
            'class' => 'app\core\CoreAuthManager',
            // uncomment if you want to cache RBAC items hierarchy
            'cache' => 'cache'
        ],
    ],
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
