<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: member_verify.php 2034 2013-12-07 03:08:33Z $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'uid' => 
  array (
    'field' => 'uid',
    'label' => 'UID',
    'pk' => true,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => false,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'name' => 
  array (
    'field' => 'name',
    'label' => '姓名/企业名',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),
  'id_number' => 
  array (
    'field' => 'id_number',
    'label' => '证件号',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'id_photo' => 
  array (
    'field' => 'id_photo',
    'label' => '证件图片',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'photo',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'mobile' => 
  array (
    'field' => 'mobile',
    'label' => '手机号',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'mobile',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'verify' => 
  array (
    'field' => 'verify',
    'label' => '审核状态',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'radio',
    'comment' => '0:待审,1:通过，2：打回',
    'default' => '',
    'SO' => '=',
  ),
  'refuse' => 
  array (
    'field' => 'refuse',
    'label' => '拒绝信息',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'textarea',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'verify_time' => 
  array (
    'field' => 'verify_time',
    'label' => '认证通过时间',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'unixtime',
    'comment' => '',
    'default' => '',
    'SO' => 'betweendate',
  ),
  'request_ip' => 
  array (
    'field' => 'request_ip',
    'label' => '申请时IP',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'clientip',
    'comment' => '',
    'default' => '0.0.0.0',
    'SO' => false,
  ),
  'request_time' => 
  array (
    'field' => 'request_time',
    'label' => '申请时间',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'dateline',
    'comment' => '',
    'default' => '',
    'SO' => 'betweendate',
  ),
);