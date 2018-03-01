<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Jtyjy_Member_MyPm extends Ctl_Jtyjy_Jiatingyingjuyuan
{

    protected $pm_pro = array(
        1 => '方案设计',
        2 => '水泥改造',
        3 => '泥瓦阶段',
        4 => '木工阶段',
        5 => '油漆阶段',
        6 => '完工',
        7 => '验收完成'
    );

    protected $pm_type = array(
        1 => '水电工程',
        2 => '土木工程',
        3 => '油漆工程',
        4 => '安装工程'
    );

    public function index($page = 1)
    {
        $map = array(
            'custom_id' => $this->MEMBER['uid'],
            'closed' => 0
        );
        $pager['page'] = $page = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        if ($items = K::M('pm/site')->items($map, array(
            'dateline' => 'desc'
        ), $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['pager'] = $pager;
            $this->pagedata['items'] = $items;
            $this->pagedata['steps'] = $this->pm_pro;
        }
        $this->tmpl = 'jtyjy/member/mypm/index.html';
    }

    public function detail($site_id = null)
    {
        if (! $site_id) {
            $this->err->add('非法访问', 100);
        } elseif (! $detail = K::M('pm/site')->detail($site_id)) {
            $this->err->add('非法操作', 100);
        } else {
            $progress = K::M('pm/site_progress')->items(array(
                'site_id' => $site_id,
                'status' => 1
            ));
            $this->pagedata['detail'] = $detail;
            $this->pagedata['progress'] = $progress;
            $this->pagedata['pm_type'] = $this->pm_type;
            $this->pagedata['steps'] = $this->pm_pro;
            $this->pagedata['supervist'] = $this->format($this->supervist(), 'supervist_id', 'name');
            $this->pagedata['member'] = $this->format($this->member(), 'uid', 'uname');
            $this->tmpl = 'jtyjy/member/mypm/detail.html';
        }
    }

    private function supervist()
    {
        $map = array(
            'closed' => 0
        );
        return K::M('supervist/supervist')->items($map);
    }

    private function member()
    {
        $map = array(
            'closed' => 0
        );
        return K::M('member/member')->items($map);
    }

    private function format($data, $k, $v)
    {
        $result = array();
        foreach ($data as $kk => $d) {
            $result[$d[$k]] = $d[$v];
        }
        return $result;
    }
}    	