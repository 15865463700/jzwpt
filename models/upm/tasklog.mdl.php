<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Upm_Tasklog extends Mdl_Table
{   
  
    protected $_table = 'upm_task_log';
    protected $_pk = 'log_id';
    protected $_cols = 'log_id,company_id,sale_id,pmid,yuyue_id,yuyue_status,wx_openid,hash,clientip,dateline';

    public function detail_by_yuyue_id($yuyue_id)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            return false;
        }
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE yuyue_id='{$yuyue_id}'";
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }

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

    public function yuyue_log($log_id, $yuyue_id)
    {
        if(!$log = K::M('upm/tasklog')->detail($log_id)){
            return false;
        }
        if($ret = $this->update($log_id, array('yuyue_id'=>$yuyue_id, 'yuyue_status'=>1))){
            K::M('upm/task')->update_cps($log, 'yuyue');
        }
        return $ret;
    }

    public function tongji_count($filter)
    {
        $counts = array('uv'=>0, 'yuyue'=>0, 'youxiao'=>0, 'liangfang'=>0, 'qiandan'=>0);
        $where = $this->where($filter);
        $sql = "SELECT status, COUNT(1) as count WHERE ".$where. " GROUP BY status";
        $sql = "SELECT `yuyue_status`, COUNT(1) as C FROM ".$this->table($this->_table)." WHERE ".$where ." GROUP BY `yuyue_status`";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                switch($row['yuyue_status']){
                    case 4:
                        $counts['qiandan'] += $row['C'];
                    case 3:
                        $counts['liangfang'] += $row['C'];
                    case 2:
                        $counts['youxiao'] += $row['C'];
                    case 1:
                        $counts['yuyue'] += $row['C'];
                    default:
                        $counts['uv'] += $row['C'];
                }
            }
        }
        return $counts;
    }

    public function update_yuyue($yuyue_id, $status=0)
    {
        if(!$log = $this->detail_by_yuyue_id($yuyue_id)){
            return false;
        }else if(!$status = (int)$status){
            return false;
        }
        //1:预约，2:有效,3:量房,4:签单      
        if($this->update($log['log_id'], array('yuyue_status'=>$status))){
            if($status == 2){
                $s = 'youxiao';
            }else if($status == 3){
                $s = 'liangfang';
            }else if($status == 4){
                $s = 'qiandan';
            }
            K::M('upm/task')->update_cps($log, $s);
        }
        
    }
}