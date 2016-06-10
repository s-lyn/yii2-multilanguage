<?php

$application = new yii\web\Application(require(dirname(dirname(__DIR__)) . '/config/frontend/functional.php'));
$application->on($application::EVENT_BEFORE_ACTION, ['\pjhl\multilanguage\Start', 'run']);