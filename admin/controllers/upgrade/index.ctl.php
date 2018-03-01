<?php

if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Upgrade_Index extends Ctl {
    
    private function _domain(){
       $domain = $_SERVER['HTTP_HOST'];
       $count = substr_count($domain,'.');
       if($count > 2){
          $domain = substr($domain, strpos($domain, '.')+1,  strlen($domain));
       }
       return $domain;
    }


    public function index() {
       // echo $this->mklink('index/welcome','index');die;
        $v = JH_RELEASE;
        $sign = md5(uniqid());
        file_put_contents(__CORE_DIR . '../patch.php', '<?php echo "' . $sign . '";');
        $url = "http://www.ijh.cc/?patch-check.html&h=" . urlencode($this->_domain()) . "&v=" . urlencode($v) . '&k=' .__CFG::Authorize . '&pro=b1e4811c4373f0fe672b64742b061f32&sign=' . $sign;
        //echo $url;die;
        $data = file_get_contents($url);
        unlink(__CORE_DIR . '../patch.php');
        $data = json_decode($data, true);
        if ($data['ret'] != 1 && $data['ret'] != 8) {
             $this->err->add($data['msg'], 211);
             $this->err->set_data('forward', '?index-welcome.html');
                 $this->err->response();
        }else{
            if ($data['ret'] == 1) {
                $this->err->add($data['msg']);
                $this->err->set_data('forward', '?index-welcome.html');
                 $this->err->response();
            }else{
                
                $this->pagedata['data'] = $data;
                $this->tmpl = 'admin:upgrade/index/index.html';
            }
        }
    }
    
    public function download(){
        $dir = __CORE_DIR.'../patch';
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        if(!$patch_name = htmlspecialchars($_GET['patch_name'])){
            if(!$patch_id = (int)$_GET['patch_id']){
                //$this->error('请选择要下载的补丁');
                $this->err->add("请选择要下载的补丁", 211);
                $this->err->set_data('forward', '?index-welcome.html');
                 $this->err->response();
            }
            $v = JH_RELEASE;
            $sign = md5(uniqid());
            file_put_contents(__CORE_DIR.'../patch.php','<?php echo "'.$sign.'";');
            $url = "http://www.ijh.cc/?patch-download.html&patch_id=".$patch_id."&h=".urlencode($this->_domain())."&v=".urlencode($v).'&k='.__CFG::Authorize .'&pro=b1e4811c4373f0fe672b64742b061f32&sign='.$sign;
            $data = file_get_contents($url);
            unlink(__CORE_DIR.'../patch.php');         
            if(empty($data)){
                $this->err->add("网络超时，没有办法下载服务器补丁", 211);
                $this->err->set_data('forward', '?index-welcome.html');
                 $this->err->response();
            }           
            $patch_name = md5(uniqid());
            file_put_contents($dir.'/'.$patch_name.'.zip', $data);
            if(!class_exists('ZipArchive')){
                $this->err->add("您的服务器暂时不支持ZipArchive类文件", 211);
                $this->err->set_data('forward', '?index-welcome.html');
                 $this->err->response();
            }
            $zip = new ZipArchive();
            $res = $zip->open($dir.'/'.$patch_name.'.zip');
            if($res === TRUE){
                 $zip->extractTo($dir.'/'.$patch_name);
                 $zip->close();
            }
            unlink($dir.'/'.$patch_name.'.zip');
        }else{
            if(!is_dir($dir.'/'.$patch_name.'/upgrade')){
                $this->err->add("请重新再试", 211);
                $this->err->set_data('forward', '?index-welcome.html');
                 $this->err->response();
            }
        }
        
        $checks = $this->_checkdirs($dir.'/'.$patch_name.'/upgrade/',__CORE_DIR.'../');
        if(!empty($checks)){
           
            $this->pagedata['files'] = $checks;
            $this->pagedata['patch_name'] = $patch_name;
            $this->tmpl = 'admin:upgrade/index/download.html';
        }else{
            $this->_mv($dir.'/'.$patch_name.'/upgrade/',__CORE_DIR.'../');
         
            if(file_exists($dir.'/'.$patch_name.'/upgrade.sql')){
                $sql = file_get_contents($dir.'/'.$patch_name.'/upgrade.sql');
                if(!empty($sql)){
                    $sql = str_replace('bao_', $this->system->db->_tablepre, $sql);
                    $sqls = explode(";\n", $sql);
                    foreach($sqls  as $v){
                        $v = trim($v);
                        if(!empty($v)){
                            $this->system->db->Execute($v);
                        }
                    }
                }
                unlink($dir.'/'.$patch_name.'/upgrade.sql');
            }
            $this->_deldir($dir.'/'.$patch_name);
            $this->err->add("恭喜您升级完成");
            $this->err->set_data('forward', '?index-welcome.html');
            $this->err->response();
        }
    }
    
    private function  _deldir($dir) { 
        //先删除目录下的文件： 
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                if (!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    $this->_deldir($fullpath);
                }
            }
        }
        closedir($dh);
        //删除当前文件夹： 
        if (rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }

    private function _checkdirs($filepath,$showpath =''){
        $dh = opendir($filepath);
        $return = array();
        $local = '';
         while ($file = readdir($dh)) {

             if($file == '.' || $file == '..' )            continue;
             if(is_dir($filepath.$file)){
                 $local = $showpath.$file.'/';
                 $return = array_merge($return, $this->_checkdirs($filepath.$file.'/',$local));
             }else{
                 if(file_exists($showpath.$file)){
                    $a = fopen($showpath.$file, 'a+');
                    if($a == false){
                        $return []  = $showpath.$file;
                    }else{
                        fclose($a);
                    }
                 }else{
                    $a =  fopen($showpath.'helloword.txt', 'w+');
                    if($a == false){
                        $return []  = $showpath;
                    }else{
                        fclose($a);
                        unlink($showpath.'helloword.txt');
                    }
                 }
             }
         }
         closedir($dh);
         return $return;
     }

    
    private function _mv($filepath,$mvpatch){
        $dh = opendir($filepath);
         while ($file = readdir($dh)) {
             if($file == '.' || $file == '..' )            continue;
             if(is_dir($filepath.$file)){
                 if(!is_dir($mvpatch.$file)){
                     mkdir($mvpatch.$file,0755,true);
                 }
                 $this->_mv($filepath.$file.'/',$mvpatch.$file.'/');
             }else{
                 if(file_exists($mvpatch.$file)){
                    rename($mvpatch.$file,$mvpatch.NOW_TIME.$file);
                 }
                 rename($filepath.$file, $mvpatch.$file);
             }
         }
         closedir($dh);
         return true;
     }

}
