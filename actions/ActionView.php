<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\data\ActiveDataProvider;

class ActionView extends Action {

    public function run($id) {
        $controller = $this->controller;
        
        return $controller->render('view', [
                    'model' => $controller->findModel($id),
        ]);
    }

}
