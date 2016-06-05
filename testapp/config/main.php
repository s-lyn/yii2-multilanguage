<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'app-test',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'testapp\controllers',
    'language' => 'en-US',
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'fixtureDataPath' => '@tests/codeception/common/fixtures/data',
            'templatePath' => '@tests/codeception/common/templates/fixtures',
            'namespace' => 'tests\codeception\common\fixtures',
        ],
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:' . __DIR__ . DIRECTORY_SEPARATOR . 'test.sqlite',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'rules' => [
                '/' => 'site/index',
            ],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'multilanguageHideDefaultPrefix' => true,
            'class' => 'pjhl\multilanguage\components\AdvancedUrlManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'class' => 'pjhl\multilanguage\components\AdvancedRequest',
            'cookieValidationKey' => 'dI8p8_mvNhRzN1pr7n0kdva8IDJTk2D8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'forceCopy' => YII_DEBUG,
        ],
    ],
    'params' => $params,
];

if (!YII_ENV_TEST) {
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
