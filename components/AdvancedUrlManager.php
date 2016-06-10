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
        $url_lang = Yii::$app->language;
        
        // If isset lang param
        if (isset($params['x-language-url'])) {
            // If exists language
            $xLang = LangHelper::getLanguageByParam('url', $params['x-language-url']);
            if ($xLang) {
                $url_lang = $xLang['url'];
            }
            // Delete if is pretty url
            if ($this->enablePrettyUrl) {
                unset($params['x-language-url']);
            }
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
