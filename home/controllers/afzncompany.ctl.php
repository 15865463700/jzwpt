<?php
class Ctl_Afzncompany extends Ctl{
    public static $ctl_afzncompany_old="afzncompany";
    public static $ctl_afzncompany_new="afzn";

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $system->request['uri'];
        if (preg_match('/afzncompany(-index)?-(\d+).html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index($afzncompany_id)
    {
        $this->detail($afzncompany_id);
    }

    public function detail($afzncompany_id)
    {
        if($_REQUEST["a"]){
            $afzncompany_id=$_REQUEST["a"];
        }
        if(strpos($this->request['uri'],"ompany")){
            header("Location:/afzn/{$afzncompany_id}.html");die;
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);

        $this->pagedata['afzncompany'] = $afzncompany;
        $comment_list = K::M('afzncompany/comment')->items(array(
            'afzncompany_id' => $afzncompany_id,
            'audit' => '1'
        ), null, 1, 4);
        
        $uids = array();
        foreach ($comment_list as $k => $v) {
            $uids[$v['uid']] = $v['uid'];
        }
        if ($uids) {
            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        }
        // $this->pagedata['mobile_url'] = $this->mklink('mobile/afzncompany', array($afzncompany_id));
        // $this->pagedata['comment_list'] = $comment_list;
        // $this->seo->set_afzncompany($afzncompany);
		
        $this->seo->set_company($afzncompany);
        $this->seo->init('afzncompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/afzncompany/{$afzncompany_id}.html";

//        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/index.html'; 
//       } else {
//            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/index.html';
//        }
    }

    public function about($afzncompany_id){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        header("Location:/".Ctl_Afzncompany::$ctl_afzncompany_new."/jj-".$afzncompany_id.".html");die;
    }
    public function jj($afzncompany_id){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
        // $this->pagedata['photo_list'] = K::M('afzncompany/photo')->items_by_afzncompany($afzncompany_id);
        // $this->seo->set_afzncompany($afzncompany);
        // $this->seo->init('afzncompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/afzncompany/about-{$afzncompany_id}.html";
        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/about.html';
        } else {
            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/about.html';
        }
    }

    public function youhui($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc= Ctl_Afzncompany::$ctl_afzncompany_new."/yh-".$afzncompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function yh($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter['afzncompany_id'] = $afzncompany_id;
        $filter['audit'] = 1;
        if ($items = K::M('afzncompany/youhui')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $afzncompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_afzncompany($afzncompany);
        // $this->seo->init('afzncompany');
        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/youhui.html';
        } else {
            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/youhui.html';
        }
    }

    public function news($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Afzncompany::$ctl_afzncompany_new."/xw-".$afzncompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function xw($afzncompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $items = K::M('afzncompany/news')->items_by_company($afzncompany_id, $page, $limit, $count);
        if ($items) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $afzncompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_afzncompany($afzncompany);
        // $this->seo->init('afzncompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/afzncompany/news-{$afzncompany_id}.html";
        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/news.html';
        } else {
            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/news.html';
        }
    }

    public function cases($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Afzncompany::$ctl_afzncompany_new."/al-".$afzncompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function al($afzncompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 12;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1,
            'closed' => 0
        );
        $filter['company_id'] = $afzncompany_id;
        if ($items = K::M('afzncase/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $afzncompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_afzncompany($afzncompany);
        // $this->seo->init('afzncompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/afzncompany/cases-{$afzncompany_id}.html";
        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/cases.html';
        } else {
            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/cases.html';
        }
    }

    public function site($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=Ctl_Afzncompany::$ctl_afzncompany_new."/gd-".$afzncompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function gd($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'audit' => 1
        );
        $filter['afzncompany_id'] = $afzncompany_id;
        if ($items = K::M('home/site')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $afzncompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
        }
        // $this->seo->set_afzncompany($afzncompany);
        // $this->seo->init('afzncompany');
        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/site.html';
        } else {
            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/site.html';
        }
    }

    public function team($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Afzncompany::$ctl_afzncompany_new."/td-".$afzncompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function td($afzncompany_id = 0, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $afzncompany_id,
            'company_type' => 6,
            'closed' => 0
        );
        if ($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $afzncompany_id,
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        // $this->seo->set_afzncompany($afzncompany);
        // $this->seo->init('afzncompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/afzncompany/team-{$afzncompany_id}.html";
        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/team.html';
        } else {
            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/team.html';
        }
    }

    public function comment($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $loc=  Ctl_Afzncompany::$ctl_afzncompany_new."/pj-".$afzncompany_id;
        if($page>1){
            $loc.="-".$page;
        }
        header("Location:/{$loc}.html");die;
    }
    public function pj($afzncompany_id, $page = 1){
        if($_REQUEST['a']){
            $afzncompany_id=$_REQUEST['a'];
        }
        if($_REQUEST['c']){
            $page=$_REQUEST['c'];
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 9;
        $pager['count'] = $count = 0;
        if ($items = K::M('afzncompany/comment')->items_by_company($afzncompany_id, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $afzncompany_id,
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
        // $this->seo->set_afzncompany($afzncompany);
        // $this->seo->init('afzncompany');
         $this->pagedata['canonical']="{$_SERVER['HTTP_HOST']}/afzncompany/comment-{$afzncompany_id}.html";
        if (empty($afzncompany['skin']) || $afzncompany['skin'] == 'default') {
            $this->pagedata['skin_theme'] = "afzncompany";
            $this->tmpl = 'afzncompany/comment.html';
        } else {
            $this->tmpl = 'afzncompany/' . $afzncompany['skin'] . '/comment.html';
        }
    }

    public function detail_c($afzncompany_id)
    {
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $afzncompany['desc'] = K::M('content/html')->text($afzncompany['info']);
        $this->pagedata['afzncompany'] = $afzncompany;
        $this->tmpl = 'afzncompany/detail_c.html';
    }

    public function savecomment($afzncompany_id = null)
    {
        $this->check_login();
        if (! ($afzncompany_id = (int) $afzncompany_id) && ! ($afzncompany_id = (int) $this->GP('afzncompany_id'))) {
            $this->error(404);
        }
        $afzncompany = $this->check_afzncompany($afzncompany_id);
        $this->pagedata['afzncompany'] = $afzncompany;
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
                        $data['city_id'] = $afzncompany['city_id'];
                        $data['company_id'] = $afzncompany_id;
                        $data['uid'] = $this->uid;
                        $data['audit'] = $allow_comment;
                        if ($comment_id = K::M('afzncompany/comment')->create($data)) {
                            K::M('afzncompany/comment')->comment_count($afzncompany_id);
                            K::M('afzncompany/comment')->comment($data);
                            $this->err->add('发表点评成功');
                        }
                    }
                }
    }

    protected function check_afzncompany(&$company_id = null)
    {
        if (! $company_id = (int) $company_id) {
            $this->error(404);
        } else 
            if (! $company = K::M('afzncompany/company')->detail($company_id, true)) {
                $this->error(404);
            } else 
                if (empty($company['audit']) && (empty($this->uid) || ($this->uid != $company['uid']))) {
                    $this->err->add('商铺审核中不能访问', 212);
                    $this->err->response();
                }
        $fields = K::M('afzncompany/fields')->detail($company_id);
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
        K::M('afzncompany/company')->update_count($company_id, 'views', 1);
        return $company;
    }
}