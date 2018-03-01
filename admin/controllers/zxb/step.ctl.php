<?php

/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Zxb_Step extends Ctl {

    public function index($zxb_id = null) {
        if (!($zxb_id = (int) $zxb_id) && !($zxb_id = $this->GP('zxb_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('zxb/zxb')->detail($zxb_id)) {
            $this->err->add('您要要查看的内容不存在或已经删除', 212);
        } else {
            $filter['zxb_id'] = $zxb_id;
            $hetong = K::M('zxb/hetong')->items($filter);
            foreach ($hetong as $k => $v) {
                $item = $v;
            }
            $this->pagedata['hetong'] = $item;
            $tenders = K::M('tenders/tenders')->items($filter);
            foreach ($tenders as $k => $v) {
                $tenders_id = $v['tenders_id'];
            }
            $tenders_look = K::M('tenders/look')->items(array('tenders_id' => $tenders_id, 'is_signed' => '1'));

            foreach ($tenders_look as $k => $v) {
                $this->pagedata['tenders_look'] = $v;
            }
            $step = K::M('zxb/step')->items($filter);
            foreach ($step as $k => $v) {

                $steps[$v['step']] = $v;
                if ($v['step'] > 3 && $v['step'] < 7) {
                    if ($photo_lists = K::M('zxb/photo')->items(array('zxb_id' => $detail['zxb_id'], 'company_id' => $detail['company_id'], 'step' => $v['step']))) {
                        $steps[$v['step']]['photo'] = $photo_lists;
                    }
                }
            }
            if($steps[7]['yezhu_status']){
                $steps[7]['yezhu_message']="已确认";
                switch($steps[7]['back']){
                    case 7:
                        $steps[7]['yezhu_message']="一周后返款".date("Y年m月d日",$steps[7]['dealline']).")";
                        break;
                    case 30:
                        $steps[7]['yezhu_message']="一个月后返款(返款时间".date("Y年m月d日",$steps[7]['dealline']).")";
                        break;
                }
            }
            $zxb = K::M('zxb/zxb')->items($filter);
            $this->pagedata['step'] = $steps;
            $this->pagedata['status'] = $zxb['status'];
            $this->pagedata['company'] = K::M('company/company')->detail($detail['company_id']);
            $this->pagedata['member'] = K::M('member/member')->detail($detail['uid']);
            $this->pagedata['cityList'] = K::M("data/city")->fetch_all();
            $this->pagedata['detail'] = $detail;
            $this->pagedata['items'] = $items;
            $this->tmpl = 'admin:zxb/step/items.html';
        }
    }

    public function edit($step_id = null) {
        //echo $step_id;die;
        if (!($step_id = (int) $step_id) && !($step_id = $this->GP('step_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('zxb/step')->detail($step_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if (!$items = K::M('zxb/zxb')->detail($detail['zxb_id'])) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if ($data = $this->checksubmit('data')) {
            // //积分  start
            // echo 1;
                    $htqr=$this->GP('htqr');
                    if($htqr['jftj']=="yes"){
                        //金钱转换为积分      可以入库
                        //接值
                        $data1['number']=$_POST['number'];  //合同总价->积分
                        $data1['uid']=$_POST['uid'];         // 公司下的用户id
                        $data1['tenders_id']=$_POST['tenders_id'];   //招标id
                        $l=$data1['uid'];
                        $member=K::M('member/member')->member($l);
                        if($member){
                        $a=$member['jifen'];
                        $b=$data1['number'];
                        $jifen=$a+$b;
                        K::M('zxb/zxb')->update($htqr['zxb_id'], array('status'=>3));
                        K::M('zxb/step')->update($step_id, array('content'=>$data['content'],'status'=>1));
                        K::M('member/member')->update1($pk=$l,$data=$jifen);   //执行修改语句  member表
                        //把数据加入到 fenxiao_log
                        $adminojt=$this->admin;
                        $admin_id=$adminojt->admin_id;
                        $admin_name=$adminojt->admin_name;
                        $data1['admin']=$admin_id.':'.$admin_name;
                        K::M('fenxiao/log')->create1($data1);    //执行添加语句   fenxiao_log表
                        }else{
                            $this->err->add('操作失败12');
                            
                        }
                       
                   }
                    //积分 end

            if ($detail['step'] >= 3 && $detail['step'] <= 7) {
                if ($detail['yezhu_status'] != 1) {
                    $this->err->add('公司和业主未审核通过 请等待审核', 216);
                } else { 
                 if ($_FILES['data']) {
                        foreach ($_FILES['data'] as $k => $v) {
                            foreach ($v as $kk => $vv) {
                                $attachs[$kk][$k] = $vv;
                            }
                        }
                        $upload = K::M('magic/upload');
                        foreach ($attachs as $k => $attach) {
                            if ($attach['error'] == UPLOAD_ERR_OK) {
                                if ($a = $upload->upload($attach, 'step')) {
                                    $data[$k] = $a['photo'];
                                }
                            }
                        }
                    }
                
                    $data['time'] = __TIME;
                    if ($detail['step'] == '7') {
                        $data['company_status'] = 1;
                    }
					if($data['dealline']>0&&(int)$data['dealline']>time()){
						$this->err->add("返款操作失败，还未到业主同意返款时间(返款时间：".date("Y-m-d H:i",$data['dealline']).")");
					}else{
						if (K::M('zxb/step')->update($step_id, $data)) {
							if ($items['status'] < $detail['step']) {
								if ($detail['step'] == '7') {
									K::M('zxb/zxb')->update($detail['zxb_id'], array('status' => '8','back'=>$data['back'],'back_status'=>$data['back_status'],'dealline'=>$data['dealline']));
								} else {
									K::M('zxb/zxb')->update($detail['zxb_id'], array('status' => $detail['step'],'back'=>$data['back'],'back_status'=>$data['back_status'],'dealline'=>$data['dealline']));
								}
							}
							if ($detail['step'] == '3') {
								$hetong = K::M('zxb/hetong')->items(array('zxb_id' => $detail['zxb_id']));
								foreach ($hetong as $k => $v) {
									$hetong_id = $v['hetong_id'];
								}
								K::M('zxb/hetong')->update($hetong_id, array('status' => '1'));
							}
							$this->err->add('修改内容成功');
						}
					}
                }
            } else {
                $this->err->add('您要修改的内容状态不正确', 215);
            }
        } else {
            $this->pagedata['status'] = K::M('zxb/zxb')->get_status();
            $this->pagedata['detail'] = $detail;
            $this->pagedata['items'] = $items;
            $this->pagedata['company'] = K::M('company/company')->detail($detail['company_id']);
            $this->pagedata['member'] = K::M('member/member')->detail($detail['uid']);
            $this->tmpl = 'admin:zxb/step/edit.html';
        }
    }

}
