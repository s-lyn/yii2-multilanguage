<?php

namespace pjhl\multilanguage\components;

use Yii;
use yii\web\UrlManager;
use pjhl\multilanguage\helpers\Languages;

class AdvancedUrlManager extends UrlManager {
    
    public function createUrl($params) {
        
        $default = Languages::all()->getConfigDefault();
        $current = Languages::all()->getConfigCurrent();
        
        $url_prefix = null;
        
        if (isset($params['x-language-url']) && !$params['x-language-url']) {
            $params['x-language-url'] = $default['url'];
        }
        
        if (isset($params['x-language-url']) && Languages::all()->getConfigByParam('url', $params['x-language-url'])) {
            $isDefault = isset($default['default']) && $default['default'];
            $url_prefix = ($params['x-language-url'] === $default['url'] && $isDefault)
                    ? ''
                    : $params['x-language-url'];
            unset($params['x-language-url']);
        }
        
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
    
}
