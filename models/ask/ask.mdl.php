<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: ask.mdl.php 5649 2014-06-25 11:13:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Ask_Ask extends Mdl_Table
{   
  
    protected $_table = 'ask';
    protected $_pk = 'ask_id';
    protected $_cols = 'ask_id,title,seo_title,seo_keyword,thumb,seo_description,cat_id,uid,intro,dateline,clientip,views,answer_num,audit,answer_id,orderby,prop';
    protected $_orderby = array('ask_id'=>'desc');
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        $data['orderby'] = isset($data['orderby']) ? $data['orderby'] : 50;
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
   
    public function items_count_by_ids()
    {
        $sql = "SELECT count(1) as num,cat_id FROM ".$this->table($this->_table)." group by cat_id";
        $items = array();   
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                if($row['cat_id']){
                    $items[$row['cat_id']] = $row['num'];
                }
            }
        }
        return $items;
    }

    public function ask_answer_num($arr=array()){
        $ask_ids="0";
        foreach($arr as $k=>$v){
            $ask_ids.=",".$v['ask_id'];
        }
        $sql="select ask_id,count(answer_id) answer_num from "
            .$this->table("ask_answer")
            ." where audit>0 and ask_id in ({$ask_ids}) group by ask_id";
        $items=array();
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                if($row["ask_id"]){
                    $items[$row["ask_id"]]["answer_num"]=$row["answer_num"];
                }
            }
            foreach($arr as $k=>$v){
                $arr[$k]['answer_num']=$items[$v['ask_id']]['answer_num'];
            }
        }
        return $arr;
    }
	
	public function props($props,$page,$city_id=0,$order){
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
        $where = " 1=1 ";
		if(!is_array($props)){
			$props=explode(',',$props);
		}
		foreach($props as $k=>$v){
			$where.=" and prop like '%{$v}%'";
		}/*
        if($city_id){
            $where .= " AND city_id='{$city_id}'";
        }*/
        if($cat_id){
            $where.=" and cat_id in ({$cat_id})";
        }
        if($order){
            $where.=" order by {$order} ";
        }
        if($page){
            $where.=" limit 0,{$page} ";
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where ";
        $result=array();
        if($rs = $this->db->Execute($sql)) {
            while ($row = $rs->fetch()) {
                array_push($result, $row);
            }
        }
        return $result;
    }
		
    
}