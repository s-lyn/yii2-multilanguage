<?php

use pjhl\multilanguage\LangHelper;

class LangHelperTest extends \PHPUnit_Framework_TestCase {

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
    }

    protected function tearDown() {
        
    }

    // Test list af all languages
    public function testLanguages() {
        $languages = $this->languages;
        $this->assertEquals($languages, LangHelper::languages());

        Yii::$app->params['languages'] = 'string';
        $this->assertEquals([], LangHelper::languages());

        unset(Yii::$app->params['languages']);
        $this->assertEquals([], LangHelper::languages());

        // Resture params
        Yii::$app->params['languages'] = $languages;
    }

    public function testGetLanguageByParam() {
        $this->assertEquals('English', LangHelper::getLanguageByParam('default', true)['name']);
        $this->assertEquals('English', LangHelper::getLanguageByParam('locale', 'en')['name']);
        $this->assertEquals('Русский', LangHelper::getLanguageByParam('locale', 'ru')['name']);

        $this->assertNull(LangHelper::getLanguageByParam('locale', 'es'));
        $this->assertNull(LangHelper::getLanguageByParam('unexist key', '123'));
    }

    public function testGetLanguage() {
        $this->assertEquals('English', LangHelper::getLanguage()['name']);
        $this->assertEquals(1, LangHelper::getLanguage('id'));
        Yii::$app->language = 'ru';
        $this->assertEquals('Русский', LangHelper::getLanguage()['name']);
        $this->assertEquals(2, LangHelper::getLanguage('id'));
        Yii::$app->language = 'es';
        $this->assertNull(LangHelper::getLanguage());
        $this->assertNull(LangHelper::getLanguage('id'));
        // Resture config
        Yii::$app->language = 'en';
    }

    

}
