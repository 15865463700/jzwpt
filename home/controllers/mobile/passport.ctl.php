<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Passport extends Ctl_Mobile
{

    public function index()
    {
        $pager['backurl'] = $this->mklink('mobile');
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/passport/login.html';
    }

    public function byphone($from)
    {
        if ($from == 'member') {
            if ($data = $this->checksubmit('data')) {
                $session = K::M('system/session')->start();
                if ($code = $session->get('code_' . $data['phone'])) {
                    if ($data['code'] == $code) {
                        if ($items = K::M('member/member')->items(array(
                            'mobile' => $data['phone']
                        ), array(
                            'uid' => 'desc'
                        ), 1, 1)
                        ) {
                            foreach ($items as $k => $v) {
                                $uname = $v['uname'];
                                $passwd = $v['passwd'];
                            }
                            if ($member = $this->auth->login($uname, $passwd, 'uname', true, false)) {
                                $this->err->add("{$member[uname]}，欢迎您回来!");
                                if (!$forward = $this->request['forward']) {
                                    $forward = K::M('helper/link')->mklink('index', array(), array(), 'base');
                                } else
                                    if (strpos($forward, 'passport') !== false) {
                                        $forward = K::M('helper/link')->mklink('ucenter/member:index', array(), array(), 'base');
                                    }
                                if (substr($forward, 0, 7) != 'http://') {
                                    $forward = '/' . trim($forward, '/');
                                }
                                $this->err->set_data('forward', $forward);
                            }
                        } else {
                            $data['uname'] = $data['phone'];
                            $data['mail'] = $data['phone'] . '@qq.com';
                            $data['passwd'] = '123456';
                            $data['mobile'] = $data['phone'];
                            $data['verify'] = '2';
                            if ($detail = K::M('member/member')->items(array(
                                'mobile' => $data['phone']
                            ))
                            ) {
                                // fanxian
                                $this->err->add('该手机号码已经被注册', 213);
                            } else
                                if ($uid = K::M('member/account')->create($data)) {
                                    K::M('member/magic')->reg_jifen($uid);
                                    $this->err->add('恭喜您，注册会员成功');
                                    $from_list = K::M('member/member')->from_list();
                                    $account_from = $account['from'];
                                    if (!$from_list[$account_from]) {
                                        $account_from = 'member';
                                    }
                                    $forward = K::M('helper/link')->mklink('ucenter/' . $account_from . ':index', array(), array(), 'base');
                                    $this->err->set_data('forward', $forward);
                                }
                        }
                    } else {
                        $this->err->add('验证码错误或者已经过期', 212);
                    }
                }
            } else {
                $this->tmpl = 'passport/byphone.html';
            }
        } else {
            header('Location:' . K::M('helper/link')->mklink('passport-signup:' . $from));
        }
    }

    public function sendsms($phone)
    {
        if (!$a = K::M('verify/check')->phone($phone)) {
            $this->err->add('电话号码有误', 212);
        } else {
            $code = rand(100000, 999999);
            $session = K::M('system/session')->start();
            $session->set('code_' . $phone, $code, 900); // 15分钟缓存
            $smsdata = array(
                'code' => $code
            );
            $this->err->add('恭喜您，注册会员成功');
            if (K::M('sms/sms')->send($phone, 'login', $smsdata)) {
                $this->err->add('信息发送成功');
            }
        }
    }

    public function login()
    {
        if (!$this->checksubmit('data')) {
            $this->err->add('非法的数据提交', 211);
        } else
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 212);
            } else
                if (!$uname = $data['uname']) {
                    $this->err->add('用户名不正确', 213);
                } else
                    if (!$passwd = $data['passwd']) {
                        $this->err->add('登录密码不正确', 214);
                    } else {
                        $verifycode_success = true;
                        $access = $this->system->config->get('access');
                        if ($access['verifycode']['login']) {
                            if (!$verifycode = $this->GP('verifycode')) {
                                $verifycode_success = false;
                                $this->err->add('验证码不正确', 212);
                            } else
                                if (!K::M('magic/verify')->check($verifycode)) {
                                    $verifycode_success = false;
                                    $this->err->add('验证码不正确', 212);
                                }
                        }
                        if ($verifycode_success) {
                            $keep = $this->GP('keep') ? true : false;
                            $a = K::M('verify/check')->mail($uname) ? 'mail' : 'uname';
                            if ($member = $this->auth->login($uname, $passwd, $a, false, $keep)) {

                                // die(var_dump($member));
                                $this->err->add("{$member['uname']}，欢迎您回来!");
                            }
                        }
                    }
    }

    // QQ 联合登录
    public function qqlogin()
    {
        if ($url = K::M('member/qqlogin')->qqloign_url()) {
            header("Location: {$url}");
            die();
        }
    }

    public function qqcallback()
    {
        if (!$code = $this->GP('code')) {
            die('回传地址有问题2');
        } elseif (!$state = $this->GP('state')) {
            die('回传地址有问题1');
        } elseif (true == K::M('member/qqlogin')->qqcallback($code, $state)) {
            $forward = K::M('helper/link')->mklink('mobile/ucenter:index', array(), array(), 'base');
            header("Location: {$forward}");
            die();
        }
    }

    public function qqreg($access_token, $qq_app_id, $openid)
    {
        if ($account = $this->GP('account')) {
            if (K::M('member/qqlogin')->qqreg($this->GP('access_token'), $this->GP('qq_app_id'), $this->GP('openid'), $account['uname'], $account['passwd'])) {
                $this->err->add('恭喜您，注册会员成功');
                $forward = K::M('helper/link')->mklink('ucenter/member:index', array(), array(), 'base');
                $this->err->set_data('forward', $forward);
            }
        } else {
            $this->pagedata['title'] = 'QQ第三方登录';
            $this->pagedata['access_token'] = $access_token;
            $this->pagedata['qq_app_id'] = $qq_app_id;
            $this->pagedata['openid'] = $openid;
            $this->tmpl = 'mobile/passport/thirdreg.html';
        }
    }

    public function weiboreg($openid, $access_token)
    {
        if ($account = $this->GP('account')) {
            if (K::M('member/weibo')->weiboreg($this->GP('openid'), $this->GP('access_token'), $account['uname'], $account['passwd'])) {
                $this->err->add('恭喜您，注册会员成功');
                $forward = K::M('helper/link')->mklink('ucenter/member:index', array(), array(), 'base');
                $this->err->set_data('forward', $forward);
            }
        } else {
            $this->pagedata['title'] = '微博第三方登录';
            $this->pagedata['openid'] = $openid;
            $this->pagedata['access_token'] = $access_token;
            $this->tmpl = 'mobile/passport/thirdreg2.html';
        }
    }

    public function weibo()
    {
        if ($url = K::M('member/weibo')->weibo_url()) {
            header("Location: {$url}");
            die();
        }
    }

    public function weibocallback()
    {
        if (!$code = $this->GP('code')) {
            die('回传地址有问题2');
        }
        if (true == K::M('member/weibo')->weibocallback($code)) {
            $forward = K::M('helper/link')->mklink('mobile/ucenter:index', array(), array(), 'base');
            header("Location: {$forward}");
            die();
        }
    }

    public function loginout()
    {
        @header("Expires: -1");
        @header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
        @header("Pragma: no-cache");
        $this->auth->loginout();
        header("Location: " . $this->mklink('mobile/index', array(), array(), 'base'));
        die();
    }

    public function signup()
    {
        $pager['backurl'] = $this->mklink('mobile/passport');
        $this->pagedata['pager'] = $pager;
        $this->pagedata['fromlist'] = K::M('member/view')->from_list();
        $this->tmpl = 'mobile/passport/signup.html';
    }

    public function create()
    {
        if (!$this->checksubmit('data')) {
            $this->err->add('非法的数据提交', 211);
        } else
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 212);
            } else
                if ($data['passwd'] != $this->GP('confirmpasswd')) {
                    $this->err->add('两次输入的密码不相同', 213);
                } else {
                    $access = $this->system->config->get('access');
                    $verifycode_success = true;
                    $mobile = $data['uname'];
                    $session = K::M('system/session')->start();
                    $yan = $session->get('price_' . $mobile);
                    $yan1 = $this->GP('verifycode');
//                    if ($access['verifycode']['signup']) {
//                        if (! $verifycode = $this->GP('verifycode')) {
//                            $verifycode_success = false;
//                            $this->err->add('验证码不正确', 212);
//                        } else
//                            if (! K::M('magic/verify')->check($verifycode)) {
//                                $verifycode_success = false;
//                                $this->err->add('验证码不正确', 212);
//                            }
//                    }
                    $m = K::M('member/member')->only($mobile);
                    if ($data['passwd'] == "") {
                        $this->err->add('密码为空', 212);
                    } else if ($this->GP('confirmpasswd') == "") {
                        $this->err->add('再次输入密码不能为空', 212);
                    } else if ($mobile == "") {
                        $this->err->add('手机号码不能为空', 212);
                    } else if ($yan1 == "") {
                        $this->err->add('验证码不能为空', 212);
                    } else if ($yan1 != $yan) {
                        $this->err->add('验证码不正确', 212);
                    } else if ($m >= 1) {
                        $this->err->add('该手机号已被注册', 212);
                    } else {
                        if ($verifycode_success) {
                            $data['mobile'] = $data['uname'];
                            if ($uid = K::M('member/account')->create($data)) {
                                $this->err->set_data('forward', $this->mklink('mobile/ucenter'));
                                $this->err->add('恭喜您，注册会成功');
                            }
                        }
                    }

                }
    }

    public function forget()
    {
        $this->tmpl = 'mobile/passport/forget.html';
    }
    public function find()
    {
        $mobile = $this->GP('mobile');
        $verifycode = $this->GP('verifycode');
        if ($mobile == "") {
            $this->err->add('手机号码不能为空！', 212);
        } else if (!K::M('verify/check')->mobile($mobile)) {
            $this->err->add('手机号码不正确，请重新输入！', 212);
        } else if($verifycode==""){
            $this->err->add('验证码不能为空', 212);
        }else{
            $verifycode_success = true;
            $access = $this->system->config->get('access');
            if ($access['verifycode']['login']) {
                if (!$verifycode) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确', 212);
                } else
                    if (!K::M('magic/verify')->check($verifycode)) {
                        $verifycode_success = false;
                        $this->err->add('验证码不正确', 212);
                    }
            }  
        }
        if ($verifycode_success) {
                $m=K::M('member/member')->only($mobile);
                if($m!=1){
                    $this->err->add('该账户不存在，请重新输入', 212);
                }else {
                    $code = rand(100000, 999999);
                    $session = K::M('system/session')->start();
                    $session->set('code_' . $mobile, $code, 900); // 15分钟缓存
                    $session->set('mobile_' . $mobile, $mobile,900);
                    $smsdata = array(
                        'code' => $code
                    );
                    if (K::M('sms/sms')->send($mobile, "sms_price", $smsdata)) {
                        $this->err->add("信息发送成功,请注意查收!
                     <br/>
                   <a href='/mobile/passport-code.html'><font color='red'>点击输入验证码</a></font>
                     ");

                        $this->code($mobile);
                        //$this->err->set_data('forward', $this->mklink('mobile/passport-forget'));
                    }else{
                        $this->err->add('验证码发送失败，请重新输入', 212);
                    }
                }
            }

    }
    // public function find()
    // {
    //     $mobile = $this->GP('mobile');
    //     $verifycode = $this->GP('verifycode');
    //     if ($mobile == "") {
    //         $this->err->add('手机号码不能为空！', 212);
    //     } else if (!K::M('verify/check')->mobile($mobile)) {
    //         $this->err->add('手机号码不正确，请重新输入！', 212);
    //     } else if($verifycode==""){
    //         $this->err->add('验证码不能为空', 212);
    //     }else{
    //         $verifycode_success = true;
    //         $access = $this->system->config->get('access');
    //         if ($access['verifycode']['login']) {
    //             if (!$verifycode) {
    //                 $verifycode_success = false;
    //                 $this->err->add('验证码不正确', 212);
    //             } else
    //                 if (!K::M('magic/verify')->check($verifycode)) {
    //                     $verifycode_success = false;
    //                     $this->err->add('验证码不正确', 212);
    //                 }
    //         }
    //         if ($verifycode_success) {
    //             $m=K::M('member/member')->only($mobile);
    //             if($m!=1){
    //                 $this->err->add('该账户不存在，请重新输入', 212);
    //             }else {
    //                 $code = rand(100000, 999999);
    //                 $session = K::M('system/session')->start();
    //                 $session->set('code_' . $mobile, $code, 900); // 15分钟缓存
    //                 $session->set('mobile_' . $mobile, $mobile,900);
    //                 $smsdata = array(
    //                     'code' => $code
    //                 );
    //                 if (K::M('sms/sms')->send($mobile, "sms_price", $smsdata) || true) {
    //                     $this->err->add("信息发送成功,请注意查收!
    //                  <br/>
    //                <a href='/mobile/passport-code.html'><font color='red'>点击输入验证码</a></font>
    //                 //  ");

    //                     $this->code($mobile);
    //                     //$this->err->set_data('forward', $this->mklink('mobile/passport-forget'));
    //                 }
    //             }
    //         }
    //     }

    // }
    public function yan(){
        $mobile=$this->GP('mobile');
        $yan=$this->GP('yan');
        $session = K::M('system/session')->start();
        $ss=$session->get('code_' . $mobile);// 15分钟缓存
        if ($yan==$ss){
            $member = K::M('member/member')->member($mobile,'mobile');
            $uid=$member['uid'];
            $passwd = rand(1000000,9999999);
            $smsdata = array(
                'passwd' => $passwd
            );
            $a=K::M('member/member')->update($uid, array('passwd' => md5($passwd)));
            if($a){
                K::M('sms/sms')->send($mobile,'passwd',$smsdata);
                $this->err->add("新密码已发送到您的手机,尽快修改密码！");
            }
        }else{
            $this->err->add("验证码错误，请重新输入");
        }
    }

    public function code($mobile){
        $session = K::M('system/session')->start();
        $m=$session->get('mobile_' . $mobile);
        $this->pagedata['mobile'] = $m;
        $this->tmpl = 'mobile/passport/code.html';
    }
}
