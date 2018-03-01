<?php

class Widget_Article extends Model
{

    public function index(&$params)
    {
    }

	public function cate(&$params)
	{
		$params['tpl'] = 'cate_options.html';
		$data['value'] = $params['value'] ? $params['value'] : 0;
		$from = $params['from'] ? $params['from'] : null;
    	$data['tree'] = K::M('article/cate')->tree($from);
    	return $data;			
	}

    public function newitems(&$params){
        $data['limit'] = $params['limit'] ? $params['limit'] : 5;
        $filter['from'] = 'article';
        $filter['closed'] = 0;
        $article = K::M('article/view')->items($filter,array('article_id'=>'DESC') , 1,$data['limit']);
        $cates = K::M('article/cate')->fetch_all();
        foreach($article as $k=>$v){
            $article[$k]['cat_title'] = $cates[$v['cat_id']]['title'];
        }
        $data['article'] = $article;
        $params['tpl'] = 'newitems.html'; 
        return $data;
    }
    
    public function randitems(&$params){
        $data['limit'] = $params['limit'] ? $params['limit'] : 8;
        $filter['from'] = 'article';
        $filter['closed'] = 0;
        $count = K::M('article/view')->count(" `from`='article' AND closed=0 ");
        if($data['limit'] > $count){
             $article = K::M('article/view')->items($filter,array('article_id'=>'DESC') , 1,$data['limit']);
        }else{
             $page = rand(1,  ceil(($count-$data['limit'])/ $data['limit']));
             $article = K::M('article/view')->items($filter,array('article_id'=>'ASC') , $page,$data['limit']);
        }
        $cates = K::M('article/cate')->fetch_all();
        foreach($article as $k=>$v){
            $article[$k]['cat_title'] = $cates[$v['cat_id']]['title'];
        }
        $data['article'] = $article;
        $params['tpl'] = 'randitems.html'; 
        return $data;
    }

    public function hot(&$params){
        $data['limit'] = $params['limit'] ? $params['limit'] : 8;
        $data['t']=$params['t'] ? $params['t'] : 0;
        $data['title']=$params['title'];
        $data['cat_id']=$params['cat_id'];
        $data['key']=isset($params['key'])&&$params['key']>0?1:0;
        $data['strlen']=isset($params['strlen'])?$params['strlen']:100;
        $cat_ids=K::M('article/cate')->children_ids(0);
        $data['list']=K::M('article/article')->items_by_cate_page($cat_ids,$data['limit'],0,$params['order']);
        $params['tpl'] = 'hot.html';
        return $data;
    }

    public function tag(&$params){
        $data['limit'] = $params['limit'] ? $params['limit'] : 15;
        $data['cat_id']=$params['cat_id'];
        if(isset($params['key'])) {
            if(empty($params['key'])){
                $params['key']="'aaaaaaaaaaaaaaaaaaaa'";
            }else{
                $params['key']="'{$params['key']},aaaaaaaaaaaaaaaaaaaa'";
                $params['key']=str_replace(",","','",$params['key']);
            }
            $cat_ids=K::M('article/cate')->children_ids($params['cat_id']);
            $data['list']=K::M('article/tag')->items_by_cate_key_page($cat_ids,$params['key'],$data['limit'],0,$params['order']);
            $params['tpl'] = 'tag2.html';
            return $data;
        }else{
            $cat_ids=K::M('article/cate')->children_ids($params['cat_id']);
            $data['list']=K::M('article/tag')->items_by_cate_page($cat_ids,$data['limit'],0,$params['order']);
            $params['tpl'] = 'tag.html';
            return $data;
        }
    }

}
