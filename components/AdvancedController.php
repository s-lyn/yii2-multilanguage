<?php

namespace pjhl\multilanguage\components;
use Yii;
use yii\web\Controller;
use pjhl\multilanguage\helpers\Languages;

class AdvancedController extends Controller {
    
    
    public function init() {
        parent::init();
    }
    
    public function beforeAction($action) {
        Languages::init();
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }

}
