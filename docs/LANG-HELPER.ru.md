LangHelper
==========

Вы можете получить локаль текущего языка с помощью ```php Yii::$app->language```,
но более удобные данные можно получить с помощью хелпера:

```php
<?php

use pjhl\mltilanguage\LangHelper;
```

Для примера будем использовать конфигурацию в *params.php*:
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

Возвращает список всех языков (аналог ```php Yii::$app->params```).

### LangHelper::getLanguage(\[$key\]);

Возвращает данные текущего языка. Если указан необязательный параметр *$key*, возвратит
значение этого ключа.

```php
LangHelper::getLanguage(); // [ 'id' => 1, 'url' => 'en', 'locale' => 'en', ...
LangHelper::getLanguage('id'); // 1
LangHelper::getLanguage('locale'); // "en"
LangHelper::getLanguage('name'); // "English"
```

### LangHelper::getLanguageByParam($name, $value);

Возвращает данные языка по его значению.

```php
LangHelper::getLanguageByParam('url', 'ru'); // [ 'id' => 2, 'url' => 'ru', 'locale' => 'ru', ...
```