<?php

namespace pjhl\multilanguage\components;

use Yii;
use yii\web\UrlManager;
use pjhl\multilanguage\helpers\Languages;
use pjhl\multilanguage\LangHelper;

class AdvancedUrlManager extends UrlManager {

    public function createUrl($params) {

        $default = Languages::all()->getConfigDefault();
        $current = LangHelper::getLanguageByParam('locale', Yii::$app->language);
        
        // Url's language such as "en"
        $url_lang = null;

        if (isset($params['x-language-url']) && !$params['x-language-url']) {
            $params['x-language-url'] = $default['url'];
        }

        if (isset($params['x-language-url']) && Languages::all()->getConfigByParam('url', $params['x-language-url'])) {
            $isDefault = isset($default['default']) && $default['default'];
            $url_lang = ($params['x-language-url'] === $default['url'] && $isDefault) ? '' : $params['x-language-url'];
            // Delete if is pretty url
            if ($this->enablePrettyUrl) {
                unset($params['x-language-url']);
            }
        }

        if ($url_lang === null) {
            // Иначе подставляем текущий язык
            $url_lang = Yii::$app->request->getLanguageInurl();
        }

        $url = parent::createUrl($params);
        if ($url_lang) {
            // Pretty url
            if ($this->enablePrettyUrl && !$this->showScriptName) {
                $pattern = "/^" . preg_quote($this->baseUrl, '/') . "/";
                $url = preg_replace($pattern, $this->baseUrl . '/' . $url_lang, $url );
            } else if ($this->enablePrettyUrl && $this->showScriptName) {
                // Pretty url with showScriptName 
                $pattern = "/^" . preg_quote($this->scriptUrl, '/') . "/";
                $url = preg_replace($pattern, $this->scriptUrl . '/' . $url_lang , $url );
            }
        }
        return $url;
    }

}
