<?php

if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Jiameng extends Ctl_Mobile
{

    public function __construct(&$system)
    {
        parent::__construct($system);
    }

    public function index($page = 1)
    {
        $this->tmpl = 'mobile/jiameng/jiameng.html';
    }
    public function appli(){
       $data=$this->checksubmit("data");
        $mobile=$data['mobile'];
        $phone_code=$data['phone_code'];
        if (empty($data['contact'])) {
            $this->err->add("称呼不能为空！", 211)->response();
        }
        if (empty($data['place'])) {
            $this->err->add("区域不能为空！", 211)->response();
        }
        if (empty($data['weixin'])) {
            $this->err->add("微信不能为空！", 211)->response();
        }
        if (empty($data['mobile'])) {
            $this->err->add("手机号码不能为空！", 211)->response();
        }
        if (! K::M('verify/check')->phone($data['mobile'])) {
            $this->err->add("手机号码输入错误！", 211)->response();
        }
        if (empty($data['phone_code'])) {
            $this->err->add("验证码不能为空！", 211)->response();
        }
        $session = K::M('system/session')->start();
        $phone_code1= $session->get('price_' . $mobile);
        if($phone_code!=$phone_code1){
            $this->err->add('验证码错误或者已经过期!', 0)->response();
        }else{
            if (K::M('cshhrappli/cshhrappli')->create($data)) {
                $this->err->add('恭喜您申请成功！',0)->response();
            } else {
                $this->err->add('申请失败，请稍后再试！', 211)->response();
            }
        }
//        if (empty($phone_code || $phone_code != $phone_code1)) {
//            $this->err->add('验证码错误或者已经过期!', 0)->response();
//        }
        $session->delete("price_{$_REQUEST['mobile']}");
        // $data=array();
        // $data["title"]="用户【{$_REQUEST['chenghu']}】，手机号【{$_REQUEST['phone']}】";
        // $data["mobile"]=$_REQUEST['phone'];
        // $data["contact"]=$_REQUEST['chenghu'];
        // $data["from"]="TSJ";
        // $data["clientip"]=__IP;
        // $data["dateline"]=time();
        // $data['city_id'] = empty($_REQUEST["city_id"]) ? $this->request['city_id'] : $_REQUEST["city_id"];

    }
}