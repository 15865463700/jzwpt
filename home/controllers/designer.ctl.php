<?php

class Ctl_Designer extends Ctl{
    public static $ctl_old="designer";
    public static $ctl_new="sjs";

    public function index($page = 1)
    {
        $this->items($page);
    }

    public function items($page = 1){
        if(strpos($this->request['uri'],"esigner")){
            $uri=str_replace(Ctl_Designer::$ctl_old, Ctl_Designer::$ctl_new, $this->request['uri']);
            header("Location:{$this->request['city']['siteurl']}/{$uri}");die;
        }
        $this->request['uri']=  str_replace(Ctl_Designer::$ctl_new, Ctl_Designer::$ctl_old, $this->request['uri']);
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $area_id = $group_id = $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:designer', true);
        $uri = $this->request['uri'];
        if (preg_match('/items-([\d\-]+)?(\d+)(.html)?/i', $uri, $m)||preg_match('/designer-([\d\-]+)?(\d+)(.html)?/i', $uri, $m)) {
            $page = (int) $m[2];
            if ($m[1]) {
                $attr_vids = explode('-', trim($m[1], '-'));
                $area_id = $attr_vids ? array_shift($attr_vids) : 0;
                $group_id = $attr_vids ? array_shift($attr_vids) : 0;
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        $_seo_repeat = "";
        foreach ($attr_values as $k => $v) {
            if ($v['filter']) {
                $attr_value_ids[$k] = 0;
                foreach ($attr_vids as $vv) {
                    if ($v['values'][$vv]) {
                        $attr_value_ids[$k] = $vv;
                        $attr_ids[$k] = $vv;
                        $attrs[$k] = $v['values'][$vv];
                        $attr_value_titles[$k] = $v['values'][$vv]['title'];
                        $_seo_repeat.=strpos($v['values'][$vv]['title'],"设计师")>-1?",".$this->request['city']['city_name'].$v['values'][$vv]['title']:",".$this->request['city']['city_name'].$v['values'][$vv]['title']."设计师";
                    }
                }
            }
        }
        $attr_vids = $attr_ids;
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('designer:items', array(
                $area_id,
                $group_id,
                implode('-', $vids)
            ));
            $v["link"]=preg_replace("/-items/","",$v['link']);
            $v["link"]=preg_replace("/designer-0-0-0-0-0-1\./","designer.",$v["link"]);
            $v["link"]=preg_replace("/\.html/","/",$v["link"]);
            $v["link"]=str_replace(Ctl_Designer::$ctl_old,Ctl_Designer::$ctl_new,$v["link"]);
            $v['checked'] = true;
            foreach ($v['values'] as $kk => $vv) {
                $vv['checked'] = false;
                if (in_array($kk, $attr_ids)) {
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('designer:items', array(
                    $area_id,
                    $group_id,
                    implode('-', $vids)
                ));
                $vv["link"]=preg_replace("/-items/","",$vv['link']);
                $vv["link"]=preg_replace("/designer-0-0-0-0-0-1\./","designer.",$vv["link"]);
                $vv["link"]=preg_replace("/\.html/","/",$vv["link"]);
                $vv["link"]=str_replace(Ctl_Designer::$ctl_old,Ctl_Designer::$ctl_new,$vv["link"]);
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        if ($group_list = K::M('member/group')->items_by_from('designer')) {
            $group_all_link = $this->mklink('designer:items', array(
                $area_id,
                0,
                implode('-', $attr_value_ids),
                $order,
                1
            ));
            foreach ($group_list as $k => $v) {
                $v['link'] = $this->mklink('designer:items', array(
                    $area_id,
                    $k,
                    implode('-', $attr_value_ids),
                    $order,
                    1
                ));
                $group_list[$k] = $v;
            }
        }
        $area_list = $this->request['area_list'];
        $area_all_link = $this->mklink('designer:items', array(
            0,
            $group_id,
            implode('-', $attr_value_ids),
            $order,
            1
        ));
        $area_all_link=preg_replace("/-items/","",$area_all_link);
        $area_all_link=preg_replace("/designer-0-0-0-0-0-1\./","designer.",$area_all_link);
        $area_all_link=preg_replace("/\.html/","/",$area_all_link);
        $area_all_link=str_replace(Ctl_Designer::$ctl_old,Ctl_Designer::$ctl_new,$area_all_link);
        foreach ($area_list as $k => $v) {
            $v['link'] = $this->mklink('designer:items', array(
                $k,
                $group_id,
                implode('-', $attr_value_ids),
                $order,
                1
            ));
            $v['link']=preg_replace("/-items/","",$v['link']);
            $v['link']=preg_replace("/\.html/","/",$v['link']);
            $v['link']=str_replace(Ctl_Designer::$ctl_old,Ctl_Designer::$ctl_new,$v['link']);
            $area_list[$k] = $v;
        }
        $order_list = array(
            0 => array(
                'title' => '默认'
            ),
            1 => array(
                'title' => '签单'
            ),
            2 => array(
                'title' => '口碑'
            )
        );
        $order_list[0]['link'] = $this->mklink('designer:items', array(
            $area_id,
            $group_id,
            implode('-', $attr_value_ids),
            0,
            1
        ));
        $order_list[1]['link'] = $this->mklink('designer:items', array(
            $area_id,
            $group_id,
            implode('-', $attr_value_ids),
            1,
            1
        ));
        $order_list[2]['link'] = $this->mklink('designer:items', array(
            $area_id,
            $group_id,
            implode('-', $attr_value_ids),
            2,
            1
        ));
        
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['area_id'] = $area_id;
        $pager['group_id'] = $group_id;
        $pager['order'] = $order;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['city_id'] = $this->request['city_id'];
        if ($area_id) {
            $filter['area_id'] = $area_id;
        }
        if ($group_id) {
            $filter['group_id'] = $group_id;
        }
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if ($attr_ids) {
            $filter['attrs'] = $attr_ids;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['name'] = "LIKE:%{$kw}%";
        }
        if ($order == 1) {
            $orderby = array(
                'tenders_num' => 'DESC'
            );
        } else 
            if ($order == 2) {
                $orderby = array(
                    'score' => 'DESC'
                );
            } else {
                $orderby = NULL;
            }
        if ($items = K::M('designer/designer')->items_by_attr($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('designer:items', array(
                $area_id,
                $group_id,
                implode('-', $attr_value_ids),
                $order,
                '{page}'
            ), $params));
            $pager['pagebar']=preg_replace("/-items/","",$pager['pagebar']);
            $pager['pagebar']=preg_replace("/designer-0-0-0-0-0-1\./","designer.",$pager['pagebar']);
            $pager['pagebar']=preg_replace("/\.html/","/",$pager['pagebar']);
            $pager['pagebar']=str_replace(Ctl_Designer::$ctl_old,Ctl_Designer::$ctl_new,$pager['pagebar']);
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['area_list'] = $area_list;
        $this->pagedata['group_list'] = $group_list;
        foreach($order_list as $k=>$v){
            $order_list[$k]["link"]=preg_replace("/-items/","",$v['link']);
            $order_list[$k]["link"]=preg_replace("/designer-0-0-0-0-0-1\./","designer.",$order_list[$k]["link"]);
            $order_list[$k]["link"]=preg_replace("/\.html/","/",$order_list[$k]["link"]);
            $order_list[$k]["link"]=str_replace(Ctl_Designer::$ctl_old,Ctl_Designer::$ctl_new,$order_list[$k]["link"]);
        }
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['area_all_link'] = $area_all_link;
        $this->pagedata['group_all_link'] = $group_all_link;
        $this->pagedata['pager'] = $pager;
        $seo = array(
            'area_name' => '',
            'attr' => '',
            'page' => '',
            'repeat' => $_seo_repeat,
        );
        if ($area_id) {
            $seo['area_name'] = $area_list[$area_id]['area_name'];
        }
        if ($attr_value_titles) {
            $seo['attr'] = implode('', $attr_value_titles);
        }
        if ($page > 1) {
            $seo['page'] = $page;
        }
		if(is_main()){
			empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('designer', $seo):$this->seo->init('designer_attr', $seo);
		}else{
            empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('fenzhan_designer', $seo):$this->seo->init('fenzhan_designer_attr', $seo);
		}
        $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/designer/";
        $this->tmpl = 'designer/items.html';
    }

    public function attention($uid)
    {
        $detail = $this->check_designer($uid);
        if (! $detail['audit']) {
            $this->err->add('您关注的内容还在审核中，暂不可关注', 213);
        } else {
            K::M('designer/designer')->update($uid, array(
                'attention_num' => $detail['attention_num'] + 1
            ));
            $this->err->add('关注成功！');
        }
    }

    public function yuyue($uid)
    {
        if (! ($uid = (int) $uid) && ! ($uid = (int) $this->GP('uid'))) {
            $this->err->add('没有您要的数据', 211);
        } else 
            if (! $detail = K::M('designer/designer')->detail($uid)) {
                $this->err->add('没有您要的数据', 212);
            } else 
                if (empty($detail['audit'])) {
                    $this->err->add("内容审核中，暂不可访问", 211)->response();
                } else {
                    $flag = false;
                    if ($this->GP('vrqj')) {
                        $flag = true;
                        $data["contact"] = $this->GP("user_chenghu");
                        $data["mobile"] = $this->GP("user_phone");
                        $data["province_id"] = $this->GP("province_id");
                        $data["city_id"] = $this->GP("city_id");
                        $data["area_id"] = $this->GP("area_id");
                    }
                    if ($this->checksubmit('data') || $flag) {
                        if (! $flag && (! $data = $this->GP('data'))) {
                            $this->err->add('非法的数据提交', 201);
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
                                        $this->err->add('验证码不正确!', 212);
                                    } else 
                                        if (! K::M('magic/verify')->check($verifycode)) {
                                            $verifycode_success = false;
                                            $this->err->add('验证码不正确', 212);
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

    protected function check_designer($uid)
    {
        if (! ($uid = (int) $uid) && ! ($uid = $this->GP('uid'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('designer/designer')->detail($uid)) {
                $this->error(404);
            }
        $this->pagedata['detail'] = $detail;
        return $detail;
    }
}