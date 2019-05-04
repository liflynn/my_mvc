<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/28
 * Time: 下午3:18
 */

class Fl_controller
{
    public $db;

    public function __construct()
    {
        global $db_config;
        $this->db = db_driver::connect($db_config);
    }

    public function view($path,$data='')
    {
        if(!empty($data) && is_array($data)){
           foreach($data as $key=>$val){
               $$key = $val;
           }
        }
        include 'view/'.$path.'.php';
    }

    public function model($model)
    {
        include 'model/'.$model.'.php';
        return new $model;
    }

}