

# php常用函数库
常用的函数 包含tp5 tp3 laravel 等框架函数


## 更新日志

###  **V1.0.7** `2019.07.18`

1. 【新增】laravel统计函数
2. 【新增】laravel列表函数
3. 【新增】laravel单条查询函数



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

## 使用

```php
<?php
//使用 Composer 的自动加载器
require 'vendor/autoload.php';
?>
```

## 示例

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

//===========================================
//如果在thinkphp或laravel使用框架特有的函数
//tp5 tp3 laravel 请使用简写前缀
//tp5_xxx tp3_xxx la_xxx
//在框架中,我们封装了一些数据库操作函数
//比如 统计表 取列表 取某一条 在开发中有很好的效率
//===========================================

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
## 在模板中使用

```
//统计用户表总行数
{:tp5_count('user')}
//获取某用户的昵称
{$uid|tp5_find='username'}
//取出最新10个用户
{volist name=':tp5_list("user")' id='vo'}
    {$vo.username} 
{/volist}

//在不同的框架中,使用不同的前缀即可

```

## 详细函数列表请迁步

- [函数手册](http://library.php127.com/)
- [我的博客](http://blog.php127.com/)

## 联系我们

- QQ群: [324098841](http://shang.qq.com/wpa/qunwpa?idkey=6f5462146888da75feaaa1fe1ab3addfcea63f6454548238033c6a91fa610e4e)

- 博客: [blog.php127.com](http://blog.php127.com)

- 更多开源项目: [github.com/aa24615](https://github.com/aa24615)

