<?php
namespace php127\laravel;
// +-------------------------------------------------------------------------
// | laravel常用函数库
// +-------------------------------------------------------------------------
// | Copyright (c) 20011~2019 http://blog.php127.com All rights reserved.
// +-------------------------------------------------------------------------
// | Author: 读心印 <xz615@139.com>
// +-------------------------------------------------------------------------

function la_test(){
    echo 'hello laravel';
}



/**
 * laravel统计
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $field 字段(传入则统计字段总和)
 * @param string $cache 缓存名称
 * @return int
 */
function la_count($table, $where = "", $field = "",$key='',$time=86400){

    if()
    Cache::get('key');
    $db = Illuminate\Support\Facades\DB::table($table);
    if ($field) {
        $count = $db->where($where)->sum($field);
    } else {
        $count = $db->where($where)->count();
    }
    return $count ? $count : 0;
}

/**
 * laravel取单页列表
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @param string $limit 条数
 * @return array
 */
function la_list($table, $where = "", $limit = 10, $order = "",$key='',$time=86400){
    $db = Illuminate\Support\Facades\DB::table($table);
    return $db->where($where)->limit($limit)->orderByRaw($order)->get();
}

/**
 * laravel取单条内容
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @return array|string
 */
function la_find($table, $where = "", $field = "", $order = "",$key='',$time=86400){
    $db = Illuminate\Support\Facades\DB::table($table);
    $F = $db->where($where)->orderByRaw($order)->first();
    if ($field) {
        return $F[$field];
    } else {
        return $F;
    }
}

/**
 * laravel缓存key
 * @param string $table 库名
 * @param string|array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @return array|string
 */
function la_key(...$data){
    $key = [];
    foreach ($data as $v){
        $key[] = (string)json_encode($v);
    }
    $key = join(',',$key);
    return 'la_'.md5($key);
}