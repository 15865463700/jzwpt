<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: tools.ctl.php 3304 2014-02-14 11:01:43Z youyi $
 */
class Ctl_Truste_Truste extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/jfproduct-([\d\-]+).html/i', $uri, $match)) {
            $system->request['act'] = 'index';
            $system->request['args'] = array(
                $match[2]
            );
        }
    }

    public function index()
    {
        $this->tmpl = 'truste/index.html';
    }
}