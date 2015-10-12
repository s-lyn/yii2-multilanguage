<?php

namespace pjhl\multilanguage\components;

use Yii;
use yii\web\Request;
use pjhl\multilanguage\helpers\Languages;

class AdvancedRequest extends Request {
    
    private $lang_url = null;
    
    public function getLanguageInurl() {
        return $this->lang_url;
    }
    
    public function getPathInfo() {
        // Добавить кэш $pathInfo (не забыть про setPathInfo)
        $pathInfo = parent::getPathInfo();
        
        $pattern = Languages::all()->pattern();
        if (preg_match("/^($pattern)\/(.*)/", $pathInfo, $arr)) {
            $this->lang_url = $arr[1];
            $pathInfo = $arr[ count($arr)-1 ];
        }
        
        return $pathInfo;
    }

}
