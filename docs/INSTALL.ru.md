Установка и настройка расширения
================================

1) Добавьте в конфигурационный файл Yii2:
```php
'language'   => 'en',
'sourceLanguage' => 'en',
```

Где *language* - язык по умолчанию.

2) В params.php (*Yii::$app->params*) настройте список всех языков так:
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
\* Используйте уникальный атрибут *"id"*.
\*\* Default - язык по умолчанию (будет отображаться без поддиректории в ссылке, например главная просто */*).
Не устанавливайте ни один язык по умолчанию, чтоб скрипт всегда делал редирект на необходимый 
перевод страницы.

3) Установите расширение с помощью [composer](http://getcomposer.org/download/):
```
php composer.phar require pjhl/yii2-multilanguage:~0.2
```

или добавьте в ваш файл `composer.json` :

```
"pjhl/yii2-multilanguage": "^0.2"
```

4) Настройте список компонентов yii2:
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

5) Добавьте  [.htaccess](http://www.yiiframework.com/doc-2.0/guide-tutorial-shared-hosting.html#add-extras-for-webserver) 
или аналогичную конфигурацию nginx для красивых ссылок. 

Вы можете пропустить этот шаг, если не используете pretty url.

6) Добавьте автозапуск расширения в конфиг-файл yii:
```php
'on beforeAction' => ['\pjhl\multilanguage\Start', 'run'],
```

После установки
---------------

Хорошо, вы установили расширение. Теперь можно приступить к добавлению
[переключателя языков](./LANG-SWITCH.ru.md),
[создания многоязычных моделей и CRUD](./MODELS.ru.md).
