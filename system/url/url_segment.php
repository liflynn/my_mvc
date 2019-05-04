<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/28
 * Time: 上午9:12
 */
define('APP','controllers/');

$uri = $_SERVER['REQUEST_URI'];
$uri = ltrim($uri,'/');
$uri_seg = explode('/',$uri);

if(count($uri_seg) < 2){
    exit('This page can not found !');
}

$controller = $uri_seg[0];
$method     = explode("?",$uri_seg[1])[0];

$class_path = APP.$controller.".php";

/**
 * file_exists
 */
if(file_exists($class_path)){
    include($class_path);
}else{
    exit("Class not found !");
}

/**
 * class_exists
 */
if(!class_exists($controller)){
    exit('Class not found !');
}else{
    $obj = new $controller;
}

/**
 * method exists
 */
if(!method_exists($controller,$method)){
    exit('Method not found !');
}else{
    $obj->$method();
}