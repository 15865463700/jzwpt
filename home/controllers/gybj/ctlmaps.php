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
                // array('title'=>'个人中心', 'ctl'=>'gybj/index:index', 'nav'=>'gybj/member:index'),
                // array('title'=>'个人中心', 'ctl'=>'gybj/member:index', 'menu'=>true),
                array(
                    'title' => '修改资料',
                    'ctl' => 'gybj/member:info',
                    'menu' => true
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'gybj/member:passwd',
                    'nav' => 'gybj/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'gybj/member:passwds',
                    'nav' => 'gybj/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'gybj/member:passwd1',
                    'nav' => 'gybj/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'gybj/member:passwd2',
                    'nav' => 'gybj/member:info'
                ),
                array(
                    'title' => '更换邮箱',
                    'ctl' => 'gybj/member:mail',
                    'nav' => 'gybj/member:info'
                ),
                array(
                    'title' => '修改头像',
                    'ctl' => 'gybj/member:face',
                    'nav' => 'gybj/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'gybj/member:upload',
                    'nav' => 'gybj/member:info'
                ),
                // array('title'=>'实名认证', 'ctl'=>'gybj/member/verify:name', 'menu'=>true),
                array(
                    'title' => '手机认证',
                    'ctl' => 'gybj/member/verify:mobile',
                    'nav' => 'gybj/member/verify:name'
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'gybj/member/verify:code',
                    'nav' => 'gybj/member/verify:name'
                ),
                array(
                    'title' => 'EMAIL认证',
                    'ctl' => 'gybj/member/verify:mail',
                    'nav' => 'gybj/member/verify:name'
                ),
                // array('title'=>'帐号绑定', 'ctl'=>'gybj/member:bindaccount', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'gybj/member:logs', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'gybj/member:home', 'menu'=>true),
                array(
                    'title' => '我的金币',
                    'ctl' => 'gybj/member:gold',
                    'nav' => 'gybj/member:logs'
                ),
                // array('title'=>'积分日志', 'ctl'=>'gybj/member:jflogs', 'menu'=>true),
                array(
                    'title' => '我的托管',
                    'ctl' => 'gybj/member:truste',
                    'nav' => 'gybj/member:trustelogs'
                ),
                // array('title'=>'分销链接', 'ctl'=>'gybj/member:fenxiao', 'menu'=>true),
                // array('title'=>'我的红包', 'ctl'=>'gybj/member/packet:items', 'menu'=>true),
                array(
                    'title' => '领取红包',
                    'ctl' => 'gybj/member/packet:create',
                    'nav' => 'gybj/packet:items'
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
                // array('title'=>'管理中心', 'ctl'=>'gybj/company:index', 'menu'=>true),
                array(
                    'title' => '公司设置',
                    'ctl' => 'gybj/company:info',
                    'menu' => true
                ),
                array(
                    'title' => '刷新置顶',
                    'ctl' => 'gybj/company:refresh',
                    'nav' => 'gybj/company:index'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'gybj/company:skin',
                    'nav' => 'gybj/company:info'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'gybj/company:domain',
                    'nav' => 'gybj/company:info'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'gybj/company/banner:index',
                    'nav' => 'gybj/company:info'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'gybj/company/banner:upload',
                    'nav' => 'gybj/company:info'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'gybj/company/banner:update',
                    'nav' => 'gybj/company:info'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'gybj/company/banner:delete',
                    'nav' => 'gybj/company:info'
                ),
                // array('title'=>'荣誉资质', 'ctl'=>'gybj/company/photo:index', 'menu'=>true),
                array(
                    'title' => '添加图片',
                    'ctl' => 'gybj/company/photo:create',
                    'nav' => 'gybj/company/photo:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'gybj/company/photo:update',
                    'nav' => 'gybj/company/photo:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'gybj/company/photo:delete',
                    'nav' => 'gybj/company/photo:index'
                ),
                // array('title'=>'团队管理', 'ctl'=>'gybj/company/team:index', 'menu'=>true),
                array(
                    'title' => '绑定设计师',
                    'ctl' => 'gybj/company/team:bind',
                    'nav' => 'gybj/company/team:index'
                ),
                array(
                    'title' => '解雇设计师',
                    'ctl' => 'gybj/company/team:unbind',
                    'nav' => 'gybj/company/team:index'
                ),
                array(
                    'title' => '企业新闻',
                    'ctl' => 'gybj/company/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '发布新闻',
                    'ctl' => 'gybj/company/news:create',
                    'nav' => 'gybj/company/news:index'
                ),
                array(
                    'title' => '编辑新闻',
                    'ctl' => 'gybj/company/news:edit',
                    'nav' => 'gybj/company/news:index'
                ),
                array(
                    'title' => '删除新闻',
                    'ctl' => 'gybj/company/news:delete',
                    'nav' => 'gybj/company/news:index'
                )
            )
        ),
        // array('title'=>'财务管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'财务管理', 'ctl'=>'gybj/company/money:company', 'menu'=>true),
        // array('title'=>'申请提现', 'ctl'=>'gybj/company/money:tixian', 'nav'=>'gybj/company/money:company'),
        // )
        // ),
        array(
            'title' => '装修案例',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '案例管理',
                    'ctl' => 'gybj/company/case:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加案例',
                    'ctl' => 'gybj/company/case:create',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '选择小区',
                    'ctl' => 'gybj/misc/select:home',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '选择户型图',
                    'ctl' => 'gybj/misc/select:huxing',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '编辑案例',
                    'ctl' => 'gybj/company/case:edit',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '案例图片',
                    'ctl' => 'gybj/company/case:detail',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '删除案例',
                    'ctl' => 'gybj/company/case:delete',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'gybj/company/case:update',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'gybj/company/case:upload',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'gybj/company/case:deletephoto',
                    'nav' => 'gybj/company/case:index'
                ),
                array(
                    'title' => '封面',
                    'ctl' => 'gybj/company/case:defaultphoto',
                    'nav' => 'gybj/company/case:index'
                )
            )
        ),
        
        // array('title'=>'在建工地', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'工地管理', 'ctl'=>'gybj/company/site:index', 'menu'=>true),
        // array('title'=>'发布工地', 'ctl'=>'gybj/company/site:create', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'修改工地', 'ctl'=>'gybj/company/site:edit', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'删除工地', 'ctl'=>'gybj/company/site:delete', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'选择小区', 'ctl'=>'gybj/misc/select:home', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'选择户型图', 'ctl'=>'gybj/misc/select:mycase', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'工地日记', 'ctl'=>'gybj/company/diary:site', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'发布日记', 'ctl'=>'gybj/company/diary:create', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'修改日记', 'ctl'=>'gybj/company/diary:edit', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'删除日记', 'ctl'=>'gybj/company/diary:delete', 'nav'=>'gybj/company/site:index'),
        // array('title'=>'项目管理', 'ctl'=>'gybj/company/zxpm:index', 'menu'=>true,'key'=>'zxpm'),
        // array('title'=>'项目管理', 'ctl'=>'gybj/company/zxpm:detail', 'nav'=>'gybj/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'gybj/company/zxpm:edit', 'nav'=>'gybj/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'gybj/company/zxpm:delete', 'nav'=>'gybj/company/zxpm:index','key'=>'zxpm'),
        // )
        // ),
        
        // array('title'=>'维修管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'维修投标', 'ctl'=>'gybj/misc/truste:index', 'menu'=>true),
        // array('title'=>'招标详情', 'ctl'=>'gybj/misc/truste:detail', 'nav'=>'gybj/misc/truste:index'),
        // array('title'=>'我要投标', 'ctl'=>'gybj/misc/truste:look', 'nav'=>'gybj/misc/truste:index'),
        // array('title'=>'维修竞标', 'ctl'=>'gybj/misc/truste:looked', 'menu'=>true),
        // array('title'=>'竞标跟踪', 'ctl'=>'gybj/misc/truste:track', 'nav'=>'gybj/misc/truste:looked'),
        // )
        // ),
        
        // array('title'=>'团装小区', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'团装小区', 'ctl'=>'gybj/company/tuan:index', 'menu'=>true),
        // array('title'=>'报名管理', 'ctl'=>'gybj/company/tuan:sign', 'nav'=>'gybj/company/tuan:index'),
        // array('title'=>'查看', 'ctl'=>'gybj/company/tuan:detail', 'nav'=>'gybj/company/tuan:index'),
        // )
        // ),
        
        // array('title'=>'优惠信息', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'优惠信息', 'ctl'=>'gybj/company/youhui:index', 'menu'=>true),
        // array('title'=>'刷新优惠', 'ctl'=>'gybj/company/youhui:refresh', 'nav'=>'gybj/company/youhui:index'),
        // array('title'=>'发布优惠', 'ctl'=>'gybj/company/youhui:create', 'nav'=>'gybj/company/youhui:index'),
        // array('title'=>'编辑优惠', 'ctl'=>'gybj/company/youhui:edit', 'nav'=>'gybj/company/youhui:index'),
        // array('title'=>'删除优惠', 'ctl'=>'gybj/company/youhui:delete', 'nav'=>'gybj/company/youhui:index'),
        // array('title'=>'报名查看', 'ctl'=>'gybj/company/youhui:youhuiSign', 'nav'=>'gybj/company/youhui:index'),
        // array('title'=>'查看报名', 'ctl'=>'gybj/company/youhui:sign', 'menu'=>true),
        // array('title'=>'报名详情', 'ctl'=>'gybj/company/youhui:signDetail', 'nav'=>'gybj/company/youhui:sign'),
        // array('title'=>'更新报名', 'ctl'=>'gybj/company/youhui:signSave', 'nav'=>'gybj/company/youhui:sign'),
        // )
        // ),
        array(
            'title' => '留言管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '点评管理',
                    'ctl' => 'gybj/company/comment:company',
                    'menu' => true
                ),
                array(
                    'title' => '查看点评',
                    'ctl' => 'gybj/company/comment:detail',
                    'nav' => 'gybj/company/comment:company'
                ),
                array(
                    'title' => '回复点评',
                    'ctl' => 'gybj/company/comment:reply',
                    'nav' => 'gybj/company/comment:company'
                )
            )
        )
    )
    // array('title'=>'预约管理', 'menu'=>true,
    // 'items'=>array(
    // array('title'=>'预约管理', 'ctl'=>'gybj/company/yuyue:company', 'menu'=>true),
    // array('title'=>'预约详情', 'ctl'=>'gybj/company/yuyue:detail', 'nav'=>'gybj/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'gybj/company/yuyue:save', 'nav'=>'gybj/company/yuyue:company'),
    // array('title'=>'预约设计师', 'ctl'=>'gybj/company/yuyue:designer', 'nav'=>'gybj/company/yuyue:company'),
    // array('title'=>'预约详情', 'ctl'=>'gybj/company/yuyue:designerDetail', 'nav'=>'gybj/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'gybj/company/yuyue:designerSave', 'nav'=>'gybj/company/yuyue:company'),
    //
    // array('title'=>'我要投标', 'ctl'=>'gybj/misc/tenders:index', 'menu'=>true),
    // array('title'=>'招标详情', 'ctl'=>'gybj/misc/tenders:detail', 'nav'=>'gybj/misc/tenders:index'),
    // array('title'=>'我要投标', 'ctl'=>'gybj/misc/tenders:look', 'nav'=>'gybj/misc/tenders:index'),
    // array('title'=>'我的竞标', 'ctl'=>'gybj/misc/tenders:looked', 'menu'=>true),
    // array('title'=>'竞标跟踪', 'ctl'=>'gybj/misc/tenders:track', 'nav'=>'gybj/misc/tenders:looked'),
    // array('title'=>'竞标留言', 'ctl'=>'gybj/misc/tenders:comment', 'nav'=>'gybj/misc/tenders:looked'),
    // array('title'=>'我的管家', 'ctl'=>'gybj/company/zxb:index', 'menu'=>true),
    // array('title'=>'查看装修保', 'ctl'=>'gybj/company/zxb:lists', 'nav'=>'gybj/company/zxb:index'),
    // array('title'=>'具体步骤', 'ctl'=>'gybj/company/zxb:detail', 'nav'=>'gybj/company/zxb:index'),
    // array('title'=>'用户确定预约', 'ctl'=>'gybj/company/zxb:look', 'nav'=>'gybj/company/zxb:index'),
    // array('title'=>'提交合同', 'ctl'=>'gybj/company/zxb:hetong', 'nav'=>'gybj/company/zxb:index'),
    // array('title'=>'我的投诉', 'ctl'=>'gybj/company/zxb:plaint', 'nav'=>'gybj/company/zxb:index'),
    // array('title'=>'我的投诉列表', 'ctl'=>'gybj/company/zxb:plaintlists', 'nav'=>'gybj/company/zxb:index'),
    // array('title'=>'投诉查看修改', 'ctl'=>'gybj/company/zxb:plaintedit', 'nav'=>'gybj/company/zxb:index'),
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
                    'ctl' => 'gybj/shop:index',
                    'menu' => true
                ),
                array(
                    'title' => '商铺设置',
                    'ctl' => 'gybj/shop:base',
                    'menu' => true
                ),
                array(
                    'title' => '资料设置',
                    'ctl' => 'gybj/shop:info',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'gybj/shop:domain',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => 'SEO设置',
                    'ctl' => 'gybj/shop:seo',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '购买说明',
                    'ctl' => 'gybj/shop:gmsm',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'gybj/shop:skin',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '商铺子分类',
                    'ctl' => 'gybj/shop:catechildren',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'gybj/shop/banner:index',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'gybj/shop/banner:upload',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'gybj/shop/banner:update',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'gybj/shop/banner:delete',
                    'nav' => 'gybj/shop:base'
                ),
                array(
                    'title' => '店铺资讯',
                    'ctl' => 'gybj/shop/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加资讯',
                    'ctl' => 'gybj/shop/news:create'
                ),
                array(
                    'title' => '修改资讯',
                    'ctl' => 'gybj/shop/news:edit'
                ),
                array(
                    'title' => '删除资讯',
                    'ctl' => 'gybj/shop/news:delete'
                ),
                array(
                    'title' => '门店管理',
                    'ctl' => 'gybj/shop/mendian:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加门店',
                    'ctl' => 'gybj/shop/mendian:create'
                ),
                array(
                    'title' => '修改门店',
                    'ctl' => 'gybj/shop/mendian:edit'
                ),
                array(
                    'title' => '删除门店',
                    'ctl' => 'gybj/shop/mendian:delete'
                ),
                array(
                    'title' => '刷新商铺',
                    'ctl' => 'gybj/shop:refresh',
                    'nav' => 'gybj/shop:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'gybj/shop/money:shop',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'gybj/shop/money:tixian',
                    'nav' => 'gybj/shop/money:shop'
                )
            )
        ),
        array(
            'title' => '商品管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺分类',
                    'ctl' => 'gybj/shop/vcate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'gybj/shop/vcate:create'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'gybj/shop/vcate:edit'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'gybj/shop/vcate:delete'
                ),
                array(
                    'title' => '商品管理',
                    'ctl' => 'gybj/product:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加商品',
                    'ctl' => 'gybj/product:create',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '修改商品',
                    'ctl' => 'gybj/product:edit',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '删除商品',
                    'ctl' => 'gybj/product:delete',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '商品图片',
                    'ctl' => 'gybj/product:photo',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'gybj/product:upload',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'gybj/product:deletephoto',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'gybj/product:updatephoto',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '商品规格',
                    'ctl' => 'gybj/product:spec',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '更新规格',
                    'ctl' => 'gybj/product:updatespec',
                    'nav' => 'gybj/product:index'
                ),
                array(
                    'title' => '删除规格',
                    'ctl' => 'gybj/product:deletespec',
                    'nav' => 'gybj/product:index'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'gybj/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'gybj/misc/truste:detail',
                    'nav' => 'gybj/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'gybj/misc/truste:look',
                    'nav' => 'gybj/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'gybj/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'gybj/misc/truste:track',
                    'nav' => 'gybj/misc/truste:looked'
                )
            )
        ),
        array(
            'title' => '评论管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺评论',
                    'ctl' => 'gybj/shop/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'gybj/shop/comment:detail',
                    'nav' => 'gybj/shop/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'gybj/shop/comment:reply',
                    'nav' => 'gybj/shop/comment:shop'
                ),
                array(
                    'title' => '商品评论',
                    'ctl' => 'gybj/product/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'gybj/product/comment:detail',
                    'nav' => 'gybj/product/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'gybj/product/comment:reply',
                    'nav' => 'gybj/product/comment:shop'
                )
            )
        ),
        array(
            'title' => '商铺订单',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商品订单',
                    'ctl' => 'gybj/shop/order:index',
                    'menu' => true
                ),
                array(
                    'title' => '订单详情',
                    'ctl' => 'gybj/shop/order:update',
                    'nav' => 'gybj/shop/order:index'
                ),
                array(
                    'title' => '预约管理',
                    'ctl' => 'gybj/shop/yuyue:shop',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'gybj/shop/yuyue:detail',
                    'nav' => 'gybj/shop/yuyue:shop'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'gybj/shop/yuyue:save',
                    'nav' => 'gybj/shop/yuyue:shop'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'gybj/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'gybj/misc/tenders:detail',
                    'nav' => 'gybj/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'gybj/misc/tenders:look',
                    'nav' => 'gybj/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'gybj/misc/tenders:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'gybj/misc/tenders:tracking',
                    'nav' => 'gybj/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'gybj/misc/tenders:track',
                    'nav' => 'gybj/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '优惠券',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '优惠券',
                    'ctl' => 'gybj/shop/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加优惠券',
                    'ctl' => 'gybj/shop/coupon:create',
                    'nav' => 'gybj/shop/coupon:index'
                ),
                array(
                    'title' => '修改优惠券',
                    'ctl' => 'gybj/shop/coupon:edit',
                    'nav' => 'gybj/shop/coupon:index'
                ),
                array(
                    'title' => '删除优惠券',
                    'ctl' => 'gybj/shop/coupon:delete',
                    'nav' => 'gybj/shop/coupon:index'
                ),
                array(
                    'title' => '下载日志',
                    'ctl' => 'gybj/shop/coupon:downloads',
                    'menu' => true
                ),
                array(
                    'title' => '日志详情',
                    'ctl' => 'gybj/shop/coupon:downloadDetail',
                    'nav' => 'gybj/shop/coupon:downloads'
                ),
                array(
                    'title' => '更新日志',
                    'ctl' => 'gybj/shop/coupon:downloadSave',
                    'nav' => 'gybj/shop/coupon:downloads'
                ),
                array(
                    'title' => '红包列表',
                    'ctl' => 'gybj/shop/packet:items',
                    'menu' => true
                ),
                array(
                    'title' => '发布红包',
                    'ctl' => 'gybj/shop/packet:create',
                    'nav' => 'gybj/shop/packet:items'
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
                    'ctl' => 'gybj/weixin:index',
                    'menu' => true
                ),
                array(
                    'title' => '公众号设置',
                    'ctl' => 'gybj/weixin:info',
                    'nav' => 'gybj/weixin:index'
                ),
                array(
                    'title' => '接口配置',
                    'ctl' => 'gybj/weixin:config',
                    'nav' => 'gybj/weixin:index'
                ),
                array(
                    'title' => '关注回复',
                    'ctl' => 'gybj/weixin:welcome',
                    'nav' => 'gybj/weixin:index'
                ),
                array(
                    'title' => '宣传页面',
                    'ctl' => 'gybj/weixin:leaflets',
                    'nav' => 'gybj/weixin:index'
                ),
                array(
                    'title' => '微信菜单',
                    'ctl' => 'gybj/weixin/menu:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加菜单',
                    'ctl' => 'gybj/weixin/menu:create',
                    'nav' => 'gybj/weixin/menu:index'
                ),
                array(
                    'title' => '修改菜单',
                    'ctl' => 'gybj/weixin/menu:edit',
                    'nav' => 'gybj/weixin/menu:index'
                ),
                array(
                    'title' => '删除菜单',
                    'ctl' => 'gybj/weixin/menu:delete',
                    'nav' => 'gybj/weixin/menu:index'
                ),
                array(
                    'title' => '同步到微信',
                    'ctl' => 'gybj/weixin/menu:towechat',
                    'nav' => 'gybj/weixin/menu:index'
                ),
                
                array(
                    'title' => '微信素材',
                    'ctl' => 'gybj/weixin/reply:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加素材',
                    'ctl' => 'gybj/weixin/reply:create',
                    'nav' => 'gybj/weixin/reply:index'
                ),
                array(
                    'title' => '修改素材',
                    'ctl' => 'gybj/weixin/reply:edit',
                    'nav' => 'gybj/weixin/reply:index'
                ),
                array(
                    'title' => '删除素材',
                    'ctl' => 'gybj/weixin/reply:delete',
                    'nav' => 'gybj/weixin/reply:index'
                ),
                array(
                    'title' => '选择素材',
                    'ctl' => 'gybj/weixin/reply:dialog',
                    'nav' => 'gybj/weixin/reply:index'
                ),
                array(
                    'title' => '关键字设置',
                    'ctl' => 'gybj/weixin/keyword:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加关键字',
                    'ctl' => 'gybj/weixin/keyword:create',
                    'nav' => 'gybj/weixin/keyword:index'
                ),
                array(
                    'title' => '修改关键字',
                    'ctl' => 'gybj/weixin/keyword:edit',
                    'nav' => 'gybj/weixin/keyword:index'
                ),
                array(
                    'title' => '删除关键字',
                    'ctl' => 'gybj/weixin/keyword:delete',
                    'nav' => 'gybj/weixin/keyword:index'
                )
            )
        ),
        array(
            'title' => '微网站',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '微网站',
                    'ctl' => 'gybj/weixin/msite:index',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'gybj/weixin/msite:tmpl',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'gybj/weixin/msite:access',
                    'nav' => 'gybj/weixin/msite:index'
                ),
                array(
                    'title' => '预览微官网',
                    'ctl' => 'gybj/weixin/msite/banner:index',
                    'nav' => 'gybj/weixin/msite:index'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'gybj/weixin/msite/banner:index',
                    'nav' => 'gybj/weixin/msite:index'
                ),
                array(
                    'title' => '上传广告',
                    'ctl' => 'gybj/weixin/msite/banner:upload',
                    'nav' => 'gybj/weixin/msite:index'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'gybj/weixin/msite/banner:update',
                    'nav' => 'gybj/weixin/msite:index'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'gybj/weixin/msite/banner:delete',
                    'nav' => 'gybj/weixin/msite:index'
                ),
                array(
                    'title' => '分类管理',
                    'ctl' => 'gybj/weixin/msite/cate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'gybj/weixin/msite/cate:create',
                    'nav' => 'gybj/weixin/msite/cate:index'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'gybj/weixin/msite/cate:edit',
                    'nav' => 'gybj/weixin/msite/cate:index'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'gybj/weixin/msite/cate:delete',
                    'nav' => 'gybj/weixin/msite/cate:index'
                ),
                array(
                    'title' => '文章管理',
                    'ctl' => 'gybj/weixin/msite/article:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加文章',
                    'ctl' => 'gybj/weixin/msite/article:create',
                    'nav' => 'gybj/weixin/msite/article:index'
                ),
                array(
                    'title' => '修改文章',
                    'ctl' => 'gybj/weixin/msite/article:edit',
                    'nav' => 'gybj/weixin/msite/article:index'
                ),
                array(
                    'title' => '删除文章',
                    'ctl' => 'gybj/weixin/msite/article:delete',
                    'nav' => 'gybj/weixin/msite/article:index'
                )
            )
        ),
		/*array('title'=>'分销管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'分销设置', 'ctl'=>'gybj/upm/task:index', 'menu'=>true),
                array('title'=>'设置分销', 'ctl'=>'gybj/upm/task:info', 'nav'=>'gybj/upm/task:index', 'key'=>'f_task'),
                array('title'=>'查看任务', 'ctl'=>'gybj/upm/task:detail', 'nav'=>'gybj/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分铺统计', 'ctl'=>'gybj/upm/task:count', 'nav'=>'gybj/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分销日志', 'ctl'=>'gybj/upm/tasklog:index', 'menu'=>true, 'key'=>'f_log'),
                array('title'=>'分销统计', 'ctl'=>'gybj/upm/tasklog:tongji', 'menu'=>true, 'key'=>'f_tongji'),
            )
        ),  */
        array(
            'title' => '微营销',
            'menu' => true,
            'items' => array(
                
                array(
                    'title' => '优惠券',
                    'ctl' => 'gybj/weixin/addon/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '优惠券添加',
                    'ctl' => 'gybj/weixin/addon/coupon:create',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券修改',
                    'ctl' => 'gybj/weixin/addon/coupon:edit',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券删除',
                    'ctl' => 'gybj/weixin/addon/coupon:delete',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券预览',
                    'ctl' => 'gybj/weixin/addon/coupon:preview',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券申请',
                    'ctl' => 'gybj/weixin/addon/coupon:sign',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券展示',
                    'ctl' => 'gybj/weixin/addon/coupon:show',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'gybj/weixin/addon/coupon:sn',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'gybj/weixin/addon/coupon:sndelete',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'gybj/weixin/addon/coupon:snedit',
                    'nav' => 'gybj/weixin/addon/coupon:index'
                ),
                
                array(
                    'title' => '刮刮卡',
                    'ctl' => 'gybj/weixin/addon/scratch:index',
                    'menu' => true
                ),
                array(
                    'title' => '刮刮卡添加',
                    'ctl' => 'gybj/weixin/addon/scratch:create',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡修改',
                    'ctl' => 'gybj/weixin/addon/scratch:edit',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡删除',
                    'ctl' => 'gybj/weixin/addon/scratch:delete',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡预览',
                    'ctl' => 'gybj/weixin/addon/scratch:preview',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'gybj/weixin/addon/scratch:sn',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'gybj/weixin/addon/scratch:sndelete',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'gybj/weixin/addon/scratch:snedit',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'gybj/weixin/addon/scratch:goods',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'gybj/weixin/addon/scratch:goodsdelete',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'gybj/weixin/addon/scratch:goodsedit',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'gybj/weixin/addon/scratch:goodscreate',
                    'nav' => 'gybj/weixin/addon/scratch:index'
                ),
                
                array(
                    'title' => '大转盘',
                    'ctl' => 'gybj/weixin/addon/lottery:index',
                    'menu' => true
                ),
                array(
                    'title' => '大转盘添加',
                    'ctl' => 'gybj/weixin/addon/lottery:create',
                    'nav' => 'gybj/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘修改',
                    'ctl' => 'gybj/weixin/addon/lottery:edit',
                    'nav' => 'gybj/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘删除',
                    'ctl' => 'gybj/weixin/addon/lottery:delete',
                    'nav' => 'gybj/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘预览',
                    'ctl' => 'gybj/weixin/addon/lottery:preview',
                    'nav' => 'gybj/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'gybj/weixin/addon/lottery:sn',
                    'nav' => 'gybj/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'gybj/weixin/addon/lottery:sndelete',
                    'nav' => 'gybj/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'gybj/weixin/addon/lottery:snedit',
                    'nav' => 'gybj/weixin/addon/lottery:index'
                ),
                
                array(
                    'title' => '砸金蛋',
                    'ctl' => 'gybj/weixin/addon/goldegg:index',
                    'menu' => true
                ),
                array(
                    'title' => '砸金蛋添加',
                    'ctl' => 'gybj/weixin/addon/goldegg:create',
                    'nav' => 'gybj/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋修改',
                    'ctl' => 'gybj/weixin/addon/goldegg:edit',
                    'nav' => 'gybj/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋删除',
                    'ctl' => 'gybj/weixin/addon/goldegg:delete',
                    'nav' => 'gybj/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋预览',
                    'ctl' => 'gybj/weixin/addon/goldegg:preview',
                    'nav' => 'gybj/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'gybj/weixin/addon/goldegg:sn',
                    'nav' => 'gybj/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'gybj/weixin/addon/goldegg:sndelete',
                    'nav' => 'gybj/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'gybj/weixin/addon/goldegg:snedit',
                    'nav' => 'gybj/weixin/addon/goldegg:index'
                ),
                
                array(
                    'title' => '红包',
                    'ctl' => 'gybj/weixin/addon/packet:index',
                    'menu' => true
                ),
                array(
                    'title' => '红包添加',
                    'ctl' => 'gybj/weixin/addon/packet:create',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包修改',
                    'ctl' => 'gybj/weixin/addon/packet:edit',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包删除',
                    'ctl' => 'gybj/weixin/addon/packet:delete',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包预览',
                    'ctl' => 'gybj/weixin/addon/packet:preview',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'gybj/weixin/addon/packet:sn',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'gybj/weixin/addon/packet:sndelete',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'gybj/weixin/addon/packet:logs',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'gybj/weixin/addon/packet:logsdelete',
                    'nav' => 'gybj/weixin/addon/packet:index'
                ),
                
                array(
                    'title' => '卡劵',
                    'ctl' => 'gybj/weixin/addon/card:index',
                    'menu' => true
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'gybj/weixin/addon/card:get_card',
                    'nav' => 'gybj/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'gybj/weixin/addon/card:wxqrcode',
                    'nav' => 'gybj/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'gybj/weixin/addon/card:show',
                    'nav' => 'gybj/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'gybj/weixin/addon/card:wxqrcode2',
                    'nav' => 'gybj/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵核销',
                    'ctl' => 'gybj/weixin/addon/card:consume',
                    'nav' => 'gybj/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵删除',
                    'ctl' => 'gybj/weixin/addon/card:delete_card',
                    'nav' => 'gybj/weixin/addon/card:index'
                ),
                
                array(
                    'title' => '摇一摇',
                    'ctl' => 'gybj/weixin/addon/shake:index',
                    'menu' => true
                ),
                array(
                    'title' => '摇一摇添加',
                    'ctl' => 'gybj/weixin/addon/shake:create',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇修改',
                    'ctl' => 'gybj/weixin/addon/shake:edit',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇删除',
                    'ctl' => 'gybj/weixin/addon/shake:delete',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇预览',
                    'ctl' => 'gybj/weixin/addon/shake:preview',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'gybj/weixin/addon/shake:sn',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'gybj/weixin/addon/shake:sndelete',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'gybj/weixin/addon/shake:snedit',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'gybj/weixin/addon/shake:goods',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'gybj/weixin/addon/shake:goodsdelete',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'gybj/weixin/addon/shake:goodsedit',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'gybj/weixin/addon/shake:goodscreate',
                    'nav' => 'gybj/weixin/addon/shake:index'
                ),
                array(
                    'title' => '微助力',
                    'ctl' => 'gybj/weixin/addon/help:index',
                    'menu' => true
                ),
                array(
                    'title' => '微助力添加',
                    'ctl' => 'gybj/weixin/addon/help:create',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力修改',
                    'ctl' => 'gybj/weixin/addon/help:edit',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力删除',
                    'ctl' => 'gybj/weixin/addon/help:delete',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力预览',
                    'ctl' => 'gybj/weixin/addon/help:preview',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'gybj/weixin/addon/help:sn',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'gybj/weixin/addon/help:sndelete',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'gybj/weixin/addon/help:snedit',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '查看我的助力',
                    'ctl' => 'gybj/weixin/addon/help:snlist',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'gybj/weixin/addon/help:goods',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'gybj/weixin/addon/help:goodsdelete',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'gybj/weixin/addon/help:goodsedit',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'gybj/weixin/addon/help:goodscreate',
                    'nav' => 'gybj/weixin/addon/help:index'
                ),
                array(
                    'title' => '微接力',
                    'ctl' => 'gybj/weixin/addon/relay:index',
                    'menu' => true
                ),
                array(
                    'title' => '微接力添加',
                    'ctl' => 'gybj/weixin/addon/relay:create',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力修改',
                    'ctl' => 'gybj/weixin/addon/relay:edit',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力删除',
                    'ctl' => 'gybj/weixin/addon/relay:delete',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力预览',
                    'ctl' => 'gybj/weixin/addon/relay:preview',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'gybj/weixin/addon/relay:sn',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'gybj/weixin/addon/relay:sndelete',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'gybj/weixin/addon/relay:snedit',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '查看我的接力',
                    'ctl' => 'gybj/weixin/addon/relay:snlist',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'gybj/weixin/addon/relay:goods',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'gybj/weixin/addon/relay:goodsdelete',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'gybj/weixin/addon/relay:goodsedit',
                    'nav' => 'gybj/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'gybj/weixin/addon/relay:goodscreate',
                    'nav' => 'gybj/weixin/addon/relay:index'
                )
            )
        )
    )
);
