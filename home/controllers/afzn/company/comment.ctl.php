<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if (! defined('__CORE_DIR')) {
    exit("Access Denied");
}

// class Ctl_Afzn_Company_Comment extends Ctl_Afzn_Anfangzhineng
class Ctl_Afzn_Company_Comment extends Ctl
{

    public function __construct(&$system)
    {
        parent::__construct($system);
        $menu_list = include (dirname(__FILE__) . "/../ctlmaps.php");
        $this->pagedata['menu_list'] = $menu_list["company"];
        $this->pagedata['ctlgroup'] = "company";
    }

    public function company($page = 1)
    {
         $company = $this->ucenter_company();
         $pager = $filter = array();
         $pager['page'] = $page = max((int)$page, 1);
         $pager['limit'] = $limit = 20;
         $pager['count'] = $count = 0;
         $filter = array('company_id'=>$company['company_id'], 'closed'=>0);
         if($items = K::M('afzncompany/comment')->items($filter, null, $page, $limit, $count)){
         $pager['count'] = $count;
         $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
         $uids = array();
         foreach($items as $k=>$v){
         $uids[$v['uid']] = $v['uid'];
         }
         if($uids){
         $this->pagedata['member_list'] = K::M('member/view')->items_by_ids($uids);
         }
         $this->pagedata['items'] = $items;
         }
         $this->pagedata['pager'] = $pager;
         $this->system->config->get('company_comment');
        $this->tmpl = 'afzn/company/comment/items.html';
    }

    public function detail($comment_id = null)
    {
        $company = $this->ucenter_company();
        $audit_reply = K::M('system/audit')->company('reply', $company, $audit_title);
        if (! ($comment_id = (int) $comment_id) && ! ($comment_id = (int) $this->GP('comment_id'))) {
            $this->err->add('未指定要查看的评论', 211);
        } else 
            if (! $detail = K::M('afzncompany/comment')->detail($comment_id)) {
                $this->err->add('评论不存在或已经删除', 212);
            } else 
                if ($company['company_id'] != $detail['company_id']) {
                    $this->err->add('你没有权限查看该评论', 212);
                } else {
                    if ($uid = $detail['uid']) {
                        $this->pagedata['member'] = K::M('member/member')->member($uid);
                    }
                    $pager = array(
                        'audit_reply' => $audit_reply,
                        'audit_title' => $audit_title
                    );
                    $this->pagedata['pager'] = $pager;
                    $this->pagedata['detail'] = $detail;
                    $this->system->config->get('company_comment');
                    $this->tmpl = 'afzn/company/comment/detail.html';
                }
    }

    public function reply($comment_id = null)
    {
        $company = $this->ucenter_company();
        $audit_reply = K::M('system/audit')->company('reply', $company, $audit_title);
        if (! ($comment_id = (int) $comment_id) && ! ($comment_id = (int) $this->GP('comment_id'))) {
            $this->err->add('未定义操作', 211);
        } else 
            if (! $comment = K::M('afzncompany/comment')->detail($comment_id)) {
                $this->err->add('评论不存在或已经删除', 212);
            } else 
                if ($company['company_id'] != $comment['company_id']) {
                    $this->err->add('你没有权限回复该评论', 212);
                } else 
                    if ($comment['replytime'] && $comment['reply']) {
                        $this->err->add('您已经回复过该评论了', 212);
                    } else 
                        if ($this->checksubmit()) {
                            if (! $reply_content = $this->GP('reply_content')) {
                                $this->err->add('回复内容不能空', 213);
                            } else 
                                if ($audit_reply < 0) {
                                    $this->err->add('您是【' . $audit_title . '】没有权限回复点评', 333);
                                } else 
                                    if (K::M('afzncompany/comment')->reply($comment_id, $reply_content)) {
                                        $this->err->add('回复评论成功');
                                    }
                        } else {
                            if ($uid = $comment['uid']) {
                                $this->pagedata['member'] = K::M('member/member')->detail($uid);
                            }
                            $this->pagedata['comment'] = $comment;
                            $this->tmpl = 'afzn/company/comment/reply.html';
                        }
    }

    protected function ucenter_company()
    {
        $this->company = K::M('afzncompany/company')->company_by_uid($this->uid);
        if ($this->company) {
            $group = K::M('member/group')->group($this->company['group_id']);
            $this->company['group'] = $this->MEMBER['group'] = $group;
            $this->company['group_name'] = $group['group_name'];
            $this->pagedata['group'] = $group;
            $this->pagedata['company'] = $this->company;
            $this->ucenter_city_id = $this->company['city_id'];
            return $this->company;
        } else
            if ($this->request['ctl'] == 'afzn/company' && $this->request['act'] == 'info') {
                $this->pagedata['company_no_open'] = true;
                return false;
            } else {
                $this->pagedata['company_no_open'] = true;
                $this->tmpl = 'afzn/company/info.html';
            }
        $this->response();
    }

}