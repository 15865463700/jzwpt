<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Scenter_Shop extends Ctl_Scenter
{

    protected $_allow_fields = 'cat_id,city_id,area_id,title,name,logo,contact,phone,lng,lat,banner,fox,mail,qq,hours,addr,jiaotong,bulletin,lng,lat,info,psaz,dgxz,seo_title,seo_keywords,seo_description';

    public function index()
    {
        $shop = $this->ucenter_shop();
        $this->pagedata['order_count'] = K::M('trade/order')->count_by_shop($shop['shop_id']);
        $this->pagedata['yueyue_count'] = K::M('shop/yuyue')->count(array(
            'shop_id' => $shop['shop_id']
        ));
        $this->pagedata['coupons'] = K::M('shop/coupon')->count(array(
            'shop_id' => $shop['shop_id']
        ));
        $this->pagedata['coupon_download_count'] = K::M('shop/couponDownload')->count(array(
            'shop_id' => $shop['shop_id']
        ));
        
        $items['shop_yuyue'] = K::M('shop/yuyue')->items(array(
            'shop_id' => $shop['shop_id']
        ));
        $items['shop_download'] = K::M('shop/couponDownload')->items(array(
            'shop_id' => $shop['shop_id']
        ));
        
        $items['shop_comment'] = K::M('shop/comment')->items(array(
            'shop_id' => $shop['shop_id']
        ));
        
        $items2['order_count'] = K::M('trade/order')->items(array(
            'uid' => $this->uid
        ));
        
        $this->pagedata['data'] = $this->get_data($items);
        $this->pagedata['data2'] = $this->get_data2($items2);
        $this->tmpl = 'scenter/shop/index.html';
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
            'download' => 0,
            'comment' => 0
        );
        $uv = array();
        foreach ($data as $k => $v) {
            foreach ($v as $kk => $vv) {
                $t = date('Ymd', $vv['dateline']);
                if ($t == $date) {
                    
                    if ($k == 'shop_yuyue') {
                        $result['yuyue'] ++;
                    } elseif ($k == 'shop_download') {
                        $result['download'] ++;
                    } elseif ($k == 'shop_comment') {
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
            'new' => 0,
            'unship' => 0,
            'unpay' => 0,
            'finish' => 0
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
                    } else 
                        if ($v['order_status'] == 2) {
                            $result['finish'] ++;
                        } else {
                            $result['unpay'] ++;
                        }
            }
        }
        unset($data);
        return $result;
    }

    public function base()
    {
        $shop = $this->ucenter_shop();
        if ($this->checksubmit()) {
            $data = array();
            $cfg = K::$system->config->get('attach');
            if ($attach = $_FILES['shop_thumb']) {
                if (UPLOAD_ERR_OK == $attach['error']) {
                    if ($a = K::M('magic/upload')->upload($attach, 'shop', $shop['thumb'])) {
                        $thumb = K::M('content/html')->encode($a['photo']);
                        $size = $cfg['shop']['thumb'] ? $cfg['shop']['thumb'] : '200x200';
                        K::M('image/gd')->thumbs($a['file'], array(
                            $size => $a['file']
                        ), fasle);
                    }
                }
            }
            if ($attach = $_FILES['shop_logo']) {
                if (UPLOAD_ERR_OK == $attach['error']) {
                    if ($a = K::M('magic/upload')->upload($attach, 'shop', $shop['logo'])) {
                        $logo = K::M('content/html')->encode($a['photo']);
                        $size = $cfg['shop']['logo'] ? $cfg['shop']['logo'] : '200x100';
                        K::M('image/gd')->thumbs($a['file'], array(
                            $size => $a['file']
                        ), fasle);
                    }
                }
            }
            if ($attach = $_FILES['shop_banner']) {
                if (UPLOAD_ERR_OK == $attach['error']) {
                    if ($a = K::M('magic/upload')->upload($attach, 'shop', $shop['banner'])) {
                        $banner = K::M('content/html')->encode($a['photo']);
                    }
                }
            }
            if ($thumb || $logo) {
                $a = array();
                if ($logo) {
                    $a = array(
                        'logo' => $logo
                    );
                }
                if ($thumb) {
                    $a['thumb'] = $thumb;
                }
                K::M('shop/shop')->update($shop['shop_id'], $a, true);
            }
            if ($banner) {
                K::M('shop/fields')->update($shop['shop_id'], array(
                    'banner' => $banner
                ), true);
            }
            $this->err->add('修改商铺资料成功');
        } else {
            $this->tmpl = 'scenter/shop/base.html';
        }
    }

    public function info()
    {
        $shop = K::M('shop/shop')->shop_by_uid($this->uid);
        if ($data = $this->checksubmit('data')) {
            if ($data = $this->check_fields($data, $this->_allow_fields)) {
                if ($fields = $this->GP('fields')) {
                    $fields = $this->check_fields($fields, $this->_allow_fields);
                }
                if (! empty($shop['name'])) {
                    unset($data['city_id']);
                    if (K::M('shop/shop')->update($shop['shop_id'], $data)) {
                        if ($fields && K::M('shop/fields')->update($shop['shop_id'], $fields)) {
                            $this->err->add('操作成功');
                        }
                    }
                } else {
                    if (empty($data['city_id'])) {
                        $data['city_id'] = $this->MEMBER['city_id'];
                    }
                    if ($group = K::M('member/group')->default_group('shop')) {
                        $data['group_id'] = $group['group_id'];
                    } else {
                        $data['group_id'] = 0;
                    }
                    $data['uid'] = $this->uid;
                    if ($shop_id = K::M('shop/shop')->create($data)) {
                        K::M('member/member')->update($data['uid'], array(
                            'group_id' => $data['group_id']
                        ));
                        K::M('shop/fields')->update($shop_id, $fields);
                        $this->err->add('设置店铺资料成功');
                    }
                }
            }
        } else {
            $this->pagedata['shop'] = $shop;
            $this->tmpl = 'scenter/shop/info.html';
        }
    }

    public function domain()
    {
        $shop = $this->ucenter_shop();
        $CFG = $this->system->_CFG;
        if (! $CFG['domain']['shop']) {
            $this->err->add('网站未开启商铺个性域名功能', 211);
        } else 
            if ($domain = $this->checksubmit('domain')) {
                if ($shop['group']['priv']['allow_domain'] < 0) {
                    $this->err->add('您没有权限设置个性域名', 212);
                } else 
                    if ($shop['domain']) {
                        $this->err->add('您已经设置了个性域名不可修改', 213);
                    } else {
                        $ret = true;
                        if ($CFG['domain']['company'] == $CFG['domain']['shop']) { // 当与公司公司设置相同时判断公司是否占用了
                            if ($company = K::M('company/company')->company_by_domain($domain)) {
                                $this->err->add('您选域名太好已经被人抢注了', 213);
                                $ret = false;
                            }
                        }
                        if ($ret) {
                            if (K::M('shop/shop')->update_domain($shop['shop_id'], $domain)) {
                                $this->err->add('设置个性域名成功');
                            }
                        }
                    }
            } else {
                $this->tmpl = 'scenter/shop/domain.html';
            }
    }

    public function skin()
    {
        $shop = $this->ucenter_shop();
        $allow_skin = K::M('member/group')->check_priv($shop['group_id'], 'allow_skin');
        $skins = include (__CFG::TMPL_DIR . 'default/shop/config.php');
        if ($skin = $this->checksubmit('skin')) {
            if ($allow_skin < 0) {
                $this->err->add('您是【' . $shop['group_name'] . '】没有权限更换模板', 333);
            } else 
                if (! $cfg = $skins[$skin]) {
                    $this->err->add('选择的模板不存在', 211);
                } else 
                    if (K::M('shop/fields')->update($shop['shop_id'], array(
                        'skin' => $skin
                    ), true)) {
                        $this->err->add('修改商铺模板成功');
                    }
        } else {
            $this->pagedata['pager'] = $pager;
            $this->pagedata['skins'] = $skins;
            $this->tmpl = 'scenter/shop/skin.html';
        }
    }

    public function seo()
    {
        $shop = $this->ucenter_shop();
        if ($data = $this->checksubmit('data')) {
            if (K::M('member/group')->check_priv($shop['group_id'], 'allow_seo') < 0) {
                $this->err->add('您是【' . $shop['group_name'] . '】不能设置SEO', 333);
            } else 
                if ($data = $this->check_fields($data, $this->_allow_fields)) {
                    if (K::M('shop/fields')->update($shop['shop_id'], $data)) {
                        $this->err->add('修改SEO内容成功');
                    }
                }
        } else {
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'scenter/shop/seo.html';
        }
    }

    public function gmsm()
    {
        $shop = $this->ucenter_shop();
        if ($data = $this->checksubmit('data')) {
            if ($data = $this->check_fields($data, $this->_allow_fields)) {
                K::M('shop/fields')->update($shop['shop_id'], $data);
                $this->err->add('修改商铺资料成功');
            } else {
                $this->err->add('非法的数据提交', 211);
            }
        } else {
            $this->tmpl = 'scenter/shop/gmsm.html';
        }
    }

    public function refresh()
    {
        $shop = $this->ucenter_shop();
        $integral = K::$system->config->get('integral');
        $counts = K::M('member/flush')->flushs($this->uid);
        $is_gold = abs($integral['gold']);
        if ($counts >= $shop["group"]["priv"]["day_free_count"]) {
            $this->pagedata['gold'] = $is_gold;
        }
        $this->pagedata['is_refresh'] = $counts;
        $this->pagedata['counts'] = $shop["group"]["priv"]["day_free_count"];
        if ($this->GP('fromid')) {
            $isrefresh = true;
            if ($counts >= $shop["group"]["priv"]["day_free_count"]) {
                if ($this->MEMBER['gold'] < $is_gold) {
                    $isrefresh = false;
                    $this->err->add('您的金币余额不足，请先充值', 215);
                }
            }
            $data['gold'] = '0';
            if ($isrefresh && $counts >= $shop["group"]["priv"]["day_free_count"]) {
                $data['gold'] = $is_gold;
                if ($is_gold > 0) {
                    if (! K::M('member/gold')->update($this->uid, - $is_gold, "刷新商铺")) {
                        $isrefresh = false;
                        $this->err->add('扣费失败', 201)->response();
                    }
                }
            }
            $data['uid'] = $this->uid;
            $data['from'] = 'shop';
            $data['itemId'] = $shop['shop_id'];
            if ($isrefresh && K::M('member/flush')->create($data)) {
                K::M('shop/shop')->update($shop['shop_id'], array(
                    'flushtime' => __TIME
                ));
                $this->err->add('刷新成功');
            }
        } else {
            $this->pagedata['fromid'] = $shop['shop_id'];
            $this->tmpl = 'scenter/shop/refresh/look.html';
        }
    }

    public function catechildren($pid = null)
    {
        $pid = (int) $pid;
        $cats = array();
        if ($childrens = K::M('shop/cate')->childrens($pid)) {
            foreach ($childrens as $k => $v) {
                $cats[] = array(
                    'cat_id' => $v['cat_id'],
                    'parent_id' => $v['parent_id'],
                    'title' => $v['title']
                );
            }
        }
        $this->err->set_data('cats', $cats);
        $this->err->json();
    }
}