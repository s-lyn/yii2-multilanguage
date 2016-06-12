<?php

namespace pjhl\multilanguage\components;

use Yii;
use yii\web\Request;
use pjhl\multilanguage\LangHelper;

class AdvancedRequest extends Request {

    private $lang_url = null;

    public function getLanguageInurl() {
        return $this->lang_url;
    }

    public function getPathInfo() {
        $pathInfo = parent::getPathInfo();
        $pattern = LangHelper::pattern();

        if (preg_match("/^($pattern)\/(.*)/", $pathInfo, $arr)) {
            $this->lang_url = $arr[1];
            $pathInfo = $arr[count($arr) - 1];
        } else if (isset($this->queryParams['x-language-url']) 
                && LangHelper::getLanguageByParam('url', $this->queryParams['x-language-url'])) {
            // If enablePrettyUrl===false
            $this->lang_url = $this->queryParams['x-language-url'];
        } else {
            $this->lang_url = null;
        }

        return $pathInfo;
    }

}
