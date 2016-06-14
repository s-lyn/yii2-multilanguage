Yii2 Multi Language extension
=============================

This extension allows you to do multi-language sites on yii2.
Instead, an informal specification uses the article
["Multi-regional and multilingual sites" (Google)](https://support.google.com/webmasters/answer/182192?hl=en).

**Note: extension is under development.**

Эта инструкция доступна на [русском языке](./README.ru.md).


Features
--------

*   Supports an unlimited number of languages.
*   Page language inserted into the link as a directory.
*   Correct work with the settings yii\web\UrlManager: *enablePrettyUrl* and *showScriptName*.
*   Site works correctly in subdirectories (eg, http://example.com/sub/directory/frontend/web/ru/site/login).
*   The ability to select the language in the cookie. In this case, the script
will make a redirect.
*   Redirects just for GET-requests. POST, Ajax XHR will work correctly.
*   There is helper to change the language (it is easy to use links or bootstrap dropdown).
*   CRUD-actions to quickly develop the admin modules.
*   Support of `<link rel="alternate" ...` (TODO: make help).


Examples of links
-----------------

*   http://example.com/en/
*   http://example.com/ru/
*   http://example.com/en/site/login
*   http://example.com/ru/site/login

This type of links with the settings *enablePrettyUrl = true; showScriptName = false*.
Examples of other settings *yii\web\UrlManager* can be found here (TODO: make help).


Installing and configuring extensions
-------------------------------------

*   [Installing and configuring extensions](./docs/INSTALL.md)
*   [Switch language](./docs/LANG-SWITCH.md)
*   [LangHelper](./docs/LANG-HELPER.md)
*   [FAQ](./docs/FAQ.md)

Run tests
---------

```bash
php -S localhost:8090 -t advanced
composer run-script test
```

Before starting the test, you must have installed [codeception](http://codeception.com/).


Task list
---------

- [ ] Rewrite `Controller->findModel(...)`
- [ ] Make a working example of the module "page"
- [ ] Cover the test more code
- [ ] Problem with text site/error. Session Flash Data (?)
- [ ] Detect language by IP (country) (?)
