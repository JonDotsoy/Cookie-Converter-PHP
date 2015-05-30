Cookie Converter
================

Una herramienta que permite trabajar con cadenas de textos obtenidas en los headers http y capturar los valores de las cookies o viceversa crear una cadena http con las cookies a partir de valores. 

Como Instalar
-------------

```
$ composer require jondotsoy/cookieconverter
```



Como usar
---------

### Cookie a String

```php
<?php 
$cookie = new \cookieConverter\cookie();

$cookie->cookies["SSID"] = "aBsdCDp"; 
$cookie->cookies["USER"] = "userA"; 

// SSID=aBsdCDp; USER=userA
echo $cookie;
?>
```



### String a Cookie

```php
<?php 
$cookie = new \cookieConverter\cookie("Lp=AAA; Expires=Wed, 13 Jan 2021 22:23:01 GMT");

// AAA
echo $cookie->cookies['Lp'];

// 1610576581
echo $cookie->expires;
?>
```



Licencia
--------

[License MIT](LICENSE).
