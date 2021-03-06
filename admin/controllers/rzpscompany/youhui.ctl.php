<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: youhui.ctl.php 5867 2014-07-12 02:04:39Z youyi $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Rzpscompany_Youhui extends Ctl {

    public function index($page = 1) {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if ($SO = $this->GP('SO')) {
            $pager['SO'] = $SO;
            if ($SO['youhui_id']) {
                $filter['youhui_id'] = $SO['youhui_id'];
            }
            if ($SO['area_id']) {
                $filter['area_id'] = $SO['area_id'];
            }
            if (!isset($filter['area_id'])) {
                if ($SO['city_id']) {
                    $filter['city_id'] = $SO['city_id'];
                }
            }
            if ($SO['rzpscompany_id']) {
                $filter['rzpscompany_id'] = $SO['rzpscompany_id'];
            }
            if ($SO['title']) {
                $filter['title'] = "LIKE:%" . $SO['title'] . "%";
            }
            if (is_array($SO['bg_date'])) {
                if ($SO['bg_date'][0] && $SO['bg_date'][1]) {
                    $a = strtotime($SO['bg_date'][0]);
                    $b = strtotime($SO['bg_date'][1]) + 86400;
                    $filter['bg_date'] = $a . "~" . $b;
                }
            }
            if (is_array($SO['end_date'])) {
                if ($SO['end_date'][0] && $SO['end_date'][1]) {
                    $a = strtotime($SO['end_date'][0]);
                    $b = strtotime($SO['end_date'][1]) + 86400;
                    $filter['end_date'] = $a . "~" . $b;
                }
            }
            if(is_numeric($SO['audit'])){$filter['audit'] = $SO['audit'];}
        }
        $rzpscompanyIds = array();
		if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if ($items = K::M('rzpscompany/youhui')->items($filter, null, $page, $limit, $count)) {
            foreach ($items as $k => $v) {

                if (!empty($v['rzpscompany_id']))
                    $rzpscompanyIds[$v['rzpscompany_id']] = $v['rzpscompany_id'];
                $items[$k]['clientip'] = $v['clientip'] . '(' . K::M("misc/location")->location($v['clientip']) . ')';
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
        }
        $this->pagedata['rzpscompany_list'] = K::M('rzpscompany/company')->items_by_ids($rzpscompanyIds);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
        $this->tmpl = 'admin:rzpscompany/youhui/items.html';
    }

    public function so() {
        $this->tmpl = 'admin:rzpscompany/youhui/so.html';
    }
    
    public function audit($youhui_id = null)
    {
        if ($youhui_id = (int) $youhui_id) {
			if(!$detail = K::M('rzpscompany/youhui')->detail($youhui_id)){
				$this->err->add('您要审核内容不存在或已经删除', 212);
			}else if(!$this->check_city($detail['city_id'])){
				 $this->err->add('不可越权操作', 403);
			}else{
				if (K::M('rzpscompany/youhui')->update($youhui_id,array('audit'=>1))) {
					$this->err->add('审核成功');
				}
			}
        } else if ($ids = $this->GP('youhui_id')) {

			 if($items = K::M('rzpscompany/youhui')->items_by_ids($ids)){
                $aids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['youhui_id']] = $v['youhui_id'];
                }
                if($aids && K::M('rzpscompany/youhui')->batch($aids,array('audit'=>1))){
                   $this->err->add('审核成功');
                }
            }
        } else {
            $this->err->add('未指定要审核的ID', 401);
        }
    }

    public function create() {
        if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            }else if(!$rzpscompany_id = (int)$data['rzpscompany_id']){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$rzpscompany = K::M('rzpscompany/company')->detail($rzpscompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($rzpscompany['city_id'])){
                $this->err->add('不可越权操作', 403);
            } else {
                if ($_FILES['data']) {
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $cfg = K::$system->config->get('attach');
                    $oImg = K::M('image/gd');
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'rzpscompany')) {
                                $data[$k] = $a['photo'];
                                $size['photo'] = $cfg['youhui']['photo'] ? $cfg['youhui']['photo'] : 200;
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }
				if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }
                if ($youhui_id = K::M('rzpscompany/youhui')->create($data)) {
					K::M('rzpscompany/youhui')->youhui_count($rzpscompany['rzpscompany_id']);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?rzpscompany/youhui-index.html');
                }
            }
        } else {
            $this->tmpl = 'admin:rzpscompany/youhui/create.html';
        }
    }

    public function edit($youhui_id = null) {
        if (!($youhui_id = (int) $youhui_id) && !($youhui_id = $this->GP('youhui_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('rzpscompany/youhui')->detail($youhui_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if ($this->checksubmit('data')) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if ($_FILES['data']) {
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'rzpscompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
				unset($data['city_id'],$data['rzpscompany_id']);
				if (K::M('rzpscompany/youhui')->update($youhui_id, $data)) {
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward', '?rzpscompany/youhui-index.html');
                }
            }
        } else {
            if ($rzpscompany_id = $detail['rzpscompany_id']) {
                $this->pagedata['rzpscompany'] = K::M('rzpscompany/company')->detail($rzpscompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:rzpscompany/youhui/edit.html';
        }
    }

    public function doaudit($youhui_id=null)
    {
        if($youhui_id = (int)$youhui_id){
            if(K::M('rzpscompany/youhui')->batch($youhui_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('youhui_id')){
            if(K::M('rzpscompany/youhui')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }    

    public function delete($youhui_id = null)
    {
        
		if($youhui_id = (int)$youhui_id){
            if($youhui = K::M('rzpscompany/youhui')->detail($youhui_id)){
                if(!$this->check_city($youhui['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('rzpscompany/youhui')->delete($youhui_id)){
                    K::M('rzpscompany/youhui')->youhui_count($youhui['rzpscompany_id']);
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('youhui_id')){
            if($items = K::M('rzpscompany/youhui')->items_by_ids($ids)){
                $aids = $rzpscompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['youhui_id']] = $v['youhui_id'];
                    $rzpscompany_ids[$v['rzpscompany_id']] = $v['rzpscompany_id'];
                }
                if($aids && K::M('rzpscompany/youhui')->delete($aids)){
                    K::M('rzpscompany/youhui')->youhui_count($rzpscompany_ids);
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}
