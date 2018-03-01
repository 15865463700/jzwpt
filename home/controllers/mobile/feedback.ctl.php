<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Mobile_Feedback extends Ctl_Mobile
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $uri = $this->request['uri'];
        if (preg_match('/feedback-([\d]+)\.html/i', $uri, $match)) {
            $system->request['act'] = 'detail';
            $system->request['args'] = array(
                $match[1]
            );
        }
    }
    public function index($page = 1)
    {
        $this->tmpl = 'mobile/feedback/items.html';
    }

    public function post(){
        $this->tmpl = 'mobile/feedback/post.html';
    }

    public function yuyue($activity_id)
    {
        if (! ($activity_id = (int) $activity_id) && ! ($activity_id = (int) $this->GP('activity_id'))) {
            $this->error(404);
        } else 
            if (! $detail = K::M('activity/activity')->detail($activity_id)) {
                $this->error(404);
            } elseif (! $detail['audit']) {
                $this->err->add('该活动还在审核中，暂不可评论', 213);
            } else {
                if ($data = $this->checksubmit('data')) {
                    $data['activity_id'] = $activity_id;
                    if (! $data = $this->GP('data')) {
                        $this->err->add('非法的数据提交', 201);
                    } else {
                        $data['city_id'] = $isdata['city_id'] = $this->request['city_id'];
                        $data['activity_id'] = $isdata['activity_id'] = $activity_id;
                        $data['uid'] = $isdata['uid'] = $this->uid;
                        $isdata['mobile'] = $data['mobile'];
                        if ($is_sign = K::M('activity/sign')->items($isdata)) {
                            $this->err->add('该用户已经报名完成', 215);
                        } elseif ($sign_id = K::M('activity/sign')->create($data)) {
                            $this->err->add('优惠活动报名成功！');
                        }
                    }
                } else {
                    
                    $pager['tender_hide'] = 1;
                    $access = $this->system->config->get('access');
                    $this->pagedata['yuyue_yz'] = $access['verifycode']['yuyue'];
                    $this->pagedata['activity_id'] = $activity_id;
                    $this->pagedata['detail'] = $detail;
                    $pager['backurl'] = $this->mklink('mobile/activity', array(
                        'activity_id' => $activity_id
                    ));
                    $this->pagedata['pager'] = $pager;
                    $this->tmpl = 'mobile/activity/yuyue.html';
                }
            }
    }
    public function create(){
        $phone=(int)$_POST['phone'];
        $feedback=$_POST['feedback'];
        $data=array(
            'phone'=>$phone,
            'feedback'=>$feedback
            );
         $a = K::M('verify/check')->mobile($phone);
         if($phone==""){
             $this->err->add("手机号码不能为空,请重新输入",213);
         }else if(!$a){
            $this->err->add("手机号码不正确,请重新输入",201);
         }else{
              $items=K::M('feedback/feedback')->create($data);
             if($items){
                 $this->err->add("提交成功");
             }else{
                 $this->err->add("提交失败",201);
             }
         }
    }
}