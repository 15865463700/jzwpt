<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Afzn_Weixin_Addon_Packet extends Ctl_Afzn_Anfangzhineng
{

    protected $_allow_fields = 'title,keyword,msg_pic,desc,info,start_time,end_time,ext_total,get_number,value_count,is_open,item_num,item_sum,item_max,item_unit,packet_type,deci,people,password';

    public function index($page = 1)
    {
        $weixin = $this->ucenter_weixin();
        $pager = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['page'] = $limit = 30;
        $pager['page'] = $count = 0;
        if ($items = K::M('weixin/packet')->items(array(
            'wx_id' => $weixin['wx_sid']
        ), null, $page, $limit, $count)) {
            $pgaer['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $this->pagedata['items'] = $items;
        }
        $this->tmpl = 'afzn/weixin/addon/packet/index.html';
    }

    public function create()
    {
        $weixin = $this->ucenter_weixin();
        if ($data = $this->checksubmit('data')) {
            if ($_FILES['data']) {
                foreach ($_FILES['data'] as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        $attachs[$kk][$k] = $vv;
                    }
                }
                $upload = K::M('magic/upload');
                foreach ($attachs as $k => $attach) {
                    if ($attach['error'] == UPLOAD_ERR_OK) {
                        if ($a = $upload->upload($attach, 'weixin')) {
                            $data[$k] = $a['photo'];
                        }
                    }
                }
            }
            $data['wx_id'] = $weixin['wx_sid'];
            if (! $items = K::M('weixin/keyword')->items(array(
                'keyword' => $data['keyword'],
                'wx_id' => $weixin['wx_id']
            ))) {
                if ($id = K::M('weixin/packet')->create($data)) {
                    $keyword = array();
                    $keyword['wx_id'] = $weixin['wx_id'];
                    $keyword['wx_sid'] = $weixin['wx_sid'];
                    $keyword['keyword'] = $data['keyword'];
                    $keyword['plugin'] = 'packet:' . $id;
                    K::M('weixin/keyword')->create($keyword);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', 'packet/index.html');
                }
            } else {
                $this->err->add('该关键字已经被使用，请修改关键字', 212);
            }
        } else {
            $this->tmpl = 'afzn/weixin/addon/packet/create.html';
        }
    }

    public function edit($id = null)
    {
        $weixin = $this->ucenter_weixin();
        if (! ($id = (int) $id) && ! ($id = $this->GP('id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else 
            if (! $detail = K::M('weixin/packet')->detail($id)) {
                $this->err->add('您要修改的内容不存在或已经删除', 212);
            } else 
                if ($data = $this->checksubmit('data')) {
                    if ($_FILES['data']) {
                        foreach ($_FILES['data'] as $k => $v) {
                            foreach ($v as $kk => $vv) {
                                $attachs[$kk][$k] = $vv;
                            }
                        }
                        $upload = K::M('magic/upload');
                        foreach ($attachs as $k => $attach) {
                            if ($attach['error'] == UPLOAD_ERR_OK) {
                                if ($a = $upload->upload($attach, 'weixin')) {
                                    $data[$k] = $a['photo'];
                                }
                            }
                        }
                    }
                    unset($data['keyword']);
                    if (K::M('weixin/packet')->update($id, $data)) {
                        $this->err->add('修改内容成功');
                    }
                } else {
                    $this->pagedata['detail'] = $detail;
                    $this->tmpl = 'afzn/weixin/addon/packet/edit.html';
                }
    }

    public function preview($id = null, $wx_id)
    {
        $url = $this->request['city']['siteurl'] . '/weixin/packet-index-' . $id . '-' . $wx_id . '.html';
        echo '<img alt="模式一扫码支付" src="/qrcode?data=' . urlencode($url) . '&size=11"/>';
        exit();
    }

    public function delete($id = null)
    {
        $weixin = $this->ucenter_weixin();
        if ($id = (int) $id) {
            if (! $detail = K::M('weixin/packet')->detail($id)) {
                $this->err->add('你要删除的内容不存在或已经删除', 211);
            } else {
                if ($items = K::M('weixin/keyword')->items(array(
                    'keyword' => $detail['keyword'],
                    'wx_id' => $weixin['wx_id']
                ))) {
                    if (K::M('weixin/packet')->delete($id)) {
                        foreach ($items as $k => $v) {
                            K::M('weixin/keyword')->delete($v['kw_id']);
                        }
                        $this->err->add('删除内容成功');
                    }
                } else {
                    $this->err->add('非法操作');
                }
            }
        }
    }

    public function sn($id, $page_id)
    {
        if (! ($id = (int) $id) && ! ($id = $this->GP('id'))) {
            $this->err->add('没有指定红包ID', 211);
        } else 
            if (! $detail = K::M('weixin/packet')->detail($id)) {
                $this->err->add('该红包不存在或已经删除', 212);
            } else {
                $filter = $pager = array();
                $pager['page'] = max(intval($page), 1);
                $pager['limit'] = $limit = 50;
                $filter['packet_id'] = $id;
                if ($items = K::M('weixin/packetsn')->items($filter, null, $page, $limit, $count)) {
                    $pager['count'] = $count;
                    $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                        '{page}'
                    )), array(
                        'SO' => $SO
                    ));
                }
                $this->pagedata['items'] = $items;
                $this->pagedata['detail'] = $detail;
                $this->pagedata['pager'] = $pager;
                $this->tmpl = 'afzn/weixin/addon/packet/sn.html';
            }
    }

    public function sndelete($id = null)
    {
        $weixin = $this->ucenter_weixin();
        if ($id = (int) $id) {
            if (! $detail = K::M('weixin/packetsn')->detail($id)) {
                $this->err->add('你要删除的内容不存在或已经删除', 211);
            } else {
                if (K::M('weixin/packetsn')->delete($id)) {
                    $this->err->add('删除内容成功');
                }
            }
        } else 
            if ($ids = $this->GP('id')) {
                if (K::M('weixin/packetsn')->delete($ids)) {
                    $this->err->add('批量删除内容成功');
                }
            } else {
                $this->err->add('未指定要删除的内容ID', 401);
            }
    }

    public function logs($id, $page_id)
    {
        if (! ($id = (int) $id) && ! ($id = $this->GP('id'))) {
            $this->err->add('没有指定红包ID', 211);
        } else 
            if (! $detail = K::M('weixin/packet')->detail($id)) {
                $this->err->add('该红包不存在或已经删除', 212);
            } else {
                $filter = $pager = array();
                $pager['page'] = max(intval($page), 1);
                $pager['limit'] = $limit = 50;
                $filter['packet_id'] = $id;
                if ($items = K::M('weixin/packetling')->items($filter, null, $page, $limit, $count)) {
                    $pager['count'] = $count;
                    $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                        '{page}'
                    )), array(
                        'SO' => $SO
                    ));
                }
                $this->pagedata['items'] = $items;
                $this->pagedata['detail'] = $detail;
                $this->pagedata['pager'] = $pager;
                $this->tmpl = 'afzn/weixin/addon/packet/logs.html';
            }
    }

    public function logsdelete($id = null)
    {
        $weixin = $this->ucenter_weixin();
        if ($id = (int) $id) {
            if (! $detail = K::M('weixin/packetling')->detail($id)) {
                $this->err->add('你要删除的内容不存在或已经删除', 211);
            } else {
                if (K::M('weixin/packetling')->delete($id)) {
                    $this->err->add('删除内容成功');
                }
            }
        } else 
            if ($ids = $this->GP('id')) {
                if (K::M('weixin/packetling')->delete($ids)) {
                    $this->err->add('批量删除内容成功');
                }
            } else {
                $this->err->add('未指定要删除的内容ID', 401);
            }
    }

    protected function wechat_client()
    {
        static $client = null;
        if ($client === null) {
            if (! $client = K::M('weixin/weixin')->admin_wechat_client()) {
                exit('网站公众号设置错误');
            }
        }
        return $client;
    }

    protected function access_openid($force = false)
    {
        static $openid = null;
        if ($force || $openid === null) {
            if ($code = $this->GP('code')) {
                $client = $this->wechat_client();
                $ret = $client->getAccessTokenByCode($code);
                $openid = $ret['openid'];
            } else {
                if (! $openid = $this->cookie->get('wx_openid')) {
                    $client = $this->wechat_client();
                    $url = $this->request['url'] . '/' . $this->request['uri'];
                    $authurl = $client->getOAuthConnectUri($url, $state, 'snsapi_userinfo');
                    header('Location:' . $authurl);
                    exit();
                }
            }
            $this->cookie->set('wx_openid', $openid);
        }
        if (empty($openid)) {
            exit('获取授权失败');
        }
        return $openid;
    }
}