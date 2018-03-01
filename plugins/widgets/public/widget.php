<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: widget.php 5454 2014-06-11 05:17:35Z $
 */

class Widget_Public extends Model
{

    public function help(&$params)
    {   
        $data['cate_list']      = K::M('article/cate')->fetch_all();
        $data['content_list']   = K::M('article/article')->items(array('from'=>'help','closed'=>0),array('article_id'=>'ASC'),1,50);
        $params['tpl'] = $params['tpl'] ? $params['tpl']: 'help.html';
        return $data;
    }

    public function kefu(&$params)
    {           
        $params['tpl'] =  $params['tpl'] ? $params['tpl'] : 'kefu.html';
        return true;
    }

    public function share(&$params)
    {
        $params['tpl'] =  $params['tpl'] ? $params['tpl'] : 'share.html';
        return $params;     
    }

    public function sobox(&$params)
    {
        $params['tpl'] =  $params['tpl'] ? $params['tpl'] : 'sobox.html';
        $request = K::$system->request;
        $all_sotype = array(
			'gs'=>array('ctl'=>'gs:items', 'title'=>'装修公司',"link"=>"gs/",),
			'rzps'=>array('ctl'=>'rzps:items', 'title'=>'布艺窗帘',"link"=>"rzps/",),
			'gybj'=>array('ctl'=>'gybj:items', 'title'=>'工艺摆件',"link"=>"gybj/",),
			'afzn'=>array('ctl'=>'afzn:items', 'title'=>'安防智能',"link"=>"afzn/",),
			'jtyjy'=>array('ctl'=>'jtyjy:items', 'title'=>'家庭影剧院',"link"=>"jtyjy/",),
//			'case'=>array('ctl'=>'case:album', 'title'=>'效果图',"link"=>"case/album/",),
			'case'=>array('ctl'=>'case', 'title'=>'效果图',"link"=>"case/",),
			'diary'=>array('ctl'=>'diary:items', 'title'=>'日记',"link"=>"diary/",),
            'ask'=>array('ctl'=>'ask:items', 'title'=>'问答',"link"=>"ask/",),
		);
        if($a = $sotype[$request['ctl'].':'.$request['act']]){
        }else if($request['ctl'] == 'rzps'){
            $a = array('ctl'=>'rzps:items','title'=>'布艺窗帘',"link"=>"rzps/");
        }else if($request['ctl'] == 'gybj'){
            $a = array('ctl'=>'gybj:items','title'=>'工艺摆件',"link"=>"gybj/");
        }else if($request['ctl'] == 'afzn'){
            $a = array('ctl'=>'afzn:items','title'=>'安防智能',"link"=>"afzn/");
        }else if($request['ctl'] == 'jtyjy'){
            $a = array('ctl'=>'jtyjy:items','title'=>'家庭影剧院',"link"=>"jtyjy/");
        }else if($request['ctl'] == 'case'){
            $a = array('ctl'=>'case:album','title'=>'效果图',"link"=>"case/");
        }else if($request['ctl'] == 'diary'){
            $a = array('ctl'=>'diary:items','title'=>'日记',"link"=>"diary/");
        }else if($request['ctl'] == 'ask'){
            $a = array('ctl'=>'ask:items','title'=>'问答',"link"=>"ask/");
        }else if(!$a = $sotype[$request['ctl']]){
            $a = array('ctl'=>'gs:items','title'=>'装修公司',"link"=>"gs/");
        }
        $data['all_sotype'] = $all_sotype;
        $data['sotype'] = $a;
        return $data;
    }
}