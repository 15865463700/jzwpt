<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id: look.ctl.php 5808 2014-07-05 07:00:20Z youyi $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Tenders_Look extends Ctl
{
    
    public function index($tenders_id,$page=1)
    {
        if(empty($tenders_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('tenders/tenders')->detail($tenders_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        $companyIds = array();
        $filter['tenders_id'] = $tenders_id;
        if($items = K::M('tenders/look')->items($filter, null, $page, $limit, $count)){
            foreach($items as $k=>$v){
                $companyIds[$v['company_id']] = (int)$v['company_id'];
                $items[$k]['create_ip'] = $v['create_ip'].'('. K::M("misc/location")->location($v['create_ip']) .')';
                $items[$k]['tracking'] = K::M('tenders/track')->items(array('look_id'=>$v['look_id']), null, 1, 50, $count2);
                
            }
        }
        $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($companyIds);
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['tenders'] = $detail;
        $this->pagedata['tenders_id'] = $tenders_id;
        $this->tmpl = 'fenzhan:tenders/look/items.html';
    }

    
    public function update($look_id)
	{
        if(!$look_id = (int)$look_id){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$look = K::M('tenders/look')->detail($look_id)){
            $this->err->add('竞标不存在或已经删除', 211);
        }else if(!$tenders = K::M('tenders/tenders')->detail($look['tenders_id'])){
            $this->err->add('招标不存或已经删除', 212);
        }else if(empty($tenders['audit'])){
            $this->err->add('该招标还在审核中，不可操作', 214);
        }else if($tenders['sign_uid']){
            $this->err->add('已经有中标者，不可重复设置', 215);
        }else if(!$member = K::M('member/member')->detail($look['uid'])){
			$this->err->add('该投标用户不存在', 216);
		}else if(K::M('tenders/look')->sign($look_id)){
			 switch ($member['from']) {
				case 'gz':
					K::M('gz/gz')->update_count($look['uid'], 'tenders_sign'); break;
				case 'designer':
					K::M('designer/designer')->update_count($look['uid'], 'tenders_sign'); break;
				case 'mechanic':
					K::M('mechanic/mechanic')->update_count($look['uid'], 'tenders_sign'); break;
				case 'company':
					$company = K::M('company/company')->items(array('uid'=>$look['uid']));
					foreach($company as $k => $v){
						$this->company['company_id'] = $v['company_id'];
					}
					K::M('company/company')->update_count($this->company['company_id'], 'tenders_sign'); 
				case 'shop':
					$shop = K::M('shop/shop')->items(array('uid'=>$look['uid']));
					foreach($shop as $k => $v){
						$this->company['shop_id'] = $v['shop_id'];
					}
					K::M('shop/shop')->update_count($this->shop['shop_id'], 'tenders_sign'); break;
			}
			if($tenders['fenxiaoid'] > '0'){
				$fenxiao_money = $this->system->config->get('fenxiao');
				K::M('member/member')->update_count($tenders['fenxiaoid'],'jifen',$fenxiao_money['sign']);
				K::M('fenxiao/log')->log($tenders['fenxiaoid'],$tenders['tenders_id'], 1,$fenxiao_money['sign'], '分销签单获得');
			}
			K::M('member/member')->update_count($tenders['uid'],'jifen',$fenxiao_money['signtender']);
			K::M('fenxiao/log')->log($tenders['uid'],$tenders['tenders_id'], 1,$fenxiao_money['signtender'], '用户签单获得');
            if($zxb_id = (int)$tenders['zxb_id']){
                if(!$company = K::M('company/company')->company_by_uid($look['uid'])){
                    $this->err->add('只安防智能公司才能参加装修保', 216);
                }else{
                    K::M('zxb/zxb')->sign_company($zxb_id, $company['company_id']);
                }
            }
            $this->err->add('设置中标成功');
        } 
    }



    public function create($tenders_id)
    {   
        if(empty($tenders_id)){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('tenders/tenders')->detail($tenders_id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else{
            if($this->checksubmit()){
                if(!$data = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
                }elseif(empty($detail['audit'])){
                    $this->err->add('该招标还在审核中，不可操作', 214);
                }elseif(empty($data['tid'])){
                    $this->err->add('必须选择一个分标对象', 201);
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
                    }else if($looked = K::M('tenders/look')->items(array('uid'=>$member['uid'],'tenders_id'=>$tenders_id))){
                        $this->err->add('该用户已投过标', 201)->response();
                    }else{
                        $datas = K::M('tenders/look')->getdata($member['uid']);
                        unset($data);
                        $datas['uid'] = $member['uid'];
                        $datas['tenders_id'] = $tenders_id; 
                        $datas['dateline'] = __TIME;
                        $datas['clientip'] = __IP;
                        $tenders_look = true;
                        if($gold = $this->GP('gold')){
                            if($member['gold']<$detail['gold']){
                               $tenders_look = false;
                               $this->err->add('该用户账户余额不足', 201)->response();
                            }
                            if(!K::M('member/gold')->update($member['uid'], -$detail['gold'], "看标：".$detail['title'])){
                                $tenders_look = false;
                                $this->err->add('扣费失败', 201)->response();
                            }
                        }                        
                        if($tenders_look == true && $look_id = K::M('tenders/look')->create($datas)){                            
                            K::M('tenders/tenders')->update_count($tenders_id,'looks');
                            switch ($member['from']) {
                                case 'gz':
                                    K::M('gz/gz')->update_count($member['uid'], 'tenders_num'); break;
                                case 'designer':
                                    K::M('designer/designer')->update_count($member['uid'], 'tenders_num'); break;
                                case 'mechanic':
                                    K::M('mechanic/mechanic')->update_count($member['uid'], 'tenders_num'); break;
                                case 'company':
                                    K::M('company/company')->update_count($company['company_id'], 'tenders_num'); break;
                                case 'shop':
                                    $shop = K::M('shop/shop')->items(array('uid'=>$member['uid']));
                                    foreach($shop as $k => $v){
                                        $this->company['shop_id'] = $v['shop_id'];
                                    }
                                    K::M('shop/shop')->update_count($this->shop['shop_id'], 'tenders_num'); break;
                            }
                            $smsdata = $maildata = array('contact'=>$detail['contact'] ? $detail['contact'] : '业主','mobile'=>$detail['mobile']);
                            K::M('sms/sms')->send($member['mobile'], 'admin_tenders_look', $smsdata);
                            K::M('helper/mail')->send($member['mail'], 'admin_tenders_look', $maildata);
                            $this->err->set_data('forward', '?tenders/tenders-detail-'.$tenders_id.'.html');
                            $this->err->add('分标成功');
                        }
                        
                    }
                } 
            }else{
                $this->pagedata['from_list'] = K::M('member/member')->from_list();
                $this->pagedata['tenders_id'] = $tenders_id;
                $this->pagedata['tenders'] = $detail;
                $this->tmpl = 'admin:tenders/look/create.html';
            }
        }
    } 
    
    public function tongji()
    {
         $time = 86400*30;
         $bg_time = __TIME - $time ;
         $end_time = __TIME;
		 $city_id = CITY_ID;
         if($SO = $this->GP('SO')){
             $bg_time = (int)(strtotime($SO['bg_time']));
             $end_time = (int)(strtotime($SO['end_time']));
             $company_id = (int)($SO['company_id']);
             if($company_id) $this->pagedata['company'] = K::M('company/company')->detail($company_id);
         }else{
             $SO['bg_time'] = date('Y-m-d',$bg_time);
             $SO['end_time'] = date('Y-m-d',$end_time);
         }
		$company = K::M('company/company')->detail($company_id);
        $items = K::M('tenders/look')->tongji($company['uid'],$bg_time,$end_time,$city_id);
        $this->pagedata['items'] = $items;
        $this->pagedata['SO'] = $SO;
        $this->tmpl = 'fenzhan:tenders/look/tongji.html';
    }
    



}