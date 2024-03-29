<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'nextstop-backend',
    'basePath' => dirname(__DIR__),
    'language' => 'es-ES',
    'timezone' => 'America/Mexico_City',
    'name' => 'NextStop',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [            
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '6Pd0/wW+W4UgYlKyXeDEDsS/edhis80bOhmtz0fSTYmzTH7koOdADZ54mITEgmCq',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass'     => 'app\models\User',
            'enableSession'     => false,
            'enableAutoLogin'   => true,
            'loginUrl'          => null,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl'       => true,
            'showScriptName'        => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>'                 => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'    => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'             => '<controller>/<action>',
                // The above configuration mainly adds a URL rule for the controllers
                // so that data can be accessed and manipulated with friendly URLs and
                // meaningful HTTP verbs.
                ['class' => 'yii\rest\UrlRule', 'controller' => 'comentario-dislike-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'comentario-like-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'comentario-rest'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'etiqueta-rest'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'insignia-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'insignia-tipo-rest'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'lugar-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'lugar-tipo-rest'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'publicacion-dislike-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'publicacion-etiqueta-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'publicacion-fichero-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'publicacion-like-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'publicacion-visita-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'publicacion-rest'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'ubicacion-rest'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'usuario-insignia-rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'usuario-rest'],
            ],
        ],
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
