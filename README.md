# phpramcache
Php cache in Server RAM
### Установка и настройка phpramcache

Создаем в оперативной памяти RAMDISK и монтируем к папке
mount -t [TYPE] -o size=[SIZE] [FSTYPE] [MOUNTPOINT]
[TYPE]  - тип рам диска - tmpfs, ramfs, ext4
[SIZE] - Размер
[FSTYPE] Тип файловой системы на диске tmpfs, ramfs, ext4, etc.

```sh
$ mkdir /home/bitrix/www/newramdisk
$ mount -t tmpfs -o size=4096m tmpfs /home/bitrix/www/newramdisk
```

Подключаем класс работы с кешем в PHP

```sh
$ composer require aachibilyaev/phpramcache
```

В Php подключаем класс и работаем с ним. В классе 2 метода - положить в кеш и взять из кеша.
```php
<?php
require 'vendor/autoload.php';
use aachibilyaev\phpramcache;
//В конструкторе по умолчанию указана папка /tmp/
$cache = new Phpramcache('/home/bitrix/www/newramdisk');
//Кладем данные в кеш. Первый параметр - ключ. Второй параметр - значение
$cache->setStorage('testkey', 'testdata');
//Получение данных из кеша
echo $cache->getStorage('testkey'); //Выводит testdata
```
