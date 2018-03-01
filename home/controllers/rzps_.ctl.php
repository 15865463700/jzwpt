<?php
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Rzps_ extends Ctl
{

    public function index($page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $area_id = $group_id = $order = 0;
        // $attr_values = K::M('data/attr')->attrs_by_from('vrqj:vrqj', true);
        // foreach($attr_values as $k=>$v){
        // $v['checked'] = false;
        // $vids = $attr_value_ids;
        // $vids[$k] = 0;
        // $vids['order'] = $order;
        // $vids['page'] = 1;
        // $v['link'] = $this->mklink('vrqj:index', array($sjfg,$jzmj,1));
        // if($v["attr_id"]==17){
        // if($sjfg==0){
        // $v["checked"]=true;
        // }
        // $v['link'] = $this->mklink('vrqj:index', array(0,$jzmj,1));
        // }elseif ($v["attr_id"]==18){
        // if($jzmj==0){
        // $v["checked"]=true;
        // }
        // $v['link'] = $this->mklink('vrqj:index', array($sjfg,0,1));
        // }
        // foreach($v['values'] as $kk=>$vv){
        // $vv['checked'] = false;
        // if(in_array($kk, $attr_ids)){
        // $v['checked'] = false;
        // $vv['checked'] = true;
        // }
        // $vids[$k] = $kk;
        // $vv['link'] = $this->mklink('vrqj:index', array(implode('-', $attr_value_ids),1));
        // if($v["attr_id"]==17){
        // if($sjfg==$vv["attr_value_id"]){
        // $vv['checked'] = true;
        // }
        // $vv['link'] = $this->mklink('vrqj:index', array($vv["attr_value_id"],$jzmj,1));
        // }elseif ($v["attr_id"]==18){
        // if($jzmj==$vv["attr_value_id"]){
        // $vv['checked'] = true;
        // }
        // $vv['link'] = $this->mklink('vrqj:index', array($sjfg,$vv["attr_value_id"],1));
        // }
        // $v['values'][$kk] = $vv;
        // }
        // $attr_values[$k] = $v;
        // }
        // $this->pagedata['attr_values'] = $attr_values;
        
        // $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 1;
        $pager['count'] = $count = 0;
        $filter['city_id'] = $this->request['city_id'];
        // if($sjfg>0||$jzmj>0){
        // $filter['attrs']=array($sjfg,$jzmj);
        // }
        
        if ($items = K::M('rzps/rzps')->items($filter, "rzps_id", $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('rzps:index', array(
                '{page}'
            ), $params));
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
        }
        // $access = $this->system->config->get('access');
        // $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
        $this->tmpl = 'rzps/index.html';
    }

    public function rzps($i = 0, $ii = 0, $iii = 0)
    {
        $idetail = K::M('article/article')->detail($i);
        $iidetail = K::M('article/article')->detail($ii);
        $iiidetail = K::M('article/article')->detail($iii);
        $this->pagedata["idetail"] = $idetail;
        $this->pagedata["iidetail"] = $iidetail;
        $this->pagedata["iiidetail"] = $iiidetail;
        $this->tmpl = 'rzps/rzps.html';
    }

    public function detail($rzps_id)
    {
        if (! $rzps_id = (int) $rzps_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('rzps/rzps')->detail($rzps_id)) {
                $this->error(404);
            } else {
                $this->pagedata['detail'] = $detail;
                $this->tmpl = 'rzps/detail.html';
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
        if (! ($tenders_id = (int) $tenders_id) && ! ($tenders_id = (int) $this->GP('tenders_id'))) {
            $this->error(404);
        } else 
            if ($this->MEMBER['from'] == 'member') {
                $this->err->add('您是业主不可以投标', 212);
            } else 
                if (! $tenders = K::M('tenders/tenders')->detail($tenders_id)) {
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
                                            if (! $content = $data['content']) {
                                                $this->err->add('给业主留言不能为空', 218);
                                            } else {
                                                if ($tenders['gold'] > 0) {
                                                    if (! K::M('member/gold')->update($this->uid, - $tenders['gold'], "看标：" . $tenders['title'] . "(ID:{$tenders_id})")) {
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