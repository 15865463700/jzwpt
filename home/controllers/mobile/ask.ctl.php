<?php

if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}


class Ctl_Mobile_Ask extends Ctl_Mobile
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/ask-([\d]+)\.html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[1]
            );
        }
    }

    public function index(){
        $pager['backurl'] = '/mobile/';
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/ask/index.html';
    }
    public function items($cat_id=0,$type = 0, $page = 1){
        //start
        if($_REQUEST["a"]){
            $cat_id=$_REQUEST["a"];
            if(!is_numeric($_REQUEST['a'])){
                if (! $cate = K::M('ask/cate')->detail($cat_id)) {
                    $this->error(404);
                }
                $this->pagedata['cate'] = $cate;
                $cat_id=$cate["cat_id"];
            }
        }
        if(empty($this->pagedata['cate'])&&$cat_id){
            $this->pagedata['cate'] = K::M('ask/cate')->detail($cat_id);
        }
        if($_REQUEST["b"]){
            $type=$_REQUEST["b"];
        }
        if($_REQUEST["c"]){
            $page=$_REQUEST["c"];
        }
        $filter = $pager = $cate = array();
        $pager['cat_id'] = $cat_id = (int) $cat_id;
        $pager['type'] = $type = (int) $type;
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 15;
        $cate_list = K::M('ask/cate')->fetch_all();
        foreach ($cate_list as $k => $v) {
            if ($v['cat_id'] == $cat_id) {
                $cate_list[$k]['current'] = 'current';
                if ($v['parent_id'] != '0') {
                    $cate_list[$v['parent_id']]['current'] = 'current';
                    $pager['parent_id'] = $v['parent_id'];
                    $filter['cat_id'][] = $cat_id;
                } else {
                    $pager['parent_id'] = $v['cat_id'];
                    foreach ($cate_list as $kk => $vv) {
                        if ($vv['parent_id'] == $cat_id) {
                            $filter['cat_id'][] = $vv['cat_id'];
                        }
                    }
                }
            }
        }
        if ($type = (int) $type) {
            if ($type == 1) {
                $filter['answer_id'] = '>:0';
            } else {
                $filter['answer_id'] = '0';
            }
        }
        $filter['audit'] = 1;
        $sokw = trim($this->GP('kw'));
        if ($sokw) {
            $pager['sokw'] = $sokw = htmlspecialchars($sokw);
            $filter['title'] = "LIKE:%{$sokw}%";
            $params['kw'] = $sokw;
        }
        $count=0;
        if ($items = K::M('ask/ask')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/ask:items', array(
                $cat_id,
                $type,
                '{page}'
            )), array());
            $this->pagedata['items'] = $items;
        }

        foreach ($items as $k => $v) {
            $res[] = $v['ask_id'];
      }
       $ask_id  = implode(",",$res);
        //echo $ask_id;die;
        //问题及答案
        if ($itemss = K::M('ask/answer')->items1($ask_id,$filter, null, $page, $limit, $count)) {
            foreach ($itemss as $v) {
                $askids[$v['ask_id']] = $v['ask_id'];
                if ($v['uid']) {
                    $uids[$v['uid']] = $v['uid'];
                }
            }
            $this->pagedata['itemss'] = $itemss;
        }

       // var_dump($items);die;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cate_list'] = $cate_list;
        $cate = $cate_list[$cat_id];
        $this->seo->init('ask_items', array(
            'cate_name' => $cate['title']
        ));
       $this->pagedata['cate_list'] = $cate_list = K::M('ask/cate')->fetch_all();
        //end
        $pager['backurl'] = '/mobile/';
        $this->pagedata['pager'] = $pager;
        $this->pagedata['sokw'] = $sokw;
        $this->tmpl = 'mobile/ask/items.html';
    }

    public function detail($ask_id,$page = 1){
        //start
        $detail = K::M('ask/ask')->detail($ask_id);
        $uids = array();
        if ($uid = (int) $detail['uid']) {
            $uids[$uid] = $uid;
        }
        if ($detail['answer_id']) {
            $answer = K::M('ask/answer')->detail($detail['answer_id']);
            $this->pagedata['answer'] = $answer;
            $uids[$answer['uid']] = $answer['uid'];
        }
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['ask_id'] = $ask_id;
        $filter['answer_id'] = "<>:" . $detail['answer_id'];
        if ($items = K::M('ask/answer')->items($filter, null, $page, $limit, $count)) {
            foreach ($items as $v) {
                $askids[$v['ask_id']] = $v['ask_id'];
                if ($v['uid']) {
                    $uids[$v['uid']] = $v['uid'];
                }
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('ask:items', array(
                $ask_id,
                '{page}'
            )), array());
        }
        $this->pagedata['answers'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['member_list'] = K::M('member/view')->items_by_ids($uids);
        $this->pagedata['cate_list'] = $cate_list = K::M('ask/cate')->fetch_all();
        $this->pagedata['detail'] = $detail;
        $this->pagedata['uid'] = $this->uid;
        $seo = array(
            'title' => $detail['title'],
            'cate_name' => '',
            'intro' => $detail['intro']
        );
        if ($cate = $cate_list[$detail['cat_id']]) {
            $seo['cate_name'] = $cate['title'];
        }
        $this->seo->init('ask_detail', $seo);
        if ($seo_title = $detail['seo_title']) {
            $this->seo->set_title($seo_title);
        }
        if ($seo_description = $detail['seo_description']) {
            $this->seo->set_description($seo_description);
        }
        if ($seo_keywords = $detail['seo_keyword']) {
            $this->seo->set_keywords($seo_keywords);
        }
        $access = $this->system->config->get('access');
        $this->pagedata['ask_yz'] = $access['verifycode']['ask'];
        K::M('ask/ask')->update_count($ask_id, 'views');
        //end
        $pager['backurl'] = '/mobile/ask/';
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/ask/detail.html';
    }

    public function hot($page = 1){
        $this->tmpl = 'mobile/ask/hot.html';
    }
    public function cate($page = 1){
        $this->tmpl = 'mobile/ask/cate.html';
    }
    public function post(){
        $title = htmlspecialchars($this->GP('title'), ENT_QUOTES, 'utf-8');
        $access = $this->system->config->get('access');
        $this->pagedata['ask_yz'] = $access['verifycode']['ask'];
        $this->pagedata['cates'] = K::M('ask/cate')->fetch_all();
        $this->pagedata['title'] = $title;
        $this->seo->init('ask');
        $this->tmpl = 'mobile/ask/post.html';
    }
//    public function save()
//    {
//        if (empty($this->check_login())) {
//            $this->err->add('登录后才能发布问题', 101);
//        }
////        else
////            if (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_ask')) == -1) {
////                $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
////            }
//        else
//            if ($data = $this->checksubmit('data')) {
//                $verifycode_success = true;
//                $access = $this->system->config->get('access');
//                if ($access['verifycode']['ask']) {
//                    if ($access['verifycode']['ask']) {
//                        if (!$verifycode = $this->GP('verifycode')) {
//                            $verifycode_success = false;
//                            $this->err->add('验证码不正确', 212);
//                        } else
//                            if (!K::M('magic/verify')->check($verifycode)) {
//                                $verifycode_success = false;
//                                $this->err->add('验证码不正确', 212);
//                            }
//                    }
//                    if ($verifycode_success) {
//                        if ($data['content']) {
//                            $data['title'] = K::M('content/string')->sub($data['content'], 0, 20, $suffix = "");
//                            $data['intro'] = K::M('content/string')->sub($data['content'], 20, K::M('content/string')->Len($data['content']), $suffix = "");
//                        }
//                        $data = array(
//                            'title' => $data['title'],
//                            'intro' => $data['intro'],
//                            'uid' => $this->uid,
//                            'audit' => $audit
//                        );
//                        if ($this->GP('cat_id')) {
//                            $data['cat_id'] = $this->GP('cat_id');
//                        }
//                        if ($_FILES['data']) {
//                            foreach ($_FILES['data'] as $k => $v) {
//                                foreach ($v as $kk => $vv) {
//                                    $attachs[$kk][$k] = $vv;
//                                }
//                            }
//                            $upload = K::M('magic/upload');
//                            foreach ($attachs as $k => $attach) {
//                                if ($attach['error'] == UPLOAD_ERR_OK) {
//                                    if ($a = $upload->upload($attach, 'home')) {
//                                        $data[$k] = $a['photo'];
//                                    }
//                                }
//                            }
//                        }
//                        if (!$cat_id = $this->GP('cat_id')) {
//                            $cat_id = '1';
//                        }
//                        if ($ask_id = K::M('ask/ask')->create($data)) {
//                            K::M('system/integral')->commit('ask', $this->MEMBER, '发布问题');
//                            $this->err->add('发表问题成功');
////                        $this->err->set_data('forward', $this->mklink('ask:items', array(
////                            $cat_id
////                        )));
//                        }
//                    }
//                } else {
//                    $this->err->add('发表问题失败', 201);
//                }
//            }
//
//    }
}
