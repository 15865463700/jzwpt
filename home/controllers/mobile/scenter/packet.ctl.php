<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Scenter_Packet extends Ctl_Mobile_Scenter
{

    public function items($use = 1, $page = 1)
    {
        $shop = $this->ucenter_shop();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if ($use == 1) {
            $filter['is_use'] = 0;
        } elseif ($use == 2) {
            $filter['is_use'] = 1;
            $filter['ltime'] = '>:' . time();
        } elseif ($use == 3) {
            $filter['is_use'] = 2;
        } elseif ($use == 4) {
            $filter['is_use'] = 1;
            $filter['ltime'] = '<:' . time();
        }
        $filter['shop_id'] = $shop['shop_id'];
        if ($items = K::M('member/packet')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )), array(
                'SO' => $SO
            ));
            
            $uids = array();
            foreach ($items as $k => $v) {
                $uids[$v['uid']] = $v['uid'];
            }
            foreach ($uids as $k => $v) {
                if ($v == '') {
                    unset($uids[$k]);
                }
            }
            if ($uids) {
                $this->pagedata['member'] = K::M('member/member')->items_by_ids($uids);
            }
        }
        
        $pager['type'] = $use;
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/scenter/packet/index.html';
    }

    public function create()
    {
        $shop = $this->ucenter_shop();
        if ($data = $this->checksubmit('data')) {
            for ($i = 0; $i < $data['number']; $i ++) {
                $data['shop_id'] = $shop['shop_id'];
                $data['type'] = '2';
                $data['code'] = K::M('member/packet')->create_code();
                K::M('member/packet')->create($data);
            }
            $this->err->add('红包生成成功');
            $this->err->set_data('forward', '/mobile/scenter/packet/items.html');
        } else {
            $this->err->add('未指定要生成的内容', 211);
        }
    }
}