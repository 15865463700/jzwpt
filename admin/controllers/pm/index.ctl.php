<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: log.ctl.php 3053 2014-01-15 02:00:13Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Pm_Index extends Ctl
{
    protected $pm_type = array(1=>'水电工程',2=>'土木工程',3=>'油漆工程',4=>'安装工程');
	protected $pm_pro  = array(1=>'方案设计',2=>'水泥改造',3=>'泥瓦阶段',4=>'木工阶段',5=>'油漆阶段',6=>'完工',7=>'验收完成');
	//项目列表
	public function index()
	{
		$map   = array('closed'=>0);
		$items = K::M('pm/site')->items($map);
		$this->pagedata['items'] = $items;
		$this->pagedata['zxpm'] = $this->supervist();
		$this->tmpl = 'admin:pm/index.html';
	}
	//添加项目
	public function addpm()
	{
		if($d=$this->GP('data')){
			$d['dateline'] = time();
			$d['starttime'] = strtotime($d['starttime']);
			$d['endtime'] = strtotime($d['endtime']);
			if(K::M('pm/site')->create($d)){
				$this->err->add('添加工地成功');
				$this->err->set_data('forward', '?pm/index-index.html');
			}else{
				$this->err->add('添加工地失败',100);
			}
		}else{
			$this->pagedata['pm_type'] = $this->pm_type;
			$this->pagedata['pm_pro']  = $this->pm_pro;
			$this->pagedata['zxpm'] = $this->supervist();
			$this->tmpl = 'admin:pm/addpm.html';
		}
	}
	public function edpm($site_id=null)
	{
		if(!$site_id){
			$this->err->add('非法访问',100);
		}elseif(!$detail=K::M('pm/site')->detail($site_id)){
			$this->err->add('非法访问',100);
		}elseif($d=$this->GP('data')){
			$d['lasttime'] = time();
			$d['starttime'] = strtotime($d['starttime']);
			$d['endtime'] = strtotime($d['endtime']);
			if(K::M('pm/site')->update($site_id,$d)){
				$this->err->add('编辑工地成功');
				$this->err->set_data('forward', '?pm/index-index.html');
			}else{
				$this->err->add('编辑工地失败',100);
			}
		}else{
			$this->pagedata['detail'] = $detail;
			$this->pagedata['pm_pro']  = $this->pm_pro;
			$this->pagedata['pm_type'] = $this->pm_type;
			$this->pagedata['zxpm'] = $this->supervist();
			$this->tmpl = 'admin:pm/editpm.html';
		}
	}
	//移除项目
	public function rmpm($site_id=null)
	{
		if($site_id = (int)$site_id){
            if(K::M('pm/site')->delete($site_id)){
                $this->err->add('删除成功');
            }else{
            	$this->err->add('该数据不存在！', 401);
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
	}

	// private function zxpm()
	// {
	// 	$map   = array('closed'=>0);
	// 	return K::M('pm/manager')->items($map);
	// }
	private function supervist()
	{
		$map   = array('closed'=>0);
        return  K::M('supervist/supervist')->items($map);
	}

	public function progress($site_id=null)
	{
		if(!$site_id){
			$this->err->add('非法访问',100);
		}else{
			$map   = array('status'=>1,'site_id'=>$site_id);
			$this->pagedata['site_id'] = $site_id;
			$this->pagedata['items'] = K::M('pm/site_progress')->items($map,'dateline asc');
			$this->tmpl = "admin:pm/progress/index.html";
		}
	}

	public function addprogress($site_id=null)
	{
		if(!$site_id){
			$this->err->add('非法访问',100);
		}elseif($d=$this->GP('data')){
			$d['status'] = 1;
			$d['dateline'] = time();
			if($_FILES['attach'] && !$_FILES['attach']['error']){
				$file = $_FILES['attach'];
				$root = $_SERVER['DOCUMENT_ROOT'];
				$attach = '/attachs/photo/'.date('Ym').'/';
				$ext_arr = explode('.', $file['name']);
				if(!file_exists($root.$attach)){mkdir($root.$attach,0777);}
				$attach = $attach.date('Ymd').'_'.md5($file['tmp_name']).'.'.end($ext_arr);
				if(move_uploaded_file($file['tmp_name'], $root.$attach)){
					$d['attach'] = $attach;
				}
			}
			if(K::M('pm/site_progress')->create($d)){
				$this->err->add('操作成功');
				$this->err->set_data('forward', '?pm/index-progress-'.$site_id.'.html');
			}else{
				$this->err->add('操作失败',100);
			}
		}else{
			$this->pagedata['pm_pro']  = $this->pm_pro;
			$this->pagedata['site_id'] = $site_id;
			$this->pagedata['detail']   = K::M('pm/site')->detail($site_id);
			$this->tmpl = "admin:pm/progress/addprogress.html";
		}
	}

	public function editprogress($site_id=null,$progress_id=null)
	{
		if(!$site_id || !$progress_id){
			$this->err->add('非法访问',100);
		}elseif(!$detail=K::M('pm/site_progress')->detail($progress_id)){
			$this->err->add('非法访问',100);
		}elseif($d=$this->GP('data')){
			$d['status'] = 1;
			$d['dateline'] = time();
			if($_FILES['attach'] && !$_FILES['attach']['error']){
				$file = $_FILES['attach'];
				$root = $_SERVER['DOCUMENT_ROOT'];
				$attach = '/attachs/photo/'.date('Ym').'/';
				$ext_arr = explode('.', $file['name']);
				if(!file_exists($root.$attach)){mkdir($root.$attach,0777);}
				$attach = $attach.date('Ymd').'_'.md5($file['tmp_name']).'.'.end($ext_arr);
				if(move_uploaded_file($file['tmp_name'], $root.$attach)){
					$d['attach'] = $attach;
				}
			}
			if(K::M('pm/site_progress')->update($progress_id,$d)){
			
				$this->err->set_data('forward', '?pm/index-progress-'.$site_id.'.html');
			}else{
				$this->err->add('操作失败',100);
			}
		}else{
			$this->pagedata['pm_pro']  = $this->pm_pro;
			$this->pagedata['site_id'] = $site_id;
			$this->pagedata['progress_id'] = $progress_id;
			$this->pagedata['detail']  = K::M('pm/site')->detail($site_id);
			$this->pagedata['extra']       = $detail;
			$this->tmpl = "admin:pm/progress/edprogress.html";
		}
	}

	public function rmprogress($progress_id=null)
	{
		if(!$progress_id){
			$this->err->add('非法访问',100);
		}elseif(!K::M('pm/site_progress')->detail($progress_id)){
			$this->err->add('非法访问',100);
		}elseif(K::M('pm/site_progress')->delete($progress_id)){
			$this->err->add('操作成功');
		}else{
			$this->err->add('操作失败',100);
		}
	}
}