<?php


// +-------------------------------------------------------------------------
// | thinkphp5常用函数库
// +-------------------------------------------------------------------------
// | Copyright (c) 20011~2019 http://blog.php127.com All rights reserved.
// +-------------------------------------------------------------------------
// | Author: 读心印 <xz615@139.com>
// +-------------------------------------------------------------------------


if (!function_exists('get_url')) {
    /**
     * 带域名的url
     * @param array $url
     * @param array $key key
     * @return array|string
     */
    function get_url($url,$vars='',$suffix=true){
        $host = 'http://'.$_SERVER['HTTP_HOST'];
        return $host.url($url,$vars,$suffix);
    }
}

/**
 * TP5统计
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $field 字段(传入则统计字段总和)
 * @param string $cache 缓存名称
 * @return int
 */
function get_count($table, $where = "", $field = "") {
    $db = db ( $table );
    if ($field) {
        $count = $db->where ( $where )->sum ( $field );
    } else {
        $count = $db->where ( $where )->count ();
    }
    return $count ? $count : 0;
}

/**
 * TP5取单页列表
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @param string $limit 条数
 * @return array
 */
function get_list($table,$where="",$limit=10,$order=""){
    $db = db ( $table );
    return $db->where($where)->limit($limit)->order($order)->select();
}

/**
 * TP5取单条内容
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @return array|string
 */
function get_find($table,$where="",$field="",$order=""){
    $db = db ( $table );
    $F = $db->where($where)->order($order)->find();
    if($field){
        return $F[$field];
    }else{
        return $F;
    }
}