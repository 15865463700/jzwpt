<?php
/*
 * title => 显示标题
 * ctl => ctl:act
 * priv => 权限,默认全部权限(gz,hotel,shop)
 * menu => 是否显示菜单, 只有有相应权限并且这里设置true才会显示在菜单上
 */
return array(
    // /会员菜单
    'member' => array(
        array(
            'title' => '帐户管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '个人中心',
                    'ctl' => 'dcenter/index:index',
                    'nav' => 'dcenter/member:index'
                ),
                array(
                    'title' => '个人中心',
                    'ctl' => 'dcenter/member:index',
                    'menu' => true
                ),
                array(
                    'title' => '修改资料',
                    'ctl' => 'dcenter/member:info',
                    'menu' => true
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'dcenter/member:passwd',
                    'nav' => 'dcenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'dcenter/member:passwds',
                    'nav' => 'dcenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'dcenter/member:passwd1',
                    'nav' => 'dcenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'dcenter/member:passwd2',
                    'nav' => 'dcenter/member:info'
                ),
                array(
                    'title' => '更换邮箱',
                    'ctl' => 'dcenter/member:mail',
                    'nav' => 'dcenter/member:info'
                ),
                array(
                    'title' => '修改头像',
                    'ctl' => 'dcenter/member:face',
                    'nav' => 'dcenter/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'dcenter/member:upload',
                    'nav' => 'dcenter/member:info'
                ),
                array(
                    'title' => '实名认证',
                    'ctl' => 'dcenter/member/verify:name',
                    'menu' => true
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'dcenter/member/verify:mobile',
                    'nav' => 'dcenter/member/verify:name'
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'dcenter/member/verify:code',
                    'nav' => 'dcenter/member/verify:name'
                ),
                array(
                    'title' => 'EMAIL认证',
                    'ctl' => 'dcenter/member/verify:mail',
                    'nav' => 'dcenter/member/verify:name'
                ),
                array(
                    'title' => '帐号绑定',
                    'ctl' => 'dcenter/member:bindaccount',
                    'menu' => true
                ),
                array(
                    'title' => '金币日志',
                    'ctl' => 'dcenter/member:logs',
                    'menu' => true
                ),
                array(
                    'title' => '个人主页',
                    'ctl' => 'dcenter/member:home',
                    'menu' => true
                ),
                array(
                    'title' => '我的金币',
                    'ctl' => 'dcenter/member:gold',
                    'nav' => 'dcenter/member:logs'
                ),
                array(
                    'title' => '积分日志',
                    'ctl' => 'dcenter/member:jflogs',
                    'menu' => true
                ),
                array(
                    'title' => '我的托管',
                    'ctl' => 'dcenter/member:truste',
                    'nav' => 'dcenter/member:trustelogs'
                ),
                array(
                    'title' => '分销链接',
                    'ctl' => 'dcenter/member:fenxiao',
                    'menu' => true
                ),
                array(
                    'title' => '我的红包',
                    'ctl' => 'dcenter/member/packet:items',
                    'menu' => true
                ),
                array(
                    'title' => '领取红包',
                    'ctl' => 'dcenter/member/packet:create',
                    'nav' => 'dcenter/packet:items'
                )
            )
        )
    ),
    
    // /设计师
    'designer' => array(
        array(
            'title' => '资料设置',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '资料设置',
                    'ctl' => 'dcenter/designer:index',
                    'menu' => true
                ),
                array(
                    'title' => '资料设置',
                    'ctl' => 'dcenter/designer:info',
                    'nav' => 'dcenter/designer:index'
                ),
                array(
                    'title' => '属性设置',
                    'ctl' => 'dcenter/designer:attr',
                    'nav' => 'dcenter/designer:index'
                ),
                array(
                    'title' => '刷新置顶',
                    'ctl' => 'dcenter/designer:refresh',
                    'nav' => 'dcenter/designer:index'
                )
            )
        ),
        array(
            'title' => '装修案例',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '案例管理',
                    'ctl' => 'dcenter/designer/case:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加案例',
                    'ctl' => 'dcenter/designer/case:create',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '编辑案例',
                    'ctl' => 'dcenter/designer/case:edit',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '案例图片',
                    'ctl' => 'dcenter/designer/case:detail',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '删除案例',
                    'ctl' => 'dcenter/designer/case:delete',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'dcenter/designer/case:update',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'dcenter/designer/case:upload',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'dcenter/designer/case:deletephoto',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '封面',
                    'ctl' => 'dcenter/designer/case:defaultphoto',
                    'nav' => 'dcenter/designer/case:index'
                ),
                array(
                    'title' => '选择小区',
                    'ctl' => 'dcenter/misc/select:home',
                    'nav' => 'dcenter/designer/case:index'
                ),
            )
        ),
        array(
            'title' => '文章管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '文章管理',
                    'ctl' => 'dcenter/designer/blog:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加文章',
                    'ctl' => 'dcenter/designer/blog:create',
                    'nav' => 'dcenter/designer/blog:index'
                ),
                array(
                    'title' => '编辑文章',
                    'ctl' => 'dcenter/designer/blog:edit',
                    'nav' => 'dcenter/designer/blog:index'
                ),
                array(
                    'title' => '删除文章',
                    'ctl' => 'dcenter/designer/blog:delete',
                    'nav' => 'dcenter/designer/blog:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'dcenter/designer/money:designer',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'dcenter/designer/money:tixian',
                    'nav' => 'dcenter/designer/money:designer'
                )
            )
        ),
        array(
            'title' => '预约管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '预约管理',
                    'ctl' => 'dcenter/designer/yuyue:designer',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'dcenter/designer/yuyue:detail',
                    'nav' => 'dcenter/designer/yuyue:designer'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'dcenter/designer/yuyue:save',
                    'nav' => 'dcenter/designer/yuyue:designer'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'dcenter/misc/tenders:detail',
                    'nav' => 'dcenter/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/tenders:look',
                    'nav' => 'dcenter/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'dcenter/misc/tenders:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'dcenter/misc/tenders:track',
                    'nav' => 'dcenter/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标留言',
                    'ctl' => 'dcenter/misc/tenders:comment',
                    'nav' => 'dcenter/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'dcenter/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'dcenter/misc/truste:detail',
                    'nav' => 'dcenter/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/truste:look',
                    'nav' => 'dcenter/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'dcenter/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'dcenter/misc/truste:track',
                    'nav' => 'dcenter/misc/truste:looked'
                )
            )
        )
    ),
    
    // /工长
    'gz' => array(
        array(
            'title' => '资料设置',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '资料设置',
                    'ctl' => 'dcenter/gz:index',
                    'menu' => true
                ),
                array(
                    'title' => '资料设置',
                    'ctl' => 'dcenter/gz:info',
                    'nav' => 'dcenter/gz:index'
                ),
                array(
                    'title' => '属性设置',
                    'ctl' => 'dcenter/gz:attr',
                    'nav' => 'dcenter/gz:index'
                ),
                array(
                    'title' => '刷新置顶',
                    'ctl' => 'dcenter/gz:refresh',
                    'nav' => 'dcenter/gz:index'
                )
            )
        ),
        array(
            'title' => '装修案例',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '案例管理',
                    'ctl' => 'dcenter/gz/case:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加案例',
                    'ctl' => 'dcenter/gz/case:create',
                    'nav' => 'dcenter/gz/case:index'
                ),
                array(
                    'title' => '编辑案例',
                    'ctl' => 'dcenter/gz/case:edit',
                    'nav' => 'dcenter/gz/case:index'
                ),
                array(
                    'title' => '案例图片',
                    'ctl' => 'dcenter/gz/case:detail',
                    'nav' => 'dcenter/gz/case:index'
                ),
                array(
                    'title' => '删除案例',
                    'ctl' => 'dcenter/gz/case:delete',
                    'nav' => 'dcenter/gz/case:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'dcenter/gz/case:update',
                    'nav' => 'dcenter/gz/case:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'dcenter/gz/case:upload',
                    'nav' => 'dcenter/gz/case:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'dcenter/gz/case:deletephoto',
                    'nav' => 'dcenter/gz/case:index'
                ),
                array(
                    'title' => '封面',
                    'ctl' => 'dcenter/gz/case:defaultphoto',
                    'nav' => 'dcenter/gz/case:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'dcenter/gz/money:gz',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'dcenter/gz/money:tixian',
                    'nav' => 'dcenter/gz/money:gz'
                )
            )
        ),
        array(
            'title' => '在建工地',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '工地管理',
                    'ctl' => 'dcenter/gz/site:index',
                    'menu' => true
                ),
                array(
                    'title' => '发布工地',
                    'ctl' => 'dcenter/gz/site:create',
                    'nav' => 'dcenter/gz/site:index'
                ),
                array(
                    'title' => '修改工地',
                    'ctl' => 'dcenter/gz/site:edit',
                    'nav' => 'dcenter/gz/site:index'
                ),
                array(
                    'title' => '删除工地',
                    'ctl' => 'dcenter/gz/site:delete',
                    'nav' => 'dcenter/gz/site:index'
                ),
                array(
                    'title' => '工地日记',
                    'ctl' => 'dcenter/gz/diary:site',
                    'nav' => 'dcenter/gz/site:index'
                ),
                array(
                    'title' => '发布日记',
                    'ctl' => 'dcenter/gz/diary:create',
                    'nav' => 'dcenter/gz/site:index'
                ),
                array(
                    'title' => '修改日记',
                    'ctl' => 'dcenter/gz/diary:edit',
                    'nav' => 'dcenter/gz/site:index'
                ),
                array(
                    'title' => '删除日记',
                    'ctl' => 'dcenter/gz/diary:delete',
                    'nav' => 'dcenter/gz/site:index'
                )
            )
        ),
        array(
            'title' => '预约管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '预约管理',
                    'ctl' => 'dcenter/gz/yuyue:gz',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'dcenter/gz/yuyue:detail',
                    'nav' => 'dcenter/gz/yuyue:gz'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'dcenter/gz/yuyue:save',
                    'nav' => 'dcenter/gz/yuyue:gz'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'dcenter/misc/tenders:detail',
                    'nav' => 'dcenter/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/tenders:look',
                    'nav' => 'dcenter/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'dcenter/misc/tenders:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'dcenter/misc/tenders:track',
                    'nav' => 'dcenter/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标留言',
                    'ctl' => 'dcenter/misc/tenders:comment',
                    'nav' => 'dcenter/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'dcenter/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'dcenter/misc/truste:detail',
                    'nav' => 'dcenter/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/truste:look',
                    'nav' => 'dcenter/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'dcenter/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'dcenter/misc/truste:track',
                    'nav' => 'dcenter/misc/truste:looked'
                )
            )
        ),
        array(
            'title' => '评论管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '查看评论',
                    'ctl' => 'dcenter/gz/comment:index',
                    'menu' => true
                ),
                array(
                    'title' => '评论回复',
                    'ctl' => 'dcenter/gz/comment:reply',
                    'nav' => 'dcenter/gz/comment:index'
                )
            )
        )
    ),
    
    // /技工
    'mechanic' => array(
        array(
            'title' => '资料设置',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '资料设置',
                    'ctl' => 'dcenter/mechanic:index',
                    'menu' => true
                ),
                array(
                    'title' => '属性设置',
                    'ctl' => 'dcenter/mechanic:info',
                    'nav' => 'dcenter/mechanic:index'
                ),
                array(
                    'title' => '属性设置',
                    'ctl' => 'dcenter/mechanic:attr',
                    'nav' => 'dcenter/mechanic:index'
                ),
                array(
                    'title' => '刷新技工',
                    'ctl' => 'dcenter/mechanic:refresh',
                    'nav' => 'dcenter/mechanic:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'dcenter/mechanic/money:mechanic',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'dcenter/mechanic/money:tixian',
                    'nav' => 'dcenter/mechanic/money:mechanic'
                )
            )
        ),
        array(
            'title' => '预约管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '预约管理',
                    'ctl' => 'dcenter/mechanic/yuyue:mechanic',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'dcenter/mechanic/yuyue:detail',
                    'nav' => 'dcenter/mechanic/yuyue:mechanic'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'dcenter/mechanic/yuyue:save',
                    'nav' => 'dcenter/mechanic/yuyue:mechanic'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'dcenter/misc/tenders:detail',
                    'nav' => 'dcenter/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/tenders:look',
                    'nav' => 'dcenter/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'dcenter/misc/tenders:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'dcenter/misc/tenders:track',
                    'nav' => 'dcenter/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标留言',
                    'ctl' => 'dcenter/misc/tenders:comment',
                    'nav' => 'dcenter/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'dcenter/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'dcenter/misc/truste:detail',
                    'nav' => 'dcenter/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'dcenter/misc/truste:look',
                    'nav' => 'dcenter/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'dcenter/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'dcenter/misc/truste:track',
                    'nav' => 'dcenter/misc/truste:looked'
                )
            )
        )
    )
);
