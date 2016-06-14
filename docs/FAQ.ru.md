Часто задаваемые вопросы
========================

Как создать ссылку на страницу с другим языком?
-----------------------------------------------

Укажите параметр `$params['x-language-url']` ссылки:

```php
yii\helpers\Url::current(['x-language-url'=>'es']); // "/es/"
yii\helpers\Url::toRoute(['site/login', 'x-language-url'=>'es']); // "/es/site/login"
yii\helpers\Html::a('Link', ['site/login', 'x-language-url'=>'es']); // "<a href='/es/site/login'>Link</a>"
```

Работает для всех ссылок, создаваемых *UrlManager-ом*.


Как создать ссылку без языка?
-----------------------------

Укажите параметр `$params['x-language-url']=false`:

```php
yii\helpers\Url::toRoute(['site/login', 'x-language-url'=>false]); // "/site/login"
```

Если ни один язык в `Yii::$app->params->languages` не указан по умолчанию, то по 
таким ссылкам будет определен язык пользователя и сделана переадресаця
на перевод.


Как определяется язык пользователя?
-----------------------------------

Язык пользователя определяется в приоритете:

1.   `$_COOKIE['x-language-id']`
2.   HTTP_ACCEPT_LANGUAGE
3.   Locale `Yii::$app->language`

