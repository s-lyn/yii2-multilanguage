<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\data\ActiveDataProvider;

class ActionDelete extends Action {

    public function run($id, $lang_id=null) {
        $controller = $this->controller;
        $modelName = $controller::mlConf('model');
        $contentModelName = $controller::mlConf('contentModel');

        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Удаление всех языковых версий
            $contentModelName::deleteAll(['parent_id'=>$id]);
            // Удаление записи страницы
            $controller->findModel($id)->delete();
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $controller->redirect(['index']);
    }

}
