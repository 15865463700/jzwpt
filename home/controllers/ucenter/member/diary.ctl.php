<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Ucenter_Member_Diary extends Ctl_Ucenter
{

    protected $_allow_fields = 'title,home_id,thumb,uid,company_id,home_name,type_id,way_id,total_price,start_date,end_date,meter,ctitle';

    protected $_allow_detail_fields = 'status,content';

    public function index($page = 1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['uid'] = $this->uid;
        $filter['closed'] = 0;
        if ($items = K::M('diary/diary')->items($filter, null, $page, $limit, $count)) {
            foreach ($items as $k => $v) {
                if ($v['home_id']) {
                    $home_ids[$v['home_id']] = $v['home_id'];
                }
                if ($v['company_id']) {
                    $company_ids[$v['company_id']] = $v['company_id'];
                }
            }
            if (! empty($home_ids)) {
                $this->pagedata['home_list'] = K::M('home/home')->items_by_ids($home_ids);
            }
            if (! empty($company_ids)) {
                $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($company_ids);
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
        }
        
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['status'] = K::M('home/site')->get_status();
        $this->tmpl = 'ucenter/member/diary/items.html';
    }

    public function create()
    {
        $member = K::M('member/member')->detail($this->uid);
        if (K::M('member/integral')->check('diary', $this->MEMBER) === false) {
            $this->err->add('很抱歉您的账户余额不足！', 201);
        } else 
            if ($data = $this->checksubmit('data')) {
                $allow_diary = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_diary');
                if ($allow_diary < 0) {
                    $this->err->add('您是【' . $this->MEMBER['group_name'] . '】没有权限添加装修日记', 333);
                } else 
                    if (! $data = $this->check_fields($data, $this->_allower_fields)) {
                        $this->err->add('非法的数据提交', 201);
                    } else {
                        if ($attach = $_FILES['thumb']) {
                            $cfg = K::$system->config->get('attach');
                            if ($attach['error'] == UPLOAD_ERR_OK) {
                                if ($a = K::M('magic/upload')->upload($attach, 'diary')) {
                                    $data['thumb'] = $a['photo'];
                                    $size['photo'] = $cfg['diary']['photo'] ? $cfg['diary']['photo'] : 200;
                                    K::M('image/gd')->thumbs($a['file'], array(
                                        $size['photo'] => $a['file']
                                    ));
                                }
                            }
                        }
                        $data['city_id'] = $this->MEMBER['city_id'];
                        $data['uid'] = $this->uid;
                        $data['audit'] = $allow_diary;
                        if ($diary_id = K::M('diary/diary')->create($data)) {
                            K::M('member/integral')->commit('diary', $this->MEMBER, '发布日记');
                            $this->err->add('添加日记成功');
                            $this->err->set_data('forward', $this->mklink('ucenter/member/diary:index'));
                        }
                    }
            } else {
                $this->pagedata['status'] = K::M('home/site')->get_status();
                $this->pagedata['setting'] = K::M('tenders/setting')->fetch_all_setting();
                $this->pagedata['type'] = K::M('tenders/setting')->get_type();
                $pager['city_id'] = $member['city_id'];
                $this->pagedata['pager'] = $pager;
                $this->tmpl = 'ucenter/member/diary/create.html';
            }
    }

    public function edit($diary_id = null)
    {
        if (! ($diary_id = (int) $diary_id) && ! ($diary_id = (int) $this->GP('diary_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('diary/diary')->detail($diary_id)) {
                $this->err->add('装修日记不存在或已经删除', 211);
            } else 
                if ($detail['uid'] != $this->uid) {
                    $this->err->add('不许越权管理别人的内容', 212);
                } else 
                    if ($data = $this->checksubmit('data')) {
                        if (K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_diary') < 0) {
                            $this->err->add('您是【' . $this->MEMBER['group_name'] . '】没有权限添加装修日记', 333);
                        } else 
                            if (! $data = $this->check_fields($data, $this->_allower_fields)) {
                                $this->err->add('非法的数据提交', 201);
                            } else {
                                if ($attach = $_FILES['thumb']) {
                                    $cfg = K::$system->config->get('attach');
                                    if ($attach['error'] == UPLOAD_ERR_OK) {
                                        if ($a = K::M('magic/upload')->upload($attach, 'diary')) {
                                            $data['thumb'] = $a['photo'];
                                            $size['photo'] = $cfg['diary']['photo'] ? $cfg['diary']['photo'] : 200;
                                            K::M('image/gd')->thumbs($a['file'], array(
                                                $size['photo'] => $a['file']
                                            ));
                                        }
                                    }
                                }
                                if ($diary_id = K::M('diary/diary')->update($diary_id, $data)) {
                                    $this->err->add('修改装修日记成功');
                                }
                            }
                    } else {
                        if ($home_id = $detail['home_id']) {
                            $this->pagedata['home'] = K::M('home/home')->detail($home_id);
                        }
                        if ($company_id = $detail['company_id']) {
                            $this->pagedata['company'] = K::M('company/company')->detail($company_id);
                        }
                        $this->pagedata['detail'] = $detail;
                        $this->pagedata['status'] = K::M('home/site')->get_status();
                        $this->pagedata['setting'] = K::M('tenders/setting')->fetch_all_setting();
                        $this->pagedata['type'] = K::M('tenders/setting')->get_type();
                        $pager['city_id'] = $member['city_id'];
                        $this->pagedata['pager'] = $pager;
                        $this->tmpl = 'ucenter/member/diary/edit.html';
                    }
    }

    public function delete($diary_id = null)
    {
        if (! ($diary_id = (int) $diary_id) && ! ($diary_id = (int) $this->GP('diary_id'))) {
            $this->error(404);
        } else 
            if (! $diary = K::M('diary/diary')->detail($diary_id)) {
                $this->err->add('装修日记不存在或已经删除', 212);
            } else 
                if ($diary['uid'] != $this->uid) {
                    $this->err->add('不许越权管理别人的内容', 212);
                } else 
                    if (K::M('diary/diary')->delete($diary_id)) {
                        $this->err->add('删除装修日记成功');
                    }
    }

    public function detail($diary_id = null, $page = 1)
    {
        if (! $diary_id = (int) $diary_id) {
            $this->error(404);
        } else 
            if (! $diary = K::M('diary/diary')->detail($diary_id)) {
                $this->err->add('装修日记不存在或已经删除', 211);
            } else {
                $pager = array();
                $pager['page'] = max((int) $page, 1);
                $pager['limit'] = $limit = 20;
                $pager['count'] = $count = 0;
                if ($items = K::M('diary/item')->items(array(
                    'diary_id' => $diary_id
                ), null, $page, $limit, $count)) {
                    $pager['count'] = $count;
                    $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                        $diary_id,
                        '{page}'
                    )));
                    $this->pagedata['items'] = $items;
                }
                $this->pagedata['diary'] = $diary;
                $this->tmpl = 'ucenter/member/diary/detail.html';
            }
    }

    public function createDiary($diary_id = null)
    {
        if (! ($diary_id = (int) $diary_id) && ! ($diary_id = (int) $this->GP('diary_id'))) {
            $this->error(404);
        } else 
            if (! $diary = K::M('diary/diary')->detail($diary_id)) {
                $this->err->add('装修日记不存在或已经删除', 211);
            } else 
                if ($diary['uid'] != $this->uid) {
                    $this->err->add('不许越权管理别人的内容', 212);
                } else 
                    if ($data = $this->checksubmit('data')) {
                        if (K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_diary') < 0) {
                            $this->err->add('您是【' . $this->MEMBER['group_name'] . '】没有权限添加日记', 333);
                        } else 
                            if (! $data = $this->check_fields($data, $this->_allow_detail_fields)) {
                                $this->err->add('非法的数据提交', 213);
                            } else {
                                $data['diary_id'] = $diary_id;
                                $status_list = K::M('diary/item')->diary_status($diary_id);
                                if ($detail_id = K::M('diary/item')->create($data)) {
                                    $a = array(
                                        'content_num' => $diary['content_num'] + 1
                                    );
                                    $status = (int) $data['status'];
                                    if ($status > $diary['status']) {
                                        $a['status'] = $status;
                                    }
                                    K::M('diary/diary')->update($diary_id, $a);
                                    $this->err->add('添加日记文章成功');
                                    $this->err->set_data('forward', $this->mklink('ucenter/member/diary:detail', array(
                                        $diary_id
                                    )));
                                }
                            }
                    } else {
                        $this->pagedata['diary'] = $diary;
                        $status_list = K::M('diary/item')->diary_status($diary['diary_id']);
                        $this->pagedata['status_list'] = $status_list;
                        $this->tmpl = 'ucenter/member/diary/createDiary.html';
                    }
    }

    public function editDiary($item_id = null)
    {
        if (! ($item_id = (int) $item_id) && ! ($item_id = (int) $this->GP('item_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('diary/item')->detail($item_id)) {
                $this->err->add('日记文章不存在或已经删除', 211);
            } else 
                if (! $diary = K::M('diary/diary')->detail($detail['diary_id'])) {
                    $this->err->add('装修日记不存在或已经删除', 211);
                } else 
                    if ($diary['uid'] != $this->uid) {
                        $this->err->add('不许越权管理别人的内容', 212);
                    } else 
                        if ($data = $this->checksubmit('data')) {
                            if (K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_diary') < 0) {
                                $this->err->add('您是【' . $this->MEMBER['group_name'] . '】没有权限修改日记', 333);
                            } else 
                                if (! $data = $this->check_fields($data, $this->_allow_detail_fields)) {
                                    $this->err->add('非法的数据提交', 213);
                                } else {
                                    if (K::M('diary/item')->update($item_id, $data)) {
                                        $status = (int) $data['status'];
                                        if ($status > $diary['status']) {
                                            K::M('diary/diary')->update($diary['diary_id'], array(
                                                'status' => $status
                                            ));
                                        }
                                        $this->err->add('修改日记文章成功');
                                    }
                                }
                        } else {
                            $this->pagedata['diary'] = $diary;
                            $this->pagedata['detail'] = $detail;
                            $this->pagedata['status_list'] = K::M('home/site')->get_status();
                            $this->tmpl = 'ucenter/member/diary/editDiary.html';
                        }
    }

    public function deleteDiary($item_id = null)
    {
        if (! ($item_id = (int) $item_id) && ! ($item_id = (int) $this->GP('item_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('diary/item')->detail($item_id)) {
                $this->err->add('日记文章不存在或已经删除', 211);
            } else 
                if (! $diary = K::M('diary/diary')->detail($detail['diary_id'])) {
                    $this->err->add('装修日记不存在或已经删除', 211);
                } else 
                    if ($diary['uid'] != $this->uid) {
                        $this->err->add('不许越权管理别人的内容', 212);
                    } else 
                        if (K::M('diary/item')->delete($item_id)) {
                            K::M('diary/diary')->update_count($diary['diary_id'], 'content_num', - 1);
                            $this->err->add('删除日记文章成功');
                        }
    }

    public function photo($diary_id = null, $page = 1)
    {
        if (! ($diary_id = (int) $diary_id) && ! ($diary_id = (int) $this->GP('diary_id'))) {
            $this->error(404);
        } else
            if (! $diary = K::M('diary/diary')->detail($diary_id)) {
                $this->err->add('您要查看的内容不存在或已经删除', 212);
            } else
                if ($diary['uid'] != $this->uid) {
                    $this->err->add('不许越权管理别人的内容', 212);
                } else {
                    $pager = array(
                        'diary_id' => $diary_id
                    );
                    $pager['page'] = (int) $page;
                    $pager['limit'] = $limit = 20;
                    $pager['count'] = $count = 0;
                    $this->pagedata['detail'] = $diary;
                    if ($items = K::M('diary/photo')->items_by_diary($diary_id, $page, $limit, $count)) {
                        $this->pagedata['items'] = $items;
                        $pager['count'] = $count;
                        $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("ucenter/member/diary/photo", array(
                            $diary_id,
                            '{page}'
                        )));
                    }
                    $this->pagedata['pager'] = $pager;
                    $this->tmpl = 'ucenter/member/diary/photo.html';
                }
    }

    public function upload($diary_id = null)
    {
        if (! $diary = K::M('diary/diary')->detail($diary_id)) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        } else{
            if (! $diary = K::M('diary/diary')->detail($diary_id)) {
                $this->err->add('日记不存在或已经删除', 202);
            } elseif ($diary['uid'] != $this->uid) {
                $this->err->add('不许越权管理别人的内容', 212);
            } else{
                if (! $attach = $_FILES['Filedata']) {
                    $this->err->add('上传图片失败', 401);
                } else{
                    if (UPLOAD_ERR_OK != $attach['error']) {
                        $this->err->add('上传图片失败', 402);
                    } else {
                        if ($data = K::M('diary/photo')->upload($diary_id, $attach)) {
//                                if ($allow_diary != $diary['audit'] && empty($diary['photos'])) {
//                                    K::M('diary/diary')->update($diary_id, array(
//                                        'audit' => $allow_diary
//                                    ));
//                                }
                            $cfg = $this->system->config->get('attach');
                            $this->err->set_data('photo', $cfg['attachurl'] . '/' . $data['photo']);
                            $this->err->add('上传图片成功');
                        }
                    }
                }
            }
        }
        $this->err->json();
    }

    public function update($diary_id = null)
    {
        if (! ($diary_id = (int) $diary_id) && ! ($diary_id = (int) $this->GP('diary_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else
            if (! $detail = K::M('diary/diary')->detail($diary_id)) {
                $this->err->add('您要修改的内容不存在或已经删除', 212);
            } else
                if($detail['uid'] != $this->uid) {
                    $this->err->add('不许越权管理别人的内容', 212);
                } else
                    if ($data = $this->checksubmit('data')) {
                        $photo_ids = array();
                        foreach ($data as $k => $v) {
                            $photo_ids[$k] = $k;
                        }
                        if (empty($photo_ids)) {
                            $this->err->add('没有您要更新的内容', 212);
                        } else
                            if (! $photoinfos = K::M('diary/photo')->items_by_ids($photo_ids)) {
                                $this->err->add('没有您要更新的内容', 212);
                            } else {
                                $obj = K::M('diary/photo');
                                foreach ($data as $k => $v) {
                                    if ($photoinfos[$k]['diary_id'] == $diary_id) {
                                        if ($v['title'] != $photoinfos[$k]['title']) {
                                            $obj->update($k, array(
                                                'title' => $v['title']
                                            ));
                                        }
                                    }
                                }
                                $this->err->add('更新成功');
                            }
                    }
    }

    public function defaultphoto($photo_id = null)
    {
        if (! ($photo_id = (int) $photo_id) && ! ($photo_id = (int) $this->GP('photo_id'))) {
            $this->error(404);
        } else
            if (! $detail = K::M('diary/photo')->detail($photo_id)) {
                $this->err->add('日记不存在或已经删除', 211);
            } else
                if (! $diary = K::M('diary/diary')->detail($detail['diary_id'])) {
                    $this->err->add('日记不存在或已经删除', 212);
                } else
                    if($diary['uid'] != $this->uid) {
                        $this->err->add('不许越权管理别人的内容', 213);
                    } else {
                        if (K::M('diary/diary')->update($detail['diary_id'], array(
                            'photo' => $detail['photo']
                        ))) {
                            $this->err->add('修改封面成功');
                        }
                    }
    }

    public function deletephoto($photo_id = null)
    {
        if (! ($photo_id = (int) $photo_id) && ! ($photo_id = (int) $this->GP('photo_id'))) {
            $this->error(404);
        } else{
            if (! $detail = K::M('diary/photo')->detail($photo_id)) {
                $this->err->add('日记不存在或已经删除', 211);
            } else{
                if (! $diary = K::M('diary/diary')->detail($detail['diary_id'])) {
                    $this->err->add('案例不存在或已经删除', 212);
                } else{
                    if($diary['uid'] != $this->uid) {
                        $this->err->add('不许越权管理别人的内容', 213);
                    } else {
                        if (K::M('diary/photo')->delete($photo_id)) {
                            $this->err->add('删除效果图成功');
                        }
                    }
                }
            }
        }
    }

}