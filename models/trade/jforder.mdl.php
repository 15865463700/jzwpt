<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: order.mdl.php 6303 2014-09-17 11:01:41Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Trade_Jforder extends Mdl_Table
{   
  
    protected $_table = 'jforder';
    protected $_pk = 'order_id';
    protected $_cols = 'order_id,order_no,uid,product_id,product_name,product_num,product_jfprice,pay_status,order_status,jfamount,contact,mobile,addr,note,audit,closed,clientip,dateline';
    protected $_orderby = array('order_id'=>'DESC');
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        $data['order_no'] = $this->create_order_no();
        return $this->db->insert($this->_table, $data, true);
    }


    public function create_order_no()
    {
        $i = rand(0, 9999);
        do {
            if (9999 == $i) {
                $i = 0;
            } 
            ++$i;
            $no = date("ymd") . str_pad($i, 4, "0", STR_PAD_LEFT);
            $order_no = $this->db->GetRow("SELECT order_no FROM ".$this->table($this->_table)." WHERE order_no='{$no}'");
        } while ($order_no);
        return $no;
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    //public function detail($order_id, $closed=false)
    //{
       // if($row = parent::detail($order_id, $closed)){
         //   $row['products'] = K::M('trade/product')->order_products($row['order_id']);
       // }
       // return $row;
   // }

    public function detail_by_no($no)
    {
        if($no = (int)$no){
            $where = "order_no=$no";
        }else{
            return false;
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE order_no='$no' AND closed=0";
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }

    public function set_payed($no, $trade=array())
    {
        if(!$order = $this->detail_by_no($no)){
            return false;
        }
        $a = array('pay_status'=>1, 'pay_time'=>__CFG::TIME, 'audit'=>1);
        if($ret = $this->update($order['order_id'], $a, true)){
            $smsdata = array('contact'=>$order['contact'], 'mobile'=>$order['mobile'], 'order_no'=>$no, 'order_amount'=>$order['amount']);
            $maildata = array('order_no'=>$order['order_no'], 'order_amount'=>$order['amount'], 'contact'=>$order['contact']);
            $maildata['link'] = K::M('helper/link')->mklink('jifenshangcheng/order:detail', array($order['order_id']), array(), true);
            if($mobile = K::M('verify/check')->mobile($order['mobile'])){
                K::M('sms/sms')->send($mobile, 'jforder_payment_buyer', $smsdata);
            }
            if($member = K::M('member/member')->member($order['uid'])){
                K::M('helper/mail')->send($member['mail'], 'jforder_payment_buyer', $maildata);
            }
        }
        return $ret;
    }

    public function count_by_uid($uid)
    {
        if(!$uid = (int)$uid){
            return false;
        }
        $sql = "SELECT order_status, COUNT(1) as C FROM ".$this->table($this->_table)." WHERE uid='$uid' AND closed=0 GROUP BY order_status";
        $order_count = array('count'=>0, 'cancel'=>0,'member_cancel'=>0,'shop_cancel'=>0,'unship'=>0,'new'=>0, 'unpay'=>0,'finish'=>0);
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                if($row['order_status'] == -1){
                    $order_count['member_cancel'] = $row['C'];
                    $order_count['cancel'] += $row['C'];
                }else if($row['order_status'] == -2){
                    $order_count['shop_cancel'] = $row['C'];
                    $order_count['cancel'] += $row['C'];
                }else if($row['order_status'] == 1){
                    $order_count['unship'] = $row['C'];
                }else if($row['order_status'] == 2){
                    $order_count['finish'] = $row['C'];
                }else if($row['order_status'] == 0){
                    $order_count['new'] = $row['C'];
                }
                $order_count['count'] += $row['C'];
            }
        }
        $sql = "SELECT COUNT(1) FROM ".$this->table($this->_table)." WHERE uid='$uid' AND closed=0 AND pay_status=0";
        $order_count['unpay'] = $this->db->GetOne($sql);               
        return $order_count;
    }

}