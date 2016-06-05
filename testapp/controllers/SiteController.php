<?php

namespace testapp\controllers;

use Yii;
use yii\web\Controller;

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
        return 'Nice works!';
    }

}
