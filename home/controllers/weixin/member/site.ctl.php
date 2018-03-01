<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Weixin_Member_Site extends Ctl_Weixin
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

    public function index()
    {
        $member = $this->check_member();
        if ($items = K::M('pm/site')->items(array(
            'custom_id' => $member['uid'],
            'closed' => 0
        ), array(
            'dateline' => 'desc'
        ), 1, 20)) {
            $this->pagedata['items'] = $items;
            $this->pagedata['steps'] = $this->pm_pro;
        }
        $this->tmpl = 'weixin/member/site/index.html';
    }

    public function detail($site_id = null)
    {
        if (! $site_id) {
            $this->err->add('非法操作!', 99);
        } else 
            if (! $detail = K::M('pm/site')->detail($site_id)) {
                $this->err->add('非法操作!', 100);
            } else {
                $map = array(
                    'status' => 1,
                    'site_id' => $site_id
                );
                
                $this->pagedata['items'] = K::M('pm/site_progress')->items($map, array(
                    'dateline' => 'asc'
                ));
                $this->pagedata['detail'] = $detail;
                $this->pagedata['pm_pro'] = $this->pm_pro;
                $attachs = array();
                $_attach = K::M('pm/site_attach')->items();
                foreach ($_attach as $v) {
                    $attachs[$v['progress_id']][] = $v['thumb'];
                }
                $this->pagedata['attachs'] = $attachs;
                
                $this->tmpl = 'weixin/member/site/detail.html';
            }
    }

    private function getUser()
    {
        $openid = $this->access_openid();
        return K::M('member/weixin')->detail_by_openid($openid);
    }
}