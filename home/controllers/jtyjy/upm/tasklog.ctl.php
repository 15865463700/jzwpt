<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Jtyjy_Upm_Tasklog extends Ctl_Jtyjy_Jiatingyingjuyuan
{

    public function index($page = 1)
    {
        $pager = $filter = array();
        $filter = array(
            'company_id' => $this->company_id
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
        $this->tmpl = 'jtyjy/upm/task/log/items.html';
    }

    public function tongji($d = 7)
    {
        if (! $d = (int) $d) {
            $d = 7;
        }
        $days = $counts = array();
        for ($i = $d; $i >= 0; $i --) {
            $stime = $this->system->sdaytime - 86400 * $i;
            $ltime = $this->system->sdaytime - 86400 * ($i - 1);
            $days[] = date("m-d", $stime);
            $filter = array(
                'company_id' => $this->company_id,
                'dateline' => $stime . '~' . $ltime
            );
            $a = K::M('upm/tasklog')->tongji_count($filter);
            foreach ($a as $k => $v) {
                $counts[$k][] = $v;
            }
        }
        
        $this->pagedata['days'] = $days;
        $this->pagedata['count_titles'] = array(
            'uv' => '新访客',
            'yuyue' => '预约',
            'youxiao' => '有效预约',
            'liangfang' => '量房',
            'qiandan' => '签单'
        );
        $this->pagedata['counts'] = $counts;
        $this->tmpl = 'jtyjy/upm/task/log/tongji.html';
    }
}