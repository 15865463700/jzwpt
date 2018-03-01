<?php

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Company_Yhphoto extends Ctl
{
    
    public function upload()
    {
        if(!$youhui_id = (int)$this->GP('youhui_id')){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('company/youhui')->detail($youhui_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }else if(!$this->check_city($case['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('company/yhphoto')->upload($youhui_id, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
				K::M('case/photo')->phone_count($case['youhui_id']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    

    public function delete($photo_id=null)
    {
		if($photo_id = (int)$photo_id){
            if($photo = K::M('company/yhphoto')->detail($photo_id)){
				if(!$detail = K::M('company/youhui')->detail($photo['youhui_id'])){
					 $this->err->add('该优惠不存在或已经删除', 403);
				}else if(!$this->check_city($detail['city_id'])){
					 $this->err->add('不可越权操作', 403);
				}else if(K::M('company/yhphoto')->delete($photo_id)){
					K::M('company/yhphoto')->phone_count($detail['youhui_id']);
                    $this->err->add('删除成功');
                }
            }
        }else if($ids = $this->GP('photo_id')){
           if($items = K::M('case/photo')->items_by_ids($ids)){
                $aids  =  array();
                foreach($items as $k => $v){
                    if($youhui_id = $v['youhui_id']){
                        break;
                    }
                }
                if(!$detail = K::M('company/youhui')->detail($youhui_id)){
                    $this->err->add('该案例不存在或已经删除', 403);
                }else if(!$this->check_city($detail['city_id'])){
                     $this->err->add('不可越权操作', 403);
                }else{
                    foreach($items as $val){
                        if($val['youhui_id'] == $youhui_id){
                            $aids[$val['photo_id']] = $val['photo_id'];
							$youhui_ids[$v['youhui_id']] = $v['youhui_id'];
                        }
                    }
                    if($aids && K::M('case/photo')->delete($aids)){
						K::M('case/photo')->phone_count($youhui_ids);
                        $this->err->add('批量删除成功');
                    }
                }                
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

    public function update($youhui_id)
    {
        if($this->checksubmit('data')){
            if($data = $this->GP('data')){
				$detail = K::M('company/youhui')->detail($youhui_id);
                $obj = K::M('case/photo');
                foreach($data as $k=>$v){
                    $obj->update($k, array('title'=>$v['title'],'city_id' =>$detail['city_id'] , 'orderby'=>(int)$v['orderby']));
                }
            }
            $this->err->add('更新数据成功');
        }

		
    }

}