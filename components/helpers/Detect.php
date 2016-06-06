<?php

namespace pjhl\multilanguage\components\helpers;

use Yii;
use pjhl\multilanguage\LangHelper;

class Detect {

    /**
     * Tries to determine ID of the current user's language by using cookies or browser language
     * @return  integer|null    Null - could not determine the language
     */
    public static function run() {

        // We are looking for language in the user's cookie
        if (isset($_COOKIE['x-language-id'])) {
            $isset = LangHelper::getLanguageByParam('id', $_COOKIE['x-language-id']);
            if ($isset !== null) {
                return $isset['id'];
            }
        }

        // Let's look at the language of the browser
        if (getenv('HTTP_ACCEPT_LANGUAGE')) {
            $arr = explode(';', getenv('HTTP_ACCEPT_LANGUAGE'));
            foreach ($arr as $val) {
                $val = preg_replace("/^q=[\d\.]+,?/", '', $val);
                $isset = LangHelper::getLanguageByParam('locale', substr($val, 0, 2));
                if ($isset !== null) {
                    return $isset['id'];
                }
            }
        }

        // Default language
        $lang_id = LangHelper::getLanguage('id');
        if ($lang_id !== null) {
            return $lang_id;
        }

    }

}
