<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Jhbs extends Ctl
{
    
    public function index()
    {
		exit;
		
		$this->seo->init('jhb');
        $this->tmpl = 'jhb/index.html';
    }

    public function sign()
    {
        if(!$data = $this->checksubmit('data')){
            $this->err->add('非法的数据提交', 211);
        }else if(!$data = $this->check_fields($data, 'contact,mobile')){
            $this->err->add('非法的数据提交', 212);
        }else if(K::M('bao/sign')->create($data)){
            $smsdata = $maildata = array('contact'=>$data['contact'], 'mobile'=>$data['mobile']);
            K::M('sms/sms')->send($data['mobile'], 'marry_bao', $smsdata);
            K::M('sms/sms')->admin('admin_marry_bao', $smsdata);
            K::M('helper/mail')->sendadmin('admin_marry_bao', $maildata);
            $this->err->add('报名成功，结婚助理稍后会与您取得联系');
        }
    }

}