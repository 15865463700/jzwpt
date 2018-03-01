<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Mobile_Tenders extends Ctl_Mobile
{

    private $_tenders_allow_fields = 'from,city_id,area_id,contact,mobile,home_name,way_id,style_id,budget_id,service_id,house_type_id,house_mj,addr,comment,zx_time';

    public function index()
    {
        $pager['tender_hide'] = 1;
        $this->pagedata['pager'] = $pager;
        $this->seo->init('tenders');
        
        $this->tmpl = 'mobile/tenders.html';
    }

    public function save()
    {
        if ($data = $this->checksubmit('data')) {
            if (! $data = $this->check_fields($data, $this->_tenders_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                $data['uid'] = (int) $this->uid;
                $phone=$data['mobile'];
                $contact=$data['contact'];
                $house_mj=$data['house_mj'];
                if($contact==""){
                    $this->err->add('您的称呼不能为空', 201);
                }else if($phone==""){
                    $this->err->add('手机号码不能为空', 201);
                }else if(!K::M('verify/check')->mobile($phone)){
                    $this->err->add('手机号码不正确，请重新输入', 201);
                }
//                else if($house_mj==""){
//                    $this->err->add('房屋面积不能为空', 201);
//                }else if(!(int)$house_mj){
//                    $this->err->add('房屋面积必须为数字', 201);
//                }else if($house_mj<=0){
//                    $this->err->add('房屋面积请正确输入', 201);
//                }
                else{
                if (empty($data['city_id'])) {
                    $data['city_id'] = $this->request['city_id'];
                }
                if (empty($data['name']) && ($this->uid)) {
                    $data['name'] = $this->MEMBER['uname'];
                }
                $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];
                if ($fenxiaoid = $this->cookie->get('fenxiaoid')) {
                    $data['fenxiaoid'] = $fenxiaoid;
                }
                if ($tenders_id = K::M('tenders/tenders')->create($data)) {
                    if ($attr = $this->GP('attr')) {
                        K::M('tenders/attr')->update($tenders_id, $attr);
                    }
                    $smsdata = $maildata = array(
                        'contact' => $data['name'] ? $data['name'] : '业主',
                        'mobile' => $data['mobile']
                    );
                    K::M('sms/sms')->send($data['mobile'], 'tenders', $smsdata);
                    K::M('sms/sms')->admin('admin_tenders', $smsdata);
                    K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                    if ($this->uid) {
                        $this->err->set_data('forward', $this->mklink('mobile/ucenter/member:tenderDetail', array(
                            $tenders_id
                        )));
                    }
                    $this->err->add('恭喜您发布招标成功！');
                }
             }
            }
           // $this->err->add('提交成功', 0);
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }
    public function save1()
    {
        if ($data = $this->checksubmit('data')) {
            if (! $data = $this->check_fields($data, $this->_tenders_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                //var_dump($data);die;
                $data['uid'] = (int) $this->uid;
                $phone=$data['mobile'];
                $contact=$data['contact'];
                if($contact==""){
                    $this->err->add('装修面积不能为空', 201);
                }else if(!(int)$contact){
                    $this->err->add('装修面积必须为数字', 201);
                }else if($contact<=0){
                    $this->err->add('装修面积必须大于0', 201);
                } else if($phone==""){
                    $this->err->add('手机号码不能为空', 201);
                }else if(!K::M('verify/check')->mobile($phone)){
                    $this->err->add('手机号码不正确，请重新输入', 201);
                }else{
                    if (empty($data['city_id'])) {
                        $data['city_id'] = $this->request['city_id'];
                    }
                    if (empty($data['name']) && ($this->uid)) {
                        $data['name'] = $this->MEMBER['uname'];
                    }
                    $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];
                    if ($fenxiaoid = $this->cookie->get('fenxiaoid')) {
                        $data['fenxiaoid'] = $fenxiaoid;
                    }
                    if ($tenders_id = K::M('tenders/tenders')->create($data)) {
                        if ($attr = $this->GP('attr')) {
                            K::M('tenders/attr')->update($tenders_id, $attr);
                        }
                        if ($contact < 70) {
                            $price = 70 * 599; // -$square*299;
                        } else {
                            $price = $contact * 599;
                        }
                        $smsdata = $maildata = array(
                            'contact' => $data['name'] ? $data['name'] : '业主',
                            'mobile' => $data['mobile']
                        );
                       // $smsdata = array();
                        K::M('sms/sms')->send($data['mobile'] ,"您好，您的装修价格为：{$price}元 【聚装网】", $smsdata);
//                        $mobile=$phone;
                      //  K::M('sms/sms')->send($data['mobile'], 'tenders', $smsdata);
                        K::M('sms/sms')->admin('admin_tenders', $smsdata);
                       // K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                        if ($this->uid) {
                            $this->err->set_data('forward', $this->mklink('mobile/ucenter/member:tenderDetail', array(
                                $tenders_id
                            )));
                        }
                        $this->err->add('提交成功，请注意查收您的短信！');
                    }
                }
            }
            // $this->err->add('提交成功', 0);
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }

}