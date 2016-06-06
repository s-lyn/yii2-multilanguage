<?php

namespace pjhl\multilanguage;

use Yii;
use pjhl\multilanguage\components\helpers\Detect;

class Start {

    public static function run($event) {

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
                // Make redirect to correct language url
                static::makeRedirectTo($lang);
            }
        }
    }

    /**
     * Returns current link language
     * @return array|null
     */
    private static function detectLinkLang() {
        $languageInurl = Yii::$app->request->languageInurl;
        if ($languageInurl) {
            $current = LangHelper::getLanguageByParam('url', $languageInurl);
        } else {
            $current = LangHelper::getLanguageByParam('default', true);
        }
        return $current;
    }

    /**
     * Make redirect to correct language url.
     * Ajax and not GET requests will be ignored
     * @param array $lang
     */
    private static function makeRedirectTo($lang) {
        if (Yii::$app->getRequest()->getMethod() === 'GET' && !Yii::$app->getRequest()->isAjax) {
            $isDefault = isset($lang['default']) && $lang['default'];
            $url = \yii\helpers\Url::current([
                'x-language-url'=>$isDefault ? false : $lang['url']
            ]);
            Yii::$app->getResponse()->redirect($url)->send();
            Yii::$app->end();
        }
    }

}
