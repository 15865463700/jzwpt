<?php
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Hd extends Ctl{

    public function index(){
        if($_POST){
            $session = K::M('system/session')->start();
            if (!K::M('verify/check')->phone($_REQUEST["mobile"])) {
                die(json_encode(array(
                    "message" => "手机号码输入不正确!"
                )));
            }
//            if (empty($_REQUEST["pcode"]) || $_REQUEST["pcode"] != $session->get("price_{$_REQUEST['mobile']}")) {
//                die(json_encode(array(
//                    "message" => "验证码错误或者已经过期!"
//                )));
//            }
            $data=array();
            $data['from']="TZX";
            $data['title']="业主:{$_REQUEST['contact']},手机号码:{$_REQUEST['mobile']}";//,房屋面积:{$_REQUEST['house_mj']}平米";
            $data['contact']=$_REQUEST['contact'];
            $data['mobile']=$_REQUEST['mobile'];
//            $data['house_mj']=$_REQUEST['house_mj'];
            if(empty($data['contact'])){
                die(json_encode(array(
                    "code"=>0,
                    "message"=>"称呼不能为空！",
                )));
            }
            if(empty($data['mobile'])){
                die(json_encode(array(
                    "code"=>0,
                    "message"=>"手机号码填写不正确！",
                )));
            }
//            if(empty($data['house_mj'])|| !is_numeric($data['house_mj'])){
//                die(json_encode(array(
//                    "code"=>0,
//                    "message"=>"房屋面积填写不正确！",
//                )));
//            }

            $data['city_id'] = empty($_REQUEST['city_id']) ? $this->request['city_id'] : $_REQUEST['city_id'];

            if($tenders_id = K::M('tenders/tenders')->create($data)){
                if($attr = $this->GP('attr')){
                    K::M('tenders/attr')->update($tenders_id, $attr);
                }
                die(json_encode(array(
                    "code"=>200,
                    "message"=>"恭喜您报名成功！",
                )));
            }
            die(json_encode(array(
                "code"=>0,
                "message"=>"报名操作失败，请稍后重试！",
            )));
        }
        $this->seo->init('hddy');
        $this->tmpl = 'hd.html';
    }

    public function foot(){
        if($_POST){
            $session = K::M('system/session')->start();
            if (!K::M('verify/check')->phone($_REQUEST["mobile"])) {
                die(json_encode(array(
                    "message" => "手机号码输入不正确!"
                )));
            }
            if (empty($_REQUEST["pcode"]) || $_REQUEST["pcode"] != $session->get("price_{$_REQUEST['mobile']}")) {
                die(json_encode(array(
                    "message" => "验证码错误或者已经过期!"
                )));
            }
            $data=array();
            if($_REQUEST['from']){
                $data['from']=$_REQUEST['from'];
            }else{
                $data['from']="TZX";
            }
            $data['title']="业主:{$_REQUEST['contact']},手机号码:{$_REQUEST['mobile']}";//,房屋面积:{$_REQUEST['house_mj']}平米";
            $data['contact']=$_REQUEST['contact'];
            $data['mobile']=$_REQUEST['mobile'];
//            $data['house_mj']=$_REQUEST['house_mj'];
            if(empty($data['contact'])){
                die(json_encode(array(
                    "code"=>0,
                    "message"=>"称呼不能为空！",
                )));
            }
            if(empty($data['mobile'])){
                die(json_encode(array(
                    "code"=>0,
                    "message"=>"手机号码填写不正确！",
                )));
            }
//            if(empty($data['house_mj'])|| !is_numeric($data['house_mj'])){
//                die(json_encode(array(
//                    "code"=>0,
//                    "message"=>"房屋面积填写不正确！",
//                )));
//            }

            $data['city_id'] = empty($_REQUEST['city_id']) ? $this->request['city_id'] : $_REQUEST['city_id'];

            if($tenders_id = K::M('tenders/tenders')->create($data)){
                if($attr = $this->GP('attr')){
                    K::M('tenders/attr')->update($tenders_id, $attr);
                }
                die(json_encode(array(
                    "code"=>200,
                    "message"=>"恭喜您报名成功！",
                )));
            }
        }
        die(json_encode(array(
            "code"=>0,
            "message"=>"报名操作失败，请稍后重试！",
        )));
    }

}
