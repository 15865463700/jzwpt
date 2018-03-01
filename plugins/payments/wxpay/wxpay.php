<?php
require_once __CFG::DIR."plugins/payments/wxpay/lib/WxPay.Notify.php";
require_once __CFG::DIR."plugins/payments/wxpay/lib/WxPay.Api.php";
require_once __CFG::DIR."plugins/payments/wxpay/lib/WxPay.Config.php";

class Payment_Wxpay extends WxPayNotify
{
     public function __construct($cfg)
    {
        $this->config = $cfg;
        WxPayConfig::$_CONFIG = $cfg;
        $this->_parameter = array();
        $this->_parameter['APPID'] = $cfg['appid'];
        $this->_parameter['MCHID'] = $cfg['mch_id'];
        $this->_parameter['KEY'] = $cfg['key']; 
        $this->_parameter['APPSECRET'] = $cfg['appsecret'];
        require_once __CFG::DIR."plugins/payments/wxpay/WxPay.NativePay.php";
    }

    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        //K::M('system/logs')->log('wxpay', "query:" . json_encode($result));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }

    public function build_url($input)
    {
        $inputObj = new WxPayUnifiedOrder();
        //$input['trade_no']= $input['trade_no'].'0';
        $inputObj->SetBody($input['title']);
        $inputObj->SetOut_trade_no($input['trade_no']);
        $inputObj->SetTotal_fee($input['amount']*100);
        $inputObj->SetNotify_url($this->config['notify_url']);
        $inputObj->SetTrade_type("NATIVE");
        $inputObj->SetProduct_id($input['trade_no']);
        if($inputObj->GetTrade_type() == "NATIVE"){
            $result = WxPayApi::unifiedOrder($inputObj);
            return $result["code_url"];
        }
    }

    public function NotifyProcess($trade, &$msg)
    {
        $success = false;
        $this->_logs('notify:'.json_encode($trade));
        if(!array_key_exists("transaction_id", $trade)){
            $msg = "输入参数不正确";
        }else if(!$this->Queryorder($trade["transaction_id"])){//查询订单，判断订单真实性
            $msg = "订单查询失败";
        }else if($trade['return_code'] == 'SUCCESS' && $trade['result_code'] == 'SUCCESS'){
            $amount = $trade['total_fee'] / 100;
            $trade = array('trade_no'=>$trade['out_trade_no'], 'pay_trade_no'=>$trade['transaction_id'], 'trade_status'=>$trade['return_code'], 'amount'=>$amount, 'trade_type'=>$trade['trade_type']);
            if(!$log = K::M('payment/log')->log_by_no($trade['trade_no'])){
                $msg ='支付的订单不存在';
            }else if($trade['amount'] != $log['amount']){
                $msg ='支付金额非法';
            }else if(K::M('payment/log')->set_payed($trade['trade_no'])){
                if($log['from'] == 'order'){ //订单支付
                    if(K::M('trade/payment')->payed_order($log, $trade)){
						$fenxiao = $this->system->config->get('fenxiao');
						K::M('member/member')->update_count($this->uid,'jifen',$fenxiao['pay']*$log['amount']);
						K::M('fenxiao/log')->log($this->uid,0, 1,$fenxiao['pay']*$log['amount'], '订单支付获取积分');
                        $success = true;
                    }
                }else if($log['from'] == 'package'){ //套餐订金
                    if(K::M('trade/payment')->payed_package($log, $trade)){ 
                        /*   
                        $order = K::M('package/order')->detail_by_no($trade['trade_no']);                      
                        if($sales = K::M('company/sales')->detail($order['sales_id'])){
                            //微信模板消息
                            if($sales['wx_openid']){
                                $a = array('title'=>$sales['name'].'您好', 'remark'=>'您的装修套餐已经支付成功，稍后我们的客服会与您取得联系');
                                $a['items'] = array('OrderSn'=>$no, 'OrderStatus'=>$order['order_status']);
                                $url = $this->mklink('package:order', array($order['order_id'], array(), 'wx'));
                                $this->wechat_client()->sendTempMsg(WX_OPENID, $tmpl['tpl_id'], $url, $a);
                            }
                        }
                        */
                        $success = true;
                    }
                }else if($log['from'] == 'dxtc'){ //短信套餐
                    $trade = array('payed'=>'1','payedip'=>__IP,'payedtime'=>__TIME);
                    if(K::M('trade/payment')->payed_dxtc($log, $trade)){
                        $success = true;
                    }
                }else if($log['from'] == 'gold'){ //金币充值
                    if(K::M('trade/payment')->payed_gold($log, $trade)){
						$fenxiao = $this->system->config->get('fenxiao');
						K::M('member/member')->update_count($this->uid,'jifen',$fenxiao['pay']*$log['amount']);
						K::M('fenxiao/log')->log($this->uid,0, 1,$fenxiao['pay']*$log['amount'], '充值金币获取积分');
                        $success = true;
                    }
                }else if($log['from'] == 'truste'){ //金币充值
					K::M('trade/payment')->payed_truste($log, $trade);
					$this->err->add('充值成功');
				}
            }
        }
        return $success;
    }

    public function notify_verify()
    {
        $handle = $this->Handle(true);
    }

    public function notify_success()
    {
        if($success){
            echo "success";exit;
        }else{
            echo "fail";exit;
        }
    }

    protected function _logs($log)
    {
        $key = 'payment-wxpay-'.date('Ymd');
        K::M('system/logs')->log($key, $log);
    }
}
