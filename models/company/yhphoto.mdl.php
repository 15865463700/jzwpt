<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: photo.mdl.php 6194 2014-08-30 11:15:54Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Company_Yhphoto extends Mdl_Table
{   
  
    protected $_table = 'company_youhui_photo';
    protected $_pk = 'photo_id';
    protected $_cols = 'photo_id,city_id,youhui_id,title,photo,size,views,orderby,closed,clientip,dateline';
    protected $_orderby = array('orderby'=>'ASC', 'photo_id'=>'DESC');

    protected $_hot_orderby = array('likes'=>'DESC', 'views'=>'ASC');
    protected $_hot_filter = array('closed'=>'0');
    protected $_new_orderby = array('photo_id'=>'DESC');
    protected $_new_filter = array('closed'=>'0');

    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($photo_id, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check($data,  $photo_id)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $photo_id));
    }

    public function upload($youhui_id, $attach)
    {
        if(!UPLOAD_ERR_OK == $attach['error']){
            $this->err->add('上传文件失败',201);
            return false;
        }
        $cfg = K::$system->config->get('attach');
        $B = 'photo/'.date('Ym/',__CFG::TIME);
        $D = $cfg['attachdir'].$B;
        if(!$F = K::M('helper/upload')->upload($attach, $D, $fname)){
            return false;
        }
        $oImg = K::M('image/gd');
        $thumbs = $size = array();
        $size['photo'] = $cfg['casephoto']['photo'] ? $cfg['casephoto']['photo'] : '720';
        $size['thumb'] = $cfg['casephoto']['thumb'] ? $cfg['casephoto']['thumb'] : '200';
        $size['small'] = $cfg['casephoto']['small'] ? $cfg['casephoto']['small'] : '60X60';
        $thumbs = array($size['photo']=>"{$D}/{$fname}",$size['thumb']=>"{$D}/{$fname}_thumb.jpg", $size['small']=>"{$D}/{$fname}_small.jpg");
        $oImg->thumbs($F, $thumbs);
        if($cfg['casephoto']['watermark']){
            $uname = $attach['uname'] ? $attach['uname'] : 'IJH';
            $oImg->watermark("{$D}/{$fname}", $uname);
        }
        $data = array();
        $data['youhui_id'] = (int)$youhui_id;
        if(!$data['title'] = $attach['title']){
            $data['title'] = preg_replace("/\.(jpg|jpeg|png|gif|bmp)$/i", '', $attach['name']);
        }
        $data['title'] = K::M('content/html')->encode($data['title']);
        $data['photo'] = $B.$fname;   
        $data['size'] = $attach['size'];
        $data['clientip'] = __IP;
        $data['dateline'] = __CFG::TIME;
        if($photo_id =$this->db->insert($this->_table, $data, true)){
            $data['photo_id'] = $photo_id;
            K::M('company/youhui')->update_last($youhui_id, $attach['size'], 1);
            return $data;
        }
        var_dump($this->_table);
        var_dump($data);

        var_dump($photo_id);
        return false; 
    }

    public function items_by_youhui($youhui_id, $p=1, $l=50, &$count=0)
    {
        if(!$youhui_id = (int)$youhui_id){
            return false;
        }
        $items=$this->items(array('youhui_id'=>$youhui_id,), $this->_orderby, $p, $l, $count);
        return $items;
    }

    public function count_by_youhui($youhui_id)
    {
        if(!$youhui_id = (int)$album_id){
            return false;
        }
        $sql = "SELECT youhui_id, COUNT(1) photos, SUM(`size`) size FROM ".$this->table($this->_table)." WHERE youhui_id='$youhui_id' AND closed=0";
        return $this->db->GetRow($sql);
    }

    public function delete($photo_ids, $force=false)
    {
        $sql = "DELETE FROM ".$this->table($this->_table)." WHERE " . self::field($this->_pk, $photo_ids);
        $ret = $this->db->Execute($sql);
        return $ret;      
    }

	
	function phone_count($val){
	   $count = 0;
	   $sql = "SELECT youhui_id, COUNT(1) c FROM ".$this->table($this->_table)." WHERE ". self::field('youhui_id', $val)." and closed = 0 GROUP BY youhui_id";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                K::M('company/youhui')->update($row['youhui_id'], array('phones'=>$row['c']), true);
                $count ++;
            }
        }
        return $count;
	}

    public function _check($data, $photo_id=null)
    {
        unset($data['photo_id'], $data['closed'], $data['clientip'], $data['dateline']);
        $ohtml = K::M('content/html');
        if(isset($data['photo'])){
            $data['photo'] = $ohtml->encode($data['photo']);
        }
        if(isset($data['title'])){
            $data['title'] = $ohtml->text($data['title']);
        }
        if(isset($data['youhui_id'])){
            $data['youhui_id'] = (int)$data['youhui_id'];
        }
        if(isset($data['size'])){
            $data['size'] = (int)$data['size'];
        }
        return parent::_check($data);        
    }

    public function detail($photo_id)
    {
        if(!$photo_id = (int)$photo_id){
            return false;
        }
        $where = "photo_id='{$photo_id}'";
        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where";
        if($row = $this->db->GetRow($sql)){
            $row = $this->_format_row($row);
        }
        return $row;
    }

}