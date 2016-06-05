<?php

// This is global bootstrap for autoloading
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', dirname(__DIR__));

require_once(YII_APP_BASE_PATH . '/vendor/autoload.php');
require_once(YII_APP_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');

// set correct script paths
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['SERVER_PORT'] = '80';

Yii::setAlias('@tests', __DIR__);
Yii::setAlias('@testapp', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'testapp');
