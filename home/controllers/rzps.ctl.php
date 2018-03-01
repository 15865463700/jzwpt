<?php

class Ctl_Rzps extends Ctl {
    public static $ctl_rzpscompany_old="rzpscompany";
    public static $ctl_rzpscompany_new="rzps";

    public function index($page = 1) {
        $this->items(0, 0, 0, 0, $page);
    }

    public function items($page = 1) {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $area_id = $group_id = $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:bycl', true);
        $uri = $this->request['uri'];
        if (preg_match('/items(-[\d\-]+)?(-(\d+)).html/i', $uri, $m) || preg_match('/rzps(-[\d\-]+)?(-(\d+))(\.html)*/i', $uri, $m)) {
            $page = (int) $m[3];
            if ($m[1]) {
                $attr_vids = explode('-', trim($m[1], '-'));
                $area_id = $attr_vids ? array_shift($attr_vids) : 0;
                $group_id = $attr_vids ? array_shift($attr_vids) : 0;
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        $_seo_repeat = "";
        foreach ($attr_values as $k => $v) {
            if ($v['filter']) {
                $attr_value_ids[$k] = 0;
                foreach ($attr_vids as $vv) {
                    if ($v['values'][$vv]) {
                        $attr_value_ids[$k] = $vv;
                        $attr_ids[$k] = $vv;
                        $attrs[$k] = $v['values'][$vv];
                        $attr_value_titles[$k] = $v['values'][$vv]['title'];
                        $_seo_repeat.=",{$this->request['city']['city_name']}{$v['values'][$vv]['title']}布艺窗帘公司";
                    }
                }
            }
        }
        $attr_vids = $attr_ids;
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('rzps:items', array($area_id, $group_id, implode('-', $vids)));
                $v['link'] = preg_replace("/-items/", "", $v['link']);
                $v['link']=preg_replace("/rzps-0-0-0-0-0-1\./","rzps.",$v['link']);
                $v['link'] = preg_replace("/\.html/", "/", $v['link']);
            $v['checked'] = true;
            foreach ($v['values'] as $kk => $vv) {
                $vv['checked'] = false;
                if (in_array($kk, $attr_ids)) {
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('rzps:items', array($area_id, $group_id, implode('-', $vids)));
                $vv['link'] = preg_replace("/-items/", "", $vv['link']);
                $vv['link']=preg_replace("/rzps-0-0-0-0-0-1\./","rzps.",$vv['link']);
                $vv['link'] = preg_replace("/\.html/", "/", $vv['link']);
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        if ($group_list = K::M('member/group')->items_by_from('company')) {
            $group_all_link = $this->mklink('rzps:items', array($area_id, 0, implode('-', $attr_value_ids), $order, 1));
            foreach ($group_list as $k => $v) {
                $v['link'] = $this->mklink('rzps:items', array($area_id, $k, implode('-', $attr_value_ids), $order, 1));
                $group_list[$k] = $v;
            }
        }
        $area_list = $this->request['area_list'];
        $area_all_link = $this->mklink('rzps:items', array(
            0,
            $group_id,
            implode('-', $attr_value_ids),
            $order,
            1
        ));
        $area_all_link = preg_replace("/-items/", "", $area_all_link);
        $area_all_link = preg_replace("/\.html/", "/", $area_all_link);
        foreach ($area_list as $k => $v) {
            $v['link'] = $this->mklink('rzps:items', array(
                $k,
                $group_id,
                implode('-', $attr_value_ids),
                $order,
                1
            ));
            $v['link'] = preg_replace("/-items/", "", $v['link']);
            $v['link'] = preg_replace("/\.html/", "/", $v['link']);
            $area_list[$k] = $v;
        }
        define('__SYS_DEBUG', 1);
        $order_list = array(0 => array('title' => '默认'), 1 => array('title' => '签单'), 2 => array('title' => '口碑'));
        $order_list[0]['link'] = $this->mklink('rzps:items', array($area_id, $group_id, implode('-', $attr_value_ids), 0, 1));
        $order_list[1]['link'] = $this->mklink('rzps:items', array($area_id, $group_id, implode('-', $attr_value_ids), 1, 1));
        $order_list[2]['link'] = $this->mklink('rzps:items', array($area_id, $group_id, implode('-', $attr_value_ids), 2, 1));
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
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if ($attr_ids) {
            $filter['attrs'] = $attr_ids;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter[':OR'] = array('title' => "LIKE:%{$kw}%", 'name' => "LIKE:%{$kw}%");
        }
        // if($order == 1){
        // $orderby = array('tenders_num'=>'DESC');
        // }else if($order == 2){
        // $orderby = array('score'=>'DESC');
        // }else{
        // $orderby = NULL;
        // }
        $items = K::M('rzpscompany/company')->items($filter, $orderby, $page, $limit, $count);
        foreach ($items as $key => $value) {
            $fields = K::M('rzpscompany/fields')->detail($value["company_id"]);
            foreach ($fields as $k => $v) {
                $items[$key][$k] = $v;
            }
        }
        if ($items) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('rzps:items', array(
                        $area_id,
                        $group_id,
                        implode('-', $attr_value_ids),
                        $order,
                        '{page}'
                            ), $params));
            $pager['pagebar'] = preg_replace("/-items/", "", $pager['pagebar']);
            $pager['pagebar'] = preg_replace("/\.html/", "/", $pager['pagebar']);
            foreach ($items as $k => $v) {
                $items[$k]['company_url'] = preg_replace("/\/rzpscompany-/", "/rzpscompany/", $v['company_url']);
                $items[$k]['company_url']=  str_replace(Ctl_Rzps::$ctl_rzpscompany_old, Ctl_Rzps::$ctl_rzpscompany_new, $items[$k]['company_url']);
                $items[$k]['desc'] = K::M('content/html')->text2($v['info']);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['area_list'] = $area_list;
        $this->pagedata['group_list'] = $group_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['group_all_link'] = $group_all_link;
        $pager['area_id'] = $area_id;
        $this->pagedata['pager'] = $pager;

        $seo = array(
            'area_name' => '',
            'attr' => '',
            'page' => '',
            'repeat' => $_seo_repeat,
        );
        if ($area_id) {
            $seo['area_name'] = $area_list[$area_id]['area_name'];
        }
        if ($attr_value_titles) {
            $seo['attr'] = implode('', $attr_value_titles);
        }
        if ($page > 1) {
            $seo['page'] = $page;
        }
        if (is_main()) {
            empty($seo['attr']) && empty($seo['area_name']) ? $this->seo->init('bycl', $seo) : $this->seo->init('bycl_attr', $seo);
        } else {
            empty($seo['attr']) && empty($seo['area_name']) ? $this->seo->init('fenzhan_bycl', $seo) : $this->seo->init('fenzhan_bycl_attr', $seo);
        }
        $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/rzps/";
        $this->tmpl = 'rzps/items.html';
    }

    public function yuyue($company_id) {
        if (!($company_id = (int) $company_id) && !($company_id = (int) $this->GP('company_id'))) {
            $this->error(404);
            ;
        } else
        if (!$detail = K::M('rzpscompany/company')->detail($company_id)) {
            $this->err->add('公司不存在或已经删除', 212);
        } else
        if (empty($detail['audit'])) {
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        } else {
            if ($this->checksubmit('data')) {
                if (!$data = $this->GP('data')) {
                    $this->err->add('非法的数据提交', 201);
                } else {
                    if (empty($data['contact'])) {
                        $this->err->add("称呼不能为空！", 211)->response();
                    }
                    if (!K::M('verify/check')->phone($data['mobile'])) {
                        $this->err->add("手机号码输入错误！", 211)->response();
                    }
                    $verifycode_success = true;
                    $access = $this->system->config->get('access');
                    if ($access['verifycode']['yuyue']) {
                        if (!$verifycode = $this->GP('verifycode')) {
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        } else
                        if (!K::M('magic/verify')->check($verifycode)) {
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        }
                    }
                    if ($verifycode_success) {
                        $data['uid'] = (int) $this->uid;
                        $data['company_id'] = $company_id;
                        $data['content'] = "预约软装";
                        $data['city_id'] = $this->request['city_id'];
                        if ($yuyue_id = K::M('rzpscompany/yuyue')->create($data)) {
                            K::M('rzpscompany/yuyue')->yuyue_count($company_id);
                            $this->err->add('预约公司成功！');
                        }
                    }
                }
            } else {
                $access = $this->system->config->get('access');
                $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
                $this->pagedata['company_id'] = $company_id;
                $this->pagedata['detail'] = $detail;
                $this->tmpl = 'rzps/yuyue.html';
            }
        }
    }

}
