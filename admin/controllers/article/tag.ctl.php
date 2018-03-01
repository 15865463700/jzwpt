<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: tag.ctl.php 2907 2014-01-08 08:00:55Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Article_Tag extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 20;
//        if($SO = $this->GP('SO')){
//            $pager['SO'] = $SO;
//            if($SO['tag_id']){$filter['tag_id'] = $SO['tag_id'];}
//            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
//            if($SO['tag']){$filter['tag'] = "LIKE:%".$SO['tag']."%";}
//            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1])+86400;$filter['dateline'] = $a."~".$b;}}
//        }
//        if($items = K::M('article/tag')->items($filter, null, $page, $limit, $count)){
//        	$pager['count'] = $count;
//        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mktag(null, array('{page}')), array('SO'=>$SO));;
//        }
//        $this->pagedata['items'] = $items;
//        $this->pagedata['pager'] = $pager;

//        $rs = K::M('article/tag')->refresh();
//        K::M('article/tag')->check("1,2,3,4");

//        $cat_ids=K::M('article/cate')->children_ids(0);
//        K::M('article/tag')->check("foo,goo",0,$cat_ids);
//        die;

        $count=0;
        if($items = K::M('article/tag')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
            $this->pagedata['items'] = $items;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->tmpl = 'admin:article/tag/items.html';
    }

    public function so(){
        $this->tmpl = 'admin:article/tag/so.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if($tag_id = K::M('article/tag')->create($data)){
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?article/tag-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:article/tag/create.html';
        }
    }

    public function edit($tag_id=null)
    {
        if(!($tag_id = (int)$tag_id) && !($tag_id = $this->GP('tag_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('article/tag')->detail($tag_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if(K::M('article/tag')->update($tag_id, $data)){
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:article/tag/edit.html';
        }
    }

    public function delete($tag_id)
    {
        if($tag_id = (int)$tag_id){
            if(K::M('article/tag')->delete($tag_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('tag_id')){
            if(K::M('article/tag')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}