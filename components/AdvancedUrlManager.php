<?php

namespace pjhl\multilanguage\components;

use Yii;
use yii\web\UrlManager;
use pjhl\multilanguage\helpers\Languages;

class AdvancedUrlManager extends UrlManager {
    
    public $multilanguageHideDefaultPrefix = false;
    
    public function createUrl($params) {
        
        $default = Languages::all()->getConfigDefault();
        $current = Languages::all()->getConfigCurrent();
        
        $url_prefix = null;
        
        if (isset($params['x-language-url']) && !$params['x-language-url']) {
            $params['x-language-url'] = $default['url'];
        }
        
        if (isset($params['x-language-url']) && Languages::all()->getConfigByParam('url', $params['x-language-url'])) {
            $url_prefix = ($params['x-language-url'] === $default['url'] && $this->multilanguageHideDefaultPrefix)
                    ? ''
                    : $params['x-language-url'];
            unset($params['x-language-url']);
        }
        
//        echo "url_prefix: ";
//        var_export($url_prefix);
//        echo "\n";
//        
//        print_r($params);
//        exit;
        
        if ($url_prefix === null) {
            // Иначе подставляем текущий язык
            $url_prefix = Yii::$app->request->getLanguageInurl();
        }
        
        $url = parent::createUrl($params);
        if ($url_prefix) {
            $url = '/' . $url_prefix . $url;
        }
        return $url;
    }
    
//    public function createUrl($params) {
//        
//        $default = Languages::all()->getConfigDefault();
//        $current = Languages::all()->getConfigCurrent();
//        
//        if (!isset($params['x-language-url'])) {
//            if (is_string($params)) {
//                $params = $current['id'] === $default['id'] ? $params : "{$current['url']}/{$params}";
//            } else if (is_array($params)) {
//                if ($current['id'] !== $default['id'])
//                    $params['x-language-url'] = $current['url'];
//                else if (isset($params['x-language-url']))
//                    unset($params['x-language-url']);
//            }
//        } else {
//            if ($current['id'] === $default['id'] && is_array($params) && isset($params['x-language-url'])) {
//                unset($params['x-language-url']);
//            }
//        }
//        return parent::createUrl($params);
//    }
}
