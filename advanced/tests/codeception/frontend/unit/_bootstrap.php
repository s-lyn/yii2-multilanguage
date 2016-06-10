<?php

// Create application

$application = new yii\web\Application(require(dirname(dirname(__DIR__)) . '/config/frontend/unit.php'));
$application->on($application::EVENT_BEFORE_ACTION, ['\pjhl\multilanguage\Start', 'run']);
