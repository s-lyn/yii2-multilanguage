<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;

class ActionIndex extends Action {

    public function run() {
        $controller = $this->controller;
        $modelName = $controller::getModelName();

        $dataProvider = new ActiveDataProvider([
            'query' => $modelName::find()->with('contentAll'),
        ]);

        return $controller->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }
    
}
