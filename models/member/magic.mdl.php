<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

Import::M('member/member');
class Mdl_Member_Magic extends Mdl_Member_Member
{
    
    public function verify_name($uids, $verify=true)
    {
        if(!$uids = K::M('verify/check')->ids($uids)){
            return false;
        }else if(!$member_list = K::M('member/member')->items_by_ids($uids)){
            return false;
        }
        $hotel_uids = $shop_uids = array();
        foreach($member_list as $v){
            if($v['from'] == 'shop'){
                $shop_uids[$v['uid']] = $v['uid'];
            }else if($v['from'] == 'company'){
                $company_uids[$v['uid']] = $v['uid'];
            }
        }
        $a = "(`verify`|".self::VERIFY_NAME.")";
        if(empty($verify)){
            $a = $a.'^'.self::VERIFY_NAME;
        }
        $sql = "UPDATE ".$this->table($this->_table)." SET `verify`=$a WHERE ".self::field($this->_pk, $uids);        
        if($this->db->Execute($sql)){
            if($this->db->affected_rows()){
                $this->clear_cache($uid);
            }
            if($company_uids){
                K::M('company/company')->verify_name($company_uids, $verify);
            }
            if($shop_uids){
                K::M('shop/shop')->verify_name($shop_uids, $verify);
            }           
            return true;
        }
        return false;
    }
    
    public function verify_mobile($uid, $code)
    {
        if(!$member = K::M('member/member')->member($uid)){
            $this->err->add('要验证用户不存在或已经删除',411);
        }elseif(!$member['mobile']){
            $this->err->add('该用户的手机号码不存在',411);
        }elseif($member['verify'] & self::VERIFY_MOBILE){
            $this->err->add('已经通过验证过了',411);
        }else{
            $session =K::M('system/session')->start();
            $scode =  $session->get('MOBILE_VERIFY_CODE');
            if($code == $scode){
                $a = "(`verify`|".self::VERIFY_MOBILE.")";
                $sql = "UPDATE ".$this->table($this->_table)." SET `verify`=$a WHERE uid='$uid'";
                if($this->db->Execute($sql)){
                    if($this->db->affected_rows()){
                        $this->clear_cache($uid);
                    }
					
					$this->reg_jifen($uid);


                    $this->err->add('手机验证成功',411);
                    return true;
                }else{
                    $this->err->add('更新数据失败',411);
                }                
            }else{
                $this->err->add('验证码不正确',411);
            }
        }
        return false;
    }

	public function reg_jifen($uid)
	{
		if($uid){
			//送积分 		
			$fenxiao = K::$system->config->get('fenxiao');
			K::M('member/member')->update_count($uid,'jifen',$fenxiao['newreg']);
			K::M('fenxiao/log')->log($uid,0, 1,$fenxiao['newreg'], '新注册用户手机验证');

			//送红包
			$packet['title'] = '新用户注册红包';
			$packet['code'] = K::M('member/packet')->create_code();
			$packet['is_use'] = 1;
			$packet['uid'] = $uid;
			$packet['type'] = '1';
			$packet['price'] = '10';
			$packet['man'] = '100';
			$packet['time'] = '30';
			$packet['ltime'] = time()+30*24*60*60;
			K::M('member/packet')->create($packet);

			//如果是用户推荐的
			if($fenxiaoid = $this->cookie->get('fenxiaoid')){
				K::M('member/member')->update_count($fenxiaoid,'jifen',$fenxiao['tuijian']);
				K::M('fenxiao/log')->log($fenxiaoid,0, 1,$fenxiao['tuijian'], '推荐新用户获得积分');
			}
		}
	}
    
    public function send_verify_mobile($uid)
    {   
        if(!$member = K::M('member/member')->member($uid)){
            $this->err->add('要验证用户不存在或已经删除',411);
        }else if(!$member['mobile']){
            $this->err->add('该用户的手机号码不存在',411);
        }else if($member['verify'] & self::VERIFY_MOBILE){
            $this->err->add('已经通过验证过了',411);
        }else if(!$mobile = K::M('verify/check')->mobile($member['mobile'])){
            $this->err->add('您的手机号码不合法',412);
        }else{
            $code = K::M('content/string')->Random(6, 1);
            $session =K::M('system/session')->start();
            $session->set('MOBILE_VERIFY_CODE',$code, 1800); //30分钟有效
            K::M('sms/sms')->send($member['mobile'],'verify_mobile',array('uname'=>$member['uname'], 'verify_code'=>$code));
        } 
    }

    public function verify_mail($uid, $token)
    {
        if(!$member = K::M('member/member')->member($uid)){
            $this->err->add('要验证用户不存在或已经删除',411);
        }else if($member['verify'] & self::VERIFY_MAIL){
            $this->err->add('您已经验证过邮箱了,请勿重复验证',412);
        }else{
            $hash = $this->_create_hash($uid, $member['mail']);
            if(!($token = explode(',',K::M('secure/crypt')->decode($token, $hash)))){
                $this->err->add('无效的验证链接',413);
            }else if($hash != $token[1]){
                $this->err->add('无效的验证链接',414);
            }else if($token[0] != $uid){
                $this->err->add('无效的验证链接',415);
            }else if((intval($token[2])+86400) < __CFG::TIME){
                $this->err->add('验证连接已经过期,有效性为24小时',415);
            }else{
                $a = "(`verify`|".self::VERIFY_MAIL.")";
                $sql = "UPDATE ".$this->table($this->_table)." SET `verify`=$a WHERE uid='$uid'";
                if($this->db->Execute($sql)){
                    if($this->db->affected_rows()){
                        $this->clear_cache($uid);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function verify_no_mail($uid)
    {
        $a = "(`verify`|".self::VERIFY_MAIL.") ^".self::VERIFY_MAIL;
        $sql = "UPDATE ".$this->table($this->_table)." SET `verify`=$a WHERE uid='$uid'";
        if($this->db->Execute($sql)){
            if($this->db->affected_rows()){
                $this->clear_cache($uid);
            }
            return true;
        }
        return false;
    }

    public function create_token($uid, $mail)
    {
        $oCrypt = K::M('secure/crypt');
        $hash = $this->_create_hash($uid ,$mail);
        $time = microtime(true);
        return $oCrypt->encode("{$uid},{$hash},{$time}", $hash);
    }

    public function send_verify_mail($uid)
    {
        if($member = K::M('member/member')->member($uid)){
            $token = $this->create_token($uid, $member['mail']);
            $site = K::$system->config->get('site');
            $link = K::M('helper/link')->mklink('passport:verfiy', "mail-{$member['uid']}-{$token}", array(), 'www');
            return K::M('helper/mail')->sendmail($member['mail'], 'member_verify', array('uname'=>$member['uname'], 'verify_link'=>$link));
        }
        return false;
    }
    
    //通知用户邮件通知接口
    public function mail_notice($uid = 0,$key = null, $data = array()){
        
        if(empty($uid)) return false;         
        if(!$member = K::M('member/member')->member($uid)) return false;        
        if($member['verify'] & self::VERIFY_MAIL) { //通过了邮件认证的才能接受到通知邮件
            $site = K::$system->config->get('site');
            $title = "{$site['title']}邮件通知";
            return K::M('helper/mail')->sendmail($member['mail'], $key, $data);
        }
        return false;
    }

    public function verify_forgot($uid, $token)
    {
        if(!$member = K::M('member/member')->member($uid)){
            $this->err->add('要验证用户不存在或已经删除',411);
        }else{
            $hash = $this->_create_hash($uid, $member['mail']);
            if(!$token = explode(',', K::M('secure/crypt')->decode($token, $hash))){
                $this->err->add('无效的找回密码链接',413);
            }else if($token[0] != $uid){
                $this->err->add('无效的找回密码链接',415);
            }else if((intval($token[2])+86400) < __CFG::TIME){
                $this->err->add('找回密码连接已经过期,有效性为24小时',415);
            }else if($this->_create_hash($uid, $member['mail']) == $token[1]){
                return $member;
            }
        }
        return false;
    }
     public function send_forgot($mobile)
    {
        echo 1;die;
        if(!K::M('verify/check')->phone($mobile)){
            $this->err->add('手机格式不正确',411);
        }else {

            $member = K::M('member/member')->member($mobile,'mobile');
         if(!$member){
            $this->err->add('该手機號碼不存在',411);
        }else{
            $site = K::$system->config->get('site');
            $token = $this->create_token($member['uid'], $mail);
            $link = K::M('helper/link')->mklink('passport:forgot', "reset-{$member['uid']}-{$token}", array(), 'www');
            return K::M('helper/mail')->sendmail($member['mail'], 'member_forgot', array('uname'=>$member['uname'], 'forgot_link'=>$link));
        }

        }
        return false;
    }

    // public function send_forgot($mail)
    // {
    //     if(!K::M('verify/check')->mail($mail)){
    //         $this->err->add('456邮箱格式不正确',411);
    //     }else if(!$member = K::M('member/member')->member($mail, 'mail')){
    //         $this->err->add('该邮箱不存在',411);
    //     }else{
    //         $site = K::$system->config->get('site');
    //         $token = $this->create_token($member['uid'], $mail);
    //         $link = K::M('helper/link')->mklink('passport:forgot', "reset-{$member['uid']}-{$token}", array(), 'www');
    //         return K::M('helper/mail')->sendmail($member['mail'], 'member_forgot', array('uname'=>$member['uname'], 'forgot_link'=>$link));
    //     }
    //     return false;
    // }

    protected function _create_hash($uid, $mail)
    {
        return strtoupper(md5($uid.__CFG::SECRET_KEY.$mail));
    }
}