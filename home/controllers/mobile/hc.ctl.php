<?php

if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Hc extends Ctl_Mobile
{
    public function index($id = null){

        exit;
//        $this->system->cookie->delete('check_mobile');
//        $attr_values = K::M('data/attr')->attrs_by_from('zx:case');
//        $this->pagedata['attr_values'] = $attr_values;
//        if ($id && $id != $this->uid) {
//            $this->cookie->set('fenxiaoid', $id);
//        }
//        $this->pagedata['page_title']="";
//        $this->seo->init('mobile');
        $this->tmpl = 'mobile/hc/index.html';
    }

}