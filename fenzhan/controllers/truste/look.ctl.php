<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: look.ctl.php 5808 2014-07-05 07:00:20Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Truste_Look extends Ctl
{
    
    public function index($truste_id,$page=1)
    {
        if(empty($truste_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('truste/truste')->detail($truste_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        $companyIds = array();
        $filter['truste_id'] = $truste_id;
        if($items = K::M('truste/look')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
                $companyIds[$v['company_id']] = (int)$v['company_id'];
                $items[$k]['create_ip'] = $v['create_ip'].'('. K::M("misc/location")->location($v['create_ip']) .')';
                
            }
        }
        $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($companyIds);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['truste'] = $detail;
        $this->pagedata['truste_id'] = $truste_id;
        $this->tmpl = 'admin:truste/look/items.html';
    }

    
    public function update($look_id)
	{
        if(!$look_id = (int)$look_id){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$look = K::M('truste/look')->detail($look_id)){
            $this->err->add('竞标不存在或已经删除', 211);
        }else if(!$truste = K::M('truste/truste')->detail($look['truste_id'])){
            $this->err->add('招标不存或已经删除', 212);
        }else if($truste['sign_uid']){
            $this->err->add('已经有中标者，不可重复设置', 215);
        }else if(!$member = K::M('member/member')->detail($look['uid'])){
			$this->err->add('该投标用户不存在', 216);
		}else if(K::M('truste/look')->sign($look_id)){
			 switch ($member['from']) {
				case 'gz':
					K::M('gz/gz')->update_count($look['uid'], 'truste_sign'); break;
				case 'designer':
					K::M('designer/designer')->update_count($look['uid'], 'truste_sign'); break;
				case 'mechanic':
					K::M('mechanic/mechanic')->update_count($look['uid'], 'truste_sign'); break;
				case 'company':
					$company = K::M('company/company')->items(array('uid'=>$look['uid']));
					foreach($company as $k => $v){
						$this->company['company_id'] = $v['company_id'];
					}
					K::M('company/company')->update_count($this->company['company_id'], 'truste_sign'); 
				case 'shop':
					$shop = K::M('shop/shop')->items(array('uid'=>$look['uid']));
					foreach($shop as $k => $v){
						$this->company['shop_id'] = $v['shop_id'];
					}
					K::M('shop/shop')->update_count($this->shop['shop_id'], 'truste_sign'); break;
			}
			
			K::M('member/member')->update_count($truste['uid'],'jifen',$fenxiao_money['signtender']);
            $this->err->add('设置中标成功');
        } 
    }

    public function create($truste_id)
    {   
        if(empty($truste_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('truste/truste')->detail($truste_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else{
            if($this->checksubmit()){
                if(!$data = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
                }elseif(empty($data['tid'])){
                    $this->err->add('必须选择一个分标对象', 201);
                }else if($detail['looks'] >= $detail['max_look']){
                    $this->err->add('该招标已经结束了!', 212); 
                }else{
                    switch ($data['from']) {
                        case 'company':
                            $tmdl = K::M('company/company');break;
                        case 'designer':
                            $tmdl = K::M('designer/designer');break;
                        case 'gz':
                            $tmdl = K::M('gz/gz');break;
                        case 'mechanic':
                            $tmdl = K::M('mechanic/mechanic');break;
                        case 'shop':
                            $tmdl = K::M('shop/shop');break;
                    }
                    if(!$tmember = $tmdl->detail($data['tid'])){
                        $this->err->add('请选择正确的分标对象', 201);
                    }else if(!$member = K::M('member/member')->detail($tmember['uid'])){
                        $this->err->add('该用户不存在', 201)->response();
                    }else if($looked = K::M('truste/look')->items(array('uid'=>$member['uid'],'truste_id'=>$truste_id))){
                        $this->err->add('该用户已投过标', 201)->response();
                    }else{
                        $datas = K::M('truste/look')->getdata($member['uid']);
                        unset($data);
                        $datas['uid'] = $member['uid'];
                        $datas['truste_id'] = $truste_id; 
                        $datas['dateline'] = __TIME;
                        $datas['clientip'] = __IP;
                        $truste_look = true;
                        if($gold = $this->GP('gold')){
                            if($member['gold']<$detail['gold']){
                               $truste_look = false;
                               $this->err->add('该用户账户余额不足', 201)->response();
                            }
                            if(!K::M('member/gold')->update($member['uid'], -$detail['gold'], "看标：".$detail['title'])){
                                $truste_look = false;
                                $this->err->add('扣费失败', 201)->response();
                            }
                        }                        
                        if($truste_look == true && $look_id = K::M('truste/look')->create($datas)){                            
                            K::M('truste/truste')->update_count($truste_id,'looks');
                            switch ($member['from']) {
                                case 'gz':
                                    K::M('gz/gz')->update_count($member['uid'], 'truste_num'); break;
                                case 'designer':
                                    K::M('designer/designer')->update_count($member['uid'], 'truste_num'); break;
                                case 'mechanic':
                                    K::M('mechanic/mechanic')->update_count($member['uid'], 'truste_num'); break;
                                case 'company':
                                    $company = K::M('company/company')->update_count($company['company_id'], 'truste_num'); break;
                                case 'shop':
                                    $shop = K::M('shop/shop')->items(array('uid'=>$member['uid']));
                                    foreach($shop as $k => $v){
                                        $this->company['shop_id'] = $v['shop_id'];
                                    }
                                    K::M('shop/shop')->update_count($this->shop['shop_id'], 'truste_num'); break;
                            }
                            $smsdata = $maildata = array('contact'=>$detail['contact'] ? $detail['contact'] : '业主','mobile'=>$detail['mobile']);
                            K::M('sms/sms')->send($member['mobile'], 'admin_truste_look', $smsdata);
                            K::M('helper/mail')->send($member['mail'], 'admin_truste_look', $maildata);
                            $this->err->set_data('forward', '?truste/truste-detail-'.$truste_id.'.html');
                            $this->err->add('分标成功');
                        }
                        
                    }
					
                } 
            }else{
                $this->pagedata['from_list'] = K::M('member/member')->from_list();
                $this->pagedata['truste_id'] = $truste_id;
                $this->tmpl = 'admin:truste/look/create.html';
            }
        }
    }

}