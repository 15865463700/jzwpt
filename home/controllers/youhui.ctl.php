<?php

class Ctl_Youhui extends Ctl
{

    public function index($page = 1)
    {
        $this->items(null, $page);
    }

    public function items($company_id, $page = 1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter['city_id'] = $this->request['city_id'];
        $filter['audit'] = 1;
        if ($items = K::M('company/youhui')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->seo->init('youhui', array(
            'page' => ($page > 1) ? $page : ''
        ));
        $this->tmpl = 'youhui/items.html';
    }

    public function detail($youhui_id)
    {
        $youhui_id=isset($_REQUEST["a"])?$_REQUEST["a"]:$youhui_id;
        if (! $youhui_id = (int) $youhui_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('company/youhui')->detail($youhui_id)) {
                $this->error(404);
            } else 
                if (empty($detail['audit'])) {
                    $this->err->add("内容审核中，暂不可访问", 211)->response();
                } else {
                    $company = $this->check_company($detail['company_id']);
                    $filter = array();
                    $filter['city_id'] = $this->request['city_id'];
                    $filter['stime'] = "<:" . __TIME;
                    $filter['ltime'] = ">:" . __TIME;
                    $filter['youhui_id'] = "<>:" . $youhui_id;
                    $filter['audit'] = 1;
                    $this->pagedata['detail'] = $detail;
                    $this->pagedata['items'] = K::M('company/youhui')->items($filter, array(
                        'youhui_id' => 'DESC'
                    ), 1, 3);
                    $this->pagedata['company'] = $company;
                    $seo = array(
                        'title' => $detail['title'],
                        'company_name' => $company['name'],
                        'youhui_desc' => ''
                    );
                    $seo['youhui_desc'] = K::M('content/text')->substr(K::M('content/html')->text($detail['content'], true), 0, 200);
                    $this->seo->init('youhui_detail', $seo);
                    $this->pagedata['mobile_url'] = $this->mklink('mobile/youhui:detail', array(
                        $youhui_id
                    ));
                    $this->tmpl = 'youhui/detail.html';
                }
    }

    public function sign($youhui_id)
    {
        if (! ($youhui_id = (int) $youhui_id) && ! ($youhui_id = $this->GP('youhui_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('company/youhui')->detail($youhui_id)) {
                $this->error(404);
            } else 
                if (empty($detail['audit'])) {
                    $this->err->add("内容审核中，暂不可访问", 211)->response();
                } elseif ($data = $this->checksubmit('data')) {
                    if (! $data = $this->check_fields($data, 'contact,mobile')) {
                        $this->error(404);
                    } else {
                        $verifycode_success = true;
                        $access = $this->system->config->get('access');
                        if ($access['verifycode']['yuyue']) {
                            if (! $verifycode = $this->GP('verifycode')) {
                                $verifycode_success = false;
                                $this->err->add('验证码不正确', 212);
                            } else 
                                if (! K::M('magic/verify')->check($verifycode)) {
                                    $verifycode_success = false;
                                    $this->err->add('验证码不正确', 212);
                                }
                        }
                        if ($verifycode_success) {
                            $data['uid'] = (int) $this->uid;
                            $data['company_id'] = $detail['company_id'];
                            $data['company_id'] = $detail['company_id'];
                            $company = K::M('company/company')->detail($data['company_id']);
                            $data['youhui_id'] = $youhui_id;
                            $data['city_id'] = $this->request['city_id'];
                            if ($id = K::M('company/sign')->create($data)) {
                                K::M('company/youhui')->update_count($youhui_id, 'sign_num', 1);
                                $smsdata = $maildata = array(
                                    'contact' => $data['contact'] ? $data['contact'] : '业主',
                                    'mobile' => $data['mobile'],
                                    'youhui' => $detail['title'],
                                    'company_name' => $data['company_name']
                                );
                                K::M('sms/sms')->send($data['mobile'], 'youhui_yuyue', $smsdata);
                                K::M('sms/sms')->company('youhui_tongzhi', $smsdata);
                                K::M('helper/mail')->sendmail($detail['mail'], 'youhui_yuyue', $maildata);
                                $this->err->add('恭喜您报名成功！');
                            }
                        }
                    }
                } else {
                    $access = $this->system->config->get('access');
                    $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
                    $this->pagedata['youhui_id'] = $youhui_id;
                    $this->pagedata['detail'] = $detail;
                    $this->tmpl = 'youhui/sign.html';
                }
    }
}