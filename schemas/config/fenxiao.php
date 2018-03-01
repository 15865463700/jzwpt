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
  'audit' => 
  array (
    'label' => '招标审核通过返利',
    'field' => 'audit',
    'type' => 'number',
    'default' => '100',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'sign' => 
  array (
    'label' => '招标签单返利',
    'field' => 'sign',
    'type' => 'number',
    'default' => '500',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
   'newreg' => 
  array (
    'label' => '新注册获取积分',
    'field' => 'newreg',
    'type' => 'number',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'signtender' => 
  array (
    'label' => '招标签单获取积分',
    'field' => 'signtender',
    'type' => 'number',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'tuijian' => 
  array (
    'label' => '推荐获取积分',
    'field' => 'tuijian',
    'type' => 'number',
    'default' => '',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
  'pay' => 
  array (
    'label' => '购物获取积分',
    'field' => 'pay',
    'type' => 'text',
    'default' => '0.1',
    'comment' => '',
    'html' => false,
    'empty' => false,
  ),
);