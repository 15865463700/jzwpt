<?php

class Ctl_Xw extends Ctl {
    
    public function __construct(&$system)
    {
        parent::__construct($system);
        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
    }

    public function index($cat_id = 80, $page = 1) {
//        $this->album($page);
        $this->items($cat_id, $page);
    }

    public function items($cat_id = 80, $page = 1) {
        if ($_REQUEST["a"]) {
            $page = $_REQUEST["a"];
        }
//        $sokw = trim($this->GP('kw'));
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
            } else {
//                if ('article' != $cate['from']) {
//                    $this->error(404);
//                }
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
            $pager['pagebar'] = preg_replace("/xw-items-([0-9]*)/", "xw", $pager['pagebar']);
            $pager['pagebar'] = preg_replace("/xw-index-([0-9]*)/", "xw", $pager['pagebar']);
            $pager['pagebar'] = str_replace("-1.", ".", $pager['pagebar']);
            $pager['pagebar'] = str_replace(".html", "/", $pager['pagebar']);
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
//        $seo = array(
//            'cate_name' => '',
//            'cate_seo_title' => '',
//            'cate_seo_keywords' => '',
//            'cate_seo_description' => '',
//            'page' => (($page > 1) ? $page : '')
//        );
        $this->seo->init('xw_items');
        if ($seo_title = $cate['seo_title']) {
            $this->seo->set_title($seo_title);
        }
        if ($seo_description = $cate['seo_description']) {
            $this->seo->set_description($seo_description);
        }
        if ($seo_keywords = $cate['seo_keywords']) {
            $this->seo->set_keywords($seo_keywords);
        }
        $this->pagedata['canonical'] = "www.jzwpt.com/xw/";
        $this->tmpl = 'xw/items.html';
    }

    public function album($page = 1) {
        $pager = $filter = $attrs = $attr_ids = $attr_vids = $attr_value_ids = $attr_value_titles = array();
        $order = 0;
        $attr_values = K::M('data/attr')->attrs_by_from('zx:xw');
        $uri = $this->request['uri'];
        if (preg_match('/album(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)) {
            $page = (int) $m[3];
            if ($m[1]) {
                $attr_vids = explode('-', trim($m[1], '-'));
                $order = $attr_vids ? array_pop($attr_vids) : 0;
            }
        }
        foreach ($attr_values as $k => $v) {
            if ($v['filter']) {
                $attr_value_ids[$k] = 0;
                foreach ($attr_vids as $vv) {
                    if ($v['values'][$vv]) {
                        $attr_value_ids[$k] = $vv;
                        $attr_ids[$k] = $vv;
                        $attrs[$k] = $v['values'][$vv];
                        $attr_value_titles[$k] = $v['values'][$vv]['title'];
                    }
                }
            }
        }
        $attr_vids = $attr_ids;
        foreach ($attr_values as $k => $v) {
            $vids = $attr_value_ids;
            $vids[$k] = 0;
            $vids['order'] = $order;
            $vids['page'] = 1;
            $v['link'] = $this->mklink('xw:album', array(
                implode('-', $vids)
            ));
            $v['checked'] = true;
            foreach ($v['values'] as $kk => $vv) {
                $vv['checked'] = false;
                if (in_array($kk, $attr_ids)) {
                    $v['checked'] = false;
                    $vv['checked'] = true;
                }
                $vids[$k] = $kk;
                $vv['link'] = $this->mklink('xw:album', array(
                    implode('-', $vids)
                ));
                $v['values'][$kk] = $vv;
            }
            $attr_values[$k] = $v;
        }
        $order_list = array(
            0 => array(
                'title' => '今日推荐'
            ),
            1 => array(
                'title' => '最受欢迎 '
            ),
            2 => array(
                'title' => '人气排行'
            )
        );
        $order_list[0]['link'] = $this->mklink('xw:album', array(
            implode('-', $attr_value_ids),
            0,
            1
        ));
        $order_list[1]['link'] = $this->mklink('xw:album', array(
            implode('-', $attr_value_ids),
            1,
            1
        ));
        $order_list[2]['link'] = $this->mklink('xw:album', array(
            implode('-', $attr_value_ids),
            2,
            1
        ));
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['city_id'] = array(
            $this->request['city_id'],
            0
        );
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if ($attr_ids) {
            $filter['attrs'] = $attr_ids;
        }
        if ($kw = $this->GP('kw')) {
            $pager['sokw'] = $kw = htmlspecialchars($kw);
            $params['kw'] = $kw;
            $filter['title'] = "LIKE:%{$kw}%";
        }
        if ($order == 2) {
            $orderby = array(
                'likes' => 'DESC'
            );
        } else
        if ($order == 1) {
            $orderby = array(
                'views' => 'DESC'
            );
        } else {
            $orderby = NULL;
        }
        if ($items = K::M('xw/xw')->items($filter, $orderby, $page, $limit, $count)) {
            $lastphotos = array();
            foreach ($items as $k => $val) {
                if ($val['lastphotos']) {
                    $lastphotos[] = $val['lastphotos'];
                    $items[$k]['lastphotos'] = explode(',', $val['lastphotos']);
                }
            }
            if (!empty($lastphotos)) {
                $lastphotos = join(',', $lastphotos);
                $this->pagedata['photos'] = K::M('xw/photo')->items_by_ids($lastphotos);
            }
            $this->pagedata['items'] = $items;
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('xw:album', array(
                        implode('-', $attr_value_ids),
                        $order,
                        '{page}'
                            ), $params));
        }
        $this->pagedata['attr_values'] = $attr_values;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['pager'] = $pager;
        $seo = array(
            'attr' => '',
            'page' => ''
        );
        if ($attr_value_titles) {
            $seo['attr'] = implode('_', $attr_value_titles);
        }
        if ($page > 1) {
            $seo['page'] = $page;
        }
        $this->seo->init('xw', $seo);
        $this->tmpl = 'xw/album.html';
    }

    public function detail($article_id, $page = 1) {
        strpos(strtolower($_SERVER['REQUEST_URI']), '-detail-') > -1 ? header("Location: http://{$_SERVER['HTTP_HOST']}" . preg_replace('/\w+-detail-/', 'xw/', $_SERVER['REQUEST_URI'])) : "";

        if ($_REQUEST["a"]) {
            $article_id = $_REQUEST["a"];
        }
        if ($_REQUEST["b"]) {
            $page = $_REQUEST["b"];
        }
        if (!$article_id = (int) $article_id) {
            $this->error(404);
        } else{
            if (!$detail = K::M('article/article')->detail($article_id)) {
                $this->error(404);
            } else{
                $cats=K::M('article/cate')->children_ids(80);
                $arr=explode(",",$cats);
                if(!in_array($detail['cat_id'],$arr)){
                    header("location:/zxgl/{$article_id}.html");die;
                }
                if (!$cate = K::M('article/cate')->cate($detail['cat_id'])) {
                    $this->error(404);
                } else{
                    if (empty($detail['audit'])) {
                        $this->err->add('文章审核中，暂时不可访问', 211);
                    } else{
                        if ($detail['ontime'] && $detail['ontime'] > __TIME) {
                            $this->err->add('文章还未发布，暂时不可访问', 212);
                        } else {
                            K::M('article/article')->update_count($article_id, 'views', 1);
                            if ($detail['linkurl']) {
                                header("Location:" . $detail['linkurl']);
                                exit();
                            } else
                                if ($detail['from'] != 'article') {
                                    $this->error(404);
                                } else
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
                            $pager['prev'] = K::M('article/article')->prev_item($article_id, 80);
                            $pager['prev']['link'] = str_replace("article", "xw", strtolower($pager['prev']['link']));
                            $pager['prev']['link'] = str_replace("-detail-", "/", strtolower($pager['prev']['link']));
                            $pager['prev']['link'] = str_replace("-1.", ".", strtolower($pager['prev']['link']));
                            $pager['next'] = K::M('article/article')->next_item($article_id, 80);
                            $pager['next']['link'] = str_replace("article", "xw", strtolower($pager['next']['link']));
                            $pager['next']['link'] = str_replace("-detail-", "/", strtolower($pager['next']['link']));
                            $pager['next']['link'] = str_replace("-1.", ".", strtolower($pager['next']['link']));
                            if ($comment_list = K::M('article/comment')->items(array(
                                'article_id' => $article_id,
                                'closed' => 0
                            ), array(
                                'comment_id' => 'DESC'
                            ), 1, 5)
                            ) {
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
                            $this->pagedata['cate'] = $cate;
                            $arr = explode(",", $detail['tag']);
                            foreach ($arr as $v) {
                                $tag = K::M('article/tag')->detail($v, 80);
                                $detail['curr_content'] = preg_replace("/$v/", "<a href='/tag-{$tag['tag_id']}/' class='xwtag'>{$v}</a>", $detail['curr_content'], 1);
                            }
                            $this->pagedata['detail'] = $detail;

                            $seo = array(
                                'article_title' => $detail['title'],
                                'seo_keywords' => $detail['seo_keywords'],
                                'seo_description' => $detail['seo_description'],
                            );
                            $this->seo->init('xw_detail', $seo);
                            $this->pagedata['canonical'] = "www.jzwpt.com/xw/{$article_id}.html";
                            $this->tmpl = 'xw/detail.html';
                        }
                    }
                }
            }
        }
    }

    public function comment($xw_id) {
        if (!$this->check_login()) {
            $this->err->add('您还没有登录，不能评论', 101);
        } elseif (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_comment')) == - 1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        } elseif (!$content = $this->GP('content')) {
            $this->err->add('评论内容不能不能为空', 211);
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
                $xw = $this->check_case($xw_id);
                $data = array(
                    'xw_id' => $xw_id,
                    'uid' => $this->uid,
                    'content' => $content,
                    'audit' => $audit,
                    'city_id' => $this->request['city_id']
                );
                K::M('xw/comment')->create($data);
                $this->err->add('评论成功！');
            }
        }
    }

    protected function check_case($xw_id) {
        if (!$xw_id = (int) $xw_id) {
            $this->error(404);
        } else
        if (!$xw = K::M('xw/xw')->detail($xw_id)) {
            $this->error(404);
        } elseif (!$xw['audit']) {
            $this->err->add("内容审核中，暂不可访问", 211)->response();
        }
        $this->pagedata['uri'] = $this->request['uri'];
        $this->pagedata['detail'] = $xw;
        return $xw;
    }

    public function like($xw_id) {
        if (!$xw_id = (int) $xw_id) {
            $this->err->add('案例不存在', 211);
        } else
        if (!$xw = K::M('xw/xw')->detail($xw_id)) {
            $this->err->add('案例不存在', 212);
        } else
        if (!$xw['audit']) {
            $this->err->add('该案例还未通过审核', 212);
        } else
        if (K::M('xw/like')->is_like($xw_id, __IP)) {
            $this->err->add('已经喜欢过了', 212);
        } else {
            $data = array(
                'xw_id' => $xw_id,
                'uid' => $this->uid,
                'create_ip' => __IP,
                'dateline' => __TIME
            );
            K::M('xw/like')->create($data);
            K::M('xw/xw')->update_count($xw_id, 'likes', 1);
            $this->err->add('喜欢成功');
        }
    }

}
