<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Supervist extends Ctl
{

    public function index($page)
    {
        $this->items($page);
    }

    public function items($page = 1)
    {
        $url = array();
        if ($length = strpos($this->request['uri'], '&')) {
            $this->request['uri'] = substr($this->request['uri'], 0, $length);
        }
        $attr_values = K::M('data/attr')->attrs_by_from('zx:supervist');
        $http_key = $attr_keys = array();
        $http_key['area_id'] = 'area_id';
        foreach ($attr_values as $key => $value) {
            $http_key['attr' . $key] = 'attr' . $key;
        }
        $http_key['area_id'] = 'area_id';
        $http_key['order'] = 'order';
        $http_key['page'] = 'page';
        $num = count($http_key);
        if (preg_match('/([\/a-zA-Z\-0-9])+/', $this->request['uri'], $match)) {
            $uri = explode('-', $match[0]);
        }
        foreach ($uri as $k => $v) {
            if (! is_numeric($v)) {
                unset($uri[$k]);
            }
        }
        if (count($uri) > $num) {
            $uri = array_slice($uri, 0, $num);
        } else {
            $uri = array_pad($uri, $num, 0);
        }
        $url = array_combine($http_key, $uri);
        if ($url['order'] == '2') {
            $order = array(
                'views' => 'desc'
            );
        } else {
            $order = null;
        }
        $page = empty($url['page']) ? 1 : (int) $url['page'];
        $filter = $pager = array();
        if ($area_id = (int) $url['area_id']) {
            $filter['area_id'] = $area_id;
        } else {
            $filter['city_id'] = $this->request['city_id'];
        }
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 15;
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        foreach ($attr_values as $key => $value) {
            $attr_values[$key]['link'] = $this->mklink('supervist:items', array_merge($url, array(
                'attr' . $key => 0
            )));
            if (empty($url['attr' . $key]))
                $attr_values[$key]['checked'] = true;
            foreach ($value['values'] as $k => $v) {
                $attr_values[$key]['values'][$k]['link'] = $this->mklink('supervist:items', array_merge($url, array(
                    'attr' . $key => $k
                )));
                if (! empty($url['attr' . $key]) && $url['attr' . $key] == $k) {
                    $attr[] = $k;
                    $attr_values[$key]['values'][$k]['checked'] = true;
                }
            }
        }
        if ($attr) {
            $filter['attrs'] = $attr;
        }
        if ($items = K::M('supervist/supervist')->items_by_attr($filter, $order, $page, $limit, $count)) {
            $num = 0;
            foreach ($items as $k => $val) {
                if ($val['supervist_id']) {
                    $supervist_ids[$val['supervist_id']] = $val['supervist_id'];
                }
                $items[$k]['about'] = K::M('content/html')->text($val['about']);
                $items[$k]['count'] = $num ++;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('supervist:items', array_merge($url, array(
                'page' => '{page}'
            ))));
        }
        $area_list = K::M('data/area')->areas_by_city($this->request['city_id']);
        foreach ($area_list as $k => $v) {
            if ($k == $url['area_id']) {
                $area_list[$k]['checked'] = true;
            }
            $area_list[$k]['link'] = $this->mklink('supervist:items', array_merge($url, array(
                'area_id' => $k
            )), array(), true);
        }
        $order = K::M('supervist/supervist')->get_order();
        foreach ($order as $k => $v) {
            if ($k == $url['order']) {
                $order[$k]['checked'] = true;
            }
            if (! $url['order']) {
                $order['1']['checked'] = true;
            }
            $order[$k]['link'] = $this->mklink('supervist:items', array_merge($url, array(
                'order' => $k
            )), array(), true);
        }
        $this->pagedata['order'] = $order;
        $this->pagedata['area_url'] = $this->mklink('supervist:items', array_merge($url, array(
            'area_id' => 0
        )), array(), true);
        $this->pagedata['area_list'] = $area_list;
        $this->pagedata['url_data'] = $url;
        $this->pagedata['supervist'] = $items;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['area_id'] = $area_id;
        K::M('helper/seo')->init('supervist', array(
            'area_name' => $area_list[$area_id]['area_name']
        ));
        $this->tmpl = 'supervist/items.html';
    }

    public function detail($supervist_id)
    {
        K::M('supervist/supervist')->update_count($supervist_id, 'views', 1);
        $detail = $this->check_supervist($supervist_id);
        $this->pagedata['city_list'] = K::M("data/city")->fetch_all();
        $this->pagedata['area_list'] = K::M("data/area")->fetch_all();
        K::M('helper/seo')->init('supervist_about', array(
            'name' => $detail['realname']
        ));
        $this->tmpl = 'supervist/detail.html';
    }

    protected function check_supervist($supervist_id)
    {
        if (! ($supervist_id = (int) $supervist_id) && ! ($supervist_id = $this->GP('supervist_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('supervist/supervist')->detail($supervist_id)) {
                $this->error(404);
            }
        $this->pagedata['detail'] = $detail;
        return $detail;
    }
}