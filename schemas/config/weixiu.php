<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * #fileid#
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'max_look' => 
  array (
    'label' => '最大投标数',
    'field' => 'max_look',
    'type' => 'number',
    'default' => '3',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'gold' => 
  array (
    'label' => '投标花费金币',
    'field' => 'gold',
    'type' => 'number',
    'default' => '50',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
);