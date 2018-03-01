<?php

if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Afznnews extends Ctl
{

    public function index()
    {
        $this->items();
    }

    public function items($page = 1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['city_id'] = $this->request['city_id'];
        $filter['audit'] = 1;
        if ($items = K::M('afzncompany/news')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('news:items', array(
                '{page}'
            )));
            foreach ($items as $k => $v) {
                $v['desc'] = K::M('content/html')->text($v['content'], true);
                $items[$k] = $v;
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->seo->init('news_items', array(
            'page' => ($page > 1) ? $page : ''
        ));
        $this->tmpl = 'afznnews/items.html';
    }

    public function detail($news_id)
    {
        $news_id=$_REQUEST['a']?$_REQUEST['a']:$news_id;
        if (! $news_id = (int) $news_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('afzncompany/news')->detail($news_id)) {
                $this->error(404);
            } else {
                K::M('afzncompany/news')->update_count($news_id, 'views', 1);
                $afzncompany = $this->check_company($detail['company_id']);
                $this->pagedata['afzncompany'] = $afzncompany;
                
                $this->pagedata['detail'] = $detail;
                // $seo = array('title'=>$detail['title'], 'company_name'=>$company['name'], 'news_desc'=>'');
                // $seo['news_desc'] = K::M('content/text')->substr(K::M('content/html')->text($detail['content'], true), 0, 200);
                // $this->seo->init('news_detail', $seo);
                // $this->pagedata['mobile_url'] = $this->mklink('mobile/company', array($detail['company_id']));
                $this->tmpl = 'afznnews/detail.html';
            }
    }

    protected function check_company(&$company_id = null)
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
        if ($uid = $company['uid']) {
            $company['member'] = K::M('member/member')->detail($uid);
        }
        if ($group_id = $company['group_id']) {
            $company['group'] = K::M('member/group')->group($group_id);
        }
        $this->pagedata['company'] = $company;
        K::M('company/company')->update_count($company_id, 'views', 1);
        return $company;
    }
}