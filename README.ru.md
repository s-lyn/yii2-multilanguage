Yii2 Multi Language extension
=============================

Это расширение позволяет делать многоязычные сайты на yii2.
Вместо неформальной спецификации используется статья google
["Мультирегиональные и многоязычные сайты"](https://support.google.com/webmasters/answer/182192?hl=ru).

**Примечание: расширение находится в стадии разработки.**

This instruction is available [in English](./README.md).


Особенности расширения
----------------------

*   Поддержка неограниченного количества языков.
*   Язык страницы вставляется в ссылку как директория.
*   Корректная работа с настройками yii\web\UrlManager: *enablePrettyUrl* и *showScriptName*.
*   Корректная работа сайта в подкаталогах (например, http://example.com/sub/directory/frontend/web/ru/site/login).
*   Возможность указать язык принудительно с помощью cookies. В этом случае скрипт
будет делать редирект, если пользователь открыл страницу с другим языком.
*   Редиректы только для GET-запросов. POST, Ajax XHR будут корректно работать.
*   Есть хелпер для переключения языка (легко использовать ссылки или bootstrap dropdown).
*   CRUD-actions для быстрой разработки модулей админки.
*   Поддержка `<link rel="alternate" ...` (TODO: сделать справку).


Примеры ссылок
--------------

*   http://example.com/en/
*   http://example.com/ru/
*   http://example.com/en/site/login
*   http://example.com/ru/site/login

Так будут выглядеть ссылки из настройками *enablePrettyUrl=true; showScriptName=false*.
Примеры для других настроек *yii\web\UrlManager* можно посмотреть тут (TODO: сделать справку).


Установка и настройка расширения
--------------------------------

*   [Установка и настройка расширения](./docs/INSTALL.ru.md)
*   [Смена языка](./docs/LANG-SWITCH.ru.md)
*   [Создание модели и контроллеров](./docs/MODELS.ru.md)
*   [LangHelper](./docs/LANG-HELPER.ru.md)
*   [Часто задаваемые вопросы](./docs/FAQ.ru.md)


Запуск тестов
-------------

```bash
php -S localhost:8090 -t advanced
composer run-script test
```

Перед запуском тестов у вас должен быть установлен [codeception](http://codeception.com/).


Task list
---------

- [ ] Rewrite `Controller->findModel(...)`
- [ ] Make a working example of the module "page"
- [ ] Cover the test more code
- [ ] Problem with text site/error. Session Flash Data (?)
- [ ] Detect language by IP (country) (?)
