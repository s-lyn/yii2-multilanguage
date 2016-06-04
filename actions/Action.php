<?php

namespace pjhl\multilanguage\actions;

class Action extends \yii\base\Action {
    
    /**
     * @return boolean
     */
    protected function isControllerHasViewAction() {
        $controller = $this->controller;
        // Check in default actions
        $actions = $controller->actions();
        if ($actions && is_array($actions) && isset($actions['view']) && $actions['view'])
            return true;
        // Check in standalone Actions
        if ($controller->hasMethod('actionView')) {
            return true;
        }
        
        return false;
    }
    
}

