<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: company.ctl.php 3419 2014-02-21 09:42:53Z youyi $
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Rzps_Rzps extends Ctl
{

    public function index($page=1)
    {
       $filter = $pager = array();
       $pager['page'] = max(intval($page), 1);
       $pager['limit'] = $limit = 10;
       if($items = K::M('rzps/rzps')->items($filter, null, $page, $limit, $count)){
           $pager['count'] = $count;
           $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
         }
         $this->pagedata['items'] = $items;
         $this->pagedata['pager'] = $pager;
                $this->tmpl = 'admin:/rzps/rzps/items.html';
    }


    public function audit()
    {

        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;

        $uids = array();
        $filter['closed'] = 0;
        $filter['audit'] = 0;
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if ($items = K::M('rzpscompany/company')->items($filter, null, $page, $limit, $count)) {
            foreach($items as $k=>$v){
                $uids[] = $v['uid'];
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO' => $SO));
        }
        $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
       $this->tmpl = 'admin:/rzps/rzps/audit.html';
     }



    // public function so($target=null, $multi=null)
    // {
    //     if($target){
    //         $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
    //         $pager['target'] = $target;
    //     }
    //     $this->pagedata['pager'] = $pager;
    //     $this->tmpl = 'admin:company/company/so.html';
    // }

    // public function dialog($page=1)
    // {
    //     $filter = $pager = array();
    //     $pager['page'] = max(intval($page), 1);
    //     $pager['limit'] = $limit = 10;
    //     $pager['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
    //     if($SO = $this->GP('SO')){
    //         $pager['SO'] = $SO;
    //         if ($SO['company_id']) {$filter['company_id'] = $SO['company_id'];}
    //         if ($SO['uid']) {$filter['uid'] = $SO['uid'];}
    //         if ($SO['area_id']) {$filter['area_id'] = $SO['area_id'];}
    //         if(!isset($filter['area_id'])){
    //             if ($SO['city_id']) {$filter['city_id'] = $SO['city_id'];}
    //         }
    //         if ($SO['name']) {$filter['name'] = "LIKE:%" . $SO['name'] . "%";}
    //         if ($SO['tel']) {$filter['tel'] = "LIKE:%" . $SO['tel'] . "%";}
    //         if (is_numeric($SO['audit'])) {$filter['audit'] = $SO['audit'];}
    //     }
    //     $filter['closed'] = 0;
    //     if(CITY_ID){
    //         $filter['city_id'] = CITY_ID;
    //     }
    //     if($items = K::M('company/company')->items($filter, null, $page, $limit, $count)){
    //         $pager['count'] = $count;
    //         $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO, 'multi'=>$multi));
    //         $uids = array();
    //         foreach($items as $k=>$v){
    //             $uids[$v['uid']] = $v['uid'];
    //         }
    //         $this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
    //     }
    //     $this->pagedata['items'] = $items;
    //     $this->pagedata['pager'] = $pager;
    //     $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
    //     $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
    //     $this->tmpl = 'admin:company/company/dialog.html';
    // }
 public function create()
    {

        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                if($_FILES['data']){
                    foreach($_FILES['data'] as $k=>$v){
                        foreach($v as $kk=>$vv){
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $upload = K::M('magic/upload');
                    foreach($attachs as $k=>$attach){
                        if($attach['error'] == UPLOAD_ERR_OK){
                            if($a = $upload->upload($attach, 'home')){
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
                $company_id=K::M('rzps/rzps')->create($data);
                
                if($company_id){
                    $this->err->add('添加内容成功！');
                    $this->err->set_data('forward', '?rzps/rzps-index.html');
                }else{
                    $this->err->add('添加内容失败！');
                }
            } 
        }else{
            // $list = K::M('designer/designer')->items($filter, null, $page, $limit, $count);
            // $designer_list=array();
            // foreach($list as $k=>$v){
            //     $designer_list[$v["uid"]]=array(
            //         "uid"=>$v["uid"],
            //         "uname"=>$v["uname"],
            //     );
            // }
            // unset($list);
            // $this->pagedata['designer_list'] = $designer_list;

           $this->tmpl = 'admin:rzps/rzps/create.html';
        }
    }
    public function edit($company_id = null)
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                $detail = K::M('rzps/rzps')->detail($data["company_id"]);
                $data["rz_name"]=$detail["rz_name"];

                if($_FILES['data']){
                    foreach($_FILES['data'] as $k=>$v){
                        foreach($v as $kk=>$vv){
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $upload = K::M('magic/upload');
                    foreach($attachs as $k=>$attach){
                        if($attach['error'] == UPLOAD_ERR_OK){
                            if($a = $upload->upload($attach, 'home')){
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }
                // $company_id=K::M('rzps/rzps')->edit($data);
                // if($attr=  $this->GP('attr')){
                //     K::M('rzps/attr')->update($company_id,$attr);
                // }
                if($company_id){
                    $this->err->add('修改内容成功！');
                    $this->err->set_data('forward', '?rzps/rzps-index.html');
                }else{
                    $this->err->add('修改内容失败！');
                }
            } 
        }else{
            $list = K::M('designer/designer')->items($filter, null, $page, $limit, $count);
            $designer_list=array();
            foreach($list as $k=>$v){
                $designer_list[$v["uid"]]=array(
                    "uid"=>$v["uid"],
                    "uname"=>$v["uname"],
                );
            }
            unset($list);
            $this->pagedata['designer_list'] = $designer_list;

           $this->tmpl = 'admin:rzps/rzps/edit.html';
        }
    }
        
    
  
    
    public function auditup($company_id = null)
    {
        if ($company_id = (int) $company_id) {
            if (K::M('rzpscompany/company')->update($company_id,array('audit'=>1))) {
                $this->err->add('审核成功');
            }
        } else if ($ids = $this->GP('company_id')) {
            if (K::M('rzpscompany/company')->batch($ids,array('audit'=>1))) {
                $this->err->add('审核成功');
            }
        } else {
            $this->err->add('未指定要审核的ID', 401);
        }
    }
    
    public function vip($company_id = null){
         if ($company_id = (int) $company_id) {
             if($detail = K::M('rzpscompany/company')->detail($company_id)){
                $data['is_vip'] = empty($detail['is_vip']) ? 1 : 0;
                if (K::M('rzpscompany/company')->update($company_id,$data)) {
                    $this->err->add('设置成功');
                }else{
                     $this->err->add('设置失败');
                }
             }else{
                  $this->err->add('未指定要设为旗舰的ID', 401);
             }
         }else{
              $this->err->add('未指定要设为旗舰的ID', 401);
         }  
    }


    public function delete($company_id = null)
    { 
        if($company_id = (int)$company_id){
            if($company = K::M('rzpscompany/company')->detail($company_id)){
                if(!$this->check_city($company['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('company/company')->delete($company_id)){
                    $this->err->add('删除软装配饰公司成功');
                }
            }
        }else if($ids = $this->GP('company_id')){
            if($items = K::M('rzpscompany/company')->items_by_ids($ids)){
                $aids  = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['company_id']] = $v['company_id'];
                }
                if($aids && K::M('rzpscompany/company')->delete($aids)){
                    $this->err->add('批量删除软装配饰公司成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }
}