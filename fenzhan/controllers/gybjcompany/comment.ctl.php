<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: comment.ctl.php 6077 2014-08-13 13:48:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Gybjcompany_Comment extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['gybjcompany_id']){$filter['gybjcompany_id'] = $SO['gybjcompany_id'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['audit']){$filter['audit'] = $SO['audit'];}
        }
        $uids = $gybjcompanyIds = array();
		$filter['closed'] = 0;
		if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('gybjcompany/comment')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
               if(!empty($v['uid'])) $uids[$v['uid']] = $v['uid'];
               if(!empty($v['gybjcompany_id']))  $gybjcompanyIds[$v['gybjcompany_id']] = $v['gybjcompany_id'];
                  $items[$k]['clientip'] = $v['clientip'].'('. K::M("misc/location")->location($v['clientip']) .')';
            } 
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
		$this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->system->config->get('gybjcompany_comment');
        $this->tmpl = 'admin:gybjcompany/comment/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:gybjcompany/comment/so.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(!$gybjcompany_id = (int)$data['gybjcompany_id']){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$gybjcompany = K::M('gybjcompany/company')->detail($gybjcompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($gybjcompany['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else{
                $data['replytime'] = __TIME + rand(1000,86400);
                $data['replyip']   = __IP;
				if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }
                if($id = K::M('gybjcompany/comment')->create($data)){
                    K::M('gybjcompany/comment')->comment_count($gybjcompany['gybjcompany_id']);
					K::M('gybjcompany/comment')->comment($data);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?gybjcompany/comment-index.html');
                }
            } 
        }else{
           $this->pagedata['score'] =$this->system->config->get('score');
           $this->tmpl = 'admin:gybjcompany/comment/create.html';
        }
    }
   
    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('gybjcompany/comment')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
				unset($data['city_id'],$data['company_id']);
                if(K::M('gybjcompany/comment')->update($id, $data)){
                    
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward', '?gybjcompany/comment-index.html');
                }  
            } 
        }else{
            $city=K::M('data/city')->detail($detail['city_id']);
            $detail["city_name"]=$city["city_name"];
        	$this->pagedata['detail'] = $detail;
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->detail($uid);
            }
            if($gybjcompany_id = $detail['company_id']){
                $this->pagedata['gybjcompany'] = K::M('gybjcompany/company')->detail($gybjcompany_id);
            }
             $this->pagedata['score'] =$this->system->config->get('score');
        	$this->tmpl = 'admin:gybjcompany/comment/edit.html';
        }
    }

	public function audit($id = null)
    {
        if ($id = (int) $id) { 
			if($comment = K::M('gybjcompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('gybjcompany/comment')->update($id,array('audit'=>1))){
                    $this->err->add('审核成功');
                }
			}
        } else if ($ids = $this->GP('comment_id')) {
			if($items = K::M('gybjcompany/comment')->items_by_ids($ids)){
                $aids = $gybjcompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $gybjcompany_ids[$v['gybjcompany_id']] = $v['gybjcompany_id'];
                }
                if($aids && K::M('gybjcompany/comment')->batch($aids,array('audit'=>1))){
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
			if($comment = K::M('gybjcompany/comment')->detail($id)){
				if(!$this->check_city($comment['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('gybjcompany/comment')->delete($id)){
                    K::M('gybjcompany/comment')->comment_count($comment['gybjcompany_id']);
                    K::M('gybjcompany/comment')->comment_del($comment);
                    $this->err->add('删除成功');
                }
			}
        }else if($ids = $this->GP('comment_id')){
			if($items = K::M('gybjcompany/comment')->items_by_ids($ids)){
                $aids = $gybjcompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['comment_id']] = $v['comment_id'];
                    $gybjcompany_ids[$v['gybjcompany_id']] = $v['gybjcompany_id'];
                    K::M('gybjcompany/comment')->comment_del($v);
                }
                if($aids && K::M('gybjcompany/comment')->delete($aids)){
                    K::M('gybjcompany/comment')->comment_count($gybjcompany_ids);
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }

    }

}