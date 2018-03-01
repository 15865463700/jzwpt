<?php

class Mdl_Dp_Log extends Mdl_Table
{   
  
    protected $_table = 'dp_log';
    protected $_pk = 'log_id';
    protected $_cols = 'log_id,cate_id,target_id,uid,dateline,clientip';
    protected $_orderby = array('log_id'=>'desc');
    
    public function create($data, $checked=false)
    {
//        if(!$checked && !$data = $this->_check_schema($data)){
//            return false;
//        }
        $data['clientip']=__IP;
        return $this->db->insert($this->_table, $data, true);
    }

    public function counts_by_ids($ids=array(),$cate_id=1){
        $ids_str=implode(",",$ids);
        $where=" target_id in ($ids_str) ";
        $where.=" and cate_id = {$cate_id} ";
        $sql="select target_id as id,count(target_id) as count from ".$this->table($this->_table)." WHERE $where group by target_id";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $items[$row['id']]=$row['count'];

            }
        }
//        var_dump($sql);

        return $items;
    }

    public function exists($uid,$cate_id,$target_id,$time){
        $end_time=__CFG::TIME-$time;
        $where="uid='$uid'";
        $where.=" and cate_id='$cate_id'";
        $where.=" and target_id='$target_id'";
        $where.=" and target_id='$target_id'";
        $where.=" and dateline>$end_time";
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where ";
        $count=0;
        if($rs = $this->db->Execute($sql)) {
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
        }
        return $count>0;
    }

    public function remove($uid,$cate_id,$target_id,$time){
        $end_time=__CFG::TIME-$time;
        $where="uid='$uid'";
        $where.=" and cate_id='$cate_id'";
        $where.=" and target_id='$target_id'";
        $where.=" and target_id='$target_id'";
        $where.=" and dateline>$end_time";
        $sql = "DELETE FROM ".$this->table($this->_table)." WHERE $where ";
        $count=0;
        if($rs = $this->db->Execute($sql)) {
            return true;
        }else{
            return false;
        }
    }

}
