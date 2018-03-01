<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Article extends Ctl_Mobile
{

    public function index($status = 0, $type_id = 0, $way_id = 0, $order = 0, $page = null)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        $filter['from'] = 'article';
        $tree = K::M('article/cate')->tree('article');
        foreach ($tree as $k => $v) {
            if ($k == '8') {
                foreach ($v as $kk => $vv) {
                    $article = $vv;
                }
            }
        }
        // foreach($article as $k => $v){
        // $article[$k]['c'] = K::M('article/cate')->children_ids($v['cat_id']);
        // }
        $this->pagedata['article'] = $article;
        $pager['backurl'] = $this->mklink('mobile');
        $this->pagedata['pager'] = $pager;
        $this->seo->init('article');
        //日记
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
        $pager['limit'] = $limit = 2;
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
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('mobile/diary:index', array(
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
        //日记
        $this->tmpl = 'mobile/article/index.html';
    }

    public function items($cate_id, $page = 1){
        if (! $cate_id = (int) $cate_id) {
            $this->error(404);
        } else 
            if (! $cate = K::M('article/cate')->detail($cate_id)) {
                $this->error(404);
            } else {
                $filter = $pager = array();
                $pager['page'] = max(intval($page), 1);
                $pager['limit'] = $limit = 6;
                $pager['count'] = $count = 0;
                $filter['city_id'] = array(
                    0,
                    $this->request['city_id']
                );
                $filter['audit'] = 1;
                $filter['closed'] = 0;
                if ($cat_ids = K::M('article/cate')->children_ids($cate_id)) {
                    $filter['cat_id'] = explode(',', $cat_ids);
                }
                if ($items = K::M('article/article')->items($filter, null, $page, $limit, $count)) {
                    $pager['count'] = $count;
                    $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                        $cate_id,
                        '{page}'
                    )));
                    $this->pagedata['items'] = $items;
                }
                $pager['backurl'] = $this->mklink('mobile/article');
                $this->pagedata['pager'] = $pager;
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
                $tree = K::M('article/cate')->tree('article');
                foreach ($tree as $k => $v) {
                    if ($k == '8') {
                        foreach ($v as $kk => $vv) {
                            $article = $vv;
                        }
                    }
                }
                
                $this->pagedata['cate'] = $cate;
                $this->pagedata['article'] = $article;
                $this->seo->init('article_items', $seo);
                $this->tmpl = 'mobile/article/items.html';
            }
    }
//    public function detail($article_id){
//        if (! ($article_id = (int) $article_id) && ! ($article_id = (int) $this->GP('article_id'))) {
//            $this->error(404);
//        } else
//            if (! $detail = K::M('article/article')->detail($article_id)) {
//                $this->error(404);
//            } else
//                if (! $cate = K::M('article/cate')->cate($detail['cat_id'])) {
//                    $this->error(404);
//                } else
//                    if (! $detail['audit']) {
//                        $this->err->add('内容审核中,不能查看！', 212);
//                    } else
//                        if ($detail['ontime'] && $detail['ontime'] > __TIME) {
//                            $this->err->add('文章还未发布，暂时不可访问', 212);
//                        } else {
//                            K::M('article/article')->update_count($article_id, 'views', 1);
//                            if ($detail['linkurl']) {
//                                header("Location:" . $detail['linkurl']);
//                                exit();
//                            }
//                            $filter['article_id'] = "<>:" . $detail['article_id'];
//                            $filter['cat_id'] = $detail['cat_id'];
//                            $this->pagedata['items'] = K::M('article/article')->items($filter, null, 1, 5);
//                            $this->pagedata['detail'] = $detail;
//                            $this->pagedata['content'] = K::M('article/content')->detail($detail['article_id']);
//                            $pager = array();
//                            $pager['backurl'] = $this->mklink('mobile/article:items', array(
//                                'cat_id' => $detail['cat_id']
//                            ));
//                            $this->pagedata['pager'] = $pager;
//                            $seo = array(
//                                'title' => $detail['title'],
//                                'article_desc' => $detail['desc'],
//                                'cate_title' => $cate['title'],
//                                'cate_name' => $cate['title'],
//                                'page' => ($page > 1) ? $page : ''
//                            );
//                            $this->seo->init('article_detail', $seo);
//                            if ($seo_title = $detail['seo_title']) {
//                                $this->seo->set_title($seo_title);
//                            }
//                            if ($seo_description = $detail['seo_description']) {
//                                $this->seo->set_description($seo_description);
//                            }
//                            if ($seo_keywords = $detail['seo_keywords']) {
//                                $this->seo->set_keywords($seo_keywords);
//                            }
//                            if ($comment_list = K::M('article/comment')->items(array(
//                                'article_id' => $article_id,
//                                'closed' => 0
//                            ), array(
//                                'comment_id' => 'DESC'
//                            ), 1, 5)) {
//                                $uids = array();
//                                foreach ($comment_list as $k => $v) {
//                                    $uids[$v['uid']] = $v['uid'];
//                                }
//                                if ($uids) {
//                                    $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
//                                }
//                                $this->pagedata['comment_list'] = $comment_list;
//                            }
//                            $this->tmpl = 'mobile/article/detail.html';
//                        }
//    }
    public function detail($article_id, $page = 1, $t = 0) {
        if(strpos(strtolower($_SERVER['REQUEST_URI']), '-detail-')>-1){
            $loc="http://{$_SERVER['HTTP_HOST']}".preg_replace('/\w+-detail-/', 'zxgl/', $_SERVER['REQUEST_URI']);
            if(!strpos(strtolower($loc), ".htm")){
                $loc.=".html";
            }
            header("Location: {$loc}");
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
        } else
            if (!$detail = K::M('article/article')->detail($article_id)) {
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
                                    if ($detail['city_id'] && ($detail['city_id'] != $this->request['city_id'])) {
                                        $cfg = $this->system->config->get('site');
                                        if ($cfg['multi_city'] && ($city = K::M('data/city')->city($detail['city_id']))) {
                                            $this->system->response_code(301);
                                            header("Location:" . $this->mklink("article:detail", array(
                                                    $article_id
                                                ), null, $detail['city_id']));
                                            exit();
                                        }
                                    }
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
                            $this->tmpl = 'mobile/article/detail.html';
                        }
                    }

                }
    }
    public function xzx(){
        $this->pagedata['items8'] = $this->bb(8);
        $this->pagedata['items106'] = $this->bb(106);
        $this->pagedata['items107'] = $this->bb(107);
        $this->pagedata['items133'] = $this->bb(133);
        $this->tmpl = 'mobile/article/xzx.html';
    }
    public function bb($cat_id=0){
        if ($_REQUEST['p']) {
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
        $filter['city_id'] = array(
            0,
            $this->request['city_id']
        );
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
        $pager['limit'] = $limit = 3;
        $pager['count'] = $count = 0;
        if ($items = K::M('article/article')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            foreach ($items as $k => $v) {
                if ($t) {
                    $items[$k]['link'] = str_replace("/article-detail-", "/zxgl/", $v['link']);
                    $items[$k]['link'] = str_replace("-1.", ".", $items[$k]['link']);
                }
            }
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $cat_id,
                '{page}'
            ), $params));
            if ($t) {
                if (!is_numeric($_REQUEST['cat_id'])) {
                    $pager['pagebar'] = preg_replace("/article-items-([0-9]*)/", "zxgl/{$_REQUEST['cat_id']}", $pager['pagebar']);
                }
                $pager['pagebar'] = str_replace("-1.", ".", $pager['pagebar']);
                $pager['pagebar'] = str_replace(".html", "/", $pager['pagebar']);
            }
            return $items;
        }
    }

    public function zxlc($cat_id,$page = 1){
        if ($_REQUEST['p']) {
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
        $filter['city_id'] = array(
            0,
            $this->request['city_id']
        );
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
                    $items[$k]['link'] = str_replace("/article-detail-", "/zxgl/", $v['link']);
                    $items[$k]['link'] = str_replace("-1.", ".", $items[$k]['link']);
                }
            }
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $cat_id,
                '{page}'
            ), $params));
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
        $this->tmpl = 'mobile/article/zxlc.html';
    }
    public function savecomment() {
        if($this->uid<=0){
            $this->err->add('登录后才能进行评论', 201);
        }else
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