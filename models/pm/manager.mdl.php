<?php
/**
 * Copy Right Anuike.com
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: alipay.mdl.php 3053 2014-01-15 02:00:13Z youyi $
 */

class Mdl_Pm_Manager extends Mdl_Table
{   
    protected $_table = 'pm_manager';
    protected $_pk = 'mg_id';
    protected $_cols = 'mg_id,name,phone,company,email,company_id,closed,dateline,lasttime';

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
