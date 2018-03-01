<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Dcenter extends Ctl_Mobile
{

    protected $ctlmaps = array();

    public function __construct(&$system)
    {
        parent::__construct($system);
        $this->check_login();
        $this->pagedata['ctlgroup'] = $this->ctlgroup;
        $this->pagedata['menu_list'] = $this->_parse_menu($this->MEMBER['from']);
    }

    public function check_login()
    {
        if (! $this->uid) {
            if ($this->request['XREQ'] || $this->request['MINI']) {
                $this->err->add('很抱歉，你还没有登录不能访问', 101);
            } else {
                $this->pagedata['other'] = 1;
                $this->tmpl = 'mobile/dcenter/passport/login.html';
            }
            $this->err->response();
            exit();
        }
        return true;
    }

    protected function dcenter_check()
    {
        if ($this->MEMBER['from'] != 'gz' && $this->MEMBER['from'] != 'designer' && $this->MEMBER['from'] != 'mechanic') {
            $this->err->add('您的帐号不是服务人员类型', 211);
        } else {
            if ($this->MEMBER['from'] == 'mechanic') {
                if ($this->mechanic = K::M('mechanic/mechanic')->detail($this->uid)) {
                    $group = K::M('member/group')->group($this->mechanic['group_id']);
                    $this->mechanic['group'] = $group;
                    $this->mechanic['group_name'] = $group['group_name'];
                    $this->pagedata['group'] = $group;
                    $this->pagedata['mechanic'] = $this->mechanic;
                    return $this->mechanic;
                } else 
                    if ($this->request['ctl'] == 'ucenter/mechanic' && $this->request['act'] == 'info') {
                        $this->pagedata['mechanic_no_open'] = true;
                        return false;
                    } else {
                        $this->pagedata['mechanic_no_open'] = true;
                        $this->tmpl = 'mobile/ucenter/other_info.html';
                    }
            } elseif ($this->MEMBER['from'] == 'designer') {
                if ($this->designer = K::M('designer/designer')->detail($this->uid)) {
                    $group = K::M('member/group')->group($this->designer['group_id']);
                    $this->designer['group'] = $group;
                    $this->designer['group_name'] = $group['group_name'];
                    $this->pagedata['group'] = $group;
                    $this->pagedata['designer'] = $this->designer;
                    return $this->designer;
                } else 
                    if ($this->request['ctl'] == 'ucenter/designer' && $this->request['act'] == 'info') {
                        $this->pagedata['designer_no_open'] = true;
                        return false;
                    } else {
                        $this->pagedata['designer_no_open'] = true;
                        $this->tmpl = 'mobile/ucenter/other_info.html';
                    }
            } else {
                if ($this->gz = K::M('gz/gz')->detail($this->uid)) {
                    $group = K::M('member/group')->group($this->gz['group_id']);
                    $this->gz['group'] = $group;
                    $this->gz['group_name'] = $group['group_name'];
                    $this->pagedata['group'] = $group;
                    $this->pagedata['gz'] = $this->gz;
                    return $this->gz;
                } else 
                    if ($this->request['ctl'] == 'ucenter/gz' && $this->request['act'] == 'info') {
                        $this->pagedata['gz_no_open'] = true;
                        return false;
                    } else {
                        $this->pagedata['gz_no_open'] = true;
                        $this->tmpl = 'mobile/ucenter/other_info.html';
                    }
            }
        }
        $this->response();
    }

    public function ucenter_mechanic()
    {
        if ($this->MEMBER['from'] != 'mechanic') {
            $this->err->add('您的帐号不是技工类型', 211);
        } else 
            if ($this->mechanic = K::M('mechanic/mechanic')->detail($this->uid)) {
                $group = K::M('member/group')->group($this->mechanic['group_id']);
                $this->mechanic['group'] = $group;
                $this->mechanic['group_name'] = $group['group_name'];
                $this->pagedata['group'] = $group;
                $this->pagedata['mechanic'] = $this->mechanic;
                return $this->mechanic;
            } else 
                if ($this->request['ctl'] == 'ucenter/mechanic' && $this->request['act'] == 'info') {
                    $this->pagedata['mechanic_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['mechanic_no_open'] = true;
                    $this->tmpl = 'mobile/ucenter/other_info.html';
                }
        $this->response();
    }

    public function ucenter_designer()
    {
        if ($this->MEMBER['from'] != 'designer') {
            $this->err->add('您的帐号不是设计师类型', 211);
        } else 
            if ($this->designer = K::M('designer/designer')->detail($this->uid)) {
                $group = K::M('member/group')->group($this->designer['group_id']);
                $this->designer['group'] = $group;
                $this->designer['group_name'] = $group['group_name'];
                $this->pagedata['group'] = $group;
                $this->pagedata['designer'] = $this->designer;
                return $this->designer;
            } else 
                if ($this->request['ctl'] == 'ucenter/designer' && $this->request['act'] == 'info') {
                    $this->pagedata['designer_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['designer_no_open'] = true;
                    $this->tmpl = 'mobile/ucenter/other_info.html';
                }
        $this->response();
    }

    public function ucenter_gz()
    {
        if ($this->MEMBER['from'] != 'gz') {
            $this->err->add('您的帐号不是工长类型', 211);
        } else 
            if ($this->gz = K::M('gz/gz')->detail($this->uid)) {
                $group = K::M('member/group')->group($this->gz['group_id']);
                $this->gz['group'] = $group;
                $this->gz['group_name'] = $group['group_name'];
                $this->pagedata['group'] = $group;
                $this->pagedata['gz'] = $this->gz;
                return $this->gz;
            } else 
                if ($this->request['ctl'] == 'ucenter/gz' && $this->request['act'] == 'info') {
                    $this->pagedata['gz_no_open'] = true;
                    return false;
                } else {
                    $this->pagedata['gz_no_open'] = true;
                    $this->tmpl = 'mobile/ucenter/other_info.html';
                }
        $this->response();
    }

    protected function _parse_menu($from)
    {
        $menu_list = array();
        foreach ($this->ctlmenu as $k => $v) {
            if ($v['menu'] && $v['priv']) {
                $priv = explode(',', $v['priv']);
                if (in_array($from, $priv)) {
                    $v['menu'] = true;
                } else {
                    $v['menu'] = false;
                }
            }
            if ($v['menu']) {
                $items = array();
                foreach ($v['items'] as $kk => $vv) {
                    if ($vv['menu'] && $vv['priv']) {
                        $vv['priv'] = explode(',', $vv['priv']);
                        if (! in_array($from, $vv['priv'])) {
                            continue;
                        }
                    }
                    $items[] = $vv;
                }
                if ($v['items'] = $items) {
                    $menu_list[$k] = $v;
                }
            }
        }
        return $menu_list;
    }
}