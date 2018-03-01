<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Gybj_Gybj extends Mdl_Table
{   
  
    protected $_table = 'gybj';
    protected $_pk = 'gybj_id';
    protected $_cols = 'gybj_id,gybj_title,add_time,gybj_thumb,gybj_user_id,gybj_user_name,gybj_user_img,gybj_video,info,detail,lianxiren,phone,mobile,qq,address';
    protected $_orderby = array('gybj_id'=>'DESC');

    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }else if(!defined('IN_ADMIN')){
            if(!$this->check_tender_count()){
                return false;
            }
        }
        return $this->db->insert($this->_table, $data, true);
    }

	protected function check_tender_count()
    {
        $access = K::$system->config->get('access');
        if($tender_count = (int)$access['tender_count']){
            if($tender_count < $this->count(array('clientip'=>__IP, 'dateline'=>'>:'.(__TIME-86400)))){
                $this->err->add('同一IP24小时只能发布'.$tender_count.'招标', 501);
                return false;
            }
        }
        if($tender_time = (int)$access['tender_time']){
            $time = __TIME - $tender_time*60;
            if($this->count(array('clientip'=>__IP, 'dateline'=>'>:'.$time))){
                $this->err->add('同一IP两个招标的间隔'.$tender_time.'分钟', 502);
                return false;
            }
        }
        return true;
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    public function sign($tenders_id, $uid)
    {
        if(!$tenders_id = (int)$tenders_id){
            return false;
        }else if(!$uid = (int)$uid){
            return false;
        }else if(!$member = K::M('member/member')->member($uid)){
            return false;
        }
        $info = array();
        $company_id = 0;
        if($member['from'] == 'company'){
            if($company = K::M('company/company')->company_by_uid($uid)){
                $info['name'] = $company['name'];
                $info['company_id'] = $company_id = $company['company_id'];
            }
        }else if('gz' == $member['from']){
            if($gz = K::M('gz/gz')->detail($uid)){
                $info['name'] = $gz['name'];
                $info['gz_id'] = $gz['uid'];
            }
        }else if('designer' == $member['from']){
            if($designer = K::M('designer/designer')->detail($uid)){
                $info['name'] = $designer['name'];
                $info['designer_id'] = $designer['uid'];
            }
        }else if('mechanic' == $mmeber['from']){
            if($mechanic = K::M('mechanic/mechanic')->detail($uid)){
                $info['name'] = $mechanic['name'];
                $info['mechanic_id'] = $mechanic['uid'];
            }
        }else if('shop' == $member['from']){
            if($shop = K::M('shop/shop')->shop_by_uid($uid)){
                $info['name'] = $shop['name'];
                $info['shop_id'] = $shop['shop_id'];
            }
        }
        return $this->update($tenders_id, array('sign_uid'=>$uid,'sign_company_id'=>$company_id, 'sign_from'=>$member['from'], 'sign_info'=>serialize($info), 'sign_time'=>__TIME));
    }

    public function from_list()
    {
        return $this->_from_list;
    }

    //外部类调用
    public function format_row($row)
    {
        return $this->_format_row($row);
    }

    protected function _format_row($row)
    {
        static $tenders_attrs = null;
        if($tenders_attrs === null){
            $tenders_attrs = K::M('tenders/setting')->fetch_all();
        }
        $title = '';
        if($city = K::M('data/city')->city($row['city_id'])){
            $row['city_name'] = $city['city_name'];
            $title = $city['city_name'].'房屋装修';
        }
        if($area = K::M('data/area')->area($row['area_id'])){
            $row['area_name'] = $area['area_name'];
            $title = $area['area_name'].'房屋装修';
        }
        if($types = K::M('tenders/setting')->get_type()){
            $title = '';
            foreach($types as $k=>$v){
                if($type = $tenders_attrs[$row[$k.'_id']]){
                    $row[$k.'_title'] = $type['name'];
                    $title .= $type['name'];
                }
            }
        }
        if(empty($row['title'])){
            $row['title'] = $title;
        }        
        if($city_id = $row['city_id']){
            if($city = K::M('data/city')->city($city_id)){
                $row['city_name'] = $city['city_name'];
            }
        }
        if($area_id = $row['area_id']){
            if($area = K::M('data/area')->area($area_id)){
                $row['area_name'] = $area['area_name'];
            }
        }
        $row['status_title'] = K::M('misc/data')->yuyue($row['status']);
        $row['from_title'] = $this->_from_list[$row['from']];
        $row['from_attr_key'] = 'tenders:'.$row['from'];
        $row['sign_info'] = unserialize($row['sign_info']);
        return $row;
    }

    protected function _check($data, $tenders_id=null)
    {
        if($data['zx_time']){
            $data['zx_time'] = strtotime($data['zx_time']);
        }
        if($data['tx_time']){
            $data['tx_time'] = strtotime($data['tx_time']);
        }
        return parent::_check($data, $tenders_id);        
    }

    public function format_items_ext($items)
    {
        if(empty($items)){
            return false;
        }
        $company_ids = array();
        foreach((array)$items as $k=>$v){
            $company_ids[$v['sign_company_id']] = $v['sign_company_id'];
        }
        $company_list = $tenders_list = array();
        if($company_ids){
            $company_list = K::M('company/company')->items_by_ids($company_ids);
        }        
        foreach((array)$items as $k=>$v){
            if(!$company = $company_list[$v['sign_company_id']]){
                $company = array();
            }
            $v['ext'] = array('company'=>$company);
            $items[$k] = $v;
        }
        return $items;
    }

    public function items($filter=array(), $orderby=null, $p=1, $l=20, &$count=0)
    {
        if($attrs = $filter['attrs']){
            $attr_ids = join(',',$attrs);
            $attr_count = array_sum($attrs);
            $attr_sql = "SELECT gybj_id FROM ".$this->table('gybj_attr')." WHERE attr_value_id IN($attr_ids) GROUP BY gybj_id HAVING SUM(attr_value_id)=$attr_count";
        }

        unset($filter['attrs']);
        $where = $this->where($filter);
        if($attr_sql){
            $where .= " AND gybj_id IN($attr_sql)";
        }
        $orderby = $this->order($orderby, null);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)."  WHERE $where $orderby $limit";
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
            }
        }
        return $items;
    }

}
