<?php

class Mdl_Feedback_Feedback extends Mdl_Table
{
    protected $_table = 'feedback';
    protected $_pk = 'feedback_id';
    protected $_cols = 'feedback_id,status,feedback,phone,ip,dateline';


    public function create($data)
    {
        // if(!$checked && !$data = $this->_check_schema($data)){
        //     return false;
        // }else if(!defined('IN_ADMIN')){
        //     if(!$this->check_tender_count()){
        //         return false;
        //     }
        // }
        $data['ip'] = $data['ip'] ? $data['ip'] : __IP;
        $data['dateline'] = $data['dateline'] ? $data['dateline'] : __CFG::TIME;
        return $this->db->insert($this->_table, $data);
    }
      public function items($filter=array(), $orderby=null, $p=1, $l=20, &$count=0){
        $where = $this->where($filter);
        $orderby = $this->order($orderby, null);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where $orderby order by feedback_id desc  $limit" ;
        if($rs = $this->db->query($sql)){
           $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
//                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
//                $company_ids.=",".$row["company_id"];
            }
        }
        return $items;

       }
    public function detail($feedback_id, $closed=false)
    {
        if(!$feedback_id = (int)$feedback_id){
            return false;
        }
        $where = $feedback_id;
        $sql = $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE feedback_id='$where'" ;
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }
    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

}
