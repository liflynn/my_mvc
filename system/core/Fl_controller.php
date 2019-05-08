<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/28
 * Time: 下午3:18
 */

class Fl_controller
{
    protected $db;
    protected $load;

    public function __construct()
    {
        global $db_config;
        $this->db = db_driver::connect($db_config);
        $this->load = new loader();
    }

}