<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: log.ctl.php 3053 2014-01-15 02:00:13Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Pm_Manager extends Ctl
{
	public function index($page=1)
	{
		$map   = array('closed'=>0);
		$items = K::M('pm/manager')->items($map);
		$this->pagedata['items'] = $items;
		$this->tmpl = "admin:pm/manager/index.html";
	}

	public function addmg()
	{
		if($d=$this->GP('d')){
			$d['dateline'] = time();
			if(K::M('pm/manager')->create($d)){
				$this->err->add('添加监理成功');
				$this->err->set_data('forward', '?pm/manager-index.html');
			}else{
				$this->err->add('添加监理失败',100);
			}
		}else{
		   $this->tmpl = "admin:pm/manager/addmg.html";
		}
	}

	public function editmg($mg_id=null)
	{
		if(!$detail=K::M('pm/manager')->detail($mg_id)){
				$this->err->add('非法操作',99);
		}elseif($d=$this->GP('d')){
			$d['lasttime'] = time();
			if(K::M('pm/manager')->update($mg_id,$d)){
				$this->err->add('编辑监理成功');
				$this->err->set_data('forward', '?pm/manager-index.html');
			}else{
				$this->err->add('编辑监理失败',100);
			}
		}else{
			$this->pagedata['detail'] = $detail;
			$this->tmpl = "admin:pm/manager/editmg.html";	
		}
		
	}

	public function rmmg($mg_id=null)
	{
		if($mg_id = (int)$mg_id){
            if(K::M('pm/manager')->delete($mg_id)){
                $this->err->add('删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
	}
	
}	