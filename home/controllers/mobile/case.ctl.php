<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Case extends Ctl_Mobile
{

    public function index($page = 1)
    {
        $attr_values = K::M('data/attr')->attrs_by_from('zx:case', true);
        foreach ($attr_values as $k => $v) {
            $attr_value_ids[$k] = 0;
            foreach ($attr_vids as $vv) {
                if ($v['values'][$vv]) {
                    $attr_value_ids[$k] = $vv;
                    $attr_ids[$k] = $vv;
                    $attrs[$k] = $v['values'][$vv];
                    $attr_value_titles[$k] = $v['values'][$vv]['title'];
                }
            }
        }
        $attr_vids = $attr_ids;
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('mobile/case:index', $vids);
            foreach ($v['values'] as $kk => $vv) {
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('mobile/case:items', $vids);
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        //start
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $attr_values = K::M('data/attr')->attrs_by_from('zx:case', true);
        $uri = $this->request['uri'];
        if (preg_match('/case-items-([\d\-]+).html/i', $uri, $m)) {
            if ($m[1]) {
                if ($attr_vids = explode('-', trim($m[1], '-'))) {
                    $page = array_pop($attr_vids);
                }
            }
        }
        foreach ($attr_values as $k => $v) {
            $attr_value_ids[$k] = 0;
            foreach ($attr_vids as $vv) {
                if ($v['values'][$vv]) {
                    $attr_value_ids[$k] = $vv;
                    $attr_ids[$k] = $vv;
                    $attrs[$k] = $v['values'][$vv];
                    $attr_value_titles[$k] = $v['values'][$vv]['title'];
                }
            }
        }
        $attr_vids = $attr_ids;
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('mobile/case:items', $vids);
            foreach ($v['values'] as $kk => $vv) {
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('mobile/case:items', $vids);
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['city_id'] = array(
            $this->request['city_id'],
            '0'
        );
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if ($attr_ids) {
            $filter['attrs'] = $attr_ids;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/case:index', array_merge((array) $attr_ids, array(
                'page' => '{page}'
            )), $params));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['attr_ids'] = $attr_ids;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['attrs'] = $attrs;
        $this->pagedata['pager'] = $pager;
        $seo = array(
            'attr' => '',
            'page' => ''
        );
        if ($attr_value_titles) {
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if ($page > 1) {
            $seo['page'] = $page;
        }
        //end
        
        $this->pagedata['attr_values'] = $attr_values;
        $this->tmpl = 'mobile/case/index.html';
    }

    public function items($page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $attr_values = K::M('data/attr')->attrs_by_from('zx:case', true);
        $uri = $this->request['uri'];
        if (preg_match('/case-items-([\d\-]+).html/i', $uri, $m)) {
            if ($m[1]) {
                if ($attr_vids = explode('-', trim($m[1], '-'))) {
                    $page = array_pop($attr_vids);
                }
            }
        }
        foreach ($attr_values as $k => $v) {
            $attr_value_ids[$k] = 0;
            foreach ($attr_vids as $vv) {
                if ($v['values'][$vv]) {
                    $attr_value_ids[$k] = $vv;
                    $attr_ids[$k] = $vv;
                    $attrs[$k] = $v['values'][$vv];
                    $attr_value_titles[$k] = $v['values'][$vv]['title'];
                }
            }
        }
        $attr_vids = $attr_ids;
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('mobile/case:items', $vids);
            foreach ($v['values'] as $kk => $vv) {
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('mobile/case:items', $vids);
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['city_id'] = array(
            $this->request['city_id'],
            '0'
        );
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if ($attr_ids) {
            $filter['attrs'] = $attr_ids;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/case:items', array_merge((array) $attr_ids, array(
                'page' => '{page}'
            )), $params));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['attr_ids'] = $attr_ids;
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['attrs'] = $attrs;
        $this->pagedata['pager'] = $pager;
        $seo = array(
            'attr' => '',
            'page' => ''
        );
        if ($attr_value_titles) {
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if ($page > 1) {
            $seo['page'] = $page;
        }
        $this->seo->init('case', $seo);
        $this->tmpl = 'mobile/case/items.html';
    }

    public function detail($case_id)
    {
        if (! $case_id = (int) $case_id) {
            $this->error(404);
        } else 
            if (! $case = K::M('case/case')->detail($case_id)) {
                $this->error(404);
            } elseif (! $case['audit']) {
                $this->err->add("内容审核中，暂不可访问", 211)->response();
            }
        $this->pagedata['photos'] = K::M('case/photo')->items_by_case($case_id, 1, 50);
        $this->pagedata['case'] = $case;
        $pager['backurl'] = $this->mklink('mobile/case');
        $this->pagedata['pager'] = $pager;
        $this->seo->init('case_detail', array(
            'title' => $case['title'],
            'home_name' => $detail['home_name'],
            'seo_title' => $case['seo_title'],
            'seo_keywords' => $case['seo_keywords'],
            'seo_description' => $case['seo_description']
        ));
        $this->tmpl = 'mobile/case/detail.html';
    }
    public function vr($sjfg = 0, $jzmj = 0, $page = 1){

        $sjfg=$_REQUEST["a"]?$_REQUEST["a"]:$sjfg;
        $jzmj=isset($_REQUEST["b"])?$_REQUEST["b"]:$jzmj;
        $page=isset($_REQUEST["c"])?$_REQUEST["c"]:$page;
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $area_id = $group_id = $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('vrqj:vrqj', true);

        foreach ($attr_values as $k => $v) {
            $v['checked'] = false;
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('vrqj:index', array(
                $sjfg,
                $jzmj,
                1
            ));
            $v['link']=preg_replace("/-index/","",$v['link']);
            $v['link']=preg_replace("/\.html/","/",$v['link']);
            if ($v["attr_id"] == 17) {
                if ($sjfg == 0) {
                    $v["checked"] = true;
                }
                $v['link'] = $this->mklink('vrqj:index', array(
                    0,
                    $jzmj,
                    1
                ));
            }
            elseif ($v["attr_id"] == 18) {
                if ($jzmj == 0) {
                    $v["checked"] = true;
                }
                $v['link'] = $this->mklink('vrqj:index', array(
                    $sjfg,
                    0,
                    1
                ));
            }
            foreach ($v['values'] as $kk => $vv) {
                $vv['checked'] = false;
                if (in_array($kk, $attr_ids)) {
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('vrqj:index', array(
                    implode('-', $attr_value_ids),
                    1
                ));
                if ($v["attr_id"] == 17) {
                    if ($sjfg == $vv["attr_value_id"]) {
                        $vv['checked'] = true;
                    }
                    $vv['link'] = $this->mklink('vrqj:index', array(
                        $vv["attr_value_id"],
                        $jzmj,
                        1
                    ));
                } elseif ($v["attr_id"] == 18) {
                    if ($jzmj == $vv["attr_value_id"]) {
                        $vv['checked'] = true;
                    }
                    $vv['link'] = $this->mklink('vrqj:index', array(
                        $sjfg,
                        $vv["attr_value_id"],
                        1
                    ));
                }
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        $this->pagedata['attr_values'] = $attr_values;

        // $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        if ($sjfg > 0 || $jzmj > 0) {
            $filter['attrs'] = array(
                $sjfg,
                $jzmj
            );
        }
        if ($kw = $this->GP('kw')) {
           $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['vrqj_title'] = "LIKE:%{$kw}%";
        }
        if ($items = K::M('vrqj/vrqj')->items($filter, "vrqj_id", $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/case:vr', array(
                $sjfg,
                $jzmj,
                '{page}'
            ), $params));
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
        }
        $this->tmpl = 'mobile/case/vr.html';
    }
//    public function yuyue($uid){
//
//        $data["contact"] = $this->GP("user_chenghu");
//        $mobile=$data["mobile"] = $this->GP("user_phone");
//        $data["verifycode"]=$this->GP("verifycode");
//        $data['uid']=$this->GP("designer_uid");
//        echo  $data['uid'];die;
//        $session = K::M('system/session')->start();
//        $verif=$session->get('price_' . $mobile);
//        if($data["contact"]==""){
//            $this->err->add("请填写您的姓名",201);
//        }else if($data["mobile"]==""){
//            $this->err->add("请填写您的手机号码",201);
//        }else if($data['mobile']==""){
//            $this->err->add("请填写您的手机号码",201);
//        }else if(!K::M('verify/check')->phone($data['mobile'])){
//            $this->err->add("您的手机号码不正确",201);
//        }else if($data["verifycode"]==""){
//            $this->err->add("验证码不能为空",201);
//        }else if($data["verifycode"]!=$verif){
//            $this->err->add("验证码不正确",201);
//        }else{
//            $data['designer_id'] = $uid;
//            echo $data['designer_id'];die;
//            $data['company_id'] = $detail['company_id'];
//            $data['uid'] = (int) $this->uid;
//            $data['content'] = "预约设计师:" . $detail['uname'];
//        }
//    }
    public function yuyue($uid)
    {
        if (! ($uid = (int) $uid) && ! ($uid = (int) $this->GP('uid'))) {
            //$this->err->add('没有您要的数据', 211);
            die(json_encode(array(
                "message" => "没有您要的数据!"
            )));
        } else
            if (! $detail = K::M('designer/designer')->detail($uid)) {
               // $this->err->add('没有您要的数据', 212);
                die(json_encode(array(
                    "message" => "没有您要的数据!"
                )));
            } else
                if (empty($detail['audit'])) {
                    $this->err->add("内容审核中，暂不可访问", 211)->response();
                } else {
                    $flag = false;
                    if ($this->GP('vrqj')) {
                        $flag = true;
                        $data["contact"] = $this->GP("user_chenghu");
                        $data["mobile"] = $this->GP("user_phone");
                       //$data["province_id"] = $this->GP("province_id");
                        //$data["city_id"] = $this->GP("city_id");
                        //$data["area_id"] = $this->GP("area_id");
                    }
                    if ($this->checksubmit('data') || $flag) {
                        if (! $flag && (! $data = $this->GP('data'))) {
                           // $this->err->add('非法的数据提交', 201);
                            die(json_encode(array(
                                "message" => "非法的数据提交!"
                            )));
                        } else {
                            if ($this->GP('vrqj')) {
                                $data["contact"] = $this->GP("chenghu");
                                $data["mobile"] = $this->GP("phone");
                            }
                            $verifycode_success = true;
                            $access = $this->system->config->get('access');
                            if ($access['verifycode']['yuyue']) {
                                $verifycode = $this->GP('verifycode');
                                $session = K::M('system/session')->start();
                                if (! empty($verifycode) && ($verifycode == $_SESSION["price_{$data['mobile']}"])) {
                                    $verifycode_success = true;
                                } else {
                                    if (! $verifycode) {
                                        $verifycode_success = false;
                                       // $this->err->add('验证码不正确!', 212);
                                        die(json_encode(array(
                                            "message" => "验证码不正确!"
                                        )));
                                    } else
                                        if (! K::M('magic/verify')->check($verifycode)) {
                                            $verifycode_success = false;
                                           // $this->err->add('验证码不正确', 212);
                                            die(json_encode(array(
                                                "message" => "验证码不正确!"
                                            )));
                                        }
                                }
                            }
                            if ($verifycode_success) {
                                $data['designer_id'] = $uid;
                                $data['company_id'] = $detail['company_id'];
                                $data['uid'] = (int) $this->uid;
                                $data['content'] = "预约设计师:" . $detail['uname'];
                                if (empty($data['city_id'])) {
                                    $data['city_id'] = $this->request['city_id'];
                                }
                                if ($yuyue_id = K::M('designer/yuyue')->create($data)) {
                                    K::M('designer/yuyue')->yuyue_count($uid);
                                    $smsdata = $maildata = array(
                                        'contact' => $data['contact'] ? $data['contact'] : '业主',
                                        'mobile' => $data['mobile'],
                                        'designer' => $detail['realname']
                                    );
                                    K::M('sms/sms')->send($data['mobile'], 'designer_yuyue', $smsdata);
                                    if ($company_id = $detail['company_id']) {
                                        if ($company = K::M('company/company')->detail($company_id)) {
                                            $company['member'] = $detail;
                                            K::M('sms/sms')->company('designer_tongzhi', $smsdata);
                                            K::M('helper/mail')->sendcompany($company, 'designer_yuyue', $maildata);
                                        }
                                    } else {
                                        if ($detail['verify_mobile'] && K::M('verify/check')->mobile($detail['mobile'])) {
                                            K::M('sms/sms')->send($detail['mobile'], 'designer_tongzhi', $smsdata);
                                        }
                                        K::M('helper/mail')->sendmail($detail['mail'], 'designer_yuyue', $maildata);
                                    }
                                    if ($this->GP('vrqj')) {
                                        die(json_encode(array(
                                            "message" => "预约设计师成功!"
                                        )));
                                    }
                                    $this->err->add('预约设计师成功');
                                }
                            }
                        }
                    } else {
                        $access = $this->system->config->get('access');
                        $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
                        $this->pagedata['designer_id'] = $uid;
                        $this->pagedata['detail'] = $detail;
                        $this->tmpl = 'designer/yuyue.html';
                    }
                }
    }
}