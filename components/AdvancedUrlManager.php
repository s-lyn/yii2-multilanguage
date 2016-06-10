<?php

namespace pjhl\multilanguage\components;

use Yii;
use yii\web\UrlManager;
use pjhl\multilanguage\helpers\Languages;
use pjhl\multilanguage\LangHelper;

class AdvancedUrlManager extends UrlManager {

    public function createUrl($params) {

        // Url's language such as "en"
        $url_lang = Yii::$app->language;
        
        // If isset lang param
        if (isset($params['x-language-url'])) {
            // If exists language
            $xLang = LangHelper::getLanguageByParam('url', $params['x-language-url']);
            if ($xLang) {
                $url_lang = $xLang['url'];
            }
        }
        
        $current = LangHelper::getLanguageByParam('locale', $url_lang);
        $isDefault = isset($current['default']) && $current['default'];
        
        // Delete if is pretty url
        if ($this->enablePrettyUrl || $isDefault) {
            unset($params['x-language-url']);
        }

        $url = parent::createUrl($params);
        if ($current) {
            // Is curent language 
            
            // Pretty url
            if ($this->enablePrettyUrl && !$this->showScriptName) {
                $pattern = "/^" . preg_quote($this->baseUrl, '/') . "/";
                $replaceTo = $this->baseUrl;
                if (!$isDefault) {
                    $replaceTo .= '/' . $url_lang;
                }
                $url = preg_replace($pattern, $replaceTo, $url );
            } else if ($this->enablePrettyUrl && $this->showScriptName) {
                // Pretty url with showScriptName 
                $pattern = "/^" . preg_quote($this->scriptUrl, '/') . "/";
                $replaceTo = $this->baseUrl;
                if (!$isDefault) {
                    $replaceTo .= '/' . $url_lang;
                }
                $url = preg_replace($pattern, $replaceTo, $url );
            }
        }
        return $url;
    }

}
