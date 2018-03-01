<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

// class Ctl_Afzn_Company_News extends Ctl_Afzn_Anfangzhineng
class Ctl_Afzn_Company_News extends Ctl
{

    protected $_allow_fields = 'title,content';

    public function __construct(&$system)
    {
        parent::__construct($system);
        $menu_list = include (dirname(__FILE__) . "/../ctlmaps.php");
        $this->pagedata['menu_list'] = $menu_list["company"];
        $this->pagedata['ctlgroup'] = "company";
    }

    public function index()
    {
        $company = $this->ucenter_company();
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $company['company_id']
        );
        if ($items = K::M('afzncompany/news')->items($filter, null, $page, $limit, $count)) {
            $pgaer['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'afzn/company/news/items.html';
    }

    public function create()
    {
        $company = $this->ucenter_company();
        if (K::M('member/integral')->check('company_news', $this->MEMBER) === false) {
            $this->err->add('很抱歉您的账户余额不足！', 201);
        } else 
            if ($data = $this->checksubmit('data')) {
                $allow_news = K::M('member/group')->check_priv($company['group_id'], 'allow_news');
                if ($allow_news < 0) {
                    $this->err->add('您是【' . $audit_title . '】没有权限添加公司新闻', 333);
                } else 
                    if (! $data = $this->check_fields($data, $this->_allow_fields)) {
                        $this->err->add('非法的数据提交', 211);
                    } else {
                        $data['company_id'] = $company['company_id'];
                        $data['city_id'] = $company['city_id'];
                        $data['audit'] = $allow_news;
                        if ($news_id = K::M('afzncompany/news')->create($data)) {
                            K::M('afzncompany/news')->news_count($company['company_id']);
                            K::M('system/integral')->commit('company_news', $this->MEMBER, '添加公司新闻');
                            $this->err->add('添加公司新闻成功');
                            $this->err->set_data('forward', $this->mklink('afzn/company/news:index'));
                        }
                    }
            } else {
                $this->pagedata['pager'] = $pager;
                $this->tmpl = 'afzn/company/news/create.html';
            }
    }

    public function edit($news_id = null)
    {
        $company = $this->ucenter_company();
        if (! ($news_id = (int) $news_id) && ! ($news_id = (int) $this->GP('news_id'))) {
            $this->err->add('未定义操作', 211);
        } else 
            if (! $detail = K::M('afzncompany/news')->detail($news_id)) {
                $this->err->add('您要修改的内容不存在或已经删除', 212);
            } else 
                if ($company['company_id'] != $detail['company_id']) {
                    $this->err->add('您没有权限修改该内容', 213);
                } else 
                    if ($data = $this->checksubmit('data')) {
                        if (! $data = $this->check_fields($data, $this->_allow_fields)) {
                            $this->err->add('非法的数据提交', 201);
                        } else 
                            if (K::M('afzncompany/news')->update($news_id, $data)) {
                                $this->err->add('修改内容成功');
                            }
                    } else {
                        $this->pagedata['detail'] = $detail;
                        $this->tmpl = 'afzn/company/news/edit.html';
                    }
    }

    public function delete($news_id = null)
    {
        $company = $this->ucenter_company();
        if (! ($news_id = (int) $news_id) && ! ($news_id = $this->GP('news_id'))) {
            $this->err->add('未指要删除的资讯', 211);
        } else 
            if (! $detail = K::M('afzncompany/news')->detail($news_id)) {
                $this->err->add('你要删除的资讯不存或已经删除', 212);
            } else 
                if ($company['company_id'] != $detail['company_id']) {
                    $this->err->add('您没有权限删除该资讯', 213);
                } else {
                    K::M('afzncompany/news')->delete($news_id);
                    $this->err->add('删除资讯成功');
                }
    }

    protected function ucenter_company()
    {
        $this->company = K::M('afzncompany/company')->company_by_uid($this->uid);
        if ($this->company) {
            $group = K::M('member/group')->group($this->company['group_id']);
            $this->company['group'] = $this->MEMBER['group'] = $group;
            $this->company['group_name'] = $group['group_name'];
            $this->pagedata['group'] = $group;
            $this->pagedata['company'] = $this->company;
            $this->ucenter_city_id = $this->company['city_id'];
            return $this->company;
        } else 
            if ($this->request['ctl'] == 'afzn/company' && $this->request['act'] == 'info') {
                $this->pagedata['company_no_open'] = true;
                return false;
            } else {
                $this->pagedata['company_no_open'] = true;
                $this->tmpl = 'afzn/company/info.html';
            }
        $this->response();
    }
}