<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: gold.mdl.php 5610 2014-06-23 16:47:52Z youyi $
 */

Import::M('member/member');
class Mdl_Member_jifen extends Mdl_Member_Member
{   
    

    public function update($uids, $jifen, $log='')
    {

        if(!$jifen = (int)$jifen){
            $this->err->add('更变的积分值非法', 411);
        }else if(empty($log)){
            $this->err->add('未指定积分充值日志', 412);
        }else{
            if($uids = K::M('verify/check')->ids($uids)){
                foreach(explode(',', $uids) as $uid){
                    $sql = "UPDATE ".$this->table($this->_table)." SET `jifen`=`jifen`+ {$jifen} WHERE uid='$uid'";
                    if($this->db->Execute($sql)){
                        K::M('member/log')->log($uid, 'jifen', $jifen, $log);                        
                    }
                }
                return true;
            }          
        }
        return false;
    }
}