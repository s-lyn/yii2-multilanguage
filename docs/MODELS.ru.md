Создание модели и контроллеров
==============================

Для мультиязычности создается две модели:

1) Основная модель
2) Переводы

Рассмотрим шаг за шагом создание модуля на примере простых страниц.

#### Таблица page:

Поле            | Тип           | Описание
------------    | ------------- | -------------
id              | integer       | PrimaryKey
...             | ...           | Другие поля, для которых перевод не нужен (дата, статус и т.д)

#### Таблица page_content:

Поле            | Тип           | Описание
------------    | ------------- | -------------
id              | integer       | PrimaryKey
parent_id       | integer       | ForeignKey (внешний ключ) -> page.id
lang_id         | smallint      | ID языка
name            | varchar(255)  | Название страницы
text            | text          | Текст страницы

1) Создаем модель Page.php
--------------------------

```php
class Page extends \yii\db\ActiveRecord {
    
    public static function tableName() {
        return 'page';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent() {
        return $this->hasOne(PageContent::className(), ['parent_id' => 'id']);
    }
    
    /**
     * Returns list af all language versions
     * @return \yii\db\ActiveQuery
     */
    public function getContentAll() {
        return $this->hasMany(PageContent::className(), ['parent_id' => 'id']);
    }
}
```

2) Создаем модель PageContent.php
---------------------------------

```php
class PageContent extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'page_content';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage() {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }
}
```

3) Создадим PageController.php (backend)
----------------------------------------

```php
class PageController extends Controller {

    public function actions() {
        return [
            'index' => 'pjhl\multilanguage\actions\ActionIndex',
            'create' => 'pjhl\multilanguage\actions\ActionCreate',
            'view' => 'pjhl\multilanguage\actions\ActionView',
            'update' => 'pjhl\multilanguage\actions\ActionUpdate',
            'delete' => 'pjhl\multilanguage\actions\ActionDelete',
            'deleteContent' => 'pjhl\multilanguage\actions\ActionDeleteContent',
        ];
    }

    /**
     * Get multilanguage configuration
     * @param string $key   Optional key
     * @return string|array
     */
    public static function mlConf($key = null) {
        $data = [
            // Main model class
            'model' => 'common\models\Page',
            // Content model classs
            'contentModel' => 'common\models\PageContent',
            // Search model
            'searchModel' => 'backend\models\PageSearch',
        ];
        return ($key!==null)
                ? $data[$key]
                : $data;
    }
    
    /**
     * Finds the Page model based on its primary key value [and langId]
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $langId
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id, $langId=null) {
        $query = Page::find($id)
                ->where(['id'=>$id]);
        if ($langId!==null) {
            $query->with([
                'content' => function (\yii\db\ActiveQuery $query) use ($langId) {
                    $query->andWhere(['lang_id' => $langId]);
                }
            ]);
        } else {
            $query->with('content');
        }
        $model = $query->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested row does not exist.');
        }
    }
}
```

4) Сделать правки в views/page/* (backend)
------------------------------------------

_form.php:

```php
<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use pjhl\multilanguage\LangHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="hidden">
        <?= $form->field($model->content, 'id')->hiddenInput() ?>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'date')->textInput() ?>
        </div>
        <div class="col-md-offset-8 col-md-4">
            <?= $form->field($model->content, 'lang_id')
                    ->dropDownList(ArrayHelper::map(LangHelper::languages(), 'id', 'name')
                            , array('disabled'=>!$model->isNewRecord)) ?>
        </div>
    </div>
    
    <hr>

    <?= $form->field($model->content, 'name')->textInput() ?>

    <?= $form->field($model->content, 'text')->textarea(array('rows'=>15)) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord 
                ? Yii::t('page', 'Create') 
                : Yii::t('page', 'Update'), ['class' => $model->isNewRecord 
                        ? 'btn btn-success' 
                        : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
```

Изменения других view касаются только использования для переводов
`$model->content->...` вместо привычного `$model->...`.

P.S.
----

Реализацию бекенда с помощью views можно делать по разному.
Мою реализацию можно в модуле pjhl/yii2-pages (TODO: создать модуль статических сраниц),
там же есть работая демка (TODO: создать демку).