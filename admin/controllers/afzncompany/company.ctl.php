<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: afzncompany.ctl.php 3419 2014-02-21 09:42:53Z youyi $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Afzncompany_Company extends Ctl
{

    public function index($page = 1) 
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if ($SO = $this->GP('SO')) {
            $pager['SO'] = $SO;
            if ($SO['afzncompany_id']) {
                $filter['afzncompany_id'] = $SO['afzncompany_id'];
            }
            if ($SO['uid']) {
                $filter['uid'] = $SO['uid'];
            }
            if ($SO['city_id']) {
                $filter['city_id'] = $SO['city_id'];
            }
            if ($SO['area_id']) {
                $filter['area_id'] = $SO['area_id'];
            }
            if ($SO['name']) {
                $filter['name'] = "LIKE:%" . $SO['name'] . "%";
            }
            if ($SO['sort_name']) {
                $filter['sort_name'] = "LIKE:%" . $SO['sort_name'] . "%";
            }
            if ($SO['contact']) {
                $filter['contact'] = "LIKE:%" . $SO['contact'] . "%";
            }
            if ($SO['tel']) {
                $filter['tel'] = "LIKE:%" . $SO['tel'] . "%";
            }
            if (is_numeric($SO['audit'])) {
                $filter['audit'] = $SO['audit'];
            }
        }
        $uids = array();
        $filter['closed'] = 0;
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if ($items = K::M('afzncompany/company')->items($filter, null, $page, $limit, $count)) {
            foreach($items as $k=>$v){
                $uids[] = $v['uid'];
                 $items[$k]['clientip'] = $v['clientip'].'('. K::M("misc/location")->location($v['clientip']) .')';
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
               
        }
		
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
        $this->tmpl = 'admin:afzncompany/company/items.html';
    }

    
    public function audit($page = 1) 
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
    
        $uids = array();
        $filter['closed'] = 0;
        $filter['audit'] = 0;
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if ($items = K::M('afzncompany/company')->items($filter, null, $page, $limit, $count)) {
            foreach($items as $k=>$v){
                $uids[] = $v['uid'];
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
        }
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
        $this->tmpl = 'admin:afzncompany/company/audit.html';
    }
    
    
    
    public function so($target=null, $multi=null)
    {
        if($target){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;          
        $this->tmpl = 'admin:afzncompany/company/so.html';
    }

    public function dialog($page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $pager['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if ($SO['afzncompany_id']) {$filter['afzncompany_id'] = $SO['afzncompany_id'];}
            if ($SO['uid']) {$filter['uid'] = $SO['uid'];}
            if ($SO['area_id']) {$filter['area_id'] = $SO['area_id'];}
            if(!isset($filter['area_id'])){
                if ($SO['city_id']) {$filter['city_id'] = $SO['city_id'];}
            }
            if ($SO['name']) {$filter['name'] = "LIKE:%" . $SO['name'] . "%";}
            if ($SO['tel']) {$filter['tel'] = "LIKE:%" . $SO['tel'] . "%";}
            if (is_numeric($SO['audit'])) {$filter['audit'] = $SO['audit'];}
        }
        $filter['closed'] = 0;
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('afzncompany/company')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO, 'multi'=>$multi));
            $uids = array();
            foreach($items as $k=>$v){
                $uids[$v['uid']] = $v['uid'];
            }
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();        
        $this->tmpl = 'admin:afzncompany/company/dialog.html';
    }

    public function create()
    {
        if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
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
                            if ($a = $upload->upload($attach, 'afzncompany')) {
                                $data[$k] = $a['photo'];
                                if ($k === 'logo') {
                                    $size['photo'] = $cfg['afzncompanydecorate1'] ? $cfg['afzncompanydecorate1'] : '200X100';
                                } else if($k === 'thumb') {
                                    $size['photo'] = $cfg['afzncompanydecorate2'] ? $cfg['afzncompanydecorate2'] : '300X300';
                                }else{
									$size['photo'] = '1000X200';
								}
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']), false);
                            }
                        }
                    }
                }
                if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }
                $data['lat'] = trim($data['lat']);
                if ($afzncompany_id = K::M('afzncompany/company')->create($data)) {
                    if($data['uid'] && isset($data['group_id'])){
                        K::M('member/member')->update($data['uid'], array('group_id'=>(int)$data['group_id']), true);
                    }
                    if($attr=  $this->GP('attr')){
                        K::M('afzncompany/attr')->update($afzncompany_id,$attr);
                    }
                    if($fields = $this->GP('fields')){
                         K::M('afzncompany/fields')->update($afzncompany_id, $fields);
                    }                    
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?afzncompany/company-index.html');
                }
            }
        } else {
			$skins = include(__CFG::TMPL_DIR.'default/afzncompany/config.php');
			$this->pagedata['skins'] = $skins;
            $this->tmpl = 'admin:afzncompany/company/create.html';
        }
    }

    public function edit($afzncompany_id = null)
    {
        if (!($afzncompany_id = (int) $afzncompany_id) && !($afzncompany_id = $this->GP('afzncompany_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('afzncompany/company')->detail($afzncompany_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        } else if ($this->checksubmit('data')) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
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
                            if ($a = $upload->upload($attach, 'afzncompany')) {
                                $data[$k] = $a['photo'];
                                if ($k === 'logo') {
                                    $size['photo'] = $cfg['afzncompanydecorate1'] ? $cfg['afzncompanydecorate1'] : '200X100';
                                } else if($k === 'thumb') {
                                    $size['photo'] = $cfg['afzncompanydecorate2'] ? $cfg['afzncompanydecorate2'] : '300X300';
                                }else{
									$size['photo'] = '1000X200';
								}
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }                
                }

                unset($data['city_id'],$data['afzncompany_id']);
                if (K::M('afzncompany/company')->update($afzncompany_id, $data)) {
                    if($data['uid'] && isset($data['group_id'])){
                        K::M('member/member')->update($data['uid'], array('group_id'=>(int)$data['group_id']), true);
                    }
                    if($attr =  $this->GP('attr')){
                        K::M('afzncompany/attr')->update($afzncompany_id,$attr);
                    }
                    if($fields = $this->GP('fields')){                     
                         K::M('afzncompany/fields')->update($afzncompany_id,$fields);
                    }
                    $this->err->add('修改内容成功');
                    $this->err->set_data('forward', '?afzncompany/company-index.html');
                }

                
            }
        } else {
			$skins = include(__CFG::TMPL_DIR.'default/afzncompany/config.php');
			$this->pagedata['skins'] = $skins;
			$attr=K::M('afzncompany/attr')->attrs_ids_by_company($afzncompany_id);
            $this->pagedata['attr'] = $attr;
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->member($uid);
            }
            $this->pagedata['detailfields'] = K::M('afzncompany/fields')->detail($afzncompany_id);
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:afzncompany/company/edit.html';
        }
    }
    
    
    public function auditup($afzncompany_id = null)
    {
        if ($afzncompany_id = (int) $afzncompany_id) {
            if (K::M('afzncompany/company')->update($afzncompany_id,array('audit'=>1))) {
                $this->err->add('审核成功');
            }
        } else if ($ids = $this->GP('afzncompany_id')) {
            if (K::M('afzncompany/company')->batch($ids,array('audit'=>1))) {
                $this->err->add('审核成功');
            }
        } else {
            $this->err->add('未指定要审核的ID', 401);
        }
    }
    
    public function vip($afzncompany_id = null){
         if ($afzncompany_id = (int) $afzncompany_id) {
             if($detail = K::M('afzncompany/company')->detail($afzncompany_id)){
                $data['is_vip'] = empty($detail['is_vip']) ? 1 : 0;
                if (K::M('afzncompany/company')->update($afzncompany_id,$data)) {
                    $this->err->add('设置成功');
                }else{
                     $this->err->add('设置失败');
                }
             }else{
                  $this->err->add('未指定要设为旗舰的ID', 401);
             }             
         }else{
              $this->err->add('未指定要设为旗舰的ID', 401);
         }  
    }
    
    
    public function delete($afzncompany_id = null)
    { 
        if($afzncompany_id = (int)$afzncompany_id){
            if($afzncompany = K::M('afzncompany/company')->detail($afzncompany_id)){
                if(!$this->check_city($afzncompany['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('afzncompany/company')->delete($afzncompany_id)){
                    $this->err->add('删除安防智能公司成功');
                }
            }
        }else if($ids = $this->GP('afzncompany_id')){
            if($items = K::M('afzncompany/company')->items_by_ids($ids)){
                $aids  = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['afzncompany_id']] = $v['afzncompany_id'];
                }
                if($aids && K::M('afzncompany/company')->delete($aids)){
                    $this->err->add('批量删除安防智能公司成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }
}