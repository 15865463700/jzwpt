<?php
class Ctl_Jtyjycompany extends Ctl{
    public static $ctl_jtyjycompany_old="jtyjycompany";
    public static $ctl_jtyjycompany_new="jtyjy";

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $system->request['uri'];
        if (preg_match('/jtyjycompany(-index)?-(\d+).html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index($jtyjycompany_id)
    {
        $this->detail($jtyjycompany_id);
    }

    public function detail($jtyjycompany_id)
    {
        if($_REQUEST["a"]){
            $jtyjycompany_id=$_REQUEST["a"];
        }
        if(strpos($this->request['uri'],"ompany")){
            header("Location:/jtyjy/{$jtyjycompany_id}.html");die;
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $comment_list = K::M('jtyjycompany/comment')->items(array(
            'company_id' => $jtyjycompany_id,
            'audit' => '1'
        ), null, 1, 4);
        
        $uids = array();
        foreach ($comment_list as $k => $v) {
            $uids[$v['uid']] = $v['uid'];
        }
        if ($uids) {
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        // $this->pagedata['mobile_url'] = $this->mklink('mobile/jtyjycompany', array($jtyjycompany_id));
        $this->pagedata['comment_list'] = $comment_list;
        $this->seo->set_company($jtyjycompany);
        $this->seo->init('jtyjycompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/jtyjycompany/{$jtyjycompany_id}.html";
//        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/index.html';
//        } else {
//            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/index.html';
//        }
    }

    public function about($jtyjycompany_id){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        header("Location:/".Ctl_Jtyjycompany::$ctl_jtyjycompany_new."/jj-".$jtyjycompany_id.".html");die;
    }
    public function jj($jtyjycompany_id){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        // $this->pagedata['photo_list'] = K::M('jtyjycompany/photo')->items_by_jtyjycompany($jtyjycompany_id);
        // $this->seo->set_jtyjycompany($jtyjycompany);
        // $this->seo->init('jtyjycompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/jtyjycompany/about-{$jtyjycompany_id}.html";
        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/about.html';
        } else {
            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/about.html';
        }
    }

    public function youhui($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc= Ctl_Jtyjycompany::$ctl_jtyjycompany_new."/yh-".$jtyjycompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function yh($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter['jtyjycompany_id'] = $jtyjycompany_id;
        $filter['audit'] = 1;
        if ($items = K::M('jtyjycompany/youhui')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $jtyjycompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_jtyjycompany($jtyjycompany);
        // $this->seo->init('jtyjycompany');
        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/youhui.html';
        } else {
            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/youhui.html';
        }
    }

    public function news($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Jtyjycompany::$ctl_jtyjycompany_new."/xw-".$jtyjycompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function xw($jtyjycompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $items = K::M('jtyjycompany/news')->items_by_company($jtyjycompany_id, $page, $limit, $count);
        if ($items) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $jtyjycompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_jtyjycompany($jtyjycompany);
        // $this->seo->init('jtyjycompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/jtyjycompany/news-{$jtyjycompany_id}.html";
        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/news.html';
        } else {
            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/news.html';
        }
    }

    public function cases($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Jtyjycompany::$ctl_jtyjycompany_new."/al-".$jtyjycompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function al($jtyjycompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1,
            'closed' => 0
        );
        $filter['jtyjycompany_id'] = $jtyjycompany_id;
        if ($items = K::M('jtyjycase/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $jtyjycompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_jtyjycompany($jtyjycompany);
        // $this->seo->init('jtyjycompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/jtyjycompany/cases-{$jtyjycompany_id}.html";
        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/cases.html';
        } else {
            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/cases.html';
        }
    }

    public function site($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Jtyjycompany::$ctl_jtyjycompany_new."/gd-".$jtyjycompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function gd($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1
        );
        $filter['jtyjycompany_id'] = $jtyjycompany_id;
        if ($items = K::M('home/site')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $jtyjycompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
        }
        // $this->seo->set_jtyjycompany($jtyjycompany);
        // $this->seo->init('jtyjycompany');
        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/site.html';
        } else {
            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/site.html';
        }
    }

    public function team($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Jtyjycompany::$ctl_jtyjycompany_new."/td-".$jtyjycompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function td($jtyjycompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $jtyjycompany_id,
            'company_type' => 6,
            'closed' => 0
        );
        if ($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $jtyjycompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_jtyjycompany($jtyjycompany);
        // $this->seo->init('jtyjycompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/jtyjycompany/team-{$jtyjycompany_id}.html";
        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/team.html';
        } else {
            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/team.html';
        }
    }

    public function comment($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Jtyjycompany::$ctl_jtyjycompany_new."/pj-".$jtyjycompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function pj($jtyjycompany_id, $page = 1){
        if($_REQUEST['a']){
            $jtyjycompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if ($items = K::M('jtyjycompany/comment')->items_by_company($jtyjycompany_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $jtyjycompany_id,
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
        // $this->seo->set_jtyjycompany($jtyjycompany);
        // $this->seo->init('jtyjycompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/jtyjycompany/comment-{$jtyjycompany_id}.html";
        if (empty($jtyjycompany['skin']) || $jtyjycompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "jtyjycompany";
            $this->tmpl = 'jtyjycompany/comment.html';
        } else {
            $this->tmpl = 'jtyjycompany/' . $jtyjycompany['skin'] . '/comment.html';
        }
    }

    public function detail_c($jtyjycompany_id)
    {
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $jtyjycompany['desc'] = K::M('content/html')->text($jtyjycompany['info']);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
        $this->tmpl = 'jtyjycompany/detail_c.html';
    }

    public function savecomment($jtyjycompany_id = null)
    {
        $this->check_login();
        if (! ($jtyjycompany_id = (int) $jtyjycompany_id) && ! ($jtyjycompany_id = (int) $this->GP('jtyjycompany_id'))) {
            $this->error(404);
        }
        $jtyjycompany = $this->check_jtyjycompany($jtyjycompany_id);
        $this->pagedata['jtyjycompany'] = $jtyjycompany;
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
                        $data['city_id'] = $jtyjycompany['city_id'];
                        $data['company_id'] = $jtyjycompany_id;
                        $data['uid'] = $this->uid;
                        $data['audit'] = $allow_comment;
                        $data['dateline'] = time();
                        if ($comment_id = K::M('jtyjycompany/comment')->create($data)) {
                            K::M('jtyjycompany/comment')->comment_count($jtyjycompany_id);
                            K::M('jtyjycompany/comment')->comment($data);
                            $this->err->add('发表点评成功');
                        }
                    }
                }
    }

    protected function check_jtyjycompany(&$company_id = null)
    {
        if (! $company_id = (int) $company_id) {
            $this->error(404);
        } else 
            if (! $company = K::M('jtyjycompany/company')->detail($company_id, true)) {
                $this->error(404);
            } else 
                if (empty($company['audit']) && (empty($this->uid) || ($this->uid != $company['uid']))) {
                    $this->err->add('商铺审核中不能访问', 212);
                    $this->err->response();
                }
        $fields = K::M('jtyjycompany/fields')->detail($company_id);
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
        K::M('jtyjycompany/company')->update_count($company_id, 'views', 1);
        return $company;
    }
}