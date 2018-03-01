<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Supervist_Attr extends Ctl
{
    public function create()
    {
        if($data = $this->checksubmit('data')){
            
            if($supervist_id = K::M('supervist/attr')->create($data)){
                $this->err->add('添加内容成功');
                $this->err->set_data('forward', '?supervist/attr-index.html');
            } 
        }else{
           $this->tmpl = 'admin:supervist/attr/create.html';
        }
    }

    public function edit($supervist_id=null)
    {
        if(!($supervist_id = (int)$supervist_id) && !($supervist_id = $this->GP('supervist_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('supervist/attr')->detail($supervist_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($data = $this->checksubmit('data')){
            
            if(K::M('supervist/attr')->update($supervist_id, $data)){
                $this->err->add('修改内容成功');
            }  
        }else{
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:supervist/attr/edit.html';
        }
    }



    public function delete($supervist_id=null)
    {
        if($supervist_id = (int)$supervist_id){
            if(!$detail = K::M('supervist/attr')->detail($comment_id)){
                $this->err->add('你要删除的内容不存在或已经删除', 211);
            }else{
                if(K::M('supervist/attr')->delete($supervist_id)){
                    $this->err->add('删除内容成功');
                }
            }
        }else if($ids = $this->GP('supervist_id')){
            if(K::M('supervist/attr')->delete($ids)){
                $this->err->add('批量删除内容成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }  

}