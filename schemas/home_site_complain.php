<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'complain_id' => 
  array (
    'field' => 'complain_id',
    'label' => 'complain_id',
    'pk' => true,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'custom_id' => 
  array (
    'field' => 'custom_id',
    'label' => 'custom_id',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
 'type_id' => 
  array (
    'field' => 'type_id',
    'label' => '投诉类型',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '投诉类型',
    'default' => '',
    'SO' => '=',
  ),
  'company_id' => 
  array (
    'field' => 'company_id',
    'label' => 'company_id',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'content' => 
  array (
    'field' => 'content',
    'label' => 'content',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => true,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '投诉内容',
    'default' => '',
    'SO' => false,
  ),
  'reply' => 
  array (
    'field' => 'reply',
    'label' => '回复内容',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => true,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '回复内容',
    'default' => '',
    'SO' => false,
  ),
  'status' => 
  array (
    'field' => 'status',
    'label' => 'status',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '0:未审核,1:通过审核,2未通过',
    'default' => '0',
    'SO' => false,
  ),
   'read' => 
  array (
    'field' => 'read',
    'label' => 'read',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '0:未,1:已读',
    'default' => '',
    'SO' => false,
  ),
  'closed' => 
  array (
    'field' => 'closed',
    'label' => 'closed',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
   'lasttime' => 
  array (
    'field' => 'lasttime',
    'label' => '处理时间',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '处理时间',
    'default' => '',
    'SO' => 'betweendate',
  ),
  'dateline' => 
  array (
    'field' => 'dateline',
    'label' => 'dateline',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '',
    'default' => '',
    'SO' => 'betweendate',
  ),
);