<?php
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Fenxiao_Log extends Mdl_Table{
    protected $_table = 'fenxiao_log';
    protected $_pk = 'log_id';
    protected $_cols = 'log_id,uid,from,tenders_id,number,log,admin,clientip,dateline';
    protected $_orderby = array('log_id'=>'DESC');
    
    public function create($data){
        if(!$data = $this->_check_schema($data)){
            return false;
        }
        $data['clientip'] = $data['clientip'] ? $data['clientip'] : __IP;
        $data['dateline'] = $data['dateline'] ? $data['dateline'] : __CFG::TIME;
        return $this->db->insert($this->_table, $data, true);
    }
    //积分添加
     public function create1($data1){
        $number=$data1['number'];
        $uid=$data1['uid'];
        $tenders_id=$data1['tenders_id'];
        $admin=$data1['admin'];
        $data1=array('number'=>$number,'uid'=>$uid,'tenders_id'=>$tenders_id,'log'=>'用户签单获得','from'=>'1','admin'=>$admin);
        // if(!$data1 = $this->_check_schema($data1)){
        //     return false;
        // }
        $data1['clientip'] = $data1['clientip'] ? $data1['clientip'] : __IP;
        $data1['dateline'] = $data1['dateline'] ? $data1['dateline'] : __CFG::TIME;
        return $this->db->insert($this->_table, $data1, true);
    }
    //积分日志显示
    public function items($filter1)
    {
       $where = $this->where($filter1);
        $orderby = $this->order($orderby);
        //$limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where $orderby";
        if($rs = $this->db->query($sql)){
            // $row = $rs->fetch();
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
            }
        }
        return $items;
    }

    public function log($uid,$tenders_id, $from='1', $num=0, $log='')
    {
        $a = array();
        if(!$uid = (int)$uid){
            return false;
        }
        $a = array('uid'=>$uid,'tenders_id'=>$tenders_id,'from'=>$from, 'number'=>$num, 'log'=>$log);
        if(defined('IN_ADMIN')){
            $admin = K::$system->admin->admin;
            $a['admin'] = "{$admin['admin_id']}:{$admin['admin_name']}";
        }
        $a['clientip'] = __IP;
        $a['dateline'] = __CFG::TIME;
        return $this->db->insert($this->_table, $a, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

}
