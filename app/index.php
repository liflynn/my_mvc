<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/28
 * Time: 上午8:54
 */
include ('config/database.php');
include ('../system/db/db_driver.php');
global $db_config;
$db_config = $db['default'];
include ('config/autoload.php');
if(isset($autoload) && !empty($autoload)){
    $helpers_path = 'helpers/';
    foreach($autoload as $file){
        if(file_exists($helpers_path.$file.'.php')){
            include $helpers_path.$file.'.php';
        }
    }
}
include('../system/config/autoload.php');
include('../system/url/url_segment.php');


//var_dump($db['default']);
