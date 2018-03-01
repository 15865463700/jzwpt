<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

// class Ctl_Rzps_Misc_Truste extends Ctl_Rzps_Ruanzhuangpeishi
class Ctl_Rzps_Misc_Truste extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $menu_list = include (dirname(__FILE__) . "/../ctlmaps.php");
        $this->pagedata['menu_list'] = $menu_list["company"];
    }
    // public function __construct(&$system)
    // {
    // parent::__construct($system);
    // switch($this->MEMBER['from']){
    // case 'gz' : $gz = $this->ucenter_gz(); $city_id = $gz['city_id']; break;
    // case 'designer' : $designer = $this->ucenter_designer(); $city_id = $designer['city_id']; break;
    // case 'mechanic' : $mechanic = $this->ucenter_mechanic(); $city_id = $mechanic['city_id']; break;
    // case 'company' : $company = $this->ucenter_company(); $city_id = $company['city_id']; break;
    // case 'shop' : $shop = $this->ucenter_shop(); $city_id = $shop['city_id']; break;
    // }
    // $this->city_id = $city_id;
    // }
    public function index($page = 1)
    {
        // $filter = $pager = array();
        // $pager['page'] = max(intval($page), 1);
        // $pager['limit'] = $limit = 20;
        // $filter['city_id'] = $this->city_id;
        // $filter['status'] = array(0);
        // $filter['sign_uid'] = "<:1";
        // $truste_ids = array();
        // if($items = K::M('truste/truste')->items($filter, null, $page, $limit, $count)){
        // $pager['count'] = $count;
        // $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
        // $this->pagedata['items'] = $items;
        // }
        // $this->pagedata['pager'] = $pager;
        $this->tmpl = 'rzps/misc/truste/items.html';
    }

    public function company($page = 1)
    {
        $this->truste($page);
    }

    public function shop($page = 1)
    {
        $this->truste($page);
    }

    public function designer($page = 1)
    {
        $this->truste($page);
    }

    public function gz($page = 1)
    {
        $this->truste($page);
    }

    public function mechanic($page = 1)
    {
        $this->truste($page);
    }

    protected function truste($page = 1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['city_id'] = $this->city_id;
        $filter['status'] = array(
            0,
            1,
            2
        );
        $truste_ids = array();
        if ($items = K::M('truste/truste')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'rzps/misc/truste/items.html';
    }

    public function detail($truste_id = null)
    {
        if (! $truste_id = (int) $truste_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('truste/truste')->detail($truste_id)) {
                $this->err->add('招标不存在或已经删除', 211);
            } else {
                K::M('truste/truste')->update_count($truste_id, 'views');
                if ($look_list = K::M('truste/look')->items_by_truste($truste_id)) {
                    $uids = array();
                    foreach ($look_list as $k => $v) {
                        $uids[$v['uid']] = $v['uid'];
                        if ($v['uid'] == $this->uid) {
                            $detail['looked'] = $k;
                        }
                    }
                    $this->pagedata['look_list'] = $look_list;
                    if ($uids) {
                        if ($member_list = K::M('member/member')->items_by_ids($uids)) {
                            $gz_uids = $designer_uids = $mechanic_uids = $company_uids = $shop_uids = array();
                            foreach ($member_list as $v) {
                                switch ($v['from']) {
                                    case 'company':
                                        $company_uids[$v['uid']] = $v['uid'];
                                        break;
                                    case 'designer':
                                        $designer_uids[$v['uid']] = $v['uid'];
                                        break;
                                    case 'gz':
                                        $gz_uids[$v['uid']] = $v['uid'];
                                        break;
                                    case 'mechanic':
                                        $mechanic_uids[$v['uid']] = $v['uid'];
                                        break;
                                    case 'shop':
                                        $shop_uids[$v['uid']] = $v['uid'];
                                        break;
                                }
                            }
                            if ($gz_uids) {
                                $this->pagedata['gz_list'] = K::M('gz/gz')->items_by_ids($gz_uids);
                            }
                            if ($designer_uids) {
                                $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_uids);
                            }
                            if ($mechanic_uids) {
                                $this->pagedata['mechanic_list'] = K::M('mechanic/mechanic')->items_by_ids($mechanic_uids);
                            }
                            if ($company_uids) {
                                $this->pagedata['company_list'] = K::M('company/company')->items_by_uids($company_uids);
                            }
                            if ($shop_uids) {
                                $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_uids($shop_uids);
                            }
                            $this->pagedata['member_list'] = $member_list;
                        }
                    }
                    $this->pagedata['look_list'] = $look_list;
                }
                if ($uid = $detail['uid']) {
                    $this->pagedata['member'] = K::M('member/member')->member($uid);
                }
                $this->pagedata['cates'] = K::M('truste/cate')->items(array(
                    'closed' => '0',
                    'audit' => '1'
                ));
                $this->pagedata['pager'] = $pager;
                $this->pagedata['detail'] = $detail;
                K::M('truste/truste')->update_count($truste_id, 'views');
                $this->tmpl = 'rzps/misc/truste/detail.html';
            }
    }

    public function looked($page = 1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $truste_ids = array();
        $filter['uid'] = $this->uid;
        if ($items = K::M('truste/look')->items($filter, null, $page, $limit, $count)) {
            foreach ($items as $k => $v) {
                $truste_ids[$v['truste_id']] = $v['truste_id'];
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            if ($truste_ids) {
                $this->pagedata['truste_list'] = K::M('truste/truste')->items_by_ids($truste_ids);
            }
        }
        
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'rzps/misc/truste/looks.html';
    }

    public function track($look_id = null, $page = 1)
    {
        if (! $look_id = (int) $look_id) {
            $this->error(404);
        } else 
            if (! $look = K::M('truste/look')->detail($look_id)) {
                $this->err->add('您的投标不存在或已经删除', 211);
            } elseif ($look['uid'] != $this->uid) {
                $this->err->add('非法操作，你没有权限查看该标', 212);
            } else 
                if (! $detail = K::M('truste/truste')->detail($look['truste_id'])) {
                    $this->err->add('该招标数据不存在！可能由管理员删除', 213);
                } else {
                    
                    $this->pagedata['detail'] = $detail;
                    $this->pagedata['cates'] = K::M('truste/cate')->items(array(
                        'closed' => '0',
                        'audit' => '1'
                    ));
                    $this->pagedata['look_id'] = $look_id;
                    $this->pagedata['look'] = $look;
                    $this->tmpl = 'rzps/misc/truste/track.html';
                }
    }

    public function comment()
    {
        if (! $look_id = (int) $this->GP('look_id')) {
            $this->err->add('非法的数据提交', 211);
        } elseif (! $look = K::M('truste/look')->detail($look_id)) {
            $this->err->add('没有您的标', 211);
        } elseif ($look['uid'] != $this->uid) {
            $this->err->add('非法的数据提交', 211);
        } else 
            if (! $content = $this->GP('tack_content')) {
                $this->err->add('非法的数据提交', 211);
            } else {
                $data = array(
                    'content' => $content,
                    'look_id' => $look_id
                );
                if ($tracking_id = K::M('truste/track')->create($data)) {
                    $this->err->add('添加内容成功');
                }
            }
    }

    public function look($truste_id = null)
    {
        if (! ($truste_id = (int) $truste_id) && ! ($truste_id = (int) $this->GP('truste_id'))) {
            $this->error(404);
        } else 
            if (! $truste = K::M('truste/truste')->detail($truste_id)) {
                $this->err->add('招标不存在或已经删除', 212);
            } else 
                if (($truste_look = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'truste_look')) < 0) {
                    $this->err->add('您是【' . $this->MEMBER['group_name'] . '】不能进行投标', 333);
                } else 
                    if ($truste['status'] < 0) {
                        $this->err->add('该招标已经作废，不可投标!', 212);
                    } else 
                        if ($truste['sign_uid']) {
                            $this->err->add('该招标已经结束了!', 212);
                        } else 
                            if ($truste['looks'] >= $truste['max_look']) {
                                $this->err->add('该招标已经结束了!', 212);
                            } else 
                                if (K::M('truste/look')->is_looked($truste_id, $this->uid)) {
                                    $this->err->add('您已经投过标了，不需要重复投标', 213);
                                } else 
                                    if (($truste['gold']) && ($this->MEMBER['gold'] < $truste['gold'])) {
                                        $this->err->add('您的金币全额不足，请先充值', 215);
                                    } else 
                                        if ($data = $this->checksubmit('data')) {
                                            if (! $content = $data['content']) {
                                                $this->err->add('给业主留言不能为空', 216);
                                            } else {
                                                $datas = K::M('truste/look')->getdata($this->uid);
                                                $datas['truste_id'] = $truste_id;
                                                $datas['uid'] = $this->uid;
                                                $datas['content'] = $content;
                                                if ($look_id = K::M('truste/look')->create($datas)) {
                                                    if ($truste['gold'] > 0) {
                                                        if (! K::M('member/gold')->update($this->uid, - $truste['gold'], "看标：" . $truste['title'] . "(ID:{$truste_id})")) {
                                                            $this->err->add('扣费失败', 201)->response();
                                                        }
                                                    }
                                                    K::M('truste/truste')->update_count($truste_id, 'looks');
                                                    switch ($this->MEMBER['from']) {
                                                        case 'gz':
                                                            K::M('gz/gz')->update_count($this->uid, 'truste_num');
                                                            break;
                                                        case 'designer':
                                                            K::M('designer/designer')->update_count($this->uid, 'truste_num');
                                                            break;
                                                        case 'mechanic':
                                                            K::M('mechanic/mechanic')->update_count($this->uid, 'truste_num');
                                                            break;
                                                        case 'company':
                                                            K::M('company/company')->update_count($this->company['company_id'], 'truste_num');
                                                            break;
                                                        case 'shop':
                                                            K::M('shop/shop')->update_count($this->shop['shop_id'], 'truste_num');
                                                            break;
                                                    }
                                                    $this->err->add('参加竞标成功！');
                                                }
                                            }
                                        } else {
                                            $this->pagedata['truste'] = $truste;
                                            $this->tmpl = 'rzps/misc/truste/look.html';
                                        }
    }
}