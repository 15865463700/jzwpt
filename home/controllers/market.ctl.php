<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}
require (IN_DIR . 'system/plugins/smarty/block.KT.php');

class Ctl_Market extends Ctl
{

    public function index()
    {}

    public function adclick($item_id)
    {
        if ($item = K::M('adv/item')->detail($item_id)) {
            K::M('adv/item')->update_count($item_id, 'clicks');
            if (preg_match('/(http|https)\:\/\//i', $item['link'])) {
                header('Location:' . $item['link']);
            }
            exit();
        } else {
            $this->error(404);
        }
    }

    public function block($block_id, $city_id = 0)
    {
        $smarty = K::M('system/frontend');
        if ($content = K::M('block/block')->block(array(
            'id' => $block_id,
            'city_id' => $city_id
        ), null, $smarty)) {
            $content = addslashes(preg_replace('/[\r\n]+/', ' ', $content));
            echo 'document.write("' . $content . '")';
        }
        exit();
    }
}