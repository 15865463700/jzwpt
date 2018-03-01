<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: order.ctl.php 3053 2014-01-15 02:00:13Z youyi $
 */
class Ctl_Jifenshangcheng_Order extends Ctl
{

    public function create($product_id = null)
    {
        if ($this->uid) {
            if (! $data = $this->checksubmit('data')) {
                $this->err->add('非法的数据提交', 211);
            } else 
                if (! $product = K::M('jifenshangcheng/shangpin')->detail($product_id)) {
                    $this->err->add('商品不存在或已删除', 211);
                } else 
                    if (! $product['audit']) {
                        $this->err->add('商品未审核', 211);
                    } else 
                        if ($product['kucun'] < $data['num']) {
                            $this->err->add('库存不足', 211);
                        } else {
                            $filter['uid'] = $this->uid;
                            ;
                            $filter['closed'] = 0;
                            if ($items = K::M('order/address')->items($filter, null, $count)) {
                                $this->pagedata['items'] = $items;
                            }
                            $product['num'] = $data['num'];
                            $this->pagedata['product'] = $product;
                            $this->tmpl = 'trade/order/jforder_create.html';
                        }
        } else {
            $this->check_login();
        }
    }

    public function save()
    {
        $this->check_login;
        if (! $data = $this->checksubmit('data')) {
            $this->err->add('非法的数据提交', 211);
        } else 
            if (! $product = K::M('jifenshangcheng/shangpin')->detail($data['product_id'])) {
                $this->err->add('商品不存在或已删除', 211);
            }  // else if($data['product_num'] > $product['kucun']){
              // $this->err->add('您要兑换的商品库存不足', 211);
              // }
              // else if($product['sale_type'] == 3 && $product['sale_time'] < time()){
              // $this->err->add('您要兑换的商品已过期', 211);
              // }//else if($product['sale_type'] == 2 && $product['sale_sku'] < $data['product_num']){
              // $this->err->add('此商品兑换限量为：'.$product['sale_sku'].',请选择正确的数量', 211);
              // }
            else 
                if (! $data['product_num']) {
                    $this->err->add('商品数量不能为空', 211);
                } else {
                    $addr = K::M('order/address')->detail($data['addr_id']);
                    $data['mobile'] = $addr['phone'];
                    $data['addr'] = $addr['addr'];
                    $data['contact'] = $addr['contact'];
                    $data['contact'] = $addr['title'];
                    $data['uid'] = $this->uid;
                    $data['product_id'] = $product['product_id'];
                    $data['product_name'] = $product['name'];
                    $data['product_jfprice'] = $product['jfprice'];
                    $data['jfamount'] = $data['product_jfprice'] * $data['product_num'];
                    if ($this->MEMBER['jifen'] >= $data['jfamount']) {
                        /*
                         * $arr['log']= '积分商城购物';
                         * $arr['number']= $data['jfamount'];
                         * $arr['uid']= $this->uid;
                         * $arr['dateline']= time();
                         * $arr['tenders_id']= 0;
                         * $arr['from']= 2;
                         * $arr['admin']=null;
                         */
                        K::M('fenxiao/log')->log($this->uid, 0, $from = '2', $num = $data['jfamount'], $log = '积分商城购物');
                        if ($order_id = K::M('trade/jforder')->create($data)) {
                            $this->err->add('提交订单成功');
                            $this->err->set_data('forward', $this->mklink('jifenshangcheng/order:detail', array(
                                $order_id
                            )));
                        }
                    } else {
                        $this->err->add('您的积分不足', 211);
                    }
                }
    }

    public function detail($order_id = null)
    {
        if (! is_numeric($order_id)) {
            $this->error(404);
        } else 
            if ($this->check_login()) {
                if (! $order = K::M('trade/jforder')->detail($order_id)) {
                    $this->err->add('您的订单不存在或已经删除', 211);
                } else 
                    if ($order['uid'] != $this->uid) {
                        $this->err->add('您没有权限查看该订单', 212);
                    } else {
                        $this->pagedata['order'] = $order;
                        $this->tmpl = 'trade/order/jforder_detail.html';
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
                                // 更改兑换状态
                                k::M('trade/jforder')->update($order['order_id'], array(
                                    'pay_status' => 1
                                ), $checked = false);
                                $jifen = K::M('jifenshangcheng/shangpin')->detail($order['product_id']);
                                // 变更售出数量、销量、浏览量、库存。
                                K::M('jifenshangcheng/shangpin')->update($order['product_id'], array(
                                    'buys' => $jifen['buys'] + 1,
                                    'kucun' => $jifen['kucun'] - $order['product_num']
                                ), $checkde = false);
                                // $url = 'http://hf.v6.jhcms.cn/jifenshangcheng/shangpin/';
                                // header("location: {$url}");
                                // die;
                                $this->err->add('兑换成功');
                                $this->err->set_data('forward', 'http://hf.v6.jhcms.cn/jifenshangcheng/shangpin/index');
                            }
            }
    }
}