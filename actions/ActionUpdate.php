<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\data\ActiveDataProvider;
use pjhl\multilanguage\LangHelper;

class ActionUpdate extends Action {

    public function run($id, $lang_id=null) {
        $controller = $this->controller;
        $modelName = $controller::mlConf('model');
        $contentModelName = $controller::mlConf('contentModel');

        if (!$lang_id)
            $lang_id = LangHelper::getLanguage('id');
        $model = $controller->findModel($id, $lang_id);
        if (!$model->content) {
            $model->populateRelation('content', new $contentModelName());
            $model->content->lang_id = $lang_id;
            $model->content->parent_id = $model->id;
        }
        if ($model->load(Yii::$app->request->post()) && $model->content->load(Yii::$app->request->post())) {
            
            $isSaveSuccess = false;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save();
                $model->content->save();
                $transaction->commit();
                $isSaveSuccess = true;
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            
            if ($isSaveSuccess) {
                // We will redirect to view action if it exists. Otherwise, to update
                $redirectAction = $this->isControllerHasViewAction()
                        ? 'view'
                        : 'update';

                return $controller->redirect([
                    $redirectAction,
                    'id' => $model->id,
                    'lang_id'=>$lang_id
                ]);
            }
        }
        return $controller->render('update', [
            'model' => $model,
            'modelContent' => $model->content,
        ]);
     }
    
}
