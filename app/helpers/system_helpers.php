<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/28
 * Time: 下午2:36
 */

/**
 * @param $arr
 * @return array|bool
 */
function bubble_sort_asc($arr)
{
    if(!is_array($arr)) return false;
    if(count($arr)<=1)  return $arr;
    $length = count($arr);

    for($i=0;$i<$length-1;$i++){
        for($j=$i+1;$j<$length;$j++){
            if($arr[$i] > $arr[$j]){
                $tmp     = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }
    return $arr;
}

/**
 * host name
 */

function get_domain()
{
    $base_url = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) == 'https') ? 'https' : 'http';
    $http_host = strpos($_SERVER['HTTP_HOST'], '.') !== false ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return $base_url.'://'.$http_host;
}
/**
 * string or array
 * to debug content
 */
function ilog($info)
{
    $file = debug_backtrace()[0]['file'];
    $line_no = debug_backtrace()[0]['line'];
    $file_name = get_log_file();
    if(is_array($info)){
        $info = var_export($info,true);
    }
    $message = $info.PHP_EOL.$file.' At line  '.$line_no.PHP_EOL;
    file_put_contents($file_name,$message,FILE_APPEND);
}

function get_log_file()
{
    return 'debug/Log_'.date("Y-m-d").".php";
}

/**
 * @param $arr
 */

function dd($arr){
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
    die();
}
