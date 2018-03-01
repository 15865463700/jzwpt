<?php

class Ctl_Tag extends Ctl
{
    public function index($tag_id=0, $page = 1){
        $this->items($tag_id,$page);
    }

    public function items($tag_id=0, $page = 1){
        $tag_id=isset($_REQUEST["a"])?$_REQUEST["a"]:$tag_id;
        $page=isset($_REQUEST["b"])?$_REQUEST["b"]:$page;
        if ($tag_id = (int) $tag_id) {
            $tag=K::M('article/tag')->detail($tag_id);
            $this->pagedata['tag'] = $tag;
            if($tag){
                $this->pagedata['tagstr'] = "&gt;".$tag['tag_name'];
            }
        }
        $pager = $filter = $params = array();
        $cat_id = 80;
        $filter['cat_id'] = $cat_id;
        if ($cat_ids = K::M('article/cate')->children_ids($cat_id)) {
            $filter['cat_id'] = explode(',', $cat_ids);
        }
        if ($tag){
            if(!empty($tag['tag_name'])){
                $filter['tag'] = "LIKE:%{$tag['tag_name']}%";
            }
        }
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;

//        if ($tag){
            $items = K::M('article/article')->items($filter, null, $page, $limit, $count);
//        }else{
//            $items = K::M('article/article')->items_by_cate_tag_page($cat_ids, $page, $limit, $count);
//        }
		foreach($items as $k=>$v){
			$items[$k]['desc']=mb_substr($v['desc'],0,280,"utf-8");
			$items[$k]['desc']=str_replace($tag['tag_name'],"<font class='xwtag'>{$tag['tag_name']}</font>",$items[$k]['desc']);
		}
        if ($items) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                $tag_id,
                '{page}'
            ), $params));
            $pager['pagebar'] = preg_replace("/tag-index/","tag",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/tag-0-1\./","tag.",$pager['pagebar']);
            $pager['pagebar'] = preg_replace("/\.html/","/",$pager['pagebar']);
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $seo = array(
            'tag_name' => $tag['tag_name'],
            'page' => (($page > 1) ? $page : '')
        );
        $this->seo->init('tag_items', $seo);
        $this->tmpl = 'tag/items.html';
    }

    public function detail($article_id, $page = 1){
        if (! $article_id = (int) $article_id) {
            $this->error(404);
        } else
            if (! $detail = K::M('article/article')->detail($article_id)) {
                $this->error(404);
            } else
                if (! $cate = K::M('article/cate')->cate($detail['cat_id'])) {
                    $this->error(404);
                } else
                    if (empty($detail['audit'])) {
                        $this->err->add('文章审核中，暂时不可访问', 211);
                    } else
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
                                if (! $curr_content = $detail['content_list'][$offset]) {
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
                            $this->tmpl = 'tag/detail.html';
                        }
    }

}
