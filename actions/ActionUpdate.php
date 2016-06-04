<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\data\ActiveDataProvider;
use pjhl\multilanguage\helpers\Languages;

class ActionUpdate extends Action {

    public function run($id, $lang_id=null) {
        $controller = $this->controller;
        $modelName = $controller::mlConf('model');
        $contentModelName = $controller::mlConf('contentModel');

        if (!$lang_id)
            $lang_id = Languages::currentLangId();
        $model = $controller->findModel($id);
        $session = Yii::$app->session;
        
        $modelContent = $model->getContent($lang_id)->one();
        if (!$modelContent) {
            $modelContent = new $contentModelName();
            $modelContent->lang_id = $lang_id;
        }
        
        if ($model->load(Yii::$app->request->post()) && $modelContent->load(Yii::$app->request->post())) {
            
            $modelContent->lang_id = $lang_id;
            $modelContent->parent_id = $model->id;
            
            $isSaveSuccess = false;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save();
                $modelContent->save();
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
            'modelContent' => $modelContent,
        ]);
     }
    
}
