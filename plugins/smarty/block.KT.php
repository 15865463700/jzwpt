<?php
/**
 * Copy	Right Anhuike.com
 * $Id function.widget.php shzhrui<anhuike@gmail.com>
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

function smarty_block_KT($params, $content,	$smarty, &$repeat)
{
	static $block = null;
	if($block === null){
		$block = K::M('block/block');
	}	
	if(!$repeat && $content){
	    $result=$block->block($params, $content, $smarty);
        if($params["t"]){
            $result=preg_replace("/(article-detail|xw-detail|company|gybjcompany|rzpscompany|afzncompany|jtyjycompany)-/","{$params['t']}/",$result);
            $result=preg_replace("/-1\./",".",$result);
            if(substr_count($result,".")==0){
                if(!empty($result)){
                    $result.=".html";
                }
            }elseif(substr_count($result,".html")==0&&substr_count($result,".")>0&&substr_count($result,"html")==0){
                $result=preg_replace("/(xw\/\d*)/","$1.html",$result);
            }
        }
        return $result;
	}
}