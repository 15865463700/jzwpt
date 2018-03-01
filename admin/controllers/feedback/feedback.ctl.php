<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: comment.ctl.php 3053 2017-04-28 04:00:13Z liangxu $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Feedback_Feedback extends Ctl {
	public function index(){
            $filter = $pager = array();
            $pager['page'] = max(intval($page), 1);
            $pager['limit'] = $limit = 20;
            $filter['feedback_id'] = $feedback_id;
            if(CITY_ID){
                $filter['city_id'] = CITY_ID;
            }
            if($items = K::M('feedback/feedback')->items($filter, null, $page, $limit, $count)){
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($feedback_id, '{page}')), array('SO'=>$SO));
            }
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
            $this->pagedata['feedback_id'] = $feedback_id;
            //$this->pagedata['diary'] = $detail;
            //$this->pagedata['status'] = K::M('home/site')->get_status();
            //var_dump($this->pagedata['status']);die;
            $this->tmpl = 'admin:feedback/item/items.html';
		 //    $filter = $pager = array();
   //          $pager['page'] = max(intval($page), 1);
   //          $pager['limit'] = $limit = 5;
   //          $filter['feedback_id'] = $feedback_id;
   //          if($items = K::M('feedback/feedback')->items($filter, null, $page, $limit, $count)){
   //              $pager['count'] = $count;
   //              $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($feedback_id, '{page}')), array('SO'=>$SO));
   //          }
   //          $this->pagedata['items'] = $items;
   //          $this->pagedata['pager'] = $pager;
   //          $this->pagedata['feedback_id'] = $feedback_id;
   //          $this->pagedata['diary'] = $detail;
   //          $this->pagedata['status'] = K::M('home/site')->get_status();
			// $this->tmpl = 'admin:feedback/item/items.html';
	}
    public function delete($feedback_id = null) {
        if($feedback_id = (int)$feedback_id){
            if($diary = K::M('feedback/feedback')->detail($feedback_id)){
                if(!$this->check_city($diary['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('feedback/feedback')->delete($feedback_id)){
                    $this->err->add('删除反馈成功');
                }
            }
        }else if($ids = $this->GP('feedback_id')){
            if($items = K::M('feedback/feedback')->items_by_ids($ids)){
                $aids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['feedback_id']] = $v['feedback_id'];
                }
                //var_dump($aids);die;
                if($aids && K::M('feedback/feedback')->delete($aids)){
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }
    public function edit($feedback_id = null) {

        if (!($feedback_id = (int) $feedback_id) && !($feedback_id = $this->GP('feedback_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('feedback/feedback')->detail($feedback_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        } else if ($this->checksubmit('data')) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if (K::M('feedback/feedback')->update($feedback_id, $data)) {
                    $this->err->add('修改内容成功');
                    $this->err->set_data('forward', $this->mklink('feedback/feedback:index'));
                }
            }
        } else {
            $detail = K::M('feedback/feedback')->detail($feedback_id);

            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:feedback/item/edit.html';
        }
    }
    public function auditup($feedback_id = null) {
        if ($feedback_id = (int) $feedback_id) {
            if (K::M('feedback/feedback')->update($feedback_id, array('status' => 1))) {
                $this->err->add('审核成功');
            }
        } else if ($ids = $this->GP('feedback_id')) {
            if (K::M('feedback/feedback')->batch($ids, array('status' => 1))) {
                $this->err->add('审核成功');
            }
        } else {
            $this->err->add('未指定要审核的ID', 401);
        }
    }
}