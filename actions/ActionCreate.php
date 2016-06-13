<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\data\ActiveDataProvider;
use pjhl\multilanguage\LangHelper;

class ActionCreate extends Action {

    public function run() {
        $controller = $this->controller;
        $modelName = $controller::mlConf('model');
        $contentModelName = $controller::mlConf('contentModel');

        $model = new $modelName();
        $model->populateRelation('content', new $contentModelName());
        $model->content->lang_id = LangHelper::getLanguage('id');
        
        if ($model->load(Yii::$app->request->post()) && $model->content->load(Yii::$app->request->post())) {
            $isSaveSuccess = false;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $res = $model->save();
                if ($res) {
                    $model->content->parent_id = $model->id;
                    $model->content->save();
                    $transaction->commit();
                    $isSaveSuccess = true;
                } else {
                    throw new \Exception('Не удалось сохранить модель - ошибка валидации');
                }
            } catch(\Exception $e) {
                $transaction->rollBack();
                //throw $e;
            }
            
            if ($isSaveSuccess) {
                // We will redirect to view action if it exists. Otherwise, to update
                $redirectAction = $this->isControllerHasViewAction()
                        ? 'view'
                        : 'update';

                return $controller->redirect([
                    $redirectAction,
                    'id' => $model->id,
                    'lang_id' => $model->content->lang_id,
                ]);
            }
        }
        
        return $controller->render('create', [
            'model' => $model
        ]);
        
    }
    
}
