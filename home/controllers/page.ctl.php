<?php

class Ctl_Page extends Ctl
{
    public function __construct(&$system)
    {
    	parent::__construct($system);
    	if(preg_match('/page\/(\w+)(\.html)?/i', $this->request['uri'], $m)){
    		$this->request['act'] = 'detail';
    		$this->request['args'] = array($m[1]);
    	}
    }

	public function detail($p)
	{
		$this->tmpl = "page/{$p}.html";
	}

	public function error($error){
        if($error){
            $this->tmpl = "page/{$error}.html";
        }else{
            $this->tmpl = "page/error.html";
        }
	}



}
