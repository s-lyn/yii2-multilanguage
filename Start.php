<?php

namespace pjhl\multilanguage;

use Yii;
use pjhl\multilanguage\components\helpers\Detect;

class Start {

    public static function run($event) {

        $langExpected = static::detectExpectLang();
        if ($langExpected !== null) {
            // Make redirect to correct language url
            static::makeRedirectTo($lang);
        }
    }

    /**
     * Returns expected link language
     * @return array|null   Null - no lang expecte
     */
    public static function detectExpectLang() {

        $langExpected = null;

        // Save the language in a config of the yii2
        $lang_id = Detect::run();
        if ($lang_id !== null) {
            $lang = LangHelper::getLanguageByParam('id', $lang_id);
            if ($lang !== null) {
                Yii::$app->language = $lang['locale'];
            }
        }



        // Detect current link language
        $current = static::detectLinkLang();
        if ($current) {
            if ($lang['id'] != $current['id']) {
                $langExpected = $lang;
            }
        }

        return $langExpected;
    }

    /**
     * Returns current link language
     * @return array|null
     */
    public static function detectLinkLang() {
        $languageInurl = Yii::$app->request->languageInurl;
        if ($languageInurl) {
            $current = LangHelper::getLanguageByParam('url', $languageInurl);
        } else {
            $current = LangHelper::getLanguageByParam('default', true);
        }
        return $current;
    }

    /**
     * Creates link for language redirect
     * @param string|false $link
     */
    public static function redirectLink($lang) {
        $link = null;
        if (!$lang) {
            return $link;
        }
        
        // Do not make redirect on test env
        $isTestEnv = defined('YII_ENV') && YII_ENV === 'test';
        $isTestEnv2 = defined('YII_ENV_TEST') && YII_ENV_TEST;
        if ($isTestEnv || $isTestEnv2) {
            return;
        }

        if (Yii::$app->getRequest()->getMethod() === 'GET' && !Yii::$app->getRequest()->isAjax) {
            $isDefault = isset($lang['default']) && $lang['default'];
            $link = \yii\helpers\Url::current([
                        'x-language-url' => $isDefault ? false : $lang['url']
            ]);
        }
        return $link;
    }

    /**
     * Make redirect to correct language url.
     * Ajax and not GET requests will be ignored
     * @param array $lang
     */
    private static function makeRedirectTo($lang) {
        return; ##!! Заглушка
        $link = static::redirectLink($lang);

        if ($link !== null) {
            Yii::$app->getResponse()->redirect($link)->send();
            Yii::$app->end();
        }
    }

}
