<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Gybjcompany extends Ctl{
    public static $ctl_gybjcompany_old="gybjcompany";
    public static $ctl_gybjcompany_new="gybj";

    public function __construct(&$system){
        parent::__construct($system);
        $uri = $system->request['uri'];
        if (preg_match('/gybjcompany(-index)?-(\d+).html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index($gybjcompany_id){
        $this->detail($gybjcompany_id);
    }

    public function detail($gybjcompany_id){
        if($_REQUEST["a"]){
            $gybjcompany_id=$_REQUEST["a"];
        }
        if(strpos($this->request['uri'],"ompany")){
            header("Location:/gybj/{$gybjcompany_id}.html");die;
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $comment_list = K::M('gybjcompany/comment')->items(array(
            'company_id' => $gybjcompany_id,
            'audit' => '1'
        ), null, 1, 4);
        
        $uids = array();
        foreach ($comment_list as $k => $v) {
            $uids[$v['uid']] = $v['uid'];
        }
        if ($uids) {
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        // $this->pagedata['mobile_url'] = $this->mklink('mobile/gybjcompany', array($gybjcompany_id));
        $this->pagedata['comment_list'] = $comment_list;
        $this->seo->set_company($gybjcompany);
        $this->seo->init('gybjcompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/gybjcompany/{$gybjcompany_id}.html";
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/index.html';
        } else {
            die('gybjcompany/' . $gybjcompany['skin'] . '/index.html');
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/index.html';
        }
    }

    public function about($gybjcompany_id){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        header("Location:/".Ctl_Gybjcompany::$ctl_gybjcompany_new."/jj-".$gybjcompany_id.".html");die;
    }
    public function jj($gybjcompany_id){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        // $this->pagedata['photo_list'] = K::M('gybjcompany/photo')->items_by_gybjcompany($gybjcompany_id);
        // $this->seo->set_gybjcompany($gybjcompany);
        // $this->seo->init('gybjcompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/gybjcompany/about-{$gybjcompany_id}.html";
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/about.html';
        } else {
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/about.html';
        }
    }

    public function youhui($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc= Ctl_Gybjcompany::$ctl_gybjcompany_new."/yh-".$gybjcompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function yh($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter['gybjcompany_id'] = $gybjcompany_id;
        $filter['audit'] = 1;
        if ($items = K::M('gybjcompany/youhui')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $gybjcompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_gybjcompany($gybjcompany);
        // $this->seo->init('gybjcompany');
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/youhui.html';
        } else {
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/youhui.html';
        }
    }

    public function news($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Gybjcompany::$ctl_gybjcompany_new."/xw-".$gybjcompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function xw($gybjcompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $items = K::M('gybjcompany/news')->items_by_company($gybjcompany_id, $page, $limit, $count);
        if ($items) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $gybjcompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_gybjcompany($gybjcompany);
        // $this->seo->init('gybjcompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/gybjcompany/news-{$gybjcompany_id}.html";
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/news.html';
        } else {
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/news.html';
        }
    }

    public function cases($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Gybjcompany::$ctl_gybjcompany_new."/al-".$gybjcompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function al($gybjcompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1,
            'closed' => 0
        );
        $filter['gybjcompany_id'] = $gybjcompany_id;
        if ($items = K::M('gybjcase/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $gybjcompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_gybjcompany($gybjcompany);
        // $this->seo->init('gybjcompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/gybjcompany/cases-{$gybjcompany_id}.html";
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/cases.html';
        } else {
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/cases.html';
        }
    }

    public function site($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Gybjcompany::$ctl_gybjcompany_new."/gd-".$gybjcompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function gd($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1
        );
        $filter['gybjcompany_id'] = $gybjcompany_id;
        if ($items = K::M('home/site')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $gybjcompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
        }
        // $this->seo->set_gybjcompany($gybjcompany);
        // $this->seo->init('gybjcompany');
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/site.html';
        } else {
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/site.html';
        }
    }

    public function team($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc= Ctl_Gybjcompany::$ctl_gybjcompany_new."/td-".$gybjcompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function td($gybjcompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $gybjcompany_id,
            'company_type' => 6,
            'closed' => 0
        );
        if ($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $gybjcompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_gybjcompany($gybjcompany);
        // $this->seo->init('gybjcompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/gybjcompany/team-{$gybjcompany_id}.html";
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/team.html';
        } else {
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/team.html';
        }
    }

    public function comment($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc= Ctl_Gybjcompany::$ctl_gybjcompany_new."/pj-".$gybjcompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function pj($gybjcompany_id, $page = 1){
        if($_REQUEST['a']){
            $gybjcompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if ($items = K::M('gybjcompany/comment')->items_by_company($gybjcompany_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $gybjcompany_id,
                '{page}'
            )));
            $uids = array();
            foreach ($items as $v) {
                $uids[$v['uid']] = $v['uid'];
            }
            if ($uids) {
                $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
            }
            $this->pagedata['items'] = $items;
        }
        
        $access = $this->system->config->get('access');
        $this->pagedata['comment_yz'] = $access['verifycode']['comment'];
        // $this->seo->set_gybjcompany($gybjcompany);
        // $this->seo->init('gybjcompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/gybjcompany/comment-{$gybjcompany_id}.html";
        if (empty($gybjcompany['skin']) || $gybjcompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "gybjcompany";
            $this->tmpl = 'gybjcompany/comment.html';
        } else {
            $this->tmpl = 'gybjcompany/' . $gybjcompany['skin'] . '/comment.html';
        }
    }

    public function detail_c($gybjcompany_id)
    {
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $gybjcompany['desc'] = K::M('content/html')->text($gybjcompany['info']);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $this->tmpl = 'gybjcompany/detail_c.html';
    }

    public function savecomment($gybjcompany_id = null)
    {
        $this->check_login();
        if (! ($gybjcompany_id = (int) $gybjcompany_id) && ! ($gybjcompany_id = (int) $this->GP('gybjcompany_id'))) {
            $this->error(404);
        }
        $gybjcompany = $this->check_gybjcompany($gybjcompany_id);
        $this->pagedata['gybjcompany'] = $gybjcompany;
        $allow_comment = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_score');
        if ($allow_comment < 0) {
            $this->err->add('您是【' . $this->MEMBER['group_name'] . '】没有权限发表点评', 333);
        } else 
            if (! $data = $this->checksubmit('data')) {
                $this->err->add('非法的数据提交', 211);
            } else 
                if (! $data = $this->check_fields($data, 'score1,score2,score3,score4,score5,content')) {
                    $this->err->add('非法的数据提交', 212);
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
                        $data['city_id'] = $gybjcompany['city_id'];
                        $data['company_id'] = $gybjcompany_id;
                        $data['uid'] = $this->uid;
                        $data['audit'] = $allow_comment;
                        $data['dateline'] = time();
                        if ($comment_id = K::M('gybjcompany/comment')->create($data)) {
                            K::M('gybjcompany/comment')->comment_count($gybjcompany_id);
                            K::M('gybjcompany/comment')->comment($data);
                            $this->err->add('发表点评成功');
                        }
                    }
                }
    }

    protected function check_gybjcompany(&$company_id = null)
    {
        if (! $company_id = (int) $company_id) {
            $this->error(404);
        } else 
            if (! $company = K::M('gybjcompany/company')->detail($company_id, true)) {
                $this->error(404);
            } else 
                if (empty($company['audit']) && (empty($this->uid) || ($this->uid != $company['uid']))) {
                    $this->err->add('商铺审核中不能访问', 212);
                    $this->err->response();
                }
        
        $fields = K::M('gybjcompany/fields')->detail($company_id);
        foreach ($fields as $k => $v) {
            $company[$k] = $v;
        }
        
        $company['desc'] = K::M('content/html')->text($company['info']);
        
        if ($uid = $company['uid']) {
            $company['member'] = K::M('member/member')->detail($uid);
        }
        if ($group_id = $company['group_id']) {
            $company['group'] = K::M('member/group')->group($group_id);
        }
        $this->pagedata['company'] = $company;
        K::M('gybjcompany/company')->update_count($company_id, 'views', 1);
        return $company;
    }
}