<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Packet_Packet extends Ctl
{
    
    public function index($page=1)
    {

		$filter = $pager = array();
    	
		$pager['page'] = max(intval($page), 1);
    	
		$pager['limit'] = $limit = 50;
                
		if($SO = $this->GP('SO')){

			$pager['SO'] = $SO;

			if($SO['title']){
				$filter['title'] = $SO['title'];
			}

		}
		$filter['type'] = '1';
		if($items = K::M('member/packet')->items($filter, null, $page, $limit, $count)){
			$pager['count'] = $count;
        	
			$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        
		}
		$this->pagedata['cate'] = K::M('shop/cate')->items(array('parent_id'=>'0'));
		$this->pagedata['items'] = $items;
		$pager['type'] = 1;
		$this->pagedata['pager'] = $pager;

		$this->tmpl = 'admin:member/packet/items.html';

		
    }

	public function so()
	{

		$this->tmpl = 'admin:member/packet/so.html';
	}

	public function create()
    {
        if($data = $this->checksubmit('data')){
            
            if($packet_id = K::M('packet/packet')->create($data)){
                $this->err->add('添加内容成功');
                $this->err->set_data('forward', '?packet/packet-index.html');
            } 
        }else{
           $this->tmpl = 'admin:packet/packet/create.html';
        }
    }
	
	public function shop($page=1)
    {
    	$filter = $pager = array();
    	
		$pager['page'] = max(intval($page), 1);
    	
		$pager['limit'] = $limit = 50;
                
		if($SO = $this->GP('SO')){

			$pager['SO'] = $SO;

			if($SO['title']){
				$filter['title'] = $SO['title'];
			}

		}
		$filter['type'] = '2';
		if($items = K::M('member/packet')->items($filter, null, $page, $limit, $count)){
			$pager['count'] = $count;
        	
			$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        
		}
		$this->pagedata['cate'] = K::M('shop/cate')->items(array('parent_id'=>'0'));
		$this->pagedata['items'] = $items;
		$pager['type'] = 2;
		$this->pagedata['pager'] = $pager;

		$this->tmpl = 'admin:member/packet/items.html';
    }
	
	function shengcheng()
	{
		if($data = $this->checksubmit('data')){
			for($i=0;$i<$data['number'];$i++){
				$data['code'] = K::M('member/packet')->create_code();
				K::M('member/packet')->create($data);
			}
			$this->err->add('红包生成成功');
			$this->err->set_data('forward', '?packet/packet-index.html');
		}else{
			 $this->err->add('未指定要生成的内容', 211);
		}
	}

}