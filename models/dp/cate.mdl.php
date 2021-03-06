<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: cate.mdl.php 2387 2013-12-20 07:57:21Z $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Mdl_Dp_Cate extends Mdl_Table {

    protected $_table = 'dp_cate';
    protected $_pk = 'cat_id';
    protected $_cols = 'cat_id,title,py,parent_id,seo_keywords,seo_description,orderby,audit,closed,dateline';
    protected $_orderby = array('parent_id' => 'ASC', 'orderby' => 'ASC');
    protected $_pre_cache_key = 'ask_cat_list';

    public function detail($cat_id, $closed = false)
    {
        if(!is_numeric($cat_id)){
            $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE py = '{$cat_id}' LIMIT 1";
            if($detail = $this->db->GetRow($sql)){
                return $detail;
            }
            return false;
        }
        if ($detail = parent::detail($cat_id, $closed)) {
            $detail['pids'] = $this->parent_ids($cat_id);
            $detail = $this->_format_row($detail);
        }
        return $detail;
    }

    public function create($data, $checked = false)
    {
        if (!$checked && !$data = $this->_check_schema($data)) {
            return false;
        }
        if ($cat_id = $this->db->insert($this->_table, $data, true)) {
            $this->flush();
        }
        return $cat_id;
    }

    public function update($cat_id, $data, $checked = false)
    {
        if (!$cat_id = (int) $cat_id) {
            return false;
        }
        else if (!$checked && !$data = $this->_check_schema($data, $cat_id)) {
            return false;
        }
        if ($ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $cat_id))) {
            $this->flush();
        }
        return $ret;
    }

    public function cate($cat_id)
    {
        if (!$cat_id = (int) $cat_id) {
            return false;
        }
        else if ($cate_list = $this->fetch_all()) {
            return $cate_list[$cat_id];
        }
        return false;
    }

    public function parent_ids($cat_id, $glue = ',', $append = false)
    {
        if (!$cat_id = (int) $cat_id) {
            return false;
        }
        $pids = $append ? array($cat_id) : array();
        if ($cats = $this->fetch_all()) {
            while ($a = $cats[$cat_id]) {
                if ($cat_id = $a['parent_id']) {
                    array_unshift($pids, $cat_id);
                }
            }
        }
        return implode($glue, $pids);
    }

    public function options($pid = 0)
    {
        $options = array();
        if ($items = $this->fetch_all()) {
            foreach ($items as $k => $v) {
                if ($v['parent_id'] == $pid) {
                    $options[$k] = $v['title'];
                }
            }
        }
        return $options;
    }

    public function childrens($pid = 0)
    {
        $childrens = array();
        if ($items = $this->fetch_all()) {
            foreach ((array) $items as $k => $v) {
                if ($v['parent_id'] == $pid) {
                    $childrens[$k] = $v;
                }
            }
        }
        return $childrens;
    }

    public function children_ids($pid = 0)
    {
        $ids = array($pid);
        $return = array($pid);
        if ($items =  $this->fetch_all()) {
            if (!empty($pid))
                unset($items[$pid]);
            while (true) {
                $local = array();
                foreach ($items as $k => $v) {
                    if (in_array($v['parent_id'], $ids)) {
                        $return[$k] = $local[$k] = $k;
                        unset($items[$k]);
                    }
                }
                if (empty($local))
                    break;
                $ids = $local;
            }
        }
        return $return;
    }

    protected function _format_row($row)
    {

        return $row;
    }


//    protected function children_ids($pids){
//        $select=$this->_db->select();
//        $select->from($this->_name,"cat_id")
//            ->where("parent_id in (?)",$pids);
//        $result=$this->_db->fetchCol($select);
//        if($result){
//            return array_merge($pids,$this->children_ids($result));
//        }else{
//            return array_merge($pids,$result);
//        }
//    }

//    public function children_tree($pids){
//        if(empty($pids))return false;
//        $children_ids=$this->children_ids($pids);
//        $select=$this->_db->select();
//        $select->from($this->_name)
//            ->where("cat_id in (?)",$children_ids);
//        $list=$this->_db->fetchAll($select);
//
//
//
//        $result=array();
//        if(count($pids)==1&& in_array("0", $pids)){
//            foreach($list as $k=>$v){
//                if(in_array($v['parent_id'], $pids)){
//                    array_push($result, $v);
//                    unset($list[$k]);
//                }
//            }
//        }else{
//            foreach($list as $k=>$v){
//                if(in_array($v['cat_id'], $pids)){
//                    array_push($result, $v);
//                    unset($list[$k]);
//                }
//            }
//        }
//        if(count($result)>0){
//            foreach($result as $k=>$v){
//                foreach($list as $kk=>$vv){
//                    if($v['cat_id']==$vv['parent_id']){
//                        !is_array($result[$k]['subs'])&&($result[$k]['subs']=array());
//                        array_push($result[$k]['subs'], $vv);
//                        unset($list[$kk]);
//                    }
//                }
//                if(count($result[$k]['subs'])>0){
//                    foreach($result[$k]['subs'] as $k2=>$v2){
//                        foreach($list as $kk=>$vv){
//                            if($v2['cat_id']==$vv['parent_id']){
//                                !is_array($result[$k]['subs'][$k2]['subs'])&&($result[$k]['subs'][$k2]['subs']=array());
//                                array_push($result[$k]['subs'][$k2]['subs'], $vv);
//                                unset($list[$kk]);
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        return $result;
//    }

}
