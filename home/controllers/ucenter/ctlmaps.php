<?php

return array(
    // /会员菜单
    'member' => array(
        array(
            'title' => '帐户管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '个人中心',
                    'ctl' => 'ucenter/index:index',
                    'nav' => 'ucenter/member:index'
                ),
                array(
                    'title' => '个人中心',
                    'ctl' => 'ucenter/member:index',
                    'menu' => true
                ),
                array(
                    'title' => '消息',
                    'ctl' => 'ucenter/index:tip',
                ),
                array(
                    'title' => '修改资料',
                    'ctl' => 'ucenter/member:info',
                    'menu' => true
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'ucenter/member:passwds',
                    'nav' => 'ucenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'ucenter/member:passwd1',
                    'nav' => 'ucenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'ucenter/member:passwd2',
                    'nav' => 'ucenter/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'ucenter/member:passwd',
                    'nav' => 'ucenter/member:info'
                ),
                array(
                    'title' => '更换邮箱',
                    'ctl' => 'ucenter/member:mail',
                    'nav' => 'ucenter/member:info'
                ),
                array(
                    'title' => '修改头像',
                    'ctl' => 'ucenter/member:face',
                    'nav' => 'ucenter/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'ucenter/member:upload',
                    'nav' => 'ucenter/member:info'
                ),
//                array(
//                    'title' => '实名认证',
//                    'ctl' => 'ucenter/member/verify:name',
//                    'menu' => true
//                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'ucenter/member/verify:mobile',
                    'nav' => 'ucenter/member/verify:name'
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'ucenter/member/verify:code',
                    'nav' => 'ucenter/member/verify:name'
                ),
                array(
                    'title' => 'EMAIL认证',
                    'ctl' => 'ucenter/member/verify:mail',
                    'nav' => 'ucenter/member/verify:name'
                ),
                array(
                    'title' => '帐号绑定',
                    'ctl' => 'ucenter/member:bindaccount',
//                    'menu' => true
                ),
                array(
                    'title' => '金币日志',
                    'ctl' => 'ucenter/member:logs',
//                    'menu' => true
                    'menu' => false
                ),
                array(
                    'title' => '我的金币',
                    'ctl' => 'ucenter/member:gold',
                    'nav' => 'ucenter/member:logs'
                ),
                array(
                    'title' => '积分日志',
                    'ctl' => 'ucenter/member:jflogs',
//                    'menu' => true
                    'menu' => false
                ),
                array(
                    'title' => '我的托管',
                    'ctl' => 'ucenter/member:truste',
                    'nav' => 'ucenter/member:trustelogs'
                ),
//                array(
//                    'title' => '分销链接',
//                    'ctl' => 'ucenter/member:fenxiao',
//                    'menu' => true
//                ),
//                array(
//                    'title' => '我的红包',
//                    'ctl' => 'ucenter/member/packet:items',
//                    'menu' => true
//                ),
//                array(
//                    'title' => '领取红包',
//                    'ctl' => 'ucenter/member/packet:create',
//                    'nav' => 'ucenter/packet:items'
//                )
            )
        ),
        array(
            'title' => '内容管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '我的装修',
                    'ctl' => 'ucenter/member/mypm:index',
                    'menu' => true
                ),
                array(
                    'title' => '我的装修',
                    'ctl' => 'ucenter/member/mypm:detail',
                    'nav' => 'ucenter/member/mypm:index'
                ),
                array(
                    'title' => '装修日记',
                    'ctl' => 'ucenter/member/diary:index',
                    'menu' => true
                ),
                array(
                    'title' => '创建日记',
                    'ctl' => 'ucenter/member/diary:create',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '修改日记',
                    'ctl' => 'ucenter/member/diary:edit',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '删除日记',
                    'ctl' => 'ucenter/member/diary:delete',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '日记文章',
                    'ctl' => 'ucenter/member/diary:detail',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '日记图片',
                    'ctl' => 'ucenter/member/diary:photo',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '上传日记图片',
                    'ctl' => 'ucenter/member/diary:upload',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '更新日记图片',
                    'ctl' => 'ucenter/member/diary:update',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '删除日记图片',
                    'ctl' => 'ucenter/member/diary:deletephoto',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '删除默认日记图片',
                    'ctl' => 'ucenter/member/diary:defaultphoto',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '添加文章',
                    'ctl' => 'ucenter/member/diary:createDiary',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '修改文章',
                    'ctl' => 'ucenter/member/diary:editDiary',
                    'nav' => 'ucenter/member/diary:index'
                ),
                array(
                    'title' => '删除文章',
                    'ctl' => 'ucenter/member/diary:deleteDiary',
                    'nav' => 'ucenter/member/diary:index'
                ),
                
                array(
                    'title' => '装修问答',
                    'ctl' => 'ucenter/member/ask:index',
                    'menu' => true
                ),
                array(
                    'title' => '我的回答',
                    'ctl' => 'ucenter/member/ask:answer',
                    'nav' => 'ucenter/member/ask:index'
                ),
                array(
                    'title' => '我的管家',
                    'ctl' => 'ucenter/member/zxb:index',
                    'menu' => true,
                    'tag' => 'wdzxb',
                ),
                array(
                    'title' => '查看装修保',
                    'ctl' => 'ucenter/member/zxb:lists',
                    'nav' => 'ucenter/member/zxb:index'
                ),
                array(
                    'title' => '具体步骤',
                    'ctl' => 'ucenter/member/zxb:detail',
                    'nav' => 'ucenter/member/zxb:index'
                ),
                array(
                    'title' => '我的投诉',
                    'ctl' => 'ucenter/member/zxb:plaint',
                    'nav' => 'ucenter/member/zxb:index'
                ),
                array(
                    'title' => '我的投诉列表',
                    'ctl' => 'ucenter/member/zxb:plaintlists',
                    'nav' => 'ucenter/member/zxb:index'
                ),
                array(
                    'title' => '投诉查看修改',
                    'ctl' => 'ucenter/member/zxb:plaintedit',
                    'nav' => 'ucenter/member/zxb:index'
                ),
                array(
                    'title' => '提交合同证明',
                    'ctl' => 'ucenter/member/zxb:hetong',
                    'nav' => 'ucenter/member/zxb:index'
                ),
                /*
                array('title'=>'我的评论', 'ctl'=>'ucenter/member/ask:index', 'menu'=>true),
                array('title'=>'我的回答', 'ctl'=>'ucenter/member/ask:answer', 'nav'=>'ucenter/member/diary:index'),
                */
                array(
                    'title' => '公装',
                    'ctl' => 'ucenter/member/zxb:gz',
                ),
                array(
                    'title' => '公装详情',
                    'ctl' => 'ucenter/member/zxb:gzxq',
                ),
                array(
                    'title' => '公装合同',
                    'ctl' => 'ucenter/member/zxb:gzht',
                ),
                array(
                    'title' => '公装流程',
                    'ctl' => 'ucenter/member/zxb:gzlc',
                ),
            )
        ),

        array(
            'title' => '点评管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '我的点评',
                    'ctl' => 'ucenter/member/dp:index',
                    'menu' => true
                ),
                array(
                    'title' => '我的评论',
                    'ctl' => 'ucenter/member/dp:answer',
                    'nav' => 'ucenter/member/dp:index'
                ),
            )
        ),

        ################
        array(
            'title' => '我的维修',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '我的维修',
                    'ctl' => 'ucenter/member/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '查看维修',
                    'ctl' => 'ucenter/member/truste:trusteDetail',
                    'nav' => 'ucenter/member/truste:index'
                ),
                array(
                    'title' => '完善维修',
                    'ctl' => 'ucenter/member/truste:trusteEdit',
                    'nav' => 'ucenter/member/truste:index'
                ),
                array(
                    'title' => '设置中标',
                    'ctl' => 'ucenter/member/truste:signLook',
                    'nav' => 'ucenter/member/truste:index'
                ),
                array(
                    'title' => '设置完工',
                    'ctl' => 'ucenter/member/truste:ended',
                    'nav' => 'ucenter/member/truste:index'
                ),
                array(
                    'title' => '完工评论',
                    'ctl' => 'ucenter/member/truste:comments',
                    'nav' => 'ucenter/member/truste:index'
                )
            )
            
        ),
        array(
            'title' => '我的订单',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商城订单',
                    'ctl' => 'ucenter/member/order:index',
                    'menu' => true
                ),
                array(
                    'title' => '积分商城订单',
                    'ctl' => 'ucenter/member/jforder:index',
//                    'menu' => true
                    'menu' => false
                ),
                array(
                    'title' => '更新订单',
                    'ctl' => 'ucenter/member/order:update',
                    'nav' => 'ucenter/member/order:index'
                ),
                array(
                    'title' => '更新订单',
                    'ctl' => 'ucenter/member/jforder:update',
                    'nav' => 'ucenter/member/order:index'
                ),
                array(
                    'title' => '订单地址',
                    'ctl' => 'ucenter/member/order:address',
                    'menu' => true
                ),
                array(
                    'title' => '新建地址',
                    'ctl' => 'ucenter/member/order:create_addr',
                    'nav' => 'ucenter/member/order:address'
                ),
                array(
                    'title' => '修改地址',
                    'ctl' => 'ucenter/member/order:update_addr',
                    'nav' => 'ucenter/member/order:address'
                ),
                array(
                    'title' => '删除地址',
                    'ctl' => 'ucenter/member/order:delete_addr',
                    'nav' => 'ucenter/member/order:address'
                ),
                array(
                    'title' => '设置默认地址',
                    'ctl' => 'ucenter/member/order:default_addr',
                    'nav' => 'ucenter/member/order:address'
                ),
                array(
                    'title' => '我的招标',
                    'ctl' => 'ucenter/member/yuyue:tenders',
                    'menu' => true
                ),
                array(
                    'title' => '查看招标',
                    'ctl' => 'ucenter/member/yuyue:tendersDetail',
                    'nav' => 'ucenter/member/yuyue:tendersx'
                ),
                array(
                    'title' => '完善招标',
                    'ctl' => 'ucenter/member/yuyue:tendersEdit',
                    'nav' => 'ucenter/member/yuyue:tenders'
                ),
                array(
                    'title' => '设置中标',
                    'ctl' => 'ucenter/member/yuyue:signLook',
                    'nav' => 'ucenter/member/yuyue:tenders'
                ),
                array(
                    'title' => '我的预约',
                    'ctl' => 'ucenter/member/yuyue:company',
//                    'menu' => true
                    'menu' => false
                ),
                array(
                    'title' => '查看预约',
                    'ctl' => 'ucenter/member/yuyue:companyDetail',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '预约设计师',
                    'ctl' => 'ucenter/member/yuyue:designer',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '查看预约',
                    'ctl' => 'ucenter/member/yuyue:designerDetail',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '预约技工',
                    'ctl' => 'ucenter/member/yuyue:mechanic',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '查看技工',
                    'ctl' => 'ucenter/member/yuyue:mechanicDetail',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '预约工长',
                    'ctl' => 'ucenter/member/yuyue:gz',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '查看工长',
                    'ctl' => 'ucenter/member/yuyue:gzDetail',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '商铺预约',
                    'ctl' => 'ucenter/member/yuyue:shop',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
                array(
                    'title' => '查看预约',
                    'ctl' => 'ucenter/member/yuyue:shopDetail',
                    'nav' => 'ucenter/member/yuyue:company'
                ),
//                array(
//                    'title' => '我的优惠券',
//                    'ctl' => 'ucenter/member:coupon',
//                    'menu' => true
//                ),
                array(
                    'title' => '我的装修贷款',
                    'ctl' => 'ucenter/member:topics',
                    'menu' => true
                ),
                array(
                    'title' => '查看装修贷款',
                    'ctl' => 'ucenter/member:topicsdetail',
                    'nav' => 'ucenter/member:topicsdetail'
                )
            )
        ),
        array(
            'title' => '常用功能',
            'menu' => false,
            'items' => array(
                array(
                    'title' => '选择小区',
                    'ctl' => 'ucenter/misc/select:home'
                ),
                array(
                    'title' => '选择公司',
                    'ctl' => 'ucenter/misc/select:company'
                ),
                array(
                    'title' => '选择户型',
                    'ctl' => 'ucenter/misc/select:huxing'
                ),
                array(
                    'title' => '我的案例',
                    'ctl' => 'ucenter/misc/select:mycase'
                ),
                array(
                    'title' => '访问主页',
                    'ctl' => 'ucenter/member:home'
                ),
                array(
                    'title' => '我的权限',
                    'ctl' => 'ucenter/member:group'
                )
            )
        )
    )
);
