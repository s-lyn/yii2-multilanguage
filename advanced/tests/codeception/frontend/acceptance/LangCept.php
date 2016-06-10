<?php
use tests\codeception\frontend\AcceptanceTester;
use tests\codeception\frontend\_pages\LangPage;

/* @var $scenario Codeception\Scenario */

//\pjhl\multilanguage\Start::run();

$I = new AcceptanceTester($scenario);

$I->wantTo('Test language page');

$langPage = LangPage::openBy($I);
$I->canSeeResponseCodeIs(200);
$I->see('Language: en.');

// Same page on russian
$I->click('ChangeRU');
$I->canSeeResponseCodeIs(200);
$I->see('Language: ru.');

$I->click('Home');
$I->canSeeResponseCodeIs(200);
$I->see('Index page works.');
$I->see('Locale: ru;');

// Back to english
$I->click('ChangeEN');
$I->canSeeResponseCodeIs(200);
$I->see('Index page works.');
$I->see('Locale: en;');