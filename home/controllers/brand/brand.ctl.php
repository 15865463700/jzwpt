<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Brand_Brand extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/product-([\d\-]+).html/i', $uri, $match)) {
            $system->request['act'] = 'index';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index()
    {
        $cat_id = $brand_id = $order = $attr_ids = 0;
        $filter = $pager = $attr_values = array();
        // cat-attrs-order-page
        $uri = $this->request['uri'];
        if (preg_match('/index(-([\d\-]+)?)?-(\d+).html/i', $uri, $match)) {
            $page = $match[3];
            if ($vids = explode('-', trim($match[2], '-'))) {
                $brand_id = array_shift($vids);
                $cat_id = $vids ? array_shift($vids) : 0;
                $order = $vids ? array_pop($vids) : 0;
                $attr_values = $vids;
                $attr_ids = implode('-', $vids);
            }
        } else 
            if (preg_match('/index-(\d+).html/i', $uri, $match)) {
                $page = $match[1];
            }
        $filter['city_id'] = $this->request['city_id'];
        $filter['audit'] = 1;
        $filter['closed'] = 0;
        // $filter['brand_id'] = $brand_id;
        if ($cat_id = (int) $cat_id) {
            if (! $cate = K::M('shop/cate')->cate($cat_id)) {
                $this->error(404);
            }
            $this->pagedata['cate'] = $cate;
            $this->pagedata['top_cate'] = $top_cate = K::M('shop/cate')->top_cate($cat_id);
            $filter['cat_id'] = K::M('shop/cate')->children_ids($cat_id);
        }
        // if(!$cate['brands'][$brand_id]){
        // $brand_id = 0;
        // }
        if ($brand_id = (int) $brand_id) {
            $filter['brand_id'] = $brand_id;
        } else {
            $brand = K::M('shop/brand')->fetch_all();
            $b = array();
            foreach ($brand as $k => $v) {
                $b[] = $v['brand_id'];
            }
            $brand_id = $filter['brand_id'] = $b[0];
        }
        $this->pagedata['childrens'] = K::M('shop/cate')->childrens($cat_id);
        foreach ($attr_values as $k => $v) {
            if ($v == 0) {
                unset($attr_values[$k]);
            }
        }
        if ($attr_values) {
            $filter['attrs'] = $attr_values;
        }
        $params = array();
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $filter[':OR'] = array(
                'title' => "LIKE:%{$kw}%",
                'name' => "LIKE:%{$kw}%"
            );
        }
        // order {0:默认,1:价格, 2:销量}
        $orderby = null;
        if ($order == 1) {
            $check['buy'] = '1';
            $orderby = array(
                'buys' => 'DESC',
                'books' => 'DESC'
            );
        } else 
            if ($order == 2) {
                $check['price'] = '1';
                $orderby = array(
                    'price' => 'ASC'
                );
            } else {
                $check['default'] = '1';
                $order = 0;
            }
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 1;
        $pager['count'] = $count = 0;
        $pager['cat_id'] = $cat_id;
        $pager['brand_id'] = $brand_id;
        $pager['order'] = $order;
        if ($attr_values) {
            $pager['attr_values'] = $attr_values;
        }
        if ($items = K::M('product/product')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('brand/brand:index', array(
                $brand_id,
                $cat_id,
                $attr_ids,
                $order,
                '{page}'
            ), array(), true), array(
                'kw' => $pager['sokw']
            ));
            $this->pagedata['items'] = $items;
            $shop_ids = array();
            foreach ($items as $k => $v) {
                $shop_ids[$v['shop_id']] = $v['shop_id'];
            }
            if ($shop_ids) {
                $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_ids($shop_ids);
            }
        }
        $order_link = array();
        $order_link['default'] = $this->mklink('brand/brand:index', array(
            $cat_id,
            $brand_id,
            $attr_ids,
            0,
            1
        ));
        $order_link['buy'] = $this->mklink('brand/brand:index', array(
            $cat_id,
            $brand_id,
            $attr_ids,
            1,
            1
        ));
        $order_link['price'] = $this->mklink('brand/brand:index', array(
            $cat_id,
            $brand_id,
            $attr_ids,
            2,
            1
        ));
        $pager['order_list'] = $order_link;
        $this->pagedata['check'] = $check;
        $seo = array(
            'cate_title' => '',
            'cate_seo_title' => '',
            'cate_seo_keywords' => '',
            'cate_seo_description' => ''
        );
        if ($cate) {
            $seo['cate_title'] = $cate['title'];
            $seo['cate_seo_title'] = $cate['seo_title'];
            $seo['cate_seo_keywords'] = $cate['seo_keywords'];
            $seo['cate_seo_description'] = $cate['seo_description'];
        }
        $this->seo->init('mall_product', $seo);
        $this->pagedata['brands'] = $brands;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'brand/index.html';
    }
}