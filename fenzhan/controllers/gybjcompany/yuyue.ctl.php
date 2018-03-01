<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: yuyue.ctl.php 5681 2014-06-26 11:33:16Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Gybjcompany_Yuyue extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['gybjcompany_id']){$filter['gybjcompany_id'] = $SO['gybjcompany_id'];}
            if($SO['mobile']){$filter['mobile'] = "LIKE:%".$SO['mobile']."%";}
            if($SO['contact']){$filter['contact'] = "LIKE:%".$SO['contact']."%";}
            if(is_numeric($SO['status'])){$filter['status'] = $SO['status'];}
        }
		if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('gybjcompany/yuyue')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
               if(!empty($v['uid'])) $uids[$v['uid']] = $v['uid'];
               if(!empty($v['company_id']))  $gybjcompanyIds[$v['company_id']] = $v['company_id'];
                  $items[$k]['clientip'] = $v['clientip'].'('. K::M("misc/location")->location($v['clientip']) .')';
            } 
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
		$this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        $gybjcompany_list=K::M('gybjcompany/company')->items_by_ids($gybjcompanyIds);
        $this->pagedata['gybjcompany_list'] = $gybjcompany_list;
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:gybjcompany/yuyue/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:gybjcompany/yuyue/so.html';
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
				if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }
                if($yuyue_id = K::M('gybjcompany/yuyue')->create($data)){
					//K::M('gybjcompany/yuyue')->yuyue_count($gybjcompany['gybjcompany_id']);
					K::M('gybjcompany/company')->update($gybjcompany['gybjcompany_id'], array('yuyue_num'=>$gybjcompany['yuyue_num']+1));
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?gybjcompany/yuyue-index.html');
                }
            } 
        }else{
            
           $this->tmpl = 'admin:gybjcompany/yuyue/create.html';
        }
    }

    public function edit($yuyue_id=null)
    {
        if(!($yuyue_id = (int)$yuyue_id) && !($yuyue_id = $this->GP('yuyue_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('gybjcompany/yuyue')->detail($yuyue_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                unset($data['gybjcompany_id'], $data['city_id']);
                if(K::M('gybjcompany/yuyue')->update($yuyue_id, $data)){
                    $this->err->add('修改内容成功');
					$this->err->set_data('forward', '?gybjcompany/yuyue-index.html');
                }  
            } 
        }else{
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->detail($uid);
            }
            if($gybjcompany_id = $detail['gybjcompany_id']){
                $this->pagedata['gybjcompany'] = K::M('gybjcompany/company')->detail($gybjcompany_id);
            }
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:gybjcompany/yuyue/edit.html';
        }
    }

    public function detail($yuyue_id=null)
    {
        if(!($yuyue_id = (int)$yuyue_id) && !($yuyue_id = $this->GP('yuyue_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('gybjcompany/yuyue')->detail($yuyue_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else{
            if($uid = (int)$detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->detail($uid);
            }
            if($gybjcompany_id = $detail['gybjcompany_id']){
                $this->pagedata['gybjcompany'] = K::M('gybjcompany/company')->detail($gybjcompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:gybjcompany/yuyue/detail.html';
        }        
    }

    public function delete($yuyue_id=null)
    {
		if($yuyue_id = (int)$yuyue_id){
            if($yuyue = K::M('gybjcompany/yuyue')->detail($yuyue_id)){
                if(!$this->check_city($yuyue['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('gybjcompany/yuyue')->delete($yuyue_id)){
                    //K::M('gybjcompany/yuyue')->yuyue_count($yuyue['gybjcompany_id']);
                    $this->err->add('删除公司新闻成功');
                }
            }
        }else if($ids = $this->GP('yuyue_id')){
            if($items = K::M('gybjcompany/yuyue')->items_by_ids($ids)){
                $aids = $gybjcompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['yuyue_id']] = $v['yuyue_id'];
                    $gybjcompany_ids[$v['gybjcompany_id']] = $v['gybjcompany_id'];
                }
                if($aids && K::M('gybjcompany/yuyue')->delete($aids)){
                    //K::M('gybjcompany/yuyue')->yuyue_count($gybjcompany_ids);
                    $this->err->add('批量删除公司新闻成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}