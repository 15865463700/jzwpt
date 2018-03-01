<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Supervist_Supervist extends Mdl_Table
{   
  
    protected $_table = 'supervist';
    protected $_pk = 'supervist_id';
    protected $_cols = 'supervist_id,city_id,area_id,thumb,name,qq,mobile,views,about,orderby,closed,dateline';
	
	protected $_orderby = array('orderby'=>'ASC','supervist_id'=>'DESC');
	protected $order_list = array(1=>array('title'=>'默认'),2=>array('title'=>'浏览数'));
	
	public function get_order(){
        
        return $this->order_list;
    }
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

	public function items_by_attr($filter=array(), $orderby=null, $p=1, $l=20, &$count=0)
    {
        if($attrs = $filter['attrs']){
            $attr_ids = join(',',$attrs);
            $attr_count = array_sum($attrs);
            $attr_sql = "SELECT supervist_id FROM ".$this->table('supervist_attr')." WHERE attr_value_id IN($attr_ids) GROUP BY supervist_id HAVING SUM(attr_value_id)=$attr_count";
        }
      
        unset($filter['attrs']);
        $where = $this->where($filter);
        if($attr_sql){
            $where .= " AND supervist_id IN($attr_sql)";
        }
        $orderby = $this->order($orderby, null);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)."  WHERE $where $orderby $limit";
        if($rs = $this->db->query($sql)){
			$count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                if($this->_pk){
                    $items[$row[$this->_pk]] = $row;
                }else{
                    $items[] = $row;
                }
            }
            
        }
        return $items;
    }

    public function detail_by_openid($openid)
    {
        $sql = "SELECT * FROM ".$this->table($this->_table)."WHERE opendid={$openid}";
        if($row = $this->db->GetRow($sql)){
            return $row;
        }
        return false;
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