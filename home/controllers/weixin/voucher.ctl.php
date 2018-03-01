<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Weixin_Voucher extends Ctl_Weixin
{

    public function index($wx_id)
    {
        if (! $wx_id) {
            $this->err->add('参数错误', 215);
        } elseif (! $weixin = K::M('weixin/weixin')->detail($wx_id)) {
            $this->err->add('该商家还未绑定公众号', 216);
        } else {
            $client = $this->wechat_client();
            $cardlist = $client->getcardlist($weixin);
            $res = json_decode($cardlist, true);
            $arr1 = $card = array();
            if ($res['errcode'] == 0 && $res['total_num'] > 0) {
                foreach ($res['card_id_list'] as $k => $v) {
                    $arr = array();
                    $arr = json_decode($client->getcarddetail($weixin, $v), true);
                    $arr1[] = $arr['card'];
                }
                
                foreach ($arr1 as $k => $v) {
                    
                    $card[$k] = $v[strtolower($v['card_type'])]['base_info'];
                    $card[$k]['card_type'] = $v['card_type'];
                    $card[$k]['iid'] = base64_encode($v[strtolower($v['card_type'])]['base_info']['id']);
                    
                    if ($card[$k]['date_info']['fixed_term'] > 0) {
                        $card[$k]['stime'] = '领取后' . $card[$k]['date_info']['fixed_term'] . '天有效';
                    } elseif ($card[$k]['date_info']['type'] == 'DATE_TYPE_PERMANENT') {
                        $card[$k]['stime'] = '永久有效';
                    } else {
                        $card[$k]['stime'] = $card[$k]['date_info']['begin_timestamp'];
                        $card[$k]['etime'] = $card[$k]['date_info']['end_timestamp'];
                    }
                }
                $time = time();
                
                Import::L('weixin/jssdk.php');
                $jsSdk = new WeixinJSSDK($weixin['appid'], $weixin['secret']);
                $this->pagedata['wxjscfg'] = $jsSdk->getSignPackage();
                foreach ($card as $k => $v) {
                    $card[$k]['wxjscfg'] = $jsSdk->getCardSignPackage($v['id']);
                }
                foreach ($card as $k => $v) {
                    if ($v['etime'] && $v['etime'] > $time) {
                        $card1[] = $v;
                    } else {
                        $card2[] = $v;
                    }
                }
                
                $this->pagedata['wx_id'] = $wx_id;
                $this->pagedata['card'] = $vc = array_merge_recursive($card1, $card2);
                $this->pagedata['time'] = $time;
                // if(empty($openid)){
                // $openid = $this->access_openid();
                // }
                $openid = 'oNk4bt2iSuRpxQNAejGPIFKriYmc';
                
                $arr = json_decode($client->getmycarddetail($weixin, $openid), true);
                foreach ($arr['card_list'] as $k => $v) {
                    $arr9[] = $v['card_id'];
                }
                foreach ($vc as $k => $v) {
                    if (in_array($v['id'], $arr9)) {
                        $card3[] = $v;
                    } else {
                        $card4[] = $v;
                    }
                }
                $this->pagedata['card3'] = $card3;
                $this->pagedata['card4'] = $card4;
                $this->tmpl = 'weixin/voucher/index.html';
            } else {
                $this->err->add('您没有卡劵,请先在微信中添加', 213);
            }
        }
    }
}