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

require 'vendor/autoload.php';

//生成随机手机号
echo get_rand_phone();

//更直观的print_r
$arr = ['a'=>123];
pr($arr);

//生成无限级目录树
mkdirs('src/library');

?>
```

## 如果在thinkphp或laravel使用框架特有的函数
```
<?php

require 'vendor/autoload.php';

//获取数据表总行数
echo tp5_count('user');

//你可以指定条件
echo tp5_count('user','type=1');
echo tp5_count('user',['type'=>1]);

//获取用户总积分
echo tp5_count('user','type=1','score');

//获取用户前10条
$user = tp5_list('user','',10);
//根据某个条件
$user = tp5_list('user','type=1',10);
//或者积分最高
$user = tp5_list('user','type=1',10,'score desc');

//更多请移步详细函数列表

?>
```

## 详细函数列表请迁步

- [函数手册](http://library.php127.com/)
- [我的博客](http://blog.php127.com/)