<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Weixin_Web extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $this->wechatCfg = $system->config->get('wechat');
    }

    public function index(){
        $session = K::M('system/session')->start();
        $session->set('wxljdz',$_REQUEST['ref']);
        if ($openid = $this->access_openid()) {
            if ($m = K::M('member/weixin')->detail_by_openid($openid)) {
                if($m['mobile']){
                    header("Location:".$session->get('wxljdz'));
                    exit;
                }else{
                    header("Location:/mobile/nh/yz");
                    exit;
                }
            } else {
                if ($client = $this->wechat_client()) {
                    $wx_info = $client->getUserInfoById($openid);
                    if ($wx_info) {
                        if ($m = K::M('member/weixin')->create_account($wx_info)) {
                            if($m['yezhu']){
                                header("Location:".$session->get('wxljdz'));
                                exit;
                            }else{
                                header("Location:/mobile/nh/yz");
                                exit;
                            }
                        }
                    }
                    die("授权网页登录成功");
                }
            }
        }
    }

    protected function access_openid($force = false){
        static $openid = null;
        if ($force || $openid === null) {
            if ($code = $this->GP('code')) {
                $client = $this->wechat_client();
                $ret = $client->getAccessTokenByCode($code);

                $openid = $ret['openid'];
                if($unionid = $ret['unionid']){
                    $this->cookie->set('wx_unionid', $ret['unionid']);
                    $m = K::M('member/weixin')->detail_by_unionid($unionid);
                }else{
                    if ($openid) {
                        $m = K::M('member/weixin')->detail_by_openid($openid);
                    } else {
                        header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxac82a430f5700657&redirect_uri=http://www.jzwpt.com/weixin/web/index&response_type=code&scope=snsapi_userinfo&state=123456#wechat_redirect");
                        exit('获取授权失败1');
                    }
                }
//                if ($openid) {
//                    $m = K::M('member/weixin')->detail_by_openid($openid);
//                } else {
//                    header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxac82a430f5700657&redirect_uri=http://www.jzwpt.com/weixin/web/index&response_type=code&scope=snsapi_userinfo&state=123456#wechat_redirect");
//                    exit('获取授权失败1');
//                }
                if ($m['uid']) {
                    K::M('member/auth')->manager($m['uid']);
                }else{
                    if ($wx_info = $client->getUserInfoById($ret['openid'])) {
                        if ($m = K::M('member/weixin')->create_account($wx_info)) {
                            K::M('member/auth')->manager($m['uid']);
                        }
                    }
                }
                $this->cookie->set('wx_openid', $openid);
            } else {
                if (! $openid = $this->cookie->get('wx_openid')) {
                    $client = $this->wechat_client();
                    $url = $this->request['url'] . '/' . $this->request['uri'];
                    $authurl = $client->getOAuthConnectUri($url, $state, 'snsapi_userinfo');
                    header('Location:' . $authurl);
                    exit();
                }
                $unionid = $this->cookie->get('unionid');

            }
            if (! defined('WX_OPENID')) {
                define('WX_OPENID', $openid);
            }
            if (! defined('WX_OPENID')) {
                define('WX_UNIONID', $unionid);
            }
        }
        if (empty($openid)) {
            exit('获取授权失败');
        }
        return $openid;
    }

    protected function wechat_client(){
        static $client = null;
        if ($client === null) {
            if (! $client = K::M('weixin/weixin')->admin_wechat_client()) {
                exit('网站公众号设置错误');
            }
        }
        return $client;
    }

    public function cmd($str = ""){
//        $result=system("service jzwpt_app ".$str);
//        exec("whoami",$result);
        $result=exec("/home/jzwptapp.sh",$rs);
        var_dump($result);
        die;

    }

}
