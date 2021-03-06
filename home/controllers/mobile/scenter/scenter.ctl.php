<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Scenter extends Ctl_Mobile
{

    protected $ctlmaps = array();

    public function __construct(&$system)
    {
        parent::__construct($system);
        $this->check_login();
        $this->pagedata['ctlgroup'] = $this->ctlgroup;
        $this->pagedata['menu_list'] = $this->_parse_menu($this->MEMBER['from']);
    }

    public function check_login()
    {
        if (! $this->uid) {
            if ($this->request['XREQ'] || $this->request['MINI']) {
                $this->err->add('很抱歉，你还没有登录不能访问', 101);
            } else {
                $this->pagedata['other'] = 1;
                $this->tmpl = 'mobile/scenter/passport/login.html';
            }
            $this->err->response();
            exit();
        }
        return true;
    }

    protected function scenter_check()
    {
        if ($this->MEMBER['from'] != 'company' && $this->MEMBER['from'] != 'shop') {
            $this->err->add('您的帐号不是商家类型', 211);
        } else {
            if ($this->MEMBER['from'] == 'company') {
                if ($this->company = K::M('company/company')->company_by_uid($this->uid)) {
                    $group = K::M('member/group')->group($this->company['group_id']);
                    $this->company['group'] = $group;
                    $this->company['group_name'] = $group['group_name'];
                    $this->pagedata['group'] = $group;
                    $this->pagedata['company'] = $this->company;
                    return $this->company;
                } else 
                    if ($this->request['ctl'] == 'ucenter/company' && $this->request['act'] == 'info') {
                        $this->pagedata['company_no_open'] = true;
                        return false;
                    } else {
                        $this->pagedata['company_no_open'] = true;
                        $this->tmpl = 'mobile/scenter/other_info.html';
                    }
            } else {
                if ($this->shop = K::M('shop/shop')->shop_by_uid($this->uid)) {
                    $group = K::M('member/group')->group($this->shop['group_id']);
                    $this->shop['group'] = $group;
                    $this->shop['group_name'] = $group['group_name'];
                    $this->pagedata['group'] = $group;
                    $this->pagedata['shop'] = $this->shop;
                    return $this->shop;
                } else 
                    if ($this->request['ctl'] == 'ucenter/shop' && $this->request['act'] == 'info') {
                        $this->pagedata['shop_no_open'] = true;
                        return false;
                    } else {
                        $this->pagedata['shop_no_open'] = true;
                        $this->tmpl = 'mobile/scenter/other_info.html';
                    }
            }
        }
        $this->response();
    }

    protected function ucenter_company()
    {
        if ($this->MEMBER['from'] != 'company') {
            $this->err->add('您的帐号不是装修公司类型', 211);
        } else 
            if ($this->company = K::M('company/company')->company_by_uid($this->uid)) {
                $group = K::M('member/group')->group($this->company['group_id']);
                $this->company['group'] = $group;
                $this->company['group_name'] = $group['group_name'];
                $this->pagedata['group'] = $group;
                $this->pagedata['company'] = $this->company;
                return $this->company;
            } else 
                if ($this->request['ctl'] == 'ucenter/company' && $this->request['act'] == 'info') {
                    $this->pagedata['company_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['company_no_open'] = true;
                    $this->tmpl = 'mobile/scenter/other_info.html';
                }
        $this->response();
    }

    protected function ucenter_shop()
    {
        if ($this->MEMBER['from'] != 'shop') {
            $this->err->add('您的帐号不是商家类型', 211);
        } else 
            if ($this->shop = K::M('shop/shop')->shop_by_uid($this->uid)) {
                $group = K::M('member/group')->group($this->shop['group_id']);
                $this->shop['group'] = $group;
                $this->shop['group_name'] = $group['group_name'];
                $this->pagedata['group'] = $group;
                $this->pagedata['shop'] = $this->shop;
                return $this->shop;
            } else 
                if ($this->request['ctl'] == 'ucenter/shop' && $this->request['act'] == 'info') {
                    $this->pagedata['shop_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['shop_no_open'] = true;
                    $this->tmpl = 'mobile/scenter/other_info.html';
                }
        $this->response();
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