<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Ucenter_Jforder extends Ctl_Mobile_Ucenter
{

    public function index($type = null)
    {
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
        $filter['uid'] = $this->uid;
        $filter['closed'] = 0;
        if ($items = K::M('trade/jforder')->items($filter)) {
            $order_ids = $shop_ids = array();
            foreach ($items as $k => $v) {
                $order_ids[$v['order_id']] = $v['order_id'];
                // $shop_ids[$v['shop_id']] = $v['shop_id'];
            }
            $this->pagedata['items'] = $items;
        }
        $pager['type'] = $type;
        $pager['backurl'] = $this->mklink('mobile/ucenter');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/ucenter/jforder/items.html';
    }

    public function orders()
    {
        $filter['uid'] = $this->uid;
        $pager['backurl'] = $this->mklink('mobile/ucenter');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/ucenter/order/orders.html';
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
                                    if ($order['order_status'] > 0) {
                                        $this->err->add('订单已经取消，不需要重复操作', 215);
                                    } else 
                                        if ($order['pay_status']) {
                                            $this->err->add('订单已支付，不可取消', 216);
                                        } else {
                                            if (K::M('trade/jforder')->update($order['order_id'], array(
                                                'order_status' => - 1
                                            ), true)) {
                                                $data['uid'] = $order['uid']; // from,tenders_id,number,log,admin,clientip,dateline
                                                $data['from'] = 1;
                                                $data['number'] = $order['jfamount'];
                                                $data['log'] = '积分商城取消订单';
                                                $log = K::M('fenxiao/log')->create($data);
                                                $this->err->add('取消订单成功');
                                            }
                                        }
                                } else 
                                    if ('ship' == $status) {
                                        if ($order['order_status'] != 1) {
                                            $this->err->add('只有商家发货后才能确认收货', 217);
                                        } else 
                                            if (K::M('trade/jforder')->update($order['order_id'], array(
                                                'order_status' => 2
                                            ), true)) {
                                                // K::M('shop/shop')->udpate_count($order['shop_id'], 'credit', 1);
                                                /*
                                                 * if($shop = K::M('shop/shop')->detail($order['shop_id'])){
                                                 * $maildata = array('order_no'=>$order['order_no'], 'order_amount'=>$order['amount'], 'contact'=>$order['contact']);
                                                 * $maildata['shop_name'] = $shop['name'];
                                                 * $maildata['shop_phone'] = $shop['phone'];
                                                 * if($member = K::M('member/member')->member($shop['uid'])){
                                                 * $shop['member'] = $member;
                                                 * }
                                                 * K::M('helper/mail')->sendshop($shop, 'order_ship_seller', $maildata);
                                                 * }
                                                 */
                                                $this->err->add('确认收货成功');
                                            }
                                    }
    }

    public function payment($order_no = null)
    {
        if (! is_numeric($order_no) && ! ($order_no = (int) $this->GP('order_no'))) {
            $this->error(404);
        } else 
            if ($this->check_login()) {
                if (! $order = K::M('trade/jforder')->detail_by_no($order_no)) {
                    $this->err->add('您的订单不存在或已经删除', 211);
                } else 
                    if ($order['order_status'] < 0) {
                        $this->err->add('订单已经取消不可支付', 212);
                    } else 
                        if ($order['order_status'] == 2) {
                            $this->err->add('订单已经完成不可支付', 213);
                        } else 
                            if ($order['pay_status']) {
                                $this->err->add('该订单已经支付过了,不需要重复支付', 212);
                            } else {
                                $this->pagedata['order'] = $order;
                                $pager['backurl'] = $this->mklink('mobile/ucenter/order-index');
                                $this->pagedata['pager'] = $pager;
                                $this->tmpl = 'mobile/ucenter/jforder/payment.html';
                            }
            }
    }

    public function detail($order_no = null)
    {
        if (! is_numeric($order_no)) {
            $this->error(404);
        } else 
            if ($this->check_login()) {
                if (! $order = K::M('trade/jforder')->detail_by_no($order_no)) {
                    $this->err->add('您的订单不存在或已经删除', 211);
                } else 
                    if (($order['uid'] != $this->uid) && ($shop['uid'] != $this->uid)) {
                        $this->err->add('您没有权限查看该订单', 212);
                    } else {
                        $this->pagedata['order'] = $order;
                        $pager['backurl'] = $this->mklink('mobile/ucenter/jforder-index');
                        $this->pagedata['pager'] = $pager;
                        $this->tmpl = 'mobile/ucenter/jforder/detail.html';
                    }
            }
    }

    public function create($product_id = null)
    {
        if ($this->uid) {
            if (! $product = K::M('jfproduct/jfproduct')->detail($product_id)) {
                $this->err->add('商品不存在或已删除', 211);
            } else 
                if (! $product['audit']) {
                    $this->err->add('商品未审核', 211);
                } else 
                    if ($product['kucun'] <= 0) {
                        $this->err->add('库存不足', 211);
                    } else {
                        $filter['uid'] = $this->uid;
                        $filter['closed'] = 0;
                        if ($items = K::M('order/address')->items($filter, null, $count)) {
                            $this->pagedata['items'] = $items;
                        }
                        $product['num'] = $data['num'];
                        $this->pagedata['product'] = $product;
                        $this->tmpl = 'mobile/jfproduct/order/create.html';
                    }
        } else {
            $this->check_login();
        }
    }

    public function shop_order()
    {
        $filter['uid'] = $this->uid;
        $pager['backurl'] = $this->mklink('mobile/ucenter');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/ucenter/order/shop_order.html';
    }

    public function shop_index($type = null)
    {
        $shop = $this->ucenter_shop();
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
        $pager['backurl'] = $this->mklink('mobile/ucenter/order-shop_order');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/ucenter/order/shop_items.html';
    }

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

    public function shop_detail($order_no = null)
    {
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
                            $pager['backurl'] = $this->mklink('mobile/ucenter/order-shop_index');
                            $this->pagedata['pager'] = $pager;
                            $this->tmpl = 'mobile/ucenter/order/detail.html';
                        }
            }
    }

    public function address()
    {
        $pager = $filter = array();
        if (is_numeric($type)) {
            $page = $type;
            $type = 'all';
        }
        $pager['type'] = $type;
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        ;
        $filter['closed'] = 0;
        if ($items = K::M('order/address')->items($filter, null, $page, $limit, $count)) {
            $i = 1;
            foreach ($items as $k => $v) {
                $items[$k]['id'] = $i ++;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $type,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->tmpl = 'mobile/ucenter/order/address.html';
    }

    public function address_detail($addr_id = null)
    {
        if (! $addr_id) {
            $this->err->add('非法的数据提交', 211);
        } else {
            if (! $data = K::M('order/address')->detail($addr_id)) {
                $this->err->add('该数据不存在', 212);
            } elseif ($data['uid'] != $this->uid) {
                $this->err->add('没权限', 214);
            } else {
                $this->pagedata['data'] = $data;
                $this->tmpl = 'mobile/ucenter/order/address_detail.html';
            }
        }
    }

    public function create_addr()
    {
        if ($data = $this->checksubmit('data')) {
            $data['uid'] = $this->uid;
            if (K::M('order/address')->create($data, true)) {
                $this->err->add('添加地址成功');
            }
        }
        $this->tmpl = 'mobile/ucenter/order/address.html';
    }

    public function update_addr($addr_id = null)
    {
        if ($addr_id && $data = $this->checksubmit('data')) {
            if (K::M('order/address')->update($addr_id, $data)) {
                $this->err->add('修改地址成功');
                $this->err->set_data('forward', $this->mklink('mobile/ucenter/order:address'));
            }
        }
    }

    public function delete_addr($addr_id = null)
    {
        K::M('order/address')->delete($addr_id);
        $this->err->add('删除地址成功');
        $this->err->set_data('forward', $this->mklink('mobile/ucenter/order:address'));
    }

    public function default_addr($addr_id = null)
    {
        if (! $addr_id) {
            $this->err->add('设置失败', 215);
        } else {
            $uid = $this->uid;
            $attr['default'] = '0';
            K::M('order/address')->set_default($uid, $attr);
            $attr['default'] = '1';
            if (K::M('order/address')->update($addr_id, $attr)) {
                $this->err->add('设置默认成功');
                $this->err->set_data('forward', $this->mklink('mobile/ucenter/order:address'));
            }
        }
    }
}