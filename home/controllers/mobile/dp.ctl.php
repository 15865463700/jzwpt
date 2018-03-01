<?php

class Ctl_Mobile_Dp extends Ctl_Mobile
{

    public function __construct(&$system)
    {
        parent::__construct($system);
//        $uri = $this->request['uri'];
//        if (preg_match('/ask-([\d]+)\.html/i', $uri, $match)) {
//            $system->request['act'] = 'detail';
//            $system->request['args'] = array(
//                $match[1]
//            );
//        }
    }

    public function index(){
        $this->tmpl = 'mobile/dp/index.html';
    }

    public function dplist($page=1){
        $result=array();

        $filter = $pager = $cate = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 30;
        $filter['audit'] = 1;
        $filter['ask_id'] = ">:970";
        $orderby = array('ask_id'=>'DESC');
        $count=0;
        if ($items = K::M('dp/ask')->items($filter, $orderby,$page, $limit, $count)) {
        }
        $result['count']=$count;

        $ask_ids = array();
        foreach($items as $k=>$v){
            array_push($ask_ids,$v['ask_id']);
        }
        $htdztj=K::M('dp/log')->counts_by_ids($ask_ids,1);
        $htpjtj=K::M('dp/answer')->counts_by_parentIds($ask_ids,1);

        Import::L('jiami/xdeode.class.php');
        $xdeode = new XDeode(6);
        foreach($items as $k=>$v){
            $items[$k]['datetime']=date("Y-m-d H:i",$v['dateline']);
            if($htdztj[$v['ask_id']]){
                $items[$k]['htdz_count']=$htdztj[$v['ask_id']];
            }else{
                $items[$k]['htdz_count']=0;
            }
            if($htpjtj[$v['ask_id']]){
                $items[$k]['htpj_count']=$htpjtj[$v['ask_id']];
            }else{
                $items[$k]['htpj_count']=0;
            }
            if($v['uid']>0){
                $user=K::M('member/member')->detail($v['uid']);
//                $items[$k]['uname']=$user['uname'];
                if($user['company']){
                    $items[$k]['uname']=$user['company'];
                }else if(preg_match("/^[\d\-]{7,11}$/", $user['uname'])){
                    $items[$k]['uname']="jzuser-".substr($user['uname'],0,2)."***".substr($user['uname'],strlen($user['uname'])-2);
                }else{
                    $items[$k]['uname']="jzuser-".$user['uname'];
                }
                $items[$k]['face']="/attachs/".$user['face'];
            }else{
                $items[$k]['uname']="jzuser-".$xdeode->encode($v['ask_id']);
                $items[$k]['face']="/themes/default/static/images/niming_23.jpg";
            }
            if(!$items[$k]['face']){
                $items[$k]['face']="/themes/default/static/images/niming_23.jpg";
            }
            $items[$k]['uname'].="";
        }

        $answers=K::M('dp/answer')->items_by_askIds($ask_ids);
        $answer_ids = array();
        foreach($answers as $k=>$v){
            array_push($answer_ids,$v['answer_id']);
        }

        $pjdztj=K::M('dp/log')->counts_by_ids($answer_ids,2);
        $pjpjtj=K::M('dp/answer')->counts_by_parentIds($answer_ids,2);

        $answer_map=array();
        $answers_uname=array();
        foreach($answers as $k=>$v){
            if(!$answer_map[$v['ask_id']]){
                $answer_map[$v['ask_id']]=array();
            }
            if($pjdztj[$v['answer_id']]){
                $v['pjdz_count']=$pjdztj[$v['answer_id']];
            }else{
                $v['pjdz_count']=0;
            }
            if($pjpjtj[$v['answer_id']]){
                $v['pjpj_count']=$pjpjtj[$v['answer_id']];
            }else{
                $v['pjpj_count']=0;
            }
            if($v['uid']>0){
                $user=K::M('member/member')->detail($v['uid']);
//                $answers_uname[$v['answer_id']]=$user['uname'];
                if($user['company']){
                    $answers_uname[$v['answer_id']]=$user['company'];
                }else if(preg_match("/^[\d\-]{7,11}$/", $user['uname'])){
                    $answers_uname[$v['answer_id']]="jzuser-".substr($user['uname'],0,2)."***".substr($user['uname'],strlen($user['uname'])-2);
                }else{
                    $answers_uname[$v['answer_id']]="jzuser-".$user['uname'];
                }
//                $v['uname']=$user['uname'];
                if($user['company']){
                    $v['uname']=$user['company'];
                }else if(preg_match("/^[\d\-]{7,11}$/", $user['uname'])){
                    $v['uname']="jzuser-".substr($user['uname'],0,2)."***".substr($user['uname'],strlen($user['uname'])-2);
                }else{
                    $v['uname']="jzuser-".$user['uname'];
                }
                $v['face']="/attachs/".$user['face'];
            }else{
                $uname=$xdeode->encode($v['answer_id']);
                $v['face']="/themes/default/static/images/niming_23.jpg";
                $v['uname']=$uname;
                $answers_uname[$v['answer_id']]=$uname;
            }
            if(!$v['face']){
                $v['face']="/themes/default/static/images/niming_23.jpg";
            }
            $v['datetime']=date("Y-m-d H:i",$v['dateline']);
            array_push($answer_map[$v['ask_id']],$v);
        }

        foreach($answer_map as $k=>$v){
            foreach($v as $kk=>$vv){
                $answer_map[$k][$kk]["pname"]=$answers_uname[$vv['parent_id']];
            }
        }
        $result['total'] = $count;
//        $result['next']=
        $result['answers_uname'] = $answers_uname;

        foreach($items as $k=>$v){
            $items[$k]["answers"]=$answer_map[$v['ask_id']];

        }
        $result['items'] = array_values($items);
        if($page*$limit<=$count){
            $result['n'] = ++$page;
        }else{
            $result['n'] = 0;
        }

        die(json_encode($result));
    }

    public function wdlist($page=1){
        $result=array();
        $order=0;
        $pager = $filter = array();
        $pager['page'] = $page = max((int) $page, 1);
        $pager['order'] = $order;
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter['status'] = 1;
        $orderby = array(
            'wd_id' => 'DESC'
        );
        if ($items = K::M('wd/wd')->items($filter, $orderby,$page, $limit, $count)) {
            $pager['count'] = $count;
        }
        $pc=ceil($count*1.0/$page);
        if($pc<1){
            $pc=1;
        }
//        if($page*$limit<=$count){
//            $result['n'] = ++$page;
//        }else{
//            $result['n'] = 0;
//        }
        $result['items'] = array_values($items);
        $result['count'] = $count;
        if($page*$limit<=$count){
            $result['n'] = ++$page;
        }else{
            $result['n'] = 0;
        }
        die(json_encode($result));
    }

    public function show(){
        $this->tmpl = 'mobile/dp/show.html';
    }
}
