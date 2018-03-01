<?php
/*
 * title => 显示标题
 * ctl => ctl:act
 * priv => 权限,默认全部权限(gz,hotel,shop)
 * menu => 是否显示菜单, 只有有相应权限并且这里设置true才会显示在菜单上
 */
return array(
    // 会员菜单
    'member' => array(
        array(
            'title' => '帐户管理',
            'menu' => true,
            'items' => array(
                // array('title'=>'个人中心', 'ctl'=>'rzps/index:index', 'nav'=>'rzps/member:index'),
                // array('title'=>'个人中心', 'ctl'=>'rzps/member:index', 'menu'=>true),
                array(
                    'title' => '修改资料',
                    'ctl' => 'rzps/member:info',
                    'menu' => true
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'rzps/member:passwd',
                    'nav' => 'rzps/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'rzps/member:passwds',
                    'nav' => 'rzps/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'rzps/member:passwd1',
                    'nav' => 'rzps/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'rzps/member:passwd2',
                    'nav' => 'rzps/member:info'
                ),
                array(
                    'title' => '更换邮箱',
                    'ctl' => 'rzps/member:mail',
                    'nav' => 'rzps/member:info'
                ),
                array(
                    'title' => '修改头像',
                    'ctl' => 'rzps/member:face',
                    'nav' => 'rzps/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'rzps/member:upload',
                    'nav' => 'rzps/member:info'
                ),
                // array('title'=>'实名认证', 'ctl'=>'rzps/member/verify:name', 'menu'=>true),
                array(
                    'title' => '手机认证',
                    'ctl' => 'rzps/member/verify:mobile',
                    'nav' => 'rzps/member/verify:name'
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'rzps/member/verify:code',
                    'nav' => 'rzps/member/verify:name'
                ),
                array(
                    'title' => 'EMAIL认证',
                    'ctl' => 'rzps/member/verify:mail',
                    'nav' => 'rzps/member/verify:name'
                ),
                // array('title'=>'帐号绑定', 'ctl'=>'rzps/member:bindaccount', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'rzps/member:logs', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'rzps/member:home', 'menu'=>true),
                array(
                    'title' => '我的金币',
                    'ctl' => 'rzps/member:gold',
                    'nav' => 'rzps/member:logs'
                ),
                // array('title'=>'积分日志', 'ctl'=>'rzps/member:jflogs', 'menu'=>true),
                array(
                    'title' => '我的托管',
                    'ctl' => 'rzps/member:truste',
                    'nav' => 'rzps/member:trustelogs'
                ),
                // array('title'=>'分销链接', 'ctl'=>'rzps/member:fenxiao', 'menu'=>true),
                // array('title'=>'我的红包', 'ctl'=>'rzps/member/packet:items', 'menu'=>true),
                array(
                    'title' => '领取红包',
                    'ctl' => 'rzps/member/packet:create',
                    'nav' => 'rzps/packet:items'
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
                // array('title'=>'管理中心', 'ctl'=>'rzps/company:index', 'menu'=>true),
                array(
                    'title' => '公司设置',
                    'ctl' => 'rzps/company:info',
                    'menu' => true
                ),
                array(
                    'title' => '刷新置顶',
                    'ctl' => 'rzps/company:refresh',
                    'nav' => 'rzps/company:index'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'rzps/company:skin',
                    'nav' => 'rzps/company:info'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'rzps/company:domain',
                    'nav' => 'rzps/company:info'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'rzps/company/banner:index',
                    'nav' => 'rzps/company:info'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'rzps/company/banner:upload',
                    'nav' => 'rzps/company:info'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'rzps/company/banner:update',
                    'nav' => 'rzps/company:info'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'rzps/company/banner:delete',
                    'nav' => 'rzps/company:info'
                ),
                // array('title'=>'荣誉资质', 'ctl'=>'rzps/company/photo:index', 'menu'=>true),
                array(
                    'title' => '添加图片',
                    'ctl' => 'rzps/company/photo:create',
                    'nav' => 'rzps/company/photo:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'rzps/company/photo:update',
                    'nav' => 'rzps/company/photo:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'rzps/company/photo:delete',
                    'nav' => 'rzps/company/photo:index'
                ),
                // array('title'=>'团队管理', 'ctl'=>'rzps/company/team:index', 'menu'=>true),
                array(
                    'title' => '绑定设计师',
                    'ctl' => 'rzps/company/team:bind',
                    'nav' => 'rzps/company/team:index'
                ),
                array(
                    'title' => '解雇设计师',
                    'ctl' => 'rzps/company/team:unbind',
                    'nav' => 'rzps/company/team:index'
                ),
                array(
                    'title' => '企业新闻',
                    'ctl' => 'rzps/company/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '发布新闻',
                    'ctl' => 'rzps/company/news:create',
                    'nav' => 'rzps/company/news:index'
                ),
                array(
                    'title' => '编辑新闻',
                    'ctl' => 'rzps/company/news:edit',
                    'nav' => 'rzps/company/news:index'
                ),
                array(
                    'title' => '删除新闻',
                    'ctl' => 'rzps/company/news:delete',
                    'nav' => 'rzps/company/news:index'
                )
            )
        ),
        // array('title'=>'财务管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'财务管理', 'ctl'=>'rzps/company/money:company', 'menu'=>true),
        // array('title'=>'申请提现', 'ctl'=>'rzps/company/money:tixian', 'nav'=>'rzps/company/money:company'),
        // )
        // ),
        array(
            'title' => '装修案例',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '案例管理',
                    'ctl' => 'rzps/company/case:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加案例',
                    'ctl' => 'rzps/company/case:create',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '选择小区',
                    'ctl' => 'rzps/misc/select:home',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '选择户型图',
                    'ctl' => 'rzps/misc/select:huxing',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '编辑案例',
                    'ctl' => 'rzps/company/case:edit',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '案例图片',
                    'ctl' => 'rzps/company/case:detail',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '删除案例',
                    'ctl' => 'rzps/company/case:delete',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'rzps/company/case:update',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'rzps/company/case:upload',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'rzps/company/case:deletephoto',
                    'nav' => 'rzps/company/case:index'
                ),
                array(
                    'title' => '封面',
                    'ctl' => 'rzps/company/case:defaultphoto',
                    'nav' => 'rzps/company/case:index'
                )
            )
        ),
        
        // array('title'=>'在建工地', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'工地管理', 'ctl'=>'rzps/company/site:index', 'menu'=>true),
        // array('title'=>'发布工地', 'ctl'=>'rzps/company/site:create', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'修改工地', 'ctl'=>'rzps/company/site:edit', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'删除工地', 'ctl'=>'rzps/company/site:delete', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'选择小区', 'ctl'=>'rzps/misc/select:home', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'选择户型图', 'ctl'=>'rzps/misc/select:mycase', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'工地日记', 'ctl'=>'rzps/company/diary:site', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'发布日记', 'ctl'=>'rzps/company/diary:create', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'修改日记', 'ctl'=>'rzps/company/diary:edit', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'删除日记', 'ctl'=>'rzps/company/diary:delete', 'nav'=>'rzps/company/site:index'),
        // array('title'=>'项目管理', 'ctl'=>'rzps/company/zxpm:index', 'menu'=>true,'key'=>'zxpm'),
        // array('title'=>'项目管理', 'ctl'=>'rzps/company/zxpm:detail', 'nav'=>'rzps/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'rzps/company/zxpm:edit', 'nav'=>'rzps/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'rzps/company/zxpm:delete', 'nav'=>'rzps/company/zxpm:index','key'=>'zxpm'),
        // )
        // ),
        
        // array('title'=>'维修管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'维修投标', 'ctl'=>'rzps/misc/truste:index', 'menu'=>true),
        // array('title'=>'招标详情', 'ctl'=>'rzps/misc/truste:detail', 'nav'=>'rzps/misc/truste:index'),
        // array('title'=>'我要投标', 'ctl'=>'rzps/misc/truste:look', 'nav'=>'rzps/misc/truste:index'),
        // array('title'=>'维修竞标', 'ctl'=>'rzps/misc/truste:looked', 'menu'=>true),
        // array('title'=>'竞标跟踪', 'ctl'=>'rzps/misc/truste:track', 'nav'=>'rzps/misc/truste:looked'),
        // )
        // ),
        
        // array('title'=>'团装小区', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'团装小区', 'ctl'=>'rzps/company/tuan:index', 'menu'=>true),
        // array('title'=>'报名管理', 'ctl'=>'rzps/company/tuan:sign', 'nav'=>'rzps/company/tuan:index'),
        // array('title'=>'查看', 'ctl'=>'rzps/company/tuan:detail', 'nav'=>'rzps/company/tuan:index'),
        // )
        // ),
        
        // array('title'=>'优惠信息', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'优惠信息', 'ctl'=>'rzps/company/youhui:index', 'menu'=>true),
        // array('title'=>'刷新优惠', 'ctl'=>'rzps/company/youhui:refresh', 'nav'=>'rzps/company/youhui:index'),
        // array('title'=>'发布优惠', 'ctl'=>'rzps/company/youhui:create', 'nav'=>'rzps/company/youhui:index'),
        // array('title'=>'编辑优惠', 'ctl'=>'rzps/company/youhui:edit', 'nav'=>'rzps/company/youhui:index'),
        // array('title'=>'删除优惠', 'ctl'=>'rzps/company/youhui:delete', 'nav'=>'rzps/company/youhui:index'),
        // array('title'=>'报名查看', 'ctl'=>'rzps/company/youhui:youhuiSign', 'nav'=>'rzps/company/youhui:index'),
        // array('title'=>'查看报名', 'ctl'=>'rzps/company/youhui:sign', 'menu'=>true),
        // array('title'=>'报名详情', 'ctl'=>'rzps/company/youhui:signDetail', 'nav'=>'rzps/company/youhui:sign'),
        // array('title'=>'更新报名', 'ctl'=>'rzps/company/youhui:signSave', 'nav'=>'rzps/company/youhui:sign'),
        // )
        // ),
        array(
            'title' => '留言管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '点评管理',
                    'ctl' => 'rzps/company/comment:company',
                    'menu' => true
                ),
                array(
                    'title' => '查看点评',
                    'ctl' => 'rzps/company/comment:detail',
                    'nav' => 'rzps/company/comment:company'
                ),
                array(
                    'title' => '回复点评',
                    'ctl' => 'rzps/company/comment:reply',
                    'nav' => 'rzps/company/comment:company'
                )
            )
        )
    )
    // array('title'=>'预约管理', 'menu'=>true,
    // 'items'=>array(
    // array('title'=>'预约管理', 'ctl'=>'rzps/company/yuyue:company', 'menu'=>true),
    // array('title'=>'预约详情', 'ctl'=>'rzps/company/yuyue:detail', 'nav'=>'rzps/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'rzps/company/yuyue:save', 'nav'=>'rzps/company/yuyue:company'),
    // array('title'=>'预约设计师', 'ctl'=>'rzps/company/yuyue:designer', 'nav'=>'rzps/company/yuyue:company'),
    // array('title'=>'预约详情', 'ctl'=>'rzps/company/yuyue:designerDetail', 'nav'=>'rzps/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'rzps/company/yuyue:designerSave', 'nav'=>'rzps/company/yuyue:company'),
    //
    // array('title'=>'我要投标', 'ctl'=>'rzps/misc/tenders:index', 'menu'=>true),
    // array('title'=>'招标详情', 'ctl'=>'rzps/misc/tenders:detail', 'nav'=>'rzps/misc/tenders:index'),
    // array('title'=>'我要投标', 'ctl'=>'rzps/misc/tenders:look', 'nav'=>'rzps/misc/tenders:index'),
    // array('title'=>'我的竞标', 'ctl'=>'rzps/misc/tenders:looked', 'menu'=>true),
    // array('title'=>'竞标跟踪', 'ctl'=>'rzps/misc/tenders:track', 'nav'=>'rzps/misc/tenders:looked'),
    // array('title'=>'竞标留言', 'ctl'=>'rzps/misc/tenders:comment', 'nav'=>'rzps/misc/tenders:looked'),
    // array('title'=>'我的管家', 'ctl'=>'rzps/company/zxb:index', 'menu'=>true),
    // array('title'=>'查看装修保', 'ctl'=>'rzps/company/zxb:lists', 'nav'=>'rzps/company/zxb:index'),
    // array('title'=>'具体步骤', 'ctl'=>'rzps/company/zxb:detail', 'nav'=>'rzps/company/zxb:index'),
    // array('title'=>'用户确定预约', 'ctl'=>'rzps/company/zxb:look', 'nav'=>'rzps/company/zxb:index'),
    // array('title'=>'提交合同', 'ctl'=>'rzps/company/zxb:hetong', 'nav'=>'rzps/company/zxb:index'),
    // array('title'=>'我的投诉', 'ctl'=>'rzps/company/zxb:plaint', 'nav'=>'rzps/company/zxb:index'),
    // array('title'=>'我的投诉列表', 'ctl'=>'rzps/company/zxb:plaintlists', 'nav'=>'rzps/company/zxb:index'),
    // array('title'=>'投诉查看修改', 'ctl'=>'rzps/company/zxb:plaintedit', 'nav'=>'rzps/company/zxb:index'),
    //
    // )
    // ),
    ,
    
    // /商铺菜单
    'shop' => array(
        array(
            'title' => '商铺管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商铺中心',
                    'ctl' => 'rzps/shop:index',
                    'menu' => true
                ),
                array(
                    'title' => '商铺设置',
                    'ctl' => 'rzps/shop:base',
                    'menu' => true
                ),
                array(
                    'title' => '资料设置',
                    'ctl' => 'rzps/shop:info',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'rzps/shop:domain',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => 'SEO设置',
                    'ctl' => 'rzps/shop:seo',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '购买说明',
                    'ctl' => 'rzps/shop:gmsm',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'rzps/shop:skin',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '商铺子分类',
                    'ctl' => 'rzps/shop:catechildren',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'rzps/shop/banner:index',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'rzps/shop/banner:upload',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'rzps/shop/banner:update',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'rzps/shop/banner:delete',
                    'nav' => 'rzps/shop:base'
                ),
                array(
                    'title' => '店铺资讯',
                    'ctl' => 'rzps/shop/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加资讯',
                    'ctl' => 'rzps/shop/news:create'
                ),
                array(
                    'title' => '修改资讯',
                    'ctl' => 'rzps/shop/news:edit'
                ),
                array(
                    'title' => '删除资讯',
                    'ctl' => 'rzps/shop/news:delete'
                ),
                array(
                    'title' => '门店管理',
                    'ctl' => 'rzps/shop/mendian:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加门店',
                    'ctl' => 'rzps/shop/mendian:create'
                ),
                array(
                    'title' => '修改门店',
                    'ctl' => 'rzps/shop/mendian:edit'
                ),
                array(
                    'title' => '删除门店',
                    'ctl' => 'rzps/shop/mendian:delete'
                ),
                array(
                    'title' => '刷新商铺',
                    'ctl' => 'rzps/shop:refresh',
                    'nav' => 'rzps/shop:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'rzps/shop/money:shop',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'rzps/shop/money:tixian',
                    'nav' => 'rzps/shop/money:shop'
                )
            )
        ),
        array(
            'title' => '商品管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺分类',
                    'ctl' => 'rzps/shop/vcate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'rzps/shop/vcate:create'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'rzps/shop/vcate:edit'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'rzps/shop/vcate:delete'
                ),
                array(
                    'title' => '商品管理',
                    'ctl' => 'rzps/product:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加商品',
                    'ctl' => 'rzps/product:create',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '修改商品',
                    'ctl' => 'rzps/product:edit',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '删除商品',
                    'ctl' => 'rzps/product:delete',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '商品图片',
                    'ctl' => 'rzps/product:photo',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'rzps/product:upload',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'rzps/product:deletephoto',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'rzps/product:updatephoto',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '商品规格',
                    'ctl' => 'rzps/product:spec',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '更新规格',
                    'ctl' => 'rzps/product:updatespec',
                    'nav' => 'rzps/product:index'
                ),
                array(
                    'title' => '删除规格',
                    'ctl' => 'rzps/product:deletespec',
                    'nav' => 'rzps/product:index'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'rzps/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'rzps/misc/truste:detail',
                    'nav' => 'rzps/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'rzps/misc/truste:look',
                    'nav' => 'rzps/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'rzps/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'rzps/misc/truste:track',
                    'nav' => 'rzps/misc/truste:looked'
                )
            )
        ),
        array(
            'title' => '评论管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺评论',
                    'ctl' => 'rzps/shop/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'rzps/shop/comment:detail',
                    'nav' => 'rzps/shop/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'rzps/shop/comment:reply',
                    'nav' => 'rzps/shop/comment:shop'
                ),
                array(
                    'title' => '商品评论',
                    'ctl' => 'rzps/product/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'rzps/product/comment:detail',
                    'nav' => 'rzps/product/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'rzps/product/comment:reply',
                    'nav' => 'rzps/product/comment:shop'
                )
            )
        ),
        array(
            'title' => '商铺订单',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商品订单',
                    'ctl' => 'rzps/shop/order:index',
                    'menu' => true
                ),
                array(
                    'title' => '订单详情',
                    'ctl' => 'rzps/shop/order:update',
                    'nav' => 'rzps/shop/order:index'
                ),
                array(
                    'title' => '预约管理',
                    'ctl' => 'rzps/shop/yuyue:shop',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'rzps/shop/yuyue:detail',
                    'nav' => 'rzps/shop/yuyue:shop'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'rzps/shop/yuyue:save',
                    'nav' => 'rzps/shop/yuyue:shop'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'rzps/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'rzps/misc/tenders:detail',
                    'nav' => 'rzps/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'rzps/misc/tenders:look',
                    'nav' => 'rzps/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'rzps/misc/tenders:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'rzps/misc/tenders:tracking',
                    'nav' => 'rzps/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'rzps/misc/tenders:track',
                    'nav' => 'rzps/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '优惠券',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '优惠券',
                    'ctl' => 'rzps/shop/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加优惠券',
                    'ctl' => 'rzps/shop/coupon:create',
                    'nav' => 'rzps/shop/coupon:index'
                ),
                array(
                    'title' => '修改优惠券',
                    'ctl' => 'rzps/shop/coupon:edit',
                    'nav' => 'rzps/shop/coupon:index'
                ),
                array(
                    'title' => '删除优惠券',
                    'ctl' => 'rzps/shop/coupon:delete',
                    'nav' => 'rzps/shop/coupon:index'
                ),
                array(
                    'title' => '下载日志',
                    'ctl' => 'rzps/shop/coupon:downloads',
                    'menu' => true
                ),
                array(
                    'title' => '日志详情',
                    'ctl' => 'rzps/shop/coupon:downloadDetail',
                    'nav' => 'rzps/shop/coupon:downloads'
                ),
                array(
                    'title' => '更新日志',
                    'ctl' => 'rzps/shop/coupon:downloadSave',
                    'nav' => 'rzps/shop/coupon:downloads'
                ),
                array(
                    'title' => '红包列表',
                    'ctl' => 'rzps/shop/packet:items',
                    'menu' => true
                ),
                array(
                    'title' => '发布红包',
                    'ctl' => 'rzps/shop/packet:create',
                    'nav' => 'rzps/shop/packet:items'
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
                    'ctl' => 'rzps/weixin:index',
                    'menu' => true
                ),
                array(
                    'title' => '公众号设置',
                    'ctl' => 'rzps/weixin:info',
                    'nav' => 'rzps/weixin:index'
                ),
                array(
                    'title' => '接口配置',
                    'ctl' => 'rzps/weixin:config',
                    'nav' => 'rzps/weixin:index'
                ),
                array(
                    'title' => '关注回复',
                    'ctl' => 'rzps/weixin:welcome',
                    'nav' => 'rzps/weixin:index'
                ),
                array(
                    'title' => '宣传页面',
                    'ctl' => 'rzps/weixin:leaflets',
                    'nav' => 'rzps/weixin:index'
                ),
                array(
                    'title' => '微信菜单',
                    'ctl' => 'rzps/weixin/menu:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加菜单',
                    'ctl' => 'rzps/weixin/menu:create',
                    'nav' => 'rzps/weixin/menu:index'
                ),
                array(
                    'title' => '修改菜单',
                    'ctl' => 'rzps/weixin/menu:edit',
                    'nav' => 'rzps/weixin/menu:index'
                ),
                array(
                    'title' => '删除菜单',
                    'ctl' => 'rzps/weixin/menu:delete',
                    'nav' => 'rzps/weixin/menu:index'
                ),
                array(
                    'title' => '同步到微信',
                    'ctl' => 'rzps/weixin/menu:towechat',
                    'nav' => 'rzps/weixin/menu:index'
                ),
                
                array(
                    'title' => '微信素材',
                    'ctl' => 'rzps/weixin/reply:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加素材',
                    'ctl' => 'rzps/weixin/reply:create',
                    'nav' => 'rzps/weixin/reply:index'
                ),
                array(
                    'title' => '修改素材',
                    'ctl' => 'rzps/weixin/reply:edit',
                    'nav' => 'rzps/weixin/reply:index'
                ),
                array(
                    'title' => '删除素材',
                    'ctl' => 'rzps/weixin/reply:delete',
                    'nav' => 'rzps/weixin/reply:index'
                ),
                array(
                    'title' => '选择素材',
                    'ctl' => 'rzps/weixin/reply:dialog',
                    'nav' => 'rzps/weixin/reply:index'
                ),
                array(
                    'title' => '关键字设置',
                    'ctl' => 'rzps/weixin/keyword:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加关键字',
                    'ctl' => 'rzps/weixin/keyword:create',
                    'nav' => 'rzps/weixin/keyword:index'
                ),
                array(
                    'title' => '修改关键字',
                    'ctl' => 'rzps/weixin/keyword:edit',
                    'nav' => 'rzps/weixin/keyword:index'
                ),
                array(
                    'title' => '删除关键字',
                    'ctl' => 'rzps/weixin/keyword:delete',
                    'nav' => 'rzps/weixin/keyword:index'
                )
            )
        ),
        array(
            'title' => '微网站',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '微网站',
                    'ctl' => 'rzps/weixin/msite:index',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'rzps/weixin/msite:tmpl',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'rzps/weixin/msite:access',
                    'nav' => 'rzps/weixin/msite:index'
                ),
                array(
                    'title' => '预览微官网',
                    'ctl' => 'rzps/weixin/msite/banner:index',
                    'nav' => 'rzps/weixin/msite:index'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'rzps/weixin/msite/banner:index',
                    'nav' => 'rzps/weixin/msite:index'
                ),
                array(
                    'title' => '上传广告',
                    'ctl' => 'rzps/weixin/msite/banner:upload',
                    'nav' => 'rzps/weixin/msite:index'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'rzps/weixin/msite/banner:update',
                    'nav' => 'rzps/weixin/msite:index'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'rzps/weixin/msite/banner:delete',
                    'nav' => 'rzps/weixin/msite:index'
                ),
                array(
                    'title' => '分类管理',
                    'ctl' => 'rzps/weixin/msite/cate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'rzps/weixin/msite/cate:create',
                    'nav' => 'rzps/weixin/msite/cate:index'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'rzps/weixin/msite/cate:edit',
                    'nav' => 'rzps/weixin/msite/cate:index'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'rzps/weixin/msite/cate:delete',
                    'nav' => 'rzps/weixin/msite/cate:index'
                ),
                array(
                    'title' => '文章管理',
                    'ctl' => 'rzps/weixin/msite/article:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加文章',
                    'ctl' => 'rzps/weixin/msite/article:create',
                    'nav' => 'rzps/weixin/msite/article:index'
                ),
                array(
                    'title' => '修改文章',
                    'ctl' => 'rzps/weixin/msite/article:edit',
                    'nav' => 'rzps/weixin/msite/article:index'
                ),
                array(
                    'title' => '删除文章',
                    'ctl' => 'rzps/weixin/msite/article:delete',
                    'nav' => 'rzps/weixin/msite/article:index'
                )
            )
        ),
		/*array('title'=>'分销管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'分销设置', 'ctl'=>'rzps/upm/task:index', 'menu'=>true),
                array('title'=>'设置分销', 'ctl'=>'rzps/upm/task:info', 'nav'=>'rzps/upm/task:index', 'key'=>'f_task'),
                array('title'=>'查看任务', 'ctl'=>'rzps/upm/task:detail', 'nav'=>'rzps/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分铺统计', 'ctl'=>'rzps/upm/task:count', 'nav'=>'rzps/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分销日志', 'ctl'=>'rzps/upm/tasklog:index', 'menu'=>true, 'key'=>'f_log'),
                array('title'=>'分销统计', 'ctl'=>'rzps/upm/tasklog:tongji', 'menu'=>true, 'key'=>'f_tongji'),
            )
        ),  */
        array(
            'title' => '微营销',
            'menu' => true,
            'items' => array(
                
                array(
                    'title' => '优惠券',
                    'ctl' => 'rzps/weixin/addon/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '优惠券添加',
                    'ctl' => 'rzps/weixin/addon/coupon:create',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券修改',
                    'ctl' => 'rzps/weixin/addon/coupon:edit',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券删除',
                    'ctl' => 'rzps/weixin/addon/coupon:delete',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券预览',
                    'ctl' => 'rzps/weixin/addon/coupon:preview',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券申请',
                    'ctl' => 'rzps/weixin/addon/coupon:sign',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券展示',
                    'ctl' => 'rzps/weixin/addon/coupon:show',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'rzps/weixin/addon/coupon:sn',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'rzps/weixin/addon/coupon:sndelete',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'rzps/weixin/addon/coupon:snedit',
                    'nav' => 'rzps/weixin/addon/coupon:index'
                ),
                
                array(
                    'title' => '刮刮卡',
                    'ctl' => 'rzps/weixin/addon/scratch:index',
                    'menu' => true
                ),
                array(
                    'title' => '刮刮卡添加',
                    'ctl' => 'rzps/weixin/addon/scratch:create',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡修改',
                    'ctl' => 'rzps/weixin/addon/scratch:edit',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡删除',
                    'ctl' => 'rzps/weixin/addon/scratch:delete',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡预览',
                    'ctl' => 'rzps/weixin/addon/scratch:preview',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'rzps/weixin/addon/scratch:sn',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'rzps/weixin/addon/scratch:sndelete',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'rzps/weixin/addon/scratch:snedit',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'rzps/weixin/addon/scratch:goods',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'rzps/weixin/addon/scratch:goodsdelete',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'rzps/weixin/addon/scratch:goodsedit',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'rzps/weixin/addon/scratch:goodscreate',
                    'nav' => 'rzps/weixin/addon/scratch:index'
                ),
                
                array(
                    'title' => '大转盘',
                    'ctl' => 'rzps/weixin/addon/lottery:index',
                    'menu' => true
                ),
                array(
                    'title' => '大转盘添加',
                    'ctl' => 'rzps/weixin/addon/lottery:create',
                    'nav' => 'rzps/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘修改',
                    'ctl' => 'rzps/weixin/addon/lottery:edit',
                    'nav' => 'rzps/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘删除',
                    'ctl' => 'rzps/weixin/addon/lottery:delete',
                    'nav' => 'rzps/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘预览',
                    'ctl' => 'rzps/weixin/addon/lottery:preview',
                    'nav' => 'rzps/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'rzps/weixin/addon/lottery:sn',
                    'nav' => 'rzps/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'rzps/weixin/addon/lottery:sndelete',
                    'nav' => 'rzps/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'rzps/weixin/addon/lottery:snedit',
                    'nav' => 'rzps/weixin/addon/lottery:index'
                ),
                
                array(
                    'title' => '砸金蛋',
                    'ctl' => 'rzps/weixin/addon/goldegg:index',
                    'menu' => true
                ),
                array(
                    'title' => '砸金蛋添加',
                    'ctl' => 'rzps/weixin/addon/goldegg:create',
                    'nav' => 'rzps/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋修改',
                    'ctl' => 'rzps/weixin/addon/goldegg:edit',
                    'nav' => 'rzps/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋删除',
                    'ctl' => 'rzps/weixin/addon/goldegg:delete',
                    'nav' => 'rzps/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋预览',
                    'ctl' => 'rzps/weixin/addon/goldegg:preview',
                    'nav' => 'rzps/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'rzps/weixin/addon/goldegg:sn',
                    'nav' => 'rzps/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'rzps/weixin/addon/goldegg:sndelete',
                    'nav' => 'rzps/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'rzps/weixin/addon/goldegg:snedit',
                    'nav' => 'rzps/weixin/addon/goldegg:index'
                ),
                
                array(
                    'title' => '红包',
                    'ctl' => 'rzps/weixin/addon/packet:index',
                    'menu' => true
                ),
                array(
                    'title' => '红包添加',
                    'ctl' => 'rzps/weixin/addon/packet:create',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包修改',
                    'ctl' => 'rzps/weixin/addon/packet:edit',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包删除',
                    'ctl' => 'rzps/weixin/addon/packet:delete',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包预览',
                    'ctl' => 'rzps/weixin/addon/packet:preview',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'rzps/weixin/addon/packet:sn',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'rzps/weixin/addon/packet:sndelete',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'rzps/weixin/addon/packet:logs',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'rzps/weixin/addon/packet:logsdelete',
                    'nav' => 'rzps/weixin/addon/packet:index'
                ),
                
                array(
                    'title' => '卡劵',
                    'ctl' => 'rzps/weixin/addon/card:index',
                    'menu' => true
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'rzps/weixin/addon/card:get_card',
                    'nav' => 'rzps/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'rzps/weixin/addon/card:wxqrcode',
                    'nav' => 'rzps/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'rzps/weixin/addon/card:show',
                    'nav' => 'rzps/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'rzps/weixin/addon/card:wxqrcode2',
                    'nav' => 'rzps/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵核销',
                    'ctl' => 'rzps/weixin/addon/card:consume',
                    'nav' => 'rzps/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵删除',
                    'ctl' => 'rzps/weixin/addon/card:delete_card',
                    'nav' => 'rzps/weixin/addon/card:index'
                ),
                
                array(
                    'title' => '摇一摇',
                    'ctl' => 'rzps/weixin/addon/shake:index',
                    'menu' => true
                ),
                array(
                    'title' => '摇一摇添加',
                    'ctl' => 'rzps/weixin/addon/shake:create',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇修改',
                    'ctl' => 'rzps/weixin/addon/shake:edit',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇删除',
                    'ctl' => 'rzps/weixin/addon/shake:delete',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇预览',
                    'ctl' => 'rzps/weixin/addon/shake:preview',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'rzps/weixin/addon/shake:sn',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'rzps/weixin/addon/shake:sndelete',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'rzps/weixin/addon/shake:snedit',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'rzps/weixin/addon/shake:goods',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'rzps/weixin/addon/shake:goodsdelete',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'rzps/weixin/addon/shake:goodsedit',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'rzps/weixin/addon/shake:goodscreate',
                    'nav' => 'rzps/weixin/addon/shake:index'
                ),
                array(
                    'title' => '微助力',
                    'ctl' => 'rzps/weixin/addon/help:index',
                    'menu' => true
                ),
                array(
                    'title' => '微助力添加',
                    'ctl' => 'rzps/weixin/addon/help:create',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力修改',
                    'ctl' => 'rzps/weixin/addon/help:edit',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力删除',
                    'ctl' => 'rzps/weixin/addon/help:delete',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力预览',
                    'ctl' => 'rzps/weixin/addon/help:preview',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'rzps/weixin/addon/help:sn',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'rzps/weixin/addon/help:sndelete',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'rzps/weixin/addon/help:snedit',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '查看我的助力',
                    'ctl' => 'rzps/weixin/addon/help:snlist',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'rzps/weixin/addon/help:goods',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'rzps/weixin/addon/help:goodsdelete',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'rzps/weixin/addon/help:goodsedit',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'rzps/weixin/addon/help:goodscreate',
                    'nav' => 'rzps/weixin/addon/help:index'
                ),
                array(
                    'title' => '微接力',
                    'ctl' => 'rzps/weixin/addon/relay:index',
                    'menu' => true
                ),
                array(
                    'title' => '微接力添加',
                    'ctl' => 'rzps/weixin/addon/relay:create',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力修改',
                    'ctl' => 'rzps/weixin/addon/relay:edit',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力删除',
                    'ctl' => 'rzps/weixin/addon/relay:delete',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力预览',
                    'ctl' => 'rzps/weixin/addon/relay:preview',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'rzps/weixin/addon/relay:sn',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'rzps/weixin/addon/relay:sndelete',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'rzps/weixin/addon/relay:snedit',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '查看我的接力',
                    'ctl' => 'rzps/weixin/addon/relay:snlist',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'rzps/weixin/addon/relay:goods',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'rzps/weixin/addon/relay:goodsdelete',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'rzps/weixin/addon/relay:goodsedit',
                    'nav' => 'rzps/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'rzps/weixin/addon/relay:goodscreate',
                    'nav' => 'rzps/weixin/addon/relay:index'
                )
            )
        )
    )
);
