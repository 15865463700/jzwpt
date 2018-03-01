<?php

class Mdl_Wd_Wd extends Mdl_Table
{
    protected $_table = 'wd';
    protected $_pk = 'wd_id';
    protected $_cols = 'wd_id,ask,answer,status,ip,dateline';

    public function create($data){
        $data['ip'] = $data['ip'] ? $data['ip'] : __IP;
        $data['dateline'] = $data['dateline'] ? $data['dateline'] : __CFG::TIME;
        return $this->db->insert($this->_table, $data);
    }

      public function items($filter=array(), $orderby=null, $p=1, $l=20, &$count=0){
        $where = $this->where($filter);
        $orderby = $this->order($orderby, null);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where $orderby $limit" ;
        if($rs = $this->db->query($sql)){
           $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
//                $company_ids.=",".$row["company_id"];
            }
        }
        return $items;

       }
    public function detail($wd_id, $closed=false)
    {
        if(!$wd_id = (int)$wd_id){
            return false;
        }
        $where = $wd_id;
        $sql = $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE wd_id='$where'" ;
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
