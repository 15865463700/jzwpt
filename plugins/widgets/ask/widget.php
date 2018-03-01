<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author shzhrui<anhuike@gmail.com>
 * $Id: widget.php 6072 2014-08-12 12:23:29Z youyi $
 */

class Widget_Ask extends Model
{

    public function index(&$params)
    {
        $data = $params;
        if($adv_id = intval($params['adv_id'])){
            if(!$detail = K::M('adv/adv')->detail($adv_id)){
                return false;
            }
        }else if($params['key']){
            if(!$adv = K::M('adv/adv')->adv_by_key($params['key'])){
                return false;
            }else if(!$detail = K::M('adv/adv')->detail($adv['adv_id'])){
                return false;
            }
        }else if($params['name']){
            if(!$adv = K::M('adv/adv')->adv_by_name($params['name'])){
                return false;
            }else if(!$detail = K::M('adv/adv')->detail($adv['adv_id'])){
                return false;
            }           
        }else{
            return false;
        }
        $data['adv'] = $adv;
        if(empty($params['tpl'])){
            $params['tpl'] = "adv_{$adv[from]}.html";
        }
        $nums = intval($params['limit']);
        $order = strtolower($params['order']);
        $order = in_array($order,array('asc','desc','rand')) ? $order : "asc";
        if($items = $detail['items']){
            $item_list = array();
            foreach($items as $k=>$v){
                if(empty($v['audit'])){
                    continue;
                }else if($v['stime'] && ($v['stime'] > __TIME)){
                    continue;
                }else if($v['ltime'] && ($v['ltime'] < __TIME)){
                    continue;
                }else if($params['city_id']){
                    if($params['city_id'] != $v['city_id']){
                        continue;
                    }
                }
                $item_list[$k] = $v;
            }
            if(empty($item_list)){
                return false;
            }
            $item_list = array_values($item_list);
            if('desc' == $order){
                $item_list = array_reverse($item_list);
            }else if('rand' == $order){
                shuffle($item_list);
            }
            if($nums > 0){
                $item_list = array_slice($item_list,0,$nums);
            }
            $data['items'] = $item_list;
        }
        return $data;
    }

    public function option(&$params)
    {
        if(!$params['tpl']){
            if(!in_array($params['type'], array('label', 'checkbox', 'radio', 'option'))){
                $params['type'] = 'option';
            }
            $params['tpl'] = 'widget:default/'.$params['type'].'.html';
        }        
        $data['value'] = $params['value'] ? $params['value'] : 0;
        $data['from'] = $params['from'] ? $params['from'] : null;
        $options = array();
        if($items = K::M('adv/adv')->items(array('audit'=>1,'closed'=>0))){
            foreach($items as $k=>$v){
                $options[$v['adv_id']] = $v['title'];
            }
        }
        $data['options'] = $options;
        return $data;       
    }
	
    public function props(&$params){
		$type=$params['type'] ? $params['type'] : "";
        $data['limit'] = $params['limit'] ? $params['limit'] : 8;
        $data['props'] = $params['props'] ? $params['props'] :"9999";
        $data['order'] = $params['order'] ? $params['order'] :"";
        #$data['title']=$params['title'];
        #$data['cat_id']=$params['cat_id'];
        #$data['key']=isset($params['key'])&&$params['key']>0?1:0;
        $data['strlen']=isset($params['strlen'])?$params['strlen']:100;
        $data['items']=K::M('ask/ask')->props($data['props'],$data['limit'],$city_id=0,$data['order']);
        $params['tpl'] = "prop{$type}.html";
        return $data;
    }
	
	
}