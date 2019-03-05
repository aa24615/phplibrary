<?php

// +-------------------------------------------------------------------------
// | thinkphp3常用函数库
// +-------------------------------------------------------------------------
// | Copyright (c) 20011~2019 http://blog.php127.com All rights reserved.
// +-------------------------------------------------------------------------
// | Author: 读心印 <xz615@139.com>
// +-------------------------------------------------------------------------



/**
 * TP3统计
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $field 字段(传入则统计字段总和)
 * @param int $time 缓存时间
 * @param string $cache 缓存名称
 * @return int
 */
function get_count($table,$where="",$field="",$time=1800,$cache=true){
    $db   = M($table);
    $time = $time ? : C('DATA_CACHE_TIME');
    if($field){
        $count = $db->cache($cache,$time)->where($where)->sum($field);
    }else{
        $count = $db->cache($cache,$time)->where($where)->count();
    }
    return $count ? : 0;
}


/**
 * TP3取单条内容
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @param int $time 缓存时间
 * @param string $cache 缓存名称
 * @return array|string
 */
function get_find($table,$where="",$order="",$field="",$time=1800,$cache=true){
    $time = $time ? : C('DATA_CACHE_TIME');
    $F=M($table)->cache($cache,$time)->where($where)->order($order)->field($field)->find();
    $c=$field ? $F[$field] : $F;
    return $c ? : false;
}


/**
 * TP3取单页列表
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $order 排序
 * @param string $limit 条数
 * @param int $time 缓存时间
 * @param string $cache 缓存名称
 * @return array
 */
function get_list($table,$where='',$order='',$limit="",$time=1800,$cache=true){
    $time = $time ? : C('DATA_CACHE_TIME');
    $list=M($table)->cache($cache,$time)->where($where)->order($order)->limit($limit)->select();
    return $list;
}
