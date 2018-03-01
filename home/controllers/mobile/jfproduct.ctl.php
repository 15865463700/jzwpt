<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Jfproduct extends Ctl_Mobile
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

    public function index($page = 1)
    {
        $cat_id = 0;
        $filter = $pager = array();
        $uri = $this->request['uri'];
        if (preg_match('/jfproduct-(\d+)-(\d+).html/i', $uri, $match)) {
            $page = $match[2];
            $cat_id = $match[1];
        } else 
            if (preg_match('/jfproduct-(\d+).html/i', $uri, $match)) {
                $page = $match[1];
            }
        if ($cat_id = (int) $cat_id) {
            $pager['cat_id'] = $cat_id;
            $filter['cat_id'] = "IN:" . K::M('shop/cate')->children_ids($cat_id);
        }
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        // $filter['city_id'] = $this->request['city_id'];
        if ($items = K::M('jfproduct/jfproduct')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )), array(
                'SO' => $SO
            ));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/jfproduct/index.html';
    }

    public function detail($product_id = null)
    {
        if (! $product_id = (int) $product_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('jfproduct/jfproduct')->detail($product_id)) {
                $this->error(404);
            } else 
                if ($detail['closed'] == 1) {
                    $this->error(404);
                } else 
                    if (empty($detail['audit'])) {
                        $this->err->add("内容审核中，暂不可访问", 211)->response();
                    } else {
                        $this->pagedata['detail'] = $detail;
                        $this->tmpl = 'mobile/jfproduct/detail.html';
                    }
    }
}
    