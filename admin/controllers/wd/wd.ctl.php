<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: comment.ctl.php 3053 2017-04-28 04:00:13Z liangxu $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Wd_Wd extends Ctl {

    public function index($page=1){
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
//            $filter['wd_id'] = $wd_id;
//            if(CITY_ID){
//                $filter['city_id'] = CITY_ID;
//            }
        $count=0;
        if($items = K::M('wd/wd')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
        }
        $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
//            $this->pagedata['wd_id'] = $wd_id;
        //$this->pagedata['diary'] = $detail;
        //$this->pagedata['status'] = K::M('home/site')->get_status();
        //var_dump($this->pagedata['status']);die;
        $this->tmpl = 'admin:wd/items.html';
        //    $filter = $pager = array();
        //          $pager['page'] = max(intval($page), 1);
        //          $pager['limit'] = $limit = 5;
        //          $filter['wd_id'] = $wd_id;
        //          if($items = K::M('wd/wd')->items($filter, null, $page, $limit, $count)){
        //              $pager['count'] = $count;
        //              $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($wd_id, '{page}')), array('SO'=>$SO));
        //          }
        //          $this->pagedata['items'] = $items;
        //          $this->pagedata['pager'] = $pager;
        //          $this->pagedata['wd_id'] = $wd_id;
        //          $this->pagedata['diary'] = $detail;
        //          $this->pagedata['status'] = K::M('home/site')->get_status();
        // $this->tmpl = 'admin:feedback/item/items.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 211);
            }else{
                $wd_id = K::M('wd/wd')->create($data);
                if($wd_id){
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('wd/wd:index'));
                }
            }
        }else{
            $this->tmpl = 'admin:wd/create.html';
        }
    }

    public function edit($wd_id = null) {

        if (!($wd_id = (int) $wd_id) && !($wd_id = $this->GP('wd_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('wd/wd')->detail($wd_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        } else if ($this->checksubmit('data')) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if (K::M('wd/wd')->update($wd_id, $data)) {
                    $this->err->add('修改内容成功');
                    $this->err->set_data('forward', $this->mklink('wd/wd:index'));
                }
            }
        } else {
            $detail = K::M('wd/wd')->detail($wd_id);

            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:wd/edit.html';
        }
    }

    public function delete($wd_id = null) {
        if($wd_id = (int)$wd_id){
            if($diary = K::M('wd/wd')->detail($wd_id)){
                if(!$this->check_city($diary['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('wd/wd')->delete($wd_id)){
                    $this->err->add('删除反馈成功');
                }
            }
        }else if($ids = $this->GP('wd_id')){
            if($items = K::M('wd/wd')->items_by_ids($ids)){
                $aids = array();
                if($aids && K::M('wd/wd')->delete($aids)){
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

    public function auditup($wd_id = null) {
        if ($wd_id = (int) $wd_id) {
            if (K::M('wd/wd')->update($wd_id, array('status' => 1))) {
                $this->err->add('审核成功');
            }
        } else if ($ids = $this->GP('wd_id')) {
            if (K::M('wd/wd')->batch($ids, array('status' => 1))) {
                $this->err->add('审核成功');
            }
        } else {
            $this->err->add('未指定要审核的ID', 401);
        }
    }

}
