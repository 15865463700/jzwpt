<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Price_Attrfrom extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['pricefrom_id']){$filter['pricefrom_id'] = $SO['pricefrom_id'];}
        }
        if($items = K::M('price/attrfrom')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:price/attr/form/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:price/attr/form/so.html';
    }

    public function detail($pricefrom_id = null)
    {
        if(!$pricefrom_id = (int)$pricefrom_id){
            $this->err->add('未指定要查看内容的ID', 211);
        }else if(!$detail = K::M('price/attrfrom')->detail($pricefrom_id)){
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        }else{
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:price/attr/form/detail.html';
        }
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if($pricefrom_id = K::M('price/attrfrom')->create($data)){
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?price/attrfrom-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:price/attr/form/create.html';
        }
    }

    public function edit($pricefrom_id=null)
    {
        if(!($pricefrom_id = (int)$pricefrom_id) && !($pricefrom_id = $this->GP('pricefrom_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('price/attrfrom')->detail($pricefrom_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if(K::M('price/attrfrom')->update($pricefrom_id, $data)){
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:price/attr/form/edit.html';
        }
    }

    public function doaudit($pricefrom_id=null)
    {
        if($pricefrom_id = (int)$pricefrom_id){
            if(K::M('price/attrfrom')->batch($pricefrom_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('pricefrom_id')){
            if(K::M('price/attrfrom')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($pricefrom_id=null)
    {
        if($pricefrom_id = (int)$pricefrom_id){
            if(K::M('price/attrfrom')->delete($pricefrom_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('pricefrom_id')){
            if(K::M('price/attrfrom')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}