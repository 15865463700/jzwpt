
<?php
class Mdl_Xw_Like extends Mdl_Table
{   
    
    protected $_table = 'xw_like';
    protected $_pk = 'like_id';
    protected $_cols = 'like_id,xw_id,uid,create_ip,dateline';
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }
    
    public function is_like($xw_id,$create_ip){
        
        $xw_id = (int) $xw_id;
        $create_ip = $this->_quote($create_ip);
        
        return $this->count(" xw_id={$xw_id} AND create_ip={$create_ip} ");
    }
    
}