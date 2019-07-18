<?php
namespace php127\laravel;
// +-------------------------------------------------------------------------
// | laravel常用函数库
// +-------------------------------------------------------------------------
// | Copyright (c) 2011~2019 http://blog.php127.com All rights reserved.
// +-------------------------------------------------------------------------
// | Author: 读心印 <xz615@139.com>
// +-------------------------------------------------------------------------

function la_test(){
    echo 'hello laravel';
}



/**
 * laravel统计
 * @param string $table 库名
 * @param array $where 条件
 * @param string $field 字段(传入则统计字段总和)
 * @param string $key 缓存名称(不传自动生成)
 * @param int $time 缓存时间(默认86400秒)
 * @return int
 */
function la_count($table, $where = [], $field = "",$key='',$time=86400){

    $key = $key ? : 'la_count'.la_key($table, $where , $field);
    $data = \Illuminate\Support\Facades\Cache::remember($key,$time,function () use($table, $where, $field){

        $db = \Illuminate\Support\Facades\DB::table($table);
        if ($field) {
            $data = $db->where($where)->sum($field);
        } else {
            $data = $db->where($where)->count();
        }
        return $data;
    });
    return $data ? $data : 0;
}
/**
 * laravel取单页列表
 * @param string $table 库名
 * @param array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @param string $limit 条数
 * @param string $key 缓存名称(不传自动生成)
 * @param int $time 缓存时间(默认86400秒)
 * @return array
 */
function la_list($table, $where = [], $limit = 10,$field='*',$order = '',$key='',$time=86400){
    $key = $key ? : 'la_list'.la_key($table,$where,$limit,$field,$order);
    $data = \Illuminate\Support\Facades\Cache::remember($key,$time, function () use ($table,$where,$limit,$order,$field){
        $db = \Illuminate\Support\Facades\DB::table($table);
        if($order){
            return $db->where($where)->limit($limit)->select($field)->orderByRaw($order)->get();
        }else{
            return $db->where($where)->limit($limit)->select($field)->get();
        }

    });
    return $data;
}

/**
 * laravel取单条内容
 * @param string $table 库名
 * @param array $where 条件
 * @param string $order 排序
 * @param string $field 字段
 * @param string $key 缓存名称(不传自动生成)
 * @param int $time 缓存时间(默认86400秒)
 * @return array|string
 */
function la_find($table, $where = [], $field = "", $order = "",$key='',$time=86400){

    $key = $key ? : 'la_find'.la_key($table,$where,$field,$order);

    $data = \Illuminate\Support\Facades\Cache::remember($key,$time, function () use ($table,$where,$order,$field) {

        $db = \Illuminate\Support\Facades\DB::table($table);
        if($order){
            return $db->where($where)->orderByRaw($order)->first();
        }else{
            return $db->where($where)->first();
        }
    });
    if ($field) {
        return $data[$field];
    } else {
        return $data;
    }
}

/**
 * laravel生成缓存key
 * @param string|array $data 参数可多个
 * @return string
 */
function la_key(...$data){
    $key = [];
    foreach ($data as $v){
        $key[] = (string)json_encode($v);
    }
    $key = join(',',$key);
    return 'la_'.md5($key);
}