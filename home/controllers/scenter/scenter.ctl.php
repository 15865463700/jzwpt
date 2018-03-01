<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: ucenter.ctl.php 5808 2014-07-05 07:00:20Z youyi $
 */
class Ctl_Scenter extends Ctl
{

    protected $ctlmaps = array();

    public function __construct(&$system)
    {
        parent::__construct($system);
        $this->ctlmaps = include (dirname(__FILE__) . '/ctlmaps.php');
        $ctlmap = $this->_check_priv($this->MEMBER['from']);
        $this->request['ctlmap'] = $ctlmap;
        $this->pagedata['ctlgroup'] = $this->ctlgroup;
        $this->pagedata['menu_list'] = $this->_parse_menu($this->MEMBER['from']);
        $this->ucenter_city_id = $this->MEMBER['city_id'];
        $this->ucenter_city = K::M('data/city')->city($this->ucenter_city_id);
        if ($this->MEMBER['from'] == 'company') {
            $this->company = K::M('company/company')->company_by_uid($this->MEMBER['uid']);
        }
        
        if ($this->MEMBER['from'] != 'company' && $this->MEMBER['from'] != 'shop') {
            $this->err->add('您的帐号不是公司类型', 215);
            $forward = K::M('helper/link')->mklink('ucenter/member:index', array(), array(), 'base');
            header('Location:' . $forward);
            $this->response();
        }
    }

    protected function ucenter_company()
    {
        if ($this->MEMBER['from'] != 'company') {
            $this->err->add('您的帐号不是安防智能公司类型', 211);
            $this->response();
        } else {
            $this->company = K::M('company/company')->company_by_uid($this->uid);
            if ($this->company) {
                $group = K::M('member/group')->group($this->company['group_id']);
                $this->company['group'] = $this->MEMBER['group'] = $group;
                $this->company['group_name'] = $group['group_name'];
                $this->pagedata['group'] = $group;
                $this->pagedata['company'] = $this->company;
                $this->ucenter_city_id = $this->company['city_id'];
                return $this->company;
            } else {
                if ($this->request['ctl'] == 'scenter/company' && $this->request['act'] == 'info') {
                    $this->pagedata['company_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['company_no_open'] = true;
                    $this->tmpl = 'scenter/company/info.html';
                }
            }
        }
        $this->response();
    }

    protected function ucenter_shop()
    {
        if ($this->MEMBER['from'] != 'shop') {
            $this->err->add('您的帐号不是商家类型', 211);
            $this->response();
        } else 
            if ($this->shop = K::M('shop/shop')->shop_by_uid($this->uid)) {
                $group = K::M('member/group')->group($this->shop['group_id']);
                $this->shop['group'] = $this->MEMBER['group'] = $group;
                $this->shop['group_name'] = $group['group_name'];
                $this->pagedata['group'] = $group;
                $this->pagedata['shop'] = $this->shop;
                $this->ucenter_city_id = $this->shop['city_id'];
                return $this->shop;
            } else 
                if ($this->request['ctl'] == 'scenter/shop' && $this->request['act'] == 'info') {
                    $this->pagedata['shop_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['shop_no_open'] = true;
                    $this->tmpl = 'scenter/shop/info.html';
                }
        $this->response();
    }

    public function ucenter_weixin()
    {
        if ($this->MEMBER['from'] == 'company') {
            $company = $this->ucenter_company();
            $group = $company['group'];
        } else 
            if ($this->MEMBER['from'] == 'shop') {
                $shop = $this->ucenter_shop();
                $group = $shop['group'];
            } else 
                if ($this->MEMBER['from'] == 'gz') {
                    $gz = $this->ucenter_gz();
                    $group = $gz['group'];
                } else 
                    if ($this->MEMBER['from'] == 'designer') {
                        $designer = $this->ucenter_designer();
                        $group = $designer['group'];
                    } else 
                        if ($this->MEMBER['from'] == 'mechanic') {
                            $mechanic = $this->ucenter_mechanic();
                            $group = $mechanic['group'];
                        }
        if ($group['allow_weixin'] < 0) {
            $this->tmpl = 'scenter/weixin/nopriv.html';
        } else 
            if ($this->weixin = K::M('weixin/weixin')->weixin_by_uid($this->uid)) {
                $this->pagedata['weixin'] = $this->weixin;
                return $this->weixin;
            } else 
                if ($this->request['ctl'] == 'scenter/weixin' && $this->request['act'] == 'info') {
                    $this->pagedata['weixin_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['weixin_no_open'] = true;
                    $this->tmpl = 'scenter/weixin/info.html';
                }
        $this->response();
    }

    public function check_login()
    {
        if (! $this->uid) {
            if ($this->request['XREQ'] || $this->request['MINI']) {
                $this->err->add('很抱歉，你还没有登录不能访问', 101);
            } else {
                $this->pagedata['other'] = 1;
                $this->tmpl = 'scenter/passport/login.html';
            }
            $this->err->response();
            exit();
        }
        return true;
    }

    protected function _check_priv($from = 'member')
    {
        $this->check_login();
        $ctlmap = array();
        $request = $this->request;
        foreach ($this->ctlmaps as $group => $menu) {
            foreach ($menu as $k => $v) {
                if ($v['priv']) {
                    if (! in_array($from, explode(',', $v['priv']))) {
                        continue;
                    }
                }
                foreach ($v['items'] as $kk => $vv) {
                    if ($vv['ctl'] == $request['ctl'] . ':' . $request['act']) {
                        if ($vv['priv']) {
                            if (! in_array($from, explode(',', $vv['priv']))) {
                                $ctlmap = array();
                                break;
                            }
                        }
                        $this->ctlgroup = $group;
                        $this->ctlmenu = $menu;
                        $ctlmap = $vv;
                        if ($from == $group) {
                            return $ctlmap;
                        }
                    }
                }
            }
        }
        if ($ctlmap) {
            return $ctlmap;
        }
        if ($this->request['XREQ'] || $this->request['MINI']) {
            $this->err->add('很抱歉，您没有权限访问', 201);
        } else {
            $this->tmpl = 'scenter/nopriv.html';
        }
        
        $this->err->response();
        exit();
    }

    protected function _parse_menu($from)
    {
        $menu_list = array();
        foreach ($this->ctlmenu as $k => $v) {
            if ($v['menu'] && $v['priv']) {
                $priv = explode(',', $v['priv']);
                if (in_array($from, $priv)) {
                    $v['menu'] = true;
                } else {
                    $v['menu'] = false;
                }
            }
            if ($v['menu']) {
                $items = array();
                foreach ($v['items'] as $kk => $vv) {
                    if ($vv['menu'] && $vv['priv']) {
                        $vv['priv'] = explode(',', $vv['priv']);
                        if (! in_array($from, $vv['priv'])) {
                            continue;
                        }
                    }
                    $items[] = $vv;
                }
                if ($v['items'] = $items) {
                    $menu_list[$k] = $v;
                }
            }
        }
        return $menu_list;
    }
	
}