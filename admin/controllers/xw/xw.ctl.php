<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author @shzhrui<Anhuike@gmail.com>
 * $Id: case.ctl.php 6077 2014-08-13 13:48:56Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Xw_Xw extends Ctl
{

    public function index($page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['xw_id']){$filter['xw_id'] = $SO['xw_id'];}
            if($SO['home_id']){$filter['home_id'] = $SO['home_id'];}
            if($SO['company_id']){$filter['company_id'] = $SO['company_id'];}
            if(is_numeric($SO['audit'])){$filter['audit'] = $SO['audit'];}
            if($SO['title']){$filter['title'] = "LIKE:%".$SO['title']."%";}
            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1])+86400;$filter['dateline'] = $a."~".$b;}}
        }
        $filter['closed'] = 0 ;
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        $items = K::M('xw/xw')->items($filter, array('xw_id'=>'desc'), $page, $limit, $count);
        if($items){
            $pager['count'] = $count;
//            $home_ids = $company_ids = $designer_ids = array();
//            foreach($items as $k=>$v){
//                if($v['home_id']){
//                    $home_ids[$v['home_id']] = $v['home_id'];
//                }
////                if($v['company_id']){
////                    $company_ids[$v['company_id']] = $v['company_id'];
////                }
////                if($v['uid']){
////                    $uids[$v['uid']] = $v['uid'];
////                }
//            }

//            if(!empty($home_ids)){
//                $this->pagedata['home_list'] = K::M('home/home')->items_by_ids($home_ids);
//            }
//            if(!empty($company_ids)){
//                $this->pagedata['company_list'] = K::M('gybjcompany/company')->items_by_ids($company_ids);
//            }
//            if(!empty($uids)){
//                $this->pagedata['uid_list'] = K::M('member/member')->items_by_ids($uids);
//            }
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:xw/xw/items.html';
    }

    public function dialog($page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $pager['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['id']){$filter['id'] = $SO['id'];}
            if($SO['city_id']){$filter['city_id'] = $SO['city_id'];}
            if($SO['area_id']){$filter['area_id'] = $SO['area_id'];}
            if($SO['name']){$filter['name'] = "LIKE:%".$SO['name']."%";}
            if($SO['tel']){$filter['tel'] = "LIKE:%".$SO['tel']."%";}
            if($SO['kf']){$filter['kf'] = "LIKE:%".$SO['kf']."%";}
            if(is_array($SO['lng'])){$a = intval($SO['lng'][0]);$b=intval($SO['lng'][1]);if($a && $b){$filter['lng'] = $a."~".$b;}}
            if(is_array($SO['lat'])){$a = intval($SO['lat'][0]);$b=intval($SO['lat'][1]);if($a && $b){$filter['lat'] = $a."~".$b;}}
        }
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('xw/xw')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO, 'multi'=>$multi));
        }

        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
        $this->tmpl = 'admin:xw/xw/dialog.html';
    }

    public function audit($page=1)
    {
        $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 50;
        $filter = array('audit'=>0, 'closed'=>0);
        if(CITY_ID){
            $filter['city_id'] = CITY_ID;
        }
        if($items = K::M('xw/xw')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:xw/xw/audit.html';
    }

    public function update($from='audit', $xw_id=null)
    {
        $data = array();
        if($from == 'audit'){
            $data = array('audit'=>'1');
            $msg = '审核';
        }
        if($data){
            if($xw_id = (int)$xw_id){
                if(K::M('xw/xw')->update($xw_id,  $data)){
                    $this->err->add($msg.'成功');
                }
            }else if($ids = $this->GP('xw_id')){
                foreach((array)$ids as $id){
                    K::M('xw/xw')->update((int)$id,  $data);
                }
                $this->err->add("批量{$msg}成功");
            }else{
                $this->err->add("未指定要{$msg}的内容ID", 401);
            }
        }else{
            $this->err->add('未定义操作', 201);
        }
    }

    public function so()
    {
        $this->tmpl = 'admin:xw/xw/so.html';
    }

    public function detail($xw_id=null)
    {
        if(!$xw_id = (int)$xw_id){
            $this->err->add('非指定相册ID', 211);
        }else if(!$case = K::M('xw/xw')->detail($xw_id)){
            $this->err->add('相册不存在或已经删除', 212);
        }else if(!$this->check_city($case['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else{
            $pager = array('xw_id'=>$xw_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 50;
            $pager['count'] = $count = 0;
            $this->pagedata['detail'] = $detail;
            if($items = K::M('xw/photo')->items_by_case($xw_id, $page, $limit, $count)){
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("xw/xw:detail", array('{page}')));
            }
            $this->pagedata['pager'] = $pager;
            $this->pagedata['case'] = $case;
            $this->tmpl = 'admin:xw/xw/detail.html';
        }
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 211);
//            }else if(!$uid = (int)$data['uid']){
//                $this->err->add('未选择用户', 212);
//            }else if(!$member = K::M('member/member')->detail($uid)){
//                $this->err->add('您选的用户不存在或已经删除', 213);
//            }else if(!$this->check_city($member['city_id'])){
//                $this->err->add('不可越权操作', 403);
            }else{
//                $filter['uid'] = $member['uid'];
//                $user = K::M($member['from'].'/'.$member['from'])->items($filter);
//                foreach($user as $k => $v){
//                    $company_id = $v['company_id'];
//                    $city_id = $v['city_id'];
//                    $uid = $v['uid'];
//                }
//                if(!$data['home_name']){
//                    $home = K::M('home/home')->detail($data['home_id']);
//                    $data['home_name'] = $home['name'];
//                }
//                $data['company_id'] = $company_id;
                if(CITY_ID){
                    $data['city_id'] = CITY_ID;
                }else{
//                    $data['city_id'] = $city_id;
                }
                $data['lasttime'] = __TIME;
//                if($photo = K::M('home/photo')->detail($data['huxing_id'])){
//                    $data['huxing'] = $photo['photo'];
//                }
                $xw_id = K::M('xw/xw')->create($data);
                if($xw_id){
//                    if(!$attr = $this->GP('attr')){
//                        $attr = array();
//                    }
//                    K::M('xw/attr')->update($xw_id, $attr);
//                    K::M('xw/xw')->case_count($xw_id);
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('xw/xw:index'));
                }
            }
        }else{
            $this->tmpl = 'admin:xw/xw/create.html';
        }
    }

    public function edit($xw_id=null)
    {
        if(!($xw_id = (int)$xw_id) && !($xw_id = $this->GP('xw_id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('xw/xw')->detail($xw_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if(!$this->check_city($detail['city_id'])){
            $this->err->add('不可越权操作', 403);
        }else if($this->checksubmit('data')){

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
                }else{

                    if($photo = K::M('home/photo')->detail($data['huxing_id'])){
                        $data['huxing'] = $photo['photo'];
                    }
                }
                unset($data['xw_id']);
                if(K::M('xw/xw')->update($xw_id, $data)){
                    if(!$attr = $this->GP('attr')){
                        $attr = array();
                    }
                    /*
                    if($detail['company_id'] != $data['company_id']){
                        if($company_id = (int) $data['company_id']){
                            K::M('company/company')->update_count($company_id, 'case_num', 1);
                        }
                        if($company_id = (int)$detail['company_id']){
                            K::M('company/company')->update_count($company_id, 'case_num', -1);
                        }
                    }
                    */
                    K::M('xw/attr')->update($xw_id, $attr);
                    $this->err->add('修改内容成功');
                }
            }
        }else{
            if($attrs = K::M('xw/attr')->attrs_by_case($xw_id)){
                $this->pagedata['attrs'] = $attrs;
                $detail['attrvalues'] = array_keys($attrs);
            }

            if($home_id = (int)$detail['home_id']){
                $this->pagedata['home'] = K::M('home/home')->detail($home_id);
            }
            if($huxing_id = (int)$detail['huxing_id']){
                $this->pagedata['huxing'] = K::M('home/photo')->detail($huxing_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'admin:xw/xw/edit.html';
        }
    }

    public function doaudit($xw_id=null)
    {
        if($xw_id = (int)$xw_id){
            if(K::M('xw/xw')->batch($xw_id, array('audit'=>1))){
                $this->err->add('审核内容成功');
            }
        }else if($ids = $this->GP('xw_id')){
            if(K::M('xw/xw')->batch($ids, array('audit'=>1))){
                $this->err->add('批量审核内容成功');
            }
        }else{
            $this->err->add('未指定要审核的内容', 401);
        }
    }

    public function delete($xw_id=null)
    {
        if($xw_id = (int)$xw_id){
            if($case = K::M('xw/xw')->detail($xw_id)){
                if(!$this->check_city($case['city_id'])){
                    $this->err->add('不可越权操作', 403);
                }else if(K::M('xw/xw')->delete($xw_id)){
                    K::M('xw/xw')->down_count($case);
                    $this->err->add('删除新闻成功');
                }
            }
        }else if($ids = $this->GP('xw_id')){
            if($items = K::M('xw/xw')->items_by_ids($ids)){
                $aids = $company_ids = $homes_id = $uids = array();
                foreach($items as $v){
                    if(CITY_ID && CITY_ID != $v['city_id']){
                        continue;
                    }
                    $aids[$v['xw_id']] = $v['xw_id'];
                }
                if($aids && K::M('xw/xw')->delete($aids)){
                    K::M('xw/xw')->downs_count($items);
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}