<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: comment.ctl.php 6077 2014-08-13 13:48:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Rzpscompany_Comment extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['rzpscompany_id']){$filter['rzpscompany_id'] = $SO['rzpscompany_id'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['audit']){$filter['audit'] = $SO['audit'];}
        }
        $uids = $rzpscompanyIds = array();
		$filter['closed'] = 0;
		if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('rzpscompany/comment')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
               if(!empty($v['uid'])) $uids[$v['uid']] = $v['uid'];
               if(!empty($v['rzpscompany_id']))  $rzpscompanyIds[$v['rzpscompany_id']] = $v['rzpscompany_id'];
                  $items[$k]['clientip'] = $v['clientip'].'('. K::M("misc/location")->location($v['clientip']) .')';
            } 
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
		$this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->system->config->get('rzpscompany_comment');
        $this->tmpl = 'admin:rzpscompany/comment/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:rzpscompany/comment/so.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(!$rzpscompany_id = (int)$data['company_id']){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$rzpscompany = K::M('rzpscompany/company')->detail($rzpscompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($rzpscompany['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else{
                $data['replytime'] = __TIME + rand(1000,86400);
                $data['replyip']   = __IP;
				if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }
                if($id = K::M('rzpscompany/comment')->create($data)){
                    K::M('rzpscompany/comment')->comment_count($rzpscompany['company_id']);
					K::M('rzpscompany/comment')->comment($data);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?rzpscompany/comment-index.html');
                }
            } 
        }else{
           $this->pagedata['score'] =$this->system->config->get('score');
           $this->tmpl = 'admin:rzpscompany/comment/create.html';
        }
    }
   
    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('rzpscompany/comment')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
				unset($data['city_id']);
                if(K::M('rzpscompany/comment')->update($id, $data)){
                    
                    $count=K::M('rzpscompany/comment')->comment_count($rzpscompany['rzpscompany_id']);
					//K::M('rzpscompany/comment')->comment($data);
					
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward', '?rzpscompany/comment-index.html');
                }  
            } 
        }else{
            $city=K::M('data/city')->detail($detail['city_id']);
            $detail["city_name"]=$city["city_name"];
        	$this->pagedata['detail'] = $detail;
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->detail($uid);
            }
            if($rzpscompany_id = $detail['company_id']){
                $this->pagedata['rzpscompany'] = K::M('rzpscompany/company')->detail($rzpscompany_id);
            }
             $this->pagedata['score'] =$this->system->config->get('score');
        	$this->tmpl = 'admin:rzpscompany/comment/edit.html';
        }
    }

	public function audit($id = null)
    {
        if ($id = (int) $id) { 
			if($comment = K::M('rzpscompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('rzpscompany/comment')->update($id,array('audit'=>1))){
                    $this->err->add('审核成功');
                }
			}
        } else if ($ids = $this->GP('comment_id')) {
			if($items = K::M('rzpscompany/comment')->items_by_ids($ids)){
                $aids = $rzpscompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $rzpscompany_ids[$v['rzpscompany_id']] = $v['rzpscompany_id'];
                }
                if($aids && K::M('rzpscompany/comment')->batch($aids,array('audit'=>1))){
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
			if($comment = K::M('rzpscompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('rzpscompany/comment')->delete($id)){
                    K::M('rzpscompany/comment')->comment_count($comment['rzpscompany_id']);
                    K::M('rzpscompany/comment')->comment_del($comment);
                    $this->err->add('删除成功');
                }
			}
        }else if($ids = $this->GP('comment_id')){
			if($items = K::M('rzpscompany/comment')->items_by_ids($ids)){
                $aids = $rzpscompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $rzpscompany_ids[$v['rzpscompany_id']] = $v['rzpscompany_id'];
                    K::M('rzpscompany/comment')->comment_del($v);
                }
                if($aids && K::M('rzpscompany/comment')->delete($aids)){
                    K::M('rzpscompany/comment')->comment_count($rzpscompany_ids);
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }

    }

}