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
        'multilanguageHideDefaultPrefix' => true,
        'class' => 'pjhl\multilanguage\components\AdvancedUrlManager',
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

## Language selector

Add this code in your view:

```php
<?php
use pjhl\multilanguage\assets\ChangeLanguageAsset;
ChangeLanguageAsset::register($this);
?>
<a href="#" class="multilanguage-set" data-language="1">EN</a>
<a href="#" class="multilanguage-set" data-language="2">RU</a>
```

You can use more complicated switches.

## Helper

```php
use pjhl\multilanguage\helpers\Languages;

// Get current Lang ID
$langId = Languages::currentLangId(); // 1

// Get current language params
$data = Languages::all()->getConfigCurrent();
echo $data['name']; // "English"
```

