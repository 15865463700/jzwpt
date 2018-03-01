<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: photo.ctl.php 2034 2013-12-07 03:08:33Z $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Rzpscompany_Photo extends Ctl
{


    public function rzpscompany($rzpscompany_id, $page=1)
    {
        if(!$rzpscompany_id = (int)$rzpscompany_id){
            $this->err->add('未指定公司', 212);
        }else if(!$rzpscompany = K::M('rzpscompany/company')->detail($rzpscompany_id)){
            $this->err->add('您选的公司不存在或已经删除', 213);
        }else if(!$this->check_city($rzpscompany['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else{
            $filter = $pager = array();
            $pager['page'] = max(intval($page), 1);
            $pager['limit'] = $limit = 50;
            $pager['count'] = $count = 0;
            $filter = array('rzpscompany_id'=>$rzpscompany_id);
            if ($items = K::M('rzpscompany/photo')->items($filter, null, $page, $limit, $count)) {
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
            }
			$this->pagedata['rzpscompany_list'] = K::M('rzpscompany/company')->items_by_ids($rzpscompany_id);
			$this->pagedata['rzpscompany_id'] = $rzpscompany_id;
            $this->pagedata['rzpscompany'] = $rzpscompany;
            $this->pagedata['pager'] = $pager;
			$this->pagedata['type'] = K::M('rzpscompany/photo')->get_type_means();
            $this->pagedata['items'] = $items;
            $this->tmpl = 'admin:rzpscompany/photo/rzpscompany.html';
        }
    }

    public function create($rzpscompany_id)
    {
        if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            }else if(!$rzpscompany_id){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$rzpscompany = K::M('rzpscompany/company')->detail($rzpscompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($rzpscompany['city_id'])){
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
                            if ($a = $upload->upload($attach, 'rzpscompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
                if ($photo_id = K::M('rzpscompany/photo')->create($data)) {
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward','?rzpscompany/photo-rzpscompany-'.$rzpscompany_id.'.html');
                }
            }
        } else {
			$this->pagedata['rzpscompany_id'] = $rzpscompany_id;
            $this->pagedata['type'] = K::M('rzpscompany/photo')->get_type_means();
            $this->tmpl = 'admin:rzpscompany/photo/create.html';
        }
    }

    public function edit($photo_id = null)
    {
        if (!($photo_id = (int) $photo_id) && !($photo_id = $this->GP('photo_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('rzpscompany/photo')->detail($photo_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$rzpscompany = K::M('rzpscompany/company')->detail($detail['rzpscompany_id'])){
            $this->err->add('该公司不存在或已被删除', 403);
        }else if(!$this->check_city($rzpscompany['city_id'])){
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
                unset($data['rzpscompany_id'],$data['photo_id']);
                if (K::M('rzpscompany/photo')->update($photo_id, $data)) {
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward','?rzpscompany/photo-rzpscompany-'.$detail['rzpscompany_id'].'.html');
                }
            }
        } else {
            if($rzpscompany_id = $detail['rzpscompany_id']){
                $this->pagedata['rzpscompany'] = K::M('rzpscompany/company')->detail($rzpscompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->pagedata['type'] = K::M('rzpscompany/photo')->get_type_means();
            $this->tmpl = 'admin:rzpscompany/photo/edit.html';
        }
    }

    public function delete($photo_id = null)
    {

		if($photo_id = (int)$photo_id){
            if($photo = K::M('rzpscompany/photo')->detail($photo_id)){
				if(!$rzpscompany = K::M('rzpscompany/company')->detail($photo['rzpscompany_id'])){
					 $this->err->add('该公司不存在或已经删除', 403);
				}else if(!$this->check_city($rzpscompany['city_id'])){
					 $this->err->add('不可越权操作', 403);
				}else if(K::M('rzpscompany/photo')->delete($photo_id)){
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('photo_id')){
           if($items = K::M('rzpscompany/photo')->items_by_ids($ids)){
                $aids  =  array();
                foreach($items as $k => $v){
                    if($rzpscompany_id = $v['rzpscompany_id']){
                        break;
                    }
                }
                if(!$rzpscompany = K::M('rzpscompany/company')->detail($rzpscompany_id)){
                    $this->err->add('该公司不存在或已经删除', 403);
                }else if(!$this->check_city($rzpscompany['city_id'])){
                     $this->err->add('不可越权操作', 403);
                }else{
                    foreach($items as $val){
                        if($val['rzpscompany_id'] == $rzpscompany_id){
                            $aids[$val['photo_id']] = $val['photo_id'];
                        }
                    }
                    if($aids && K::M('rzpscompany/photo')->delete($aids)){
                        $this->err->add('批量删除成功');
                    }
                }                
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}
