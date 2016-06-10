<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use pjhl\multilanguage\LangHelper;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     * @return mixed
     */
    public function actionIndex() {
        $mode = (Yii::$app->request->queryParams 
                && isset(Yii::$app->request->queryParams['mode']) 
                && Yii::$app->request->queryParams['mode'])
                ? Yii::$app->request->queryParams['mode']
                : 0;
        switch ($mode) {
            case 1:
                Yii::$app->urlManager->enablePrettyUrl = true;
                Yii::$app->urlManager->showScriptName = true;
                break;
            case 2:
                Yii::$app->urlManager->enablePrettyUrl = false; // false false here too
                Yii::$app->urlManager->showScriptName = true;
                break;
            default:
                Yii::$app->urlManager->enablePrettyUrl = true;
                Yii::$app->urlManager->showScriptName = false;
                break;
        }
        return $this->render('index', [
            'mode' => $mode,
        ]);
    }
    
    public function actionLang() {
        return $this->render('lang');
    }
    
    // Change language
    public function actionChange($lang) {
        // Check if language isset
        $langData = LangHelper::getLanguageByParam('url', $lang);
        if ($langData) {
            // Save language
            setcookie('x-language-id', $langData['id'], time()+1000 * 86400 * 365, '/');
        }
        // Back to referer url
        $referer = Yii::$app->request->referrer;
        return $this->redirect($referer);
    }
    
}
