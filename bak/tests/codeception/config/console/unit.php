<?php
/**
 * Application configuration for console unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/advanced/common/config/main.php'),
    require(YII_APP_BASE_PATH . '/advanced/common/config/main-local.php'),
    require(YII_APP_BASE_PATH . '/advanced/console/config/main.php'),
    require(YII_APP_BASE_PATH . '/advanced/console/config/main-local.php'),
    require(dirname(__DIR__) . '/config.php'),
    require(dirname(__DIR__) . '/config-local.php'),
    require(dirname(__DIR__) . '/unit.php'),
    [
    ]
);
