<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: diary.mdl.php 5531 2014-06-19 10:26:25Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Company_Designer extends Mdl_Table
{   
  
    protected $_table = 'company_designer';
    protected $_pk = 'designer_id';
    protected $_cols = 'school,phone,qq,jingyan,leixing,zhiwei,team,designer_id,idea,resume,company_id,title,home_id,home_name,city_id,thumb,company_id,type_id,way_id,total_price,start_date,end_date,content_num,views,comments,status,clientip,dateline,audit,closed,meter';
    
    protected $_orderby = array('designer_id'=>'DESC');

    public function jingyan()
    {
        return array(
            1=>"0-1年",
            2=>"1-3年",
            3=>"3-5年",
            4=>"5-8年",
            5=>"8年以上",
        );
    }

    public function leixing()
    {
        return array(
            1=>"家装",
            2=>"公装",
            3=>"别墅",
        );
    }

    public function zhiwei()
    {
        return array(
            1=>"优秀设计师",
            2=>"资深设计师",
            3=>"主任设计师",
            4=>"首席设计师",
        );
    }
    public function create($data, $checked=false)
    {	
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        //var_dump($data);die;
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    protected function _format_row($row)
    {
        static $status_list = null;
        static $setting = null;
        static $type_list = null;
        if($status_list === null){
            $status_list = K::M('home/site')->get_status();
            $setting = K::M('tenders/setting')->fetch_all();
        }
        $row['type_title'] = $setting[$row['type_id']]['name'];
        $row['way_title'] = $setting[$row['way_id']]['name'];
        $row['status_title'] = $status_list[$row['status']];
        if($city_id = $row['city_id']){
            if($city = K::M('data/city')->city($city_id)){
                $row['city_name'] = $city['city_name'];
            }
        }
        return $row;        
    }

    public function items($filter=array(), $orderby=null, $p=1, $l=50, &$count=0){
        $where = $this->where($filter);
        $orderby = $this->order($orderby);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where $orderby $limit";
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
            }
        }
        return $items;
    }

    public function delete($designer_id, $force=false){
        $sql = "DELETE FROM ".$this->table($this->_table)." WHERE " . self::field($this->_pk, $designer_id);
        $ret = $this->db->Execute($sql);
        return $ret;
    }

    public function detail($designer_id, $closed=false)
    {
        if(!$designer_id = intval($designer_id)){
            return false;
        }
        $where = "designer_id='$designer_id'";
        $sql = "SELECT * FROM {$this->table($this->_table)} WHERE $where LIMIT 1";
        $detail = $this->db->GetRow($sql);
        return $detail;
    }

}