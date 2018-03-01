<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Price extends Ctl
{

    private $_price_allow_fields = 'style_id,house_type_id,way_id,home_name,level,from';

    public function index()
    {
        $this->pagedata['setting'] = k::M('tenders/setting')->fetch_all_setting();
        $this->pagedata['type'] = k::M('tenders/setting')->get_type();
        K::M('helper/seo')->init('tenders', array());
        if ($price = K::M('system/cookie')->get('price')) {
            $this->pagedata['is_show'] = '1';
        }
        $this->tmpl = 'price/index.html';
    }
    //头部报价
     public function get_price($mj)
    {
        if (! $mj = (int) $mj) {
            $this->error(404);
        } else {
            if ($mj < 70) {
                $last_price = (70 * 599)."元"; // -$mj*299;
                  // return $last_price;
            } else {
                $last_price = ($mj * 599)."元";
                  // return $last_price;
            }
        }
        $this->err->set_data('html', $last_price);
        $this->err->json();
     }

    // public function get_price($mj)
    // {
    //     $filter['city_id'] = $this->request['city_id'];
    //     if (! $mj = (int) $mj) {
    //         $this->error(404);
    //     } else 
    //         if (! $items = K::M('price/attr')->items($filter)) {     
    //             echo 2;die;
    //             $this->error(404);
    //         } else {
    //             $from = K::M('price/attrfrom')->items();
    //             $tenders = K::M('tenders/tenders')->items();
    //             $arr = array();
    //             $last_price = $cailiao_price = '';
    //             $count = 0;
    //             foreach ($items as $k => $v) {
    //                 if (strpos($v['per'], '%')) {
    //                     $items[$k]['price'] = ($mj * $v['per'] * $v["zhucai"] + $mj * $v['per'] * $v["fucai"] + $mj * $v['per'] * $v["rengong"]) / 100;
    //                     $items[$k]['mj'] = ($mj * $v['per']) / 100;
    //                     $last_price += $items[$k]['price'];
    //                     $cailiao_price += ($mj * $v['per'] * $v["zhucai"] + $mj * $v['per'] * $v["fucai"]) / 100;
    //                 } else {
    //                     $items[$k]['price'] = $mj * $v['per'] * $v["zhucai"] + $mj * $v['per'] * $v["fucai"] + $mj * $v['per'] * $v["rengong"];
    //                     $items[$k]['mj'] = $mj * $v['per'];
    //                     $last_price += $items[$k]['price'];
    //                     $cailiao_price += $mj * $v['per'] * $v["zhucai"] + $mj * $v['per'] * $v["fucai"];
    //                 }
    //                 $count ++;
    //             }
    //             foreach ($items as $k => $v) {
    //                 $arr[$v["pricefrom_id"]][] = $v;
    //             }
    //             $this->pagedata['cailiao_price'] = $cailiao_price;
    //             $this->pagedata['last_price'] = $last_price;
    //             $this->pagedata['arr'] = $arr;
    //             $this->pagedata['from'] = $from;
    //             $this->pagedata['tenders'] = $tenders;
    //             $this->pagedata['mj'] = $mj;
    //             $this->pagedata['is_show'] = '1';
    //             return $last_price;
    //             // $this->tmpl = 'price/get_price.html';
    //             // return $this->output(true);
    //         }
    // }

    public function yuyue()
    {
        if (! $data = $this->GP('data')) {
            $this->err->add('您的信息没有填写', 201);
        } else 
            if (! $data['mj']) {
                $this->err->add('请填写建筑面积', 202);
            } else {
                $this->pagedata['data'] = $data;
                $this->tmpl = 'price/yuyue.html';
            }
    }

    public function sendsms($mobile)
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

    public function sendsms2()
    {
        $mobile=$_REQUEST["m"];
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
        $this->err->json();
    }

    public function byphone()
    {
        $session = K::M('system/session')->start();
        if ($data = $this->checksubmit('data')) {
            if ($code = $session->get('price_' . $data['mobile'])) {
                if ($data['code'] == $code) {
                    K::M('system/cookie')->set('price', '1', 9000);
                    if ($data) {
                        $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];
                        if ($tenders_id = K::M('tenders/tenders')->create($data)) {
                            $this->err->add('验证通过，请等待跳转');
                            $forward = K::M('helper/link')->mklink('price:index', array(
                                'mj' => $data['mj']
                            ));
                            $this->err->set_data('forward', $forward);
                            $this->err->set_data('html', $this->get_price($data['mj']));
                            $this->err->json();
                        }
                    }
                } else {
                    $this->err->add('验证码错误或者已经过期', 212);
                }
            } else {
                $this->err->add('请获取验证码', 215);
            }
        }
    }

    public function budget(){
        $flag = true;
        if (!$province_id = intval($_REQUEST["province"])) {
            $flag=false;
            $this->err->add('请选择省份!',500);
        }
        if ($flag&&!$city_id = intval($_REQUEST["city"])) {
            $flag=false;
            $this->err->add('请选择城市!',500);
        }
        if ($flag&&((!$square = intval($_REQUEST["square"])) || $square < 1)) {
            $flag=false;
            $this->err->add('房屋面积输入不正确!',500);
        }
        
        $cal_type="";
        if($_REQUEST['type']){
            $cal_type=$_REQUEST['type'];
            if($_REQUEST['type']==1){
                $flag=false;
                $this->err->add('请选择装修类型!',500);
            }
        }
        $phone=$_REQUEST["phone"];
        if ($flag&&!K::M('verify/check')->phone($phone)) {
            $flag=false;
            $this->err->add('手机号码输入不正确!',500);
        }
        if($flag){
            $data = array();
//            if($cal_type){
                switch($cal_type){
                    case 3:
                        $data["from"] = "gz";
                        $price = $square * 399;
                        if($price<=50000){
                            $data['gold']=399;
                        }elseif($price<=100000){
                            $data['gold']=699;
                        }else{
                            $data['gold']=999;
                        }
                        break;
                    case 4:
                        $data["from"] = "bs";
                        $price = $square * 1100;
                        $data['gold']=1200;
                        break;
                    case 2:
                    default:
                        $data["from"] = "jz";
                        if ($square < 70) {
                            $price = 70 * 599;
                        } else {
                            $price = $square * 599;
                        }
                        $data['gold']=299;
                        break;
                }
//            }else{
//                $data["from"] = "zxys";
//            }
            $data['budget']=$price;
            $data['house_mj']=$square;
            $price = number_format($price, 2);
            if($cal_type){
//                $data["title"] = sprintf("%s_%s平_%s元", $_REQUEST['phone'],$square,$price);
                $data["title"] = sprintf("%s_%s平_%s元", date("Y-m-d H:i")."_",$square,$price);
            }else{
//                $data["title"] = sprintf("%s_%s平_%s室_%s厅_%s厨_%s卫_%s阳台_%s元", $_REQUEST['phone'],$square, $_REQUEST['shi'], $_REQUEST['ting'], $_REQUEST['chu'], $_REQUEST['wei'], $_REQUEST['yangtai'], $price);
                $data["title"] = sprintf("%s_%s平_%s室_%s厅_%s厨_%s卫_%s阳台_%s元", date("Y-m-d H:i")."_",$square, $_REQUEST['shi'], $_REQUEST['ting'], $_REQUEST['chu'], $_REQUEST['wei'], $_REQUEST['yangtai'], $price);
            }
            $data["mobile"] = $phone;
            $data["contact"] = $phone;
            $data["clientip"] = __IP;
            $data["dateline"] = time();
            $data['city_id'] = $city_id;
            $data['uid'] = $this->MEMBER["uid"];
            K::M('tenders/tenders')->create($data);
            $smsdata = array();
            K::M('sms/sms')->send($phone, "您好，您的装修参考价格为：{$price}元,如有疑问请致电010-56132268 【聚装网】", $smsdata);
            $city = K::M('data/city')->detail($city_id);
            $cfg = $this->system->config->get('site');
            $this->err->set_data('link',sprintf("http://%s.%s",$city['pinyin'],$cfg['city_domain']));
            $this->err->set_data('price',$price);
            $this->err->add("您好，计算结果稍后将以短信的方式发送到您的手机上，请注意查收!",200);
        }
        $this->err->json();
    }

    /**
     * 首页报价
     */
    public function home(){
        if ($_POST) {
            $session = K::M('system/session')->start();
            if (empty($_REQUEST["phone_code"]) || $_REQUEST["phone_code"] != $session->get("price_{$_REQUEST['phone']}")) {
                die(json_encode(array(
                    "message" => "验证码错误或者已经过期!"
                )));
            }
            if (! $province_id = intval($_REQUEST["province_id"])) {
                die(json_encode(array(
                    "message" => "请选择省份!"
                )));
            }
            if (! $city_id = intval($_REQUEST["city_id"])) {
                die(json_encode(array(
                    "message" => "请选择城市!"
                )));
            }
            if ((! $square = intval($_REQUEST["square"])) || $square < 1) {
                die(json_encode(array(
                    "message" => "房屋面积输入不正确!"
                )));
            }
            if (! K::M('verify/check')->phone($_REQUEST["phone"])) {
                die(json_encode(array(
                    "message" => "手机号码输入不正确!"
                )));
            }
            $session->delete("price_{$_REQUEST['phone']}");
            $data = array();
//            $data["title"] = "手机号[{$_REQUEST['phone']}]面积[{$square}]平";
            $data["title"] = date("Y-m-d H:i")."_面积[{$square}]平";
            $data["mobile"] = $_REQUEST['phone'];
            $data["contact"] = $_REQUEST['phone'];
            $data["from"] = "TBJ";
            $data["clientip"] = __IP;
            $data["dateline"] = time();
            $data['city_id'] = empty($_REQUEST["city_id"]) ? $this->request['city_id'] : $_REQUEST["city_id"];
            $data['uid'] = $this->MEMBER["uid"];
            K::M('tenders/tenders')->create($data);
            
            if ($square < 70) {
                $price = 70 * 599; // -$square*299;
            } else {
                $price = $square * 599;
            }
            $price = number_format($price, 2);
            $smsdata = array();
            K::M('sms/sms')->send($_REQUEST["phone"], "您好，您的装修参考价格为：{$price}元,如有疑问请致电010-56132268 【聚装网】", $smsdata);
            $city = K::M('data/city')->detail($data['city_id']);
            $cfg = $this->system->config->get('site');
            die(json_encode(array(
                "code" => 1,
                "message" => "您好，计算结果稍后将以短信的方式发送到您的手机上，请注意查收!",
                "link" => "http://" . $city['pinyin'] . "." . $cfg['city_domain']
            )));
        } else {
            die(json_encode(array(
                "message" => "非法请求!"
            )));
        }
    }
}