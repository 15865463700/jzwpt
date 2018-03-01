
<?php

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Cshhrappli_Cshhrappli extends Ctl
{
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 10;
        
        if($items = K::M('cshhrappli/cshhrappli')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:cshhr/cshhr/appli.html';
    }

   
}
