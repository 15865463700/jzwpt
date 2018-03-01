<?php
Import::I('sms');
class Mdl_Sms_Qxt implements Sms_Interface
{
    protected $gateway = 'http://api.cnsms.cn/?ac=send&uid=%s&pwd=%s&mobile=%s&content=%s&encode=utf8';
    protected $_cfg = array();
    public $tag='qxt';
    public $lastmsg = '未知的错误';
	public $lastcode = 1;

    public function __construct($system)
    {
    	$this->_cfg = $system->config->get('sms');
    }
    
    public function send($mobile, $content)
    {
    	if($ret = @file_get_contents(sprintf("{$this->gateway}",$this->_cfg['uname'],$this->_cfg['passwd'],$mobile,$content))){
    		if($ret == 100){
    		    $this->lastmsg = "发送成功!";
    			return true;
    		}else{
                switch($ret){
				   case 101:$error='验证失败';break;
				   case 107:$error='频率过快';break;
				   case 108:$error='新密不为空';break;
				   case 109:$error='账号已冻结';break;
				   case 114:$error='账号被锁';break;
				   case 115:$error='操作失败';break;
				   case 116:$error='禁止接口发送';break;
				   case 117:$error='绑定IP不正确';break;
				}
				$this->lastcode = $ret;
                !empty($error)?$this->lastmsg = $error:false;
    		}
    	}
    	return false;
    }
}