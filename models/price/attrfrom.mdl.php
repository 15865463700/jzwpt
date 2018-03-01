<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Price_Attrfrom extends Mdl_Table
{   
  
    protected $_table = 'price_attr_from';
    protected $_pk = 'pricefrom_id';
    protected $_cols = 'pricefrom_id,pricefrom,title,city_id';
	protected $_pre_cache_key = 'price-attr-list';

    
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

	public function from($pricefrom_id)
    {
        if($pricefrom_id = (int)$pricefrom_id){
            if($from_list = $this->fetch_all()){
                if($from = $from_list[$pricefrom_id]){
                    return $from;
                }
            }
        }
        return false;        
    }
}