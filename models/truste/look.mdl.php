<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: look.mdl.php 5402 2014-06-03 10:17:57Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Truste_Look extends Mdl_Table
{   
  
    protected $_table = 'truste_look';
    protected $_pk = 'look_id';
    protected $_cols = 'look_id,truste_id,uid,content,clientip,dateline,is_signed,city_id,from,company_id,info';
    protected $_orderby = array('look_id'=>'DESC');
    
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
   
    public function items_by_truste($truste_id, $p=1, $l=200, &$count=0)
    {
        if(!$truste_id = (int)$truste_id){
            return false;
        }
        return $this->items(array('truste_id'=>$truste_id), null, $p, $l, $count);
    }

    public function is_looked($uid, $truste_id)
    {
        if(!$truste_id = (int)$truste_id){
            return false;
        }else if(!$uid = (int)$uid){
            return false;
        }
        return $this->count("truste_id='{$truste_id}' AND uid='{$uid}'");
    }

    public function sign($look_id)
    {
        if($look = $this->detail($look_id)){
            $this->db->Execute("UPDATE ". $this->table($this->_table)." SET is_signed=0 WHERE truste_id=".$look['truste_id']);
            if($this->update($look_id, array('is_signed'=>1))){
                return K::M('truste/truste')->sign($look['truste_id'], $look['uid']);
            }
        }
        return false;
    }

	public function getdata($uid)
	{
		
        if(!$uid = (int)$uid){
            return false;
        }else if(!$member = K::M('member/member')->member($uid)){
            return false;
        }
        $info = array();
        if('gz' == $member['from']){
            if($gz = K::M('gz/gz')->detail($uid)){
                $data['city_id'] = $gz['city_id'];
                $data['from'] = 'gz';
				$info['name'] = $gz['name'];
                $info['gz_id'] = $gz['uid'];
            }
        }
		$data['info'] = serialize($info);
		return $data;
   
	}
}