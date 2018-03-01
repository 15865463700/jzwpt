<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Ucenter_Jifen extends Ctl_Mobile_Ucenter
{

    public function index($type = null, $page = 0)
    {
        $filter = $pager = array();
        if (is_numeric($type)) {
            $page = $type;
            $type = null;
        } else 
            if ($type == 'in') {
                $filter['from'] = 1;
            } else 
                if ($type == 'out') {
                    $filter['from'] = 2;
                }
        $pager['type'] = $type;
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $this->uid;
        if ($items = K::M('fenxiao/log')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/ucenter/jifen:index', array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['from'] = $filter['from'];
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/ucenter/jifen/index.html';
    }
}