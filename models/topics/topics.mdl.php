<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Topics_Topics extends Mdl_Table
{   
  
    protected $_table = 'topics';
    protected $_pk = 'topics_id';
    protected $_cols = 'topics_id,uid,name,card,education,marriage,city_id,area_id,addr,work,c_addr,c_mobile,position,home_person,home_relationship,home_phone,orter_person,orter_relationship,orter_phone,photo1,photo2,photo3,bank,bank_card,mobile,audit,remark,dateline,money,zq';

	protected $education_list = array(1=>array('title'=>'博士及以上'),2=>array('title'=>'硕士'),3=>array('title'=>'本科'),4=>array('title'=>'大专'),5=>array('title'=>'高中/中专'),6=>array('title'=>'初中及以下'));

	protected $marriage_list = array(1=>array('title'=>'未婚'),2=>array('title'=>'已婚'),3=>array('title'=>'离异'),4=>array('title'=>'丧偶'));

	protected $home_relationship_list = array(1=>array('title'=>'配偶'),2=>array('title'=>'父亲'),3=>array('title'=>'母亲'));

	protected $other_relationship_list = array(1=>array('title'=>'同事'),2=>array('title'=>'同学'),3=>array('title'=>'朋友'),4=>array('title'=>'其他'));

	protected $bank_list = array(1=>array('title'=>'招商银行'),2=>array('title'=>'中国农业银行'),3=>array('title'=>'北京银行'),4=>array('title'=>'交通银行'),5=>array('title'=>'重庆银行'),6=>array('title'=>'中国银行'),7=>array('title'=>'中国建设银行'),8=>array('title'=>'中国光大银行'),9=>array('title'=>'南充市商业银行'),10=>array('title'=>'中信银行'),11=>array('title'=>'广东发展银行'),12=>array('title'=>'上海浦东发展银行'));

	protected $zq_list = array(3=>array('title'=>'3期（3个月）'),6=>array('title'=>'6期（6个月）'),12=>array('title'=>'12期（1年）'),18=>array('title'=>'18期（1年半）'),24=>array('title'=>'24期（2年）'),36=>array('title'=>'36期（3年）'),48=>array('title'=>'48期（4年）'),60=>array('title'=>'60期（5年）'));


	public function get_education(){
        
        return $this->education_list;
    }

	public function get_marriage(){
        
        return $this->marriage_list;
    }

	public function get_home_relationship(){
        
        return $this->home_relationship_list;
    }

	public function get_other_relationship(){
        
        return $this->other_relationship_list;
    }

	public function get_bank(){
        
        return $this->bank_list;
    }

	public function get_zq(){
        
        return $this->zq_list;
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
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }
}