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
                // array('title'=>'个人中心', 'ctl'=>'jtyjy/index:index', 'nav'=>'jtyjy/member:index'),
                // array('title'=>'个人中心', 'ctl'=>'jtyjy/member:index', 'menu'=>true),
                array(
                    'title' => '修改资料',
                    'ctl' => 'jtyjy/member:info',
                    'menu' => true
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'jtyjy/member:passwd',
                    'nav' => 'jtyjy/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'jtyjy/member:passwds',
                    'nav' => 'jtyjy/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'jtyjy/member:passwd1',
                    'nav' => 'jtyjy/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'jtyjy/member:passwd2',
                    'nav' => 'jtyjy/member:info'
                ),
                array(
                    'title' => '更换邮箱',
                    'ctl' => 'jtyjy/member:mail',
                    'nav' => 'jtyjy/member:info'
                ),
                array(
                    'title' => '修改头像',
                    'ctl' => 'jtyjy/member:face',
                    'nav' => 'jtyjy/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'jtyjy/member:upload',
                    'nav' => 'jtyjy/member:info'
                ),
                // array('title'=>'实名认证', 'ctl'=>'jtyjy/member/verify:name', 'menu'=>true),
                array(
                    'title' => '手机认证',
                    'ctl' => 'jtyjy/member/verify:mobile',
                    'nav' => 'jtyjy/member/verify:name'
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'jtyjy/member/verify:code',
                    'nav' => 'jtyjy/member/verify:name'
                ),
                array(
                    'title' => 'EMAIL认证',
                    'ctl' => 'jtyjy/member/verify:mail',
                    'nav' => 'jtyjy/member/verify:name'
                ),
                // array('title'=>'帐号绑定', 'ctl'=>'jtyjy/member:bindaccount', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'jtyjy/member:logs', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'jtyjy/member:home', 'menu'=>true),
                array(
                    'title' => '我的金币',
                    'ctl' => 'jtyjy/member:gold',
                    'nav' => 'jtyjy/member:logs'
                ),
                // array('title'=>'积分日志', 'ctl'=>'jtyjy/member:jflogs', 'menu'=>true),
                array(
                    'title' => '我的托管',
                    'ctl' => 'jtyjy/member:truste',
                    'nav' => 'jtyjy/member:trustelogs'
                ),
                // array('title'=>'分销链接', 'ctl'=>'jtyjy/member:fenxiao', 'menu'=>true),
                // array('title'=>'我的红包', 'ctl'=>'jtyjy/member/packet:items', 'menu'=>true),
                array(
                    'title' => '领取红包',
                    'ctl' => 'jtyjy/member/packet:create',
                    'nav' => 'jtyjy/packet:items'
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
                // array('title'=>'管理中心', 'ctl'=>'jtyjy/company:index', 'menu'=>true),
                array(
                    'title' => '公司设置',
                    'ctl' => 'jtyjy/company:info',
                    'menu' => true
                ),
                array(
                    'title' => '刷新置顶',
                    'ctl' => 'jtyjy/company:refresh',
                    'nav' => 'jtyjy/company:index'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'jtyjy/company:skin',
                    'nav' => 'jtyjy/company:info'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'jtyjy/company:domain',
                    'nav' => 'jtyjy/company:info'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'jtyjy/company/banner:index',
                    'nav' => 'jtyjy/company:info'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'jtyjy/company/banner:upload',
                    'nav' => 'jtyjy/company:info'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'jtyjy/company/banner:update',
                    'nav' => 'jtyjy/company:info'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'jtyjy/company/banner:delete',
                    'nav' => 'jtyjy/company:info'
                ),
                // array('title'=>'荣誉资质', 'ctl'=>'jtyjy/company/photo:index', 'menu'=>true),
                array(
                    'title' => '添加图片',
                    'ctl' => 'jtyjy/company/photo:create',
                    'nav' => 'jtyjy/company/photo:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'jtyjy/company/photo:update',
                    'nav' => 'jtyjy/company/photo:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'jtyjy/company/photo:delete',
                    'nav' => 'jtyjy/company/photo:index'
                ),
                // array('title'=>'团队管理', 'ctl'=>'jtyjy/company/team:index', 'menu'=>true),
                array(
                    'title' => '绑定设计师',
                    'ctl' => 'jtyjy/company/team:bind',
                    'nav' => 'jtyjy/company/team:index'
                ),
                array(
                    'title' => '解雇设计师',
                    'ctl' => 'jtyjy/company/team:unbind',
                    'nav' => 'jtyjy/company/team:index'
                ),
                array(
                    'title' => '企业新闻',
                    'ctl' => 'jtyjy/company/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '发布新闻',
                    'ctl' => 'jtyjy/company/news:create',
                    'nav' => 'jtyjy/company/news:index'
                ),
                array(
                    'title' => '编辑新闻',
                    'ctl' => 'jtyjy/company/news:edit',
                    'nav' => 'jtyjy/company/news:index'
                ),
                array(
                    'title' => '删除新闻',
                    'ctl' => 'jtyjy/company/news:delete',
                    'nav' => 'jtyjy/company/news:index'
                )
            )
        ),
        // array('title'=>'财务管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'财务管理', 'ctl'=>'jtyjy/company/money:company', 'menu'=>true),
        // array('title'=>'申请提现', 'ctl'=>'jtyjy/company/money:tixian', 'nav'=>'jtyjy/company/money:company'),
        // )
        // ),
        array(
            'title' => '装修案例',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '案例管理',
                    'ctl' => 'jtyjy/company/case:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加案例',
                    'ctl' => 'jtyjy/company/case:create',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '选择小区',
                    'ctl' => 'jtyjy/misc/select:home',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '选择户型图',
                    'ctl' => 'jtyjy/misc/select:huxing',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '编辑案例',
                    'ctl' => 'jtyjy/company/case:edit',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '案例图片',
                    'ctl' => 'jtyjy/company/case:detail',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '删除案例',
                    'ctl' => 'jtyjy/company/case:delete',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'jtyjy/company/case:update',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'jtyjy/company/case:upload',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'jtyjy/company/case:deletephoto',
                    'nav' => 'jtyjy/company/case:index'
                ),
                array(
                    'title' => '封面',
                    'ctl' => 'jtyjy/company/case:defaultphoto',
                    'nav' => 'jtyjy/company/case:index'
                )
            )
        ),
        
        // array('title'=>'在建工地', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'工地管理', 'ctl'=>'jtyjy/company/site:index', 'menu'=>true),
        // array('title'=>'发布工地', 'ctl'=>'jtyjy/company/site:create', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'修改工地', 'ctl'=>'jtyjy/company/site:edit', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'删除工地', 'ctl'=>'jtyjy/company/site:delete', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'选择小区', 'ctl'=>'jtyjy/misc/select:home', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'选择户型图', 'ctl'=>'jtyjy/misc/select:mycase', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'工地日记', 'ctl'=>'jtyjy/company/diary:site', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'发布日记', 'ctl'=>'jtyjy/company/diary:create', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'修改日记', 'ctl'=>'jtyjy/company/diary:edit', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'删除日记', 'ctl'=>'jtyjy/company/diary:delete', 'nav'=>'jtyjy/company/site:index'),
        // array('title'=>'项目管理', 'ctl'=>'jtyjy/company/zxpm:index', 'menu'=>true,'key'=>'zxpm'),
        // array('title'=>'项目管理', 'ctl'=>'jtyjy/company/zxpm:detail', 'nav'=>'jtyjy/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'jtyjy/company/zxpm:edit', 'nav'=>'jtyjy/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'jtyjy/company/zxpm:delete', 'nav'=>'jtyjy/company/zxpm:index','key'=>'zxpm'),
        // )
        // ),
        
        // array('title'=>'维修管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'维修投标', 'ctl'=>'jtyjy/misc/truste:index', 'menu'=>true),
        // array('title'=>'招标详情', 'ctl'=>'jtyjy/misc/truste:detail', 'nav'=>'jtyjy/misc/truste:index'),
        // array('title'=>'我要投标', 'ctl'=>'jtyjy/misc/truste:look', 'nav'=>'jtyjy/misc/truste:index'),
        // array('title'=>'维修竞标', 'ctl'=>'jtyjy/misc/truste:looked', 'menu'=>true),
        // array('title'=>'竞标跟踪', 'ctl'=>'jtyjy/misc/truste:track', 'nav'=>'jtyjy/misc/truste:looked'),
        // )
        // ),
        
        // array('title'=>'团装小区', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'团装小区', 'ctl'=>'jtyjy/company/tuan:index', 'menu'=>true),
        // array('title'=>'报名管理', 'ctl'=>'jtyjy/company/tuan:sign', 'nav'=>'jtyjy/company/tuan:index'),
        // array('title'=>'查看', 'ctl'=>'jtyjy/company/tuan:detail', 'nav'=>'jtyjy/company/tuan:index'),
        // )
        // ),
        
        // array('title'=>'优惠信息', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'优惠信息', 'ctl'=>'jtyjy/company/youhui:index', 'menu'=>true),
        // array('title'=>'刷新优惠', 'ctl'=>'jtyjy/company/youhui:refresh', 'nav'=>'jtyjy/company/youhui:index'),
        // array('title'=>'发布优惠', 'ctl'=>'jtyjy/company/youhui:create', 'nav'=>'jtyjy/company/youhui:index'),
        // array('title'=>'编辑优惠', 'ctl'=>'jtyjy/company/youhui:edit', 'nav'=>'jtyjy/company/youhui:index'),
        // array('title'=>'删除优惠', 'ctl'=>'jtyjy/company/youhui:delete', 'nav'=>'jtyjy/company/youhui:index'),
        // array('title'=>'报名查看', 'ctl'=>'jtyjy/company/youhui:youhuiSign', 'nav'=>'jtyjy/company/youhui:index'),
        // array('title'=>'查看报名', 'ctl'=>'jtyjy/company/youhui:sign', 'menu'=>true),
        // array('title'=>'报名详情', 'ctl'=>'jtyjy/company/youhui:signDetail', 'nav'=>'jtyjy/company/youhui:sign'),
        // array('title'=>'更新报名', 'ctl'=>'jtyjy/company/youhui:signSave', 'nav'=>'jtyjy/company/youhui:sign'),
        // )
        // ),
        array(
            'title' => '留言管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '点评管理',
                    'ctl' => 'jtyjy/company/comment:company',
                    'menu' => true
                ),
                array(
                    'title' => '查看点评',
                    'ctl' => 'jtyjy/company/comment:detail',
                    'nav' => 'jtyjy/company/comment:company'
                ),
                array(
                    'title' => '回复点评',
                    'ctl' => 'jtyjy/company/comment:reply',
                    'nav' => 'jtyjy/company/comment:company'
                )
            )
        )
    )
    // array('title'=>'预约管理', 'menu'=>true,
    // 'items'=>array(
    // array('title'=>'预约管理', 'ctl'=>'jtyjy/company/yuyue:company', 'menu'=>true),
    // array('title'=>'预约详情', 'ctl'=>'jtyjy/company/yuyue:detail', 'nav'=>'jtyjy/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'jtyjy/company/yuyue:save', 'nav'=>'jtyjy/company/yuyue:company'),
    // array('title'=>'预约设计师', 'ctl'=>'jtyjy/company/yuyue:designer', 'nav'=>'jtyjy/company/yuyue:company'),
    // array('title'=>'预约详情', 'ctl'=>'jtyjy/company/yuyue:designerDetail', 'nav'=>'jtyjy/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'jtyjy/company/yuyue:designerSave', 'nav'=>'jtyjy/company/yuyue:company'),
    //
    // array('title'=>'我要投标', 'ctl'=>'jtyjy/misc/tenders:index', 'menu'=>true),
    // array('title'=>'招标详情', 'ctl'=>'jtyjy/misc/tenders:detail', 'nav'=>'jtyjy/misc/tenders:index'),
    // array('title'=>'我要投标', 'ctl'=>'jtyjy/misc/tenders:look', 'nav'=>'jtyjy/misc/tenders:index'),
    // array('title'=>'我的竞标', 'ctl'=>'jtyjy/misc/tenders:looked', 'menu'=>true),
    // array('title'=>'竞标跟踪', 'ctl'=>'jtyjy/misc/tenders:track', 'nav'=>'jtyjy/misc/tenders:looked'),
    // array('title'=>'竞标留言', 'ctl'=>'jtyjy/misc/tenders:comment', 'nav'=>'jtyjy/misc/tenders:looked'),
    // array('title'=>'我的管家', 'ctl'=>'jtyjy/company/zxb:index', 'menu'=>true),
    // array('title'=>'查看装修保', 'ctl'=>'jtyjy/company/zxb:lists', 'nav'=>'jtyjy/company/zxb:index'),
    // array('title'=>'具体步骤', 'ctl'=>'jtyjy/company/zxb:detail', 'nav'=>'jtyjy/company/zxb:index'),
    // array('title'=>'用户确定预约', 'ctl'=>'jtyjy/company/zxb:look', 'nav'=>'jtyjy/company/zxb:index'),
    // array('title'=>'提交合同', 'ctl'=>'jtyjy/company/zxb:hetong', 'nav'=>'jtyjy/company/zxb:index'),
    // array('title'=>'我的投诉', 'ctl'=>'jtyjy/company/zxb:plaint', 'nav'=>'jtyjy/company/zxb:index'),
    // array('title'=>'我的投诉列表', 'ctl'=>'jtyjy/company/zxb:plaintlists', 'nav'=>'jtyjy/company/zxb:index'),
    // array('title'=>'投诉查看修改', 'ctl'=>'jtyjy/company/zxb:plaintedit', 'nav'=>'jtyjy/company/zxb:index'),
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
                    'ctl' => 'jtyjy/shop:index',
                    'menu' => true
                ),
                array(
                    'title' => '商铺设置',
                    'ctl' => 'jtyjy/shop:base',
                    'menu' => true
                ),
                array(
                    'title' => '资料设置',
                    'ctl' => 'jtyjy/shop:info',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'jtyjy/shop:domain',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => 'SEO设置',
                    'ctl' => 'jtyjy/shop:seo',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '购买说明',
                    'ctl' => 'jtyjy/shop:gmsm',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'jtyjy/shop:skin',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '商铺子分类',
                    'ctl' => 'jtyjy/shop:catechildren',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'jtyjy/shop/banner:index',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'jtyjy/shop/banner:upload',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'jtyjy/shop/banner:update',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'jtyjy/shop/banner:delete',
                    'nav' => 'jtyjy/shop:base'
                ),
                array(
                    'title' => '店铺资讯',
                    'ctl' => 'jtyjy/shop/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加资讯',
                    'ctl' => 'jtyjy/shop/news:create'
                ),
                array(
                    'title' => '修改资讯',
                    'ctl' => 'jtyjy/shop/news:edit'
                ),
                array(
                    'title' => '删除资讯',
                    'ctl' => 'jtyjy/shop/news:delete'
                ),
                array(
                    'title' => '门店管理',
                    'ctl' => 'jtyjy/shop/mendian:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加门店',
                    'ctl' => 'jtyjy/shop/mendian:create'
                ),
                array(
                    'title' => '修改门店',
                    'ctl' => 'jtyjy/shop/mendian:edit'
                ),
                array(
                    'title' => '删除门店',
                    'ctl' => 'jtyjy/shop/mendian:delete'
                ),
                array(
                    'title' => '刷新商铺',
                    'ctl' => 'jtyjy/shop:refresh',
                    'nav' => 'jtyjy/shop:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'jtyjy/shop/money:shop',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'jtyjy/shop/money:tixian',
                    'nav' => 'jtyjy/shop/money:shop'
                )
            )
        ),
        array(
            'title' => '商品管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺分类',
                    'ctl' => 'jtyjy/shop/vcate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'jtyjy/shop/vcate:create'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'jtyjy/shop/vcate:edit'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'jtyjy/shop/vcate:delete'
                ),
                array(
                    'title' => '商品管理',
                    'ctl' => 'jtyjy/product:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加商品',
                    'ctl' => 'jtyjy/product:create',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '修改商品',
                    'ctl' => 'jtyjy/product:edit',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '删除商品',
                    'ctl' => 'jtyjy/product:delete',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '商品图片',
                    'ctl' => 'jtyjy/product:photo',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'jtyjy/product:upload',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'jtyjy/product:deletephoto',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'jtyjy/product:updatephoto',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '商品规格',
                    'ctl' => 'jtyjy/product:spec',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '更新规格',
                    'ctl' => 'jtyjy/product:updatespec',
                    'nav' => 'jtyjy/product:index'
                ),
                array(
                    'title' => '删除规格',
                    'ctl' => 'jtyjy/product:deletespec',
                    'nav' => 'jtyjy/product:index'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'jtyjy/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'jtyjy/misc/truste:detail',
                    'nav' => 'jtyjy/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'jtyjy/misc/truste:look',
                    'nav' => 'jtyjy/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'jtyjy/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'jtyjy/misc/truste:track',
                    'nav' => 'jtyjy/misc/truste:looked'
                )
            )
        ),
        array(
            'title' => '评论管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺评论',
                    'ctl' => 'jtyjy/shop/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'jtyjy/shop/comment:detail',
                    'nav' => 'jtyjy/shop/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'jtyjy/shop/comment:reply',
                    'nav' => 'jtyjy/shop/comment:shop'
                ),
                array(
                    'title' => '商品评论',
                    'ctl' => 'jtyjy/product/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'jtyjy/product/comment:detail',
                    'nav' => 'jtyjy/product/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'jtyjy/product/comment:reply',
                    'nav' => 'jtyjy/product/comment:shop'
                )
            )
        ),
        array(
            'title' => '商铺订单',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商品订单',
                    'ctl' => 'jtyjy/shop/order:index',
                    'menu' => true
                ),
                array(
                    'title' => '订单详情',
                    'ctl' => 'jtyjy/shop/order:update',
                    'nav' => 'jtyjy/shop/order:index'
                ),
                array(
                    'title' => '预约管理',
                    'ctl' => 'jtyjy/shop/yuyue:shop',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'jtyjy/shop/yuyue:detail',
                    'nav' => 'jtyjy/shop/yuyue:shop'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'jtyjy/shop/yuyue:save',
                    'nav' => 'jtyjy/shop/yuyue:shop'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'jtyjy/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'jtyjy/misc/tenders:detail',
                    'nav' => 'jtyjy/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'jtyjy/misc/tenders:look',
                    'nav' => 'jtyjy/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'jtyjy/misc/tenders:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'jtyjy/misc/tenders:tracking',
                    'nav' => 'jtyjy/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'jtyjy/misc/tenders:track',
                    'nav' => 'jtyjy/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '优惠券',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '优惠券',
                    'ctl' => 'jtyjy/shop/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加优惠券',
                    'ctl' => 'jtyjy/shop/coupon:create',
                    'nav' => 'jtyjy/shop/coupon:index'
                ),
                array(
                    'title' => '修改优惠券',
                    'ctl' => 'jtyjy/shop/coupon:edit',
                    'nav' => 'jtyjy/shop/coupon:index'
                ),
                array(
                    'title' => '删除优惠券',
                    'ctl' => 'jtyjy/shop/coupon:delete',
                    'nav' => 'jtyjy/shop/coupon:index'
                ),
                array(
                    'title' => '下载日志',
                    'ctl' => 'jtyjy/shop/coupon:downloads',
                    'menu' => true
                ),
                array(
                    'title' => '日志详情',
                    'ctl' => 'jtyjy/shop/coupon:downloadDetail',
                    'nav' => 'jtyjy/shop/coupon:downloads'
                ),
                array(
                    'title' => '更新日志',
                    'ctl' => 'jtyjy/shop/coupon:downloadSave',
                    'nav' => 'jtyjy/shop/coupon:downloads'
                ),
                array(
                    'title' => '红包列表',
                    'ctl' => 'jtyjy/shop/packet:items',
                    'menu' => true
                ),
                array(
                    'title' => '发布红包',
                    'ctl' => 'jtyjy/shop/packet:create',
                    'nav' => 'jtyjy/shop/packet:items'
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
                    'ctl' => 'jtyjy/weixin:index',
                    'menu' => true
                ),
                array(
                    'title' => '公众号设置',
                    'ctl' => 'jtyjy/weixin:info',
                    'nav' => 'jtyjy/weixin:index'
                ),
                array(
                    'title' => '接口配置',
                    'ctl' => 'jtyjy/weixin:config',
                    'nav' => 'jtyjy/weixin:index'
                ),
                array(
                    'title' => '关注回复',
                    'ctl' => 'jtyjy/weixin:welcome',
                    'nav' => 'jtyjy/weixin:index'
                ),
                array(
                    'title' => '宣传页面',
                    'ctl' => 'jtyjy/weixin:leaflets',
                    'nav' => 'jtyjy/weixin:index'
                ),
                array(
                    'title' => '微信菜单',
                    'ctl' => 'jtyjy/weixin/menu:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加菜单',
                    'ctl' => 'jtyjy/weixin/menu:create',
                    'nav' => 'jtyjy/weixin/menu:index'
                ),
                array(
                    'title' => '修改菜单',
                    'ctl' => 'jtyjy/weixin/menu:edit',
                    'nav' => 'jtyjy/weixin/menu:index'
                ),
                array(
                    'title' => '删除菜单',
                    'ctl' => 'jtyjy/weixin/menu:delete',
                    'nav' => 'jtyjy/weixin/menu:index'
                ),
                array(
                    'title' => '同步到微信',
                    'ctl' => 'jtyjy/weixin/menu:towechat',
                    'nav' => 'jtyjy/weixin/menu:index'
                ),
                
                array(
                    'title' => '微信素材',
                    'ctl' => 'jtyjy/weixin/reply:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加素材',
                    'ctl' => 'jtyjy/weixin/reply:create',
                    'nav' => 'jtyjy/weixin/reply:index'
                ),
                array(
                    'title' => '修改素材',
                    'ctl' => 'jtyjy/weixin/reply:edit',
                    'nav' => 'jtyjy/weixin/reply:index'
                ),
                array(
                    'title' => '删除素材',
                    'ctl' => 'jtyjy/weixin/reply:delete',
                    'nav' => 'jtyjy/weixin/reply:index'
                ),
                array(
                    'title' => '选择素材',
                    'ctl' => 'jtyjy/weixin/reply:dialog',
                    'nav' => 'jtyjy/weixin/reply:index'
                ),
                array(
                    'title' => '关键字设置',
                    'ctl' => 'jtyjy/weixin/keyword:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加关键字',
                    'ctl' => 'jtyjy/weixin/keyword:create',
                    'nav' => 'jtyjy/weixin/keyword:index'
                ),
                array(
                    'title' => '修改关键字',
                    'ctl' => 'jtyjy/weixin/keyword:edit',
                    'nav' => 'jtyjy/weixin/keyword:index'
                ),
                array(
                    'title' => '删除关键字',
                    'ctl' => 'jtyjy/weixin/keyword:delete',
                    'nav' => 'jtyjy/weixin/keyword:index'
                )
            )
        ),
        array(
            'title' => '微网站',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '微网站',
                    'ctl' => 'jtyjy/weixin/msite:index',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'jtyjy/weixin/msite:tmpl',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'jtyjy/weixin/msite:access',
                    'nav' => 'jtyjy/weixin/msite:index'
                ),
                array(
                    'title' => '预览微官网',
                    'ctl' => 'jtyjy/weixin/msite/banner:index',
                    'nav' => 'jtyjy/weixin/msite:index'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'jtyjy/weixin/msite/banner:index',
                    'nav' => 'jtyjy/weixin/msite:index'
                ),
                array(
                    'title' => '上传广告',
                    'ctl' => 'jtyjy/weixin/msite/banner:upload',
                    'nav' => 'jtyjy/weixin/msite:index'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'jtyjy/weixin/msite/banner:update',
                    'nav' => 'jtyjy/weixin/msite:index'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'jtyjy/weixin/msite/banner:delete',
                    'nav' => 'jtyjy/weixin/msite:index'
                ),
                array(
                    'title' => '分类管理',
                    'ctl' => 'jtyjy/weixin/msite/cate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'jtyjy/weixin/msite/cate:create',
                    'nav' => 'jtyjy/weixin/msite/cate:index'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'jtyjy/weixin/msite/cate:edit',
                    'nav' => 'jtyjy/weixin/msite/cate:index'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'jtyjy/weixin/msite/cate:delete',
                    'nav' => 'jtyjy/weixin/msite/cate:index'
                ),
                array(
                    'title' => '文章管理',
                    'ctl' => 'jtyjy/weixin/msite/article:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加文章',
                    'ctl' => 'jtyjy/weixin/msite/article:create',
                    'nav' => 'jtyjy/weixin/msite/article:index'
                ),
                array(
                    'title' => '修改文章',
                    'ctl' => 'jtyjy/weixin/msite/article:edit',
                    'nav' => 'jtyjy/weixin/msite/article:index'
                ),
                array(
                    'title' => '删除文章',
                    'ctl' => 'jtyjy/weixin/msite/article:delete',
                    'nav' => 'jtyjy/weixin/msite/article:index'
                )
            )
        ),
		/*array('title'=>'分销管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'分销设置', 'ctl'=>'jtyjy/upm/task:index', 'menu'=>true),
                array('title'=>'设置分销', 'ctl'=>'jtyjy/upm/task:info', 'nav'=>'jtyjy/upm/task:index', 'key'=>'f_task'),
                array('title'=>'查看任务', 'ctl'=>'jtyjy/upm/task:detail', 'nav'=>'jtyjy/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分铺统计', 'ctl'=>'jtyjy/upm/task:count', 'nav'=>'jtyjy/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分销日志', 'ctl'=>'jtyjy/upm/tasklog:index', 'menu'=>true, 'key'=>'f_log'),
                array('title'=>'分销统计', 'ctl'=>'jtyjy/upm/tasklog:tongji', 'menu'=>true, 'key'=>'f_tongji'),
            )
        ),  */
        array(
            'title' => '微营销',
            'menu' => true,
            'items' => array(
                
                array(
                    'title' => '优惠券',
                    'ctl' => 'jtyjy/weixin/addon/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '优惠券添加',
                    'ctl' => 'jtyjy/weixin/addon/coupon:create',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券修改',
                    'ctl' => 'jtyjy/weixin/addon/coupon:edit',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券删除',
                    'ctl' => 'jtyjy/weixin/addon/coupon:delete',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券预览',
                    'ctl' => 'jtyjy/weixin/addon/coupon:preview',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券申请',
                    'ctl' => 'jtyjy/weixin/addon/coupon:sign',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券展示',
                    'ctl' => 'jtyjy/weixin/addon/coupon:show',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'jtyjy/weixin/addon/coupon:sn',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'jtyjy/weixin/addon/coupon:sndelete',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'jtyjy/weixin/addon/coupon:snedit',
                    'nav' => 'jtyjy/weixin/addon/coupon:index'
                ),
                
                array(
                    'title' => '刮刮卡',
                    'ctl' => 'jtyjy/weixin/addon/scratch:index',
                    'menu' => true
                ),
                array(
                    'title' => '刮刮卡添加',
                    'ctl' => 'jtyjy/weixin/addon/scratch:create',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡修改',
                    'ctl' => 'jtyjy/weixin/addon/scratch:edit',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡删除',
                    'ctl' => 'jtyjy/weixin/addon/scratch:delete',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡预览',
                    'ctl' => 'jtyjy/weixin/addon/scratch:preview',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'jtyjy/weixin/addon/scratch:sn',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'jtyjy/weixin/addon/scratch:sndelete',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'jtyjy/weixin/addon/scratch:snedit',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'jtyjy/weixin/addon/scratch:goods',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'jtyjy/weixin/addon/scratch:goodsdelete',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'jtyjy/weixin/addon/scratch:goodsedit',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'jtyjy/weixin/addon/scratch:goodscreate',
                    'nav' => 'jtyjy/weixin/addon/scratch:index'
                ),
                
                array(
                    'title' => '大转盘',
                    'ctl' => 'jtyjy/weixin/addon/lottery:index',
                    'menu' => true
                ),
                array(
                    'title' => '大转盘添加',
                    'ctl' => 'jtyjy/weixin/addon/lottery:create',
                    'nav' => 'jtyjy/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘修改',
                    'ctl' => 'jtyjy/weixin/addon/lottery:edit',
                    'nav' => 'jtyjy/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘删除',
                    'ctl' => 'jtyjy/weixin/addon/lottery:delete',
                    'nav' => 'jtyjy/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘预览',
                    'ctl' => 'jtyjy/weixin/addon/lottery:preview',
                    'nav' => 'jtyjy/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'jtyjy/weixin/addon/lottery:sn',
                    'nav' => 'jtyjy/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'jtyjy/weixin/addon/lottery:sndelete',
                    'nav' => 'jtyjy/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'jtyjy/weixin/addon/lottery:snedit',
                    'nav' => 'jtyjy/weixin/addon/lottery:index'
                ),
                
                array(
                    'title' => '砸金蛋',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:index',
                    'menu' => true
                ),
                array(
                    'title' => '砸金蛋添加',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:create',
                    'nav' => 'jtyjy/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋修改',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:edit',
                    'nav' => 'jtyjy/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋删除',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:delete',
                    'nav' => 'jtyjy/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋预览',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:preview',
                    'nav' => 'jtyjy/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:sn',
                    'nav' => 'jtyjy/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:sndelete',
                    'nav' => 'jtyjy/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'jtyjy/weixin/addon/goldegg:snedit',
                    'nav' => 'jtyjy/weixin/addon/goldegg:index'
                ),
                
                array(
                    'title' => '红包',
                    'ctl' => 'jtyjy/weixin/addon/packet:index',
                    'menu' => true
                ),
                array(
                    'title' => '红包添加',
                    'ctl' => 'jtyjy/weixin/addon/packet:create',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包修改',
                    'ctl' => 'jtyjy/weixin/addon/packet:edit',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包删除',
                    'ctl' => 'jtyjy/weixin/addon/packet:delete',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包预览',
                    'ctl' => 'jtyjy/weixin/addon/packet:preview',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'jtyjy/weixin/addon/packet:sn',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'jtyjy/weixin/addon/packet:sndelete',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'jtyjy/weixin/addon/packet:logs',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'jtyjy/weixin/addon/packet:logsdelete',
                    'nav' => 'jtyjy/weixin/addon/packet:index'
                ),
                
                array(
                    'title' => '卡劵',
                    'ctl' => 'jtyjy/weixin/addon/card:index',
                    'menu' => true
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'jtyjy/weixin/addon/card:get_card',
                    'nav' => 'jtyjy/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'jtyjy/weixin/addon/card:wxqrcode',
                    'nav' => 'jtyjy/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'jtyjy/weixin/addon/card:show',
                    'nav' => 'jtyjy/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'jtyjy/weixin/addon/card:wxqrcode2',
                    'nav' => 'jtyjy/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵核销',
                    'ctl' => 'jtyjy/weixin/addon/card:consume',
                    'nav' => 'jtyjy/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵删除',
                    'ctl' => 'jtyjy/weixin/addon/card:delete_card',
                    'nav' => 'jtyjy/weixin/addon/card:index'
                ),
                
                array(
                    'title' => '摇一摇',
                    'ctl' => 'jtyjy/weixin/addon/shake:index',
                    'menu' => true
                ),
                array(
                    'title' => '摇一摇添加',
                    'ctl' => 'jtyjy/weixin/addon/shake:create',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇修改',
                    'ctl' => 'jtyjy/weixin/addon/shake:edit',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇删除',
                    'ctl' => 'jtyjy/weixin/addon/shake:delete',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇预览',
                    'ctl' => 'jtyjy/weixin/addon/shake:preview',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'jtyjy/weixin/addon/shake:sn',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'jtyjy/weixin/addon/shake:sndelete',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'jtyjy/weixin/addon/shake:snedit',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'jtyjy/weixin/addon/shake:goods',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'jtyjy/weixin/addon/shake:goodsdelete',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'jtyjy/weixin/addon/shake:goodsedit',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'jtyjy/weixin/addon/shake:goodscreate',
                    'nav' => 'jtyjy/weixin/addon/shake:index'
                ),
                array(
                    'title' => '微助力',
                    'ctl' => 'jtyjy/weixin/addon/help:index',
                    'menu' => true
                ),
                array(
                    'title' => '微助力添加',
                    'ctl' => 'jtyjy/weixin/addon/help:create',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力修改',
                    'ctl' => 'jtyjy/weixin/addon/help:edit',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力删除',
                    'ctl' => 'jtyjy/weixin/addon/help:delete',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力预览',
                    'ctl' => 'jtyjy/weixin/addon/help:preview',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'jtyjy/weixin/addon/help:sn',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'jtyjy/weixin/addon/help:sndelete',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'jtyjy/weixin/addon/help:snedit',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '查看我的助力',
                    'ctl' => 'jtyjy/weixin/addon/help:snlist',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'jtyjy/weixin/addon/help:goods',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'jtyjy/weixin/addon/help:goodsdelete',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'jtyjy/weixin/addon/help:goodsedit',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'jtyjy/weixin/addon/help:goodscreate',
                    'nav' => 'jtyjy/weixin/addon/help:index'
                ),
                array(
                    'title' => '微接力',
                    'ctl' => 'jtyjy/weixin/addon/relay:index',
                    'menu' => true
                ),
                array(
                    'title' => '微接力添加',
                    'ctl' => 'jtyjy/weixin/addon/relay:create',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力修改',
                    'ctl' => 'jtyjy/weixin/addon/relay:edit',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力删除',
                    'ctl' => 'jtyjy/weixin/addon/relay:delete',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力预览',
                    'ctl' => 'jtyjy/weixin/addon/relay:preview',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'jtyjy/weixin/addon/relay:sn',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'jtyjy/weixin/addon/relay:sndelete',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'jtyjy/weixin/addon/relay:snedit',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '查看我的接力',
                    'ctl' => 'jtyjy/weixin/addon/relay:snlist',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'jtyjy/weixin/addon/relay:goods',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'jtyjy/weixin/addon/relay:goodsdelete',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'jtyjy/weixin/addon/relay:goodsedit',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'jtyjy/weixin/addon/relay:goodscreate',
                    'nav' => 'jtyjy/weixin/addon/relay:index'
                )
            )
        )
    )
);
