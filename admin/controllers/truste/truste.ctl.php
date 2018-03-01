<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Truste_Truste extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['truste_id']){$filter['truste_id'] = $SO['truste_id'];}
            if($SO['city_id']){$filter['city_id'] = $SO['city_id'];}
            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
            if($SO['contact']){$filter['contact'] = "LIKE:%".$SO['contact']."%";}
            if($SO['mobile']){$filter['mobile'] = "LIKE:%".$SO['mobile']."%";}
            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1])+86400;$filter['dateline'] = $a."~".$b;}}
        }
        if($items = K::M('truste/truste')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:truste/truste/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:truste/truste/so.html';
    }

    public function detail($truste_id = null)
    {
        if(!$truste_id = (int)$truste_id){
            $this->err->add('未指定要查看内容的ID', 211);
        }else if(!$detail = K::M('truste/truste')->detail($truste_id)){
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        }else{
            $uids = array();
            if($uid = $detail['uid']){
                $uids[$v['uid']] = $uid;
            }
            if($look_list = K::M('truste/look')->items_by_truste($truste_id, 1, 200)){
                foreach($look_list as $k=>$v){
                    $uids[$v['uid']] = $v['uid'];
                }
                $this->pagedata['look_list'] = $look_list;
            }
            if($uids){
                $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
            }
            $this->pagedata['cates'] = K::M('truste/cate')->items(array('closed'=>'0','audit'=>'1'));
            $detail['from_attr_key'] = 'truste:'.$detail['from'];
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:truste/truste/detail.html';
        }
    }
    public function edit($truste_id=null)
    {
        if(!($truste_id = (int)$truste_id) && !($truste_id = $this->GP('truste_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('truste/truste')->detail($truste_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                if(K::M('truste/truste')->update($truste_id, $data)){
					$member = K::M('member/member')->detail($detail['uid']);
                    $this->err->add('修改内容成功');
                }
            } 
        }else{
            if($uid = $detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->member($uid);
            }
			
			$this->pagedata['cates'] = K::M('truste/cate')->items(array('closed'=>'0','audit'=>'1'));
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:truste/truste/edit.html';
        }
    }

    public function doaudit($truste_id=null)
    {
        if($truste_id = (int)$truste_id){
            if(K::M('truste/truste')->batch($truste_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('truste_id')){
            if(K::M('truste/truste')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($truste_id=null)
    {
        if($truste_id = (int)$truste_id){
            if(K::M('truste/truste')->delete($truste_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('truste_id')){
            if(K::M('truste/truste')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}