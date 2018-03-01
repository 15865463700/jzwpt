<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Price_Attrvalue extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['priceattr_value_id']){$filter['priceattr_value_id'] = $SO['priceattr_value_id'];}
        }
        if($items = K::M('price/attrvalue')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:price/attr/value/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:price/attr/value/so.html';
    }

    public function detail($priceattr_value_id = null)
    {
        if(!$priceattr_value_id = (int)$priceattr_value_id){
            $this->err->add('未指定要查看内容的ID', 211);
        }else if(!$detail = K::M('price/attrvalue')->detail($priceattr_value_id)){
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        }else{
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:price/attr/value/detail.html';
        }
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if($priceattr_value_id = K::M('price/attrvalue')->create($data)){
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?price/attrvalue-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:price/attr/value/create.html';
        }
    }

    public function edit($priceattr_value_id=null)
    {
        if(!($priceattr_value_id = (int)$priceattr_value_id) && !($priceattr_value_id = $this->GP('priceattr_value_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('price/attrvalue')->detail($priceattr_value_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if(K::M('price/attrvalue')->update($priceattr_value_id, $data)){
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:price/attr/value/edit.html';
        }
    }

    public function doaudit($priceattr_value_id=null)
    {
        if($priceattr_value_id = (int)$priceattr_value_id){
            if(K::M('price/attrvalue')->batch($priceattr_value_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('priceattr_value_id')){
            if(K::M('price/attrvalue')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($priceattr_value_id=null)
    {
        if($priceattr_value_id = (int)$priceattr_value_id){
            if(K::M('price/attrvalue')->delete($priceattr_value_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('priceattr_value_id')){
            if(K::M('price/attrvalue')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}