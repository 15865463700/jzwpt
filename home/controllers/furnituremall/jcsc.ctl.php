<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Furnituremall_Jcsc2 extends Ctl
{

    public function index()
    {
        $this->pagedata['cate_list'] = K::M('shop/cate')->fetch_all();
        $this->seo->init('mall');
        $this->tmpl = 'furnituremall/jcsc.html';
    }
}