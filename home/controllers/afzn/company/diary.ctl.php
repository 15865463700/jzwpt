<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Afzn_Company_Diary extends Ctl_Afzn_Anfangzhineng
{

    protected $_allow_fields = 'status,title,content';

    public function __construct(&$system)
    {
        parent::__construct($system);
        $menu_list = include(dirname(__FILE__) . "/../ctlmaps.php");
        $this->pagedata['menu_list'] = $menu_list["company"];
        $this->pagedata['ctlgroup'] = "company";
    }

    public function site($site_id = null)
    {
        $company = $this->ucenter_company();
        if (!$site_id = (int)$site_id) {
            $this->error(404);
        } else
            if (!$site = K::M('home/site')->detail($site_id)) {
                $this->err->add('工地不存在或已经删除', 211);
            } else {
                if ($items = K::M('home/item')->items(array(
                    'site_id' => $site_id
                ))
                ) {
                    $this->pagedata['items'] = $items;
                }
                $this->pagedata['site'] = $site;
                $this->pagedata['status_list'] = K::M('home/site')->get_status();
                $this->tmpl = 'afzn/company/site/diary/site.html';
            }
    }

    public function create($site_id = null)
    {
        $company = $this->ucenter_company();
        $allow_site = K::M('member/group')->check_priv($company['group_id'], 'allow_site');
        if (!($site_id = (int)$site_id) && !($site_id = (int)$this->GP('site_id'))) {
            $this->error(404);
        } else
            if (!$site = K::M('home/site')->detail($site_id)) {
                $this->err->add('工地不存在或已经删除', 211);
            } else
                if ($site['company_id'] != $company['company_id']) {
                    $this->err->add('您没有权限添加该工地日记', 213);
                } else
                    if ($data = $this->checksubmit('data')) {
                        if ($audit_site < 0) {
                            $this->err->add('您是【' . $company['group_name'] . '】没有权限添加工地日记', 333);
                        } else
                            if (!$data = $this->check_fields($data, $this->_allow_fields)) {
                                $this->err->add('非法的数据提交', 214);
                            } else {
                                $data['site_id'] = $site_id;
                                $status_list = K::M('home/item')->diary_status($site_id);
                                if ($status_list[$data['status']]['has_diary']) {
                                    $this->err->add($status_list[$data['status']]['title'] . "的日记已写，你可以选择编辑", 215);
                                } else
                                    if ($item_id = K::M('home/item')->create($data)) {
                                        if ($data['status'] > $site['status']) {
                                            K::M('home/site')->update($site_id, array(
                                                'status' => (int)$data['status']
                                            ), true);
                                        }
                                        $this->err->add('添加工地日志成功');
                                        $this->err->set_data('forward', $this->mklink('afzn/company/diary:site', array(
                                            $site_id
                                        )));
                                    }
                            }
                    } else {
                        $this->pagedata['site'] = $site;
                        $this->pagedata['status_list'] = K::M('home/item')->diary_status($site_id);
                        $pager = array(
                            'audit_site' => $audit_site,
                            'audit_title' => $audit_title
                        );
                        $this->pagedata['pager'] = $pager;
                        $this->tmpl = 'afzn/company/site/diary/create.html';
                    }
    }

    public function edit($item_id = null)
    {
        $company = $this->ucenter_company();
        if (!($item_id = (int)$item_id) && !($item_id = (int)$this->GP('item_id'))) {
            $this->error(404);
        } else
            if (!$detail = K::M('home/item')->detail($item_id)) {
                $this->err->add('日志不存在或已经删除', 211);
            } else
                if (!$site = K::M('home/site')->detail($detail['site_id'])) {
                    $this->err->add('工地不存在或已经删除', 212);
                } else
                    if ($site['company_id'] != $company['company_id']) {
                        $this->err->add('您没有权限修改该日记', 213);
                    } else
                        if ($data = $this->checksubmit('data')) {
                            unset($data['status']);
                            if (!$data = $this->check_fields($data, $this->_allow_fields)) {
                                $this->err->add('非法的数据提交', 214);
                            } else
                                if (K::M('home/item')->update($item_id, $data)) {
                                    $this->err->add('修改工地日志成功');
                                }
                        } else {
                            $this->pagedata['detail'] = $detail;
                            $this->pagedata['site'] = $site;
                            $this->tmpl = 'afzn/company/site/diary/edit.html';
                        }
    }

    public function delete($item_id = null)
    {
        $company = $this->ucenter_company();
        if (!($item_id = (int)$item_id) && !($item_id = $this->GP('item_id'))) {
            $this->err->add('未指要删除的工地日记', 211);
        } else
            if (!$detail = K::M('home/item')->detail($item_id)) {
                $this->err->add('你要删除的工地日记不存或已经删除', 212);
            } else
                if (!$site = K::M('home/site')->detail($detail['site_id'])) {
                    $this->err->add('工地不存在或已经删除', 212);
                } else
                    if ($company['company_id'] != $site['company_id']) {
                        $this->err->add('您没有权限删除该工地日记', 213);
                    } else {
                        K::M('home/item')->delete($item_id);
                        $this->err->add('删除工地日记成功');
                    }
    }

    protected function ucenter_company(){
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