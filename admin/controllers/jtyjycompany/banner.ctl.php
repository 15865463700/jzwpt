<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: banner.ctl.php 2034 2013-12-07 03:08:33Z $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Jtyjycompany_Banner extends Ctl
{

    public function jtyjycompany($jtyjycompany_id,$page = 1)
    {
		if(!$jtyjycompany_id = (int)$jtyjycompany_id){
            $this->err->add('未指定公司', 212);
        }else if(!$jtyjycompany = K::M('jtyjycompany/company')->detail($jtyjycompany_id)){
            $this->err->add('您选的公司不存在或已经删除', 213);
        }else if(!$this->check_city($jtyjycompany['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else{
			$filter = $pager = array();
			$pager['page'] = max(intval($page), 1);
			$pager['limit'] = $limit = 50;
			if ($SO = $this->GP('SO')) {
				$pager['SO'] = $SO;
				if ($SO['jtyjycompany_id']) {
					$filter['jtyjycompany_id'] = $SO['jtyjycompany_id'];
				}
				if ($SO['title']) {
					$filter['title'] = "LIKE:%" . $SO['title'] . "%";
				}
			}
			$jtyjycompanyIds = array();
			$filter = array('jtyjycompany_id'=>$jtyjycompany_id);
			if ($items = K::M('jtyjycompany/banner')->items($filter, null, $page, $limit, $count)) {
				 foreach($items as $k=>$v){
				   if(!empty($v['jtyjycompany_id']))  $jtyjycompanyIds[$v['jtyjycompany_id']] = $v['jtyjycompany_id'];
				} 
				$pager['count'] = $count;
				$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
			}
			$this->pagedata['jtyjycompany_list'] = K::M('jtyjycompany/company')->items_by_ids($jtyjycompanyIds);
			$this->pagedata['items'] = $items;
			$this->pagedata['pager'] = $pager;
			$this->pagedata['jtyjycompany_id'] = $jtyjycompany_id;
			$this->tmpl = 'admin:jtyjycompany/banner/jtyjycompany.html';
		}
    }


    public function create($jtyjycompany_id)
    {
        if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            }else if(!$jtyjycompany_id){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$jtyjycompany = K::M('jtyjycompany/company')->detail($jtyjycompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($jtyjycompany['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else {
                if ($_FILES['data']) {
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'jtyjycompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
				
                if ($banner_id = K::M('jtyjycompany/banner')->create($data)) {
                    $this->err->add('添加内容成功');
					$this->err->set_data('forward','?jtyjycompany/banner-jtyjycompany-'.$jtyjycompany_id.'.html');
                }
            }
        } else {
			$this->pagedata['jtyjycompany_id'] = $jtyjycompany_id;
            $this->tmpl = 'admin:jtyjycompany/banner/create.html';
        }
    }

    public function edit($banner_id = null)
    {
        if (!($banner_id = (int) $banner_id) && !($banner_id = $this->GP('banner_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('jtyjycompany/banner')->detail($banner_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if (!$jtyjycompany = K::M('jtyjycompany/company')->detail($detail['jtyjycompany_id'])) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$this->check_city($jtyjycompany['city_id'])){
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
                            if ($a = $upload->upload($attach, 'jtyjycompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
                unset($data['jtyjycompany_id'],$data['banner_id']);
                if (K::M('jtyjycompany/banner')->update($banner_id, $data)) {
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward','?jtyjycompany/banner-jtyjycompany-'.$detail['jtyjycompany_id'].'.html');
                }
            }
        } else {
            if ($jtyjycompany_id = $detail['jtyjycompany_id']) {
                $this->pagedata['jtyjycompany'] = K::M('jtyjycompany/company')->detail($jtyjycompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:jtyjycompany/banner/edit.html';
        }
    }

    public function delete($banner_id = null)
	{
		if($banner_id = (int)$banner_id){
            if($banner = K::M('jtyjycompany/banner')->detail($banner_id)){
				if(!$jtyjycompany = K::M('jtyjycompany/company')->detail($banner['jtyjycompany_id'])){
					 $this->err->add('该公司不存在或已经删除', 403);
				}else if(!$this->check_city($jtyjycompany['city_id'])){
					 $this->err->add('不可越权操作', 403);
				}else if(K::M('jtyjycompany/banner')->delete($banner_id)){
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('banner_id')){
            if($items = K::M('jtyjycompany/banner')->items_by_ids($ids)){
                $aids  =  array();
                foreach($items as $k => $v){
                    if($jtyjycompany_id = $v['jtyjycompany_id']){
                        break;
                    }
                }
                if(!$jtyjycompany = K::M('jtyjycompany/company')->detail($jtyjycompany_id)){
                    $this->err->add('该公司不存在或已经删除', 403);
                }else if(!$this->check_city($jtyjycompany['city_id'])){
                     $this->err->add('不可越权操作', 403);
                }else{
                    foreach($items as $val){
                        if($val['jtyjycompany_id'] == $jtyjycompany_id){
                            $aids[$val['banner_id']] = $val['banner_id'];
                        }
                    }
                    if($aids && K::M('jtyjycompany/banner')->delete($aids)){
                        $this->err->add('批量删除成功');
                    }
                }                
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}
