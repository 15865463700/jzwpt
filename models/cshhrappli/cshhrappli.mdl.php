<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Cshhrappli_Cshhrappli extends Mdl_Table
{   
  
    protected $_table = 'cshhr_appli';
    protected $_pk = 'appli_id';
    protected $_cols = 'appli_id,contact,mobile,weixin,place,add_time';
    protected $_orderby = array('appli_id'=>'DESC');

    public function create($data, $checked=false)
        {
         if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        $data["add_time"]=time();
        return $this->db->insert($this->_table, $data, true);
        }
}
