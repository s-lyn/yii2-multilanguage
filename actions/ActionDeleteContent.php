<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;

class ActionDeleteContent extends Action {

    public function run($id, $lang_id=null) {
        $controller = $this->controller;
        $contentModelName = $controller::getContentModelName();
        // Удаление записи контента
        $contentModelName::findOne($id)->delete();
        return $controller->redirect(['index']);
    }

}
