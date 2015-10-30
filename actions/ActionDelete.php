<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;

class ActionDelete extends Action {

    public function run($id, $lang_id=null) {
        $controller = $this->controller;
        $modelName = $controller::getModelName();
        $contentModelName = $controller::getContentModelName();

        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Удаление всех языковых версий
            $contentModelName::deleteAll(['parent_id'=>$id]);
            ##!! Думаю можно переопределить метод delete() в меделе Page, чтоб удалять и всех потомков
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
