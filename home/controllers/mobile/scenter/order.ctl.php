<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Scenter_Order extends Ctl_Mobile_Scenter
{

    public function shop_order()
    {
        $shop = $this->ucenter_shop();
        $filter['uid'] = $this->uid;
        $pager['backurl'] = $this->mklink('mobile/scenter');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/scenter/order/shop_order.html';
    }
    //
    public function shop_index($type = null)
    {
        $shop = $this->ucenter_shop();
        if (! $type) {
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
                case 'unship':
                    $filter['order_status'] = 0;
                    break;
                case 'ship':
                    $filter['order_status'] = 1;
                    break;
                default:
                    $type = 'all';
            }
        }
        $pager['type'] = $type;
        $filter['shop_id'] = $shop['shop_id'];
        $filter['closed'] = 0;
        
        if ($items = K::M('trade/order')->items($filter)) {
            $this->pagedata['items'] = $items;
            $order_ids = $uids = array();
            foreach ($items as $k => $v) {
                $order_ids[$v['order_id']] = $v['order_id'];
                $uids[$v['uid']] = $v['uid'];
            }
            if ($order_ids) {
                $product_ids = array();
                if ($product_list = K::M('trade/product')->items(array(
                    'order_id' => $order_ids
                ), null, 1, 1000)) {
                    foreach ($product_list as $v) {
                        $product_ids[$v['product_id']] = $v['product_id'];
                    }
                }
                if ($product_ids) {
                    if ($org_products = K::M('product/product')->items_by_ids($product_ids)) {
                        foreach ($product_list as $k => $v) {
                            $product_list[$k] = array_merge((array) $org_products[$v['product_id']], $v);
                        }
                    }
                }
                $this->pagedata['product_list'] = $product_list;
            }
            if ($uids) {
                $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
            }
        }
        $pager['backurl'] = $this->mklink('mobile/scenter/order-shop_order');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/scenter/order/shop_items.html';
    }
    //
    public function shop_update($status, $order_no = null)
    {
        $shop = $this->ucenter_shop();
        if (! in_array($status, array(
            'ship',
            'cancel'
        ))) {
            $this->error(404);
        } else 
            if (! is_numeric($order_no)) {
                $this->error(404);
            } else 
                if (! $order = K::M('trade/order')->detail_by_no($order_no)) {
                    $this->err->add('订单不存在或已经删除', 211);
                } else 
                    if ($order['shop_id'] != $shop['shop_id']) {
                        $this->err->add('您没有权限操作该订单', 211);
                    } else 
                        if ($order['order_status'] < 0) {
                            $this->err->add('订单已经取消，不可操作', 212);
                        } else 
                            if ($order['order_status'] == 2) {
                                $this->err->add('订单已完成，不可操作', 213);
                            } else 
                                if ('cancel' == $status) {
                                    if ($order['pay_status']) {
                                        $this->err->add('订单已支付，不可取消', 214);
                                    } else 
                                        if ($order['order_status'] > 0) {
                                            $this->err->add('订单已发货不可取消', 215);
                                        } else {
                                            if (K::M('trade/order')->update($order['order_id'], array(
                                                'order_status' => - 2
                                            ), true)) {
                                                $log = K::M('payment/log')->log_by_no($order['order_no']);
                                                if ($log['packet']) {
                                                    K::M('member/packet')->update($log['packet'], array(
                                                        'is_use' => '1',
                                                        'desc' => ''
                                                    ), true);
                                                }
                                                $this->err->add('取消订单成功');
                                            }
                                        }
                                } else 
                                    if ('ship' == $status) {
                                        if ($order['order_status'] == 1) {
                                            $this->err->add('订单已经发货,不可重复发货', 214);
                                        } else 
                                            if (empty($order['order_status'])) {
                                                if (K::M('trade/order')->update($order['order_id'], array(
                                                    'order_status' => 1
                                                ), true)) {
                                                    $member = K::M('member/member')->member($order['uid']);
                                                    $smsdata = $maildata = array(
                                                        'order_no' => $order['order_no'],
                                                        'order_amount' => $order['amount'],
                                                        'contact' => $order['contact']
                                                    );
                                                    if ($mobile = K::M('verify/check')->mobile($order['mobile'])) {
                                                        K::M('sms/sms')->send($order['mobile'], 'order_ship_buyer', $smsdata);
                                                    } else 
                                                        if ($member['verify_mobile'] && K::M('verify/check')->mobile($member['mobile'])) {
                                                            K::M('sms/sms')->send($member['mobile'], 'order_ship_buyer', $smsdata);
                                                        }
                                                    $maildata['link'] = K::M('helper/link')->mklink('trade/order:detail', array(
                                                        $order['order_no']
                                                    ), array(), true);
                                                    if ($member['mail']) {
                                                        K::M('helper/mail')->send($member['mail'], 'order_ship_buyer', $maildata);
                                                    }
                                                    $this->err->add('订单发货成功');
                                                }
                                            }
                                    }
    }
 //
    public function shop_detail($order_no = null)
    {
        $shop = $this->ucenter_shop();
        if (! is_numeric($order_no)) {
            $this->error(404);
        } else 
            if ($this->check_login()) {
                if (! $order = K::M('trade/order')->detail_by_no($order_no)) {
                    $this->err->add('您的订单不存在或已经删除', 211);
                } else 
                    if (! $shop = K::M('shop/shop')->detail($order['shop_id'])) {
                        $this->err->add('商家不存在或已经删除', 211);
                    } else 
                        if (($order['uid'] != $this->uid) && ($shop['uid'] != $this->uid)) {
                            $this->err->add('您没有权限查看该订单', 212);
                        } else {
                            $this->pagedata['shop'] = $shop;
                            $this->pagedata['order'] = $order;
                            $pager['backurl'] = $this->mklink('mobile/scenter/order-shop_index');
                            $this->pagedata['pager'] = $pager;
                            $this->tmpl = 'mobile/scenter/order/detail.html';
                        }
            }
    }
}
