<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: order.ctl.php 3903 2014-03-17 02:09:44Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Trade_Jforder extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['order_id']){$filter['order_id'] = $SO['order_id'];}
            if($SO['order_no']){$filter['order_no'] = "LIKE:%".$SO['order_no']."%";}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if(is_array($SO['amount'])){$a = intval($SO['amount'][0]);$b=intval($SO['amount'][1]);if($a && $b){$filter['amount'] = $a."~".$b;}}
            if($SO['contact']){$filter['contact'] = "LIKE:%".$SO['contact']."%";}
            if(is_numeric($SO['pay_status'])){$filter['pay_status'] = $SO['pay_status'];}
            if(is_numeric($SO['order_status'])){$filter['order_status'] = $SO['order_status'];}
            if(is_numeric($SO['audit'])){$filter['audit'] = $SO['audit'];}
            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1])+86400;$filter['dateline'] = $a."~".$b;}}
        }
        $filter['closed'] = 0;
        if($items = K::M('trade/jforder')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
            $uids = $shop_ids = array();
            foreach($items as $k=>$v){
                $uids[$v['uid']] = $v['uid'];
                $shop_ids[$v['shop_id']] = $v['shop_id'];
            }
            if($uids){
                $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
            }
            if($shop_ids){
                $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_ids($shop_ids);
            }
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:trade/jforder/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:trade/jforder/so.html';
    }

    public function detail($order_id = null)
    {
        if(!$order_id = (int)$order_id){
            $this->err->add('未指定要查看内容的ID', 211);
        }else if(!$detail = K::M('trade/jforder')->detail($order_id)){
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        }else{
            if($uid = $detail['uid']){
                $this->pagedata['member'] = K::M('member/member')->member($uid);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:trade/jforder/detail.html';
        }
    }

    public function sendout($order_id=null)
    {
        if(!$order = K::M('trade/jforder')->detail($order_id)){
            $this->err->add('订单不存在', 401);
        }else if($order['order_status'] == 1){
            $this->err->add('该订单已经发货，不能重复发货', 401);
        }else if($order['order_status'] == 2){
            $this->err->add('该订单已经完成，不能发货', 401);
        }else if($order['order_status'] < 0){
            $this->err->add('该订单已经取消，不能发货', 401);
        }else if(K::M('trade/jforder')->update($order_id,array('order_status'=>'1'))){
            $this->err->add('发货成功');
        }
    }

    public function cancle($order_id=null)
    {
        if(!$order = K::M('trade/jforder')->detail($order_id)){
            $this->err->add('未指定要取消的内容ID', 401);
        }else if($order['pay_status'] && ($order['amount'] > 0)){
            $this->err->add('用户已支付，订单不能取消', 401);
        }else if($order['order_status'] == 1){
            $this->err->add('该订单已经发货，不能取消', 401);
        }else if($order['order_status'] == 2){
            $this->err->add('该订单已经完成，不能取消', 401);
        }else if($order['order_status'] < 0){
            $this->err->add('该订单已经取消，不能重复取消', 401);
        }else if(K::M('trade/jforder')->update($order_id,array('order_status'=>'-2'))){
            $member = K::M('member/member')->detail($order['uid']);
            K::M('member/member')->update($order['uid'], array('jifen'=>$member['jifen']+$order['jfamount']), $checked=false);
            K::M('fenxiao/log')->log($this->uid,0, '1',$order['jfamount'],'取消订单退回积分');
            //K::M('member/gold')->update($order['uid'],$order['jfamount'],'取消订单退回金币');
            $this->err->add('取消成功');
        }
    }

    public function delete($order_id=null)
    {
        if($order_id = (int)$order_id){
            if(K::M('trade/jforder')->delete($order_id)){
                $this->err->add('删除成功');
            }
        }else if($ids = $this->GP('order_id')){
            if(K::M('trade/jforder')->delete($ids)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}