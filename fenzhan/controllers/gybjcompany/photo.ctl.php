<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: photo.ctl.php 2034 2013-12-07 03:08:33Z $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Gybjcompany_Photo extends Ctl
{


    public function gybjcompany($gybjcompany_id, $page=1)
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
            $pager['count'] = $count = 0;
            $filter = array('gybjcompany_id'=>$gybjcompany_id);
            if ($items = K::M('gybjcompany/photo')->items($filter, null, $page, $limit, $count)) {
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
            }
			$this->pagedata['gybjcompany_list'] = K::M('gybjcompany/company')->items_by_ids($gybjcompany_id);
			$this->pagedata['gybjcompany_id'] = $gybjcompany_id;
            $this->pagedata['gybjcompany'] = $gybjcompany;
            $this->pagedata['pager'] = $pager;
			$this->pagedata['type'] = K::M('gybjcompany/photo')->get_type_means();
            $this->pagedata['items'] = $items;
            $this->tmpl = 'admin:gybjcompany/photo/gybjcompany.html';
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
                if ($photo_id = K::M('gybjcompany/photo')->create($data)) {
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward','?gybjcompany/photo-gybjcompany-'.$gybjcompany_id.'.html');
                }
            }
        } else {
			$this->pagedata['gybjcompany_id'] = $gybjcompany_id;
            $this->pagedata['type'] = K::M('gybjcompany/photo')->get_type_means();
            $this->tmpl = 'admin:gybjcompany/photo/create.html';
        }
    }

    public function edit($photo_id = null)
    {
        if (!($photo_id = (int) $photo_id) && !($photo_id = $this->GP('photo_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('gybjcompany/photo')->detail($photo_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$gybjcompany = K::M('gybjcompany/company')->detail($detail['gybjcompany_id'])){
            $this->err->add('该公司不存在或已被删除', 403);
        }else if(!$this->check_city($gybjcompany['city_id'])){
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
                unset($data['gybjcompany_id'],$data['photo_id']);
                if (K::M('gybjcompany/photo')->update($photo_id, $data)) {
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward','?gybjcompany/photo-gybjcompany-'.$detail['gybjcompany_id'].'.html');
                }
            }
        } else {
            if($gybjcompany_id = $detail['gybjcompany_id']){
                $this->pagedata['gybjcompany'] = K::M('gybjcompany/company')->detail($gybjcompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->pagedata['type'] = K::M('gybjcompany/photo')->get_type_means();
            $this->tmpl = 'admin:gybjcompany/photo/edit.html';
        }
    }

    public function delete($photo_id = null)
    {

		if($photo_id = (int)$photo_id){
            if($photo = K::M('gybjcompany/photo')->detail($photo_id)){
				if(!$gybjcompany = K::M('gybjcompany/company')->detail($photo['gybjcompany_id'])){
					 $this->err->add('该公司不存在或已经删除', 403);
				}else if(!$this->check_city($gybjcompany['city_id'])){
					 $this->err->add('不可越权操作', 403);
				}else if(K::M('gybjcompany/photo')->delete($photo_id)){
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('photo_id')){
           if($items = K::M('gybjcompany/photo')->items_by_ids($ids)){
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
                            $aids[$val['photo_id']] = $val['photo_id'];
                        }
                    }
                    if($aids && K::M('gybjcompany/photo')->delete($aids)){
                        $this->err->add('批量删除成功');
                    }
                }                
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}
