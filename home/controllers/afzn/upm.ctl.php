<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: member.ctl.php 5937 2014-07-28 01:04:06Z youyi $
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Afzn_Upm extends Ctl_Afzn_Anfangzhineng
{

    public function index()
    {
        $this->tmpl = 'afzn/upm/upm.html';
    }
}