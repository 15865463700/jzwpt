<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

// class Ctl_Jtyjy_Company_Money extends Ctl_Jtyjy_Jiatingyingjuyuan
class Ctl_Jtyjy_Company_Money extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $menu_list = include (dirname(__FILE__) . "/../ctlmaps.php");
        $this->pagedata['menu_list'] = $menu_list["company"];
        $this->pagedata['ctlgroup'] = "company";
    }

    public function company($type = 'all', $page = 1)
    {
        // $company = $this->ucenter_company();
        // $filter = $pager = array();
        // $filter['uid'] = $company['uid'];
        // if(is_numeric($type)){
        // $page = $type;
        // }
        // if($type == 'in'){
        // $filter['money'] = '>:0';
        // }else if($type == 'out'){
        // $filter['money'] = '<:0';
        // }else{
        // $type = 'all';
        // }
        // $pager['type'] = $type;
        // $pager['page'] = $page = max((int)$page, 1);
        // $pager['limit'] = $limit = 20;
        // $pager['count'] = $count = 0;
        //
        // if($items = K::M('shop/money')->items($filter, null, $page, $limit, $count)){
        // $pgaer['count'] = $count;
        // $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($type, '{page}')));
        // $this->pagedata['items'] = $items;
        // }
        // $this->pagedata['pager'] = $pager;
        $this->tmpl = 'jtyjy/company/money/items.html';
    }

    public function tixian()
    {
        $company = $this->ucenter_company();
        $member = K::M('member/member')->detail($company['uid']);
        if ($data = $this->checksubmit('data')) {
            if (! is_numeric($data['money'])) {
                $this->err->add('提现金额不合法', 211);
            } else 
                if (! $money = round($data['money'], 2)) {
                    $this->err->add('提现金额不合法', 212);
                } else 
                    if ($money > $member['truste_money']) {
                        $this->err->add('提现金额不能大于你的账户余额', 213);
                    } else 
                        if (K::M('shop/money')->request_tixian($member['uid'], - $money)) {
                            $this->err->add('申请提现成功，等待财务审核');
                        }
        } else {
            $this->pagedata['member'] = $member;
            $this->tmpl = 'jtyjy/company/money/tixian.html';
        }
    }
}