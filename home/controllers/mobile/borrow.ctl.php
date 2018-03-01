<?php
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Borrow extends Ctl_Mobile{

    public function __construct(&$system){
        parent::__construct($system);
    }

    public function index(){
        $this->tmpl = 'mobile/borrow/borrow.html';
    }
}