<?php

namespace pjhl\multilanguage;

use Yii;

class LangHelper {
    
    /**
     * Returns a list of the configurations for all languages
     * @return array
     */
    public static function languages() {
        if (!isset(Yii::$app->params['languages'])) {
            Yii::error('You must specify the list of languages in params["languages"]', 'yii2-multilanguage');
            return [];
        }
        $languages = Yii::$app->params['languages'];
        if (!is_array($languages)) {
            Yii::error('Yii::$app->params["languages"] must be an array', 'yii2-multilanguage');
            return [];
        }
        return $languages;
    }
    
    /**
     * Returns the language setting on the value of its parameter
     * @param string $name   Name
     * @param mixed $value   Value
     * @return array|null   Config array or NULL
     */
    public static function getLanguageByParam($name, $value) {
        foreach (self::languages() as $lang) {
            if (isset($lang[ $name ]) && $lang[ $name ] == $value) {
                return $lang;
            }
        }
        return null;
    }
    
    /**
     * Returns the current language settings
     * @param string $key   Key for return value
     * @return mixed   Config array or NULL
     */
    public static function getLanguage($key = null) {
        $lang = self::getLanguageByParam('locale', Yii::$app->language);
        if ($lang !== null && $key!==null && isset($lang[$key])) {
            return $lang[$key];
        }
        return $lang;
    }

}
