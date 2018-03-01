<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Index extends Ctl_Mobile
{
    public function index($id = null){
        $this->system->cookie->delete('check_mobile');
        $attr_values = K::M('data/attr')->attrs_by_from('zx:case');
        $this->pagedata['attr_values'] = $attr_values;
        if ($id && $id != $this->uid) {
            $this->cookie->set('fenxiaoid', $id);
        }
        $this->pagedata['page_title']="";
        $this->seo->init('mobile');
        $this->tmpl = 'mobile/index.html';
    }

    public function force($to = 'web')
    {
        $site = $this->system->config->get('site');
        if ($to == 'web') {
            $this->system->cookie->delete('force_web');
            $this->system->cookie->delete('force_mobile');
            $this->system->cookie->set('force_web', 1);
            header('Location:' . $site['siteurl']);
            exit();
        } else 
            if ($site['mobile'] && ($to == 'mobile')) {
                $mobile = $this->system->config->get('mobile');
                $this->system->cookie->delete('force_web');
                $this->system->cookie->delete('force_mobile');
                $this->system->cookie->set('force_mobile', 1);
                
                $url = $mobile['url'];
                if ($site['multi_city']) {
                    $city = $this->request['city'];
                    if (substr($mobile['url'], - 7) == '/mobile') {
                        $url = $city['siteurl'] . '/mobile';
                    } else {
                        $url = $mobile['url'] . '/' . $city['py'];
                    }
                }
                header("Location:{$url}");
                exit();
            }
    }
    public function back(){
            if (isset($_SERVER['HTTP_REFERER'])){
                $Url=$_SERVER['HTTP_REFERER'];
                //echo $Url;die;
                header("header:{$Url}");
            }else{
//没有来路
                exit();
            }

    }
    public function pc(){
        $this->system->cookie->set('check_mobile',time());
        header("location:/");
    }
}