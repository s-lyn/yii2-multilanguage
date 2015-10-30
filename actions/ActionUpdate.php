<?php

namespace pjhl\multilanguage\actions;

use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;
use pjhl\multilanguage\helpers\Languages;

class ActionUpdate extends Action {

    public function run($id, $lang_id=null) {
        $controller = $this->controller;
        $modelName = $controller::getModelName();
        $contentModelName = $controller::getContentModelName();

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
            
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save();
                $modelContent->save();
                $transaction->commit();
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            
            //$session->setFlash('pageUpdated', 'Страница оновлена.'); ##!! Edit
            return $controller->redirect(['update', 'id' => $model->id, 'lang_id'=>$lang_id]);
        } else {
            return $controller->render('update', [
                'model' => $model,
                'modelContent' => $modelContent,
            ]);
        }
    }

}
