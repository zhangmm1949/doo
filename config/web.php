<?php

include __DIR__ . '/local_config.php';

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'WorkOrder',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'asd$%^$DFDSFasdffASDh2353@×&',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                // 如果是QQ邮箱，host改为smtp.qq.com
//                'host' => 'smtp.qq.com',
                'host' => 'smtp.163.com',
                // 邮箱登录帐号
                'username' => $local_config['adminEmail'],
                // 如果是qq邮箱，这里要填写第三方授权码，而不是你的qq登录密码，参考qq邮箱的帮助文档
                //http://service.mail.qq.com/cgi-bin/help?subtype=1&&id=28&&no=1001256
                'password' => $local_config['adminEmail_password'],// 网易邮箱授权码，并非真实邮箱密码
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['zhangmm1949@163.com'=>'Admin']
            ],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        // admin-lte的配置
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
    ],

    'modules' => [
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => $local_config['gii.allowedIPs'],
    ];
}

return $config;
