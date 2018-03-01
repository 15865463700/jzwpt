<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Tenders_Tenders extends Ctl {

    public function index($page = 1) {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if ($SO = $this->GP('SO')) {
            $pager['SO'] = $SO;
            if ($SO['tenders_id']) {
                $filter['tenders_id'] = $SO['tenders_id'];
            }
            if ($SO['from']) {
                $filter['from'] = $SO['from'];
            }
            if ($SO['city_id']) {
                $filter['city_id'] = $SO['city_id'];
            }
            if ($SO['title']) {
                $filter['title'] = "LIKE:%" . $SO['title'] . "%";
            }
            if ($SO['contact']) {
                $filter['contact'] = "LIKE:%" . $SO['contact'] . "%";
            }
            if ($SO['mobile']) {
                $filter['mobile'] = "LIKE:%" . $SO['mobile'] . "%";
            }
            if ($SO['home_name']) {
                $filter['home_name'] = "LIKE:%" . $SO['home_name'] . "%";
            }
            if (is_numeric($SO['status'])) {
                $filter['status'] = $SO['status'];
            }
            if (is_numeric($SO['audit'])) {
                $filter['audit'] = $SO['audit'];
            }
            if (is_array($SO['zx_time'])) {
                if ($SO['zx_time'][0] && $SO['zx_time'][1]) {
                    $a = strtotime($SO['zx_time'][0]);
                    $b = strtotime($SO['zx_time'][1]) + 86400;
                    $filter['zx_time'] = $a . "~" . $b;
                }
            }
            if (is_array($SO['tx_time'])) {
                if ($SO['tx_time'][0] && $SO['tx_time'][1]) {
                    $a = strtotime($SO['tx_time'][0]);
                    $b = strtotime($SO['tx_time'][1]) + 86400;
                    $filter['tx_time'] = $a . "~" . $b;
                }
            }
            if (is_array($SO['dateline'])) {
                if ($SO['dateline'][0] && $SO['dateline'][1]) {
                    $a = strtotime($SO['dateline'][0]);
                    $b = strtotime($SO['dateline'][1]) + 86400;
                    $filter['dateline'] = $a . "~" . $b;
                }
            }
        }
        if ($items = K::M('tenders/tenders')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:tenders/tenders/items.html';
    }

    public function so() {
        $this->tmpl = 'admin:tenders/tenders/so.html';
    }

    public function detail($tenders_id = null) {
        if (!$tenders_id = (int) $tenders_id) {
            $this->err->add('未指定要查看内容的ID', 211);
        }
        $detail = K::M('tenders/tenders')->detail($tenders_id);
//        if(!$detail['gold']){
//            if($detail['from']=='jz'){
//                K::M('tenders/tenders')->update($detail['tenders_id'], array('gold' =>599));
//                $detail = K::M('tenders/tenders')->detail($tenders_id);
//            }else if($detail['from']=='gz'){
//                K::M('tenders/tenders')->update($detail['tenders_id'], array('gold' =>599));
//                $detail = K::M('tenders/tenders')->detail($tenders_id);
//            }else if($detail['from']=='bs'){
//                K::M('tenders/tenders')->update($detail['tenders_id'], array('gold' =>599));
//                $detail = K::M('tenders/tenders')->detail($tenders_id);
//            }
//        }
        if (!$detail) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        } else {
            $uids = array();
            if ($uid = $detail['uid']) {
                $uids[$v['uid']] = $uid;
            }
            $look_list = K::M('tenders/look')->items_by_tenders($tenders_id, 1, 200);
            if ($look_list) {
                foreach ($look_list as $k => $v) {
                    $uids[$v['uid']] = $v['uid'];
                }
                $this->pagedata['look_list'] = $look_list;
            }
            if ($uids) {
                $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
            }
            if (!$attrs = K::M('tenders/attr')->attrs_by_tenders($tenders_id)) {
                $attrs = array();
            }
            $detail['from_attr_key'] = 'tenders:' . $detail['from'];
            $detail['attrvalues'] = array_keys($attrs);
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:tenders/tenders/detail.html';
        }
    }

    public function create() {
        if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if ($attach = $_FILES['huxing']) {
                    $upload = K::M('magic/upload');
                    if ($attach['error'] == UPLOAD_ERR_OK) {
                        if ($a = $upload->upload($attach, 'tenders')) {
                            $data['huxing'] = $a['photo'];
                        }
                    }
                }
                if ($tenders_id = K::M('tenders/tenders')->create($data)) {
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', '?tenders/tenders-index.html');
                }
            }
        } else {
            $this->tmpl = 'admin:tenders/tenders/create.html';
        }
    }

    public function edit($tenders_id = null) {
        if (!($tenders_id = (int) $tenders_id) && !($tenders_id = $this->GP('tenders_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('tenders/tenders')->detail($tenders_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if ($this->checksubmit('data')) {
            $zbpd = $_REQUEST['zbpd'];
            $price=0;
            if($zbpd=="jz_299"){
                $price=299;
            }elseif ($zbpd=="gz_399") {
                $price=399;
            }elseif ($zbpd=="gz_699") {
                $price=699;
            }elseif ($zbpd=="gz_999") {
                $price=999;
            }elseif ($zbpd=="bs_1200") {
                $price=1200;
            }
            if($price!=$_REQUEST['data']['gold']){
                $this->err->add('派单信息错误！', 212);
            }elseif (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            }else {
                if ($attach = $_FILES['huxing']) {
                    $upload = K::M('magic/upload');
                    if ($attach['error'] == UPLOAD_ERR_OK) {
                        if ($a = $upload->upload($attach, 'tenders', $detail['hunxing'])) {
                            $data['huxing'] = $a['photo'];
                        }
                    }
                }
                if ($detail['audit'] == 0) {
                    $add = 1;
                }
                if (K::M('tenders/tenders')->update($tenders_id, $data)) {
                    $member = K::M('member/member')->detail($detail['uid']);

                    if ($add == 1 && $detail['fenxiaoid'] > '0' && $data['audit'] == 1) {
                        $fenxiao_money = $this->system->config->get('fenxiao');
                        K::M('member/member')->update_count($detail['fenxiaoid'], 'jifen', $fenxiao_money['audit']);
                        K::M('fenxiao/log')->log($detail['fenxiaoid'], $detail['tenders_id'], 1, $fenxiao_money['audit'], '招标审核通过返利');
                    }
                    if ($detail['from'] == 'ZXB') {
                        K::M('zxb/zxb')->update($detail['zxb_id'], array('audit' => $data['audit']));
                    }
                    if ($attr = $this->GP('attr')) {
                        K::M('tenders/attr')->update($tenders_id, $attr);
                    }
                    if ($detail['openid']) {
                        if ($wechatCfg = $this->system->config->get('wechat')) {
                            if ($client = K::M('weixin/weixin')->admin_wechat_client()) {
                                if ($client->weixin_type == 1) {
                                    //模板消息
                                    $params = array();
                                    $params['title'] = '您的装修招标有了新消息';
                                    $params['items'] = array($detail['from_title'], date('Y-m-d'));
                                    $CFG = $this->system->_CFG;
                                    $wx_tenders_url = 'weixin/tenders-detail-' . $tenders_id . '.html';
                                    if ($CFG['site']['rewrite']) {
                                        $wx_tenders_url = $CFG['site']['siteurl'] . '/' . $wx_tenders_url;
                                    } else {
                                        $wx_tenders_url = $CFG['sute']['siteurl'] . '/index.php?' . $wx_tenders_url;
                                    }
                                    $client->sendTempMsg($detail['openid'], 'DGU3xtbiBDqRcwkUHBhOzIZVL9HlqPDJqjZQlRk7tb8', $wx_tenders_url, $params);
                                }
                            }
                        }
                    }
                    $this->err->add('修改内容成功');
                }
            }
        } else {
            if ($uid = $detail['uid']) {
                $this->pagedata['member'] = K::M('member/member')->member($uid);
            }
            if (!$attrs = K::M('tenders/attr')->attrs_by_tenders($tenders_id)) {
                $attrs = array();
            }
            $detail['attrvalues'] = array_keys($attrs);
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:tenders/tenders/edit.html';
        }
    }

    public function doaudit($tenders_id = null) {
        if ($tenders_id = (int) $tenders_id) {
            if (K::M('tenders/tenders')->batch($tenders_id, array('audit' => 1))) {
                $this->err->add('审核内容成功');
            }
        } else if ($ids = $this->GP('tenders_id')) {
            if (K::M('tenders/tenders')->batch($ids, array('audit' => 1))) {
                $this->err->add('批量审核内容成功');
            }
        } else {
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($tenders_id = null) {
        if ($tenders_id = (int) $tenders_id) {
            if (K::M('tenders/tenders')->delete($tenders_id)) {
                $this->err->add('删除成功');
            }
        } else if ($ids = $this->GP('tenders_id')) {
            if (K::M('tenders/tenders')->delete($ids)) {
                $this->err->add('批量删除成功');
            }
        } else {
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

    public function reg($tenders_id=null){
        if (!$tenders_id = (int) $tenders_id) {
            $this->err->add('未指定要查看内容的ID', 211);
        }
        $detail = K::M('tenders/tenders')->detail($tenders_id);
        if (!$detail) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        }
        $mobile=$detail['mobile'];
        $passwd = rand(1000000,9999999);
        
        $account=array();
        $account['uname']=$mobile;
        $account['passwd']=$passwd;
        $account['mobile']=$mobile;
        $account['from']='member';
        
        if (! K::M('verify/check')->phone($account["mobile"])) {
            $this->err->add('注册失败,手机号码不正确!', 213);
        } else {
            $m = K::M('member/member')->only($mobile);
            if($m>=1){
                $m = K::M('member/member')->getByMobile($mobile);
                if($m){
                    $flag=K::M('tenders/tenders')->update($tenders_id,array('uid' =>$m['uid']));
                    if($flag){
                        $this->err->add('该手机号码已被注册！绑定成功!');
                    }else{
                        $this->err->add('该手机号码已被注册！绑定失败!');
                    }
                }else{
                    $this->err->add('该手机号码已被注册！绑定失败!');
                }
            }else {
                if ($uid = K::M('member/account')->create($account)) {
                    K::M('tenders/tenders')->update($tenders_id,array('uid' =>$uid));
                    $smsdata = array(
                         'mobile' => $mobile,
                         'passwd' => $passwd
                     );
                    K::M('sms/sms')->send($mobile,'register_admin',$smsdata);
                    $this->err->add('恭喜您，注册会员成功!',200);
                }else{
                    $this->err->add('对不起，注册会员失败!');
                }
            }
        }
    }
}
