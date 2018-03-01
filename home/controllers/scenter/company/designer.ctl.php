<?php

class Ctl_Scenter_Company_Designer extends Ctl_Scenter{

    protected $_allow_fields = 'title,content';

    public function index()
    {
        $company = $this->ucenter_company();
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter = array(
            'company_id' => $company['company_id']
        );
        if ($items = K::M('company/designer')->items($filter, null, $page, $limit, $count)) {
            $pgaer['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'scenter/company/designer/items.html';
    }
    //添加设计师
    public function create(){
        $company = $this->ucenter_company();
        if ($data = $this->checksubmit('data')) {
            if ($attach = $_FILES['thumb']) {
                if ($attach['error'] == UPLOAD_ERR_OK) {
                    if ($a = K::M('magic/upload')->upload($attach, 'company_designer')) {
                        $data['thumb'] = $a['photo'];
                        $size['photo'] = $cfg['site']['photo'] ? $cfg['site']['photo'] : 200;
                        K::M('image/gd')->thumbs($a['file'], array(
                            $size['photo'] => $a['file']
                        ));
                    }
                }
            }
                $data['dateline'] = time();
                if ($designer_id = K::M('company/designer')->create($data)) {
                    $this->err->add('添加公司设计师成功');
                    $this->err->set_data('forward', $this->mklink('scenter/company/designer:index'));
                }
        } else {
            $this->pagedata['jingyan'] = K::M('company/designer')->jingyan();
            $this->pagedata['leixing'] = K::M('company/designer')->leixing();
            $this->pagedata['zhiwei'] = K::M('company/designer')->zhiwei();
            $this->pagedata['company'] = $company;
            $this->tmpl = 'scenter/company/designer/create.html';
        }
    }
   //修改设计师
   //
    public function edit($designer_id = null)
    {
        $company = $this->ucenter_company();
        if (! ($designer_id = (int) $designer_id) && ! ($designer_id = (int) $this->GP('designer_id'))) {
            $this->err->add('未定义操作', 211);
        } else {
            if (! $detail = K::M('company/designer')->detail($designer_id)) {
                $this->err->add('您要修改的内容不存在或已经删除', 212);
            } else {
                if ($company['company_id'] != $detail['company_id']) {
                    $this->err->add('您没有权限修改该内容', 213);
                } else {
                    if ($data = $this->checksubmit('data')) {
                        if (! $data = $this->check_fields($data, $this->_allow_fields)) {
                            $this->err->add('非法的数据提交', 201);
                        } else {
                           if( $data = $this->checksubmit('data')){
                            if ($attach = $_FILES['thumb']) {
                                if ($attach['error'] == UPLOAD_ERR_OK) {
                                    if ($a = K::M('magic/upload')->upload($attach, 'company_designer')) {
                                        $data['thumb'] = $a['photo'];
                                        $size['photo'] = $cfg['site']['photo'] ? $cfg['site']['photo'] : 200;
                                        K::M('image/gd')->thumbs($a['file'], array(
                                            $size['photo'] => $a['file']
                                        ));
                                    }
                                }
                            }
                            if (K::M('company/designer')->update($designer_id, $data)) {
                              $this->err->add('修改内容成功');
                              $this->err->set_data('forward', $this->mklink('scenter/company/designer:index'));
                            }
                           }else{
                              $this->err->add('修改内容失败');
                              $this->err->set_data('forward', $this->mklink('scenter/company/designer:edit'));
                           }
                            // if (K::M('company/designer')->update($designer_id, $data)) {
                            //     $this->err->add('修改内容成功');
                            //      $this->err->set_data('forward', $this->mklink('scenter/company/designer:index'));
                            // }
                        }
                    } else {
                        $this->pagedata['jingyan'] = K::M('company/designer')->jingyan();
                        $this->pagedata['leixing'] = K::M('company/designer')->leixing();
                        $this->pagedata['zhiwei'] = K::M('company/designer')->zhiwei();
                        $this->pagedata['company'] = $company;
                        $this->pagedata['detail'] = $detail;
                        $pager['city_id'] = $company['city_id'];
                        $this->pagedata['pager'] = $pager;
                        $this->tmpl = 'scenter/company/designer/edit.html';
                    }
                }
            }
        }
    }
    //  public function edit($designer_id = null)
    // {
    //     $company = $this->ucenter_company();
    //     if (! ($designer_id = (int) $designer_id) && ! ($designer_id = (int) $this->GP('designer_id'))) {
    //         $this->err->add('未定义操作', 211);
    //     } else {
    //         if (! $detail = K::M('company/designer')->detail($designer_id)) {
    //             $this->err->add('您要修改的内容不存在或已经删除', 212);
    //         } else {
    //             if ($company['company_id'] != $detail['company_id']) {
    //                 $this->err->add('您没有权限修改该内容', 213);
    //             } else {
    //                 if ($data = $this->checksubmit('data')) {
    //                     if (! $data = $this->check_fields($data, $this->_allow_fields)) {
    //                         $this->err->add('非法的数据提交', 201);
    //                     } else {
    //                         if (K::M('company/designer')->update($designer_id, $data)) {
    //                             $this->err->add('修改内容成功');
    //                         }
    //                     }
    //                 } else {
    //                     $this->pagedata['jingyan'] = K::M('company/designer')->jingyan();
    //                     $this->pagedata['leixing'] = K::M('company/designer')->leixing();
    //                     $this->pagedata['zhiwei'] = K::M('company/designer')->zhiwei();
    //                     $this->pagedata['company'] = $company;
    //                     $this->pagedata['detail'] = $detail;
    //                     $this->tmpl = 'scenter/company/designer/edit.html';
    //                 }
    //             }
    //         }
    //     }
    // }

    public function delete($designer_id = null)
    {
        $company = $this->ucenter_company();
        if (! ($designer_id = (int) $designer_id) && ! ($designer_id = $this->GP('designer_id'))) {
            $this->err->add('未指要删除的设计师', 211);
        } else 
            if (! $detail = K::M('company/designer')->detail($designer_id)) {
                $this->err->add('你要删除的设计师不存或已经删除', 212);
            } else 
                if ($company['company_id'] != $detail['company_id']) {
                    $this->err->add('您没有权限删除该设计师', 213);
                } else {
                    K::M('company/designer')->delete($designer_id);
                    $this->err->add('删除设计师成功');
                }
    }
}