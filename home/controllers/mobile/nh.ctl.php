<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Nh extends Ctl_Mobile{

    public function index(){
        $this->tmpl = 'mobile/nh/index.html';
    }

    public function qd(){
        if($_POST){
            $data=array(
                "realname"=>$_REQUEST['realname'],
                "mobile"=>$_REQUEST['mobile'],
                "company"=>$_REQUEST['company'],
            );
            K::M('member/member')->update($this->uid, $data);
            header("Location:/mobile/dp");
            exit;
        }else{
            $this->tmpl = 'mobile/nh/qd.html';
        }
    }

    public function yz(){
        if($_POST){
            $realname=$_REQUEST['realname'];
            $mobile=$_REQUEST['mobile'];
            $verifycode=$_REQUEST['verifycode'];

            $session = K::M('system/session')->start();
            $vcode = $session->get('price_' . $mobile);
            if (!$verifycode||$verifycode!=$vcode) {
                $this->pagedata['error_message'] = "验证码不正确!";
                $this->pagedata['wxljdz'] = $session->get('wxljdz');
                $this->tmpl = 'mobile/nh/yz.html';
            }else{
                $data=array(
                    "realname"=>$realname,
                    "mobile"=>$mobile,
                    "yezhu"=>1,
                );
                K::M('member/member')->update($this->uid, $data);
                header("Location:".$session->get('wxljdz'));
            }
        }else{

            $session = K::M('system/session')->start();
            $this->pagedata['wxljdz'] = $session->get('wxljdz');
            $this->tmpl = 'mobile/nh/yz.html';
        }
    }

}
