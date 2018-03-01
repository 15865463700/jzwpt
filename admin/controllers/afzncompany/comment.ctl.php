<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: comment.ctl.php 6077 2014-08-13 13:48:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Afzncompany_Comment extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['afzncompany_id']){$filter['afzncompany_id'] = $SO['afzncompany_id'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['audit']){$filter['audit'] = $SO['audit'];}
        }
        $uids = $afzncompanyIds = array();
		$filter['closed'] = 0;
		if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('afzncompany/comment')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
               if(!empty($v['uid'])) $uids[$v['uid']] = $v['uid'];
               if(!empty($v['afzncompany_id']))  $afzncompanyIds[$v['afzncompany_id']] = $v['afzncompany_id'];
                  $items[$k]['clientip'] = $v['clientip'].'('. K::M("misc/location")->location($v['clientip']) .')';
            } 
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
		$this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->system->config->get('afzncompany_comment');
        $this->tmpl = 'admin:afzncompany/comment/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:afzncompany/comment/so.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(!$afzncompany_id = (int)$data['company_id']){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$afzncompany = K::M('afzncompany/company')->detail($afzncompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($afzncompany['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else{
                $data['replytime'] = __TIME + rand(1000,86400);
                $data['replyip']   = __IP;
				if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }
                if($id = K::M('afzncompany/comment')->create($data)){
                    K::M('afzncompany/comment')->comment_count($afzncompany['afzncompany_id']);
					K::M('afzncompany/comment')->comment($data);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?afzncompany/comment-index.html');
                }
            } 
        }else{
           $this->pagedata['score'] =$this->system->config->get('score');
           $this->tmpl = 'admin:afzncompany/comment/create.html';
        }
    }
   
    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }
        $detail = K::M('afzncompany/comment')->detail($id);
        if(!$detail){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
				unset($data['city_id']);
				$data["replyip"]=__IP;
				$data["replytime"]=time();
                if(K::M('afzncompany/comment')->update($id, $data)){
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward', '?afzncompany/comment-index.html');
                }  
            } 
        }else{
            
            $city=K::M('data/city')->detail($detail['city_id']);
            $detail["city_name"]=$city["city_name"];
            
        	$this->pagedata['detail'] = $detail;
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->detail($uid);
            }
            if($afzncompany_id = $detail['company_id']){
                $this->pagedata['afzncompany'] = K::M('afzncompany/company')->detail($afzncompany_id);
            }
             $this->pagedata['score'] =$this->system->config->get('score');
        	$this->tmpl = 'admin:afzncompany/comment/edit.html';
        }
    }

	public function audit($id = null)
    {
        if ($id = (int) $id) { 
			if($comment = K::M('afzncompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('afzncompany/comment')->update($id,array('audit'=>1))){
                    $this->err->add('审核成功');
                }
			}
        } else if ($ids = $this->GP('comment_id')) {
			if($items = K::M('afzncompany/comment')->items_by_ids($ids)){
                $aids = $afzncompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $afzncompany_ids[$v['afzncompany_id']] = $v['afzncompany_id'];
                }
                if($aids && K::M('afzncompany/comment')->batch($aids,array('audit'=>1))){
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
			if($comment = K::M('afzncompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('afzncompany/comment')->delete($id)){
                    K::M('afzncompany/comment')->comment_count($comment['afzncompany_id']);
                    K::M('afzncompany/comment')->comment_del($comment);
                    $this->err->add('删除成功');
                }
			}
        }else if($ids = $this->GP('comment_id')){
			if($items = K::M('afzncompany/comment')->items_by_ids($ids)){
                $aids = $afzncompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $afzncompany_ids[$v['afzncompany_id']] = $v['afzncompany_id'];
                    K::M('afzncompany/comment')->comment_del($v);
                }
                if($aids && K::M('afzncompany/comment')->delete($aids)){
                    K::M('afzncompany/comment')->comment_count($afzncompany_ids);
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }

    }

}