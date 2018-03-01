<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: news.ctl.php 6077 2014-08-13 13:48:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Afzncompany_News extends Ctl
{
    
    public function index($page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['afzncompany_id']){$filter['afzncompany_id'] = $SO['afzncompany_id'];}
            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
            if(is_numeric($SO['audit'])){$filter['audit'] = $SO['audit'];}
        }
        $afzncompanyIds = array();
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('afzncompany/news')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
               if(!empty($v['company_id'])){
                   $afzncompanyIds[$v['company_id']] = $v['company_id'];
               }
                $items[$k]['clientip'] = $v['clientip'].'('. K::M("misc/location")->location($v['clientip']) .')';
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $afzncompany_list=K::M('afzncompany/company')->items_by_ids($afzncompanyIds);
        $this->pagedata['afzncompany_list'] = $afzncompany_list;
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:afzncompany/news/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:afzncompany/news/so.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 211);
            }else if(!$afzncompany_id = (int)$data['afzncompany_id']){
                $this->err->add('未选要发布到的公司', 212);
            }else if(!$afzncompany = K::M('afzncompany/company')->detail($afzncompany_id)){
                $this->err->add('您选的公司不存在或已经删除', 213);
            }else if(!$this->check_city($afzncompany['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else{
                $data['city_id'] = $afzncompany['city_id'];
                if($news_id = K::M('afzncompany/news')->create($data)){
                    K::M('afzncompany/news')->news_count($afzncompany['afzncompany_id']);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?afzncompany/news-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:afzncompany/news/create.html';
        }
    }

    public function edit($news_id=null)
    {
        if(!($news_id = (int)$news_id) && !($news_id = $this->GP('news_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('afzncompany/news')->detail($news_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                unset($data['city_id']);
                if(K::M('afzncompany/news')->update($news_id, $data)){
                    $this->err->add('修改内容成功');
                    $this->err->set_data('forward', '?afzncompany/news-index.html');
                }  
            } 
        }else{
            if($afzncompany_id = $detail['company_id']){
                $this->pagedata['afzncompany'] = K::M('afzncompany/company')->detail($afzncompany_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:afzncompany/news/edit.html';
        }
    }

    public function doaudit($news_id=null)
    {
        if($news_id = (int)$news_id){
            if(K::M('afzncompany/news')->batch($news_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('news_id')){
            if(K::M('afzncompany/news')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($news_id=null)
    {
        if($news_id = (int)$news_id){
            if($news = K::M('afzncompany/news')->detail($news_id)){
                if(!$this->check_city($news['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('afzncompany/news')->delete($news_id)){
                    K::M('afzncompany/news')->news_count($news['afzncompany_id']);
                    $this->err->add('删除公司新闻成功');
                }
            }
        }else if($ids = $this->GP('news_id')){
            if($items = K::M('afzncompany/news')->items_by_ids($ids)){
                $aids = $afzncompany_ids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['news_id']] = $v['news_id'];
                    $afzncompany_ids[$v['afzncompany_id']] = $v['afzncompany_id'];
                }
                if($aids && K::M('afzncompany/news')->delete($aids)){
                    K::M('afzncompany/news')->news_count($afzncompany_ids);
                    $this->err->add('批量删除公司新闻成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}