<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Home_Service extends Mdl_Table
{   
  
    protected $_table = 'home_site_service';
    protected $_pk = 'service_id';
    protected $_cols = 'service_id,company_id,custom_id,type_id,reply,content,status,read,colsed,lasttime,dateline';

    protected $_type   = array(1=>'水电',2=>'管道',3=>'土木',4=>'煤气');
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