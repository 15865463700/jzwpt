<?php

class Ctl_Mobile_Afzncompany extends Ctl_Mobile{

    public function __construct(&$system){
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/afzncompany-([\d]+).html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[1]
            );
        }
    }

    public function index(){
        $this->items();
    }

    public function detail($company_id)
    {
        $company = $this->check_afzncompany($company_id);
        $pager = array();
        $pager['backurl'] = "/mobile/rzzn/";
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/afzncompany/detail.html';
    }

    public function youhui($company_id, $page = 1)
    {
        $company = $this->check_afzncompany($company_id);
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['page'] = $limit = 5;
        $pager['count'] = $count = 0;
        if ($items = K::M('afzncompany/youhui')->items_by_company($company_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $pager['backurl'] = $this->mklink('mobile/afzncompany', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/afzncompany/youhui.html';
    }

    public function cases($company_id, $page = 1)
    {
        $company = $this->check_afzncompany($company_id);
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
        $pager['backurl'] = $this->mklink('mobile/afzncompany', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_company($company);
        // $this->seo->init('company');
        $this->tmpl = 'mobile/afzncompany/cases.html';
    }

    public function team($company_id, $page = 1)
    {
        $company = $this->check_afzncompany($company_id);
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
        $pager['backurl'] = $this->mklink('mobile/afzncompany', array(
            $company_id
        ));
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_company($company);
        // $this->seo->init('company');
        $this->tmpl = 'mobile/afzncompany/team.html';
    }

    public function news($company_id, $page = 1)
    {}

    public function yuyue($company_id = null)
    {
        if (! ($company_id = (int) $company_id) && ! ($company_id = (int) $this->GP('company_id'))) {
            $this->error(404);
        } else 
            if (! $company = K::M('afzncompany/company')->detail($company_id)) {
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
                            if ($yuyue_id = K::M('afzncompany/yuyue')->create($data)) {
                                K::M('afzncompany/company')->update_count($company_id, 'yuyue_num');
                                $this->err->add('预约公司成功');
                                $this->err->set_data('forward', $this->mklink('mobile/afzncompany', array(
                                    $company_id
                                )));
                            }
                        }
                    } else {
                        $pager['tender_hide'] = 1;
                        $pager['backurl'] = $this->mklink('mobile/afzncompany', array(
                            $company_id
                        ));
                        $this->pagedata['pager'] = $pager;
                        $this->pagedata['company'] = $company;
                        $this->tmpl = 'mobile/afzncompany/yuyue.html';
                    }
    }

    protected function check_afzncompany(&$company_id = null)
    {
        if (! $company_id = (int) $company_id) {
            $this->error(404);
        } else 
            if (! $company = K::M('afzncompany/company')->detail($company_id, true)) {
                $this->error(404);
            } else 
                if (empty($company['audit']) && (empty($this->uid) || ($this->uid != $company['uid']))) {
                    $this->err->add('商铺审核中不能访问', 212);
                    $this->err->response();
                }
        $fields = K::M('afzncompany/fields')->detail($company_id);
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
        K::M('afzncompany/company')->update_count($company_id, 'views', 1);
        return $company;
    }

}