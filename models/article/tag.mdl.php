<?php
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Article_Tag extends Mdl_Table
{   
  
    protected $_table = 'article_tag';
    protected $_pk = 'tag_id';
    protected $_cols = 'tag_id,tag_name,cat_id,sortorder,count';
//    protected $_pre_cache_key = 'article-link-list';
//    protected $_orderby = array('orderby'=>'DESC');
    
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

    public function detail($tag_id,$cat_id=0){
        if($cat_id>0){
            $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE tag_name like '%{$tag_id}%' and cat_id={$cat_id} LIMIT 1";
        }else{
            if(!$tag_id = intval($tag_id)){
                return false;
            }
            $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE tag_id={$tag_id} LIMIT 1";
        }
        if($detail = $this->db->GetRow($sql)){
            return $detail;
        }
        return false;
    }

    public function filter($content, $limit=5)
    {
        static $filter = null;
        if($filter === null){
            $a = $b = array();
            if($items = $this->fetch_all()){
                $count = 0;
                foreach($items as $v){
                    $a['find'][] = "/{$v['title']}/";
                    $c = md5($v['title']);
                    $a['replace'][] = "@{$c}@";
                    $b['find'][] = "/@{$c}@/";
                    $b['replace'][] = "<a href=\"{$v['link']}\" target=\"_blank\">{$v['title']}</a>";
                }
            }
            $filter = array('a'=>$a, 'b'=>$b);
        }
        $_filter_ext = array();
        if(preg_match_all('/(title|alt)=\"(.*?)\"/i', $content, $m)){
            $a = $b = array();
            foreach($m[0] as $v){
                $a['find'][] = "/".addslashes($v)."/"; ///{$v}/";
                $c = md5($v);
                $a['replace'][] = "@{$c}@";
                $b['find'][] = "/@{$c}@/";
                $b['replace'][] = $v;
            }
            $_filter_ext = array('a'=>$a, 'b'=>$b);
            if($_filter_ext['a']){
                $content = preg_replace($_filter_ext['a']['find'], $_filter_ext['a']['replace'], $content);
            }
        }

        $limit = (int)$limit;
        if($filter['a']['find'] && $filter['a']['replace']){
            $content = preg_replace($filter['a']['find'],$filter['a']['replace'], $content, $limit);
            $content = preg_replace($filter['b']['find'],$filter['b']['replace'], $content, $limit);
        }
        if($_filter_ext['b']['find']){
            $content = preg_replace($_filter_ext['b']['find'], $_filter_ext['b']['replace'], $content);
        }
        return $content;
    }

    public function check($s,$pid,$cat_ids){
        $arr=explode(",",$s);
        if(is_array($arr)){
            foreach($arr as $k=>$v){
                if($v){
                    $sql = "SELECT tag_id,count(count) count FROM ".$this->table($this->_table)." WHERE tag_name = '{$v}' and cat_id={$pid}";
                    $tag_rs = $this->db->GetRow($sql);
                    $count=$tag_rs["count"];

                    $data=array();
                    $sql = "SELECT count(*) count FROM ".$this->table("article")." WHERE tag like '%{$v}%' and cat_id in ({$cat_ids})";
                    $article_rs=$this->db->GetRow($sql);
                    $data["count"]=$article_rs["count"];
                    if($count>0) {
                        $this->update($tag_rs['tag_id'],$data);
                    }else{
                        $data['tag_name']=$v;
                        $data['cat_id']=$pid;
                        $data['sortorder']=50;
                        $this->create($data);
                    }
                }
            }
        }
    }

    public function refresh(){
        $sql = "SELECT * FROM ".$this->table($this->_table);
        $tag_arr=array();
        if($rs = $this->db->Execute($sql)) {
            while ($row = $rs->fetch()) {
                array_push($tag_arr, $row);
            }
        }
        foreach($tag_arr as $key=>$value){
            $sql = "SELECT count(*) count FROM ".$this->table("article")." WHERE tag like '%{$value['tag_name']}%'";
            $rs = $this->db->GetRow($sql);
            $tag_arr[$key]['count']=$rs['count'];
            $this->db->update($this->_table, array("count"=>$rs['count']), $this->field($this->_pk, $value['tag_id']));
        }
        if($rs = $this->db->Execute($sql)) {
            return true;
        }
        return false;
    }

    public function items($filter=array(), $orderby=null, $p=1, $l=20, &$count=0){
        if(empty($p)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $p)){
            return false;
        }
        $limit = $this->limit($p, $l);
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table($this->_table)} {$limit}";
        $result=array();
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while ($row = $rs->fetch()) {
                array_push($result, $row);
            }
        }
        return $result;
    }

    public function items_by_cate_page($cat_id,$page,$city_id=0,$order){
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
//        $where = "closed='0'";
        $where = "1=1";
        if($city_id){
            $where .= " AND city_id='{$city_id}'";
        }
        if($cat_id){
            $where.=" and cat_id in ({$cat_id})";
        }
        if($order){
            $where.=" order by {$order} ";
        }
        if($page){
            $where.=" limit 0,{$page} ";
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where ";
        $result=array();
        if($rs = $this->db->Execute($sql)) {
            while ($row = $rs->fetch()) {
                array_push($result, $row);
            }
        }
        return $result;
    }

    public function items_by_cate_key_page($cat_id,$key,$page,$city_id=0,$order){
        if(empty($page)){
            return false;
        }else if(!preg_match('/^[\w]+$/', $page)){
            return false;
        }
//        $where = "closed='0'";
        $where = "1=1";
        if($city_id){
            $where .= " AND city_id='{$city_id}'";
        }
        if($cat_id){
            $where.=" and cat_id in ({$cat_id})";
        }
        if($key){
            $where.=" and tag_name in ({$key})";
        }
        if($order){
            $where.=" order by {$order} ";
        }
        if($page){
            $where.=" limit 0,{$page} ";
        }
        $sql = "SELECT * FROM {$this->table($this->_table)} WHERE $where ";
        $result=array();
        if($rs = $this->db->Execute($sql)) {
            while ($row = $rs->fetch()) {
                array_push($result, $row);
            }
        }
        return $result;
    }

}