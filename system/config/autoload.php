<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/28
 * Time: 上午9:52
 */
define('SYS_DB_PATH','../system/db/');
define('SYS_CORE_PATH','../system/core/');
function __autoload($classname)
{
    $class_path = SYS_DB_PATH.$classname.'.php';
    if(file_exists($class_path)){
        include ($class_path);
    }else{
        exit('Class '.$classname.' not exists');
    }
}

function my_autoload($classname)
{
    $class_path = SYS_CORE_PATH.$classname.'.php';
    if(file_exists($class_path)){
        include ($class_path);
    }else{
        exit('Class '.$classname.' not exists');
    }
}

spl_autoload_register('my_autoload');