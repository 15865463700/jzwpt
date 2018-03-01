<?php
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Cshhr extends Ctl{
    
    public function __construct(&$system)
    {
        parent::__construct($system);
        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
    }
    
    public function appli()
    {
        $data= $this->checksubmit('data');
        var_dump($data);die;
        $data = array(
            "contact" => $_REQUEST["contact"],
            "place" => $_REQUEST["place"],
            "weixin" => $_REQUEST["weixin"],
            "mobile" => $_REQUEST["mobile"],
            "phone_code" => $_REQUEST["phone_code"]
        );
        if (empty($data['contact'])) {
            $this->err->add("称呼不能为空！", 211)->response();
        }
        if (empty($data['place'])) {
            $this->err->add("区域不能为空！", 211)->response();
        }
        if (empty($data['weixin'])) {
            $this->err->add("微信不能为空！", 211)->response();
        }
        if (! K::M('verify/check')->phone($data['mobile'])) {
            $this->err->add("手机号码输入错误！", 211)->response();
        }
        
        if (empty($data['phone_code'])) {
            $this->err->add("验证码不能为空！", 211)->response();
        }
        $session = K::M('system/session')->start();
        if (empty($_REQUEST["phone_code"]) || $_REQUEST["phone_code"] != $session->get("price_{$_REQUEST['mobile']}")) {
            $this->err->add('验证码错误或者已经过期!', 0)->response();
        }
        $session->delete("price_{$_REQUEST['mobile']}");
        
        // $data=array();
        // $data["title"]="用户【{$_REQUEST['chenghu']}】，手机号【{$_REQUEST['phone']}】";
        // $data["mobile"]=$_REQUEST['phone'];
        // $data["contact"]=$_REQUEST['chenghu'];
        // $data["from"]="TSJ";
        // $data["clientip"]=__IP;
        // $data["dateline"]=time();
        // $data['city_id'] = empty($_REQUEST["city_id"]) ? $this->request['city_id'] : $_REQUEST["city_id"];
        
        if (K::M('cshhrappli/cshhrappli')->create($data)) {
            $this->err->add('恭喜您申请成功！', 1)->response();
        } else {
            $this->err->add('申请失败，请稍后再试！', 0)->response();
        }
        //
        // $this->tmpl = 'cshhr/cshhr.html';
        // $cfg = $this->system->config->get('site');
        
        // die(json_encode(array(
        // "message"=>"您的免费设计申请已提交，我们将第一时间为您服务!",
        // "link"=>"http://".$city['pinyin'].".".$cfg['city_domain'],
        // )));
    }

    public function save()
    {
        if ($data = $this->checksubmit('data')) {
            if (! $data = $this->check_fields($data, $this->_tenders_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                $verifycode_success = true;
                $access = $this->system->config->get('access');
                if ($access['verifycode']['tender']) {
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
                    if (empty($data['city_id'])) {
                        $data['city_id'] = $this->request['city_id'];
                    }
                    if (empty($data['contact']) && ($this->uid)) {
                        $data['contact'] = $this->MEMBER['uname'];
                    }
                    if ($attach = $_FILES['huxing']) {
                        if (UPLOAD_ERR_OK == $attach['error']) {
                            if ($a = K::M('magic/upload')->upload($attach, 'tenders')) {
                                $data['huxing'] = K::M('content/html')->encode($a['photo']);
                            }
                        }
                    }
                    $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];
                    if ($fenxiaoid = $this->cookie->get('fenxiaoid')) {
                        $data['fenxiaoid'] = $fenxiaoid;
                    }
                    if ($tenders_id = K::M('tenders/tenders')->create($data)) {
                        if ($attr = $this->GP('attr')) {
                            K::M('tenders/attr')->update($tenders_id, $attr);
                        }
                        $this->pagedata['tenders_id'] = $tenders_id;
                        $smsdata = $maildata = array(
                            'contact' => $data['contact'] ? $data['contact'] : '业主',
                            'mobile' => $data['mobile']
                        );
                        K::M('sms/sms')->send($data['mobile'], 'tenders', $smsdata);
                        K::M('sms/sms')->admin('admin_tenders', $smsdata);
                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                        $this->tmpl = 'tenders/success.html';
                        $wx_tenders_qr = false;
                        if ($wechatCfg = $this->system->config->get('wechat')) {
                            if ($client = K::M('weixin/weixin')->admin_wechat_client()) {
                                if ($client->weixin_type == 1) {
                                    $data = array(
                                        'uid' => $uid,
                                        'type' => 'tenders',
                                        'addon' => array(
                                            'tenders_id' => $tenders_id
                                        )
                                    );
                                    if ($scene_id = K::M('weixin/authcode')->create($data)) {
                                        if ($ticket = $client->getQrcodeTicket(array(
                                            'scene_id' => $scene_id,
                                            'expire' => 1800
                                        ))) {
                                            $wx_tenders_qr = $client->getQrcodeImgUrlByTicket($ticket);
                                            $this->pagedata['wx_tenders_qr'] = $wx_tenders_qr;
                                        }
                                    }
                                }
                            }
                        }
                        $this->err->set_data('tenders_id', $tenders_id);
                        $this->err->set_data('wx_tenders_qr', $wx_tenders_qr);
                        $this->err->set_data('show_content', $this->output(true));
                        $this->tmpl = null;
                        if ($this->uid) {
                            $this->err->set_data('forward', $this->mklink('ucenter/member/yuyue:tendersDetail', array(
                                $tenders_id
                            )));
                        }
                        $this->err->add('恭喜您发布招标成功！');
                    }
                }
            }
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }
}