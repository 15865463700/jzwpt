<?php
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Xw_Comment extends Mdl_Table
{   
  
    protected $_table = 'xw_comment';
    protected $_pk = 'comment_id';
    protected $_cols = 'comment_id,city_id,xw_id,uid,content,clientip,dateline,audit';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        $data['clientip'] = __IP;
        $data['dateline'] = __CFG::TIME;
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