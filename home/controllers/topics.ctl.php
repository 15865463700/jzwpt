<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

// 装修贷款
class Ctl_Topics extends Ctl
{

    public function index()
    {
        $access = $this->system->config->get('access');
        
        $site = $this->system->config->get('site');
        if (strpos($site['topics'], '%') !== false) {
            $topics = $site['topics'];
        } else {
            $topics = ($site['topics'] / 100) . '%';
        }
        $this->pagedata['topics'] = $topics;
        $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
        $this->pagedata['zq'] = K::M('topics/topics')->get_zq();
        $this->tmpl = 'topics/loan.html';
    }

    public function reg1()
    {
        $this->check_login();
        $uid = $this->uid;
        if ($topics = K::M('topics/topics')->items(array(
            'uid' => $uid,
            'audit' => '0'
        ))) {
            foreach ($topics as $k => $v) {
                $topics_id = $v['topics_id'];
                $this->pagedata['topics'] = $v;
            }
        }
        if ($data = $this->checksubmit('data')) {
            $data['uid'] = $uid;
            $data['audit'] = 0;
            $is_tijiao = false;
            if ($topics_id) {
                if (K::M('topics/topics')->update($topics_id, $data)) {
                    $is_tijiao = true;
                }
            } else {
                if ($topics_id = K::M('topics/topics')->create($data)) {
                    $is_tijiao = true;
                }
            }
            if ($is_tijiao == true) {
                $this->err->add('个人信息提交成功');
                $forward = K::M('helper/link')->mklink('topics:reg2', array(
                    'topics_id' => $topics_id
                ), array(), 'base');
                $this->err->set_data('forward', $forward);
            } else {
                $this->err->add('非法的数据提交', 201);
            }
        } else {
            $this->pagedata['education'] = K::M('topics/topics')->get_education();
            $this->pagedata['marriage'] = K::M('topics/topics')->get_marriage();
            $this->tmpl = 'topics/reg1.html';
        }
    }

    public function reg2($topics_id)
    {
        $this->check_login();
        $uid = $this->uid;
        if (! $topics_id) {
            $topics_id = $this->GP('topics_id');
        }
        if (! $topics_id) {
            $this->err->add('贷款ID不能为空', 205);
        } else {
            if ($topics = K::M('topics/topics')->detail($topics_id)) {
                $this->pagedata['topics'] = $topics;
            }
            
            if ($data = $this->checksubmit('data')) {
                $data['uid'] = $uid;
                $is_tijiao = false;
                
                if (K::M('topics/topics')->update($topics_id, $data)) {
                    $is_tijiao = true;
                }
                
                if ($is_tijiao == true) {
                    $this->err->add('职业及联系信息提交成功');
                    $forward = K::M('helper/link')->mklink('topics:reg3', array(
                        'topics_id' => $topics_id
                    ), array(), 'base');
                    $this->err->set_data('forward', $forward);
                } else {
                    $this->err->add('非法的数据提交', 201);
                }
            } else {
                $this->pagedata['topics_id'] = $topics_id;
                $this->pagedata['home'] = K::M('topics/topics')->get_home_relationship();
                $this->pagedata['other'] = K::M('topics/topics')->get_other_relationship();
                $this->tmpl = 'topics/reg2.html';
            }
        }
    }

    public function reg3($topics_id)
    {
        $this->check_login();
        $uid = $this->uid;
        if (! $topics_id) {
            $topics_id = $this->GP('topics_id');
        }
        if (! $topics_id) {
            $this->err->add('贷款ID不能为空', 205);
        } else {
            if ($topics = K::M('topics/topics')->detail($topics_id)) {
                $this->pagedata['topics'] = $topics;
            }
            
            if ($_FILES['data']) {
                $data['uid'] = $uid;
                $is_tijiao = false;
                
                foreach ($_FILES['data'] as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        $attachs[$kk][$k] = $vv;
                    }
                }
                $cfg = K::$system->config->get('attach');
                $oImg = K::M('image/gd');
                $upload = K::M('magic/upload');
                foreach ($attachs as $k => $attach) {
                    if ($attach['error'] == UPLOAD_ERR_OK) {
                        if ($a = $upload->upload($attach, 'company')) {
                            $data[$k] = $a['photo'];
                            $oImg->thumbs($a['file'], array(
                                $size['photo'] => $a['file']
                            ), false);
                        }
                    }
                }
                
                if (K::M('topics/topics')->update($topics_id, $data)) {
                    $is_tijiao = true;
                }
                
                if ($is_tijiao == true) {
                    $this->err->add('映像资料提交成功');
                    $forward = K::M('helper/link')->mklink('topics:reg4', array(
                        'topics_id' => $topics_id
                    ), array(), 'base');
                    $this->err->set_data('forward', $forward);
                } else {
                    $this->err->add('非法的数据提交', 201);
                }
            } else {
                $this->pagedata['topics_id'] = $topics_id;
                $this->tmpl = 'topics/reg3.html';
            }
        }
    }

    public function reg4($topics_id)
    {
        $this->check_login();
        $uid = $this->uid;
        if (! $topics_id) {
            $topics_id = $this->GP('topics_id');
        }
        if (! $topics_id) {
            $this->err->add('贷款ID不能为空', 205);
        } else {
            if ($topics = K::M('topics/topics')->detail($topics_id)) {
                $this->pagedata['topics'] = $topics;
            }
            if ($data = $this->checksubmit('data')) {
                $data['uid'] = $uid;
                $session = K::M('system/session')->start();
                if ($code = $session->get('topics_' . $data['mobile'])) {
                    if ($data['code'] == $code) {
                        unset($data['code']);
                        $is_tijiao = false;
                        if (K::M('topics/topics')->update($topics_id, $data)) {
                            $is_tijiao = true;
                        }
                        
                        if ($is_tijiao == true) {
                            $this->err->add('银行卡资料设置成功');
                            $forward = K::M('helper/link')->mklink('topics:reg5', array(
                                'topics_id' => $topics_id
                            ), array(), 'base');
                            $this->err->set_data('forward', $forward);
                        } else {
                            $this->err->add('非法的数据提交', 201);
                        }
                    } else {
                        $this->err->add('验证码错误或者已经过期', 212);
                    }
                } else {
                    $this->err->add('请先获取验证码', 215);
                }
            } else {
                $this->pagedata['topics_id'] = $topics_id;
                $this->pagedata['bank'] = K::M('topics/topics')->get_bank();
                $this->tmpl = 'topics/reg4.html';
            }
        }
    }

    public function sendsms($phone)
    {
        if (! $a = K::M('verify/check')->mobile($phone)) {
            $this->err->add('电话号码有误', 212);
        } else {
            $code = rand(100000, 999999);
            $session = K::M('system/session')->start();
            $session->set('topics_' . $phone, $code, 900); // 15分钟缓存
            $smsdata = array(
                'code' => $code
            );
            if (K::M('sms/sms')->send($phone, 'sms_login', $smsdata)) {
                $this->err->add('信息发送成功');
            }
        }
    }

    public function reg5($topics_id)
    {
        $this->check_login();
        $uid = $this->uid;
        if (! $topics_id) {
            $topics_id = $this->GP('topics_id');
        }
        if (! $topics_id) {
            $this->err->add('贷款ID不能为空', 205);
        } else {
            if ($topics = K::M('topics/topics')->detail($topics_id)) {
                $this->pagedata['topics'] = $topics;
            }
            
            if ($data = $this->checksubmit('data')) {
                $data['uid'] = $uid;
                $is_tijiao = false;
                
                if (K::M('topics/topics')->update($topics_id, $data)) {
                    $is_tijiao = true;
                }
                
                if ($is_tijiao == true) {
                    $this->err->add('申请成功等待审核');
                    $forward = K::M('helper/link')->mklink('ucenter/member/topics:detail', array(
                        'topics_id' => $topics_id
                    ), array(), 'base');
                    $this->err->set_data('forward', $forward);
                } else {
                    $this->err->add('非法的数据提交', 201);
                }
            } else {
                $this->pagedata['topics_id'] = $topics_id;
                $this->pagedata['zq'] = K::M('topics/topics')->get_zq();
                $this->tmpl = 'topics/reg5.html';
            }
        }
    }

    public function get_money($m, $t)
    {
        $site = $this->system->config->get('site');
        // if(strpos($site['topics'],'%') !== false){
        // $topics = trim($site['topics'],'%')/100;
        // }else{
        $topics = $site['topics'];
        // }
        $result['price'] = $m;
        $result['t'] = $t;
        // $result['all_price'] = sprintf("%.2f",$m*$topics*$t+$m);
        // $result['month'] = sprintf("%.2f",($m*$topics*$t+$m)/$t);
        
        $mmmm = ($m * $t * $topics) + ($m * 1000);
        $all_price = $mmmm / 1000;
        $all_price = round($all_price, 2);
        $month = $all_price / $t;
        $month = round($month, 2);
        $result['all_price'] = $all_price;
        $result['month'] = $month;
        $this->pagedata['result'] = $result;
        $this->pagedata['zq'] = K::M('topics/topics')->get_zq();
        $this->tmpl = 'topics/show.html';
    }

    public function loanSign()
    {
        if ($this->checksubmit('data')) {
            if (! $data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            } else {
                $verifycode_success = true;
                $access = $this->system->config->get('access');
                if ($access['verifycode']['yuyue']) {
                    if (! $verifycode = $this->GP('verifycode')) {
                        $verifycode_success = false;
                        $this->err->add('验证码不正确', 212);
                    } else 
                        if (! K::M('magic/verify')->check($verifycode)) {
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        }
                }
                if ($verifycode_success) {
                    $data['uid'] = (int) $this->uid;
                    $data['status'] = '1';
                    $data['content'] = "报名申请贷款:" . $data['content'];
                    if ($yuyue_id = K::M('loan/yuyue')->create($data)) {
                        $smsdata = array(
                            'contact' => $data['contact'],
                            'mobile' => $data['mobile']
                        );
                        K::M('sms/sms')->send($data['mobile'], 'loan_sign', $smsdata);
                        $this->err->add('申请贷款报名成功');
                    }
                }
            }
        } else {
            $access = $this->system->config->get('access');
            $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
            $this->tmpl = 'topics/loanSign.html';
        }
    }

    public function activity()
    {
        $filter['uid'] = $this->uid;
        $filter['is_use'] = 0;
        $filter['is_change'] = 1;
        $filter['type'] = 2;
        $luck_log = K::M('luck/log')->items($filter, array(
            'lasttime' => 'desc'
        ), 1, 100, $count);
        $this->pagedata['count'] = $count;
        $filters['is_use'] = 1;
        $filters['type'] = 2;
        $log = K::M('luck/log')->items($filters, null, 1, 10);
        $uids = $lucks = array();
        $num = 0;
        foreach ($log as $k => $v) {
            $log[$k]['num'] = $num ++;
            $uids[$v['uid']] = $v['uid'];
            $lucks[$v['luck_id']] = $v['luck_id'];
        }
        $this->pagedata['member'] = K::M('member/member')->items_by_ids($uids);
        $this->pagedata['luck'] = K::M('luck/luck')->items_by_ids($lucks);
        $this->pagedata['prize'] = K::M('luck/luck')->prize_list();
        $this->pagedata['log'] = $log;
        $this->tmpl = 'topics/activity.html';
    }

    public function luck()
    {
        $filter['uid'] = $this->uid;
        $filter['is_use'] = 0;
        $filter['is_change'] = 1;
        $filter['type'] = 1;
        $luck_log = K::M('luck/log')->items($filter, array(
            'lasttime' => 'desc'
        ), 1, 100, $count);
        $this->pagedata['count'] = $count;
        $filters['is_use'] = 1;
        $filters['type'] = 1;
        $log = K::M('luck/log')->items($filters, null, 1, 10);
        $uids = $lucks = array();
        $num = 0;
        foreach ($log as $k => $v) {
            $log[$k]['num'] = $num ++;
            $uids[$v['uid']] = $v['uid'];
            $lucks[$v['luck_id']] = $v['luck_id'];
        }
        $this->pagedata['member'] = K::M('member/member')->items_by_ids($uids);
        $this->pagedata['luck'] = K::M('luck/luck')->items_by_ids($lucks);
        $this->pagedata['log'] = $log;
        $this->pagedata['prize'] = K::M('luck/luck')->prize_list();
        $this->tmpl = 'topics/luck.html';
    }

    public function create($type)
    {
        if ($data = $this->checksubmit('data')) {
            if (! $type) {
                $this->err->add('错误', 213);
            }
            $data['uid'] = $this->uid;
            $data['type'] = $type;
            if (! $log = K::M('luck/log')->items($data)) {
                $this->err->add('该兑换码不存在', 211);
            } else {
                foreach ($log as $k => $v) {
                    if ($v['is_change'] == 1) {
                        $this->err->add('该兑换码已兑换', 212);
                    } else {
                        $d['is_change'] = 1;
                        $d['dateline'] = __TIME;
                        K::M('luck/log')->update($v['log_id'], $d);
                        $this->err->add('兑换成功');
                    }
                }
            }
        } else {
            $this->pagedata['type'] = $type;
            $this->tmpl = 'topics/create.html';
        }
    }

    public function result()
    {
        $name = $this->GP('name');
        if (! $this->check_login()) {
            $this->err->add('您还没有登录，不能抽奖', 101);
        } else {
            $filter['uid'] = $this->uid;
            $filter['is_use'] = 0;
            $filter['is_change'] = 1;
            if ($name != 'luck' && $name != 'activity') {
                $this->err->add('该抽奖不存在', 211);
            } else {
                
                if ($name == 'luck') {
                    $filter['type'] = 1;
                } else 
                    if ($name == 'activity') {
                        $filter['type'] = 2;
                    }
                
                if (! $luck_log = K::M('luck/log')->items($filter, null, 1, 100, $count)) {
                    $this->err->add('抽奖次数不足', 212);
                } else {
                    foreach ($luck_log as $k => $v) {
                        $log_id = $v['log_id'];
                    }
                    if ($log_id) {
                        $filters['closed'] = 0;
                        $filters['audit'] = 1;
                        $filters['type'] = $filter['type'];
                        $luck = K::M('luck/luck')->items($filters);
                        $return = K::M('luck/luck')->get_award($luck);
                    }
                }
                
                $data['is_use'] = 1;
                $data['lasttime'] = __TIME;
                $data['luck_id'] = $return['luck_id'];
                K::M('luck/log')->update($log_id, $data);
                K::M('luck/luck')->update_count($return['luck_id'], 'number', - 1);
            }
        }
        $return['count'] = $count - 1;
        $this->err->set_data('data', $return);
        $this->err->json();
        die();
    }
}