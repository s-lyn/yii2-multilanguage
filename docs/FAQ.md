FAQ
===

How to create a link to a page in a different language?
-------------------------------------------------------

Set link param `$params['x-language-url']` :

```php
yii\helpers\Url::current(['x-language-url'=>'es']); // "/es/"
yii\helpers\Url::toRoute(['site/login', 'x-language-url'=>'es']); // "/es/site/login"
yii\helpers\Html::a('Link', ['site/login', 'x-language-url'=>'es']); // "<a href='/es/site/login'>Link</a>"
```

It works for all links created by *UrlManager*.


How to create a link without language?
--------------------------------------

Set parameter `$params['x-language-url']=false`:

```php
yii\helpers\Url::toRoute(['site/login', 'x-language-url'=>false]); // "/site/login"
```

If no language is specified by default in `Yii::$app->params->languages`, then by
such links will be detected user's language with a redirect on translation.


How the script identifies the user's language?
----------------------------------------------

User language is identified priority:

1.   `$_COOKIE['x-language-id']`
2.   HTTP_ACCEPT_LANGUAGE
3.   Locale `Yii::$app->language`

