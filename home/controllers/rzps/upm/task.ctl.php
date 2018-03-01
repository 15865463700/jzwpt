<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Rzps_Upm_Task extends Ctl_Rzps_Ruanzhuangpeishi
{

    protected $_allow_fields = 'title,photo,content,stime,ltime,uv_num,uv_credits,uv_money,yuyue_credits,yuyue_money,youxiao_credits,youxiao_money,liangfang_credits,liangfang_money,qiandan_credits,qiandan_money,audit';

    public function index($page = 1)
    {
        // $company = $this->ucenter_company();
        $company_id = $company['company_id'];
        if (! $detail = K::M('upm/task')->detail_by_company_id($company_id)) {
            $this->info();
        } else {
            $pager = $filter = array();
            $filter = array(
                'task_id' => $task_id
            );
            $pager['page'] = $page = max((int) $page, 1);
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            if ($items = K::M('upm/tasklog')->items($filter, $order, $page, $limit, $count)) {
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                    $task_id,
                    '{page}'
                )));
            }
            $this->pagedata['detail'] = $detail;
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'rzps/upm/task/index.html';
        }
    }

    public function info()
    {
        // $company = $this->ucenter_company();
        $company_id = $company['company_id'];
        $detail = $detail = K::M('upm/task')->detail_by_company_id($company_id);
        
        if ($data = $this->checksubmit('data')) {
            if (! $data = $this->check_fields($data, $this->_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else 
                if ($detail['company_id']) {
                    if ($task_id = K::M('upm/task')->update($detail['task_id'], $data)) {
                        $this->err->add("配置分销任务成功");
                        $this->err->set_data('forward', $this->mklink('rzps/upm/task:index'));
                    }
                } else {
                    $data['company_id'] = $company_id;
                    if ($task_id = K::M('upm/task')->create($data)) {
                        $this->err->add("配置分销任务成功");
                        $this->err->set_data('forward', $this->mklink('rzps/upm/task:index'));
                    }
                }
        } else {
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'rzps/upm/task/info.html';
        }
    }

    public function detail($page = 1)
    {
        // $company = $this->ucenter_company();
        $company_id = $company['company_id'];
        if (! $detail = K::M('upm/task')->detail($company_id)) {
            $this->err->add('你要查看的内容不存或已经删除', 212);
        } else 
            if ($detail['company_id'] != $company_id) {
                $this->err->add('您没有权限删除该内容', 213);
            } else {
                $pager = $filter = array();
                $filter = array(
                    'company_id' => $company_id
                );
                $pager['page'] = $page = max((int) $page, 1);
                $pager['limit'] = $limit = 20;
                $pager['count'] = $count = 0;
                if ($items = K::M('upm/tasklog')->items($filter, $order, $page, $limit, $count)) {
                    $this->pagedata['items'] = $items;
                    $pager['count'] = $count;
                    $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                        '{page}'
                    )));
                }
                $this->pagedata['detail'] = $detail;
                $this->pagedata['pager'] = $pager;
                $this->tmpl = 'rzps/upm/task/detail.html';
            }
    }

    public function count()
    {
        // $company = $this->ucenter_company();
        $company_id = $company['company_id'];
        $days = $counts = array();
        $titles = array(
            'uv' => '新访客',
            'yuyue' => '预约',
            'youxiao' => '有效预约',
            'liangfang' => '量房',
            'qiandan' => '签单'
        );
        for ($i = 7; $i >= 0; $i --) {
            $stime = $this->system->sdaytime - 86400 * $i;
            $ltime = $this->system->sdaytime - 86400 * ($i - 1);
            $days[] = date("m-d", $stime);
            $filter = array(
                'company_id' => $company_id,
                'dateline' => $stime . '~' . $ltime
            );
            $a = K::M('upm/tasklog')->tongji_count($filter);
            foreach ($a as $k => $v) {
                $counts[$k]['name'] = $titles[$k];
                $counts[$k]['data'][] = $v;
            }
        }
        $this->err->set_data('data', array(
            'days' => $days,
            'counts' => array_values($counts)
        ));
        $this->err->json();
    }
}