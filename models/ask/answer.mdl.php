<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: answer.mdl.php 3053 2014-01-15 02:00:13Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Ask_Answer extends Mdl_Table
{   
  
    protected $_table = 'ask_answer';
    protected $_pk = 'answer_id';
    protected $_cols = 'answer_id,ask_id,uid,contents,dateline,clientip,audit';
    protected $_orderby = array('answer_id'=>'desc');
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }
    public function items1($ask_id){
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE ask_id in ($ask_id)";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $items[$row['uid']] = $this->_format_row($row);
            }
        }
        return $items;
    }
    public function counts_by_askIds($ids=array())
    {
        $ids_str = implode(",", $ids);
        $where = " ask_id in ($ids_str) ";
        $where = " and parent_id = 0 ";
        $sql = "select ask_id as id,count(answer_id) as count from " . $this->table($this->_table) . " WHERE $where group by ask_id";
        $items = array();
        if ($rs = $this->db->Execute($sql)) {
            while ($row = $rs->fetch()) {
                $items[$row['id']] = $row['count'];
            }
        }
        return $items;
    }
    public function counts_by_answerIds($ids=array()){
        $ids_str=implode(",",$ids);
        $where=" parent_id in ($ids_str) ";
        $sql="select parent_id as id,count(answer_id) as count from ".$this->table($this->_table)." WHERE $where group by parent_id";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $items[$row['id']]=$row['count'];
            }
        }
        return $items;
    }
}
