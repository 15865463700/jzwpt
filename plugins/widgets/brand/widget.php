<?php
/**
 * Copy Right Anuike.com
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: widget.php 5605 2014-06-23 11:04:22Z youyi $
 */

class Widget_Brand extends Model
{

    public function filter(&$params)
    {
        $cate = $top_cate = $cates = $parents = $childrens = $brands = $attrs = array();
        $brand_id = (int)$params['brand_id'];
        if($cat_id = (int)$params['cat_id']){
            if($cate = K::M('shop/cate')->cate($cat_id)){
                $top_cate = K::M('shop/cate')->top_cate($cat_id);
                $attrs = K::M('shop/attr')->attrs_by_cat($cat_id);                
            }
        }
        //if(!$cate || $cate['brands'][$brand_id]){
           //$brand_id = 0;
       // }
        $cate_list = K::M('shop/cate')->fetch_all();
        //$brands = K::M('shop/brand')->fetch_all();
        //if($brand_ids = $cate['brand_ids']){
        $oLink = K::M('helper/link');
        $ctl = $params['ctl'] ? $params['ctl'] : 'brand/brand:index';
             //所有品牌
        if($brands = K::M('shop/brand')->fetch_all()){
            foreach($brands as $k=>$v){
                $v['link'] = $oLink->mklink($ctl, array($v['brand_id'], 1), null, true);
                $brands[$k] = $v;
            }
            $brand_all_link = $oLink->mklink($ctl, array($brand_id, 1), null, true);
        }
        //} 
        //所有分类,先取顶级分类
        $cate = K::M('shop/cate')->fetch_all();
        foreach($cate as $k=>$v){
            if($v['parent_id'] == 0){
                //顶级
                $ding_cats[$v['cat_id']] = $v['title'];
                //if(strpos($v['brand_ids'], $brand_id)){
                    //满足品牌条件
                    //$cat_a[$v['cat_id']] = $v['title'];
                //}
                //满足品牌条件
                $arr = explode(',',$v['brand_ids']);
                if(in_array($brand_id,$arr)){
                    //parent_id = 0
                    $parents[$k]= $v;
                    //构建链接
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k, 0, $order, 1), null, true);
                }
            }
        }
        //foreach($brands as $k=>$v){
          //  var_dump($v['link']);
        //}die;
        #vdp($brands);die;

        if($cate){
            foreach($cate_list as $k=>$v){
                //满足品牌条件
                $arr = explode(',',$v['brand_ids']);
                if($v['parent_id']==0 && in_array($brand_id,$arr)){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k, 0, $order, 1), null, true);
                    $parents[$k] = $v;
                    //顶级分类，cat==parent_id
                }else if($top_cate['cat_id'] == $v['parent_id']){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k ,$attr_ids, $order, 1), null, true);
                    $cates[$k] = $v;
                }else if($v['parent_id'] == $cate['parent_id'] || $v['parent_id'] == $cate['cat_id'] || $v['cat_id'] == $cate['cat_id']){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k, $attr_ids, $order, 1), null, true);
                    $childrens[$k] = $v;
                }
            }
        }
        /*else{
            foreach($cate_list as $k=>$v){
                //$arr = explode(',',$v['brand_ids']);
                if($v['parent_id']==0 ){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id, $k, 0, $order, 1), null, true);
                    $parents[$k] = $v;
                }
            }
        }*/
        //$cat = K::M('shop/cate')->top_cate($top_cate);
        $cate_all_link = $oLink->mklink($ctl, array( $brand_id, $top_cate['cat_id'],$attr_ids, $order, 1), null, true); 

        $attr_ids = array();
        if($attrs){
            if($attr_values = (array)$params['attr_values']){
                $a = implode('-', $attr_values);
                foreach($attrs as $k=>$v){
                    foreach($a as $vv){
                        if(in_array($vv, $v['values'])){
                            $attr_ids[$k] = $vv;
                        }else{
                            $attr_ids[$k] = 0;
                        }
                    }
                }
            }
        }
        if($attr_ids){
            $attr_ids = implode('-', $attr_ids);
        }else{
            $attr_ids = '0';
        }
        $order = (int)$params['order'];
        
        if($attrs = K::M('shop/attr')->attrs_by_cat($cat_id)){
            $values = array();
            foreach($attrs as $k=>$v){
                foreach($attr_values as $kk=>$vv){
                    if($v['values'][$vv]){
                        $values[$k] = $vv;
                    }
                }
            }
            $attr_values = $values;
            foreach($attrs as $k=>$v){
                $checked = false;
                foreach((array)$v['values'] as $kk=>$vv){
                    if(in_array($vv['attr_value_id'], $attr_values)){
                        $vv['checked'] = $checked = true;
                    }else{
                        $a = $attr_values;
                        $a[$vv['attr_id']] = $vv['attr_value_id'];
                        $vv['link'] = $oLink->mklink($ctl, array($brand_id,$cat_id, implode('-', $a), $order, 1), null, true);
                    }
                    $v['checked'] = $checked;
                    $a = $attr_values;
                    unset($a[$k]);
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$cat_id, implode('-', $a), $order, 1), null, true);
                    $v['values'][$kk] = $vv;
                }
                $attrs[$k] = $v;
            }            
        }
        $data = array('cate'=>$cate,'top_cate'=>$top_cate, 'parents'=>$parents, 'cates'=>$cates, 'childrens'=>$childrens, 'brands'=>$brands, 'attrs'=>$attrs);
        #vdp($data['parents']);die;
        $data['cat_id'] = $cat_id;
        $data['brand_id'] = $brand_id;
        $data['cate_all_link'] = $cate_all_link;
        $data['brand_all_link'] = $brand_all_link;
        $data['attr_values'] = (array)$attr_values;
        $data['order'] = $order;
        return $data;
    }
    //手机端品牌筛选
    public function mobile(&$params)
    {
        $cate = $top_cate = $cates = $parents = $childrens = $brands = $attrs = array();
        $brand_id = (int)$params['brand_id'];
        if($cat_id = (int)$params['cat_id']){
            if($cate = K::M('shop/cate')->cate($cat_id)){
                $top_cate = K::M('shop/cate')->top_cate($cat_id);
                $attrs = K::M('shop/attr')->attrs_by_cat($cat_id);                
            }
        }
        $cate_list = K::M('shop/cate')->fetch_all();
        $oLink = K::M('helper/link');
        $ctl = $params['ctl'] ? $params['ctl'] : 'mobile/brand:index';
        if($brands = K::M('shop/brand')->fetch_all()){
            foreach($brands as $k=>$v){
                $v['link'] = $oLink->mklink($ctl, array($v['brand_id'], 1), null, true);
                $brands[$k] = $v;
            }
            $brand_all_link = $oLink->mklink($ctl, array($brand_id, 1), null, true);
        }
        //} 
        //所有分类,先取顶级分类
        $cate = K::M('shop/cate')->fetch_all();
        foreach($cate as $k=>$v){
            if($v['parent_id'] == 0){
                //顶级
                $ding_cats[$v['cat_id']] = $v['title'];
                //if(strpos($v['brand_ids'], $brand_id)){
                    //满足品牌条件
                    //$cat_a[$v['cat_id']] = $v['title'];
                //}
                //满足品牌条件
                $arr = explode(',',$v['brand_ids']);
                if(in_array($brand_id,$arr)){
                    //parent_id = 0
                    $parents[$k]= $v;
                    //构建链接
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k, 0, $order, 1), null, true);
                }
            }
        }
        //foreach($brands as $k=>$v){
          //  var_dump($v['link']);
        //}die;
        #vdp($brands);die;

        if($cate){
            foreach($cate_list as $k=>$v){
                //满足品牌条件
                $arr = explode(',',$v['brand_ids']);
                if($v['parent_id']==0 && in_array($brand_id,$arr)){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k, 0, $order, 1), null, true);
                    $parents[$k] = $v;
                    //顶级分类，cat==parent_id
                }else if($top_cate['cat_id'] == $v['parent_id']){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k ,$attr_ids, $order, 1), null, true);
                    $cates[$k] = $v;
                }else if($v['parent_id'] == $cate['parent_id'] || $v['parent_id'] == $cate['cat_id'] || $v['cat_id'] == $cate['cat_id']){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$k, $attr_ids, $order, 1), null, true);
                    $childrens[$k] = $v;
                }
            }
        }
        /*else{
            foreach($cate_list as $k=>$v){
                //$arr = explode(',',$v['brand_ids']);
                if($v['parent_id']==0 ){
                    $v['link'] = $oLink->mklink($ctl, array($brand_id, $k, 0, $order, 1), null, true);
                    $parents[$k] = $v;
                }
            }
        }*/
        //$cat = K::M('shop/cate')->top_cate($top_cate);
        $cate_all_link = $oLink->mklink($ctl, array( $brand_id, $top_cate['cat_id'],$attr_ids, $order, 1), null, true); 

        $attr_ids = array();
        if($attrs){
            if($attr_values = (array)$params['attr_values']){
                $a = implode('-', $attr_values);
                foreach($attrs as $k=>$v){
                    foreach($a as $vv){
                        if(in_array($vv, $v['values'])){
                            $attr_ids[$k] = $vv;
                        }else{
                            $attr_ids[$k] = 0;
                        }
                    }
                }
            }
        }
        if($attr_ids){
            $attr_ids = implode('-', $attr_ids);
        }else{
            $attr_ids = '0';
        }
        $order = (int)$params['order'];
        
        if($attrs = K::M('shop/attr')->attrs_by_cat($cat_id)){
            $values = array();
            foreach($attrs as $k=>$v){
                foreach($attr_values as $kk=>$vv){
                    if($v['values'][$vv]){
                        $values[$k] = $vv;
                    }
                }
            }
            $attr_values = $values;
            foreach($attrs as $k=>$v){
                $checked = false;
                foreach((array)$v['values'] as $kk=>$vv){
                    if(in_array($vv['attr_value_id'], $attr_values)){
                        $vv['checked'] = $checked = true;
                    }else{
                        $a = $attr_values;
                        $a[$vv['attr_id']] = $vv['attr_value_id'];
                        $vv['link'] = $oLink->mklink($ctl, array($brand_id,$cat_id, implode('-', $a), $order, 1), null, true);
                    }
                    $v['checked'] = $checked;
                    $a = $attr_values;
                    unset($a[$k]);
                    $v['link'] = $oLink->mklink($ctl, array($brand_id,$cat_id, implode('-', $a), $order, 1), null, true);
                    $v['values'][$kk] = $vv;
                }
                $attrs[$k] = $v;
            }            
        }
        $data = array('cate'=>$cate,'top_cate'=>$top_cate, 'parents'=>$parents, 'cates'=>$cates, 'childrens'=>$childrens, 'brands'=>$brands, 'attrs'=>$attrs);
        #vdp($data['parents']);die;
        $data['cat_id'] = $cat_id;
        $data['brand_id'] = $brand_id;
        $data['cate_all_link'] = $cate_all_link;
        $data['brand_all_link'] = $brand_all_link;
        $data['attr_values'] = (array)$attr_values;
        $data['order'] = $order;
        return $data;
    }
}