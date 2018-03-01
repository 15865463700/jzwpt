<?php
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Price extends Ctl_Mobile
{

    public function get_price()
    {
        $this->tmpl = 'mobile/price/get_price.html';
    }

    public function sendsms($mobile)
    {
        $m=K::M('member/member')->only($mobile);
        if (! $a = K::M('verify/check')->mobile($mobile)) {
            $this->err->add('电话号码有误', 212);
        }else if($m>=1){
            $this->err->add('该手机号已被注册', 212);
        }else{
            $code = rand(100000, 999999);
            $session = K::M('system/session')->start();
            $session->set('price_' . $mobile, $code, 900); // 15分钟缓存
            $smsdata = array(
                'code' => $code
            );
            if (K::M('sms/sms')->send($mobile, "sms_price", $smsdata) || true) {
                $this->err->add('信息发送成功' . $code);
            }
        }
    }
    public function sendsms1($mobile)
    {
        if (! $a = K::M('verify/check')->mobile($mobile)) {
            $this->err->add('电话号码有误', 212);
        } else {
            $code = rand(100000, 999999);
            $session = K::M('system/session')->start();
            $session->set('price_' . $mobile, $code, 900); // 15分钟缓存
            $smsdata = array(
                'code' => $code
            );
            if (K::M('sms/sms')->send($mobile, "sms_price", $smsdata) || true) {
                $this->err->add('信息发送成功' . $code);
            }
        }
    }
    public function forget($mobile)
    {
        $m=K::M('member/member')->only($mobile);
        if($m!=1){
            $this->err->add('该账户不存在，请重新输入', 212);
        }else if (! $a = K::M('verify/check')->mobile($mobile)) {
            $this->err->add('电话号码有误', 212);
        } else {
            $code = rand(100000, 999999);
            $session = K::M('system/session')->start();
            $session->set('price_' . $mobile, $code, 900); // 15分钟缓存
            $smsdata = array(
                'code' => $code
            );
            if (K::M('sms/sms')->send($mobile, "sms_price", $smsdata) || true) {
                $this->err->add('信息发送成功' . $code);
            }
        }
    }

}