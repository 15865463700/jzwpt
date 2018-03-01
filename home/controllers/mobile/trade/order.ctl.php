<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Mobile_Trade_Order extends Ctl_Mobile
{

    public function create()
    {
        $this->check_login();
        if (! $data = $this->checksubmit('data')) {
            $this->err->add('非法的数据提交', 211);
        } else {
            $data['uid'] = $this->uid;
            $cart = K::M('trade/cart')->detail();
            if (empty($cart['product_count'])) {
                $this->err->add('您的购物车中没有商品，请先添加要购买的商品', 212);
                $this->err->set_data('forward', $this->mklink('mobile/prolduct'));
            } else 
                if ($order = K::M('trade/order')->create_by_cart($cart, $data)) {
                    $this->system->cookie->set('Order-Buy', 1, 3600);
                    $this->err->add('提交定单成功');
                    K::M('trade/cart')->clean();
                    $this->err->set_data('forward', $this->mklink('mobile/trade/order:success', array(
                        $order['order_no']
                    )));
                }
        }
    }

    public function success($order_no)
    {
        if (! $this->system->cookie->get('Order-Buy')) {
            header("Location:" . $this->mklink('trade/order:detail', array(
                $order_no
            )));
            exit();
        } else 
            if ($order = K::M('trade/order')->detail_by_no($order_no)) {
                $this->pagedata['order'] = $order;
                $pager['order_no'] = $order_no;
                $this->pagedata['pager'] = $pager;
                $this->tmpl = 'mobile/trade/order/success.html';
            }
    }

    public function detail($order_no = null)
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
                            $this->tmpl = 'mobile/trade/order/detail.html';
                        }
            }
    }

    public function payment($order_no = null)
    {
        if (! is_numeric($order_no) && ! ($order_no = (int) $this->GP('order_no'))) {
            $this->error(404);
        } else 
            if ($this->check_login()) {
                if (! $order = K::M('trade/order')->detail_by_no($order_no)) {
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
                                $log = K::M('payment/log')->log_by_no($order_no);
                                if ($log['packet']) {
                                    $detail = K::M('member/packet')->detail($log['packet']);
                                }
                                
                                $filter['is_use'] = 1;
                                $filter['uid'] = $this->uid;
                                $filter['ltime'] = '>:' . time();
                                $filter['shop_id'] = array(
                                    '0',
                                    $order['shop_id']
                                );
                                $c = array();
                                $cat[0] = 0;
                                foreach ($order["products"] as $k => $v) {
                                    if ($c[$v["cat_id"]]) {
                                        $c[$v["cat_id"]] += $v['product_price'] * $v["number"];
                                    } else {
                                        $c[$v["cat_id"]] = $v['product_price'] * $v["number"];
                                    }
                                    $cat[] = $v["cat_id"];
                                }
                                
                                $filter['cate_id'] = $cat;
                                
                                $packet = K::M('member/packet')->items($filter, array(
                                    'price' => 'desc'
                                ));
                                
                                foreach ($packet as $k => $v) {
                                    if ($v['cate_id']) {
                                        if ($c[$v['cate_id']] < $v['man']) {
                                            unset($packet[$k]);
                                        }
                                    }
                                    
                                    if ($order['product_amount'] < $v['man']) {
                                        unset($packet[$k]);
                                    }
                                }
                                if ($detail) {
                                    $packet[$log['packet']] = $detail;
                                }
                                if ($packet_id) {
                                    $max_packet = $packet[$packet_id];
                                } elseif ($detail) {
                                    $max_packet = $detail;
                                } else {
                                    $max_packet = reset($packet);
                                }
                                $this->pagedata['max_packet'] = $max_packet;
                                $order['amount'] = $order['amount'] - $max_packet['price'];
                                $this->pagedata['packet'] = $packet;
                                if (! $packet_id) {
                                    $packet_id = $max_packet['id'];
                                } else {
                                    if (! $packet[$packet_id]) {
                                        if ($log['packet']) {
                                            $packet_id = $log['packet'];
                                        } else {
                                            $packet_id = 0;
                                        }
                                    }
                                }
                                $this->pagedata['packet_id'] = $packet_id;
                                $pager = array();
                                $pager['backurl'] = $this->mklink('mobile/trade/order:detail', array(
                                    $order_no
                                ));
                                $htis->pagedata['pager'] = $pager;
                                $this->pagedata['order'] = $order;
                                $this->pagedata['pay_list'] = K::M('payment/payment')->fetch_all();
                                $this->tmpl = 'mobile/trade/payment/payment.html';
                            }
            }
    }
}