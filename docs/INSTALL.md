Installing and configuring extensions
=====================================

1) Set in Yii2 configuration file:
```php
'language'   => 'en',
'sourceLanguage' => 'en',
```

*language* - default locale.

2) Set in params file all the languages do you needs:
```php
'languages' => [
    [
        'id' => 1,
        'url' => 'en',
        'locale' => 'en',
        'name' => 'English',
        'default' => true,
    ],
    [
        'id' => 2,
        'url' => 'ru',
        'locale' => 'ru',
        'name' => 'Русский',
    ],
],
```
\* Use unique integer ID.
\*\* Default - default language (/en /ru - standard, / - default).
Do not set any default language so that the script always redirects to the language subfolder.

3) Install the extension through [composer](http://getcomposer.org/download/):
```
php composer.phar require pjhl/yii2-multilanguage:~0.2
```

or add this line to the require section of your `composer.json` file.

```
"pjhl/yii2-multilanguage": "^0.2"
```

4) Update your components:
```php
'components' => [
    'request' => [
        'class' => 'pjhl\multilanguage\components\AdvancedRequest'
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'class' => 'pjhl\multilanguage\components\AdvancedUrlManager',
    ],
],
```

5) Add [.htaccess](http://www.yiiframework.com/doc-2.0/guide-tutorial-shared-hosting.html#add-extras-for-webserver) or 
nginx config for pretty url. 

Skip this step if you do not want to use pretty url.

6) Set in Yii2 configuration file:
```php
'on beforeAction' => ['\pjhl\multilanguage\Start', 'run'],
```

After install
-------------

Okay, you have installed the extension.
Now you can configure [language switching](./LANG-SWITCH.md),
[creating multilingual models and CRUD](./MODELS.md).
