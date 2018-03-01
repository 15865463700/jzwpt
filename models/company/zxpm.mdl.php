<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Company_Zxpm extends Mdl_Table
{   
  
    protected $_table = 'company_zxpm';
    protected $_pk = 'zxpm_id';
    protected $_cols = 'zxpm_id,company_id,name,mail,mobile,wx_openid,wx_info,dateline';

    
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

    public function detail_by_openid($openid)
    {
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE wx_openid='{$openid}'";
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }
}