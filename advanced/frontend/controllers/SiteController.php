<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;

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
        $mode = Yii::$app->request->queryParams['mode']
                ? Yii::$app->request->queryParams['mode']
                : 0;
        Yii::$app->language = 'ru';
        switch ($mode) {
            case 1:
                Yii::$app->urlManager->enablePrettyUrl = true;
                Yii::$app->urlManager->showScriptName = true;
                break;
            case 2:
                Yii::$app->urlManager->enablePrettyUrl = false; // false false
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

}
