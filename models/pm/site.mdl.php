<?php
/**
 * Copy Right Anuike.com
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: alipay.mdl.php 3053 2014-01-15 02:00:13Z youyi $
 */

class Mdl_Pm_Site extends Mdl_Table
{   
    protected $_table = 'pm_site';
    protected $_pk = 'site_id';
    protected $_cols = 'site_id,title,city_id,area_id,addr,home_name,house_mj,type_id,company,custom,custom_id,company_id,zxpm_id,price,starttime,endtime,status,closed,dateline';

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

     protected function _format_row($row)
    {
        if($city_id = $row['city_id']){
            if($city = K::M('data/city')->city($city_id)){
                $row['city_name'] = $city['city_name'];
            }
        }
        return $row;
    }
}