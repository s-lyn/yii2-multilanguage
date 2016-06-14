Смена языка
===========

Для смены языка пользователя достаточно установить ID языка в `COOKIE['x-language-id']`.

На PHP:

```php
setcookie('x-language-id', $langId, time()+1000 * 86400 * 365, '/'); // $langId - integer
```

JS:

```js
var date = new Date(new Date().getTime() + 86400000 * 365); // 1 year
document.cookie = "x-language-id="+langId+"; path=/; expires=" + date.toUTCString();
```

JQuery [cookie plugin](https://plugins.jquery.com/cookie/):

```js
$.cookie('x-language-id', langId, { expires: 365, path: '/' });
```

Или вы можете воспользоваться встроенным asset-ом:

```php
<?php
use pjhl\multilanguage\assets\ChangeLanguageAsset;
ChangeLanguageAsset::register($this);
?>
<a href="#" class="multilanguage-set" data-language="1">EN</a>
<a href="#" class="multilanguage-set" data-language="2">RU</a>
```

Можно использовать Dropdown:
```php
<?php
use pjhl\multilanguage\assets\ChangeLanguageAsset;
ChangeLanguageAsset::register($this);
?>
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    English
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li class="active"><a href="#" class="multilanguage-set" data-language="1">English</a></li>
    <li><a href="#" class="multilanguage-set" data-language="2">Русский</a></li>
  </ul>
</div>
```
