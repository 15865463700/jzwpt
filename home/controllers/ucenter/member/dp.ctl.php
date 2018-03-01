<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Ucenter_Member_Dp extends Ctl_Ucenter
{

    public function index($page = 1)
    {
        $filter = $pager = array();
        $filter['uid'] = $this->uid;
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        if ($items = K::M('dp/ask')->items(array(
            'uid' => $this->uid
        ), null, $page, $limit, $count)){
//            $items = K::M('dp/ask')->ask_answer_num($items);
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));

            $ask_ids=array();
            foreach($items as $k=>$v){
                array_push($ask_ids,$v['ask_id']);
            }
            $ask_ids=array_unique($ask_ids);
            $htpjtj=K::M('dp/answer')->counts_by_parentIds($ask_ids,1);
            foreach($items as $k=>$v){
                if($htpjtj[$v['ask_id']]){
                    $items[$k]['answer_num']=$htpjtj[$v['ask_id']];
                }else{
                    $items[$k]['answer_num']=0;
                }
            }
            $this->pagedata['items'] = $items;
            $this->pagedata['cate_list'] = K::M('dp/cate')->fetch_all();
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'ucenter/member/dp/asks.html';
    }

    public function answer($page = 1)
    {
        $filter = $pager = array();
        $filter['uid'] = $this->uid;
        $pager['page'] = $page = max((int) $page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        if ($items = K::M('dp/answer')->items(array(
            'uid' => $this->uid
        ), null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array(
                '{page}'
            )));
            $ask_ids = array();
            foreach ($items as $k => $v) {
                $ask_ids[$v['ask_id']] = $v['ask_id'];
            }
            if ($ask_ids) {
                $this->pagedata['ask_list'] = K::M('dp/ask')->items_by_ids($ask_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'ucenter/member/dp/answers.html';
    }
}