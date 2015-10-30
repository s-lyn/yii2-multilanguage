<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;
use pjhl\multilanguage\helpers\Languages;

class ActionCreate extends Action {

    public function run() {
        $controller = $this->controller;
        $modelName = $controller::getModelName();
        $contentModelName = $controller::getContentModelName();

        $model = new $modelName();
        $session = Yii::$app->session;
        $modelContent = new $contentModelName();
        $modelContent->lang_id = Languages::currentLangId();
        
        if ($model->load(Yii::$app->request->post()) && $modelContent->load(Yii::$app->request->post())) {
            
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $res = $model->save();
                if ($res) {
                    $modelContent->parent_id = $model->id;
                    $modelContent->save();
                    $transaction->commit();
                } else {
                    print_r($model->errors);
                    throw new \Exception('Не удалось сохранить модель - ошибка валидации');
                }
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            //$session->setFlash('pageCreated', 'Страница оновлена.'); ##!! Edit
            return $controller->redirect(['update', 'id' => $model->id]);
        } else {
            return $controller->render('create', [
                'model' => $model,
                'modelContent' => $modelContent,
            ]);
        }
    }

}
