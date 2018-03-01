<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Topics_Topics extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['topics_id']){$filter['topics_id'] = $SO['topics_id'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['name']){$filter['name'] = $SO['name'];}
        }
        if($items = K::M('topics/topics')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
		$this->pagedata['zq'] =K::M('topics/topics')->get_zq();
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:topics/topics/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:topics/topics/so.html';
    }



    public function edit($topics_id=null)
    {
        if(!($topics_id = (int)$topics_id) && !($topics_id = $this->GP('topics_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('topics/topics')->detail($topics_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($data = $this->checksubmit('data')){
                    if($_FILES['data']){
            foreach($_FILES['data'] as $k=>$v){
                foreach($v as $kk=>$vv){
                    $attachs[$kk][$k] = $vv;
                }
            }
            $upload = K::M('magic/upload');
            foreach($attachs as $k=>$attach){
                if($attach['error'] == UPLOAD_ERR_OK){
                    if($a = $upload->upload($attach, 'topics')){
                        $data[$k] = $a['photo'];
                    }
                }
            }
        }

            if(K::M('topics/topics')->update($topics_id, $data)){
                $this->err->add('修改内容成功');
            }  
        }else{
			$this->pagedata['education'] =K::M('topics/topics')->get_education();
			$this->pagedata['marriage'] =K::M('topics/topics')->get_marriage();
            $this->pagedata['detail'] = $detail;
			$this->pagedata['home'] =K::M('topics/topics')->get_home_relationship();
			$this->pagedata['other'] =K::M('topics/topics')->get_other_relationship();
			$this->pagedata['bank'] =K::M('topics/topics')->get_bank();
			$this->pagedata['zq'] =K::M('topics/topics')->get_zq();
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:topics/topics/edit.html';
        }
    }

   

    public function delete($topics_id=null)
    {
        if($topics_id = (int)$topics_id){
            if(!$detail = K::M('topics/topics')->detail($topics_id)){
                $this->err->add('你要删除的内容不存在或已经删除', 211);
            }else{
                if(K::M('topics/topics')->delete($topics_id)){
                    $this->err->add('删除内容成功');
                }
            }
        }else if($ids = $this->GP('topics_id')){
            if(K::M('topics/topics')->delete($ids)){
                $this->err->add('批量删除内容成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

    public function lixi()
    {
        $zq_list = K::M('topics/topics')->get_zq();
        #vdp($zq_list);die;
        $this->tmpl = 'admin:topics/topics/lixi.html';
    }
}