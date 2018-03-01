<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: data_city.php 3159 2014-01-22 01:54:39Z youyi $
 */
return array (
  'city_id' => 
  array (
    'field' => 'city_id',
    'label' => 'ID',
    'pk' => true,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),
  'province_id' => 
  array (
    'field' => 'province_id',
    'label' => '省份',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '',
    'SO' => '=',
  ),  
  'city_name' => 
  array (
    'field' => 'city_name',
    'label' => '城市',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),
  'pinyin' => 
  array (
    'field' => 'pinyin',
    'label' => '拼音',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'theme_id' => 
  array (
    'field' => 'theme_id',
    'label' => '模板',
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
'logo' => 
  array (
    'field' => 'logo',
    'label' => 'LOGO',
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
    'SO' => 'like',
  ),
'weixinqr' => 
  array (
    'field' => 'weixinqr',
    'label' => '微信',
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
    'SO' => 'like',
  ),    
'kfqq' => 
  array (
    'field' => 'kfqq',
    'label' => '客服QQ',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'qq',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),
'phone' => 
  array (
    'field' => 'phone',
    'label' => '电话',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'phone',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),   
'mobile' => 
  array (
    'field' => 'mobile',
    'label' => '手机',
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
    'SO' => 'like',
  ),
'mail' => 
  array (
    'field' => 'mail',
    'label' => '邮箱',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'mail',
    'comment' => '',
    'default' => '',
    'SO' => 'like',
  ),   
  'seo_title' => 
  array (
    'field' => 'seo_title',
    'label' => 'seo标题',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'seo_keywords' => 
  array (
    'field' => 'seo_keywords',
    'label' => 'seo关键词',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'textarea',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'seo_description' => 
  array (
    'field' => 'seo_description',
    'label' => 'seo描述',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'textarea',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
'tongji' =>
    array(
    'field' => 'tongji',
    'label' => '统计代码',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => true,
    'empty' => true,
    'show' => false,
    'list' => false,
    'type' => 'textarea',
    'comment' => '',
    'default' => '',
    'SO' => false,
),  
  'orderby' => 
  array (
    'field' => 'orderby',
    'label' => '排序',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '50',
    'SO' => false,
  ),
  'audit' => 
  array (
    'field' => 'audit',
    'label' => '状态',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '0',
    'SO' => false,
  ),
   'dateline' => 
  array (
    'field' => 'dateline',
    'label' => 'dateline',
    'pk' => false,
    'add' => false,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '0',
    'SO' => false,
  ),   
);