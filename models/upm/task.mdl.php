<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Upm_Task extends Mdl_Table
{   
  
    protected $_table = 'upm_task';
    protected $_pk = 'company_id';
    protected $_cols = 'company_id,title,photo,content,stime,ltime,uv_num,uv_credits,uv_money,yuyue_credits,yuyue_money,youxiao_credits,youxiao_money,liangfang_credits,liangfang_money,qiandan_credits,qiandan_money,views,uv_count,yuyue_count,liangfang_count,qiandan_count,audit,dateline';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    public function detail_by_company_id($company_id)
    {
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE company_id='{$company_id}'";
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }

    public function update_cps($log, $s)
    {
        //1:预约,2:有效,3:量房,4:签单
        if($task = $this->detail($log['company_id'])){
            $credit = $money = 0;
            if($s == 'yuyue'){
                $credit = $task['yuyue_credits'];
                $moeny = $task['yuyue_moeny'];
            }else if($s == 'youxiao'){
                $credit = $task['youxiao_credits'];
                $moeny = $task['youxiao_moeny'];
            }else if($s == 'liangfang'){
                $credit = $task['liangfang_credits'];
                $moeny = $task['liangfang_moeny'];
            }else if($s == 'qiandan'){
                $credit = $task['qiandan_credits'];
                $moeny = $task['qiandan_moeny'];
            }
            if($this->update_count($log['company_id'], "{$s}_count", 1)){
                if($task['audit'] && ($task['stime'] < __TIME || !$task['stime']) && ($task['ltime'] > __TIME || !$task['ltime'])){
                    if($credit){
                        K::M('company/sales')->update_credits($log['sales_id'], $credits);
                    }
                    if($money){
                        K::M('company/sales')->update_money($log['sales_id'], $money);
                    }
                }
            }
        }
    }

    protected function _format_row($row)
    {
        if($row['stime'] > __TIME){
            $row['status'] = 'wait';
            $row['status_title'] = '未开始';
            $row['last_day'] = ceil(($row['ltime'] - __TIME)/86400);
        }else if($row['ltime'] < __TIME){
            $row['status'] = 'finish';
            $row['status_title'] = '已结束';
        }else{
            $row['status'] = 'process';
            $row['status_title'] = '进行中';
            $row['last_day'] = ceil(($row['ltime'] - __TIME)/86400);
        }
        return $row;
    }

}