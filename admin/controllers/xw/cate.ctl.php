<?php
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Xw_Cate extends Ctl
{
   
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;

        if($items = K::M('xw/cate')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));;
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['tree'] = K::M('xw/cate')->tree();
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:xw/cate/items.html';
    }

    public function create($parent_id=null)
    {
        if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if($cat_id = K::M('xw/cate')->create($data)){
                $this->err->add('添加分类成功');
                $this->err->set_data('forward', '?xw/cate-index.html');
            }
        }else{
            $pager['parent_id'] = intval($parent_id);
            $this->pagedata['pager'] = $pager;
            $this->pagedata['tree'] = K::M('xw/cate')->tree();
            $this->tmpl = 'admin:xw/cate/create.html';
        }
    }

    public function edit($cat_id=null)
    {
        if(!($cat_id = (int)$cat_id) && !($cat_id = (int)$this->GP('cat_id'))){
            $this->err->add('未指要修改ID', 211);
        }else if(!$cate = K::M('xw/cate')->detail($cat_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(K::M('xw/cate')->update($cat_id, $data)){
                $this->err->add('修改内容成功');
            }
        }else{
        	$this->pagedata['cate'] = $cate;
            $this->pagedata['cate_list'] = K::M('xw/cate')->fetch_all();
        	$this->tmpl = 'admin:xw/cate/edit.html';
        }
    }

    public function update()
    {
        if($orders = $this->GP('orderby')){
            $obj = K::M('xw/cate');
            foreach($orders as $k=>$v){
                $obj->update($k, array('orderby'=>$v));
            }
            $this->err->add('更新数据成功');
        }
    }

    public function delete($cat_id=null)
    {
        if($cat_id = (int)$cat_id){
            if(K::M('xw/cate')->delete($cat_id)){
                $this->err->add('删除成功');
            }
        }else if($pks = $this->GP('cat_id')){
            if(K::M('xw/cate')->delete($pks)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }        
    }
}