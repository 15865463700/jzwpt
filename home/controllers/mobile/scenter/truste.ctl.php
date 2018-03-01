<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Mobile_Scenter_Truste extends Ctl_Mobile_Scenter
{

    public function truste($type = 1)
    {
        $member = $this->scenter_check();
        $form = $this->MEMBER['from'];
        if ($form == 'member') {
            $this->err->add('权限错误', 211);
        } else {
            
            $filter = $pager = array();
            $pager['page'] = max(intval($page), 1);
            $pager['limit'] = $limit = 50;
            $truste_ids = array();
            if ($form == 'company') {
                $company = $this->ucenter_company();
                $filter['company_id'] = $company['company_id'];
                $filter['from'] = 'company';
            } else {
                $shop = $this->ucenter_shop();
                $filter['uid'] = $shop['uid'];
            }
            if ($type == '2') {
                $filter['is_signed'] = '0';
            } else {
                $filter['is_signed'] = '1';
            }
            
            $filter['city_id'] = $member['city_id'];
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
            $this->pagedata['type'] = $type;
            $this->pagedata['items'] = $items;
            $pager['backurl'] = $this->mklink('mobile/scenter');
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile/scenter/truste/truste.html';
        }
    }

    public function trusteDetail($truste_id)
    {
        $member = $this->scenter_check();
        $form = $this->MEMBER['from'];
        if ($form == 'member') {
            $this->err->add('权限错误', 211);
        } else {
            $temp = 'ucenter_' . $form;
            $form_list = $this->$temp();
            $audit_truste = K::M('system/audit')->$form('truste', $form_list, $audit_title);
            $pager = array(
                'audit_truste' => $audit_truste,
                'audit_title' => $audit_title
            );
            if (! $truste_id = (int) $truste_id) {
                $this->error(404);
            } else 
                if (! $detail = K::M('truste/truste')->detail($truste_id)) {
                    $this->err->add('招标不存在或已经删除', 211);
                } else {
                    if ($look_list = K::M('truste/look')->items_by_truste($truste_id)) {
                        $uids = array();
                        foreach ($look_list as $k => $v) {
                            $uids[$v['uid']] = $v['uid'];
                        }
                        $this->pagedata['look_list'] = $look_list;
                        if ($uids) {
                            if ($member_list = K::M('member/member')->items_by_ids($uids)) {
                                $company_uids = array();
                                foreach ($member_list as $v) {
                                    $company_uids[$v['uid']] = $v['uid'];
                                }
                                if ($company_uids) {
                                    $this->pagedata['company_list'] = K::M('company/company')->items_by_uids($company_uids);
                                }
                            }
                        }
                    }
                    K::M('truste/truste')->update_count($truste_id, 'pv_num');
                    if ($uid = $detail['uid']) {
                        $this->pagedata['member'] = K::M('member/member')->member($uid);
                    }
                    $looked = K::M('truste/look')->items(array(
                        'truste_id' => $truste_id,
                        'uid' => $this->uid
                    ));
                    foreach ($looked as $k => $v) {
                        $detail['looked'] = 1;
                    }
                    $this->pagedata['cates'] = K::M('truste/cate')->items(array(
                        'closed' => '0',
                        'audit' => '1'
                    ));
                    $pager['backurl'] = $this->mklink('mobile/scenter/truste-truste');
                    $this->pagedata['pager'] = $pager;
                    $this->pagedata['detail'] = $detail;
                    $this->tmpl = 'mobile/scenter/truste/trusteDetail.html';
                }
        }
    }

    public function truste_look($truste_id)
    {
        $member = $this->scenter_check();
        if (! ($truste_id = (int) $truste_id) && ! ($truste_id = (int) $this->GP('truste_id'))) {
            $this->error(404);
        } else 
            if (($truste_look = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'truste_look')) < 0) {
                $this->err->add('您是【' . $this->MEMBER['group_name'] . '】不能进行投标', 333);
            } else 
                if (! $truste = K::M('truste/truste')->detail($truste_id)) {
                    $this->err->add('招标不存在或已经删除', 212);
                } elseif ((int) $truste['status'] === 1) {
                    $this->err->add('该招标已经结束了!', 212);
                } else 
                    if ($truste['looks'] >= $truste['max_look']) {
                        $this->err->add('该招标已经结束了!', 212);
                    } else 
                        if ($looked = K::M('truste/look')->items(array(
                            'truste_id' => $truste_id,
                            'uid' => $this->uid
                        ))) {
                            $this->err->add('您已经投过标了，不需要重复投标', 213);
                        } else 
                            if (($truste['gold']) && ($this->MEMBER['gold'] < $truste['gold'])) {
                                $this->err->add('您的金币全额不足，请先充值', 215);
                            } else 
                                if ($data = $this->checksubmit('data')) {
                                    if (! $content = $data['content']) {
                                        $this->err->add('给业主留言不能为空', 216);
                                    } else {
                                        if ($truste['gold'] > 0) {
                                            if (! K::M('member/gold')->update($this->uid, - $truste['gold'], "看标：" . $truste['title'] . "(ID:{$truste_id})")) {
                                                $this->err->add('扣费失败', 201)->response();
                                            }
                                        }
                                        $data = array(
                                            'truste_id' => $truste_id,
                                            'uid' => $this->uid,
                                            'content' => $content
                                        );
                                        if ($look_id = K::M('truste/look')->create($data)) {
                                            K::M('truste/truste')->update_count($truste_id, 'looks');
                                            $this->err->add('参加竞标成功！');
                                            $this->err->set_data('forward', $this->mklink('mobile/scenter/truste:trusteDetail', array(
                                                'truste_id' => $truste_id
                                            )));
                                        }
                                    }
                                } else {
                                    $pager['backurl'] = $this->mklink('mobile/scenter/truste:trusteDetail', array(
                                        'truste_id' => $truste_id
                                    ));
                                    $this->pagedata['pager'] = $pager;
                                    $this->pagedata['truste'] = $truste;
                                    $this->tmpl = 'mobile/scenter/truste/trustesign.html';
                                }
    }

    public function truste_looked()
    {
        $member = $this->scenter_check();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['city_id'] = $member['city_id'];
        $filter['status'] = array(
            0,
            1
        );
        $filter['sign_uid'] = "<:1";
        $truste_ids = array();
        if ($items = K::M('truste/truste')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile/scenter/truste/truste_looked.html';
    }
}
