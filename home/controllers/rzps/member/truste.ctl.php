<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Rzps_Member_Truste extends Ctl_Rzps_Ruanzhuangpeishi
{

    private $_truste_allow_fields = 'city_id,area_id,contact,mobile,photo,cate_id,budget,truste,addr,comment,max_look,gold';

    public function index($page = 1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if ($items = K::M('truste/truste')->items($filter, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('truste:truste', array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'rzps/member/truste/index.html';
    }

    public function trusteDetail($truste_id = null)
    {
        if (! $truste_id = (int) $truste_id) {
            $this->error(404);
        } else 
            if (! $detail = K::M('truste/truste')->detail($truste_id)) {
                $this->err->add('查看的维修不存在或已经删除', 211);
            } else 
                if ($detail['uid'] != $this->uid) {
                    $this->err->add('您没有权限查看该维修', 212);
                } else {
                    
                    if ($look_list = K::M('truste/look')->items_by_truste($truste_id)) {
                        $uids = array();
                        foreach ($look_list as $k => $v) {
                            $uids[$v['uid']] = $v['uid'];
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
                    }
                    $this->pagedata['cates'] = K::M('truste/cate')->items(array(
                        'closed' => '0',
                        'audit' => '1'
                    ));
                    $this->pagedata['pager'] = $pager;
                    $this->pagedata['detail'] = $detail;
                    $this->tmpl = 'rzps/member/truste/trusteDetail.html';
                }
    }

    public function trusteEdit($truste_id = null)
    {
        if (! ($truste_id = (int) $truste_id) && ! ($truste_id = (int) $this->GP('truste_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('truste/truste')->detail($truste_id)) {
                $this->err->add('查看的维修不存在或已经删除', 211);
            } else 
                if ($detail['uid'] != $this->uid) {
                    $this->err->add('您没有权限操作该维修', 212);
                } else 
                    if ($data = $this->checksubmit('data')) {
                        if (! $this->check_fields($data, $this->_truste_allow_fields)) {
                            $this->err->add('非法的数据提交', 213);
                        }
                        if ($attach = $_FILES['photo']) {
                            $upload = K::M('magic/upload');
                            if ($attach['error'] == UPLOAD_ERR_OK) {
                                if ($a = $upload->upload($attach, 'truste', $detail['photo'])) {
                                    $data['photo'] = $a['photo'];
                                }
                            }
                        }
                        if ($detail['is_pay'] == 1) {
                            unset($data['truste']);
                        }
                        if (K::M('truste/truste')->update($truste_id, $data)) {
                            $this->err->add('完善维修信息成功');
                        }
                    } else {
                        $this->pagedata['cates'] = K::M('truste/cate')->items(array(
                            'closed' => '0',
                            'audit' => '1'
                        ));
                        $this->pagedata['detail'] = $detail;
                        $this->tmpl = 'rzps/member/truste/trusteEdit.html';
                    }
    }

    public function signLook($look_id)
    {
        if (! $look_id = (int) $look_id) {
            $this->error(404);
        } else 
            if (! $look = K::M('truste/look')->detail($look_id)) {
                $this->err->add('竞标不存在或已经删除', 211);
            } else 
                if (! $truste = K::M('truste/truste')->detail($look['truste_id'])) {
                    $this->err->add('维修不存或已经删除', 212);
                } else 
                    if ($truste['uid'] != $this->uid) {
                        $this->err->add('你没有权限操作该维修信息', 213);
                    } else 
                        if ($truste['sign_uid']) {
                            $this->err->add('已经有中标者，不可重复设置', 215);
                        } else 
                            if (! $member = K::M('member/member')->detail($look['uid'])) {
                                $this->err->add('该投标用户不存在', 216);
                            } else 
                                if (K::M('truste/look')->sign($look_id)) {
                                    switch ($member['from']) {
                                        case 'gz':
                                            K::M('gz/gz')->update_count($look['uid'], 'truste_sign');
                                            break;
                                        case 'designer':
                                            K::M('designer/designer')->update_count($look['uid'], 'truste_sign');
                                            break;
                                        case 'mechanic':
                                            K::M('mechanic/mechanic')->update_count($look['uid'], 'truste_sign');
                                            break;
                                        case 'company':
                                            $company = K::M('company/company')->items(array(
                                                'uid' => $look['uid']
                                            ));
                                            foreach ($company as $k => $v) {
                                                $this->company['company_id'] = $v['company_id'];
                                            }
                                            K::M('company/company')->update_count($this->company['company_id'], 'truste_sign');
                                        case 'shop':
                                            $shop = K::M('shop/shop')->items(array(
                                                'uid' => $look['uid']
                                            ));
                                            foreach ($shop as $k => $v) {
                                                $this->company['shop_id'] = $v['shop_id'];
                                            }
                                            K::M('shop/shop')->update_count($this->shop['shop_id'], 'truste_sign');
                                            break;
                                    }
                                    $this->err->add('设置中标成功');
                                }
    }

    public function comments($truste_id = null)
    {
        if (! ($truste_id = (int) $truste_id) && ! ($truste_id = (int) $this->GP('truste_id'))) {
            $this->error(404);
        } else 
            if (! $truste = K::M('truste/truste')->detail($truste_id)) {
                $this->err->add('招标不存在或已经删除', 212);
            } else 
                if ($truste['status'] < 0) {
                    $this->err->add('该招标已经作废，不可评论!', 212);
                } else 
                    if ($truste['uid'] != $this->uid) {
                        $this->err->add('权限不足不能评论!', 212);
                    } else 
                        if ($truste['sign_from'] == 'mechanic') {
                            $this->err->add('技工暂没开启评价功能!', 215);
                        } else 
                            if (! $truste['sign_from']) {
                                $this->err->add('数据出错!', 215);
                            } else 
                                if ($truste['comment_id']) {
                                    $this->err->add('您已经评价过了', 215);
                                } else 
                                    if ($data = $this->checksubmit('data')) {
                                        if ($data['content'] == '') {
                                            $this->err->add('评论内容不能为空', 214);
                                        } else {
                                            $data['uid'] = $this->uid;
                                            $data[$truste['sign_from'] . '_id'] = $truste['sign_uid'];
                                            $data['city_id'] = $this->request['city_id'];
                                            $data['audit'] = $audit;
                                            $data['truste_id'] = $truste_id;
                                            if ($comment = K::M($truste['sign_from'] . '/comment')->create($data)) {
                                                if ($truste['sign_from'] != 'shop') {
                                                    K::M($truste['sign_from'] . '/comment')->comment($data);
                                                }
                                                $truste = K::M('truste/truste')->update($truste_id, array(
                                                    'comment_id' => $comment
                                                ));
                                                $this->err->add('评论成功！');
                                            }
                                        }
                                    } else {
                                        $this->pagedata['truste_id'] = $truste_id;
                                        $this->tmpl = 'rzps/member/truste/comments.html';
                                    }
    }

    public function ended($truste_id)
    {
        if (! ($truste_id = (int) $truste_id) && ! ($truste_id = (int) $this->GP('truste_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('truste/truste')->detail($truste_id)) {
                $this->err->add('查看的维修不存在或已经删除', 211);
            } else 
                if ($detail['uid'] != $this->uid) {
                    $this->err->add('您没有权限操作该维修', 212);
                } else {
                    
                    if ($detail['is_pay'] == 1) {
                        $log = K::M('payment/log')->items(array(
                            'truste_id' => $truste_id,
                            'payed' => '1'
                        ));
                        $d = reset($log);
                        if ($d['amount'] == $detail['truste']) {
                            K::M('member/member')->update_money($detail['sign_uid'], $detail['truste'], '维修招标完工：ID(' . $truste_id . ')，标题:' . $detail['title']);
                            K::M('truste/truste')->update($truste_id, array(
                                'status' => 2
                            ));
                        } else {
                            K::M('member/member')->update_money($detail['sign_uid'], $d['amount'], '维修招标完工：ID(' . $truste_id . ')，标题:' . $detail['title']);
                            K::M('truste/truste')->update($truste_id, array(
                                'status' => 2
                            ));
                        }
                    } else {
                        K::M('truste/truste')->update($truste_id, array(
                            'status' => 2
                        ));
                    }
                    
                    $this->err->add('设置完工成功');
                }
    }
}