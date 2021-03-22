<?php

// +-------------------------------------------------------------------------
// | php常用函数库
// +-------------------------------------------------------------------------
// | Copyright (c) 2011~2019 http://blog.php127.com All rights reserved.
// +-------------------------------------------------------------------------
// | Author: 读心印 <xz615@139.com>
// +-------------------------------------------------------------------------


/**
 * 随机数组中某个值
 * @param array $array 数组
 * @param array $key key
 * @return array|string
 */
function get_rand_array($array, $key = '')
{
    $len = count($array);
    $data = $array[rand(0, $len - 1)];
    return $key ? $data[$key] : $data;
}


/**
 * 随机生成手机号
 * @return int
 */
function get_rand_phone()
{
    $prefix = [
        //移动段
        134, 135, 136, 137, 138, 139, 147, 148, 150, 151, 152, 157, 158, 159, 165, 172, 178, 182, 183, 184, 187, 188, 198,
        //联通段
        130, 131, 132, 145, 146, 155, 156, 166, 171, 175, 176, 185, 186,
        //电信段
        133, 149, 153, 173, 174, 177, 180, 181, 189, 191, 199,
    ];
    return $prefix[rand(0, count($prefix) - 1)] . rand(10000000, 99999999);
}


/**
 * 打印数组
 * @param array $data 数据
 * @param boolean $isExit 是否终止运行
 * @return string
 */
function pr($data, $isExit = false)
{
    echo '<pre>';
    $bt = debug_backtrace();
    $file = __FILE__;
    $line = "unkown";
    if (isset($bt[0]) && isset($bt[0]['file'])) {
        $file = $bt[0]['file'];
        $line = $bt[0]['line'];
    }
    echo $fl = '[' . $file . ':' . $line . "]\r\n";
    print_r($data);
    if ($isExit) {
        exit("\r\tExit");
    }
}




/**
 * 自定义通用状态助手
 * @param int $state 状态
 * @param array $array 自定义数组
 * @return string
 */
function get_state($state, $array = ['禁用', '正常'])
{
    return $array[$state];
    //使用示例
    //比如有一个用户,我把他封号了
    //$state = 0; //1正常 0 为封号
    //html
    //{$state|get_state} //不传值默认输出 禁用
    //{$state|get_state=['封号','正常']} //自定义输出 封号
    //例子2
    //比如我的用户等级
    //$type = 2; //0为普通会员 1为vip1 2为vip2 3为vip3 等等...
    //html
    //{$type|get_state=['普通会员','vip1','vip2','vip3']} //输出 vip2
    //例子3
    //问题来了,那么我的不是从0,1,2,3开始定义的怎么办
    //$type = -5; //-5为普通会员 11为vip1 22为vip2 33为vip3 等等...
    //html
    //{$type|get_state=[-5=>'普通会员',11=>'vip1',22=>'vip2',33=>'vip3']} //输出 普通会员
    //足以满足大部分要求
}



/**
 * 版本生成器
 * @param boolean $del 是否删除版本
 * @param array $array 自定义路径
 * @return string|boolean
 */
function get_version($del = false, $filename = './version.txt')
{
    if ($del) {
        return unlink($filename);
    }
    if (file_exists($filename)) {
        return file_get_contents($filename);
    } else {
        $v = date("YmdHis");
        file_put_contents($filename, $v);
        return $v;
    }
}


/**
 * 文件信息
 * @param string $filename 文件路径
 * @return array
 */
function get_fileinfo($filename)
{
    $data['type'] = filetype($filename); //文件类型
    $data['size'] = filesize($filename); //文件大小
    $data['atime'] = date("Y-m-d H:i:s", fileatime($filename)); //最近访问时间
    $data['mtime'] = date("Y-m-d H:i:s", filemtime($filename)); //最近修改时间
    $data['is_executable'] = (is_executable($filename) ? true : false); //是否为可执行文件
    $data['is_link'] = (is_link($filename) ? true : false); //是否为链接(Link)
    $data['is_readable'] = (is_readable($filename) ? true : false); //是否可读
    $data['is_writable'] = (is_writable($filename) ? true : false); //是否可写
    $data['realpath'] = realpath($filename); //文件绝对路径
    clearstatcache();
    return $data;
}

/**
 * 常见过滤广告
 * @param string $str 内容
 * @return string
 */
function get_safestr($str)
{
    $arr = array(
        '/承接/',
        '/刷钻/',
        '/业务/',
        "/qq/i",
        '/(\d+)/',
        '/^[a-z]([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/',
        '/出售/i',
        '/.com/i',
        '/.net/i',
        '/.cn/i',
        '/.cc/i',
        '/www./i',
        '/http\:\/\//i',
        '/网址/i',
    );
    return preg_replace($arr, "", $str);
}

/**
 * 中英文字符串长度
 * @param string $str 内容
 * @param string $charset 编码
 * @return int
 */
function get_length($str, $charset = 'utf-8')
{
    if ($charset == 'utf-8') {
        $str = iconv('utf-8', 'gb2312', $str);
    }
    $num = strlen($str);
    $cnNum = 0;
    for ($i = 0; $i < $num; $i++) {
        if (ord(substr($str, $i + 1, 1)) > 127) {
            $cnNum++;
            $i++;
        }
    }
    $enNum = $num - ($cnNum * 2);
    $number = ($enNum / 2) + $cnNum;
    return ceil($number);
}



/**
 * 时间之前
 * @param string $time 时间戳
 * @param string $format 超过30天显示格式
 * @return string
 */
function get_qtime($time, $format = "Y-m-d")
{
    //计算天数
    $timediff = time() - $time;
    $days = intval($timediff / 86400);
    if ($days > 30) {
        return date($format, $time);
    }
    if ($days != 0) {
        return $days . "天前";
    }
    //计算小时数
    $remain = $timediff % 86400;
    $hours = intval($remain / 3600);
    if ($hours != 0) {
        return $hours . "小时前";
    }
    //计算分钟数
    $remain = $remain % 3600;
    $mins = intval($remain / 60);
    if ($mins != 0) {
        return $mins . "分钟前";
    }
    //计算秒数
    $secs = $remain % 60;

    return $secs . "秒前";
}

/**
 * 字节大小转换
 * @param int $size 字节
 * @return string
 */
function get_sizes($size)
{
    $f = "";
    $prec = 3;
    if ($size < 0) {
        $f = "-";
    }
    $size = round(abs($size));
    $units = array(0 => "B", 1 => "KB", 2 => "MB", 3 => "GB", 4 => "TB");
    if ($size == 0) {
        return str_repeat(" ", $prec) . "0$units[0]";
    }
    $unit = min(4, floor(log($size) / log(2) / 10));
    $size = $size * pow(2, -10 * $unit);
    $digi = $prec - 1 - floor(log($size) / log(10));
    $size = round($size * pow(10, $digi)) * pow(10, -$digi);
    return $f . $size . $units[$unit];
}

/**
 * 中文字符截取
 * @param string $str 内容
 * @param int $length 长度
 * @param string $charset 编码
 * @param int $suffix 是否显示...
 * @return string
 */
function get_msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
{
    if (function_exists("mb_substr")) {
        return mb_substr($str, $start, $length, $charset);
    } elseif (function_exists('iconv_substr')) {
        return iconv_substr($str, $start, $length, $charset);
    }
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    if ($suffix) {
        return $slice . "…";
    }
    return $slice;
}

/**
 * 生成随机字符
 * @param int $length 长度
 * @param int $type 组合方式 a所有 d数字 x小写字母 s大小字母
 * @return string
 */
function get_randstr($length = 8, $type = 'a')
{
    $chars = '';
    if (strpos($type, 'a') !== false) {
        $chars .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    } else {
        if (strpos($type, 'd') !== false) {
            $chars .= '0123456789';
        }
        if (strpos($type, 'x') !== false) {
            $chars .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if (strpos($type, 's') !== false) {
            $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
    }

    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $code;
}
