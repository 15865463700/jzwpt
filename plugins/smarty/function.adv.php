<?php
/**
 * Copy Right Anhuike.com
 * $Id function.widget.php shzhrui<anhuike@gmail.com>
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
function smarty_function_adv($params, &$smarty)
{
    $params['adv_id'] = $params['adv_id'] ? $params['adv_id'] : $params['id'];
    $result=K::M('adv/adv')->block($params, null, $smarty);
    if($params["t"]){
        $result=preg_replace("/article-detail-/","{$params['t']}/",$result);
        $result=preg_replace("/-1\./",".",$result);
    }
    return $result;
}

