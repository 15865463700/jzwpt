<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

// class Ctl_Jtyjy_Member_Packet extends Ctl_Jtyjy_Jiatingyingjuyuan
class Ctl_Jtyjy_Member_Packet extends Ctl
{

    protected $_allow_packet_fields = 'uid,is_use,ltime';

    public function __construct(&$system)
    {
        parent::__construct($system);
        $menu_list = include (dirname(__FILE__) . "/../ctlmaps.php");
        $this->pagedata['menu_list'] = $menu_list["member"];
        $this->pagedata['ctlgroup'] = $this->ctlgroup;
    }

    public function items($type = 1, $page = 1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if ($type == 1) {
            $filter['is_use'] = 1;
            $filter['ltime'] = '>:' . time();
        } elseif ($type == 2) {
            $filter['is_use'] = 2;
        } elseif ($type == 3) {
            $filter['is_use'] = 1;
            $filter['ltime'] = '<:' . time();
        }
        if ($items = K::M('member/packet')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('member:packet', array(
                $type,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
            $shops = array();
            foreach ($items as $k => $v) {
                $shops[$v['shop_id']] = $v['shop_id'];
            }
            foreach ($shops as $k => $v) {
                if ($v == '') {
                    unset($shops[$k]);
                }
            }
            if ($shops) {
                
                $this->pagedata['shop'] = K::M('shop/shop')->items_by_ids($shops);
            }
        }
        
        $pager['type'] = $type;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cate'] = K::M('shop/cate')->items(array(
            'parent_id' => '0'
        ));
        $this->tmpl = 'jtyjy/member/packet/index.html';
    }

    public function create()
    {
        if ($data = $this->checksubmit('data')) {
            
            if ($items = K::M('member/packet')->items(array(
                'code' => $data['code'],
                'is_use' => '0'
            ))) {
                $data['uid'] = $this->uid;
                $detail = current($items);
                $data['ltime'] = time() + $detail['time'] * 24 * 60 * 60;
                $data['is_use'] = '1';
                if (K::M('member/packet')->update($detail['id'], $data)) {
                    $this->err->add('添加红包成功');
                    $this->tmpl = 'jtyjy/member/packet/items.html';
                }
            } else {
                $this->err->add('该code码不存在', 215);
            }
        }
    }
}