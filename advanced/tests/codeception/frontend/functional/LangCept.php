<?php
use tests\codeception\frontend\FunctionalTester;
use yii\helpers\Url;

/* @var $scenario Codeception\Scenario */

Yii::$app->language = 'en';

$I = new FunctionalTester($scenario);
$I->wantTo('Test main page');

$I->amOnPage(['/']);
$I->canSeeResponseCodeIs(200);
$I->see('Locale: en;');
$I->see('Url::home: /frontend/web/index-test.php;');
$I->see('Url::current: /frontend/web/index-test.php/site/index;');
$I->see('Url::to: /;');
$I->see('Url::toRoute: /frontend/web/index-test.php/site/index;');
