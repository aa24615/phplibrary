<?php

// +-------------------------------------------------------------------------
// | php常用函数库
// +-------------------------------------------------------------------------
// | Copyright (c) 20011~2019 http://blog.php127.com All rights reserved.
// +-------------------------------------------------------------------------
// | Author: 读心印 <xz615@139.com>
// +-------------------------------------------------------------------------

/**
 * 打印数组
 * @param array $data 数据
 * @param boolean $isExit 是否终止运行
 * @return string
 */
function pr($data,$isExit=false){
    echo '<pre>';
    $bt = debug_backtrace();
    $file = __FILE__;
    $line = "unkown";
    if (isset($bt[0]) && isset($bt[0]['file'])) {
        $file = $bt[0]['file'];
        $line = $bt[0]['line'];
    }
    echo $fl=  '['.$file.':'.$line."]\r\n";
    print_r($data);
    if ($isExit){
        exit("\r\tExit");
    }
}



//生成目录树
function mkdirs($dir){
    $arr = explode('/',$dir);
    $p = '';
    foreach ($arr as $v){
        $v = trim($v);
        if($v){
            $p .=$v."/";
            if (!file_exists($p)){
                mkdir ($p,0777,true);
            }
        }
    }
    return true;
}



/**
 * 遍历文件
 * @param string $dir 路径
 * @param string|array $suffixs 指定后缀名
 * @return array
 */
function get_dirs($dir="",$suffixs=[]){
    if(is_dir($dir)){
        if($dh = opendir($dir)){
            $list = [];
            while (($file = readdir($dh)) !== false){
                if($file!="." && $file!=".."){
                    list($name,$ext)=explode(".",$file);//获取扩展名
                    $filename = $dir.'/'.$file;
                    $is=false;
                    if(is_dir($filename)){
                        $list = array_merge($list,get_dirs($filename,$suffixs));
                    }else{
                        if($suffixs){
                            if(is_array($suffixs)){
                                if(in_array($ext,$suffixs)){
                                    $is = true;
                                }
                            }else{
                                if($ext==$suffixs){
                                    $is = true;
                                }
                            }
                        }else{
                            $is = true;
                        }
                    }
                    if($is){
                        $size = filesize($filename);
                        $list[] = [
                            'filename' => $filename,
                            'name' => $name,
                            'ext' => $ext,
                            'dir' => $dir,
                            'size'=> $size
                        ];
                    }
                }
            }
            closedir($dh);
            return $list;
        }else{
            return "目录不存在: {$dir}";
        }
    }else{
        return "目录不存在: {$dir}";
    }
}



/**
 * 自定义通用状态助手
 * @access public
 * @param int $state 状态
 * @param array  $array 自定义数组
 * @return string
 */
function get_state($state,$array=['禁用','正常']) {
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



//判断是否蜘蛛
function is_spider(){
    $robots = array("baiduspider","googlebot","sosospider","360spider","slurp","yodaobot","sogou","msnbot","bingbot");
    $agent = strtolower($_SERVER["HTTP_USER_AGENT"]);
    $is = 0;
    foreach($robots as $val){
        if(strpos($agent,$val)!==false){
            $is++;
        }
    }
    if($is>0){
        return true;
    }
    return false;
}
