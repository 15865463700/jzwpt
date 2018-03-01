<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: comment.ctl.php 6077 2014-08-13 13:48:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Jtyjycompany_Comment extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['jtyjycompany_id']){$filter['jtyjycompany_id'] = $SO['jtyjycompany_id'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['audit']){$filter['audit'] = $SO['audit'];}
        }
        $uids = $jtyjycompanyIds = array();
		$filter['closed'] = 0;
		if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('jtyjycompany/comment')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
               if(!empty($v['uid'])) $uids[$v['uid']] = $v['uid'];
               if(!empty($v['jtyjycompany_id']))  $jtyjycompanyIds[$v['jtyjycompany_id']] = $v['jtyjycompany_id'];
                  $items[$k]['clientip'] = $v['clientip'].'('. K::M("misc/location")->location($v['clientip']) .')';
            } 
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
		$this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->system->config->get('jtyjycompany_comment');
        $this->tmpl = 'admin:jtyjycompany/comment/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:jtyjycompany/comment/so.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(!$jtyjycompany_id = (int)$data['company_id']){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$jtyjycompany = K::M('jtyjycompany/company')->detail($jtyjycompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($jtyjycompany['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else{
                $data['replytime'] = __TIME + rand(1000,86400);
                $data['replyip']   = __IP;
				if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }
                if($id = K::M('jtyjycompany/comment')->create($data)){
                    K::M('jtyjycompany/comment')->comment_count($jtyjycompany['jtyjycompany_id']);
					K::M('jtyjycompany/comment')->comment($data);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?jtyjycompany/comment-index.html');
                }
            } 
        }else{
           $this->pagedata['score'] =$this->system->config->get('score');
           $this->tmpl = 'admin:jtyjycompany/comment/create.html';
        }
    }
   
    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('jtyjycompany/comment')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
				unset($data['city_id']);
                if(K::M('jtyjycompany/comment')->update($id, $data)){
                    
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward', '?jtyjycompany/comment-index.html');
                }  
            } 
        }else{
            $city=K::M('data/city')->detail($detail['city_id']);
            $detail["city_name"]=$city["city_name"];
        	$this->pagedata['detail'] = $detail;
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->detail($uid);
            }
            if($jtyjycompany_id = $detail['company_id']){
                $this->pagedata['jtyjycompany'] = K::M('jtyjycompany/company')->detail($jtyjycompany_id);
            }
             $this->pagedata['score'] =$this->system->config->get('score');
        	$this->tmpl = 'admin:jtyjycompany/comment/edit.html';
        }
    }

	public function audit($id = null)
    {
        if ($id = (int) $id) { 
			if($comment = K::M('jtyjycompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('jtyjycompany/comment')->update($id,array('audit'=>1))){
                    $this->err->add('审核成功');
                }
			}
        } else if ($ids = $this->GP('comment_id')) {
			if($items = K::M('jtyjycompany/comment')->items_by_ids($ids)){
                $aids = $jtyjycompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $jtyjycompany_ids[$v['jtyjycompany_id']] = $v['jtyjycompany_id'];
                }
                if($aids && K::M('jtyjycompany/comment')->batch($aids,array('audit'=>1))){
                    $this->err->add('批量审核成功');
                }
            }
        } else {
            $this->err->add('未指定要审核的ID', 401);
        }
    }

    public function delete($id=null)
    {
        if($id = (int)$id){
			if($comment = K::M('jtyjycompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('jtyjycompany/comment')->delete($id)){
                    K::M('jtyjycompany/comment')->comment_count($comment['jtyjycompany_id']);
                    K::M('jtyjycompany/comment')->comment_del($comment);
                    $this->err->add('删除成功');
                }
			}
        }else if($ids = $this->GP('comment_id')){
			if($items = K::M('jtyjycompany/comment')->items_by_ids($ids)){
                $aids = $jtyjycompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $jtyjycompany_ids[$v['jtyjycompany_id']] = $v['jtyjycompany_id'];
                    K::M('jtyjycompany/comment')->comment_del($v);
                }
                if($aids && K::M('jtyjycompany/comment')->delete($aids)){
                    K::M('jtyjycompany/comment')->comment_count($jtyjycompany_ids);
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }

    }

}