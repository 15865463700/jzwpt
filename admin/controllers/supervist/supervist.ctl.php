<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Supervist_Supervist extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['supervist_id']){$filter['supervist_id'] = $SO['supervist_id'];}
			if($SO['name']){$filter['name'] = $SO['name'];}
        }
		$filter['closed'] = 0;
        if($items = K::M('supervist/supervist')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:supervist/supervist/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:supervist/supervist/so.html';
    }



    public function create()
    {
        if($data = $this->checksubmit('data')){
			if($_FILES['data']){
				foreach($_FILES['data'] as $k=>$v){
					foreach($v as $kk=>$vv){
						$attachs[$kk][$k] = $vv;
					}
				}
				$upload = K::M('magic/upload');
				foreach($attachs as $k=>$attach){
					if($attach['error'] == UPLOAD_ERR_OK){
						if($a = $upload->upload($attach, 'video')){
							$data[$k] = $a['photo'];
						}
					}
				}
			}
            if($supervist_id = K::M('supervist/supervist')->create($data)){
				if($attr=  $this->GP('attr')){
					K::M('supervist/attr')->update($supervist_id,$attr);     
				}
                $this->err->add('添加内容成功');
                $this->err->set_data('forward', '?supervist/supervist-index.html');
            } 
        }else{
           $this->tmpl = 'admin:supervist/supervist/create.html';
        }
    }

    public function edit($supervist_id=null)
    {
        if(!($supervist_id = (int)$supervist_id) && !($supervist_id = $this->GP('supervist_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('supervist/supervist')->detail($supervist_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($data = $this->checksubmit('data')){
            if($_FILES['data']){
				foreach($_FILES['data'] as $k=>$v){
					foreach($v as $kk=>$vv){
						$attachs[$kk][$k] = $vv;
					}
				}
				$upload = K::M('magic/upload');
				foreach($attachs as $k=>$attach){
					if($attach['error'] == UPLOAD_ERR_OK){
						if($a = $upload->upload($attach, 'video')){
							$data[$k] = $a['photo'];
						}
					}
				}
			}
            if(K::M('supervist/supervist')->update($supervist_id, $data)){
				if($attr=  $this->GP('attr')){
					K::M('supervist/attr')->update($supervist_id,$attr);       
				}
                $this->err->add('修改内容成功');
            }  
        }else{
			$this->pagedata['attr'] = K::M('supervist/attr')->attrs_ids_by_supervist($supervist_id);
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:supervist/supervist/edit.html';
        }
    }

    public function delete($supervist_id=null)
    {
        if($supervist_id = (int)$supervist_id){
            if(!$detail = K::M('supervist/supervist')->detail($supervist_id)){
                $this->err->add('你要删除的内容不存在或已经删除', 211);
            }else{
                if(K::M('supervist/supervist')->delete($supervist_id)){
                    $this->err->add('删除内容成功');
                }
            }
        }else if($ids = $this->GP('supervist_id')){
            if(K::M('supervist/supervist')->delete($ids)){
                $this->err->add('批量删除内容成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }  

}