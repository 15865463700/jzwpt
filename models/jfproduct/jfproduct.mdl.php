<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Jfproduct_Jfproduct extends Mdl_Table
{   
  
    protected $_table = 'jfproduct';
    protected $_pk = 'product_id';
    protected $_cols = 'product_id,name,cat_id,city_id,area_id,kucun,danwei,market_price,order_status,jfprice,photo,info,views,score,comments,buys,onsale,onpayment,sale_type,sale_time,sale_sku,sale_count,orderby,audit,closed,lastupdate,dateline';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        if(!$data['dateline']){
            $data['dateline'] = __CFG::TIME;
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