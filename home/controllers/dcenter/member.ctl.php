<?php

if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Dcenter_Member extends Ctl_Dcenter
{

    protected $_allow_fields = 'mail,gender,from,mobile,Y,M,D,city_id,realname';

    public function index()
    {
        $this->pagedata['order_count'] = K::M('trade/order')->count_by_uid($this->uid);
        $this->pagedata['yuyue_company_count'] = K::M('company/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['yuyue_designer_count'] = K::M('designer/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['yuyue_shop_count'] = K::M('shop/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['tenders_count'] = K::M('tenders/tenders')->count(array(
            'uid' => $this->uid
        ));
        
        $items2['order_count'] = K::M('trade/order')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_company_count'] = K::M('company/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_designer_count'] = K::M('designer/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_shop_count'] = K::M('shop/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['tenders_count'] = K::M('tenders/tenders')->items(array(
            'uid' => $this->uid
        ));
        $this->pagedata['data'] = $this->get_data($items);
        $this->pagedata['data2'] = $this->get_data2($items2);
        $this->tmpl = 'dcenter/member/index.html';
    }
    
    // 按天数获取数据
    private function get_data($data, $day = 7)
    {
        $result = array();
        for ($i = 0; $i < $day; $i ++) {
            $t = date('Ymd', time() - $i * 24 * 3600);
            $t1 = date('Y-m-d', time() - $i * 24 * 3600);
            $result[$t1] = $this->order_data($data, $t);
        }
        $result = array_reverse($result);
        return $result;
    }
    // 数据比对
    private function order_data($data, $date = null)
    {
        if (! $date) {
            $date = date('Ymd', time());
        }
        $result = array(
            'company' => 0,
            'designer' => 0,
            'mechanic' => 0,
            'shop' => 0,
            'tenders' => 0
        );
        $uv = array();
        foreach ($data as $k => $v) {
            foreach ($t as $kk => $vv) {
                $t = date('Ymd', $vv['dateline']);
                if ($v == $date) {
                    
                    if ($k == 'yuyue_company_count') {
                        $result['company'] ++;
                    } elseif ($k == 'yuyue_designer_count') {
                        $result['designer'] ++;
                    } elseif ($k == 'yuyue_mechanic_count') {
                        $result['mechanic'] ++;
                    } elseif ($k == 'yuyue_shop_count') {
                        $result['shop'] ++;
                    } elseif ($k == 'tenders_count') {
                        $result['tenders'] ++;
                    }
                }
            }
        }
        unset($data);
        return $result;
    }
    
    // 按天数获取数据
    private function get_data2($data, $day = 7)
    {
        $result = array();
        for ($i = 0; $i < $day; $i ++) {
            $t = date('Ymd', time() - $i * 24 * 3600);
            $t1 = date('Y-m-d', time() - $i * 24 * 3600);
            $result[$t1] = $this->order_data2($data, $t);
        }
        $result = array_reverse($result);
        return $result;
    }
    // 数据比对
    private function order_data2($data, $date = null)
    {
        if (! $date) {
            $date = date('Ymd', time());
        }
        $result = array(
            'new' => 0,
            'unship' => 0,
            'unpay' => 0
        );
        $uv = array();
        foreach ($data['order_count'] as $k => $v) {
            $t = date('Ymd', $v['dateline']);
            if ($t == $date) {
                
                if ($v['order_status'] == 1) {
                    $result['unship'] ++;
                } else 
                    if ($v['order_status'] == 0) {
                        $result['new'] ++;
                    } else {
                        $result['unpay'] ++;
                    }
            }
        }
        unset($data);
        return $result;
    }

    public function info()
    {
        if ($account = $this->checksubmit('account')) {
            if ($this->MEMBER['verify_mobile']) {
                unset($account['mobile']); // 认证后不允许修改手机
            }
            if ($this->MEMBER['verify_mail']) {
                unset($account['mail']); // 认证后不允许修改邮箱
            }
            if ($this->MEMBER['from'] != 'member') {
                unset($account['from']);
            }
            if (! $account = $this->check_fields($account, $this->_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
                if ($this->MEMBER['verify_mobile']) {
                    unset($account['mobile']); // 认证后不允许修改手机
                }
            } else 
                if (K::M('member/member')->update($this->uid, $account)) {
                    $this->err->add('更新个人资料成功');
                }
        } else {
            $this->pagedata['from_list'] = K::M('member/member')->from_list();
            $this->tmpl = 'dcenter/member/info.html';
        }
    }

    public function passwd()
    {
        if ($account = $this->checksubmit('account')) {
            if (md5($account['old_passwd']) != $this->MEMBER['passwd']) {
                $this->err->add('原密码不正确', 211);
            } else 
                if ($account['passwd'] != $account['confirm_passwd']) {
                    $this->err->add('两次输入的密码不相同', 212);
                } else 
                    if (K::M('member/account')->check_passwd($account['passwd'])) {
                        if ($this->auth->update_passwd($account['passwd'], false)) {
                            $this->err->add('修改密码成功');
                        }
                    }
        } else {
            $this->tmpl = 'dcenter/member/passwd.html';
        }
    }

    public function passwds()
    {
        $this->tmpl = 'dcenter/member/passwds.html';
    }

    public function passwd1()
    {
        if ($this->MEMBER['mobile']) {
            $passwd = rand(1000000, 9999999);
            $smsdata = array(
                'passwd' => $passwd
            );
            if (K::M('sms/sms')->send($this->MEMBER['mobile'], 'passwd', $smsdata)) {
                K::M('member/member')->update($this->uid, array(
                    'passwd' => md5($passwd)
                ));
                $this->err->add('信息发送成功');
            } else {
                $this->err->add('发送失败');
            }
        } else {
            $this->err->add('该手机未绑定');
        }
    }

    public function passwd2()
    {
        if ($this->MEMBER['mobile']) {
            $passwd = rand(1000000, 9999999);
            $smsdata = array(
                'passwd' => $passwd
            );
            if (K::M('helper/mail')->sendmail($this->MEMBER['mail'], 'passwd', $maildata)) {
                K::M('member/member')->update($this->uid, array(
                    'passwd' => md5($passwd)
                ));
                $this->err->add('请到邮箱查看');
            } else {
                $this->err->add('邮件发送失败');
            }
        } else {
            $this->err->add('该邮箱未绑定');
        }
    }

    public function mail()
    {
        if ($account = $this->checksubmit('account')) {
            if ($this->MEMBER['verify_mail'] && (md5($account['passwd']) != $this->MEMBER['passwd'])) {
                $this->err->add('原密码不正确', 211);
            } else 
                if (K::M('member/account')->check_mail($account['newmail'])) {
                    if ($this->auth->update_mail($account['newmail'])) {
                        $this->err->add('更换邮箱成功');
                    }
                }
        } else {
            $this->tmpl = 'dcenter/member/mail.html';
        }
    }

    public function face()
    {
        $this->tmpl = 'dcenter/member/face.html';
    }

    public function upload()
    {
        if (! $data = file_get_contents("php://input")) {
            $this->err->add('图片数据上传失败', 201);
        } else 
            if (K::M('member/face')->update_face($this->uid, null, $data)) {
                $this->err->add('更新会员头像成功');
            }
        $this->err->json();
    }

    public function bindaccount()
    {
        $this->system->config->get('connect');
        $bind_list = K::M('connect/connect')->items(array(
            'uid' => $this->uid
        ), null, 1, 10);
        if ($wechatCfg = $this->system->config->get('wechat')) {
            if ($admin_weixin = K::M('weixin/weixin')->admin()) {
                if ($admin_weixin['type'] == 1) {
                    if ($member_wechat = K::M('member/weixin')->detail($this->uid)) {
                        $this->pagedata['member_wechat'] = $member_wechat;
                    } else {
                        $data = array(
                            'uid' => $this->uid,
                            'type' => 'bind'
                        );
                        if ($scene_id = K::M('weixin/authcode')->create($data)) {
                            Import::L('weixin/wechat.class.php');
                            $client = new WechatClient($admin_weixin['appid'], $admin_weixin['secret']);
                            if ($ticket = $client->getQrcodeTicket(array(
                                'scene_id' => $scene_id,
                                'expire' => 1800
                            ))) {
                                $wechat_bind_qr = $client->getQrcodeImgUrlByTicket($ticket);
                                $this->pagedata['wechat_bind_qr'] = $wechat_bind_qr;
                            }
                        }
                    }
                }
                $this->pagedata['admin_weixin'] = $admin_weixin;
            }
        }
        if ($bind_list) {
            foreach ($bind_list as $v) {
                if ($v['type'] == 1) {
                    $this->pagedata['qq_bind'] = true;
                } else 
                    if ($v['type'] == 2) {
                        $this->pagedata['wb_bind'] = true;
                    }
            }
        }
        $this->pagedata['bind_list'] = $bind_list;
        $this->tmpl = 'dcenter/member/bindaccount.html';
    }

    public function gold()
    {
        $this->system->config->get('gold');
        $this->pagedata['pay_list'] = K::M('payment/payment')->fetch_all();
        $this->tmpl = 'dcenter/member/gold.html';
    }

    public function truste($truste, $truste_id)
    {
        if ($truste < 1) {
            $this->err->add('托管金额不能小于1元', 201);
        } elseif (! $detail = K::M('truste/truste')->detail($truste_id)) {
            $this->err->add('该维修不存在', 202);
        } elseif ($detail['is_pay'] == 1) {
            $this->err->add('该维修委托金已支付', 203);
        } else {
            $this->pagedata['truste'] = $truste;
            $this->pagedata['truste_id'] = $truste_id;
            $this->pagedata['pay_list'] = K::M('payment/payment')->fetch_all();
            $this->tmpl = 'dcenter/member/truste.html';
        }
    }

    public function logs($type = null, $page = 0)
    {
        $filter = $pager = array();
        if (is_numeric($type)) {
            $page = $type;
            $type = null;
        } else 
            if ($type == 'in') {
                $filter['number'] = ">:0";
            } else 
                if ($type == 'out') {
                    $filter['number'] = "<:0";
                }
        $pager['type'] = $type;
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $this->uid;
        $filter['from'] = 'gold';
        if ($items = K::M('member/log')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('dcenter/member:logs', array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'dcenter/member/logs.html';
    }

    public function jflogs($type = null, $page = 0)
    {
        $filter = $pager = array();
        if (is_numeric($type)) {
            $page = $type;
            $type = null;
        } else 
            if ($type == 'in') {
                $filter['from'] = 1;
            } else 
                if ($type == 'out') {
                    $filter['from'] = 2;
                }
        $pager['type'] = $type;
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $this->uid;
        if ($items = K::M('fenxiao/log')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('dcenter/member:jflogs', array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['from'] = $filter['from'];
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'dcenter/member/jflogs.html';
    }

    public function coupon($page = 1)
    {
        $filter = $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array(
            'uid' => $this->uid
        );
        if ($items = K::M('shop/couponDownload')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
            $coupon_ids = array();
            foreach ($items as $k => $v) {
                $coupon_ids[$v['coupon_id']] = $v['coupon_id'];
                $shop_ids[$v['shop_id']] = $v['shop_id'];
            }
            if ($coupon_ids) {
                $this->pagedata['coupon_list'] = K::M('shop/coupon')->items_by_ids($coupon_ids);
            }
            if ($shop_ids) {
                $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_ids($shop_ids);
            }
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'dcenter/member/coupon.html';
    }

    public function group()
    {
        $this->pagedata['group_list'] = K::M('member/group')->items_by_from($this->MEMBER['from']);
        $this->tmpl = 'dcenter/member/group/group.html';
    }

    public function home($uid)
    {
        if ($this->MEMBER['from'] == 'shop') {
            $shop = $this->ucenter_shop();
            $url = $shop['shop_url'];
        } else 
            if ($this->MEMBER['from'] == 'company') {
                $company = $this->ucenter_company();
                $url = $company['company_url'];
            } else 
                if ($this->MEMBER['from'] == 'gz') {
                    $gz = $this->ucenter_gz();
                    $url = $this->mklink('gz:detail', $this->uid);
                } else 
                    if ($this->MEMBER['from'] == 'designer') {
                        $designer = $this->ucenter_designer();
                        $url = $this->mklink('blog', $this->uid);
                    } else 
                        if ($this->MEMBER['from'] == 'mechanic') {
                            $mechanic = $this->ucenter_mechanic();
                            $url = $this->mklink('mechanic:detail', $this->uid);
                        } else {
                            $this->error(404);
                        }
        header("Location:{$url}");
        exit();
    }

    public function fenxiao()
    {
        $url = $this->mklink('index/index', $this->uid);
        $this->pagedata['url'] = $url;
        $this->tmpl = 'dcenter/member/fenxiao.html';
    }

    public function topics()
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if ($SO = $this->GP('SO')) {
            $pager['SO'] = $SO;
            if ($SO['topics_id']) {
                $filter['topics_id'] = $SO['topics_id'];
            }
            if ($SO['uid']) {
                $filter['uid'] = $SO['uid'];
            }
            if ($SO['name']) {
                $filter['name'] = $SO['name'];
            }
        }
        $filter['uid'] = $this->uid;
        if ($items = K::M('topics/topics')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )), array(
                'SO' => $SO
            ));
        }
        $this->pagedata['zq'] = K::M('topics/topics')->get_zq();
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'dcenter/member/topics/index.html';
    }

    public function topicsdetail($topics_id = null)
    {
        if (! $topics_id = (int) $topics_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('topics/topics')->detail($topics_id)) {
                $this->err->add('查看的贷款不存在', 211);
            } else 
                if ($detail['uid'] != $this->uid) {
                    $this->err->add('您没有权限查看该贷款', 212);
                } else {
                    // 还款总额
                    $site = $this->system->config->get('site');
                    $topics = $site['topics'];
                    $price = $detail['money'];
                    $t = $detail['zq'];
                    $mmmm = ($price * $t * $topics) + ($price * 1000);
                    $all_price = $mmmm / 1000;
                    $all_price = round($all_price, 2);
                    
                    $month = $all_price / $t;
                    $month = round($month, 2);
                    $this->pagedata['month'] = $month;
                    $this->pagedata['all_price'] = $all_price;
                    $this->pagedata['detail'] = $detail;
                    $this->tmpl = 'dcenter/member/topics/detail.html';
                }
    }
}