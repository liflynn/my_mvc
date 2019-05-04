<?php

/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/26
 * Time: 下午2:00
 */
class db_driver
{
    public static $instance;
    public static $link;

    private function __construct()
    {
        //防止被初始化
    }

    private function __clone()
    {
        //防止被克隆
    }

    static function connect($config)
    {
        $hostname = $config['hostname'];
        $username = $config['username'];
        $password = $config['password'];
        $database = $config['database'];
        $port     = $config['port'];
        if (!isset(self::$instance)) {

            $class = __CLASS__;
            self::$instance = new $class;
            $link = mysqli_connect($hostname,$username,$password,$database,$port);
            mysqli_set_charset($link,'utf8');
            self::$link = $link;
        }

        return self::$instance;
    }

    public function close($query)
    {
        //施放结果集
        mysqli_free_result($query);
        //关闭连接
        mysqli_close(self::$link);
    }

    public function query($sql)
    {
        $link = self::$link;
        $query =  mysqli_query($link,$sql);
        return $query;
    }

    /**
     * @return array 返回二维数组
     */
    public function result_array($sql)
    {
        $query = $this->query($sql);
        $arr = array();
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
            array_push($arr,$row);
        }
        return $arr;
    }

    /**
     * @return array|null 返回一维数组
     */
    public function row_array($sql)
    {
        $query = $this->query($sql);
        $res = mysqli_fetch_array($query,MYSQLI_ASSOC);
        return $res;
    }

}