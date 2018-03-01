<?php
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Xw_Xw extends Mdl_Table{
    protected $_table = 'xw';
    protected $_pk = 'xw_id';
    protected $_cols = 'xw_id,city_id,home_id,uid,huxing,huxing_id,company_id,intro,home_name,title,photo,size,views,likes,seo_title,seo_keywords,seo_description,orderby,lastphotos,lasttime,audit,closed,clientip,dateline,content';
    protected $_orderby = array('orderby'=>'ASC', 'lasttime'=>'DESC');

    protected $_hot_orderby = array('likes'=>'DESC','orderby'=>'ASC');
    protected $_hot_filter = array('audit'=>'1', 'closed'=>'0');
    protected $_new_orderby = array('lasttime'=>'DESC');
    protected $_new_filter = array('audit'=>'1', 'closed'=>'0');

    public function items($filter=array(), $orderby=null, $p=1, $l=50, &$count=0)
    {
        if($attrs = $filter['attrs']){
            $attr_ids = join(',',$attrs);
            $attr_count = array_sum($attrs);
            $attr_sql = "SELECT xw_id FROM ".$this->table('xw_attr')." WHERE attr_value_id IN($attr_ids) GROUP BY xw_id HAVING SUM(attr_value_id)=$attr_count";
			$ids = array();
			if($rs = $this->db->query($attr_sql)){
				 while($row = $rs->fetch()){
					$ids[$row['xw_id']] = $row['xw_id'];
				}
			}
			if(!empty($ids)){
				$str = join(',',$ids);
				$datasql=" AND xw_id IN($str) ";
			}else{
				$datasql =  false;
			}
			
		}
        unset($filter['attrs']);
        $where = $this->where($filter);
        if($datasql !== false){
            $where .= $datasql;
        }else{
			return array();
		}
	
        $orderby = $this->order($orderby);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where $orderby $limit";
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
            }
        }
        return $items;
    }
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        $data['dateline']=time();
        $data['audit']=1;
        if($xw_id = $this->db->insert($this->_table, $data, true)){
//            $this->update_ext_count($data);
        }
        return $xw_id;
    }

	public function case_count($val)
	{
	    if($case = K::M('xw/xw')->detail($val)){
            if($company_id = (int)$case['company_id']){
				$this->company_count($company_id);
			}
			if($uid = (int)$case['uid']){
				$member = K::M('member/member')->detail($uid);
				if($member['from'] == 'gz' ||  $member['from'] == 'designer'){
					$this->uid_count($uid,$member['from']);
				}
			}
			if ($home_id = (int) $case['home_id']) {
				$this->home_count($home_id);
			}
        }
	}

    public function update($xw_id, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data,  $xw_id)){
            return false;
        }else if(!$case = $this->detail($xw_id)){
            return false;
        }
        if($ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $xw_id))){
            $this->update_ext_count($data, $case);
        }
        return $ret;
    }

    public function up_detail($pk, $audit = 1,$closed=false)
	{
		if(!$pk = (int)$pk){
			return false;
		}
		$this->_checkpk();	
        $audit = (int) $audit;
		$where = $this->_pk." < {$pk} AND audit={$audit}";
		if($closed && $this->field_exists('closed')){
			$where .= " AND closed='0'";
		}
		$sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where  ORDER BY ".$this->_pk." DESC LIMIT 1";
		if($detail = $this->db->GetRow($sql)){
			$detail = $this->_format_row($detail);
		}
		return $detail;
	}
    
    public function next_detail($pk,$audit = 1, $closed=false){
        if(!$pk = (int)$pk){
			return false;
		}
		$this->_checkpk();		
        $audit = (int) $audit;
		$where = $this->_pk." > {$pk} AND audit={$audit}";
		if($closed && $this->field_exists('closed')){
			$where .= " AND closed='0'";
		}
		$sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where  ORDER BY ".$this->_pk." ASC LIMIT 1";
		if($detail = $this->db->GetRow($sql)){
			$detail = $this->_format_row($detail);
		}
		return $detail;
    }

    public function delete($val, $force=false){
        if(!$ids = K::M('verify/check')->ids($val)){
            return false;
        }
        $ret = false;
        if($items = $this->items_by_ids($ids)){
            $xw_ids = array();
            foreach($items as $k=>$v){
                if(empty($v['closed'])){
                    $xw_ids[$v['xw_id']] = $v['xw_id'];
                }
            }
        }
        if($xw_ids){
            $ret = parent::delete($xw_ids, $force);
        }
        return $ret;       
    }

    public function update_last($xw_id, $size=0, $num=1)
    {
        $lastpids = array(); 
        if(!$size = (int)$size){
            return false;
        }else if(!$num = (int)$num){
            return false;
        }else if(!$xw_id = (int)$xw_id){
            return false;
        }
        $filter = array('closed'=>0, 'xw_id'=>$xw_id);
        $photo = '';
        if($items = K::M('xw/photo')->items($filter, array('photo_id'=>'DESC'), 1, 10)){
            foreach($items as $v){
                $lastpids[$v['photo_id']] = $v['photo_id'];
            }
            $last = array_shift($items);
            $photo = $last['photo'];
        }
        $pids = implode(',', $lastpids);
        $time = __CFG::TIME;
        $sql = "UPDATE ".$this->table($this->_table)
            ." SET photo='{$photo}', lastphotos='{$pids}', lasttime='{$time}',`photos`=`photos`+$num,`size`=`size`+$size "
            ." WHERE xw_id='$xw_id'";
        return $this->db->Execute($sql);
    }

    /**
     * 重置案例统计数
     */
    public function reset_count($xw_id)
    {
        if(!$xw_id = (int)$xw_id){
            return false;
        }else if(!$data = K::M('xw/photo')->count_by_case($xw_id)){
            $data = array('xw_id'=>$xw_id, 'photos'=>0, 'size'=>0);
        }
        return $this->db->update($this->_table, array('photos'=>$data['photos'], 'size'=>$data['size']), "xw_id='{$xw_id}'");
    }

    public function format_items_ext($items){
        if(empty($items)){
            return false;
        }
        $xw_ids = $photo_ids = $home_ids = $designer_ids = $company_ids = array();
        foreach((array)$items as $k=>$v){
            $xw_ids[$v['xw_id']] = $v['xw_id'];
            if($v['lastphotos']){
                foreach(explode(',', $v['lastphotos']) as $id){
                    $photo_ids[$id] = $id;
                }
            }
        }
        if($photo_ids){
            $photo_list = K::M('xw/photo')->items_by_ids($photo_ids);
        }
        if($xw_ids){
            $attr_list = K::M('xw/attr')->items(array('xw_id'=>$xw_ids), null, 1, 500);
        }
        foreach((array)$items as $k=>$v){
            $photos = $designer = $home = array();
            if($v['lastphotos']){                    
                foreach(explode(',', $v['lastphotos']) as $id){
                    if($photo = $photo_list[$id]){
                        $photos[$id] = $photo;
                    }
                }
            }
            $v['ext'] = array('photos'=>$photos,'attrs'=>array());
            $items[$k] = $v;            
        }
        $obj = K::M('data/attrvalue');
        foreach($attr_list as $k=>$v){
            if($items[$v['xw_id']]){
                if($val = $obj->attrvalue($v['attr_value_id'])){
                    $items[$v['xw_id']]['ext']['attrs'][$v['attr_value_id']] = $val['title'];
                }
            }
        }
        return $items;
    }
}
