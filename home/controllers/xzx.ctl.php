<?php

class Ctl_Xzx extends Ctl{
    
    public function __construct(&$system)
    {
        parent::__construct($system);
        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
    }
    
    public function index(){
        $this->seo->init('xzx');
        $this->pagedata['canonical'] = "www.jzwpt.com/xzx/";
        $this->tmpl = 'xzx/index.html';
    }

    public function items($cat_id=80, $page = 1){
        $this->tmpl = 'xzx/items.html';
    }

    public function detail($article_id, $page = 1){
        $this->tmpl = 'xzx/detail.html';
    }

}
