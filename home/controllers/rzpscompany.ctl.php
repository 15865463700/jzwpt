
<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Rzpscompany extends Ctl{
    public static $ctl_rzpscompany_old="rzpscompany";
    public static $ctl_rzpscompany_new="rzps";

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $system->request['uri'];
        if (preg_match('/rzpscompany(-index)?-(\d+).html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index($rzpscompany_id)
    {
        $this->detail($rzpscompany_id);
    }

    public function detail($rzpscompany_id){
        if($_REQUEST["a"]){
            $rzpscompany_id=$_REQUEST["a"];
        }
        if(strpos($this->request['uri'],"ompany")){
            header("Location:/rzps/{$rzpscompany_id}.html");die;
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
       // $rzpscompany['desc'] = K::M('content/html')->text($rzpscompany['info']);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $comment_list = K::M('rzpscompany/comment')->items(array(
            'company_id' => $rzpscompany_id,
            'audit' => '1'
        ), null, 1, 4);
        
        $uids = array();
        foreach ($comment_list as $k => $v) {
            $uids[$v['uid']] = $v['uid'];
        }
        if ($uids) {
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        // $this->pagedata['mobile_url'] = $this->mklink('mobile/rzpscompany', array($rzpscompany_id));
        $this->pagedata['comment_list'] = $comment_list;
        $this->seo->set_company($rzpscompany);
        $this->seo->init('rzpscompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/rzpscompany/{$rzpscompany_id}.html";
//        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
           $this->pagedata['skin_theme'] = "rzpscompany";
           $this->tmpl = 'rzpscompany/index.html';
//        } else {
//            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/index.html';
//        }
    }

    public function about($rzpscompany_id){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        header("Location:/". Ctl_Rzpscompany::$ctl_rzpscompany_new."/jj-".$rzpscompany_id.".html");die;
    }
    public function jj($rzpscompany_id){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/rzpscompany/about-{$rzpscompany_id}.html";
        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "rzpscompany";
            $this->tmpl = 'rzpscompany/about.html';
        } else {
            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/about.html';
        }
    }

    public function youhui($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc= Ctl_Rzpscompany::$ctl_rzpscompany_new."/yh-".$rzpscompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function yh($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter['rzpscompany_id'] = $rzpscompany_id;
        $filter['audit'] = 1;
        if ($items = K::M('rzpscompany/youhui')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $rzpscompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_rzpscompany($rzpscompany);
        // $this->seo->init('rzpscompany');
        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "rzpscompany";
            $this->tmpl = 'rzpscompany/youhui.html';
        } else {
            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/youhui.html';
        }
    }

    public function news($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Rzpscompany::$ctl_rzpscompany_new."/xw-".$rzpscompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function xw($rzpscompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $items = K::M('rzpscompany/news')->items_by_company($rzpscompany_id, $page, $limit, $count);
        if ($items) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $rzpscompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_rzpscompany($rzpscompany);
        // $this->seo->init('rzpscompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/rzpscompany/news-{$rzpscompany_id}.html";
        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "rzpscompany";
            $this->tmpl = 'rzpscompany/news.html';
        } else {
            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/news.html';
        }
    }

    public function cases($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Rzpscompany::$ctl_rzpscompany_new."/al-".$rzpscompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function al($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1,
            'closed' => 0
        );
        $filter['rzpscompany_id'] = $rzpscompany_id;
        if ($items = K::M('rzpscase/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $rzpscompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_rzpscompany($rzpscompany);
        // $this->seo->init('rzpscompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/rzpscompany/cases-{$rzpscompany_id}.html";
        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "rzpscompany";
            $this->tmpl = 'rzpscompany/cases.html';
        } else {
            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/cases.html';
        }
    }

    public function site($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Afzncompany::$ctl_afzncompany_new."/gd-".$rzpscompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function gd($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1
        );
        $filter['rzpscompany_id'] = $rzpscompany_id;
        if ($items = K::M('home/site')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $rzpscompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
        }
        // $this->seo->set_rzpscompany($rzpscompany);
        // $this->seo->init('rzpscompany');
        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "rzpscompany";
            $this->tmpl = 'rzpscompany/site.html';
        } else {
            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/site.html';
        }
    }

    public function team($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc= Ctl_Rzpscompany::$ctl_rzpscompany_new."/td-".$rzpscompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function td($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $rzpscompany_id,
            'closed' => 0
        );
        if ($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $rzpscompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_rzpscompany($rzpscompany);
        // $this->seo->init('rzpscompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/rzpscompany/team-{$rzpscompany_id}.html";
        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "rzpscompany";
            $this->tmpl = 'rzpscompany/team.html';
        } else {
            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/team.html';
        }
    }

    public function comment($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Afzncompany::$ctl_afzncompany_new."/pj-".$rzpscompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function pj($rzpscompany_id, $page = 1){
        if($_REQUEST['a']){
            $rzpscompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if ($items = K::M('rzpscompany/comment')->items_by_company($rzpscompany_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $rzpscompany_id,
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
        // $this->seo->set_rzpscompany($rzpscompany);
        // $this->seo->init('rzpscompany');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/rzpscompany/comment-{$rzpscompany_id}.html";
        if (empty($rzpscompany['skin']) || $rzpscompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "rzpscompany";
            $this->tmpl = 'rzpscompany/comment.html';
        } else {
            $this->tmpl = 'rzpscompany/' . $rzpscompany['skin'] . '/comment.html';
        }
    }

    public function detail_c($rzpscompany_id)
    {
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $rzpscompany['desc'] = K::M('content/html')->text($rzpscompany['info']);
        $this->pagedata['rzpscompany'] = $rzpscompany;
        $this->tmpl = 'rzpscompany/detail_c.html';
    }

    public function savecomment($rzpscompany_id = null)
    {
        $this->check_login();
        if (! ($rzpscompany_id = (int) $rzpscompany_id) && ! ($rzpscompany_id = (int) $this->GP('rzpscompany_id'))) {
            $this->error(404);
        }
        $rzpscompany = $this->check_rzpscompany($rzpscompany_id);
        $this->pagedata['rzpscompany'] = $rzpscompany;
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
                        $data['city_id'] = $rzpscompany['city_id'];
                        $data['rzpscompany_id'] = $rzpscompany_id;
                        $data['uid'] = $this->uid;
                        $data['audit'] = $allow_comment;
                        if ($comment_id = K::M('rzpscompany/comment')->create($data)) {
                            K::M('rzpscompany/comment')->comment_count($rzpscompany_id);
                            K::M('rzpscompany/comment')->comment($data);
                            $this->err->add('发表点评成功');
                        }
                    }
                }
    }

    protected function check_rzpscompany(&$company_id = null)
    {
        if (! $company_id = (int) $company_id) {
            $this->error(404);
        } else 
            if (! $company = K::M('rzpscompany/company')->detail($company_id, true)) {
                $this->error(404);
            } else 
                if (empty($company['audit']) && (empty($this->uid) || ($this->uid != $company['uid']))) {
                    $this->err->add('商铺审核中不能访问', 212);
                    $this->err->response();
                }
        $fields = K::M('rzpscompany/fields')->detail($company_id);
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
        K::M('rzpscompany/company')->update_count($company_id, 'views', 1);
        return $company;
    }
}