<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author shzhrui<anhuike@gmail.com>
 * $Id: http.mdl.php 9941 2015-04-28 13:13:58Z youyi $
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Weixin_Token extends Ctl
{

    public $_call = 'index';

    public function index()
    {
        if (preg_match('/weixin\/token\/code/', $this->request['uri'])) {
            $this->token_code();
        } else {
            $this->token_openid();
        }
    }

    protected function token_code()
    {
        if ($code = $this->GP('code')) {
            if (! $reback_url = $this->GP('reback_url')) {
                if (! $reback_url = $this->cookie->get('wx_token_reback_url')) {
                    exit('reback_url error');
                }
            }
            if (strpos($reback_url, '?') === false) {
                $reback_url .= '?WXCODE=' . $code;
            } else {
                $reback_url .= '&WXCODE=' . $code;
            }
            header('Location:' . $reback_url);
            exit();
        } else {
            if (! $openid = $this->cookie->get('wx_openid')) {
                $client = $this->wechat_client();
                $url = 'http://fz.jhcms.cn/weixin/token/index.html';
                if (! $reback_url = $this->GP('reback_url')) {
                    $reback_url = $this->request['forward'];
                }
                $this->cookie->set('wx_token_reback_url', $reback_url);
                $url .= '?reback_url=' . urldecode($reback_url);
                $authurl = $client->getOAuthConnectUri($url, $state, 'snsapi_userinfo');
                header('Location:' . $authurl);
                exit();
            }
        }
    }

    protected function token_openid()
    {
        static $openid = null;
        if ($openid === null) {
            if ($code = $this->GP('code')) {
                $client = $this->wechat_client();
                $ret = $client->getAccessTokenByCode($code);
                if (! $openid = $ret['openid']) {
                    exit('获取授权失败');
                }
                $this->cookie->set('wx_openid', $openid);
            } else {
                if (! $openid = $this->cookie->get('wx_openid')) {
                    $client = $this->wechat_client();
                    $url = 'http://fz.jhcms.cn/weixin/token/index.html';
                    if (! $reback_url = $this->GP('reback_url')) {
                        $reback_url = $this->request['forward'];
                    }
                    $this->cookie->set('wx_token_reback_url', $reback_url);
                    $url .= '?reback_url=' . urldecode($reback_url);
                    $authurl = $client->getOAuthConnectUri($url, $state, 'snsapi_userinfo');
                    header('Location:' . $authurl);
                    exit();
                }
            }
        }
        if (! $reback_url = $this->GP('reback_url')) {
            if (! $reback_url = $this->cookie->get('wx_token_reback_url')) {
                exit('reback_url error');
            }
        }
        if (strpos($reback_url, '?') === false) {
            $reback_url .= '?WXOPENID=' . $openid;
            $reback_url .= '?WXCODE=' . $code;
        } else {
            $reback_url .= '&WXOPENID=' . $openid;
            $reback_url .= '&WXCODE=' . $code;
        }
        header('Location:' . $reback_url);
        exit();
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
}