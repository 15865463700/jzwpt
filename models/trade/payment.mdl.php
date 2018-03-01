<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: payment.mdl.php 5531 2014-06-19 10:26:25Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Trade_Payment extends Model 
{
    
    public function order($code, $order,$packet=0, $form=false)
    {
        if(!$oPayApi = $this->loadPayment($code)){
            return false;
        }
		if($packet>0){
			$p = K::M('member/packet')->detail($packet);
			K::M('member/packet')->update($packet, array('is_use'=>'2','desc'=>'订单号'.$order['order_no'].'使用,时间'.date('Y-m-d H:i:s')),  true);
		}else{
			$p['price'] = 0;
		}
		
        if(!$log = K::M('payment/log')->log_by_no($order['order_no'])){
            $log = array('uid'=>$order['uid'], 'shop_id'=>$order['shop_id'], 'from'=>'order', 'trade_no'=>$order['order_no'], 'payment'=>$code, 'amount'=>$order['amount']-$p['price'], 'packet'=>$packet);
            if(!$log_id = K::M('payment/log')->create($log)){
                return false;
            }

            $log['log_id'] = $log_id;
        }
        if($log['payed']){
            $this->err->add('该订单已经支付成功', 211);
            return false;
        }
        $a = array();
        if($log['amount'] != ($order['amount']-$p['price'])){
            $a['amount'] = $order['amount']-$p['price'];
        }
		if($log['packet'] != $packet){
			if($log['packet']){
				K::M('member/packet')->update($log['packet'], array('is_use'=>'1','desc'=>''),  true);
			}
            $a['packet'] = $packet;
        }
        if($log['payment'] != $code){
            $a['payment'] = $code;
        }
        if($a){
            K::M('payment/log')->update($log['log_id'], $a,  true);
        }
        $params = array();
        $params['trade_no'] = $order['order_no'];
        $site = K::$system->config->get('site');
        $params['title'] = $site['title'].'-商城订单';
        $params['body'] = $order['contact'].','.$order['mobile'].','.$order['address'];
        $params['amount'] = $order['amount']-$p['price'];
        $params['contact'] = $order['contact'];
        $params['mobile'] = $order['mobile'];
        $params['addr'] = $order['addr'];
        if($form){
            return $oPayApi->build_form($params);
        }
		if (strpos($_SERVER["HTTP_USER_AGENT"], 'MicroMessenger') && $code == 'wxpay') {
			return $oPayApi->build_url($params);
		}else{
			return $oPayApi->build_url($params);
		}
    }



    public function payed_order($log, $trade)
    {
        K::M('trade/order')->set_payed($log['trade_no'], $trade);
        if($log['shop_id']){
			if($log['packet']){
				$p = K::M('member/packet')->detail($packet);
				if($p['type'] == '2'){
					K::M('shop/shop')->update_money($log['shop_id'], $trade['amount'], '订单在线支付:'.$log['trade_no']);
				}else{
					K::M('shop/shop')->update_money($log['shop_id'], $trade['amount']+$p['price'], '订单在线支付:'.$log['trade_no']);
				}
			}else{
				K::M('shop/shop')->update_money($log['shop_id'], $trade['amount'], '订单在线支付:'.$log['trade_no']);
			}
           
        }
        //自动发货
        if($log['pay_trade_no'] && $trade['trade_status'] == 'WAIT_SELLER_SEND_GOODS'){
            if($oPayApi = $this->loadPayment($log['payment'])){
                $oPayApi->sendship($log, $trade);
            }
        } 
        return true;        
    }

	public function truste($uid, $code, $amount,$log_id,$truste_id)
    {
        if(!$uid = (int)$uid){
            return false;
        }else if(!$member = K::M('member/member')->detail($uid)){
            return false;
        }else if(!$oPayApi = $this->loadPayment($code)){
            return false;
        }else if(!$log_id = (int)$log_id){
			 return false;
		}
		
        $log['trade_no'] = sprintf("2%09d", $log_id);
        K::M('payment/log')->update_trade_no($log_id, $log['trade_no']);
        $log['log_id'] = $log_id;
        $site = K::$system->config->get('site');

        $params = array();
		$params['from'] = 'truste';
        $params['trade_no'] = $log['trade_no'];
        $params['title'] = $site['title'].'-托管充值';
        $params['body'] = '会员:'.$member['uname'].'('.$uid.')';
        $params['amount'] = $amount;
		$params['truste_id'] = $truste_id;
		
        return $oPayApi->build_url($params);  
    }

	 public function payed_truste($log, $trade)
    {
        return K::M('truste/truste')->update($log['truste_id'], array('is_pay'=>'1'));
    }

    public function gold($uid, $code, $amount,$log_id)
    {
        $goldCfg = K::$system->config->get('gold');
        if(!$uid = (int)$uid){
            return false;
        }else if(!$member = K::M('member/member')->detail($uid)){
            return false;
        }else if(empty($goldCfg['onpay'])){
            $this->err->add('金币不支持在线支付', 211);
            return false;
        }else if(($amount = floatval($amount)) < $goldCfg['minpay']){
            $this->err->add('最小充值金额不能小于'.$goldCfg['minpay']."RMB", 212);
            return false;            
        }else if(!$oPayApi = $this->loadPayment($code)){
            return false;
        }else if(!$log_id = (int)$log_id){
			 return false;
		}
        $log['trade_no'] = sprintf("2%09d", $log_id);
        K::M('payment/log')->update_trade_no($log_id, $log['trade_no']);
        $log['log_id'] = $log_id;
        $site = K::$system->config->get('site');
        $params = array();
        $params['trade_no'] = $log['trade_no'];
        $params['title'] = $site['title'].'-充值金币';
        $params['body'] = '会员:'.$member['uname'].'('.$uid.')';
        $params['amount'] = $amount;
        return $oPayApi->build_url($params);  
    }

    public function payed_gold($log, $trade)
    {
        $goldCfg = K::$system->config->get('gold');
        $gold = $trade['amount'] * $goldCfg['huilv'];
        return K::M('member/gold')->update($log['uid'], $gold, '在线充值:'.$trade['trade_no']);
    }

    public function loadPayment($code)
    {
        static $_PayApiObj = array();
        if(!is_object($_PayApiObj[$code])){
            $file = __CFG::DIR."plugins/payments/{$code}/{$code}.php";
            if(!file_exists($file)){
                $this->err->add('您选择的支付接口不存在', 311);
                return false;
            }else if(!$payment = K::M('payment/payment')->payment($code)){
                $this->err->add('您选择的支付接口不存在', 312);
                return false;
            }else if(empty($payment['status'])){
                $this->err->add('您选择的支付接口不可用', 313);
                return false;
            }
			if (strpos($_SERVER["HTTP_USER_AGENT"], 'MicroMessenger') && $code == 'wxpay') {
				$file = __CFG::DIR."plugins/payments/{$code}/jsapi.php";
				include($file);
				$clsName = "Weixin_".ucfirst('jsapi');
			}else{
				include($file);
				$clsName = "Payment_".ucfirst($code);
			}
            $config = $payment['config'];
            $site = K::$system->config->get('site');
			if(defined('IN_MOBILE')){
				$config['return_url'] = $site['siteurl'].'/'.K::M('helper/link')->mklink('mobile/trade/payment:return', array($code));
				$config['notify_url'] = $site['siteurl'].'/'.K::M('helper/link')->mklink('mobile/trade/payment:notify', array($code));
			}else{
				$config['return_url'] = $site['siteurl'].'/'.K::M('helper/link')->mklink('trade/payment:return', array($code));
				$config['notify_url'] = $site['siteurl'].'/'.K::M('helper/link')->mklink('trade/payment:notify', array($code));
			}
            $_PayApiObj[$code] = new $clsName($config);
        }
        return $_PayApiObj[$code];
    }
}