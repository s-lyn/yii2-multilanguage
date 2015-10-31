<?php

namespace pjhl\multilanguage\helpers;
use Yii;


class Languages {
    
    private static $all = false;
    
    /**
     * Список языков (из настроейк)
     * @return LanguagesList
     */
    public static function all() {
        if (self::$all === false) 
            self::$all = new LanguagesList();
        return self::$all;
    }
    
    public static function currentLangId() {
        $arr = self::all()->getConfigCurrent();
        return $arr ? $arr['id'] : null;
    }


    /**
     * Определяет язык пользователя по кукам/браузеру. Если не удалось, возвращает стандартный
     * @return string   LangId (ex. "en")
     */
    public static function detectClientLangId() {
        
        $lang_id = null; //
        
        // Ищем язык в куках пользователя
        if (isset($_COOKIE['x-language-id'])) { // Yii::$app->request->cookies
            $result = self::all()->getConfigById( $_COOKIE['x-language-id'] );
            if ($result !== null) {
                $lang_id = $result['id'];
            }
        }
        
        // Определение языка по браузеру
        if ($lang_id===null) {
            if (getenv('HTTP_ACCEPT_LANGUAGE')) {
                $arr = explode(';', getenv('HTTP_ACCEPT_LANGUAGE'));
                foreach ($arr as $val) {
                    $val = preg_replace("/^q=[\d\.]+,?/", '', $val);
                    $result = self::all()->getConfigById(substr($val, 0, 2));
                    if ($result !== null) {
                        $lang_id = $result['id'];
                        break;
                    }
                }
            }
        }
        
        // Стандартный язык
        if ($lang_id===null) {
            $result = self::all()->getConfigDefault();
            $lang_id = $result===null ? null : $result['id'];
        }
        
        // Выставляем текущий язык в конфиг
        if ($lang_id!==null) {
            $result = self::all()->getConfigById($lang_id);
            if ($result) {
                Yii::$app->language = $result['locale'];
            }
        }
    }
    
    /**
     * Этот метод должен вызываться при инициализации контроллера, он 
     * делает редирект (если нужно) на выбранную языковую версию
     */
    public static function init() {
        
        // Определяем текущий язык
        self::detectClientLangId();
        
        $languageInurl = Yii::$app->request->languageInurl;
        $inurl = $languageInurl !== null 
                ? Languages::all()->getConfigByParam('url', $languageInurl) 
                : null;

        $current = Languages::all()->getConfigCurrent();
        $default = Languages::all()->getConfigDefault();
        
        $inurl_real_id = $inurl ? $inurl['id'] : $default['id'];
        
        if ($current!==null) {
            if ($inurl_real_id!==$current['id']) {
                // Префикс в ссылке и текущий язык не совпадают
                if (Yii::$app->urlManager->multilanguageHideDefaultPrefix
                        && YII_ENV!=='test' 
                        && Yii::$app->getRequest()->getMethod()==='GET' 
                        && !Yii::$app->getRequest()->isAjax) {
                    
                    $url =  \yii\helpers\Url::current(['x-language-url'=>$current['url']]);

                    Yii::$app->getResponse()->redirect($url)->send();
                    Yii::$app->end();
                }
            } else {
                if (Yii::$app->urlManager->multilanguageHideDefaultPrefix && $inurl && $inurl['id'] === $default['id']) {
                    $url = \yii\helpers\Url::current(['x-language-url'=>false]);
                    
                    Yii::$app->getResponse()->redirect($url)->send();
                    Yii::$app->end();
                }
            }
        } else {
            Yii::error('Unexpected null in $current language.', 'multilanguage');
        }
        
        if ($current)
            Yii::$app->language = $current['locale'];
    }
    
}