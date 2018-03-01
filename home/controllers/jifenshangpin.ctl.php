<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: help.ctl.php 5400 2014-06-03 09:49:17Z langzhong $
 */
class Ctl_jifenshangpin extends Ctl
{

    public function index()
    {
        $this->tmpl = 'jifenshangpin/index.html';
    }

    public function detail()
    {
        $this->tmpl = 'jifenshangpin/detail.html';
    }
}