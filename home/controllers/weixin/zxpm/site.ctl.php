<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Weixin_Zxpm_Site extends Ctl_Weixin
{

    protected $pm_pro = array(
        1 => '方案设计',
        2 => '水泥改造',
        3 => '泥瓦阶段',
        4 => '木工阶段',
        5 => '油漆阶段',
        6 => '完工',
        7 => '验收完成'
    );

    protected $pm_type = array(
        1 => '水电工程',
        2 => '土木工程',
        3 => '油漆工程',
        4 => '安装工程'
    );

    public function index()
    {
        $openid = $this->access_openid();
        if (! $supervist = K::M('supervist/supervist')->detail_by_openid($openid)) {
            $this->tmpl = 'weixin/zxpm/site/bind.html';
        } else {
            $map = array(
                'zxpm_id' => $supervist['supervist_id'],
                'closed' => 0
            );
            $items = K::M('pm/site')->items($map, array(
                'dateline' => 'desc'
            ));
            $this->pagedata['items'] = $items;
            $this->pagedata['steps'] = $this->pm_pro;
            $this->tmpl = 'weixin/zxpm/site/index.html';
        }
    }

    public function detail($site_id = null)
    {
        if (! $site_id) {
            $this->err->add('非法访问', 1000);
        } elseif (! $detail = K::M('pm/site')->detail($site_id)) {
            $this->err->add('非法访问', 1000);
        } else {
            $this->pagedata['detail'] = $detail;
            $map = array(
                'site_id' => $site_id
            );
            $progress = K::M('pm/site_progress')->items($map, array(
                'dateline' => 'asc'
            ));
            $this->pagedata['progress'] = $progress;
            $this->pagedata['steps'] = $this->pm_pro;
            $this->tmpl = 'weixin/zxpm/site/detail.html';
        }
    }

    public function item($progress_id = null)
    {
        if (! $progress_id) {
            $this->err->add('非法访问', 1000);
        } else {
            $detail = K::M('pm/site_progress')->detail($progress_id);
            $attach = K::M('pm/site_attach')->items(array(
                'progress_id' => $progress_id
            ));
            $this->pagedata['detail'] = $detail;
            $this->pagedata['attach'] = $attach;
            $this->pagedata['steps'] = $this->pm_pro;
            $this->tmpl = 'weixin/zxpm/site/item.html';
        }
    }

    public function additem($site_id = null)
    {
        if (! $site_id) {
            $this->err->add('非法访问', 1000);
        } elseif ($d = $this->GP('data')) {
            $d['status'] = 1;
            if ($progress_id = K::M('pm/site_progress')->create($d)) {
                $result = $this->upload($_FILES['img'], $progress_id);
                if (K::M('pm/site_attach')->create_many($result)) {
                    $this->err->add('操作成功');
                    $this->err->set_data('forward', $this->mklink("weixin/zxpm/site:index"));
                } else {
                    $this->err->add('操作失败', 1000);
                }
                ;
            }
        } else {
            $detail = K::M('pm/site')->detail($site_id);
            $this->pagedata['detail'] = $detail;
            $this->pagedata['steps'] = $this->pm_pro;
            $this->pagedata['type'] = $this->pm_type;
            
            $this->tmpl = 'weixin/zxpm/site/additem.html';
        }
    }

    public function bind()
    {
        $openid = $this->cookie->get('wx_openid');
        $nickname = $this->cookie->get($openid . '_nickname');
        $headimgurl = $this->cookie->get($openid . '_headimgurl');
        $session = K::M('system/session')->start();
        if (! $d = $this->GP('data')) {
            $this->err->add('非法访问', 211);
        } else 
            if (! $mobile = K::M('verify/check')->mobile($d['mobile'])) {
                $this->err->add('手机号码不正确', 212);
            } else 
                if ($session->get("MOBILE_VERIFY_CODE") != $d['verify']) {
                    $this->err->add('验证码不正确', 213);
                } else 
                    if (! $supervist = K::M('supervist/supervist')->detail_by_mobile($mobile)) {
                        $this->err->add('手机码不存在', 214);
                    } else 
                        if (K::M('supervist/supervist')->update($supervist['supervist_id'], array(
                            'openid' => $openid
                        ))) {
                            $this->err->add('微信绑定成功,可通过微信管理工地');
                        } else {
                            $this->err->add('微信绑定失败', 215);
                        }
    }

    public function sendverify()
    {
        if (! $mobile = $this->GP('mobile')) {
            $this->err->add('手机号码不正确', 211);
        } else 
            if (! $mobile = K::M('verify/check')->mobile($mobile)) {
                $this->err->add('手机号码不正确', 212);
            } else 
                if (! $supervist = K::M('supervist/supervist')->detail_by_mobile($mobile)) {
                    $this->err->add('手机码不存在', 213);
                } else {
                    $code = K::M('content/string')->Random(6, 1);
                    $session = K::M('system/session')->start();
                    $session->set('MOBILE_VERIFY_CODE', $code, 300); // 5分钟有效
                    K::M('sms/sms')->send($mobile, 'mobile_verify', array(
                        'code' => $code
                    ), $this->company_id);
                    $this->err->add('发送验证码成功');
                    // exit(json_encode(array('msg'=>'发送验证码成功,'.$session->get('MOBILE_VERIFY_CODE') )));
                }
    }

    private function upload($files, $progress_id)
    {
        $result = array();
        $root = $_SERVER['DOCUMENT_ROOT'];
        $attach = '/attachs/photo/' . date('Ym') . '/';
        if (! file_exists($root . $attach)) {
            mkdir($root . $attach, 0777);
        }
        foreach ($files['name'] as $k => $file_name) {
            $ext = explode('.', $file_name);
            $des = $attach . date('Ymd') . '_' . md5($files['tmp_name'][$k]) . '.' . end($ext);
            if (! move_uploaded_file($files['tmp_name'][$k], $root . $des)) {
                break;
            } else {
                $result[] = array(
                    'thumb' => $des,
                    'progress_id' => $progress_id
                );
            }
        }
        return $result;
    }
}