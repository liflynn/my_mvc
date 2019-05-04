<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/4/28
 * Time: 上午9:43
 */
Class study extends Fl_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $this->view('test');
    }

    public function table_data()
    {
        if(isset($_GET['keywords'])){
            $options['where_clause'] = addslashes($_GET['keywords']);
        }
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $start = ($page-1)*$limit;
        $options['start'] = $start;
        $options['limit']  = $limit;
        $contact_model = $this->model('contact');
        $res = $contact_model->get_contact_list($options);
        echo json_encode($res);
    }

}