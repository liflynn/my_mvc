<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/5/8
 * Time: 下午8:30
 */
class loader
{
    public function view($path,$data='')
    {
        if(!empty($data) && is_array($data)){
            foreach($data as $key=>$val){
                $$key = $val;
            }
        }
        $view = 'view/'.$path.'.php';
        if(!file_exists($view)){
            die($view.' not exists');
        }else{
            include $view;
        }
    }

    public function model($model)
    {
        $file  = 'model/'.$model.'.php';

        if(!file_exists($file)){
            die($file.' not exists');
        }else{
            include 'model/'.$model.'.php';
            $arr = explode('/',$model);
            $class = $arr[count($arr)-1];
            return new $class;
        }
    }

    public function library($library)
    {
        $file = 'library/'.$library.'.php';

        if(!file_exists($file)){
            die($file.' not exists');
        }else{
            include 'library/'.$library.'.php';
            $arr = explode('/',$library);
            $class = $arr[count($arr)-1];
            return new $class;
        }
    }
}