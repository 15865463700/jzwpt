<?php

if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Scenter_Company extends Ctl_Scenter
{

    protected $_allow_fields = 'city_id,area_id,title,name,slogan,contact,phone,addr,qq,mobile,lng,lat,video,banner,bank_card,clsj,zczj,djjg';
    
    public function index()
    {
        $company = $this->ucenter_company();
        $this->pagedata['youhui_count'] = K::M('company/youhui')->count(array(
            'company_id' => $company['company_id']
        ));
        $this->pagedata['youhui_sign_count'] = K::M('company/sign')->count(array(
            'company_id' => $company['company_id']
        ));
        
        $items['company_yuyue'] = K::M('company/yuyue')->items(array(
            'company_id' => $company['company_id']
        ));
        $items['company_sign'] = K::M('company/sign')->items(array(
            'company_id' => $company['company_id']
        ));
        $items['company_comment'] = K::M('company/comment')->items(array(
            'company_id' => $company['company_id']
        ));
        
        $items2['company_case'] = K::M('case/case')->items(array(
            'company_id' => $company['company_id']
        ));
        $items2['company_site'] = K::M('home/site')->items(array(
            'company_id' => $company['company_id']
        ));
        $items2['company_youhui'] = K::M('company/youhui')->items(array(
            'company_id' => $company['company_id']
        ));
        
        $this->pagedata['data'] = $this->get_data($items);
        $this->pagedata['data2'] = $this->get_data2($items2);
        
        $this->tmpl = 'scenter/company/index.html';
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
            'yuyue' => 0,
            'sign' => 0,
            'comment' => 0
        );
        foreach ($data as $k => $v) {
            foreach ($v as $kk => $vv) {
                $t = date('Ymd', $vv['dateline']);
                if ($t == $date) {
                    
                    if ($k == 'company_yuyue') {
                        $result['yuyue'] ++;
                    } elseif ($k == 'company_sign') {
                        $result['sign'] ++;
                    } elseif ($k == 'company_comment') {
                        $result['comment'] ++;
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
            'case' => 0,
            'site' => 0,
            'youhui' => 0
        );
        
        foreach ($data as $k => $v) {
            foreach ($v as $kk => $vv) {
                $t = date('Ymd', $vv['dateline']);
                if ($t == $date) {
                    
                    if ($k == 'company_case') {
                        $result['case'] ++;
                    } elseif ($k == 'company_site') {
                        $result['site'] ++;
                    } elseif ($k == 'company_youhui') {
                        $result['youhui'] ++;
                    }
                }
            }
        }
        unset($data);
        return $result;
    }

    public function refresh()
    {
        $company = $this->ucenter_company();
        $integral = K::$system->config->get('integral');
        $counts = K::M('member/flush')->flushs($this->uid);
        $is_gold = abs($integral['gold']);
        if ($counts >= $company["group"]["priv"]["day_free_count"]) {
            $this->pagedata['gold'] = $is_gold;
        }
        $this->pagedata['is_refresh'] = $counts;
        $this->pagedata['counts'] = $company["group"]["priv"]["day_free_count"];
        if ($this->GP('fromid')) {
            $isrefresh = true;
            if ($counts >= $company["group"]["priv"]["day_free_count"]) {
                if ($this->MEMBER['gold'] < $is_gold) {
                    $isrefresh = false;
                    $this->err->add('您的金币余额不足，请先充值', 215);
                }
            }
            $data['gold'] = 0;
            if ($isrefresh && $counts >= $company["group"]["priv"]["day_free_count"]) {
                $data['gold'] = $is_gold;
                if ($is_gold > 0) {
                    if (! K::M('member/gold')->update($this->uid, - $is_gold, "刷新排名")) {
                        $isrefresh = false;
                        $this->err->add('扣费失败', 201)->response();
                    }
                }
            }
            $data['uid'] = $this->uid;
            $data['from'] = 'company';
            $data['itemId'] = $company['company_id'];
            if ($isrefresh && K::M('member/flush')->create($data)) {
                K::M('company/company')->update($company['company_id'], array(
                    'flushtime' => __TIME
                ));
                $this->err->add('刷新成功');
            }
        } else {
            $this->pagedata['fromid'] = $company['company_id'];
            $this->tmpl = 'scenter/company/refresh/look.html';
        }
    }

    public function info()
    {
        $company = $this->ucenter_company();
        if ($data = $this->checksubmit('data')) {
            if (! $data = $this->check_fields($data, $this->_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                if ($_FILES['data']) {
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
                                if ($k === 'logo') {
                                    $size['photo'] = $cfg['companydecorate1'] ? $cfg['companydecorate1'] : '200X100';
                                } else 
                                    if ($k === 'thumb') {
                                        $size['photo'] = $cfg['companydecorate2'] ? $cfg['companydecorate2'] : '300X300';
                                    } else {
                                        $size['photo'] = '1000X200';
                                    }
                                $oImg->thumbs($a['file'], array(
                                    $size['photo'] => $a['file']
                                ));
                            }
                        }
                    }
                }
                if (! $company['company_id']) {
                    $data['uid'] = $this->uid;
                    if ($group = K::M('member/group')->default_group('company')) {
                        $data['group_id'] = $group['group_id'];
                    }
                    if ($company_id = K::M('company/company')->create($data)) {
                        K::M('member/member')->update($this->uid, array(
                            'group_id' => $data['group_id']
                        ));
                        if ($attr = $this->GP('attr')) {
                            K::M('company/attr')->update($company_id, $attr);
                        }
                        if ($fields = $this->GP('fields')) {
                            if ($fields = $this->check_fields($fields, array(
                                'info'
                            ))) {
                                K::M('company/fields')->update($company_id, $fields);
                            }
                        }
                        $this->err->add('设置公司资料成功');
                    }
                } else 
                    if (K::M('company/company')->update($company['company_id'], $data)) {
                        if ($attr = $this->GP('attr')) {
                            K::M('company/attr')->update($company['company_id'], $attr);
                        }
                        if ($fields = $this->GP('fields')) {
                            if ($fields = $this->check_fields($fields, array(
                                'info'
                            ))) {
                                K::M('company/fields')->update($company['company_id'], $fields);
                            }
                        }
                        $this->err->add('设置公司资料成功');
                    }
            }
        } else {
            if ($attrs = K::M('company/attr')->attrs_by_company($company['company_id'])) {
                $this->pagedata['attr_values'] = array_keys($attrs);
            }
            $this->tmpl = 'scenter/company/info.html';
        }
    }

    public function domain()
    {
        $company = $this->ucenter_company();
        $CFG = $this->system->_CFG;
        if ($CFG['domian']['company']) {
            $this->err->add('网站未开启公司个性域名功能', 211);
        } else 
            if ($domain = $this->checksubmit('domain')) {
                if (! $company['group']['priv']['allow_domain']) {
                    $this->err->add('您没有权限设置个性域名', 212);
                } else 
                    if ($company['domain']) {
                        $this->err->add('您已经设置了个性域名不可修改', 213);
                    } else 
                        if (K::M('company/company')->update_domain($company['company_id'], $domain)) {
                            $this->err->add('设置个性域名成功');
                        }
            } else {
                $this->pagedata['domain_company'] = $CFG['domain']['company'] . '.' . $CFG['site']['domain'];
                $this->tmpl = 'scenter/company/domain.html';
            }
    }

    public function skin()
    {
        $company = $this->ucenter_company();
        $allow_skin = K::M('member/group')->check_priv($company['group_id'], 'allow_skin', $group_name);
        $skins = include (__CFG::TMPL_DIR . 'default/company/config.php');
        if ($skin = $this->checksubmit('skin')) {
            if ($audit_skin < 0) {
                $this->err->add('您是【' . $audit_title . '】没有权限更换模板', 333);
            } else 
                if (! $cfg = $skins[$skin]) {
                    $this->err->add('选择的模板不存在', 211);
                } else 
                    if (K::M('company/fields')->update($company['company_id'], array(
                        'skin' => $skin
                    ), true)) {
                        $this->err->add('修改公司模板成功');
                    }
        } else {
            $pager = array(
                'allow_skin' => $allow_skin
            );
            $this->pagedata['pager'] = $pager;
            $this->pagedata['skins'] = $skins;
            $this->tmpl = 'scenter/company/skin.html';
        }
    }
}