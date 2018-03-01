<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: attr.mdl.php 2216 2013-12-16 06:39:13Z $
 */

class Mdl_Xw_Attr extends Mdl_Table
{   
  
    protected $_table = 'xw_attr';
    protected $_pk = 'xw_id,attr_id,attr_value_id';
    protected $_cols = 'xw_id,attr_id,attr_value_id';
   
    public function update($xw_id, $data, $checked=false)
    {
        if(!$checked && !$xw_id = intval($xw_id)){
            return false;
        }
        $sql = array();
        foreach((array)$data as $k=>$v){
            if(is_numeric($k)){
                foreach((array)$v as $kk=>$vv){
                    if(is_numeric($vv)){
                        $sql[] = "('{$xw_id}', '{$k}', '{$vv}')";
                    }
                }
            }
        }
        $this->db->Execute("DELETE FROM ".$this->table($this->_table)." WHERE xw_id='$xw_id'");
        if($sql){
            $sql = "INSERT INTO ".$this->table($this->_table)." VALUES".implode(',', $sql);
            $this->db->Execute($sql);
        }
    }

    public function attrs_by_case($xw_id)
    {
        if(!$xw_id = intval($xw_id)){
            return false;
        }
        $attrs = array();
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE xw_id='$xw_id'";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $attrs[$row['attr_value_id']] = $row;
            }
        }
        return $attrs;
    } 
}