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
        $this->load->view('test');
        $this->load->view('test1');
    }

    public function testApi()
    {
        $curl = $this->load->library('curl');
        $data['url'] = 'http://flynn.test.com/study/api';
        $data['data'] = json_encode(
            array(
                'test'=>123
            )
        );
        $res = $curl->post($data);
    }

    public function api()
    {
        $res = file_get_contents('php://input');
        $res = json_decode($res,true);
        ilog($res);
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
        $contact_model = $this->load->model('contact');
        $res = $contact_model->get_contact_list($options);
        echo json_encode($res);
    }

}