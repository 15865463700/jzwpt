<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: payment.ctl.php 5525 2014-06-19 07:13:55Z youyi $
 */
class Ctl_Trade_Payment extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/(return|notify)-(\w+)\.html/i', $uri, $match)) {
            $system->request['act'] = $match[1] . '_verify';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function return_verify($code)
    {
        $forward = $this->mklink('ucenter/member:index');
        if ($obj = K::M('trade/payment')->loadPayment($code)) {
            if ($trade = $obj->return_verify()) {
                if (! $log = K::M('payment/log')->log_by_no($trade['trade_no'])) {
                    $this->err->add('支付的订单不存在', 211);
                } else 
                    if ($trade['amount'] != $log['amount']) {
                        $this->err->add('支付金额非法', 212);
                    } else 
                        if (K::M('payment/log')->set_payed($trade['trade_no'])) {
                            if ($log['from'] == 'order') { // 订单支付
                                K::M('trade/payment')->payed_order($log, $trade);
                                $this->pagedata['order'] = K::M('trade/order')->detail_by_no($trade['trade_no']);
                                $fenxiao = $this->system->config->get('fenxiao');
                                K::M('member/member')->update_count($this->uid, 'jifen', $fenxiao['pay'] * $log['amount']);
                                K::M('fenxiao/log')->log($this->uid, 0, 1, $fenxiao['pay'] * $log['amount'], '支付订单获取积分');
                                
                                $this->tmpl = 'trade/payment/success.html';
                                
                                // $this->err->add('支付订单成功');
                                // $forward = $this->mklink('mall/order:detail', array($trade['trade_no']));
                            } else 
                                if ($log['from'] == 'gold') { // 金币充值
                                    K::M('trade/payment')->payed_gold($log, $trade);
                                    
                                    $fenxiao = $this->system->config->get('fenxiao');
                                    K::M('member/member')->update_count($this->uid, 'jifen', $fenxiao['pay'] * $log['amount']);
                                    K::M('fenxiao/log')->log($this->uid, 0, 1, $fenxiao['pay'] * $log['amount'], '充值金币获取积分');
                                    $this->err->add('充值金币成功');
                                } else 
                                    if ($log['from'] == 'truste') { // 金币充值
                                        K::M('trade/payment')->payed_truste($log, $trade);
                                        
                                        $fenxiao = $this->system->config->get('fenxiao');
                                        K::M('member/member')->update_count($this->uid, 'jifen', $fenxiao['pay'] * $log['amount']);
                                        K::M('fenxiao/log')->log($this->uid, 0, 1, $fenxiao['pay'] * $log['amount'], '充值金币获取积分');
                                        $this->err->add('充值成功');
                                    }
                        } else {
                            if ($log['from'] == 'order') {
                                $this->err->add('该订单已经支付过了', 213);
                            } else 
                                if ($log['from'] == 'gold') {
                                    $this->err->add('已经充值成功，请不要重复提交', 214);
                                }
                        }
            } else {
                $this->err->add('支付验证签名失败', 215);
            }
            $this->err->set_data('forward', $forward);
        }
    }

    public function notify_verify($code)
    {
        $success = false;
        if ($obj = K::M('trade/payment')->loadPayment($code)) {
            if ($trade = $obj->notify_verify()) {
                if (! $log = K::M('payment/log')->log_by_no($trade['trade_no'])) {
                    $this->err->add('支付的订单不存在', 211);
                } else 
                    if ($trade['amount'] != $log['amount']) {
                        $this->err->add('支付金额非法', 212);
                    } else 
                        if (K::M('payment/log')->set_payed($trade['trade_no'])) {
                            if ($log['from'] == 'order') { // 订单支付
                                if (K::M('trade/payment')->payed_order($log, $trade)) {
                                    $fenxiao = $this->system->config->get('fenxiao');
                                    K::M('member/member')->update_count($this->uid, 'jifen', $fenxiao['pay'] * $log['amount']);
                                    K::M('fenxiao/log')->log($this->uid, 0, 1, $fenxiao['pay'] * $log['amount'], '支付订单获取积分');
                                    $success = true;
                                }
                            } else 
                                if ($log['from'] == 'gold') { // 金币充值
                                    if (K::M('trade/payment')->payed_gold($log, $trade)) {
                                        $fenxiao = $this->system->config->get('fenxiao');
                                        K::M('member/member')->update_count($this->uid, 'jifen', $fenxiao['pay'] * $log['amount']);
                                        K::M('fenxiao/log')->log($this->uid, 0, 1, $fenxiao['pay'] * $log['amount'], '充值金币获取积分');
                                        $success = true;
                                    }
                                } else 
                                    if ($log['from'] == 'truste') { // 金币充值
                                        K::M('trade/payment')->payed_truste($log, $trade);
                                        
                                        $fenxiao = $this->system->config->get('fenxiao');
                                        K::M('member/member')->update_count($this->uid, 'jifen', $fenxiao['pay'] * $log['amount']);
                                        K::M('fenxiao/log')->log($this->uid, 0, 1, $fenxiao['pay'] * $log['amount'], '充值金币获取积分');
                                        $this->err->add('充值成功');
                                    }
                        }
            }
            $obj->notify_success($success);
        }
    }

    public function is_pay($code)
    {
        $log = K::M('payment/log')->log_by_no($code);
        if ($log['payed']) {
            if ($log['from'] == 'gold') {
                $this->err->set_data('status', 'gold');
            } else {
                $this->err->set_data('status', 'order');
            }
            $this->err->add('订单支付成功');
        } else {
            $this->err->set_data('status', 'wait');
            $this->err->add('订单等待付款');
        }
    }

    public function order($code = null, $order_no = null)
    {
        if (! is_numeric($order_no) && ! ($order_no = (int) $this->GP('order_no'))) {
            $this->error(404);
        } else 
            if (empty($code) && ! ($code = $this->GP('code'))) {
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
                                } else 
                                    if ($url = K::M('trade/payment')->order($code, $order, $this->GP('packet'))) {
                                        $packet = $this->GP('packet');
                                        if ($packet > 0) {
                                            $p = K::M('member/packet')->detail($packet);
                                        } else {
                                            $p['price'] = 0;
                                        }
                                        if (strpos($_SERVER["HTTP_USER_AGENT"], 'MicroMessenger') === false && strpos($url, 'wxpay')) {
                                            $qrurl = $this->mklink('trade/payment:wxqrcode', array(), array(
                                                'codeurl' => $url,
                                                'amount' => $order['amount'] - $p['price'],
                                                'order_no' => $order['order_no']
                                            ));
                                            header("Location:{$qrurl}");
                                        } else {
                                            header("Location:{$url}");
                                        }
                                        exit();
                                    }
                }
    }

    /*
     * public function jforder($order_no=null)
     * {
     * if(!is_numeric($order_no) && !($order_no = (int)$this->GP('order_no'))){
     * $this->error(404);
     * }//else if(empty($code) && !($code = $this->GP('code'))){
     * // $this->error(404);
     * //}
     * else if($this->check_login()){
     * if(!$order = K::M('trade/jforder')->detail_by_no($order_no)){
     * $this->err->add('您的订单不存在或已经删除', 211);
     * }else if($order['order_status'] < 0){
     * $this->err->add('订单已经取消不可支付', 212);
     * }else if($order['order_status'] == 2){
     * $this->err->add('订单已经完成不可支付', 213);
     * }else if($order['pay_status']){
     * $this->err->add('该订单已经支付过了,不需要重复支付', 212);
     * }//else if($url = K::M('trade/payment')->order($code, $order,'jforder')){
     * // header("Location:{$url}");
     * // exit;
     * //}
     * else{
     * //更改兑换状态
     * k::M('trade/jforder')->update($order['order_id'], array('pay_status'=>1), $checked=false);
     * $jifen = K::M('jfproduct/jfproduct')->detail($order['product_id']);
     * //变更售出数量、销量、浏览量、库存。
     * K::M('jfproduct/jfproduct')->update($order['product_id'],array('buys'=>$jifen['buys']+1,'kucun'=>$jifen['kucun']-$order['product_num']),$checkde=false);
     * //$url = 'http://hf.v6.jhcms.cn/jfproduct/jfproduct/';
     * //header("location: {$url}");
     * //die;
     * $this->err->add('兑换成功');
     * $this->err->set_data('forward', 'http://hf.v6.jhcms.cn/jfproduct/jfproduct/index');
     * }
     * }
     * }
     */
    public function truste($code = null, $amount = null)
    {
        if (empty($code) && ! ($code = $this->GP('code'))) {
            $this->error(404);
        } else 
            if (! ($amount = (int) $amount) && ! ($amount = (int) $this->GP('amount'))) {
                $this->err->add('充值金额不合法', 211);
            } else 
                if (! $truste_id = (int) $this->GP('truste_id')) {
                    $this->err->add('该维修不存在或已经删除', 213);
                } else 
                    if (! $detail = K::M('truste/truste')->detail($truste_id)) {
                        $this->err->add('该维修不存在或已经删除', 214);
                    } else 
                        if ($detail['uid'] != $this->uid) {
                            $this->err->add('该维修不是您提交的，请查证', 215);
                        } else 
                            if ($detail['truste'] != $amount) {
                                $this->err->add('充值金额不合法', 216);
                            } else 
                                if ($this->check_login()) {
                                    $log = array(
                                        'uid' => $this->uid,
                                        'from' => 'truste',
                                        'trade_no' => 0,
                                        'payment' => $code,
                                        'amount' => $amount,
                                        'truste_id' => $truste_id
                                    );
                                    if (! $log_id = K::M('payment/log')->create($log, true)) {
                                        $this->err->add('充值失败', 214);
                                    } elseif ($url = K::M('trade/payment')->truste($this->uid, $code, $amount, $log_id, $truste_id)) {
                                        $log['trade_no'] = sprintf("2%09d", $log_id);
                                        if (strpos($_SERVER["HTTP_USER_AGENT"], 'MicroMessenger') === false && strpos($url, 'wxpay')) {
                                            $qrurl = $this->mklink('trade/payment:wxqrcode', array(), array(
                                                'codeurl' => $url,
                                                'amount' => $amount,
                                                'order_no' => $log['trade_no']
                                            ));
                                            header("Location:{$qrurl}");
                                        } else {
                                            header("Location:{$url}");
                                        }
                                        exit();
                                    }
                                }
    }

    public function gold($code = null, $amount = null)
    {
        if (empty($code) && ! ($code = $this->GP('code'))) {
            $this->error(404);
        } else 
            if (! ($amount = (int) $amount) && ! ($amount = (int) $this->GP('amount'))) {
                $this->err->add('充值金额不合法', 211);
            } else 
                if ($this->check_login()) {
                    $log = array(
                        'uid' => $this->uid,
                        'from' => 'gold',
                        'trade_no' => 0,
                        'payment' => $code,
                        'amount' => $amount
                    );
                    if (! $log_id = K::M('payment/log')->create($log, true)) {
                        $this->err->add('充值失败', 214);
                    } elseif ($url = K::M('trade/payment')->gold($this->uid, $code, $amount, $log_id)) {
                        $log['trade_no'] = sprintf("2%09d", $log_id);
                        if (strpos($_SERVER["HTTP_USER_AGENT"], 'MicroMessenger') === false && strpos($url, 'wxpay')) {
                            $qrurl = $this->mklink('trade/payment:wxqrcode', array(), array(
                                'codeurl' => $url,
                                'amount' => $amount,
                                'order_no' => $log['trade_no']
                            ));
                            header("Location:{$qrurl}");
                        } else {
                            header("Location:{$url}");
                        }
                        exit();
                    }
                }
    }

    public function wxqrcode()
    {
        if (! $codeurl = $this->GP('codeurl')) {
            exit('params error');
        }
        if (! $amount = $this->GP('amount')) {
            exit('params error');
        }
        if (! $order_no = $this->GP('order_no')) {
            exit('params error');
        }
        $amount = sprintf("%.2f", $amount);
        $this->pagedata['codeurl'] = $codeurl;
        $this->pagedata['amount'] = $amount;
        $this->pagedata['order_no'] = $order_no;
        $this->tmpl = 'trade/payment/wxqrcode.html';
    }
}