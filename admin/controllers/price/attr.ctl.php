<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Price_Attr extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['priceattr_id']){$filter['priceattr_id'] = $SO['priceattr_id'];}
        }
        if($items = K::M('price/attr')->items($filter, null, $page, $limit, $count)){
			foreach($items as $k=>$v){
				$from_list = K::M('price/attrvalue')->items(array('priceattr_id'=>$v['priceattr_id']), null, $page, $limit, $count);
				$this->pagedata['from_list'] = $from_list;
			}
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
		$this->pagedata['from_list'] = K::M('price/attrfrom')->fetch_all();
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:price/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:price/so.html';
    }
/*
    public function detail($priceattr_id = null)
    {
        if(!$priceattr_id = (int)$priceattr_id){
            $this->err->add('未指定要查看内容的ID', 211);
        }else if(!$detail = K::M('price/attr')->detail($priceattr_id)){
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        }else{
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:price/detail.html';
        }
    }
*/
	 public function detail($priceattr_id)
    {
        if(!$priceattr_id = intval($priceattr_id)){
             $this->err->add('非法的参数请求', 201);
        }else if(!$attr = K::M('price/attr')->attr($priceattr_id)){
            $this->err->add('属性不存在或已经删除', 202);
        }else{
            $pager = array('priceattr_id'=>$priceattr_id);
            $this->pagedata['attr'] = $attr;
            $this->pagedata['pager'] = $pager;
            $this->pagedata['items'] = K::M('price/attrvalue')->value_by_attr($priceattr_id);
            $this->tmpl = 'admin:price/detail.html';
        }
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                if($priceattr_id = K::M('price/attr')->create($data)){
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?price/attr-index.html');
                }
            } 
        }else{
		   $items = K::M('price/attrfrom')->items($filter, null, $page, $limit, $count);
		   $this->pagedata['items'] = $items;
           $this->tmpl = 'admin:price/create.html';
        }
    }

    public function edit($priceattr_id=null)
    {
        if(!($priceattr_id = (int)$priceattr_id) && !($priceattr_id = $this->GP('priceattr_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('price/attr')->detail($priceattr_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                if(K::M('price/attr')->update($priceattr_id, $data)){
                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
			$this->pagedata['city_list'] = K::M('data/city')->fetch_all();
			$this->pagedata['list_from'] = K::M('price/attrfrom')->items();
        	$this->tmpl = 'admin:price/edit.html';
        }
    }

    public function doaudit($priceattr_id=null)
    {
        if($priceattr_id = (int)$priceattr_id){
            if(K::M('price/attr')->batch($priceattr_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('priceattr_id')){
            if(K::M('price/attr')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($priceattr_id=null)
    {
        if($priceattr_id = (int)$priceattr_id){
            if(K::M('price/attr')->delete($priceattr_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('priceattr_id')){
            if(K::M('price/attr')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}