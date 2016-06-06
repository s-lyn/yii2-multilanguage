<?php

use pjhl\multilanguage\components\helpers\Detect;

class DetectTest extends \PHPUnit_Framework_TestCase {

    private $languages = [
        [
            'id' => 1,
            'url' => 'en',
            'locale' => 'en',
            'name' => 'English',
            'default' => true,
        ],
        [
            'id' => 2,
            'url' => 'ru',
            'locale' => 'ru',
            'name' => 'Русский',
        ],
    ];

    protected function setUp() {
        Yii::$app->params['languages'] = $this->languages;
        Yii::$app->language = 'en';
        Yii::$app->sourceLanguage = 'en';
        $_COOKIE = ['x-language-id' => 1];
        putenv('HTTP_ACCEPT_LANGUAGE=ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4,nb;q=0.2');
    }

    protected function tearDown() {
        
    }

    public function testRun() {
        $this->assertEquals(1, Detect::run());
        
        $_COOKIE = ['x-language-id' => 2];
        $this->assertEquals(2, Detect::run());
        
        $_COOKIE = ['x-language-id' => 666];
        $this->assertEquals(2, Detect::run(), 'Used HTTP_ACCEPT_LANGUAGE');
        
        $_COOKIE = [];
        $this->assertEquals(2, Detect::run(), 'Used HTTP_ACCEPT_LANGUAGE');
        
        putenv('HTTP_ACCEPT_LANGUAGE=en-US,en;q=0.8');
        $this->assertEquals(1, Detect::run());
        
        putenv('HTTP_ACCEPT_LANGUAGE=es-ES');
        $this->assertEquals(1, Detect::run(), 'default language');
        
        Yii::$app->language = 'ru';
        $this->assertEquals(2, Detect::run(), 'default language changed');
        
        putenv('HTTP_ACCEPT_LANGUAGE=');
        $this->assertEquals(2, Detect::run(), 'empty HTTP_ACCEPT_LANGUAGE');
        
        Yii::$app->language = 'en';
        $this->assertEquals(1, Detect::run(), 'language changed');
    }

}
