<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: cate.ctl.php 5639 2014-06-25 06:37:14Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Truste_Cate extends Ctl
{
    
    public function index($page=1)
    {
		
        if($items = K::M('truste/cate')->fetch_all()){
           
            foreach($items as $k=>$v){
                $a = array();
                $v['auditLabel'] = $v['audit'] ? '正常' : '<b class="red">待审</b>';
                $items[$k] = $v;
            }
            $oTree = K::M('helper/tree');
            $oTree->icon = array('|--- ','|--- ','|---');
            $oTree->nbsp = '&nbsp;&nbsp;&nbsp;';
            $oTree->init($items);
            $strtmpl = '<tr>
                    <td><label><input type="checkbox" value="{$cat_id}" name="cat_id[]" CK="PRI"/>{$cat_id}<label></td>
                    <td>{$spacer}{$title}</td><td>{$orderby}</td><td>{$auditLabel}</td>
                    <td><a href="?truste/cate-edit-{$cat_id}.html" title="修改" mini-load="修改分类" mini-width="550" class="button" >修改</a>
                    <a href="?truste/cate-delete-{$cat_id}.html" mini-act="删除" mini-confirm="确定要删除吗？" title="删除" class="button" >删除</a></td>
                </tr>';
            $this->pagedata['items'] = $items;
            $this->pagedata['treetable'] = $oTree->tree(0, $strtmpl);
        }
        $this->tmpl = 'admin:truste/cate/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:truste/cate/so.html';
    }





    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                if($cat_id = K::M('truste/cate')->create($data)){
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?truste/cate-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:truste/cate/create.html';
        }
    }

    public function edit($cat_id=null)
    {
        if(!($cat_id = (int)$cat_id) && !($cat_id = $this->GP('cat_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('truste/cate')->detail($cat_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
			if($item_parent = K::M('truste/cate')->items(array('parent_id'=>$cat_id))){
				foreach($item_parent as $k => $v){
					$cats[] = $v['cat_id'];
				}
			}
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if($data['parent_id'] == $cat_id || in_array($data['parent_id'],$cats)){
				$this->err->add('非法分类数据提交', 218);
			}else{
                if(empty($data['brand_ids'])){
                    $data['brand_ids'] = '';
                }
                if(K::M('truste/cate')->update($cat_id, $data)){
                    $this->err->add('修改内容成功');
                }
            } 
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:truste/cate/edit.html';
        }
    }

    public function doaudit($cat_id=null)
    {
        if($cat_id = (int)$cat_id){
            if(K::M('truste/cate')->batch($cat_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('cat_id')){
            if(K::M('truste/cate')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($cat_id=null)
    {
        if($cat_id = (int)$cat_id){
            if(K::M('truste/cate')->delete($cat_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('cat_id')){
            if(K::M('truste/cate')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

    public function children($pid=null,$cat_id=null)
    {
        if(!is_numeric($pid)){
            return false;
        }
        $cats = array();
        if($childrens = K::M('truste/cate')->childrens($pid)){
            foreach($childrens as $k=>$v){
				if($v['cat_id'] != $cat_id){
					$cats[] = array('cat_id'=>$v['cat_id'], 'parent_id'=>$v['parent_id'], 'title'=>$v['title']);
				}
                
            }
        }
        $this->err->set_data('cats', $cats);        
        $this->err->json();        
    }   
}