<?php

if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}


class Ctl_Mobile_Ucenter_Ask extends Ctl
{

    //public function __construct(&$system)
   // {
       // parent::__construct($system);
//        $uri = $this->request['uri'];
//        if (preg_match('/ask-([\d]+)\.html/i', $uri, $match)) {
//            $system->request['act'] = 'detail';
//            $system->request['args'] = array(
//                $match[1]
//            );
//        }
 //  }

    public function save()
    {
        //$a=5;
         //$this->uid;die;
        //echo 1;die;
        if ($this->uid<=0) {
            $this->err->add('登录后才能发布问题', 212);
        }else
            if (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_ask')) == -1) {
                $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
            }else
          if($data = $this->checksubmit('data')) {
                    $verifycode_success = true;
                    $access = $this->system->config->get('access');
                    if ($access['verifycode']['ask']) {
                        if ($access['verifycode']['ask']) {
                            if (!$verifycode = $this->GP('verifycode')) {
                                $verifycode_success = false;
                                $this->err->add('验证码不正确', 212);
                            } else
                                if (!K::M('magic/verify')->check($verifycode)) {
                                    $verifycode_success = false;
                                    $this->err->add('验证码不正确', 212);
                                }
                        }
                        if ($verifycode_success) {
                            if ($data['content']) {
                                $data['title'] = K::M('content/string')->sub($data['content'], 0, 20, $suffix = "");
                                $data['intro'] = K::M('content/string')->sub($data['content'], 20, K::M('content/string')->Len($data['content']), $suffix = "");
                            }
                            $data = array(
                                'title' => $data['title'],
                                'intro' => $data['intro'],
                                'uid' => $this->uid
                               // 'audit' => $audit
                            );
                            if ($this->GP('cat_id')) {
                                $data['cat_id'] = $this->GP('cat_id');
                            }
                            if ($_FILES['data']) {
                                foreach ($_FILES['data'] as $k => $v) {
                                    foreach ($v as $kk => $vv) {
                                        $attachs[$kk][$k] = $vv;
                                    }
                                }
                                $upload = K::M('magic/upload');
                                foreach ($attachs as $k => $attach) {
                                    if ($attach['error'] == UPLOAD_ERR_OK) {
                                        if ($a = $upload->upload($attach, 'home')) {
                                            $data[$k] = $a['photo'];
                                        }
                                    }
                                }
                            }
                            if (!$cat_id = $this->GP('cat_id')) {
                                $cat_id = '1';
                            }
                            if ($ask_id = K::M('ask/ask')->create($data)) {
                                K::M('system/integral')->commit('ask', $this->MEMBER, '发布问题');
                                $this->err->add('发表问题成功');
//                        $this->err->set_data('forward', $this->mklink('ask:items', array(
//                            $cat_id
//                        )));
                            }
                        }
                    }
          }else {
                        $this->err->add('发表问题失败', 201);
                    }
    }
}