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
                    'ctl' => 'scenter/index:index',
                    'nav' => 'scenter/member:index'
                ),
                array(
                    'title' => '消息',
                    'ctl' => 'scenter/index:tip',
                ),
                array(
                    'title' => '个人中心',
                    'ctl' => 'scenter/member:index',
                    'menu' => true
                ),
                array(
                    'title' => '修改资料',
                    'ctl' => 'scenter/member:info',
                    
                    'menu' => true
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'scenter/member:passwd',
                    'nav' => 'scenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'scenter/member:passwds',
                    'nav' => 'scenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'scenter/member:passwd1',
                    'nav' => 'scenter/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'scenter/member:passwd2',
                    'nav' => 'scenter/member:info'
                ),
                array(
                    'title' => '更换邮箱',
                    'ctl' => 'scenter/member:mail',
                    'nav' => 'scenter/member:info'
                ),
                array(
                    'title' => '修改头像',
                    'ctl' => 'scenter/member:face',
                    'nav' => 'scenter/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'scenter/member:upload',
                    'nav' => 'scenter/member:info'
                ),
//                array(
//                    'title' => '实名认证',
//                    'ctl' => 'scenter/member/verify:name',
//                    'menu' => true
//                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'scenter/member/verify:mobile',
                    'menu' => true
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'scenter/member/verify:mobile',
                    'nav' => 'scenter/member/verify:name'
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'scenter/member/verify:code',
                    'nav' => 'scenter/member/verify:name'
                ),
                array(
                    'title' => 'EMAIL认证',
                    'ctl' => 'scenter/member/verify:mail',
                    'nav' => 'scenter/member/verify:name'
                ),
                array(
                    'title' => '帐号绑定',
                    'ctl' => 'scenter/member:bindaccount',
                    'menu' => false
                ),
                array(
                    'title' => '金币日志',
                    'ctl' => 'scenter/member:logs',
                    'menu' => true
                ),
//                array(
//                    'title' => '金币日志',
//                    'ctl' => 'scenter/member:home',
//                    'menu' => true
//                ),
                array(
                    'title' => '我的金币',
                    'ctl' => 'scenter/member:gold',
                    'nav' => 'scenter/member:logs'
                ),
//                array(
//                    'title' => '积分日志',
//                    'ctl' => 'scenter/member:jflogs',
//                    'menu' => true
//                ),
                array(
                    'title' => '积分日志',
                    'ctl' => 'scenter/member:jflogs',
                    'menu' => true
                ),
                array(
                    'title' => '我的托管',
                    'ctl' => 'scenter/member:truste',
                    'nav' => 'scenter/member:trustelogs'
                ),
//                array(
//                    'title' => '分销链接',
//                    'ctl' => 'scenter/member:fenxiao',
//                    'menu' => true
//                ),
                array(
                    'title' => '我的红包',
                    'ctl' => 'scenter/member/packet:items',
//                    'menu' => true
                    'menu' => false
                ),
                array(
                    'title' => '领取红包',
                    'ctl' => 'scenter/member/packet:create',
                    'nav' => 'scenter/packet:items'
                )
            )
        )
    ),
    
    // /公司菜单
    'company' => array(
        array(
            'title' => '公司管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '管理中心',
                    'ctl' => 'scenter/company:index',
                    'menu' => true
                ),
                array(
                    'title' => '公司设置',
                    'ctl' => 'scenter/company:info',
                    'menu' => true
                ),
                array(
                    'title' => '刷新置顶',
                    'ctl' => 'scenter/company:refresh',
                    'nav' => 'scenter/company:index'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'scenter/company:skin',
                    'nav' => 'scenter/company:info'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'scenter/company:domain',
                    'nav' => 'scenter/company:info'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'scenter/company/banner:index',
                    'nav' => 'scenter/company:info'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'scenter/company/banner:upload',
                    'nav' => 'scenter/company:info'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'scenter/company/banner:update',
                    'nav' => 'scenter/company:info'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'scenter/company/banner:delete',
                    'nav' => 'scenter/company:info'
                ),
                array(
                    'title' => '荣誉资质',
                    'ctl' => 'scenter/company/photo:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加图片',
                    'ctl' => 'scenter/company/photo:create',
                    'nav' => 'scenter/company/photo:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'scenter/company/photo:update',
                    'nav' => 'scenter/company/photo:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'scenter/company/photo:delete',
                    'nav' => 'scenter/company/photo:index'
                ),
//                array(
//                    'title' => '团队管理',
//                    'ctl' => 'scenter/company/team:index',
//                    'menu' => true
//                ),
                array(
                    'title' => '设计师管理',
                    'ctl' => 'scenter/company/designer:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加设计师',
                    'ctl' => 'scenter/company/designer:create',
                    'menu' => false
                ),
                array(
                    'title' => '设计师修改',
                    'ctl' => 'scenter/company/designer:edit',
                    'menu' => false
                ),
                array(
                    'title' => '删除设计师',
                    'ctl' => 'scenter/company/designer:delete',
                    'menu' => false
                ),
                array(
                    'title' => '绑定设计师',
                    'ctl' => 'scenter/company/team:bind',
                    'nav' => 'scenter/company/team:index'
                ),
                array(
                    'title' => '解雇设计师',
                    'ctl' => 'scenter/company/team:unbind',
                    'nav' => 'scenter/company/team:index'
                ),
                array(
                    'title' => '企业新闻',
                    'ctl' => 'scenter/company/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '发布新闻',
                    'ctl' => 'scenter/company/news:create',
                    'nav' => 'scenter/company/news:index'
                ),
                array(
                    'title' => '编辑新闻',
                    'ctl' => 'scenter/company/news:edit',
                    'nav' => 'scenter/company/news:index'
                ),
                array(
                    'title' => '删除新闻',
                    'ctl' => 'scenter/company/news:delete',
                    'nav' => 'scenter/company/news:index'
                )
            )
        ),
        array(
//            'title' => '预约管理',
            'title' => '装修保管理',
            'menu' => true,
            'items' => array(
//                array(
//                    'title' => '预约管理',
//                    'ctl' => 'scenter/company/yuyue:company',
//                    'menu' => true
//                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'scenter/company/yuyue:detail',
                    'nav' => 'scenter/company/yuyue:company'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'scenter/company/yuyue:save',
                    'nav' => 'scenter/company/yuyue:company'
                ),
                array(
                    'title' => '预约设计师',
                    'ctl' => 'scenter/company/yuyue:designer',
                    'nav' => 'scenter/company/yuyue:company'
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'scenter/company/yuyue:designerDetail',
                    'nav' => 'scenter/company/yuyue:company'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'scenter/company/yuyue:designerSave',
                    'nav' => 'scenter/company/yuyue:company'
                ),

//                array(
//                    'title' => '我要投标',
//                    'ctl' => 'scenter/misc/tenders:index',
//                    'menu' => true
//                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'scenter/misc/tenders:detail',
                    'nav' => 'scenter/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'scenter/misc/tenders:look',
                    'nav' => 'scenter/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'scenter/misc/tenders:looked',
                    'menu' => true,
                    'tag' => 'wdjb',
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'scenter/misc/tenders:track',
                    'nav' => 'scenter/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标留言',
                    'ctl' => 'scenter/misc/tenders:comment',
                    'nav' => 'scenter/misc/tenders:looked'
                ),
                array(
                    'title' => '我的管家',
                    'ctl' => 'scenter/company/zxb:index',
                    'menu' => true
                ),
                array(
                    'title' => '查看装修保',
                    'ctl' => 'scenter/company/zxb:lists',
                    'nav' => 'scenter/company/zxb:index'
                ),
                array(
                    'title' => '具体步骤',
                    'ctl' => 'scenter/company/zxb:detail',
                    'nav' => 'scenter/company/zxb:index'
                ),
                array(
                    'title' => '用户确定预约',
                    'ctl' => 'scenter/company/zxb:look',
                    'nav' => 'scenter/company/zxb:index'
                ),
                array(
                    'title' => '提交合同',
                    'ctl' => 'scenter/company/zxb:hetong',
                    'nav' => 'scenter/company/zxb:index'
                ),
                array(
                    'title' => '我的投诉',
                    'ctl' => 'scenter/company/zxb:plaint',
                    'nav' => 'scenter/company/zxb:index'
                ),
                array(
                    'title' => '我的投诉列表',
                    'ctl' => 'scenter/company/zxb:plaintlists',
                    'nav' => 'scenter/company/zxb:index'
                ),
                array(
                    'title' => '投诉查看修改',
                    'ctl' => 'scenter/company/zxb:plaintedit',
                    'nav' => 'scenter/company/zxb:index'
                ),
                array(
                    'title' => '公装',
                    'ctl' => 'scenter/company/zxb:gz',
                ),
                array(
                    'title' => '公装详情',
                    'ctl' => 'scenter/company/zxb:gzxq',
                ),
                array(
                    'title' => '公装合同',
                    'ctl' => 'scenter/company/zxb:gzht',
                ),
                array(
                    'title' => '公装流程',
                    'ctl' => 'scenter/company/zxb:gzlc',
                ),
            )

        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'scenter/company/money:company',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'scenter/company/money:tixian',
                    'nav' => 'scenter/company/money:company'
                )
            )
        ),
        array(
            'title' => '装修案例',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '案例管理',
                    'ctl' => 'scenter/company/case:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加案例',
                    'ctl' => 'scenter/company/case:create',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '选择小区',
                    'ctl' => 'scenter/misc/select:home',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '选择户型图',
                    'ctl' => 'scenter/misc/select:huxing',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '编辑案例',
                    'ctl' => 'scenter/company/case:edit',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '案例图片',
                    'ctl' => 'scenter/company/case:detail',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '删除案例',
                    'ctl' => 'scenter/company/case:delete',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'scenter/company/case:update',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'scenter/company/case:upload',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'scenter/company/case:deletephoto',
                    'nav' => 'scenter/company/case:index'
                ),
                array(
                    'title' => '封面',
                    'ctl' => 'scenter/company/case:defaultphoto',
                    'nav' => 'scenter/company/case:index'
                )
            )
        ),
        
        array(
            'title' => '在建工地',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '工地管理',
                    'ctl' => 'scenter/company/site:index',
                    'menu' => true
                ),
                array(
                    'title' => '发布工地',
                    'ctl' => 'scenter/company/site:create',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '修改工地',
                    'ctl' => 'scenter/company/site:edit',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '删除工地',
                    'ctl' => 'scenter/company/site:delete',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '选择小区',
                    'ctl' => 'scenter/misc/select:home',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '选择户型图',
                    'ctl' => 'scenter/misc/select:mycase',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '工地日记',
                    'ctl' => 'scenter/company/diary:site',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '发布日记',
                    'ctl' => 'scenter/company/diary:create',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '修改日记',
                    'ctl' => 'scenter/company/diary:edit',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '删除日记',
                    'ctl' => 'scenter/company/diary:delete',
                    'nav' => 'scenter/company/site:index'
                ),
                array(
                    'title' => '项目管理',
                    'ctl' => 'scenter/company/zxpm:index',
                    'menu' => true,
                    'key' => 'zxpm'
                ),
                array(
                    'title' => '项目管理',
                    'ctl' => 'scenter/company/zxpm:detail',
                    'nav' => 'scenter/company/zxpm:index',
                    'key' => 'zxpm'
                ),
                array(
                    'title' => '监理管理',
                    'ctl' => 'scenter/company/zxpm:edit',
                    'nav' => 'scenter/company/zxpm:index',
                    'key' => 'zxpm'
                ),
                array(
                    'title' => '监理管理',
                    'ctl' => 'scenter/company/zxpm:delete',
                    'nav' => 'scenter/company/zxpm:index',
                    'key' => 'zxpm'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'scenter/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'scenter/misc/truste:detail',
                    'nav' => 'scenter/misc/truste:index'
                ),
//                array(
//                    'title' => '我要投标',
//                    'ctl' => 'scenter/misc/truste:look',
//                    'nav' => 'scenter/misc/truste:index'
//                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'scenter/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'scenter/misc/truste:track',
                    'nav' => 'scenter/misc/truste:looked'
                )
            )
        ),
        
        array(
            'title' => '团装小区',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '团装小区',
                    'ctl' => 'scenter/company/tuan:index',
                    'menu' => true
                ),
                array(
                    'title' => '报名管理',
                    'ctl' => 'scenter/company/tuan:sign',
                    'nav' => 'scenter/company/tuan:index'
                ),
                array(
                    'title' => '查看',
                    'ctl' => 'scenter/company/tuan:detail',
                    'nav' => 'scenter/company/tuan:index'
                )
            )
        ),
        array(
            'title' => '优惠信息',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '优惠信息',
                    'ctl' => 'scenter/company/youhui:index',
                    'menu' => true
                ),
                array(
                    'title' => '刷新优惠',
                    'ctl' => 'scenter/company/youhui:refresh',
                    'nav' => 'scenter/company/youhui:index'
                ),
                array(
                    'title' => '发布优惠',
                    'ctl' => 'scenter/company/youhui:create',
                    'nav' => 'scenter/company/youhui:index'
                ),
                array(
                    'title' => '编辑优惠',
                    'ctl' => 'scenter/company/youhui:edit',
                    'nav' => 'scenter/company/youhui:index'
                ),
                array(
                    'title' => '删除优惠',
                    'ctl' => 'scenter/company/youhui:delete',
                    'nav' => 'scenter/company/youhui:index'
                ),
                array(
                    'title' => '报名查看',
                    'ctl' => 'scenter/company/youhui:youhuiSign',
                    'nav' => 'scenter/company/youhui:index'
                ),
                array(
                    'title' => '优惠图片',
                    'ctl' => 'scenter/company/youhui:detail',
                    'menu' => false
                ),
                array(
                    'title' => '优惠图片上传',
                    'ctl' => 'scenter/company/youhui:upload',
                    'menu' => false
                ),
                array(
                    'title' => '优惠图片删除',
                    'ctl' => 'scenter/company/youhui:deletephoto',
                    'menu' => false
                ),
                array(
                    'title' => '查看报名',
                    'ctl' => 'scenter/company/youhui:sign',
                    'menu' => true
                ),
                array(
                    'title' => '报名详情',
                    'ctl' => 'scenter/company/youhui:signDetail',
                    'nav' => 'scenter/company/youhui:sign'
                ),
                array(
                    'title' => '更新报名',
                    'ctl' => 'scenter/company/youhui:signSave',
                    'nav' => 'scenter/company/youhui:sign'
                )
            )
        ),
        array(
            'title' => '留言管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '点评管理',
                    'ctl' => 'scenter/company/comment:company',
                    'menu' => true
                ),
                array(
                    'title' => '查看点评',
                    'ctl' => 'scenter/company/comment:detail',
                    'nav' => 'scenter/company/comment:company'
                ),
                array(
                    'title' => '回复点评',
                    'ctl' => 'scenter/company/comment:reply',
                    'nav' => 'scenter/company/comment:company'
                )
            )
        )
    ),

    // /商铺菜单
    'shop' => array(
        array(
            'title' => '商铺管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商铺中心',
                    'ctl' => 'scenter/shop:index',
                    'menu' => true
                ),
                array(
                    'title' => '商铺设置',
                    'ctl' => 'scenter/shop:base',
                    'menu' => true
                ),
                array(
                    'title' => '资料设置',
                    'ctl' => 'scenter/shop:info',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'scenter/shop:domain',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => 'SEO设置',
                    'ctl' => 'scenter/shop:seo',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '购买说明',
                    'ctl' => 'scenter/shop:gmsm',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'scenter/shop:skin',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '商铺子分类',
                    'ctl' => 'scenter/shop:catechildren',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'scenter/shop/banner:index',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'scenter/shop/banner:upload',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'scenter/shop/banner:update',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'scenter/shop/banner:delete',
                    'nav' => 'scenter/shop:base'
                ),
                array(
                    'title' => '店铺资讯',
                    'ctl' => 'scenter/shop/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加资讯',
                    'ctl' => 'scenter/shop/news:create'
                ),
                array(
                    'title' => '修改资讯',
                    'ctl' => 'scenter/shop/news:edit'
                ),
                array(
                    'title' => '删除资讯',
                    'ctl' => 'scenter/shop/news:delete'
                ),
                array(
                    'title' => '门店管理',
                    'ctl' => 'scenter/shop/mendian:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加门店',
                    'ctl' => 'scenter/shop/mendian:create'
                ),
                array(
                    'title' => '修改门店',
                    'ctl' => 'scenter/shop/mendian:edit'
                ),
                array(
                    'title' => '删除门店',
                    'ctl' => 'scenter/shop/mendian:delete'
                ),
                array(
                    'title' => '刷新商铺',
                    'ctl' => 'scenter/shop:refresh',
                    'nav' => 'scenter/shop:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'scenter/shop/money:shop',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'scenter/shop/money:tixian',
                    'nav' => 'scenter/shop/money:shop'
                )
            )
        ),
        array(
            'title' => '商品管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺分类',
                    'ctl' => 'scenter/shop/vcate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'scenter/shop/vcate:create'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'scenter/shop/vcate:edit'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'scenter/shop/vcate:delete'
                ),
                array(
                    'title' => '商品管理',
                    'ctl' => 'scenter/product:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加商品',
                    'ctl' => 'scenter/product:create',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '修改商品',
                    'ctl' => 'scenter/product:edit',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '删除商品',
                    'ctl' => 'scenter/product:delete',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '商品图片',
                    'ctl' => 'scenter/product:photo',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'scenter/product:upload',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'scenter/product:deletephoto',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'scenter/product:updatephoto',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '商品规格',
                    'ctl' => 'scenter/product:spec',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '更新规格',
                    'ctl' => 'scenter/product:updatespec',
                    'nav' => 'scenter/product:index'
                ),
                array(
                    'title' => '删除规格',
                    'ctl' => 'scenter/product:deletespec',
                    'nav' => 'scenter/product:index'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'scenter/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'scenter/misc/truste:detail',
                    'nav' => 'scenter/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'scenter/misc/truste:look',
                    'nav' => 'scenter/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'scenter/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'scenter/misc/truste:track',
                    'nav' => 'scenter/misc/truste:looked'
                )
            )
        ),
        array(
            'title' => '评论管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺评论',
                    'ctl' => 'scenter/shop/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'scenter/shop/comment:detail',
                    'nav' => 'scenter/shop/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'scenter/shop/comment:reply',
                    'nav' => 'scenter/shop/comment:shop'
                ),
                array(
                    'title' => '商品评论',
                    'ctl' => 'scenter/product/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'scenter/product/comment:detail',
                    'nav' => 'scenter/product/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'scenter/product/comment:reply',
                    'nav' => 'scenter/product/comment:shop'
                )
            )
        ),
        array(
            'title' => '商铺订单',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商品订单',
                    'ctl' => 'scenter/shop/order:index',
                    'menu' => true
                ),
                array(
                    'title' => '订单详情',
                    'ctl' => 'scenter/shop/order:update',
                    'nav' => 'scenter/shop/order:index'
                ),
                array(
                    'title' => '预约管理',
                    'ctl' => 'scenter/shop/yuyue:shop',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'scenter/shop/yuyue:detail',
                    'nav' => 'scenter/shop/yuyue:shop'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'scenter/shop/yuyue:save',
                    'nav' => 'scenter/shop/yuyue:shop'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'scenter/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'scenter/misc/tenders:detail',
                    'nav' => 'scenter/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'scenter/misc/tenders:look',
                    'nav' => 'scenter/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'scenter/misc/tenders:looked',
                    'menu' => true,
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'scenter/misc/tenders:tracking',
                    'nav' => 'scenter/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'scenter/misc/tenders:track',
                    'nav' => 'scenter/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '优惠券',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '优惠券',
                    'ctl' => 'scenter/shop/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加优惠券',
                    'ctl' => 'scenter/shop/coupon:create',
                    'nav' => 'scenter/shop/coupon:index'
                ),
                array(
                    'title' => '修改优惠券',
                    'ctl' => 'scenter/shop/coupon:edit',
                    'nav' => 'scenter/shop/coupon:index'
                ),
                array(
                    'title' => '删除优惠券',
                    'ctl' => 'scenter/shop/coupon:delete',
                    'nav' => 'scenter/shop/coupon:index'
                ),
                array(
                    'title' => '下载日志',
                    'ctl' => 'scenter/shop/coupon:downloads',
                    'menu' => true
                ),
                array(
                    'title' => '日志详情',
                    'ctl' => 'scenter/shop/coupon:downloadDetail',
                    'nav' => 'scenter/shop/coupon:downloads'
                ),
                array(
                    'title' => '更新日志',
                    'ctl' => 'scenter/shop/coupon:downloadSave',
                    'nav' => 'scenter/shop/coupon:downloads'
                ),
                array(
                    'title' => '红包列表',
                    'ctl' => 'scenter/shop/packet:items',
//                    'menu' => true
                    'menu' => false
                ),
                array(
                    'title' => '发布红包',
                    'ctl' => 'scenter/shop/packet:create',
                    'nav' => 'scenter/shop/packet:items'
                )
            )
        )
    ),
    // /微信设置
    'weixin' => array(
        array(
            'title' => '微信设置',
            'menu' => true,
            'priv' => 'company,shop',
            'items' => array(
                array(
                    'title' => '微信设置',
                    'ctl' => 'scenter/weixin:index',
                    'menu' => true
                ),
                array(
                    'title' => '公众号设置',
                    'ctl' => 'scenter/weixin:info',
                    'nav' => 'scenter/weixin:index'
                ),
                array(
                    'title' => '接口配置',
                    'ctl' => 'scenter/weixin:config',
                    'nav' => 'scenter/weixin:index'
                ),
                array(
                    'title' => '关注回复',
                    'ctl' => 'scenter/weixin:welcome',
                    'nav' => 'scenter/weixin:index'
                ),
                array(
                    'title' => '宣传页面',
                    'ctl' => 'scenter/weixin:leaflets',
                    'nav' => 'scenter/weixin:index'
                ),
                array(
                    'title' => '微信菜单',
                    'ctl' => 'scenter/weixin/menu:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加菜单',
                    'ctl' => 'scenter/weixin/menu:create',
                    'nav' => 'scenter/weixin/menu:index'
                ),
                array(
                    'title' => '修改菜单',
                    'ctl' => 'scenter/weixin/menu:edit',
                    'nav' => 'scenter/weixin/menu:index'
                ),
                array(
                    'title' => '删除菜单',
                    'ctl' => 'scenter/weixin/menu:delete',
                    'nav' => 'scenter/weixin/menu:index'
                ),
                array(
                    'title' => '同步到微信',
                    'ctl' => 'scenter/weixin/menu:towechat',
                    'nav' => 'scenter/weixin/menu:index'
                ),
                
                array(
                    'title' => '微信素材',
                    'ctl' => 'scenter/weixin/reply:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加素材',
                    'ctl' => 'scenter/weixin/reply:create',
                    'nav' => 'scenter/weixin/reply:index'
                ),
                array(
                    'title' => '修改素材',
                    'ctl' => 'scenter/weixin/reply:edit',
                    'nav' => 'scenter/weixin/reply:index'
                ),
                array(
                    'title' => '删除素材',
                    'ctl' => 'scenter/weixin/reply:delete',
                    'nav' => 'scenter/weixin/reply:index'
                ),
                array(
                    'title' => '选择素材',
                    'ctl' => 'scenter/weixin/reply:dialog',
                    'nav' => 'scenter/weixin/reply:index'
                ),
                array(
                    'title' => '关键字设置',
                    'ctl' => 'scenter/weixin/keyword:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加关键字',
                    'ctl' => 'scenter/weixin/keyword:create',
                    'nav' => 'scenter/weixin/keyword:index'
                ),
                array(
                    'title' => '修改关键字',
                    'ctl' => 'scenter/weixin/keyword:edit',
                    'nav' => 'scenter/weixin/keyword:index'
                ),
                array(
                    'title' => '删除关键字',
                    'ctl' => 'scenter/weixin/keyword:delete',
                    'nav' => 'scenter/weixin/keyword:index'
                )
            )
        ),
        array(
            'title' => '微网站',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '微网站',
                    'ctl' => 'scenter/weixin/msite:index',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'scenter/weixin/msite:tmpl',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'scenter/weixin/msite:access',
                    'nav' => 'scenter/weixin/msite:index'
                ),
                array(
                    'title' => '预览微官网',
                    'ctl' => 'scenter/weixin/msite/banner:index',
                    'nav' => 'scenter/weixin/msite:index'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'scenter/weixin/msite/banner:index',
                    'nav' => 'scenter/weixin/msite:index'
                ),
                array(
                    'title' => '上传广告',
                    'ctl' => 'scenter/weixin/msite/banner:upload',
                    'nav' => 'scenter/weixin/msite:index'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'scenter/weixin/msite/banner:update',
                    'nav' => 'scenter/weixin/msite:index'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'scenter/weixin/msite/banner:delete',
                    'nav' => 'scenter/weixin/msite:index'
                ),
                array(
                    'title' => '分类管理',
                    'ctl' => 'scenter/weixin/msite/cate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'scenter/weixin/msite/cate:create',
                    'nav' => 'scenter/weixin/msite/cate:index'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'scenter/weixin/msite/cate:edit',
                    'nav' => 'scenter/weixin/msite/cate:index'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'scenter/weixin/msite/cate:delete',
                    'nav' => 'scenter/weixin/msite/cate:index'
                ),
                array(
                    'title' => '文章管理',
                    'ctl' => 'scenter/weixin/msite/article:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加文章',
                    'ctl' => 'scenter/weixin/msite/article:create',
                    'nav' => 'scenter/weixin/msite/article:index'
                ),
                array(
                    'title' => '修改文章',
                    'ctl' => 'scenter/weixin/msite/article:edit',
                    'nav' => 'scenter/weixin/msite/article:index'
                ),
                array(
                    'title' => '删除文章',
                    'ctl' => 'scenter/weixin/msite/article:delete',
                    'nav' => 'scenter/weixin/msite/article:index'
                )
            )
        ),
		/*array('title'=>'分销管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'分销设置', 'ctl'=>'scenter/upm/task:index', 'menu'=>true),
                array('title'=>'设置分销', 'ctl'=>'scenter/upm/task:info', 'nav'=>'scenter/upm/task:index', 'key'=>'f_task'),
                array('title'=>'查看任务', 'ctl'=>'scenter/upm/task:detail', 'nav'=>'scenter/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分铺统计', 'ctl'=>'scenter/upm/task:count', 'nav'=>'scenter/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分销日志', 'ctl'=>'scenter/upm/tasklog:index', 'menu'=>true, 'key'=>'f_log'),
                array('title'=>'分销统计', 'ctl'=>'scenter/upm/tasklog:tongji', 'menu'=>true, 'key'=>'f_tongji'),
            )
        ),  */
        array(
            'title' => '微营销',
            'menu' => true,
            'items' => array(
                
                array(
                    'title' => '优惠券',
                    'ctl' => 'scenter/weixin/addon/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '优惠券添加',
                    'ctl' => 'scenter/weixin/addon/coupon:create',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券修改',
                    'ctl' => 'scenter/weixin/addon/coupon:edit',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券删除',
                    'ctl' => 'scenter/weixin/addon/coupon:delete',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券预览',
                    'ctl' => 'scenter/weixin/addon/coupon:preview',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券申请',
                    'ctl' => 'scenter/weixin/addon/coupon:sign',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券展示',
                    'ctl' => 'scenter/weixin/addon/coupon:show',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'scenter/weixin/addon/coupon:sn',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'scenter/weixin/addon/coupon:sndelete',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'scenter/weixin/addon/coupon:snedit',
                    'nav' => 'scenter/weixin/addon/coupon:index'
                ),
                
                array(
                    'title' => '刮刮卡',
                    'ctl' => 'scenter/weixin/addon/scratch:index',
                    'menu' => true
                ),
                array(
                    'title' => '刮刮卡添加',
                    'ctl' => 'scenter/weixin/addon/scratch:create',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡修改',
                    'ctl' => 'scenter/weixin/addon/scratch:edit',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡删除',
                    'ctl' => 'scenter/weixin/addon/scratch:delete',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡预览',
                    'ctl' => 'scenter/weixin/addon/scratch:preview',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'scenter/weixin/addon/scratch:sn',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'scenter/weixin/addon/scratch:sndelete',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'scenter/weixin/addon/scratch:snedit',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'scenter/weixin/addon/scratch:goods',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'scenter/weixin/addon/scratch:goodsdelete',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'scenter/weixin/addon/scratch:goodsedit',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'scenter/weixin/addon/scratch:goodscreate',
                    'nav' => 'scenter/weixin/addon/scratch:index'
                ),
                
                array(
                    'title' => '大转盘',
                    'ctl' => 'scenter/weixin/addon/lottery:index',
                    'menu' => true
                ),
                array(
                    'title' => '大转盘添加',
                    'ctl' => 'scenter/weixin/addon/lottery:create',
                    'nav' => 'scenter/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘修改',
                    'ctl' => 'scenter/weixin/addon/lottery:edit',
                    'nav' => 'scenter/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘删除',
                    'ctl' => 'scenter/weixin/addon/lottery:delete',
                    'nav' => 'scenter/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘预览',
                    'ctl' => 'scenter/weixin/addon/lottery:preview',
                    'nav' => 'scenter/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'scenter/weixin/addon/lottery:sn',
                    'nav' => 'scenter/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'scenter/weixin/addon/lottery:sndelete',
                    'nav' => 'scenter/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'scenter/weixin/addon/lottery:snedit',
                    'nav' => 'scenter/weixin/addon/lottery:index'
                ),
                
                array(
                    'title' => '砸金蛋',
                    'ctl' => 'scenter/weixin/addon/goldegg:index',
                    'menu' => true
                ),
                array(
                    'title' => '砸金蛋添加',
                    'ctl' => 'scenter/weixin/addon/goldegg:create',
                    'nav' => 'scenter/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋修改',
                    'ctl' => 'scenter/weixin/addon/goldegg:edit',
                    'nav' => 'scenter/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋删除',
                    'ctl' => 'scenter/weixin/addon/goldegg:delete',
                    'nav' => 'scenter/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋预览',
                    'ctl' => 'scenter/weixin/addon/goldegg:preview',
                    'nav' => 'scenter/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'scenter/weixin/addon/goldegg:sn',
                    'nav' => 'scenter/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'scenter/weixin/addon/goldegg:sndelete',
                    'nav' => 'scenter/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'scenter/weixin/addon/goldegg:snedit',
                    'nav' => 'scenter/weixin/addon/goldegg:index'
                ),
                
                array(
                    'title' => '红包',
                    'ctl' => 'scenter/weixin/addon/packet:index',
                    'menu' => true
                ),
                array(
                    'title' => '红包添加',
                    'ctl' => 'scenter/weixin/addon/packet:create',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包修改',
                    'ctl' => 'scenter/weixin/addon/packet:edit',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包删除',
                    'ctl' => 'scenter/weixin/addon/packet:delete',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包预览',
                    'ctl' => 'scenter/weixin/addon/packet:preview',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'scenter/weixin/addon/packet:sn',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'scenter/weixin/addon/packet:sndelete',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'scenter/weixin/addon/packet:logs',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'scenter/weixin/addon/packet:logsdelete',
                    'nav' => 'scenter/weixin/addon/packet:index'
                ),
                
                array(
                    'title' => '卡劵',
                    'ctl' => 'scenter/weixin/addon/card:index',
                    'menu' => true
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'scenter/weixin/addon/card:get_card',
                    'nav' => 'scenter/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'scenter/weixin/addon/card:wxqrcode',
                    'nav' => 'scenter/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'scenter/weixin/addon/card:show',
                    'nav' => 'scenter/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'scenter/weixin/addon/card:wxqrcode2',
                    'nav' => 'scenter/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵核销',
                    'ctl' => 'scenter/weixin/addon/card:consume',
                    'nav' => 'scenter/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵删除',
                    'ctl' => 'scenter/weixin/addon/card:delete_card',
                    'nav' => 'scenter/weixin/addon/card:index'
                ),
                
                array(
                    'title' => '摇一摇',
                    'ctl' => 'scenter/weixin/addon/shake:index',
                    'menu' => true
                ),
                array(
                    'title' => '摇一摇添加',
                    'ctl' => 'scenter/weixin/addon/shake:create',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇修改',
                    'ctl' => 'scenter/weixin/addon/shake:edit',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇删除',
                    'ctl' => 'scenter/weixin/addon/shake:delete',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇预览',
                    'ctl' => 'scenter/weixin/addon/shake:preview',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'scenter/weixin/addon/shake:sn',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'scenter/weixin/addon/shake:sndelete',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'scenter/weixin/addon/shake:snedit',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'scenter/weixin/addon/shake:goods',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'scenter/weixin/addon/shake:goodsdelete',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'scenter/weixin/addon/shake:goodsedit',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'scenter/weixin/addon/shake:goodscreate',
                    'nav' => 'scenter/weixin/addon/shake:index'
                ),
                array(
                    'title' => '微助力',
                    'ctl' => 'scenter/weixin/addon/help:index',
                    'menu' => true
                ),
                array(
                    'title' => '微助力添加',
                    'ctl' => 'scenter/weixin/addon/help:create',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力修改',
                    'ctl' => 'scenter/weixin/addon/help:edit',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力删除',
                    'ctl' => 'scenter/weixin/addon/help:delete',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力预览',
                    'ctl' => 'scenter/weixin/addon/help:preview',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'scenter/weixin/addon/help:sn',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'scenter/weixin/addon/help:sndelete',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'scenter/weixin/addon/help:snedit',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '查看我的助力',
                    'ctl' => 'scenter/weixin/addon/help:snlist',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'scenter/weixin/addon/help:goods',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'scenter/weixin/addon/help:goodsdelete',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'scenter/weixin/addon/help:goodsedit',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'scenter/weixin/addon/help:goodscreate',
                    'nav' => 'scenter/weixin/addon/help:index'
                ),
                array(
                    'title' => '微接力',
                    'ctl' => 'scenter/weixin/addon/relay:index',
                    'menu' => true
                ),
                array(
                    'title' => '微接力添加',
                    'ctl' => 'scenter/weixin/addon/relay:create',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力修改',
                    'ctl' => 'scenter/weixin/addon/relay:edit',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力删除',
                    'ctl' => 'scenter/weixin/addon/relay:delete',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力预览',
                    'ctl' => 'scenter/weixin/addon/relay:preview',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'scenter/weixin/addon/relay:sn',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'scenter/weixin/addon/relay:sndelete',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'scenter/weixin/addon/relay:snedit',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '查看我的接力',
                    'ctl' => 'scenter/weixin/addon/relay:snlist',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'scenter/weixin/addon/relay:goods',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'scenter/weixin/addon/relay:goodsdelete',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'scenter/weixin/addon/relay:goodsedit',
                    'nav' => 'scenter/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'scenter/weixin/addon/relay:goodscreate',
                    'nav' => 'scenter/weixin/addon/relay:index'
                )
            )
        )
    )
);
