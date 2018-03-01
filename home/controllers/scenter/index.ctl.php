<?php

if (!defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Scenter_Index extends Ctl_Scenter {

    protected $_allow_fields = 'mail,gender,from,mobile,Y,M,D,city_id,realname';

    public function index() {
        $this->pagedata['order_count'] = K::M('trade/order')->count_by_uid($this->uid);
        $this->pagedata['yuyue_company_count'] = K::M('company/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['yuyue_designer_count'] = K::M('designer/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['yuyue_shop_count'] = K::M('shop/yuyue')->count(array(
            'uid' => $this->uid
        ));
        $this->pagedata['tenders_count'] = K::M('tenders/tenders')->count(array(
            'uid' => $this->uid
        ));

        $items2['order_count'] = K::M('trade/order')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_company_count'] = K::M('company/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_designer_count'] = K::M('designer/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['yuyue_shop_count'] = K::M('shop/yuyue')->items(array(
            'uid' => $this->uid
        ));
        $items['tenders_count'] = K::M('tenders/tenders')->items(array(
            'uid' => $this->uid
        ));
        $this->pagedata['data'] = $this->get_data($items);
        $this->pagedata['data2'] = $this->get_data2($items2);
        $this->tmpl = 'scenter/member/index.html';
    }

    // ��������ȡ����
    private function get_data($data, $day = 7) {
        $result = array();
        for ($i = 0; $i < $day; $i ++) {
            $t = date('Ymd', time() - $i * 24 * 3600);
            $t1 = date('Y-m-d', time() - $i * 24 * 3600);
            $result[$t1] = $this->order_data($data, $t);
        }
        $result = array_reverse($result);
        return $result;
    }

    // ���ݱȶ�
    private function order_data($data, $date = null) {
        if (!$date) {
            $date = date('Ymd', time());
        }
        $result = array(
            'company' => 0,
            'designer' => 0,
            'mechanic' => 0,
            'shop' => 0,
            'tenders' => 0
        );
        $uv = array();
        foreach ($data as $k => $v) {
            foreach ($v as $kk => $vv) {
                $t = date('Ymd', $vv['dateline']);
                if ($t == $date) {

                    if ($k == 'yuyue_company_count') {
                        $result['company'] ++;
                    } elseif ($k == 'yuyue_designer_count') {
                        $result['designer'] ++;
                    } elseif ($k == 'yuyue_mechanic_count') {
                        $result['mechanic'] ++;
                    } elseif ($k == 'yuyue_shop_count') {
                        $result['shop'] ++;
                    } elseif ($k == 'tenders_count') {
                        $result['tenders'] ++;
                    }
                }
            }
        }
        unset($data);
        return $result;
    }

    // ��������ȡ����
    private function get_data2($data, $day = 7) {
        $result = array();
        for ($i = 0; $i < $day; $i ++) {
            $t = date('Ymd', time() - $i * 24 * 3600);
            $t1 = date('Y-m-d', time() - $i * 24 * 3600);
            $result[$t1] = $this->order_data2($data, $t);
        }
        $result = array_reverse($result);
        return $result;
    }

    // ���ݱȶ�
    private function order_data2($data, $date = null) {
        if (!$date) {
            $date = date('Ymd', time());
        }
        $result = array(
            'new' => 0,
            'unship' => 0,
            'unpay' => 0
        );
        $uv = array();
        foreach ($data['order_count'] as $k => $v) {
            $t = date('Ymd', $v['dateline']);
            if ($t == $date) {

                if ($v['order_status'] == 1) {
                    $result['unship'] ++;
                } else
                if ($v['order_status'] == 0) {
                    $result['new'] ++;
                } else {
                    $result['unpay'] ++;
                }
            }
        }
        unset($data);
        return $result;
    }

    public function tip() {
        $args = $_REQUEST["args"];
        $wdjb_count = $yzts_count = 0;
        $company = $this->ucenter_company();
        if ($company) {
            $wdjb_count = K::M('tenders/look')->count("company_id='{$company['company_id']}' and see=0 and is_signed=0");
//            $yzts_count = 0;
//            if (!empty($_REQUEST['zxb_id']) && $_REQUEST['zxb_id'] > 0) {
//                $yzts_count = K::M('zxb/plaint')->count("company_id='{$company['company_id']}' and see=0 and time=0 and type=1 and zxb_id={$_REQUEST['zxb_id']}");
//            }
        }
        $this->err->set_data('wdjb',array("count" => $wdjb_count,));
        $this->err->json();
    }

}
