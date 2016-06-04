<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\data\ActiveDataProvider;

class ActionIndex extends Action {

    public function run() {
        $controller = $this->controller;
        $modelName = $controller::mlConf('searchModel');

        $searchModel = new $modelName();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $controller->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
