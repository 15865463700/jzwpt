<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: banner.ctl.php 2034 2013-12-07 03:08:33Z $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Gybjcompany_Banner extends Ctl
{

    public function gybjcompany($gybjcompany_id,$page = 1)
    {
		if(!$gybjcompany_id = (int)$gybjcompany_id){
            $this->err->add('未指定公司', 212);
        }else if(!$gybjcompany = K::M('gybjcompany/company')->detail($gybjcompany_id)){
            $this->err->add('您选的公司不存在或已经删除', 213);
        }else if(!$this->check_city($gybjcompany['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else{
			$filter = $pager = array();
			$pager['page'] = max(intval($page), 1);
			$pager['limit'] = $limit = 50;
			if ($SO = $this->GP('SO')) {
				$pager['SO'] = $SO;
				if ($SO['gybjcompany_id']) {
					$filter['gybjcompany_id'] = $SO['gybjcompany_id'];
				}
				if ($SO['title']) {
					$filter['title'] = "LIKE:%" . $SO['title'] . "%";
				}
			}
			$gybjcompanyIds = array();
			$filter = array('gybjcompany_id'=>$gybjcompany_id);
			if ($items = K::M('gybjcompany/banner')->items($filter, null, $page, $limit, $count)) {
				 foreach($items as $k=>$v){
				   if(!empty($v['gybjcompany_id']))  $gybjcompanyIds[$v['gybjcompany_id']] = $v['gybjcompany_id'];
				} 
				$pager['count'] = $count;
				$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
			}
			$this->pagedata['gybjcompany_list'] = K::M('gybjcompany/company')->items_by_ids($gybjcompanyIds);
			$this->pagedata['items'] = $items;
			$this->pagedata['pager'] = $pager;
			$this->pagedata['gybjcompany_id'] = $gybjcompany_id;
			$this->tmpl = 'admin:gybjcompany/banner/gybjcompany.html';
		}
    }


    public function create($gybjcompany_id)
    {
        if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            }else if(!$gybjcompany_id){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$gybjcompany = K::M('gybjcompany/company')->detail($gybjcompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($gybjcompany['city_id'])){
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
                            if ($a = $upload->upload($attach, 'gybjcompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
				
                if ($banner_id = K::M('gybjcompany/banner')->create($data)) {
                    $this->err->add('添加内容成功');
					$this->err->set_data('forward','?gybjcompany/banner-gybjcompany-'.$gybjcompany_id.'.html');
                }
            }
        } else {
			$this->pagedata['gybjcompany_id'] = $gybjcompany_id;
            $this->tmpl = 'admin:gybjcompany/banner/create.html';
        }
    }

    public function edit($banner_id = null)
    {
        if (!($banner_id = (int) $banner_id) && !($banner_id = $this->GP('banner_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('gybjcompany/banner')->detail($banner_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if (!$gybjcompany = K::M('gybjcompany/company')->detail($detail['gybjcompany_id'])) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$this->check_city($gybjcompany['city_id'])){
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
                            if ($a = $upload->upload($attach, 'gybjcompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
                unset($data['gybjcompany_id'],$data['banner_id']);
                if (K::M('gybjcompany/banner')->update($banner_id, $data)) {
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward','?gybjcompany/banner-gybjcompany-'.$detail['gybjcompany_id'].'.html');
                }
            }
        } else {
            if ($gybjcompany_id = $detail['gybjcompany_id']) {
                $this->pagedata['gybjcompany'] = K::M('gybjcompany/company')->detail($gybjcompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:gybjcompany/banner/edit.html';
        }
    }

    public function delete($banner_id = null)
	{
		if($banner_id = (int)$banner_id){
            if($banner = K::M('gybjcompany/banner')->detail($banner_id)){
				if(!$gybjcompany = K::M('gybjcompany/company')->detail($banner['gybjcompany_id'])){
					 $this->err->add('该公司不存在或已经删除', 403);
				}else if(!$this->check_city($gybjcompany['city_id'])){
					 $this->err->add('不可越权操作', 403);
				}else if(K::M('gybjcompany/banner')->delete($banner_id)){
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('banner_id')){
            if($items = K::M('gybjcompany/banner')->items_by_ids($ids)){
                $aids  =  array();
                foreach($items as $k => $v){
                    if($gybjcompany_id = $v['gybjcompany_id']){
                        break;
                    }
                }
                if(!$gybjcompany = K::M('gybjcompany/company')->detail($gybjcompany_id)){
                    $this->err->add('该公司不存在或已经删除', 403);
                }else if(!$this->check_city($gybjcompany['city_id'])){
                     $this->err->add('不可越权操作', 403);
                }else{
                    foreach($items as $val){
                        if($val['gybjcompany_id'] == $gybjcompany_id){
                            $aids[$val['banner_id']] = $val['banner_id'];
                        }
                    }
                    if($aids && K::M('gybjcompany/banner')->delete($aids)){
                        $this->err->add('批量删除成功');
                    }
                }                
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}
