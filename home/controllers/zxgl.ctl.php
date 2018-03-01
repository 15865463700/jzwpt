<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Zxgl extends Ctl {
    
    public function __construct(&$system)
    {
        parent::__construct($system);
        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
    }

    public function index() {
        $this->seo->init('zxgl');
        $this->pagedata['canonical'] = "www.jzwpt.com/zxgl/";
        $this->tmpl = 'zxgl/index.html';
    }

    public function items($cat_id, $page = 1) {
        $sokw = trim($this->GP('kw'));
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
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                        $cat_id,
                        '{page}'
                            ), $params));
            $pager['pagebar']=  str_replace($this->request['city']['siteurl'], $this->request['url'],$pager['pagebar']);
            $this->pagedata['items'] = $items;
        }
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
        $this->seo->init('zxgl_items', $seo);
        $this->tmpl = 'article/items.html';
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
