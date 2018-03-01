<?php
class Ctl_Dp extends Ctl{
    public static $ctl_dp_old="dp";
    public static $ctl_dp_new="dp";
    
    public function index($page=1){
        $this->items($page);
    }

    public function items($page = 1){
        $this->pagedata['canonical'] = "{$_SERVER['HTTP_HOST']}/dp/";

        $session = K::M('system/session')->start();
        if($session->get("substation")){
            $this->request['city']=$session->get("substation");
        }
        if($_REQUEST["a"]){
            $page=$_REQUEST["a"];
        }

        $filter = $pager = $cate = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['audit'] = 1;
        $count=0;
        if ($items = K::M('dp/ask')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('dp:items', array(
//                $page,
                '{page}'
            )), array());
            $pager['pagebar']=preg_replace("/dp-items-([a-zA-Z0-9]*)/","dp-$1/",$pager['pagebar']);
            $pager['pagebar']=preg_replace("/\/\.html/","/",$pager['pagebar']);
//            $pager['pagebar']=preg_replace("/\/\//","/",$pager['pagebar']);
            $pager['pagebar']=preg_replace("/-1/","",$pager['pagebar']);
        }

        $ask_ids = array();
        foreach($items as $k=>$v){
            array_push($ask_ids,$v['ask_id']);
        }
        $htdztj=K::M('dp/log')->counts_by_ids($ask_ids,1);
        $htpjtj=K::M('dp/answer')->counts_by_parentIds($ask_ids,1);

        Import::L('jiami/xdeode.class.php');
        $xdeode = new XDeode(6);
//        $mima = $xdeode->encode(222);
        foreach($items as $k=>$v){
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
                if($user['company']){
                    $items[$k]['uname']=$user['company'];
                }else if(preg_match("/^[\d\-]{7,11}$/", $user['uname'])){
                    $items[$k]['uname']="jzuser-".substr($user['uname'],0,2)."***".substr($user['uname'],strlen($user['uname'])-2);
                }else{
                    $items[$k]['uname']="jzuser-".$user['uname'];
                }
                if(!$user['face']){
                    $items[$k]['face']="/themes/default/static/images/niming_23.jpg";
                }else{
                    $items[$k]['face']='/attachs/'.$user['face'];
                }
            }else{
                $items[$k]['uname']="jzuser-".$xdeode->encode($v['ask_id']);
                $items[$k]['face']="/themes/default/static/images/niming_23.jpg";
            }
            if(!$items[$k]['face']){
                $items[$k]['face']="/themes/default/static/images/niming_23.jpg";
            }
            $items[$k]['uname'].="&nbsp;";
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['count'] = $count;

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

                if(!$user['face']){
                    $v['face']="/themes/default/static/images/niming_23.jpg";
                }else{
                    $v['face']='/attachs/'.$user['face'];
                }
            }else{
                $answers_uname[$v['answer_id']]=$xdeode->encode($v['answer_id']);
                $v['face']="/themes/default/static/images/niming_23.jpg";
            }
            if(!$v['face']){
                $v['face']="/themes/default/static/images/niming_23.jpg";
            }
            $v['uname'].="&nbsp;";
            array_push($answer_map[$v['ask_id']],$v);
        }
        $this->pagedata['answers'] = $answer_map;
        $this->pagedata['total'] = $count;
        $this->pagedata['answers_uname'] = $answers_uname;

        $this->pagedata['canonical'] = "www.jzwpt.com/{$_SERVER['REQUEST_URI']}/";
        $this->pagedata['canonical']= preg_replace("/\d*/", "", $this->pagedata['canonical']);
        $this->pagedata['canonical']= str_replace("-", "", $this->pagedata['canonical']);
        $this->pagedata['canonical']= str_replace("//", "/", $this->pagedata['canonical']);

        if(is_main()){
            empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('dp_items', $seo):$this->seo->init('dp_items_attr', $seo);
        }else{
            empty($seo['attr'])&&empty($seo['area_name'])?$this->seo->init('fenzhan_dp_items', $seo):$this->seo->init('fenzhan_dp_items_attr', $seo);
        }
        $this->tmpl = 'dp/items.html';
    }

    public function save(){
                if ($data = $this->checksubmit('data')){

                    $audit=1;
                    if ($data['content']) {
                        $data['title'] = K::M('content/string')->sub($data['content'], 0, 20, $suffix = "");
                        $data['intro'] = K::M('content/string')->sub($data['content'], 20, K::M('content/string')->Len($data['content']), $suffix = "");
                    }
                    $data = array(
                        'title' => $data['title'],
                        'intro' => $data['intro'],
                        'uid' => $this->uid,
                        'audit' => $audit
                    );
                    if (! $cat_id = $this->GP('cat_id')) {
                        $cat_id = '1';
                    }
                    if ($ask_id = K::M('dp/ask')->create($data)) {
                        $this->err->add('发起话题成功');
                        $this->err->set_data('forward', $this->mklink('dp:items', array(
                            $cat_id
                        )));
                    }
                }
                else {
                    $this->err->add('发起话题失败', 201);
                }
    }

    public function thumbs_up($cate_id=0,$target_id=0){
        if(in_array($cate_id,array(1,2))&&$target_id){
            $uid=$this->uid;
            $flag=K::M('dp/log')->exists($uid,$cate_id,$target_id,1800);
            if(!$flag){
                $data=array();
                $data['uid']=$uid;
                $data['cate_id']=$cate_id;
                $data['target_id']=$target_id;
                $data['dateline']=__CFG::TIME;
                $rs=K::M('dp/log')->create($data);
                if($rs){
                    $this->err->add('操作成功!');
                }else{
                    $this->err->add('操作失败!',500);
                }
            }else{
                if(K::M('dp/log')->remove($uid,$cate_id,$target_id,1800)){
                    $this->err->add('撤销成功!',501);
                }else{
                    $this->err->add('撤销失败!',502);
                }
            }
        }else{
            $this->err->add('操作失败!',401);
        }
    }

    public function dp($cate_id=0,$target_id = null){
        if (! $contents = $this->GP('contents')) {
            $this->err->add('请输入您要回答的内容', 212);
        }elseif(in_array($cate_id, array(1, 2)) && $target_id) {
            if($cate_id == 1) {
                if(! $detail = K::M('dp/ask')->detail($target_id)) {
                    $this->err->add('内容不存在', 213);
                }elseif ($detail['uid']&&$detail['uid'] == $this->uid) {
                    $this->err->add('您不能回复自己点评!', 214);
                }else{
                    $result=$this->pj($this->uid,1,$detail['ask_id'],$detail['ask_id'],$contents);
                    if($result) {
                        $this->err->add('点评成功!');
                    } else {
                        $this->err->add('点评失败!', 215);
                    }
                }
            }elseif($cate_id == 2) {
                if(! $detail = K::M('dp/answer')->detail($target_id)) {
                    $this->err->add('内容不存在', 212);
                }elseif ($detail['uid']&&$detail['uid'] == $this->uid) {
                    $this->err->add('您不能回复自己点评!', 214);
                }else{
                    $result=$this->pj($this->uid,2,$detail['ask_id'],$detail['answer_id'],$contents);
                    if($result) {
                        $this->err->add('点评成功!');
                    } else {
                        $this->err->add('点评失败!', 212);
                    }
                }
            }
        }else{
            $this->err->add('点评失败!', 212);
        }
    }

    private function pj($uid,$cate_id,$ask_id,$parent_id,$contents){
        $data = array(
            'uid' => $uid,
            'cate_id' => $cate_id,
            'ask_id' => $ask_id,
            'contents' => $contents,
            'audit' =>1,
            'parent_id' => $parent_id,
            'dateline' => __TIME,
            'clientip' => __IP,
        );
        $result = K::M('dp/answer')->create($data);
        return $result;
    }

    public function post(){
        if (!$contents = $this->GP('contents')) {
            $this->err->add('请输入您要发布的话题', 212);
        }else{
            $title= mb_substr($contents,0,10,"utf-8");
            $data=array(
                "title"=>$title,
                "intro"=>$contents,
                "uid"=>$this->uid,
                'dateline' => __TIME,
                'clientip' => __IP,
                'thumb_up' => 0,
                'audit' =>1,
            );
            $result = K::M('dp/ask')->create($data);
            if($result) {
                $this->err->add('点评成功!');
            } else {
                $this->err->add('点评失败!', 212);
            }
        }
    }

}
