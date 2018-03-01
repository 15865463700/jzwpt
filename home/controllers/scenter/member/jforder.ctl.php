<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Scenter_Member_Jforder extends Ctl_Scenter
{

    public function index($type = null, $page = 1)
    {
        // $pager = $filter = array();
        $pager = $filter = array();
        if (is_numeric($type)) {
            $page = $type;
            $type = 'all';
        } else {
            switch ($type) {
                case 'payed':
                    $filter['pay_status'] = 1;
                    $filter['order_status'] = array(
                        0,
                        1
                    );
                    break;
                case 'unpay':
                    $filter['pay_status'] = 0;
                    $filter['order_status'] = array(
                        0,
                        1
                    );
                    break;
                case 'finish':
                    $filter['order_status'] = 2;
                    break;
                case 'cancel':
                    $filter['order_status'] = '<:0';
                    break;
                case 'ship':
                    $filter['order_status'] = 1;
                    break;
                default:
                    $type = 'all';
            }
        }
        $pager['type'] = $type;
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        $filter['closed'] = 0;
        if ($items = K::M('trade/jforder')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $type,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'scenter/member/jforder/items.html';
    }

    public function update($status, $order_no = null)
    {
        if (! in_array($status, array(
            'ship',
            'cancel'
        ))) {
            $this->error(404);
        } else 
            if (! is_numeric($order_no)) {
                $this->error(404);
            } else 
                if (! $order = K::M('trade/jforder')->detail_by_no($order_no)) {
                    $this->err->add('订单不存在或已经删除', 211);
                } else 
                    if ($order['uid'] != $this->uid) {
                        $this->err->add('您没有权限操作该订单', 212);
                    } else 
                        if ($order['order_status'] < 0) {
                            $this->err->add('订单已经取消，不可操作', 213);
                        } else 
                            if ($order['order_status'] == 2) {
                                $this->err->add('订单已完成，不可操作', 214);
                            } else 
                                if ('cancel' == $status) {
                                    if ($order['order_status'] < 0) {
                                        $this->err->add('订单已经取消，不需要重复操作', 215);
                                    } else 
                                        if ($order['pay_status'] && ($order['amount'] > 0)) {
                                            $this->err->add('订单已兑换，不可取消', 216);
                                        } else 
                                            if ($order['pay_status'] == 1) {
                                                $this->err->add('订单已兑换，不可取消', 217);
                                            } else {
                                                if (K::M('trade/jforder')->update($order['order_id'], array(
                                                    'order_status' => - 1
                                                ), true)) {
                                                    // K::M('member/gold')->update($order['uid'],$order['jfamount'],'取消订单退回金币');
                                                    $member = $this->MEMBER;
                                                    K::M('member/member')->update($member['uid'], array(
                                                        'jifen' => $member['jifen'] + $data['jfamount']
                                                    ), $checked = false);
                                                    $this->err->add('取消订单成功');
                                                }
                                            }
                                } else 
                                    if ('ship' == $status) {
                                        if (K::M('trade/jforder')->update($order['order_id'], array(
                                            'order_status' => 2
                                        ), true)) {
                                            $this->err->add('确认收货成功');
                                        }
                                    }
    }
}