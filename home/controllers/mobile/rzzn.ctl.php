<?php

class Ctl_Mobile_Rzzn extends Ctl_Mobile
{
    public function __construct(&$system)
    {
        parent::__construct($system);
//        $uri = $this->request['uri'];
//        if (preg_match('/company-([\d]+).html/i', $uri, $match)) {
//            $system->request['act'] = 'detail';
//            $system->request['args'] = array(
//                $match[1]
//            );
//        }
    }

    public function index()
    {
        $this->items();
    }

    public function items($area_id = 0, $group_id = 0, $order = 0, $page = 1){
        if($_POST){
            $pager = $filter = $orderby = $params = array();
            $p=isset($_REQUEST["p"])?$_REQUEST["p"]:1;
            $p=max($p,1);
            $per=isset($_REQUEST["per"])?$_REQUEST["per"]:5;
            $pager['limit'] = $limit = 10;
            $pager['count'] = $count = 0;
            $filter['city_id'] = $this->request['city']["city_id"];
            $filter['audit'] = 1;
            $filter['closed'] = 0;
            if ($items = K::M('rzzn/rzzn')->items($filter, $orderby, $p, $per, $count)) {
                $pager['count'] = $count;
//            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/company:items', array(
//                $area_id,
//                $group_id,
//                $order,
//                '{page}'
//            ), $params));
                $this->pagedata['items'] = $items;
            }
            $next=$p*$per<$count?$p+1:1;
            die(json_encode(array(
                "code"=>201,
                "items"=>$items,
                "p"=>$next,
                "count"=>$count,
            )));
        }
        $this->tmpl = 'mobile/rzzn/items.html';
    }

    public function detail($company_id)
    {
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['backurl'] = $this->mklink('mobile/company');
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
        $this->tmpl = 'mobile/company/detail.html';
    }

    public function youhui($company_id, $page = 1)
    {
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['page'] = $limit = 5;
        $pager['count'] = $count = 0;
        if ($items = K::M('company/youhui')->items_by_company($company_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $pager['backurl'] = $this->mklink('mobile/company', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/company/youhui.html';
    }

    public function cases($company_id, $page = 1)
    {
        $company = $this->check_company($company_id);
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
        $pager['backurl'] = $this->mklink('mobile/company', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
        $this->tmpl = 'mobile/company/cases.html';
    }

    public function team($company_id, $page = 1)
    {
        $company = $this->check_company($company_id);
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
        $pager['backurl'] = $this->mklink('mobile/company', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
        $this->tmpl = 'mobile/company/team.html';
    }

    public function news($company_id, $page = 1)
    {}

    public function yuyue($company_id = null)
    {
        if (! ($company_id = (int) $company_id) && ! ($company_id = (int) $this->GP('company_id'))) {
            $this->error(404);
        } else 
            if (! $company = K::M('company/company')->detail($company_id)) {
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
                            if ($yuyue_id = K::M('company/yuyue')->create($data)) {
                                K::M('company/company')->update_count($company_id, 'yuyue_num');
                                $this->err->add('预约公司成功');
                                $this->err->set_data('forward', $this->mklink('mobile/company', array(
                                    $company_id
                                )));
                            }
                        }
                    } else {
                        $pager['tender_hide'] = 1;
                        $pager['backurl'] = $this->mklink('mobile/company', array(
                            $company_id
                        ));
                        $this->pagedata['pager'] = $pager;
                        $this->pagedata['company'] = $company;
                        $this->tmpl = 'mobile/company/yuyue.html';
                    }
    }
}