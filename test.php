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