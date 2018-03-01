<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Tenders extends Ctl{

    private $_tenders_allow_fields = 'from,province_id,city_id,area_id,contact,mobile,home_name,way_id,style_id,budget_id,service_id,house_type_id,house_mj,addr,comment,zx_time';

    public function __construct(&$system)
    {
        parent::__construct($system);
        $session = K::M('system/session')->start();
        if ($session->get("substation")) {
            $this->request['city'] = $session->get("substation");
        }
    }

    public function index()
    {
        if (strpos($this->request['uri'], "enders")) {
            header("Location:{$this->request['city']['siteurl']}/wyzx.html");
            die;
        }
        $config_zxb = $this->system->config->get('zxb');
        $company = K::M('company/company')->items(array(
            'verify_name' => '1'
        ), null, null, null, $count);
        $this->pagedata['company_verify'] = $config_zxb['zxb_company'] + $count;
        $yezhu = K::M('zxb/zxb')->items(null, null, null, null, $count_yezhu);
        $yezhu_last = K::M('zxb/zxb')->items(array(
            'status' => '8'
        ), null, null, null, $last_yezhu);
        $this->pagedata['zxb_yezhu'] = $config_zxb['zxb_yezhu'] + $count_yezhu;
        $this->pagedata['zxb_last'] = $config_zxb['zxb_yezhu'] + $last_yezhu;
        $price = K::M('zxb/hetong')->items(null);
        foreach ($price as $k => $v) {
            $total_price += $v['total_price'];
        }
        $access = $this->system->config->get('access');
        $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
        $this->pagedata['satisfaction'] = $config_zxb['satisfaction'];
        $this->pagedata['zxb_price'] = $config_zxb['zxb_price'] + $total_price;
        $this->seo->init('zxb');
        // $this->tmpl = 'tenders/index.html';

        // $access = $this->system->config->get('access');
        $this->pagedata['tender_yz'] = $access['verifycode']['tender'];

//        $this->seo->init('zxb');
        $this->seo->init('tenders');
        $this->pagedata['canonical'] = "www.jzwpt.com/tenders/";
        $this->tmpl = 'tenders/index.html';
    }

    public function detail($tenders_id)
    {
        if ($_REQUEST["a"]) {
            $tenders_id = $_REQUEST["a"];
        }
        if (!$tenders_id = (int)$tenders_id) {
            $this->error(404);
        } else
            if (!$detail = K::M('tenders/tenders')->detail($tenders_id)) {
                $this->error(404);
            } else
                if (empty($detail['audit'])) {
                    $this->err->add('内容审核中 ，暂不可访问', 211);
                } else {
                    if ($look_list = K::M('tenders/look')->items(array(
                        'tenders_id' => $tenders_id
                    ))) {
                        $uids = array();
                        foreach ($look_list as $v) {
                            $uids[$v['uid']] = $v['uid'];
                        }
                        if ($member_list = K::M('member/member')->items_by_ids($uids)) {
                            $company_uids = $shop_uids = $gz_uids = $designer_uids = array();
                            foreach ($member_list as $v) {
                                switch ($v['from']) {
                                    case 'company':
                                        $company_uids[$v['uid']] = $v['uid'];
                                        break;
                                    case 'shop':
                                        $shop_uids[$v['uid']] = $v['uid'];
                                        break;
                                    case 'gz':
                                        $gz_uids[$v['uid']] = $v['uid'];
                                        break;
                                    case 'designer':
                                        $designer_uids[$v['uid']] = $v['uid'];
                                        break;
                                }
                            }
                            if ($company_uids) {
                                $this->pagedata['company_list'] = K::M('company/company')->items_by_uids($company_uids);
                            }
                            if ($shop_uids) {
                                $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_uids($shop_uids);
                            }
                            if ($gz_uids) {
                                $this->pagedata['gz_list'] = K::M('gz/gz')->items_by_ids($gz_uids);
                            }
                            if ($designer_uids) {
                                $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_uids);
                            }
                            $this->pagedata['member_list'] = $member_list;
                        }
                        $this->pagedata['look_list'] = $look_list;
                    }
                    $this->pagedata['detail'] = $detail;
                    $this->seo->init('tenders_detail', array(
                        'title' => $detail['title']
                    ));
                    //添加seo标题
                    $this->seo->init('way_title');
                    $this->tmpl = 'tenders/detail.html';
                }
    }

    public function company()
    {
        $this->tmpl = 'tenders/company.html';
    }

    public function tenders($page = 1)
    {
        $this->tmpl = 'tenders/items.html';
    }

    public function fast()
    {
        if ($data = $this->checksubmit('data')) {
            $verifycode_success = true;
            $access = $this->system->config->get('access');
            if ($access['verifycode']['tender']) {
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
                $data['uid'] = (int)$this->uid;
                $data['from'] = 'TZX';
                $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];
                if ($id = K::M('tenders/tenders')->create($data)) {
                    $this->err->add('恭喜您发布招标成功！');
                }
            }
        } else {
            $access = $this->system->config->get('access');
            $this->pagedata['tender_yz'] = $access['verifycode']['tender'];
            $this->tmpl = 'tenders/fast.html';
        }
    }

    public function look($tenders_id = null)
    {
        $this->check_login();
        if (!($tenders_id = (int)$tenders_id) && !($tenders_id = (int)$this->GP('tenders_id'))) {
            $this->error(404);
        } else
            if ($this->MEMBER['from'] == 'member') {
                $this->err->add('您是业主不可以投标', 212);
            } else
                if (!$tenders = K::M('tenders/tenders')->detail($tenders_id)) {
                    $this->err->add('招标不存在或已经删除', 213);
                } else
                    if (empty($tenders['audit'])) {
                        $this->err->add('内容审核中，不可进行投标', 214);
                    } else
                        if ($tenders['looks'] >= $tenders['max_look']) {
                            $this->err->add('该招标已经结束了!', 212);
                        } else
                            if ($data = $this->checksubmit('data')) {
                                if (K::M('member/group')->check_priv($this->MEMBER['group_id'], 'tenders_look') < 0) {
                                    $this->err->add('您是【' . $this->MEMBER['group_name'] . '】没有权限投标', 215);
                                } else
                                    if ($this->MEMBER['gold'] < $tenders['gold']) {
                                        $this->err->add('您的金币不足，请先充值', 216);
                                    } else
                                        if (K::M('tenders/look')->is_looked($this->uid, $tenders_id)) {
                                            $this->err->add('您已经投标过了，不用重复投标', 217);
                                        } else
                                            if (!$content = $data['content']) {
                                                $this->err->add('给业主留言不能为空', 218);
                                            } else {
                                                if ($tenders['gold'] > 0) {
                                                    if (!K::M('member/gold')->update($this->uid, -$tenders['gold'], "看标：" . $tenders['title'] . "(ID:{$tenders_id})")) {
                                                        $this->err->add('扣费失败', 201)->response();
                                                    }
                                                }
                                                $data = array(
                                                    'tenders_id' => $tenders_id,
                                                    'uid' => $this->uid,
                                                    'content' => $content
                                                );
                                                if ($look_id = K::M('tenders/look')->create($data)) {
                                                    K::M('tenders/tenders')->update_count($tenders_id, 'looks');
                                                    switch ($this->MEMBER['from']) {
                                                        case 'gz':
                                                            K::M('gz/gz')->update_count($this->uid, 'tenders_num');
                                                            break;
                                                        case 'designer':
                                                            K::M('designer/designer')->update_count($this->uid, 'tenders_num');
                                                            break;
                                                        case 'mechanic':
                                                            K::M('mechanic/mechanic')->update_count($this->uid, 'tenders_num');
                                                            break;
                                                        case 'company':
                                                            $company = K::M('company/company')->company_by_uid($this->uid);
                                                            K::M('company/company')->update_count($company['company_id'], 'tenders_num');
                                                            break;
                                                        case 'shop':
                                                            K::M('shop/shop')->update_count($this->shop['shop_id'], 'tenders_num');
                                                            break;
                                                    }
                                                    $this->err->add('参加竞标成功！');
                                                }
                                            }
                            } else {
                                $this->pagedata['tenders'] = $tenders;
                                $this->tmpl = 'tenders/look.html';
                            }
    }

    public function save(){
        if ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_tenders_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if (empty($data["contact"])) {
                    $this->err->add('请输入姓名', 201)->response();
                }
                if (!K::M('verify/check')->phone($data['mobile'])) {
                    $this->err->add("手机号码输入错误！", 211)->response();
                }
                $verifycode_success = true;
                $access = $this->system->config->get('access');
                if ($access['verifycode']['tender']) {
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
                    $data['uid'] = (int)$this->uid;
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
//                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
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

    public function see()
    {
        if ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_tenders_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if (empty($data["contact"])) {
                    $this->err->add('请输入姓名', 201)->response();
                }
                if (!K::M('verify/check')->phone($data['mobile'])) {
                    $this->err->add("手机号码输入错误！", 211)->response();
                }
                if (empty($data["province_id"])) {
                    $this->err->add('请选择省份', 201)->response();
                }
                if (empty($data["city_id"])) {
                    $this->err->add('请选择城市', 201)->response();
                }
                if (empty($data["area_id"])) {
                    $this->err->add('请选择县', 201)->response();
                }
                $verifycode_success = true;
                $access = $this->system->config->get('access');
                /*
                 * if($access['verifycode']['tender']){
                 * if(!$verifycode = $this->GP('verifycode')){
                 * $verifycode_success = false;
                 * $this->err->add('验证码不正确', 212);
                 * }else if(!K::M('magic/verify')->check($verifycode)){
                 * $verifycode_success = false;
                 * $this->err->add('验证码不正确', 212);
                 * }
                 * }
                 */
                if ($verifycode_success) {
                    $data['uid'] = (int)$this->uid;
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
                    $data['title'] = sprintf("%s,手机号码[%s]", $data['contact'], $data['mobile']);
                    $data['from'] = "see";
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
//                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
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

    public function home()
    {
        $session = K::M('system/session')->start();
        // 联系人
        // 电话
        // 城市
        if ($_POST) {
            $session = K::M('system/session')->start();
            if (empty($_REQUEST["phone_code"]) || $_REQUEST["phone_code"] != $session->get("price_{$_REQUEST['phone']}")) {
                die(json_encode(array(
                    "message" => "验证码错误或者已经过期!"
                )));
            }
            if (empty($_REQUEST["chenghu"])) {
                die(json_encode(array(
                    "message" => "称呼不能为空!"
                )));
            }
            if (!$province_id = intval($_REQUEST["province_id"])) {
                die(json_encode(array(
                    "message" => "请选择省份!"
                )));
            }
            if (!$city_id = intval($_REQUEST["city_id"])) {
                die(json_encode(array(
                    "message" => "请选择城市!"
                )));
            }
            if (!K::M('verify/check')->phone($_REQUEST["phone"])) {
                die(json_encode(array(
                    "message" => "手机号码输入不正确!"
                )));
            }
            $session->delete("price_{$_REQUEST['phone']}");

            $data = array();
            $data["title"] = "用户【{$_REQUEST['chenghu']}】，手机号【{$_REQUEST['phone']}】";
            $data["mobile"] = $_REQUEST['phone'];
            $data["contact"] = $_REQUEST['chenghu'];
            $data["from"] = "TSJ";
            $data["clientip"] = __IP;
            $data["dateline"] = time();
            $data['city_id'] = empty($_REQUEST["city_id"]) ? $this->request['city_id'] : $_REQUEST["city_id"];
            $data['uid'] = $this->MEMBER["uid"];
            K::M('tenders/tenders')->create($data);
            $cfg = $this->system->config->get('site');
            foreach ($items as $k => $v) {
                $items[$k]['city_name'] = $city_list[$v['city_id']]['city_name'];
            }
            $city = K::M('data/city')->detail($data['city_id']);
            die(json_encode(array(
                "code" => 1,
                "message" => "您的申请已提交，我们将第一时间为您服务!",
                "link" => "http://" . $city['pinyin'] . "." . $cfg['city_domain']
            )));
        } else {
            die(json_encode(array(
                "message" => "非法请求!"
            )));
        }
    }

    public function gz(){
        if ($data = $this->checksubmit('data')) {
            if (empty($data["contact"])) {
                $this->err->add('请输入姓名', 201)->response();
            } elseif (!K::M('verify/check')->phone($data['mobile'])) {
                $this->err->add("手机号码输入错误！", 211)->response();
            } elseif (!$data['max_look']) {
                $this->err->add("可竞标的公司数量不能为空！", 211)->response();
            } elseif (!$verifycode = $this->GP('verifycode')) {
                $verifycode_success = false;
                $this->err->add('验证码不正确', 212);
            } else {
                $session = K::M('system/session')->start();
                $vcode = $session->get('price_' . $data['mobile']);
                $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                    if (!$verifycode||$verifycode!=$vcode) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                } else {
                    $verifycode_success = true;
                    $zizhi = array(
                        0 => "",
                        1 => "_资质等级(一级)",
                        2 => "_资质等级(二级)",
                        3 => "_资质等级(三级)",
                    );
                    $biaoshu = array(
                        0 => "",
                        1 => "_标书制作(是)",
                        2 => "_标书制作(否)",
                    );
                    $xiaofang = array(
                        0 => "",
                        1 => "_申报消防(是)",
                        2 => "_申报消防(否)",
                    );
                    $data['title'] = "{$data['danwei']}_{$data['contact']}{$zizhi[$data['zizhi']]}{$biaoshu[$data['biaoshu']]}{$xiaofang[$data['xiaofang']]}";
                    if ($verifycode_success) {
                        $data['uid'] = (int)$this->uid;
                        if (empty($data['city_id'])) {
                            $data['city_id'] = $this->request['city_id'];
                        }
                        if (empty($data['contact']) && ($this->uid)) {
                            $data['contact'] = $this->MEMBER['uname'];
                        }
                        $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];

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
//                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                            $this->tmpl = 'tenders/success.html';
                            $wx_tenders_qr = false;
                            $this->err->set_data('tenders_id', $tenders_id);
//                                $this->err->set_data('wx_tenders_qr', $wx_tenders_qr);
                            $this->err->set_data('show_content', $this->output(true));
                            $this->tmpl = null;
                            if ($this->uid) {
                                $this->err->set_data('forward', $this->mklink('ucenter/member/yuyue:tendersDetail', array(
                                    $tenders_id
                                )));
                            }else{
                                $this->err->set_data('forward','/gz/');
                            }
                            $this->err->add('恭喜您发布招标成功！');
                        }
                    }
                }
            }
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }

    public function bs(){
        if ($data = $this->checksubmit('data')) {
            $zhengbao="";
            switch($data['zhengbao']){
                case 0:
                    $zhengbao="";
                    break;
                case 1:
                    $zhengbao="_八大系统是否整包(是)";
                    break;
                case 2:
                    $zhengbao="_八大系统是否整包(否)";
                    break;
            }
            $data['title']="{$data['contact']}_预备金({$data['yubeijin']}){$zhengbao}";
            if (empty($data["contact"])) {
                $this->err->add('请输入姓名', 201)->response();
            } elseif (!K::M('verify/check')->phone($data['mobile'])) {
                $this->err->add("手机号码输入错误！", 211)->response();
            } elseif (!$data['max_look']) {
                $this->err->add("PK公司的数量不能为空！", 211)->response();
            } elseif (!$verifycode = $this->GP('verifycode')) {
                $verifycode_success = false;
                $this->err->add('验证码不正确', 212);
            } else {
                $session = K::M('system/session')->start();
                $vcode = $session->get('price_' . $data['mobile']);
                $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                    if (!$verifycode||$verifycode!=$vcode) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                } else {
                    $verifycode_success = true;

                    if ($verifycode_success) {
                        $data['uid'] = (int)$this->uid;
                        if (empty($data['city_id'])) {
                            $data['city_id'] = $this->request['city_id'];
                        }
                        if (empty($data['contact']) && ($this->uid)) {
                            $data['contact'] = $this->MEMBER['uname'];
                        }
                        $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];

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
//                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                            $this->tmpl = 'tenders/success.html';
                            $wx_tenders_qr = false;
                            $this->err->set_data('tenders_id', $tenders_id);
//                                $this->err->set_data('wx_tenders_qr', $wx_tenders_qr);
                            $this->err->set_data('show_content', $this->output(true));
                            $this->tmpl = null;
                            if ($this->uid) {
                                $this->err->set_data('forward', $this->mklink('ucenter/member/yuyue:tendersDetail', array(
                                    $tenders_id
                                )));
                            }else{
                                $this->err->set_data('forward','/gz/');
                            }
                            $this->err->add('恭喜您发布招标成功！');
                        }
                    }
                }
            }
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }

    public function jz(){
        if ($data = $this->checksubmit('data')) {
            $fengge="";
            if($data["fengge"]){
                $fengge="_装修风格({$data["fengge"]})";
            }
            $huxing="";
            if($data["huxing"]){
                $huxing="_装修风格({$data["huxing"]})";
            }
            $xiaoqu="";
            if($data["xiaoqu"]){
                $xiaoqu="_装修风格({$data["xiaoqu"]})";
            }
            $data['title']="{$data['contact']}{$xiaoqu}{$fengge}{$huxing}";
            if (empty($data["contact"])) {
                $this->err->add('请输入姓名', 201)->response();
            } elseif (!K::M('verify/check')->phone($data['mobile'])) {
                $this->err->add("手机号码输入错误！", 211)->response();
            } elseif (!$verifycode = $this->GP('verifycode')) {
                $verifycode_success = false;
                $this->err->add('验证码不正确', 212);
            } else {
                $session = K::M('system/session')->start();
                $vcode = $session->get('price_' . $data['mobile']);
                $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                    if (!$verifycode||$verifycode!=$vcode) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                } else {
                    $verifycode_success = true;

                    if ($verifycode_success) {
                        $data['uid'] = (int)$this->uid;
                        if (empty($data['city_id'])) {
                            $data['city_id'] = $this->request['city_id'];
                        }
                        if (empty($data['contact']) && ($this->uid)) {
                            $data['contact'] = $this->MEMBER['uname'];
                        }
                        $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];

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
//                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                            $this->tmpl = 'tenders/success.html';
                            $wx_tenders_qr = false;
                            $this->err->set_data('tenders_id', $tenders_id);
//                                $this->err->set_data('wx_tenders_qr', $wx_tenders_qr);
                            $this->err->set_data('show_content', $this->output(true));
                            $this->tmpl = null;
                            if ($this->uid) {
                                $this->err->set_data('forward', $this->mklink('ucenter/member/yuyue:tendersDetail', array(
                                    $tenders_id
                                )));
                            }else{
                                $this->err->set_data('forward','/gz/');
                            }
                            $this->err->add('恭喜您发布招标成功！');
                        }
                    }
                }
            }
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }

    public function rz(){
        if ($data = $this->checksubmit('data')) {
            $fengge="";
            if($data["fengge"]){
                $fengge="_装修风格({$data["fengge"]})";
            }
            $huxing="";
            if($data["huxing"]){
                $huxing="_装修风格({$data["huxing"]})";
            }
            $xiaoqu="";
            if($data["xiaoqu"]){
                $xiaoqu="_装修风格({$data["xiaoqu"]})";
            }
            $data['title']="{$data['contact']}{$xiaoqu}{$fengge}{$huxing}";
            if (empty($data["from"])) {
                $this->err->add('请选择招标类型', 201)->response();
            } elseif ($data["from"]===0||$data["from"]==="0") {
                $this->err->add('请选择招标类型!', 201)->response();
            } elseif (empty($data["max_look"])) {
                $this->err->add('请输入需要几家公司PK!', 201)->response();
            } elseif ($data["max_look"]===0||$data["from"]==="0") {
                $this->err->add('请输入需要几家公司PK!', 201)->response();
            } elseif (empty($data["house_mj"])) {
                $this->err->add('请输入房屋面积!', 201)->response();
            } elseif ($data["house_mj"]===0||$data["from"]==="0") {
                $this->err->add('请输入房屋面积!', 201)->response();
            } elseif (empty($data["contact"])) {
                $this->err->add('请输入姓名', 201)->response();
            } elseif (!K::M('verify/check')->phone($data['mobile'])) {
                $this->err->add("手机号码输入错误！", 211)->response();
            } elseif (!$verifycode = $this->GP('verifycode')) {
                $verifycode_success = false;
                $this->err->add('验证码不正确', 212);
            } else {
                $session = K::M('system/session')->start();
                $vcode = $session->get('price_' . $data['mobile']);
                $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                    if (!$verifycode||$verifycode!=$vcode) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                } else {
                    $verifycode_success = true;

                    if ($verifycode_success) {
                        $data['uid'] = (int)$this->uid;
                        if (empty($data['city_id'])) {
                            $data['city_id'] = $this->request['city_id'];
                        }
                        if (empty($data['contact']) && ($this->uid)) {
                            $data['contact'] = $this->MEMBER['uname'];
                        }
                        $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];

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
//                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                            $this->tmpl = 'tenders/success.html';
                            $wx_tenders_qr = false;
                            $this->err->set_data('tenders_id', $tenders_id);
//                                $this->err->set_data('wx_tenders_qr', $wx_tenders_qr);
                            $this->err->set_data('show_content', $this->output(true));
                            $this->tmpl = null;
                            if ($this->uid) {
                                $this->err->set_data('forward', $this->mklink('ucenter/member/yuyue:tendersDetail', array(
                                    $tenders_id
                                )));
                            }else{
                                $this->err->set_data('forward','/gz/');
                            }
                            $this->err->add('恭喜您发布招标成功！');
                        }
                    }
                }
            }
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }

    public function zn(){
        if ($data = $this->checksubmit('data')) {
            $other="";
            if($_REQUEST['other']){
                $other="_其他要求({$_REQUEST["other"]})";
            }
//            $huxing="";
//            if($data["huxing"]){
//                $huxing="_装修风格({$data["huxing"]})";
//            }
//            $xiaoqu="";
//            if($data["xiaoqu"]){
//                $xiaoqu="_装修风格({$data["xiaoqu"]})";
//            }
            $data['title']="{$data['contact']}{$other}";
            if (empty($data["from"])) {
                $this->err->add('请选择招标类型', 201)->response();
            } elseif ($data["from"]===0||$data["from"]==="0") {
                $this->err->add('请选择招标类型!', 201)->response();
            } elseif (empty($data["max_look"])) {
                $this->err->add('请输入需要几家公司PK!', 201)->response();
            } elseif ($data["max_look"]===0||$data["from"]==="0") {
                $this->err->add('请输入需要几家公司PK!', 201)->response();
            } elseif (empty($data["house_mj"])) {
                $this->err->add('请输入房屋面积!', 201)->response();
            } elseif ($data["house_mj"]===0||$data["from"]==="0") {
                $this->err->add('请输入房屋面积!', 201)->response();
            } elseif (empty($data["contact"])) {
                $this->err->add('请输入姓名', 201)->response();
            } elseif (!K::M('verify/check')->phone($data['mobile'])) {
                $this->err->add("手机号码输入错误！", 211)->response();
            } elseif (!$verifycode = $this->GP('verifycode')) {
                $verifycode_success = false;
                $this->err->add('验证码不正确', 212);
            } else {
                $session = K::M('system/session')->start();
                $vcode = $session->get('price_' . $data['mobile']);
                $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                    if (!$verifycode||$verifycode!=$vcode) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确' . $verifycode . "-" . $vcode, 212);
                } else {
                    $verifycode_success = true;

                    if ($verifycode_success) {
                        $data['uid'] = (int)$this->uid;
                        if (empty($data['city_id'])) {
                            $data['city_id'] = $this->request['city_id'];
                        }
                        if (empty($data['contact']) && ($this->uid)) {
                            $data['contact'] = $this->MEMBER['uname'];
                        }
                        $data['city_id'] = empty($data['city_id']) ? $this->request['city_id'] : $data['city_id'];

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
//                        K::M('helper/mail')->sendadmin('admin_tenders', $maildata);
                            $this->tmpl = 'tenders/success.html';
                            $wx_tenders_qr = false;
                            $this->err->set_data('tenders_id', $tenders_id);
//                                $this->err->set_data('wx_tenders_qr', $wx_tenders_qr);
                            $this->err->set_data('show_content', $this->output(true));
                            $this->tmpl = null;
                            if ($this->uid) {
                                $this->err->set_data('forward', $this->mklink('ucenter/member/yuyue:tendersDetail', array(
                                    $tenders_id
                                )));
                            }else{
                                $this->err->set_data('forward','/gz/');
                            }
                            $this->err->add('恭喜您发布招标成功！');
                        }
                    }
                }
            }
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }

}
