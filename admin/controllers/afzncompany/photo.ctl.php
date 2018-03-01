<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: photo.ctl.php 2034 2013-12-07 03:08:33Z $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Afzncompany_Photo extends Ctl
{


    public function afzncompany($afzncompany_id, $page=1)
    {
        if(!$afzncompany_id = (int)$afzncompany_id){
            $this->err->add('未指定公司', 212);
        }else if(!$afzncompany = K::M('afzncompany/company')->detail($afzncompany_id)){
            $this->err->add('您选的公司不存在或已经删除', 213);
        }else if(!$this->check_city($afzncompany['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else{
            $filter = $pager = array();
            $pager['page'] = max(intval($page), 1);
            $pager['limit'] = $limit = 50;
            $pager['count'] = $count = 0;
            $filter = array('afzncompany_id'=>$afzncompany_id);
            if ($items = K::M('afzncompany/photo')->items($filter, null, $page, $limit, $count)) {
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
            }
			$this->pagedata['afzncompany_list'] = K::M('afzncompany/company')->items_by_ids($afzncompany_id);
			$this->pagedata['afzncompany_id'] = $afzncompany_id;
            $this->pagedata['afzncompany'] = $afzncompany;
            $this->pagedata['pager'] = $pager;
			$this->pagedata['type'] = K::M('afzncompany/photo')->get_type_means();
            $this->pagedata['items'] = $items;
            $this->tmpl = 'admin:afzncompany/photo/afzncompany.html';
        }
    }

    public function create($afzncompany_id)
    {
        if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            }else if(!$afzncompany_id){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$afzncompany = K::M('afzncompany/company')->detail($afzncompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($afzncompany['city_id'])){
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
                            if ($a = $upload->upload($attach, 'afzncompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
                if ($photo_id = K::M('afzncompany/photo')->create($data)) {
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward','?afzncompany/photo-afzncompany-'.$afzncompany_id.'.html');
                }
            }
        } else {
			$this->pagedata['afzncompany_id'] = $afzncompany_id;
            $this->pagedata['type'] = K::M('afzncompany/photo')->get_type_means();
            $this->tmpl = 'admin:afzncompany/photo/create.html';
        }
    }

    public function edit($photo_id = null)
    {
        if (!($photo_id = (int) $photo_id) && !($photo_id = $this->GP('photo_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('afzncompany/photo')->detail($photo_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$afzncompany = K::M('afzncompany/company')->detail($detail['afzncompany_id'])){
            $this->err->add('该公司不存在或已被删除', 403);
        }else if(!$this->check_city($afzncompany['city_id'])){
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
                            if ($a = $upload->upload($attach, 'afzncompany')) {
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
                unset($data['afzncompany_id'],$data['photo_id']);
                if (K::M('afzncompany/photo')->update($photo_id, $data)) {
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward','?afzncompany/photo-afzncompany-'.$detail['afzncompany_id'].'.html');
                }
            }
        } else {
            if($afzncompany_id = $detail['afzncompany_id']){
                $this->pagedata['afzncompany'] = K::M('afzncompany/company')->detail($afzncompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->pagedata['type'] = K::M('afzncompany/photo')->get_type_means();
            $this->tmpl = 'admin:afzncompany/photo/edit.html';
        }
    }

    public function delete($photo_id = null)
    {

		if($photo_id = (int)$photo_id){
            if($photo = K::M('afzncompany/photo')->detail($photo_id)){
				if(!$afzncompany = K::M('afzncompany/company')->detail($photo['afzncompany_id'])){
					 $this->err->add('该公司不存在或已经删除', 403);
				}else if(!$this->check_city($afzncompany['city_id'])){
					 $this->err->add('不可越权操作', 403);
				}else if(K::M('afzncompany/photo')->delete($photo_id)){
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('photo_id')){
           if($items = K::M('afzncompany/photo')->items_by_ids($ids)){
                $aids  =  array();
                foreach($items as $k => $v){
                    if($afzncompany_id = $v['afzncompany_id']){
                        break;
                    }
                }
                if(!$afzncompany = K::M('afzncompany/company')->detail($afzncompany_id)){
                    $this->err->add('该公司不存在或已经删除', 403);
                }else if(!$this->check_city($afzncompany['city_id'])){
                     $this->err->add('不可越权操作', 403);
                }else{
                    foreach($items as $val){
                        if($val['afzncompany_id'] == $afzncompany_id){
                            $aids[$val['photo_id']] = $val['photo_id'];
                        }
                    }
                    if($aids && K::M('afzncompany/photo')->delete($aids)){
                        $this->err->add('批量删除成功');
                    }
                }                
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}
