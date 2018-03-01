<?php

class Ctl_Zn extends Ctl {

    public function index($page = 1) {
        $this->items($page);
    }

    public function items($page = 1) {
        $area_id = $group_id = $order = 0;
//        $attr_values = K::M('data/attr')->attrs_by_from('zx:bycl', true);
        $uri = $this->request['uri'];
        if (preg_match('/items(-[\d\-]+)?(-(\d+)).html/i', $uri, $m) || preg_match('/zn(-[\d\-]+)?(-(\d+))(\.html)*/i', $uri, $m)) {
            $page = (int) $m[3];
            if ($m[1]) {
                $attr_vids = explode('-', trim($m[1], '-'));
                $area_id = $attr_vids ? array_shift($attr_vids) : 0;
                $group_id = $attr_vids ? array_shift($attr_vids) : 0;
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        $_seo_repeat = "";
        if ($group_list = K::M('member/group')->items_by_from('company')) {
            $group_all_link = $this->mklink('zn:items', array($area_id, 0, implode('-', $attr_value_ids), $order, 1));
            foreach ($group_list as $k => $v) {
                $v['link'] = $this->mklink('zn:items', array($area_id, $k, implode('-', $attr_value_ids), $order, 1));
                $group_list[$k] = $v;
            }
        }
        $area_list = $this->request['area_list'];
        $area_all_link = $this->mklink('zn:items', array(
            0,
            $group_id,
            implode('-', $attr_value_ids),
            $order,
            1
        ));
//        $area_all_link = preg_replace("/-items/", "", $area_all_link);
//        $area_all_link = preg_replace("/\.html/", "/", $area_all_link);
        foreach ($area_list as $k => $v) {
            $v['link'] = $this->mklink('zn:items', array(
                $k,
                $group_id,
                implode('-', $attr_value_ids),
                $order,
                1
            ));
//            $v['link'] = preg_replace("/-items/", "", $v['link']);
//            $v['link'] = preg_replace("/\.html/", "/", $v['link']);
            $area_list[$k] = $v;
        }
        define('__SYS_DEBUG', 1);
        $order_list = array(0 => array('title' => '默认'), 1 => array('title' => '签单'), 2 => array('title' => '口碑'));
        $order_list[0]['link'] = $this->mklink('zn:items', array($area_id, $group_id, implode('-', $attr_value_ids), 0, 1));
        $order_list[1]['link'] = $this->mklink('zn:items', array($area_id, $group_id, implode('-', $attr_value_ids), 1, 1));
        $order_list[2]['link'] = $this->mklink('zn:items', array($area_id, $group_id, implode('-', $attr_value_ids), 2, 1));
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['area_id'] = $area_id;
        $pager['group_id'] = $group_id;
        $pager['order'] = $order;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;

        $filter['city_id'] = $this->request['city_id'];

        if ($area_id) {
            $filter['area_id'] = $area_id;
        }
        if ($group_id) {
            $filter['group_id'] = $group_id;
        }
        $filter['city_id'] = $this->request['city']["city_id"];
        $filter['closed'] = 0;
        $filter['audit'] = 1;
//        if ($attr_ids) {
//            $filter['attrs'] = $attr_ids;
//        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter[':OR'] = array('title' => "LIKE:%{$kw}%", 'name' => "LIKE:%{$kw}%");
        }
         if($order == 1){
         $orderby = array('tenders_num'=>'DESC');
         }else if($order == 2){
         $orderby = array('score'=>'DESC');
         }else{
         $orderby = NULL;
         }
        $items = K::M('zn/zn')->items($filter, $orderby, $page, $limit, $count);
        foreach ($items as $key => $value) {
            $items[$key]['company_url']="/{$value['ctag']}/{$value['company_id']}.html";
            $fields = K::M("{$value['ctag']}company/fields")->detail($value["company_id"]);
            foreach ($fields as $k => $v) {
                $items[$key][$k] = $v;
            }
            $items[$key]['desc']=strip_tags($items[$key]['info']);
        }
        if ($items) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zn:items', array(
                        $area_id,
                        $order,
                        '{page}')));
            $this->pagedata['items'] = $items;
        }
//        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['area_list'] = $area_list;
//        $this->pagedata['group_list'] = $group_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['group_all_link'] = $group_all_link;
        $pager['area_id'] = $area_id;
        $this->pagedata['pager'] = $pager;

        if(is_main()){
            empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('zn_items', $seo):$this->seo->init('zn_items_attr', $seo);
        }else{
            empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('fenzhan_zn_items', $seo):$this->seo->init('fenzhan_zn_items_attr', $seo);
        }
        $this->tmpl = 'zn/items.html';
    }

}
