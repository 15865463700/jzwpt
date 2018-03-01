<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Dcenter_Index extends Ctl_Mobile_Dcenter
{

    public function index()
    {
        $member = $this->dcenter_check();
        
        $filter['uid'] = $member['uid'];
        $arr1 = $arr2 = array();
        $arr1 = K::M('tenders/look')->items($filter, null, 1, 100000, $count1);
        $arr2 = K::M($member['from'] . '/yuyue')->items($filter, null, 1, 100000, $count3);
        $count = array(
            'count1' => count($arr1),
            'count2' => count($arr2)
        );
        $this->pagedata['count'] = $count;
        
        $pager['backurl'] = $this->mklink('mobile');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/dcenter/index.html';
    }

    public function appointment()
    {
        $member = $this->dcenter_check();
        $temp = 'ucenter_' . $this->MEMBER['from'];
        
        $form_list = $this->$temp();
        $filter = array(
            'uid' => $form_list['uid'],
            'closed' => 0
        );
        if ($items = K::M($this->MEMBER['from'] . '/yuyue')->items($filter)) {
            $this->pagedata['items'] = $items;
        }
        $pager['backurl'] = $this->mklink('mobile/dcenter');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/dcenter/appointment.html';
    }
}
