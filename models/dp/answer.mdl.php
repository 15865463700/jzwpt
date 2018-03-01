<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: answer.mdl.php 3053 2014-01-15 02:00:13Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Dp_Answer extends Mdl_Table
{   
  
    protected $_table = 'dp_answer';
    protected $_pk = 'answer_id';
    protected $_cols = 'answer_id,ask_id,uid,contents,dateline,clientip,audit,thumb_up,parent_id,cate_id';
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

    public function items_by_askIds($ask_ids=array()){
        $ask_id_str="-1";
        if(is_array($ask_ids)){
            $ask_id_str=implode(',',$ask_ids);
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE ask_id in ($ask_id_str)";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                array_push($items,$row);
//                $items[$row['uid']] = $this->_format_row($row);
            }
        }
        return $items;
    }


    public function counts_by_parentIds($ids=array(),$cate_id=1){
        $ids_str=implode(",",$ids);
        $where=" parent_id in ($ids_str) ";
        $where.=" and cate_id = {$cate_id} ";
        $sql="select parent_id as id,count(answer_id) as count from ".$this->table($this->_table)." WHERE $where group by parent_id";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $items[$row['id']]=$row['count'];
            }
        }
        return $items;
    }
//    public function counts_by_ids($ids=array(),$cate_id=1){
//        $ids_str=implode(",",$ids);
//        $where=" parent_id in ($ids_str) ";
//        $where.=" and cate_id = {$cate_id} ";
//        $sql="select target_id as id,count(target_id) as count from ".$this->table($this->_table)." WHERE $where group by target_id";
//        $items = array();
//        if($rs = $this->db->Execute($sql)){
//            while($row = $rs->fetch()){
//                $items[$row['id']]=$row['count'];
//            }
//        }
//        return $items;
//    }

//    public function detail($answer_id)
//    {
//        if(!$answer_id = intval($answer_id)){
//            return false;
//        }
//        $where = "answer_id='$answer_id'";
//        $sql = "SELECT * FROM ".$this->table($this->_table)."  WHERE $where LIMIT 1";
//        var_dump($sql);
//        if($detail = $this->db->GetRow($sql)){
////            $cate = K::M('article/cate')->cate($detail['cat_id']);
////            $detail['cat_title'] = $cate['title'];
//        }
//        //分页处理
////        $detail['content_list'] = explode($this->_page_sep, $detail['content']);
////        $detail['content_count'] = count($detail['content_list']);
//        return $detail;
//    }

}