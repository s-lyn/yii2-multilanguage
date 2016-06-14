LangHelper
==========

You can get the current language locale by using ```php Yii::$app->language```,
but a more convenient data can be obtained using helper:

```php
<?php
use pjhl\mltilanguage\LangHelper;
```

For example, we will use the configuration in *params.php*:
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

### LangHelper::languages();

Returns a list of the configurations for all languages (analogue ```php Yii::$app->params```).

### LangHelper::getLanguage(\[$key\]);

Returns the current language settings. If you set optional parameter *$key*, 
function returns the value of this key.

```php
LangHelper::getLanguage(); // [ 'id' => 1, 'url' => 'en', 'locale' => 'en', ...
LangHelper::getLanguage('id'); // 1
LangHelper::getLanguage('locale'); // "en"
LangHelper::getLanguage('name'); // "English"
```

### LangHelper::getLanguageByParam($name, $value);

Returns the language setting on the value of its parameter.

```php
LangHelper::getLanguageByParam('url', 'ru'); // [ 'id' => 2, 'url' => 'ru', 'locale' => 'ru', ...
```