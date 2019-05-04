<?php
/**
 * Created by PhpStorm.
 * User: lflynnand
 * Date: 2019/5/4
 * Time: 下午8:02
 */
class contact extends Fl_controller
{
    function get_contact_list($options)
    {
        $where_clause = isset($options['where_clause'])?' AND givenName like "%'. $options['where_clause'].'%"':'';
        $start = $options['start'];
        $limit = $options['limit'];
        $sql = <<<sql
      select * from contact
      where 1
      $where_clause
      limit $start,$limit
sql;
        $res = $this->db->result_array($sql);
        $total = $this->get_contact_total($options);
        $rt = array(
            'code' =>0,
            'count'=>$total,
            'data' =>$res,
        );
        return $rt;

    }

    function get_contact_total($options)
    {
        $where_clause = isset($options['where_clause'])?' AND givenName like "%'. $options['where_clause'].'%"':'';
        $sql = <<<sql
      select count(*) as count from contact
      where 1
      $where_clause
sql;
        ilog($sql);
        $res = $this->db->row_array($sql);
        return $res['count'];
    }

}