<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Price_Attr extends Mdl_Table
{   
  
    protected $_table = 'price_attr';
    protected $_pk = 'priceattr_id';
    protected $_cols = 'priceattr_id,title,pricefrom_id,order,zhucai,fucai,rengong,content,city_id,per';

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

	public function attr($priceattr_id)
    {
        if(!$priceattr_id = intval($priceattr_id)){
            return false;
        }
		$attrs = K::M('price/attr')->fetch_all();
        if($attrs = $this->fetch_all()){
            if($attr = $attrs[$priceattr_id]){
                if($from = K::M('price/attrfrom')->from($attr['pricefrom_id'])){
                    $attr['from_title'] = $from['title'];
                }
                return $attr;
            }
        }
        return false;
    }
}