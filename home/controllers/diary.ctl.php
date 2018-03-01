<?php

class Ctl_Diary extends Ctl{
    
    public function __construct(&$system)
    {
        parent::__construct($system);
        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
    }

    public function index($page=1)
    {
        $this->items($page);
    }

    public function items($status = 0, $type_id = 0, $way_id = 0, $order = 0, $page = null)
    {
        $status=isset($_REQUEST["a"])?$_REQUEST["a"]:$status;
        $type_id=isset($_REQUEST["b"])?$_REQUEST["b"]:$type_id;
        $way_id=isset($_REQUEST["c"])?$_REQUEST["c"]:$way_id;
        $order=isset($_REQUEST["d"])?$_REQUEST["d"]:$order;
        $page=isset($_REQUEST["e"])?$_REQUEST["e"]:$page;
        $orderby = $filter = $pager = array();
        if ($page === null) {
            $page = (int) $status;
            $status = $type_id = $way_id = $order = 0;
        }
        $pager['status'] = $status = (int) $status;
        $pager['type_id'] = $type_id = (int) $type_id;
        $pager['way_id'] = $way_id = (int) $way_id;
        $pager['order'] = $order = (int) $order;
        if ($status) {
            $filter['status'] = $status;
        }
        if ($way_id) {
            $filter['way_id'] = $way_id;
        }
        if ($type_id) {
            $filter['type_id'] = $type_id;
        }
        $status_list = K::M('home/site')->get_status();
        $status_all_link = $this->mklink('diary:items', array(
            0,
            $type_id,
            $way_id,
            $order,
            1
        ));
        foreach ($status_list as $k => $v) {
            $a = array(
                'title' => $v
            );
            $a['link'] = $this->mklink('diary:items', array(
                $k,
                $type_id,
                $way_id,
                $order,
                1
            ));
            $a['link'] = preg_replace("/diary-items/","diary",$a['link']);
            $a['link'] = preg_replace("/diary-0-0-0-0-1\./","diary.",$a['link']);
            $a['link'] = preg_replace("/\.html/","/",$a['link']);
            $status_list[$k] = $a;
        }
        $setting_list = K::M('tenders/setting')->fetch_all_setting();
        $setting_type = K::M('tenders/setting')->get_type();
        $type_list = $way_list = array();
        $type_all_link = $this->mklink('diary:items', array($status, 0, $way_id, $order, 1));
        foreach ($setting_list[$setting_type['house_type']] as $k => $v) {
            $a = array(
                'title' => $v
            );
            $a['link'] = $this->mklink('diary:items', array($status,$k,$way_id,$order,1));
            $a['link'] = preg_replace("/diary-items/","diary",$a['link']);
            $a['link'] = preg_replace("/diary-0-0-0-0-1\./","diary.",$a['link']);
            $a['link'] = preg_replace("/\.html/","/",$a['link']);
            $type_list[$k] = $a;
        }
        $way_all_link = $this->mklink('diary:items', array(
            $status,
            $type_id,
            0,
            $order,
            1
        ));
        foreach ($setting_list[$setting_type['way']] as $k => $v) {
            $a = array(
                'title' => $v
            );
            $a['link'] = $this->mklink('diary:items', array(
                $status,
                $type_id,
                $k,
                $order,
                1
            ));
            $a['link'] = preg_replace("/diary-items/","diary",$a['link']);
            $a['link'] = preg_replace("/diary-0-0-0-0-1\./","diary.",$a['link']);
            $a['link'] = preg_replace("/\.html/","/",$a['link']);
            $way_list[$k] = $a;
        }
        $order_list = array(
            0 => array(
                'title' => '默认'
            ),
            1 => array(
                'title' => '浏览数'
            ),
            2 => array(
                'title' => '评论数'
            )
        );
        foreach ($order_list as $k => $v) {
            $v['link'] = $this->mklink('diary:items', array(
                $status,
                $type_id,
                $way_id,
                $k,
                1
            ));
            $v['link'] = preg_replace("/diary-items/","diary",$v['link']);
            $v['link'] = preg_replace("/diary-0-0-0-0-1\./","diary.",$v['link']);
            $v['link'] = preg_replace("/\.html/","/",$v['link']);
            $order_list[$k] = $v;
        }
        $pager['page'] = $page = max(intval($page), 1);
        $pager['limit'] = $limit = 5;
        $filter['city_id'] = $this->request['city_id'];
        $filter['audit'] = 1;
        $filter['closed'] = 0;
        if ($order == 1) {
            $orderby = array(
                'views' => 'DESC'
            );
        } else
            if ($order == 2) {
                $orderby = array(
                    'comments' => 'DESC'
                );
            } else {
                $orderby = null;
            }
        $sokw = trim($this->GP('kw'));
        if ($sokw) {
            $pager['sokw'] = $sokw = htmlspecialchars($sokw);
            $filter['title'] = "LIKE:%{$sokw}%";
            $params['kw'] = $sokw;
        }
        if ($items = K::M('diary/diary')->items($filter, $orderby, $page, $limit, $count)) {
            $uids="0";
            foreach ($items as $k => $v) {
                if ($v['company_id']) {
                    $company_ids[$v['company_id']] = $v['company_id'];
                }
                $uids.=",{$v['uid']}";
            }
            if (! empty($company_ids)) {
                $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($company_ids);
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('diary:items', array(
                $status,
                $type_id,
                $way_id,
                $order,
                '{page}'
            )));
            $pager['pagebar'] = preg_replace("/diary-items/","diary",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/diary-0-0-0-0-1\./","diary.",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/\.html/","/",$pager['pagebar']);

            $filter=array();
            $filter["uid"]="IN:{$uids}";
			if ($kw = $this->GP('kw')) {
				$pager['sokw'] = $sokw = $kw = htmlspecialchars($kw);
				if ($sokw) {
					$pager['sokw'] = $sokw = htmlspecialchars($sokw);
					$filter['title'] = "LIKE:%{$sokw}%";
					$params['kw'] = $sokw;
				}
			}
            $count=0;
            $mlist=K::M('member/member')->items($filter, null, null, null, $count);
            $marr=array();
            foreach($mlist as $k=>$v){
                $marr[$v['uid']]=$v;
            }
            foreach($items as $k=>$v){
                $items[$k]['uname']=$marr[$v['uid']]['uname'];
                $items[$k]['face']=$marr[$v['uid']]['face'];
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['status_list'] = $status_list;
        $this->pagedata['type_list'] = $type_list;
        $this->pagedata['way_list'] = $way_list;
        foreach($order_list as $k=>$v){
            $order_list[$k]['link'] = preg_replace("/diary-items/","diary",$pager['link']);
            $order_list[$k]['link'] = preg_replace("/diary-0-0-0-0-1\./","diary.",$order_list[$k]['link']);
            $order_list[$k]['link'] = preg_replace("/\.html/","/",$order_list[$k]['link']);
        }
        $this->pagedata['order_list'] = $order_list;
        $status_all_link = preg_replace("/diary-items/","diary",$status_all_link);
        $status_all_link = preg_replace("/diary-0-0-0-0-1\./","diary.",$status_all_link);
        $status_all_link = preg_replace("/\.html/","/",$status_all_link);
        $this->pagedata['status_all_link'] = $status_all_link;
        $type_all_link = preg_replace("/diary-items/","diary",$type_all_link);
        $type_all_link = preg_replace("/diary-0-0-0-0-1\./","diary.",$type_all_link);
        $type_all_link = preg_replace("/\.html/","/",$type_all_link);
        $this->pagedata['type_all_link'] = $type_all_link;
        $way_all_link = preg_replace("/diary-items/","diary",$way_all_link);
        $way_all_link = preg_replace("/diary-0-0-0-0-1\./","diary.",$way_all_link);
        $way_all_link = preg_replace("/\.html/","/",$way_all_link);
        $this->pagedata['way_all_link'] = $way_all_link;
        $this->pagedata['pager'] = $pager;
        $this->seo->init('diary_items');
            $this->pagedata['canonical'] = "www.jzwpt.com/diary/";
        $this->tmpl = 'diary/items.html';
    }

    public function detail($diary_id, $page = 1)
    {
        $diary_id=$_REQUEST["a"]?$_REQUEST["a"]:$diary_id;
        $page=$_REQUEST["c"]?$_REQUEST["c"]:$page;
        if (! $diary_id = (int) $diary_id) {
            $this->error(404);
        } else
            if (! $detail = K::M('diary/diary')->detail($diary_id)) {
                $this->error(404);
            } else
                if (empty($detail['audit'])) {
                    $this->err->add("内容审核中，暂不可访问", 211)->response();
                } else {
                    K::M('diary/diary')->update_count($diary_id, 'views', 1);
                    if ($company_id = $detail['company_id']) {
                        $this->pagedata['company'] = K::M('company/company')->detail($company_id);
                    }
                    if ($uid = (int) $detail['uid']) {
                        if ($member = K::M('member/member')->member($case['uid'])) {
                            $this->pagedata['member'] = $member;
                        }
                    }
                    $this->pagedata['items'] = K::M('diary/item')->items(array(
                        'diary_id' => $diary_id
                    ), array(
                        'status' => 'ASC'
                    ), 1, 20);
                    $this->pagedata['detail'] = $detail;
                    $filter = $pager = array();
                    $pager['page'] = max(intval($page), 1);
                    $pager['limit'] = $limit = 5;
                    $filter['diary_id'] = $diary_id;
                    if ($comments = K::M('diary/comment')->items($filter, array(
                        'comment_id' => 'DESC'
                    ), $page, $limit, $count)) {
                        $uids = array();
                        foreach ($comments as $k => $v) {
                            $uids[$v['uid']] = $v['uid'];
                        }
                        $pager['count'] = $count;
                        $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('diary:detail', array(
                            $diary_id,
                            '{page}'
                        )));
                        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
                        $this->pagedata['comments'] = $comments;
                    }
					$this->pagedata['photos']=K::M('diary/photo')->items_by_diary($diary_id, 1, 50);
					
                    $access = $this->system->config->get('access');
                    $this->pagedata['comment_yz'] = $access['verifycode']['comment'];
                    $this->pagedata['cfg_status'] = K::M('home/site')->get_status();
                    $this->pagedata['cfg_setting'] = K::M('tenders/setting')->fetch_all_setting();
                    $this->pagedata['cfg_type'] = K::M('tenders/setting')->get_type();
                    $this->pagedata['pager'] = $pager;
                    $this->seo->init('diary_detail', array(
                        'title' => $detail['title'],
                        'uname' => $member['uname'],
                        'home_name' => $detail['home_name'],
                        'company_name' => $this->pagedata['company']['name']
                    ));
                    $this->pagedata['canonical'] = "www.jzwpt.com/diary/{$diary_id}.html";
                    $this->tmpl = 'diary/detail.html';
                }
    }
    
    public function comment($diary_id = null)
    {
        $this->check_login();
        if (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_comment')) < 0) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        } else
            if (! ($diary_id = (int) $diary_id) && ! ($diary_id = (int) $this->GP('diary_id'))) {
                $this->err->add('非法数据提交', 211);
            } else
                if (! $diary = K::M('diary/diary')->detail($diary_id)) {
                    $this->err->add('您评论的内容不存在或已经删除', 212);
                } elseif (! $diary['audit']) {
                    $this->err->add('您评论的内容还在审核中，暂不可评论', 213);
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
                        $data = array(
                            'diary_id' => $diary_id,
                            'uid' => $this->uid,
                            'content' => $content,
                            'audit' => $audit
                        );
                        K::M('diary/comment')->create($data);
                        K::M('diary/diary')->update_count($diary_id, 'comments', 1);
                        $this->err->add('评论日记成功！');
                    }
                }
    }
}


