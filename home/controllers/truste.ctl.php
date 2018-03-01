<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
class Ctl_Truste extends Ctl
{

    private $_truste_allow_fields = 'city_id,area_id,contact,mobile,photo,cate_id,budget,truste,addr,comment,max_look,gold,title';

    public function index()
    {
        $this->check_login();
        $this->pagedata['cates'] = K::M('truste/cate')->items(array(
            'closed' => '0',
            'audit' => '1'
        ));
        $this->tmpl = 'truste/index.html';
    }

    public function save()
    {
        $this->check_login();
        if ($data = $this->checksubmit('data')) {
            if (! $data = $this->check_fields($data, $this->_truste_allow_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
                $weixiu = $this->system->config->get('weixiu');
                $data['uid'] = (int) $this->uid;
                if (empty($data['city_id'])) {
                    $data['city_id'] = $this->request['city_id'];
                }
                if (empty($data['contact']) && ($this->uid)) {
                    $data['contact'] = $this->MEMBER['uname'];
                }
                if ($attach = $_FILES['photo']) {
                    if (UPLOAD_ERR_OK == $attach['error']) {
                        if ($a = K::M('magic/upload')->upload($attach, 'truste')) {
                            $data['photo'] = K::M('content/html')->encode($a['photo']);
                        }
                    }
                }
                $weixiu = $this->system->config->get('weixiu');
                $data['gold'] = $weixiu['gold'];
                $data['max_look'] = $weixiu['max_look'];
                
                if ($truste_id = K::M('truste/truste')->create($data)) {
                    $this->pagedata['truste_id'] = $truste_id;
                    $smsdata = $maildata = array(
                        'contact' => $data['contact'] ? $data['contact'] : '业主',
                        'mobile' => $data['mobile']
                    );
                    K::M('sms/sms')->send($data['mobile'], 'truste', $smsdata);
                    K::M('sms/sms')->admin('admin_truste', $smsdata);
                    K::M('helper/mail')->sendadmin('admin_truste', $maildata);
                    $this->tmpl = 'truste/success.html';
                    $this->err->set_data('forward', $this->mklink('ucenter/member/truste:trusteDetail', array(
                        $truste_id
                    )));
                    $this->err->add('恭喜您发布维修成功！');
                }
            }
        } else {
            $this->err->add('非法的数据提交', 201);
        }
    }
}