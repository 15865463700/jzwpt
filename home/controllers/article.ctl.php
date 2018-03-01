<?php

if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Article extends Ctl {
    
    public function __construct(&$system)
    {
        parent::__construct($system);
        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
    }

    public function index() {
        $this->seo->init('article');
        $this->tmpl = 'article/index.html';
    }

    public function items($cat_id=0, $page = 1, $t = 0) {
        $sokw = trim($this->GP('kw'));
        if ($_REQUEST['cat_id']) {
            $cat_id = $_REQUEST['cat_id'];
        }
        if ($_REQUEST['cate_id']) {
            $cat_id = $_REQUEST['cate_id'];
        }
        if (!$cate = K::M('article/cate')->cate($cat_id)) {
                $this->error(404);
        }
        if (is_numeric($_REQUEST['cat_id'])||$cat_id>0) {
            header("location:/zxgl/{$cate["py"]}/");die;
        }
        if(strpos("{$_SERVER['REQUEST_URI']}/","//")>-1){
        }else{
            header("location:{$_SERVER['REQUEST_URI']}/");
        }
        $cat_id = $cate["cat_id"];
        if ($_REQUEST['p']) {
            $page = $_REQUEST['p'];
        }
        if ($_REQUEST['per']) {
            $page = $_REQUEST['per'];
        }
        if ($_REQUEST['t']) {
            $t = $_REQUEST['t'];
            switch ($t) {
                case 1:
                    $this->pagedata['ctl'] = "zxgl";
                    break;
                case 2:
                    $this->pagedata['ctl'] = "xzx";
                    break;
            }
        }
        if (!($cat_id = (int) $cat_id) && empty($sokw)) {
            $this->error(404);
        }
        $pager = $filter = $params = array();
        $filter = array(
            'audit' => 1,
            'hidden' => '0',
            'closed' => 0,
            'ontime' => '<:' . __TIME
        );
//        $filter['city_id'] = array(
//            0,
//            $this->request['city_id']
//        );
        if ($cat_id) {
            if (!$cate = K::M('article/cate')->cate($cat_id)) {
                $this->error(404);
            } else
            if ('article' != $cate['from']) {
                $this->error(404);
            }
            $top_cate = $cate;
            $filter['cat_id'] = $cat_id;
            if ($cate['level'] == 3) {
                $this->pagedata['childrens'] = K::M('article/cate')->childrens($cate['parent_id']);
            } else {
                if ($cat_ids = K::M('article/cate')->children_ids($cat_id)) {
                    $filter['cat_id'] = explode(',', $cat_ids);
                }
                if (!$childrens = K::M('article/cate')->childrens($cat_id)) {
                    if ($cate['level'] > 1) {
                        $childrens = K::M('article/cate')->childrens($cate['parent_id']);
                    }
                }
                $this->pagedata['childrens'] = $childrens;
            }
            if ($cate['level'] > 1) {
                $top_cate = K::M('article/cate')->cate($cate['parent_id']);
            }
            $this->pagedata['top_cate'] = $top_cate;
            $this->pagedata['cate'] = $cate;
        }
        if ($sokw) {
            $pager['sokw'] = $sokw = htmlspecialchars($sokw);
            $filter['title'] = "LIKE:%{$sokw}%";
            $params['kw'] = $sokw;
        }
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        if ($items = K::M('article/article')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            foreach ($items as $k => $v) {
                if ($t) {
                    $items[$k]['dateline_format']=date("Y-m-d",$items[$k]['dateline']);
                    $items[$k]['link'] = str_replace("/article-detail-", "/zxgl/", $v['link']);
                    $items[$k]['link'] = str_replace("-1.", ".", $items[$k]['link']);
                    $items[$k]['link'] = preg_replace("/.*\.jzwpt\.com/", "http://www.jzwpt.com", $items[$k]['link']);
                }
            }
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                        $cat_id,
                        '{page}'
                            ), $params));
            $pager['pagebar']=  str_replace($this->request['city']['siteurl'], $this->request['url'],$pager['pagebar']);
            if ($t) {
                if (!is_numeric($_REQUEST['cat_id'])) {
                    $pager['pagebar'] = preg_replace("/article-items-([0-9]*)/", "zxgl/{$_REQUEST['cat_id']}", $pager['pagebar']);
                }
                $pager['pagebar'] = str_replace("-1.", ".", $pager['pagebar']);
                $pager['pagebar'] = str_replace(".html", "/", $pager['pagebar']);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->pagedata['t'] = $t;
        $seo = array(
            'cate_name' => '',
            'cate_seo_title' => '',
            'cate_seo_keywords' => '',
            'cate_seo_description' => '',
            'page' => (($page > 1) ? $page : '')
        );
        if ($cate) {
            $seo['cate_title'] = $seo['cate_name'] = $cate['title'];
            $seo['cate_seo_title'] = $cate['seo_title'];
            $seo['cate_seo_keywords'] = $cate['seo_keywords'];
            $seo['cate_seo_description'] = $cate['seo_description'];
        } else
        if ($sokw) {
            $seo['cate_name'] = $sokw;
        }
        $this->seo->init('article_items', $seo);
        $this->pagedata['canonical'] = "www.jzwpt.com/{$_SERVER['REQUEST_URI']}/";
        $this->pagedata['canonical'] = preg_replace("/\d*/", "", $this->pagedata['canonical']);
        $this->pagedata['canonical'] = str_replace("-", "", $this->pagedata['canonical']);
        $this->pagedata['canonical'] = str_replace("//", "/", $this->pagedata['canonical']);

        if($_POST){
            die(json_encode(array(
                "items"=>$items,
                "pi"=>$_REQUEST['pi'],
                "ps"=>$page,
            )));
        }
        $this->tmpl = 'article/items.html';
    }
    
    public function rows($cat_id=0,$page=1,$t=0){
        $pager = $filter = $params = array();
        $filter = array(
            'audit' => 1,
            'hidden' => '0',
            'closed' => 0,
//            'ontime' => '<:' . __TIME
        );
//        $filter['city_id'] = array(
//            0,
//            $this->request['city_id']
//        );
            $cates = K::M('article/cate')->children_ids($cat_id);
            $count=0;
            $ps=6;
            $rs = ($page-1)*$ps;
            $items=K::M('article/article')->items_by_cate_page($cates,$page,0,"article_id desc",$count,"{$rs},{$ps}");
            foreach($items as $k=>$v){
                $items[$k]['dateline_format']=date("Y-m-d",$v['dateline']);
            }
            $pc=ceil($count*1.0/$ps);
            if($page<$pc){
                $this->err->set_data('p',++$page);
            }
            $this->err->set_data('items', $items);
            $this->err->set_data('ps', $ps);
            $this->err->set_data('pc', $pc);
            $this->err->json();
    }

    public function detail($article_id, $page = 1, $t = 0) {
        if(strpos(strtolower($_SERVER['REQUEST_URI']), '-detail-')>-1){
//            $loc="http://{$_SERVER['HTTP_HOST']}".preg_replace('/\w+-detail-/', 'zxgl/', $_SERVER['REQUEST_URI']);
            $loc="http://www.jzwpt.com".preg_replace('/\w+-detail-/', 'zxgl/', $_SERVER['REQUEST_URI']);
            if(!strpos(strtolower($loc), ".htm")){
                $loc.=".html";
            }
            header("Location: {$loc}");die;
        }
        if(strpos(strtolower($_SERVER['REQUEST_URI']), '-1.')>-1){
            $loc="http://{$_SERVER['HTTP_HOST']}".str_replace('-1.', '.', $_SERVER['REQUEST_URI']);
            header("Location: {$loc}");
        }
        if (!empty($_REQUEST['id'])) {
            $article_id = $_REQUEST['id'];
        }
        if (!empty($_REQUEST['p'])) {
            $page = $_REQUEST['p'];
        }
        if ($_REQUEST['t']) {
            $t = $_REQUEST['t'];
                    switch ($t) {
                        case 1:
                    $this->pagedata['ctl'] = "zxgl";
                    break;
                case 2:
                    $this->pagedata['ctl'] = "xzx";
                    break;
            }
        }
        if (!$article_id = (int) $article_id) {
            $this->error(404);
        } else if (in_array($article_id,array(2481,))) {
            $this->error(404);
        } else
        if (!$detail = K::M('article/article')->detail($article_id)) {
            $this->error(404);
        }else if($detail['closed']){
            $this->error(404);
        } else
        if (!$cate = K::M('article/cate')->cate($detail['cat_id'])) {
            $this->error(404);
        } else{
            if (empty($detail['audit'])) {
                $this->err->add('文章审核中，暂时不可访问', 211);
            } else{
                $cats=K::M('article/cate')->children_ids(80);
                $arr=explode(",",$cats);
                if(in_array($detail['cat_id'],$arr)){
                    header("location:/xw/{$article_id}.html");die;
                }
                if ($detail['ontime'] && $detail['ontime'] > __TIME) {
                    $this->err->add('文章还未发布，暂时不可访问', 212);
                } else {
                    K::M('article/article')->update_count($article_id, 'views', 1);
                    if ($detail['linkurl']) {
                        header("Location:" . $detail['linkurl']);
                        exit();
                    } else{
                        if ($detail['from'] != 'article') {
                            $this->error(404);
                        } else{
//                            if ($detail['city_id'] && ($detail['city_id'] != $this->request['city_id'])) {
//                                $cfg = $this->system->config->get('site');
//                                if ($cfg['multi_city'] && ($city = K::M('data/city')->city($detail['city_id']))) {
//                                    $this->system->response_code(301);
//                                    header("Location:" . $this->mklink("article:detail", array(
//                                            $article_id
//                                        ), null, $detail['city_id']));
//                                    exit();
//                                }
//                            }
                        }

                    }
                    if ($page == 'all') {
                        $curr_content = $detail['content'];
                    } else {
                        $page = max((int) $page, 1);
                        $offset = $page - 1;
                        if (!$curr_content = $detail['content_list'][$offset]) {
                            $this->error(404);
                        }
                        $detail['curr_content'] = $curr_content;
                    }
                    $pager = array(
                        'page' => $page
                    );
                    $pager['count'] = $detail['content_count'];
                    $pager['prev'] = K::M('article/article')->prev_item($article_id);
                    $pager['next'] = K::M('article/article')->next_item($article_id);

                    if ($t) {
                        switch ($t) {
                            case 1:
                                if ($pager['prev'] && $pager['prev']['link']) {
                                    $pager['prev']['link'] = str_replace("/article-detail-", "/zxgl/", $pager['prev']['link']);
                                    $pager['prev']['link'] = str_replace("-1.", ".", $pager['prev']['link']);
                                }
                                if ($pager['next'] && $pager['next']['link']) {
                                    $pager['next']['link'] = str_replace("/article-detail-", "/zxgl/", $pager['next']['link']);
                                    $pager['next']['link'] = str_replace("-1.", ".", $pager['next']['link']);
                                }
                                break;
                            case 2:
                                if ($pager['prev'] && $pager['prev']['link']) {
                                    $pager['prev']['link'] = str_replace("/article-detail-", "/xzx/", $pager['prev']['link']);
                                    $pager['prev']['link'] = str_replace("-1.", ".", $pager['prev']['link']);
                                }
                                if ($pager['next'] && $pager['next']['link']) {
                                    $pager['next']['link'] = str_replace("/article-detail-", "/xzx/", $pager['next']['link']);
                                    $pager['next']['link'] = str_replace("-1.", ".", $pager['next']['link']);
                                }
                                break;
                        }
                    }

                    if ($comment_list = K::M('article/comment')->items(array(
                        'article_id' => $article_id,
                        'closed' => 0
                    ), array(
                        'comment_id' => 'DESC'
                    ), 1, 5)) {
                        $uids = array();
                        foreach ($comment_list as $k => $v) {
                            $uids[$v['uid']] = $v['uid'];
                        }
                        if ($uids) {
                            $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
                        }
                        $this->pagedata['comment_list'] = $comment_list;
                    }
                    $access = $this->system->config->get('access');
                    $this->pagedata['comment_yz'] = $access['verifycode']['comment'];
                    $this->pagedata['pager'] = $pager;
                    $this->pagedata['t'] = $t;
                    $this->pagedata['cate'] = $cate;
                    $this->pagedata['detail'] = $detail;
                    $seo = array(
                        'title' => $detail['title'],
                        'article_desc' => $detail['desc'],
                        'cate_title' => $cate['title'],
                        'cate_name' => $cate['title'],
                        'page' => ($page > 1) ? $page : ''
                    );
                    $this->seo->init('article_detail', $seo);
                    if ($seo_title = $detail['seo_title']) {
                        $this->seo->set_title($seo_title);
                    }
                    if ($seo_description = $detail['seo_description']) {
                        $this->seo->set_description($seo_description);
                    }
                    if ($seo_keywords = $detail['seo_keywords']) {
                        $this->seo->set_keywords($seo_keywords);
                    }
                    $this->pagedata['mobile_url'] = $this->mklink('mobile/article:detail', array(
                        $article_id
                    ));
                    $this->pagedata['canonical'] = "www.jzwpt.com/zxgl/{$article_id}.html";
                    $this->tmpl = 'article/detail.html';
                }
            }

        }
    }

    public function comments($article_id, $page = 1) {
        
    }

    public function savecomment() {
        $this->check_login();
        if (!$article_id = (int) $this->GP('article_id')) {
            $this->error(404);
        } else
        if (!$detail = K::M('article/article')->detail($article_id)) {
            $this->err->add('文章不存在或已经删除', 212);
        } else
        if (!$content = $this->GP('content')) {
            $this->err->add('至少说点什么吧！', 212);
        } else {
            $verifycode_success = true;
            $access = $this->system->config->get('access');
            if ($access['verifycode']['comment']) {
                if (!$verifycode = $this->GP('verifycode')) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确', 212);
                } else
                if (!K::M('magic/verify')->check($verifycode)) {
                    $verifycode_success = false;
                    $this->err->add('验证码不正确', 212);
                }
            }
            if ($verifycode_success) {
                $data = array(
                    'article_id' => $article_id,
                    'uid' => $this->uid,
                    'content' => $content
                );
                if (K::M('article/comment')->create($data)) {
                    K::M('article/article')->update_count($article_id, 'comments', 1);
                    $this->err->add('评论发表成功！');
                }
            }
        }
    }

}
