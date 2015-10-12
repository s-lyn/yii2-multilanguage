Yii2 Multi Language extension
=============================

The extension is under development.

## Installation

1) Set in Yii2 configuration file:
```php
'language'   => 'en-EN',
'sourceLanguage' => 'en-EN',
```
*Language* - default locale.

2) Set in params file all the languages do you needs:
```php
'languages' => [
    [
        'id' => 1,
        'url' => 'en',
        'locale' => 'en-EN',
        'name' => 'English',
        'default' => true,
    ],
    [
        'id' => 2,
        'url' => 'ru',
        'locale' => 'ru-RU',
        'name' => 'Русский',
    ],
],
```
\* Use unique integer ID.
\*\* Default - default language.

3) Install the package through composer:

    composer require pjhl/yii2-multilanguage:dev-master

4) Update your components:
```php
'components' => [
    'request' => [
        'class' => 'pjhl\multilanguage\components\AdvancedRequest'
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        //'enableStrictParsing' => true,
        'multilanguageHideDefaultPrefix' => true,
        'class' => 'pjhl\multilanguage\components\AdvancedUrlManager', // pjhl\yii2-multilanguage\components\UrlManager
    ],
],
```

## Controllers

All your controllers needs to extend **AdvancedController** like this:
```php
use pjhl\multilanguage\components\AdvancedController;

class SiteController extends AdvancedController {
    
}
```

