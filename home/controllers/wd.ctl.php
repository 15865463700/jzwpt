<?php
class Ctl_Wd extends Ctl{
    public static $ctl_dp_old="wd";
    public static $ctl_dp_new="wd";
    
    public function index($page=1){
        $this->items($page);
    }

    public function items($page = 1){
        if($_REQUEST['a']){
            $page=$_REQUEST['a'];
        }
        $order=0;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['status'] = 1;
        $orderby = array(
            'wd_id' => 'DESC'
        );
        if ($items = K::M('wd/wd')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('wd:items', array('{page}')));
            $pager['pagebar'] = preg_replace("/wd-items/","wd",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/-1\./",".",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/\.html/","/",$pager['pagebar']);
//            $pager['pagebar']=  str_replace($this->request['city']['siteurl'], $this->request['url'],$pager['pagebar']);
//            $pager['pagebar']= str_replace(Ctl_Case::$ctl_old,  Ctl_Case::$ctl_new,$pager['pagebar']);
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/dp/";
        if(is_main()){
            empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('wd_items', $seo):$this->seo->init('wd_items_attr', $seo);
        }else{
            empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('fenzhan_wd_items', $seo):$this->seo->init('fenzhan_wd_items_attr', $seo);
        }
        $this->tmpl = 'wd/items.html';
    }

}