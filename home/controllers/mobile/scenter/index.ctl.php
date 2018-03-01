<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Scenter_Index extends Ctl_Mobile_Scenter
{

    public function index()
    {
        $member = $this->scenter_check();
        if ($this->MEMBER['from'] == 'shop') {
            $shop = $this->ucenter_shop();
            $filter['shop_id'] = $shop['shop_id'];
            $filter['closed'] = 0;
            $items = K::M('trade/order')->items($filter, null, 1, 100000);
            $arr1 = $arr2 = $arr3 = $arr4 = array();
            foreach ($items as $k => $v) {
                if ($v['pay_status'] == 1 and ($v['order_status'] == 0 || $v['order_status'] == 1)) {
                    $arr1[] = $v;
                } else 
                    if ($v['pay_status'] == 0 and ($v['order_status'] == 0 || $v['order_status'] == 1)) {
                        $arr2[] = $v;
                    } else 
                        if ($v['order_status'] == 0) {
                            $arr3[] = $v;
                        } else 
                            if ($v['order_status'] == 2) {
                                $arr4[] = $v;
                            }
            }
            $count = array(
                'count1' => count($arr2),
                'count2' => count($arr1),
                'count3' => count($arr3),
                'count4' => count($arr4)
            );
            $this->pagedata['count'] = $count;
        } else {
            $company = $this->ucenter_company();
            $filter['company_id'] = $company['company_id'];
            $arr1 = $arr2 = $arr3 = $arr4 = array();
            $arr1 = K::M('tenders/look')->items($filter, null, 1, 100000, $count1);
            
            $arr2 = K::M('zxb/zxb')->items($filter, null, 1, 100000, $count2);
            $arr3 = K::M('company/yuyue')->items($filter, null, 1, 100000, $count3);
            $arr4 = K::M('company/sign')->items($filter, null, 1, 100000, $count4);
            $count = array(
                'count1' => count($arr1),
                'count2' => count($arr2),
                'count3' => count($arr3),
                'count4' => count($arr4)
            );
            $this->pagedata['count'] = $count;
        }
        $pager['backurl'] = $this->mklink('mobile');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/scenter/index.html';
    }

    public function appointment()
    {
        $member = $this->scenter_check();
        $temp = 'ucenter_' . $this->MEMBER['from'];
        
        $form_list = $this->$temp();
        $filter = array(
            'uid' => $form_list['uid'],
            'closed' => 0
        );
        if ($items = K::M($this->MEMBER['from'] . '/yuyue')->items($filter)) {
            $this->pagedata['items'] = $items;
        }
        $pager['backurl'] = $this->mklink('mobile/scenter');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/scenter/appointment.html';
    }
}
