<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Jfproduct_Product extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['name']){$filter['name'] = "LIKE:%".$SO['name']."%";}
            if(is_array($SO['jfprice'])){$a = intval($SO['jfprice'][0]);$b=intval($SO['jfprice'][1]);if($a && $b){$filter['jfprice'] = $a."~".$b;}}
        }
        $filter['closed'] = 0;
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('jfproduct/jfproduct')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:jfproduct/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:jfproduct/so.html';
    }

    public function detail($product_id = null)
    {
        if(!$product_id = (int)$product_id){
            $this->err->add('未指定要查看内容的ID', 211);
        }else if(!$detail = K::M('jfproduct/jfproduct')->detail($product_id)){
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
                $this->err->add('不可越权操作', 403);
        }else{
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:jfproduct/detail.html';
        }
    }

    public function create($cat_id=null)
    {
        if($data = $this->checksubmit('data')){ 
            if($_FILES['data']){
                    if($photos = $this->__upload($_FILES['data'])){
                        $data = array_merge($data, $photos);
                    }
                } 
            if($product_id = K::M('jfproduct/jfproduct')->create($data)){
                $this->err->add('添加内容成功');
                $this->err->set_data('forward', '?jfproduct/product-index.html');
            } 
        }else{
            if($cat_id){
                $pager['cat_id'] = $cat_id;
                $this->pagedata['pager'] = $pager;            
                $this->pagedata['cate'] = K::M('shop/cate')->cate($cat_id);
                $this->pagedata['top_cate'] = K::M('shop/cate')->top_cate($cat_id);
                $this->pagedata['parents'] = K::M('shop/cate')->parents($cat_id);
                $this->cookie->set('LAST_product_pids', K::M('shop/cate')->parent_ids($cat_id, ',', true));
            }            
            $this->tmpl = 'admin:jfproduct/create.html';
        }
    }

    public function edit($product_id=null,$cat_id=null)
    {
        if(!($product_id = (int)$product_id) && !($product_id = $this->GP('product_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('jfproduct/jfproduct')->detail($product_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
                $this->err->add('不可越权操作', 403);
        }else if($data = $this->checksubmit('data')){
            if($_FILES['data']){
                    if($photos = $this->__upload($_FILES['data'])){
                        $data = array_merge($data, $photos);
                    }
                }
            if(CITY_ID){
                $data['city_id'] = CITY_ID;
            }
            if(K::M('jfproduct/jfproduct')->update($product_id, $data)){
                $this->err->add('修改内容成功');
            }  
        }else{
            if(!$cat_id = (int)$cat_id){
                $cat_id = $detail['cat_id'];
            }
            $pager['cat_id'] = $cat_id;
            $this->pagedata['pager'] = $pager;            
            $this->pagedata['cate'] = K::M('shop/cate')->cate($cat_id);
            $this->pagedata['top_cate'] = K::M('shop/cate')->top_cate($cat_id);
            $this->pagedata['parents'] = K::M('shop/cate')->parents($cat_id);
            $this->cookie->set('LAST_product_pids', K::M('shop/cate')->parent_ids($cat_id, ',', true));
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:jfproduct/edit.html';
        }
    }

    public function doaudit($product_id=null)
    {
        if($product_id = (int)$product_id){
            if(K::M('jfproduct/jfproduct')->batch($product_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('product_id')){
            if(K::M('jfproduct/jfproduct')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($product_id=null)
    {
        if($product_id = (int)$product_id){
            if(!$detail = K::M('jfproduct/jfproduct')->detail($product_id)){
                $this->err->add('你要删除的内容不存在或已经删除', 211);
            }else if(!$this->check_city($detail['city_id'])){
                $this->err->add('不可越权操作', 403);
            }else{
                if(K::M('jfproduct/jfproduct')->delete($product_id)){
                    $this->err->add('删除内容成功');
                }
            }
        }else if($ids = $this->GP('product_id')){
            if($items = K::M('jfproduct/jfproduct')->items_by_ids($ids)){
                $aids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['product_id']] = $v['product_id'];
                }
                if(K::M('jfproduct/jfproduct')->delete($aids)){
                    $this->err->add('批量删除内容成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    } 

    public function select_cate($cat_id=null)
    {
        $this->tmpl = 'admin:jfproduct/select_cate.html';
    } 

    protected function __upload($data, $product_id=0)
    {
        $photos = array();        
        foreach($data as $k=>$v){
            foreach($v as $kk=>$vv){
                $attachs[$kk][$k] = $vv;
            }
        }
        foreach($attachs as $k=>$attach){
            if($attach['error'] == UPLOAD_ERR_OK){
                if($a = K::M('product/photo')->upload($product_id, $attach)){
                    $photos[$k] = $a['photo'];
                }
            }
        }
        return $photos;
    }

}