<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: photo.ctl.php 2034 2013-12-07 03:08:33Z $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Diary_Photo extends Ctl
{
    
    public function upload()
    {
        if(!$diary_id = (int)$this->GP('diary_id')){
            $this->err->add('非法的参数请求', 201);
        }else if(!$diary = K::M('diary/diary')->detail($diary_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }else if(!$this->check_city($diary['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('diary/photo')->upload($diary_id, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
				K::M('diary/photo')->phone_count($diary['diary_id']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    

    public function delete($photo_id=null)
    {
		if($photo_id = (int)$photo_id){
            if($photo = K::M('diary/photo')->detail($photo_id)){
				if(!$diary = K::M('diary/diary')->detail($photo['diary_id'])){
					 $this->err->add('该案例不存在或已经删除', 403);
				}else if(!$this->check_city($diary['city_id'])){
					 $this->err->add('不可越权操作', 403);
				}else if(K::M('diary/photo')->delete($photo_id)){
					K::M('diary/photo')->phone_count($diary['diary_id']);
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('photo_id')){
           if($items = K::M('diary/photo')->items_by_ids($ids)){
                $aids  =  array();
                foreach($items as $k => $v){
                    if($diary_id = $v['diary_id']){
                        break;
                    }
                }
                if(!$diary = K::M('diary/diary')->detail($diary_id)){
                    $this->err->add('该案例不存在或已经删除', 403);
                }else if(!$this->check_city($diary['city_id'])){
                     $this->err->add('不可越权操作', 403);
                }else{
                    foreach($items as $val){
                        if($val['diary_id'] == $diary_id){
                            $aids[$val['photo_id']] = $val['photo_id'];
							$diary_ids[$v['diary_id']] = $v['diary_id'];
                        }
                    }
                    if($aids && K::M('diary/photo')->delete($aids)){
						K::M('diary/photo')->phone_count($diary_ids);
                        $this->err->add('批量删除成功');
                    }
                }                
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

    public function update($diary_id)
    {
        if($this->checksubmit('data')){
            if($data = $this->GP('data')){
				$detail = K::M('diary/diary')->detail($diary_id);
                $obj = K::M('diary/photo');
                foreach($data as $k=>$v){
                    $obj->update($k, array('title'=>$v['title'],'city_id' =>$detail['city_id'] , 'orderby'=>(int)$v['orderby']));
                }
            }
            $this->err->add('更新数据成功');
        }

		
    }

}