<?php

class Ctl_Mobile_Rzpscompany extends Ctl_Mobile
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/rzpscompany-([\d]+).html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[1]
            );
        }
    }

    public function index()
    {
        $this->items();
    }

    public function items($area_id = 0, $group_id = 0, $order = 0, $page = 1)
    {
        $pager = $filter = $orderby = $params = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['area_id'] = $area_id = (int) $area_id;
        $pager['group_id'] = $group_id = (int) $group_id;
        $pager['order'] = $order = (int) $order;
        $area_list = $this->request['area_list'];
        $group_list = K::M('member/group')->options('company');
        $order_list = array(
            0 => '默认排序',
            1 => '热门排序',
            2 => '口碑排序',
            3 => '最新排序'
        );
        $filter['city_id'] = $this->request['city_id'];
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if ($area_id && $area_list[$area_id]) {
            $filter['area_id'] = $area_id;
        }
        if ($group_id && $group_list[$group_id]) {
            $filter['group_id'] = $group_id;
        }
        switch ($order) {
            case 1:
                $orderby = array(
                    'views' => 'DESC'
                );
                break;
            case 2:
                $orderby = array(
                    'score' => 'DESC'
                );
                break;
            case 3:
                $orderby = array(
                    'flushtime' => 'DESC'
                );
                break;
            default:
                $orderby = array();
                break;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        if ($items = K::M('rzpscompany/company')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/rzpscompany:items', array(
                $area_id,
                $group_id,
                $order,
                '{page}'
            ), $params));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['area_list'] = $area_list;
        $this->pagedata['group_list'] = $group_list;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['pager'] = $pager;
        $seo = array(
            'area_name' => '',
            'attr' => '',
            'page' => ''
        );
        if ($area_id) {
            $seo['area_name'] = $area_list[$area_id]['area_name'];
        }
        if ($group_id) {
            $seo['attr'] = $group_list[$group_id];
        }
        if ($page > 1) {
            $seo['page'] = $page;
        }
        $this->seo->init('gs_items', $seo);
        $this->tmpl = 'mobile/rzpscompany/items.html';
    }

    public function detail($company_id)
    {
        $company = $this->check_rzpscompany($company_id);
        $pager = array();
        $pager['backurl'] = '/mobile/rzzn/';
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_company($company);
        // $this->seo->init('company');
        $this->tmpl = 'mobile/rzpscompany/detail.html';
    }

    public function youhui($company_id, $page = 1)
    {
        $company = $this->check_rzpscompany($company_id);
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['page'] = $limit = 5;
        $pager['count'] = $count = 0;
        if ($items = K::M('rzpscompany/youhui')->items_by_company($company_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $pager['backurl'] = $this->mklink('mobile/rzpscompany', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/rzpscompany/youhui.html';
    }

    public function cases($company_id, $page = 1)
    {
        $company = $this->check_rzpscompany($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1,
            'closed' => 0
        );
        $filter['company_id'] = $company_id;
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $pager['backurl'] = $this->mklink('mobile/rzpscompany', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_company($company);
        // $this->seo->init('company');
        $this->tmpl = 'mobile/rzpscompany/cases.html';
    }

    public function team($company_id, $page = 1)
    {
        $company = $this->check_rzpscompany($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $company_id,
            'closed' => 0
        );
        if ($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $pager['backurl'] = $this->mklink('mobile/rzpscompany', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_company($company);
        // $this->seo->init('company');
        $this->tmpl = 'mobile/rzpscompany/team.html';
    }

    public function news($company_id, $page = 1)
    {}

    public function yuyue($company_id = null)
    {
        if (! ($company_id = (int) $company_id) && ! ($company_id = (int) $this->GP('company_id'))) {
            $this->error(404);
        } else 
            if (! $company = K::M('rzpscompany/company')->detail($company_id)) {
                $this->error(404);
            } else 
                if (empty($company['audit'])) {
                    $this->err->add("公司审核中，不能预约", 211);
                } else 
                    if ($data = $this->checksubmit('data')) {
                        if (! $data = $this->check_fields($data, 'contact,mobile')) {
                            $this->err->add("非法的数据提交", 212);
                        } else {
                            $data['uid'] = (int) $this->uid;
                            $data['company_id'] = $company_id;
                            $data['content'] = "预约公司:" . $company['name'] . '，来自移动端';
                            $data['city_id'] = $company['city_id'];
                            if ($yuyue_id = K::M('rzpscompany/yuyue')->create($data)) {
                                K::M('rzpscompany/company')->update_count($company_id, 'yuyue_num');
                                $this->err->add('预约公司成功');
                                $this->err->set_data('forward', $this->mklink('mobile/rzpscompany', array(
                                    $company_id
                                )));
                            }
                        }
                    } else {
                        $pager['tender_hide'] = 1;
                        $pager['backurl'] = $this->mklink('mobile/rzpscompany', array(
                            $company_id
                        ));
                        $this->pagedata['pager'] = $pager;
                        $this->pagedata['company'] = $company;
                        $this->tmpl = 'mobile/rzpscompany/yuyue.html';
                    }
    }

    protected function check_rzpscompany(&$company_id = null)
    {
        if (! $company_id = (int) $company_id) {
            $this->error(404);
        } else 
            if (! $company = K::M('rzpscompany/company')->detail($company_id, true)) {
                $this->error(404);
            } else 
                if (empty($company['audit']) && (empty($this->uid) || ($this->uid != $company['uid']))) {
                    $this->err->add('商铺审核中不能访问', 212);
                    $this->err->response();
                }
        $fields = K::M('rzpscompany/fields')->detail($company_id);
        foreach ($fields as $k => $v) {
            $company[$k] = $v;
        }
        $company['desc'] = K::M('content/html')->text($company['info']);
        if ($uid = $company['uid']) {
            $company['member'] = K::M('member/member')->detail($uid);
        }
        if ($group_id = $company['group_id']) {
            $company['group'] = K::M('member/group')->group($group_id);
        }
        $this->pagedata['company'] = $company;
        K::M('rzpscompany/company')->update_count($company_id, 'views', 1);
        return $company;
    }

}