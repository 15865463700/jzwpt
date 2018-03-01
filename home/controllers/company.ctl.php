<?php
class Ctl_Company extends Ctl{
    public static $ctl_company_old="company";
    public static $ctl_company_new="gs";

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $system->request['uri'];
        if (preg_match('/company(-index)?-(\d+).html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index($company_id){
        $this->detail($company_id);
    }

    public function detail($company_id){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if(strpos($this->request['uri'],"ompany")){
            header("Location:/gs/{$company_id}.html");die;
        }
        $company = $this->check_company($company_id);
        $comment_list = K::M('company/comment')->items(array(
            'company_id' => $company_id,
            'audit' => '1'
        ), null, 1, 4);
        $uids = array();
        foreach ($comment_list as $k => $v) {
            $uids[$v['uid']] = $v['uid'];
        }
        if ($uids) {
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        $this->pagedata['mobile_url'] = $this->mklink('mobile/company', array(
            $company_id
        ));
        $this->pagedata['comment_list'] = $comment_list;
        $this->seo->set_company($company);
        $this->seo->init('company');
        if ($company['skin'] == 'default') {
        //开始  装修公司首页设计师
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $filter = array(
            'company_id' => $company_id,
        );
        if ($items = K::M('company/designer')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['itemss'] = $items;
        }
        $this->seo->set_company($company);
        $this->seo->init('company');
        //结束   装修公司首页设计师
       
        //评价
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if ($items = K::M('company/comment')->items_by_company($company_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
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
        
        // $access = $this->system->config->get('access');
        // $this->pagedata['comment_yz'] = $access['verifycode']['comment'];
        // $this->seo->set_company($company);
        // $this->seo->init('company');
        //评价
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/company/{$company_id}.html";
        $this->tmpl = 'company/index.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/index.html';
        }
        $this->pagedata["company"]['desc'] = K::M('content/html')->text2($this->pagedata["company"]['info']);
    }

    public function about($company_id){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        header("Location:/".Ctl_Company::$ctl_company_new."/jj-".$company_id.".html");die;
    }
    public function jj($company_id){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        $company = $this->check_company($company_id);
        $this->pagedata['photo_list'] = K::M('company/photo')->items_by_company($company_id);
        $this->seo->set_company($company);
        $this->seo->init('company');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/company/about-{$company_id}.html";
        if ($company['skin'] == 'default') {
            $this->tmpl = 'company/about.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/about.html';
        }
    }

    public function youhui($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Company::$ctl_company_new."/yh-".$company_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function yh($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter['company_id'] = $company_id;
        $filter['audit'] = 1;
        if ($items = K::M('company/youhui')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/company/youhui-{$company_id}.html";
        if ($company['skin'] == 'default') {
            $this->tmpl = 'company/youhui.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/youhui.html';
        }
    }

    public function news($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Company::$ctl_company_new."/xw-".$company_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function xw($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if ($items = K::M('company/news')->items_by_company($company_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/company/news-{$company_id}.html";
        if ($company['skin'] == 'default') {
            $this->tmpl = 'company/news.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/news.html';
        }
    }

    public function cases($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Company::$ctl_company_new."/al-".$company_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function al($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1,
            'closed' => 0
        );
        $filter['company_id'] = $company_id;
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/company/cases-{$company_id}.html";
        if ($company['skin'] == 'default') {
            $this->tmpl = 'company/cases.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/cases.html';
        }
    }

    public function site($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Company::$ctl_company_new."/gd-".$company_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function gd($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1
        );
        $filter['company_id'] = $company_id;
        if ($items = K::M('home/site')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
        }
        $this->seo->set_company($company);
        $this->seo->init('company');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/company/site-{$company_id}.html";
        if ($company['skin'] == 'default') {
            $this->tmpl = 'company/site.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/site.html';
        }
    }
    
    public function team($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Company::$ctl_company_new."/td-".$company_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function td($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $company = $this->check_company($company_id);
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $company_id,
//            'closed' => 0
        );
//        if ($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)) {
        if ($items = K::M('company/designer')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->seo->set_company($company);
        $this->seo->init('company');
        if ($company['skin'] == 'default') {
            $this->tmpl = 'company/team.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/team.html';
        }
    }

    public function comment($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Company::$ctl_company_new."/pj-".$company_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function pj($company_id, $page = 1){
        if($_REQUEST['a']){
            $company_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $company = $this->check_company($company_id);
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if ($items = K::M('company/comment')->items_by_company($company_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $company_id,
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
        $this->seo->set_company($company);
        $this->seo->init('company');
         $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/company/comment-{$company_id}.html";
        if ($company['skin'] == 'default') {
            $this->tmpl = 'company/comment.html';
        } else {
            $this->tmpl = 'company/' . $company['skin'] . '/comment.html';
        }
    }

    public function detail_c($company_id)
    {
        $company = $this->check_company($company_id);
        $company['desc'] = K::M('content/html')->text($company['info']);
        $this->pagedata['company'] = $company;
        $this->tmpl = 'company/detail_c.html';
    }

    public function savecomment($company_id = null){
        $this->check_login();
        if (! ($company_id = (int) $company_id) && ! ($company_id = (int) $this->GP('company_id'))) {
            $this->error(404);
        }
        $company = $this->check_company($company_id);
        $count= K::M('tenders/tenders')->count(array("uid"=>$this->MEMBER['uid'],"status"=>2,"sign_company_id"=>$company_id,"audit"=>1,));
        $allow_comment = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_score');
        if($count<=0){
             $this->err->add('只有与该装修公司签单的业主才能评论！', 333);
        }else if ($allow_comment < 0) {
             $this->err->add('您现在没有权限发表点评', 333);
        } else{
            if (! $data = $this->checksubmit('data')) {
                $this->err->add('非法的数据提交', 211);
            } else{
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
                        $data['city_id'] = $company['city_id'];
                        $data['company_id'] = $company_id;
                        $data['uid'] = $this->uid;
                        $data['audit'] = $allow_comment;
                        if ($comment_id = K::M('company/comment')->create($data)) {
                            K::M('company/comment')->comment_count($company_id);
                            K::M('company/comment')->comment($data);
                            $this->err->add('发表点评成功');
                        }
                    }
                }
            }
        }
    }
}