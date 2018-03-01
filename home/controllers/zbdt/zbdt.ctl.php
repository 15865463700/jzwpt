<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: tools.ctl.php 3304 2014-02-14 11:01:43Z youyi $
 */
class Ctl_Zbdt_Zbdt extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/jfproduct-([\d\-]+).html/i', $uri, $match)) {
            $system->request['act'] = 'index';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index()
    {
        $cat_id = $status = $order = $min = $max = 0;
        $filter = $pager = array();
        $uri = $this->request['uri'];
        if (preg_match('/index(-([\d\-]+)?)?-(\d+).html/i', $uri, $match)) {
            $page = $match[3];
            if ($vids = explode('-', trim($match[2], '-'))) {
                $cat_id = array_shift($vids);
                $status = $vids ? array_shift($vids) : 0;
                $order = $vids ? array_pop($vids) : 0;
            }
        } else 
            if (preg_match('/index-(\d+).html/i', $uri, $match)) {
                $page = $match[1];
            }
        $pager['page'] = $page = max((int) $page, 1);
        $cate_list = K::M('truste/cate')->fetch_all();
        if ($cat_id = (int) $cat_id) {
            if ($cate = K::M('truste/cate')->cate($cat_id)) {
                $top_cate = K::M('truste/cate')->top_cate($cat_id);
            }
        }
        if ($cate) {
            foreach ($cate_list as $k => $v) {
                if (empty($v['parent_id'])) {
                    $v['link'] = $this->mklink('zbdt:index', array(
                        $k,
                        $status,
                        $order,
                        1
                    ));
                    $parents[$k] = $v;
                } else 
                    if ($top_cate['cat_id'] == $v['parent_id']) {
                        $v['link'] = $this->mklink('zbdt:index', array(
                            $k,
                            $status,
                            $order,
                            1
                        ));
                        $cates[$k] = $v;
                    } else 
                        if ($v['parent_id'] == $cate['parent_id'] || $v['parent_id'] == $cate['cat_id'] || $v['cat_id'] == $cate['cat_id']) {
                            $v['link'] = $this->mklink('zbdt:index', array(
                                $k,
                                $status,
                                $order,
                                1
                            ));
                            $childrens[$k] = $v;
                        }
            }
        } else {
            foreach ($cate_list as $k => $v) {
                if (empty($v['parent_id'])) {
                    $v['link'] = $this->mklink('zbdt:index', array(
                        $k,
                        $status,
                        $order,
                        1
                    ));
                    $parents[$k] = $v;
                }
            }
        }
        if ($status == 1) { // 进行中
            $filter['sign_uid'] = null;
            $filter['status'] = '<>:2';
        } else 
            if ($status == 2) {
                $filter['status'] = 2;
            }
        $a_link = $this->mklink('zbdt:index', array(
            $cat_id,
            0,
            $order,
            1
        ));
        $b_link = $this->mklink('zbdt:index', array(
            $cat_id,
            1,
            $order,
            1
        ));
        $c_link = $this->mklink('zbdt:index', array(
            $cat_id,
            2,
            $order,
            1
        ));
        $order_alink = $this->mklink('zbdt:index', array(
            $cat_id,
            $status,
            0,
            1
        ));
        $order_blink = $this->mklink('zbdt:index', array(
            $cat_id,
            $status,
            1,
            1
        ));
        $order_clink = $this->mklink('zbdt:index', array(
            $cat_id,
            $status,
            2,
            1
        ));
        if ($order == 0) {
            $orderby = null;
        } else 
            if ($status == 1) { // 最新
                $orderby = array(
                    'sign_time' => 'DESC'
                );
            } else 
                if ($status == 2) { // 最热
                    $orderby = array(
                        'views' => 'DESC'
                    );
                }
        if ($gold = $this->GP('data')) {
            $min = $gold['min'] + 0;
            $max = $gold['max'] + 0;
            
            if ($max - $min > 0) {
                $filter['budget'] = $min . '~' . $max;
            } else {
                $this->err->add('输入值有误！', 201);
            }
        }
        $price_link = $this->mklink('zbdt:index', array(
            $cat_id,
            $status,
            $order,
            1
        ));
        if ($cat_id) {
            $childeren = K::M('truste/cate')->children_ids($cat_id, $glue = ',');
            $filter['cate_id'] = explode(',', $childeren);
        }
        $all_parent_cat_link = $this->mklink('zbdt:index', array(
            0,
            $status,
            $order,
            1
        ));
        $limit = 10;
        $count = 0;
        if ($items = K::M('truste/truste')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zbdt:index', array(
                $cat_id,
                $status,
                $order,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $cat = K::M('truste/cate')->detail($cat_id);
        if (! $cat['parent_id']) {
            $cateids = 0;
        } else {
            $cateids = 1;
        }
        $data = array(
            'cat_id' => $cat_id,
            'status' => $status,
            'order' => $order,
            'pcat' => $p_cat,
            'cateids' => $cateids,
            'top_cate' => $top_cate
        );
        $this->pagedata['data'] = $data;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['price_link'] = $price_link;
        $this->pagedata['order_alink'] = $order_alink;
        $this->pagedata['order_blink'] = $order_blink;
        $this->pagedata['order_clink'] = $order_clink;
        $this->pagedata['a_link'] = $a_link;
        $this->pagedata['b_link'] = $b_link;
        $this->pagedata['c_link'] = $c_link;
        $this->pagedata['all_parent_cat_link'] = $all_parent_cat_link;
        $this->pagedata['parents'] = $parents;
        $this->pagedata['cates'] = $cates;
        $this->pagedata['childrens'] = $childrens;
        $this->tmpl = 'zbdt/index.html';
    }

    public function detail($truste_id)
    {
        if (! $truste_id = (int) $truste_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('truste/truste')->detail($truste_id)) {
                $this->error(404);
            } else {
                if ($look_list = K::M('truste/look')->items(array(
                    'truste_id' => $truste_id
                ))) {
                    $uids = array();
                    foreach ($look_list as $v) {
                        $uids[$v['uid']] = $v['uid'];
                    }
                    if ($member_list = K::M('member/member')->items_by_ids($uids)) {
                        $company_uids = $shop_uids = $gz_uids = $designer_uids = array();
                        foreach ($member_list as $v) {
                            switch ($v['from']) {
                                case 'company':
                                    $company_uids[$v['uid']] = $v['uid'];
                                    break;
                                case 'shop':
                                    $shop_uids[$v['uid']] = $v['uid'];
                                    break;
                                case 'gz':
                                    $gz_uids[$v['uid']] = $v['uid'];
                                    break;
                                case 'designer':
                                    $designer_uids[$v['uid']] = $v['uid'];
                                    break;
                            }
                        }
                        if ($company_uids) {
                            $this->pagedata['company_list'] = K::M('company/company')->items_by_uids($company_uids);
                        }
                        if ($shop_uids) {
                            $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_uids($shop_uids);
                        }
                        if ($gz_uids) {
                            $this->pagedata['gz_list'] = K::M('gz/gz')->items_by_ids($gz_uids);
                        }
                        if ($designer_uids) {
                            $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_uids);
                        }
                        $this->pagedata['member_list'] = $member_list;
                    }
                    $this->pagedata['look_list'] = $look_list;
                }
                $this->pagedata['detail'] = $detail;
                $this->seo->init('truste_detail', array(
                    'title' => $detail['title']
                ));
                $this->tmpl = 'zbdt/detail.html';
            }
    }
}