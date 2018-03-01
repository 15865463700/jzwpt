<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: city.ctl.php 3407 2014-02-21 06:37:45Z $
 */
class Ctl_City extends Ctl
{

    public function index()
    {
        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
        $arr = K::M('data/city')->cshhr();
        $cfg = $this->system->config->get('site');
        if (! $cfg['multi_city']) {
            header('Location:index.php');
            exit();
        }
        $city_list = K::M('data/city')->fetch_all();
        foreach ($city_list as $k => $v) {
            if ($v['pinyin']) {
                $py = strtoupper(substr($v['pinyin'], 0, 1));
                $v['py'] = $py;
                if(in_array($v["city_id"],$arr)){
                    $v["on"]=1;
                }else{
                    $v["on"]=0;
                }
                $city[$py][] = $v;
            }
        }
        $c = ksort($city);
        $this->pagedata['city_list'] = $city_list;
        $this->pagedata['city'] = $city;
        $this->pagedata['arr'] = $arr;
        $this->pagedata['province_list'] = K::M('data/province')->fetch_all();
        
        // �b��
        $this->pagedata['member'] = K::M('member/member')->count();
        $this->pagedata['company'] = K::M('company/company')->count();
        
        $this->seo->init('city');
        $this->tmpl = 'city/city.html';
    }
    
    public function change(){
        $session = K::M('system/session')->start();
        $session->set('substation',$this->request['city'], 36000);
        header("Location:{$this->request['city']['siteurl']}");die;
    }
    
}