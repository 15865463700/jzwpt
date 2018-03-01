<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Home_Complain extends Mdl_Table
{   
  
    protected $_table = 'home_site_complain';
    protected $_pk = 'complain_id';
    protected $_cols = 'complain_id,custom_id,type_id,company_id,content,reply,status,read,closed,lasttime,dateline';

    protected $_type   = array(1=>'投诉类型A',2=>'投诉类型C',3=>'投诉类型B',4=>'投诉类型D');
    protected $_status = array(0=>'未处理',1=>'已处理');

    public function type_list()
    {
        return $this->_type;
    }

    public function status_list()
    {
        return $this->_status;
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