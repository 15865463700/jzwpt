<?php

class Ctl_Zzyi extends Ctl
{

    public function index($page = 1)
    {
        $this->items($page);
    }

    public function items($page = 1)
    {
        $_REQUEST["a"]=="album"?$this->album($page):$this->items_real($page);
    }

    public function items_real($page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:zzyi', true);
        $uri = $this->request['uri'];
        if (preg_match('/items-([\d\-]+)?(-(\d+))(.html)?/i', $uri, $m)||preg_match('/zzyi-([\d\-]+)?(-(\d+))(.html)?/i', $uri, $m)) {
            $page = (int) $m[3];
            if ($m[1]) {
                $attr_vids = explode('-', trim($m[1], '-'));
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        foreach ($attr_values as $k => $v) {
            if ($v['filter']) {
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
        }
        $attr_vids = $attr_ids;
        $app_seo="";
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('zzyi:items', array(
                implode('-', $vids)
            ));
            $v['link'] = preg_replace("/zzyi-items/","zzyi",$v['link']);
            $v['link'] = preg_replace("/-0-0-0-0-1\./",".",$v['link']);
            $v['link'] = preg_replace("/\.html/","/",$v['link']);
            $v['checked'] = true;
            foreach ($v['values'] as $kk => $vv) {
                $vv['checked'] = false;
                if (in_array($kk, $attr_ids)) {
                    $v['checked'] = false;
                    $vv['checked'] = true;
                    $app_seo.=!empty($app_seo)?"-{$vv['title']}":$vv['title'];
                }
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('zzyi:items', array(
                    implode('-', $vids)
                ));
                $vv['link'] = preg_replace("/zzyi-items/","zzyi",$vv['link']);
                $vv['link'] = preg_replace("/-0-0-0-0-1\./",".",$vv['link']);
                $vv['link'] = preg_replace("/\.html/","/",$vv['link']);
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        $order_list = array(
            0 => array(
                'title' => '今日推荐'
            ),
            1 => array(
                'title' => '最受欢迎 '
            ),
            2 => array(
                'title' => '人气排行'
            )
        );
        $order_list[0]['link'] = $this->mklink('zzyi:items', array(
            implode('-', $attr_value_ids),
            0,
            1
        ));
        $order_list[1]['link'] = $this->mklink('zzyi:items', array(
            implode('-', $attr_value_ids),
            1,
            1
        ));
        $order_list[2]['link'] = $this->mklink('zzyi:items', array(
            implode('-', $attr_value_ids),
            2,
            1
        ));
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['city_id'] = array(
            $this->request['city_id'],
            0
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
        if ($order == 2) {
            $orderby = array(
                'likes' => 'DESC'
            );
        } else 
            if ($order == 1) {
                $orderby = array(
                    'views' => 'DESC'
                );
            } else {
                $orderby = NULL;
            }
        if ($items = K::M('zzyi/zzyi')->items($filter, $orderby, $page, $limit, $count)) {
            $lastphotos = array();
            foreach ($items as $k => $val) {
                if ($val['lastphotos']) {
                    $lastphotos[] = $val['lastphotos'];
                    $items[$k]['lastphotos'] = explode(',', $val['lastphotos']);
                }
            }
            if (! empty($lastphotos)) {
                $lastphotos = join(',', $lastphotos);
                $this->pagedata['photos'] = K::M('zzyi/photo')->items_by_ids($lastphotos);
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zzyi:items', array(
                implode('-', $attr_value_ids),
                $order,
                '{page}'
            ), $params));
            $pager['pagebar'] = preg_replace("/zzyi-items/","zzyi",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/-0-0-0-0-1\./",".",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/\.html/","/",$pager['pagebar']);
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['attr_values'] = $attr_values;
        foreach($order_list as $k=>$v){
            $order_list[$k]['link'] = preg_replace("/zzyi-items/","zzyi",$v['link']);
            $order_list[$k]['link'] = preg_replace("/-0-0-0-0-1\./",".",$order_list[$k]['link']);
            $order_list[$k]['link'] = preg_replace("/\.html/","/",$order_list[$k]['link']);
        }
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['pager'] = $pager;
        $seo = array(
            'attr' => '',
            'page' => ''
        );
        if ($attr_value_titles) {
            $seo['attr'] = implode('', $attr_value_titles);
        }
        if ($page > 1) {
            $seo['page'] = $page;
        }
        empty($seo['attr'])?$this->seo->init('zzyi', $seo):$this->seo->init('case_attr', $seo);
        $this->pagedata['canonical'] = "www.jzwpt.com/zzyi/";
        $this->tmpl = 'zzyi/items.html';
    }

    public function album($page = 1)
    {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:zzyi');
        $uri = $this->request['uri'];
        if (preg_match('/album(-[\d\-]+)?(-(\d+))(.html)?/i', $uri, $m)) {
            $page = (int) $m[3];
            if ($m[1]) {
                $attr_vids = explode('-', trim($m[1], '-'));
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        foreach ($attr_values as $k => $v) {
            if ($v['filter']) {
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
        }
        $attr_vids = $attr_ids;
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('zzyi:album', array(
                implode('-', $vids)
            ));
            $v['link'] = preg_replace("/zzyi-album/","zzyi/album",$v['link']);
            $v['link'] = preg_replace("/album-0-0-0-0-1\./","album.",$v['link']);
            $v['link'] = preg_replace("/\.html/","/",$v['link']);
            $v['checked'] = true;
            foreach ($v['values'] as $kk => $vv) {
                $vv['checked'] = false;
                if (in_array($kk, $attr_ids)) {
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('zzyi:album', array(
                    implode('-', $vids)
                ));
                $vv['link'] = preg_replace("/zzyi-album/","zzyi/album",$vv['link']);
                $vv['link'] = preg_replace("/-0-0-0-0-1\./",".",$vv['link']);
                $vv['link'] = preg_replace("/\.html/","/",$vv['link']);
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        $order_list = array(
            0 => array(
                'title' => '今日推荐'
            ),
            1 => array(
                'title' => '最受欢迎 '
            ),
            2 => array(
                'title' => '人气排行'
            )
        );
        $order_list[0]['link'] = $this->mklink('zzyi:album', array(
            implode('-', $attr_value_ids),
            0,
            1
        ));
        $order_list[1]['link'] = $this->mklink('zzyi:album', array(
            implode('-', $attr_value_ids),
            1,
            1
        ));
        $order_list[2]['link'] = $this->mklink('zzyi:album', array(
            implode('-', $attr_value_ids),
            2,
            1
        ));
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['city_id'] = array(
            $this->request['city_id'],
            0
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
        if ($order == 2) {
            $orderby = array(
                'likes' => 'DESC'
            );
        } else 
            if ($order == 1) {
                $orderby = array(
                    'views' => 'DESC'
                );
            } else {
                $orderby = NULL;
            }
        if ($items = K::M('zzyi/zzyi')->items($filter, $orderby, $page, $limit, $count)) {
            $lastphotos = array();
            foreach ($items as $k => $val) {
                if ($val['lastphotos']) {
                    $lastphotos[] = $val['lastphotos'];
                    $items[$k]['lastphotos'] = explode(',', $val['lastphotos']);
                }
            }
            if (! empty($lastphotos)) {
                $lastphotos = join(',', $lastphotos);
                $this->pagedata['photos'] = K::M('zzyi/photo')->items_by_ids($lastphotos);
            }
            $this->pagedata['items'] = $items;
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zzyi:album', array(
                implode('-', $attr_value_ids),
                $order,
                '{page}'
            ), $params));
            $pager['pagebar'] = preg_replace("/zzyi-album/","zzyi/album",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/album-0-0-0-0-1\./","album.",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/\.html/","/",$pager['pagebar']);
        }
        $this->pagedata['attr_values'] = $attr_values;
        foreach($order_list as $k=>$v){
            $order_list[$k]["link"] = preg_replace("/zzyi-album/","zzyi/album",$v["link"]);
            $order_list[$k]["link"] = preg_replace("/album-0-0-0-0-1\./","album.",$order_list[$k]["link"]);
            $order_list[$k]["link"] = preg_replace("/\.html/","/",$order_list[$k]["link"]);
        }
        $this->pagedata['order_list'] = $order_list;
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
        $this->seo->init('zzyi', $seo);
        $this->pagedata['canonical'] = "www.jzwpt.com/zzyi/album/";
        $this->tmpl = 'zzyi/album.html';
    }

    public function detail($case_id, $page = 1){
        if($_REQUEST["a"]){
            $case_id=$_REQUEST["a"];
        }
        var_dump($_REQUEST);die;
        $zzyi = $this->check_case($case_id);
        K::M('zzyi/zzyi')->update_count($case_id, 'views', 1);
        if ($company_id = $zzyi['company_id']) {
            $this->pagedata['company'] = K::M('company/company')->detail($zzyi['company_id']);
        } else 
            if ($member = K::M('member/member')->member($zzyi['uid'])) {
                if ($member['from'] == 'gz') {
                    $this->pagedata['gz'] = K::M('gz/gz')->detail($zzyi['uid']);
                } else 
                    if ($member['from'] == 'designer') {
                        $this->pagedata['designer'] = K::M('designer/designer')->detail($zzyi['uid']);
                    }
            }
        if ($attr_values = K::M('zzyi/attr')->attrs_by_case($case_id)) {
            foreach ($attr_values as $k => $v) {
                $zzyi['attrvalues'][$k] = $v['attr_value_id'];
            }
        }
        $this->pagedata['photos'] = K::M('zzyi/photo')->items_by_case($case_id, 1, 50);
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 5;
        $filter['case_id'] = $case_id;
        if ($items = K::M('zzyi/comment')->items($filter, array(
            'dateline' => 'desc'
        ), $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('zzyi:detail', array(
                $case_id,
                '{page}'
            )));
            $uids = array();
            foreach ($items as $k => $v) {
                $uids[$v['uid']] = $v['uid'];
            }
            if ($uids) {
                $this->pagedata['user_list'] = K::M('member/member')->items_by_ids($uids);
            }
            $this->pagedata['items'] = $items;
        }
        $access = $this->system->config->get('access');
        $this->pagedata['comment_yz'] = $access['verifycode']['comment'];
        $this->pagedata['detail'] = $zzyi;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['mobile_url'] = $this->mklink('mobile/zzyi:detail', array(
            $case_id
        ));
		$attrs = K::M('data/attr')->attrs_by_from("zx:zzyi");
		$attrstr="";
		$attrkeywords="";
		$i=0;
		foreach($attrs as $attr):
			foreach($attr['values'] as $k=>$v):
				if(in_array($v['attr_value_id'], $zzyi['attrvalues'])){
					$attrstr.=$v['title'];
					$attrkeywords.=$i++>0?",":"";
					$attrkeywords.=$v['title']."效果图";
				}
			endforeach;
		endforeach;
        $this->seo->init('case_detail', array(
            'title' => $zzyi['title'],
            'home_name' => $detail['home_name'],
            'seo_title' => $zzyi['seo_title'],
            'seo_keywords' => $zzyi['seo_keywords'],
            'seo_description' => $zzyi['seo_description'],
            'seo_decoration_style' => $zzyi['decoration_style'],
            'seo_decoration_type' => $zzyi['decoration_type'],
            'seo_decoration_price' => $zzyi['decoration_price'],
            'seo_attr' => $attrstr,
            'seo_attrkeywords' => $attrkeywords
        ));
        $this->tmpl = 'zzyi/detail.html';
    }

    public function comment($case_id)
    {
        if (! $this->check_login()) {
            $this->err->add('您还没有登录，不能评论', 101);
        } elseif (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_comment')) == - 1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        } elseif (! $content = $this->GP('content')) {
            $this->err->add('评论内容不能不能为空', 211);
        } else {
            $verifycode_success = true;
            $access = $this->system->config->get('access');
            if ($access['verifycode']['comment']) {
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
                $zzyi = $this->check_case($case_id);
                $data = array(
                    'case_id' => $case_id,
                    'uid' => $this->uid,
                    'content' => $content,
                    'audit' => $audit,
                    'city_id' => $this->request['city_id']
                );
                K::M('zzyi/comment')->create($data);
                $this->err->add('评论成功！');
            }
        }
    }

    protected function check_case($case_id)
    {
        if (! $case_id = (int) $case_id) {
            $this->error(404);
        } else 
            if (! $zzyi = K::M('zzyi/zzyi')->detail($case_id)) {
                $this->error(404);
            } elseif (! $zzyi['audit']) {
                $this->err->add("内容审核中，暂不可访问", 211)->response();
            }
        $this->pagedata['uri'] = $this->request['uri'];
        $this->pagedata['detail'] = $zzyi;
        return $zzyi;
    }

    public function like($case_id)
    {
        if (! $case_id = (int) $case_id) {
            $this->err->add('案例不存在', 211);
        } else 
            if (! $zzyi = K::M('zzyi/zzyi')->detail($case_id)) {
                $this->err->add('案例不存在', 212);
            } else 
                if (! $zzyi['audit']) {
                    $this->err->add('该案例还未通过审核', 212);
                } else 
                    if (K::M('zzyi/like')->is_like($case_id, __IP)) {
                        $this->err->add('已经喜欢过了', 212);
                    } else {
                        $data = array(
                            'case_id' => $case_id,
                            'uid' => $this->uid,
                            'create_ip' => __IP,
                            'dateline' => __TIME
                        );
                        K::M('zzyi/like')->create($data);
                        K::M('zzyi/zzyi')->update_count($case_id, 'likes', 1);
                        $this->err->add('喜欢成功');
                    }
    }
}
