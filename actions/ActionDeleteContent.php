<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\data\ActiveDataProvider;

class ActionDeleteContent extends Action {

    public function run($id, $lang_id=null) {
        $controller = $this->controller;
        $contentModelName = $controller::mlConf('contentModel');
        // Удаление записи контента
        $contentModelName::findOne($id)->delete();
        return $controller->redirect(['index']);
    }

}
