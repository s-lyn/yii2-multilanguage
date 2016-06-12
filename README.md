Yii2 Multi Language extension
=============================

This extension allows you to do multi-language sites on yii2.
Instead, an informal specification uses the article
["Multi-regional and multilingual sites" (Google)](https://support.google.com/webmasters/answer/182192?hl=en).

Эта инструкция доступна на [русском языке](./README.ru.md).

Features
--------

*   Supports an unlimited number of languages.


Note: the extension is under development.



Run tests:

```bash
php -S localhost:8090 -t advanced
composer run-script test
```


## Installation

1) Set in Yii2 configuration file:
```php
'language'   => 'en',
'sourceLanguage' => 'en',
```
*Language* - default locale.

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

3) Install the package through composer:

    composer require pjhl/yii2-multilanguage:~0.1.0

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

5) Set in Yii2 configuration file:
```php
'on beforeAction' => ['\pjhl\multilanguage\Start', 'run'],
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

## Backend controllers

Для мультиязычных моделей нужны две таблицы, например:

*page:*

- id (integer PrimaryKey)
- ... другие колонки таблицы, не нуждающиеся в переводе

И связная с ней таблица:

*page_content:*

- id (integer PrimaryKey)
- parent_id (integer) [для связи с page.id]
- lang_id (smallint) [ID языка]
- ... другие колонки таблицы (varchar, text), нуждащиеся в переводе. Пусть для примера добавим следующую.
- text (text)

1) Создаем две модели - Page.php и PageContent.php.

2) Для PageController.php добавляем код (это настроит связи):

```php
public static function getModelName() {
    return 'app\modules\Page';
}

public static function getContentModelName() {
    return 'app\models\PageContent';
}
```

3) Создадим Page.php, которая будет использоваться в админке:
```php
<?php

namespace app\modules\admin\models;

use pjhl\multilanguage\components\BackendModelTrait;

class Page extends \app\models\Page {
    use BackendModelTrait;
}
```

4) В app\models\Page.php добавим код:
```php
/**
 * Content model classs
 * @return string
 */
public static function getContentModelName() {
   return 'app\models\PageContent';
}

/**
 * @return \yii\db\ActiveQuery
 */
public function getContent($langId = null) {
    if (!$langId)
        $langId = Languages::currentLangId();

    return $this->hasOne(PageContent::className(), ['parent_id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $langId]);
}
```

5) Остальное дело за view. См. пример "page" или "post".