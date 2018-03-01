<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Member_Packet extends Mdl_Table
{   
  
    protected $_table = 'member_packet';
    protected $_pk = 'id';
    protected $_cols = 'id,title,uid,type,cate_id,shop_id,price,man,time,last_time,code,ltime,is_use,desc,dateline';

    
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

	public function create_code()
    {
		$length = '12';
		$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
		'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
		't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
		'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',
		'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		$keys = array_rand($chars,$length);
		$password = '';
		
		do {
			$password = '';
			for($i = 0; $i < $length; $i++)
			{
				$password .= $chars[$keys[$i]];
			}
		 $code = $this->db->GetRow("SELECT code FROM ".$this->table($this->_table)." WHERE code='{$password}'");
        } while ($code);
		return $password;
    }


	
}