<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author @kzx<Autumnkorda@gmail.com>
 * $Id: address.mdl.php 2034 2015-08-07 16:08:33Z $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_order_Address extends Mdl_Table
{   
    
    protected $_table = 'member_address';
    protected $_pk = 'addr_id';
    protected $_cols = 'addr_id,uid,title,phone,addr,contact,default';
    protected $_orderby = array('addr_id'=>'ASC');
    
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
    
    public function set_default($uid, $data, $checked=false)
    {
        return $this->db->update($this->_table, $data, $this->field('uid', $uid));
    }
}