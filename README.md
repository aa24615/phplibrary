# php常用函数库

###### 常用的函数 包含tp5 tp3 laravel 等框架函数


## php版本

```
PHP >= 7.0
```
## 安装

```shell
$ composer require php127/phplibrary
```

## 更新

```shell
$ composer update php127/phplibrary
```

## 安装之后，需要使用Composer的自动加载器

```php
require 'vendor/autoload.php';
```

## 使用示例

```php
<?php
use php127\library;
require 'vendor/autoload.php';

//生成随机手机号
echo get_rand_phone();

//更直观的print_r
$arr = ['a'=>123];
pr($arr);

//生成无限级目录树
mkdirs('src/library');

//更多请浏览手册
?>
```

## 详细文档请迁步

- [函数手册](http://library.php127.com/)
- [我的博客](http://blog.php127.com/)