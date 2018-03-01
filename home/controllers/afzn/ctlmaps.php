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
                // array('title'=>'个人中心', 'ctl'=>'afzn/index:index', 'nav'=>'afzn/member:index'),
                // array('title'=>'个人中心', 'ctl'=>'afzn/member:index', 'menu'=>true),
                array(
                    'title' => '修改资料',
                    'ctl' => 'afzn/member:info',
                    'menu' => true
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'afzn/member:passwd',
                    'nav' => 'afzn/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'afzn/member:passwds',
                    'nav' => 'afzn/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'afzn/member:passwd1',
                    'nav' => 'afzn/member:info'
                ),
                array(
                    'title' => '修改密码',
                    'ctl' => 'afzn/member:passwd2',
                    'nav' => 'afzn/member:info'
                ),
                array(
                    'title' => '更换邮箱',
                    'ctl' => 'afzn/member:mail',
                    'nav' => 'afzn/member:info'
                ),
                array(
                    'title' => '修改头像',
                    'ctl' => 'afzn/member:face',
                    'nav' => 'afzn/member:info'
                ),
                array(
                    'title' => '上传头像',
                    'ctl' => 'afzn/member:upload',
                    'nav' => 'afzn/member:info'
                ),
                // array('title'=>'实名认证', 'ctl'=>'afzn/member/verify:name', 'menu'=>true),
                array(
                    'title' => '手机认证',
                    'ctl' => 'afzn/member/verify:mobile',
                    'nav' => 'afzn/member/verify:name'
                ),
                array(
                    'title' => '手机认证',
                    'ctl' => 'afzn/member/verify:code',
                    'nav' => 'afzn/member/verify:name'
                ),
                array(
                    'title' => 'EMAIL认证',
                    'ctl' => 'afzn/member/verify:mail',
                    'nav' => 'afzn/member/verify:name'
                ),
                // array('title'=>'帐号绑定', 'ctl'=>'afzn/member:bindaccount', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'afzn/member:logs', 'menu'=>true),
                // array('title'=>'金币日志', 'ctl'=>'afzn/member:home', 'menu'=>true),
                array(
                    'title' => '我的金币',
                    'ctl' => 'afzn/member:gold',
                    'nav' => 'afzn/member:logs'
                ),
                // array('title'=>'积分日志', 'ctl'=>'afzn/member:jflogs', 'menu'=>true),
                array(
                    'title' => '我的托管',
                    'ctl' => 'afzn/member:truste',
                    'nav' => 'afzn/member:trustelogs'
                ),
                // array('title'=>'分销链接', 'ctl'=>'afzn/member:fenxiao', 'menu'=>true),
                // array('title'=>'我的红包', 'ctl'=>'afzn/member/packet:items', 'menu'=>true),
                array(
                    'title' => '领取红包',
                    'ctl' => 'afzn/member/packet:create',
                    'nav' => 'afzn/packet:items'
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
                // array('title'=>'管理中心', 'ctl'=>'afzn/company:index', 'menu'=>true),
                array(
                    'title' => '公司设置',
                    'ctl' => 'afzn/company:info',
                    'menu' => true
                ),
                array(
                    'title' => '刷新置顶',
                    'ctl' => 'afzn/company:refresh',
                    'nav' => 'afzn/company:index'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'afzn/company:skin',
                    'nav' => 'afzn/company:info'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'afzn/company:domain',
                    'nav' => 'afzn/company:info'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'afzn/company/banner:index',
                    'nav' => 'afzn/company:info'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'afzn/company/banner:upload',
                    'nav' => 'afzn/company:info'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'afzn/company/banner:update',
                    'nav' => 'afzn/company:info'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'afzn/company/banner:delete',
                    'nav' => 'afzn/company:info'
                ),
                // array('title'=>'荣誉资质', 'ctl'=>'afzn/company/photo:index', 'menu'=>true),
                array(
                    'title' => '添加图片',
                    'ctl' => 'afzn/company/photo:create',
                    'nav' => 'afzn/company/photo:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'afzn/company/photo:update',
                    'nav' => 'afzn/company/photo:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'afzn/company/photo:delete',
                    'nav' => 'afzn/company/photo:index'
                ),
                // array('title'=>'团队管理', 'ctl'=>'afzn/company/team:index', 'menu'=>true),
                array(
                    'title' => '绑定设计师',
                    'ctl' => 'afzn/company/team:bind',
                    'nav' => 'afzn/company/team:index'
                ),
                array(
                    'title' => '解雇设计师',
                    'ctl' => 'afzn/company/team:unbind',
                    'nav' => 'afzn/company/team:index'
                ),
                array(
                    'title' => '企业新闻',
                    'ctl' => 'afzn/company/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '发布新闻',
                    'ctl' => 'afzn/company/news:create',
                    'nav' => 'afzn/company/news:index'
                ),
                array(
                    'title' => '编辑新闻',
                    'ctl' => 'afzn/company/news:edit',
                    'nav' => 'afzn/company/news:index'
                ),
                array(
                    'title' => '删除新闻',
                    'ctl' => 'afzn/company/news:delete',
                    'nav' => 'afzn/company/news:index'
                )
            )
        ),
        // array('title'=>'财务管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'财务管理', 'ctl'=>'afzn/company/money:company', 'menu'=>true),
        // array('title'=>'申请提现', 'ctl'=>'afzn/company/money:tixian', 'nav'=>'afzn/company/money:company'),
        // )
        // ),
        array(
            'title' => '装修案例',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '案例管理',
                    'ctl' => 'afzn/company/case:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加案例',
                    'ctl' => 'afzn/company/case:create',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '选择小区',
                    'ctl' => 'afzn/misc/select:home',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '选择户型图',
                    'ctl' => 'afzn/misc/select:huxing',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '编辑案例',
                    'ctl' => 'afzn/company/case:edit',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '案例图片',
                    'ctl' => 'afzn/company/case:detail',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '删除案例',
                    'ctl' => 'afzn/company/case:delete',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'afzn/company/case:update',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'afzn/company/case:upload',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'afzn/company/case:deletephoto',
                    'nav' => 'afzn/company/case:index'
                ),
                array(
                    'title' => '封面',
                    'ctl' => 'afzn/company/case:defaultphoto',
                    'nav' => 'afzn/company/case:index'
                )
            )
        ),
        
        // array('title'=>'在建工地', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'工地管理', 'ctl'=>'afzn/company/site:index', 'menu'=>true),
        // array('title'=>'发布工地', 'ctl'=>'afzn/company/site:create', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'修改工地', 'ctl'=>'afzn/company/site:edit', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'删除工地', 'ctl'=>'afzn/company/site:delete', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'选择小区', 'ctl'=>'afzn/misc/select:home', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'选择户型图', 'ctl'=>'afzn/misc/select:mycase', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'工地日记', 'ctl'=>'afzn/company/diary:site', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'发布日记', 'ctl'=>'afzn/company/diary:create', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'修改日记', 'ctl'=>'afzn/company/diary:edit', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'删除日记', 'ctl'=>'afzn/company/diary:delete', 'nav'=>'afzn/company/site:index'),
        // array('title'=>'项目管理', 'ctl'=>'afzn/company/zxpm:index', 'menu'=>true,'key'=>'zxpm'),
        // array('title'=>'项目管理', 'ctl'=>'afzn/company/zxpm:detail', 'nav'=>'afzn/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'afzn/company/zxpm:edit', 'nav'=>'afzn/company/zxpm:index','key'=>'zxpm'), array('title'=>'监理管理', 'ctl'=>'afzn/company/zxpm:delete', 'nav'=>'afzn/company/zxpm:index','key'=>'zxpm'),
        // )
        // ),
        
        // array('title'=>'维修管理', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'维修投标', 'ctl'=>'afzn/misc/truste:index', 'menu'=>true),
        // array('title'=>'招标详情', 'ctl'=>'afzn/misc/truste:detail', 'nav'=>'afzn/misc/truste:index'),
        // array('title'=>'我要投标', 'ctl'=>'afzn/misc/truste:look', 'nav'=>'afzn/misc/truste:index'),
        // array('title'=>'维修竞标', 'ctl'=>'afzn/misc/truste:looked', 'menu'=>true),
        // array('title'=>'竞标跟踪', 'ctl'=>'afzn/misc/truste:track', 'nav'=>'afzn/misc/truste:looked'),
        // )
        // ),
        
        // array('title'=>'团装小区', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'团装小区', 'ctl'=>'afzn/company/tuan:index', 'menu'=>true),
        // array('title'=>'报名管理', 'ctl'=>'afzn/company/tuan:sign', 'nav'=>'afzn/company/tuan:index'),
        // array('title'=>'查看', 'ctl'=>'afzn/company/tuan:detail', 'nav'=>'afzn/company/tuan:index'),
        // )
        // ),
        
        // array('title'=>'优惠信息', 'menu'=>true,
        // 'items'=>array(
        // array('title'=>'优惠信息', 'ctl'=>'afzn/company/youhui:index', 'menu'=>true),
        // array('title'=>'刷新优惠', 'ctl'=>'afzn/company/youhui:refresh', 'nav'=>'afzn/company/youhui:index'),
        // array('title'=>'发布优惠', 'ctl'=>'afzn/company/youhui:create', 'nav'=>'afzn/company/youhui:index'),
        // array('title'=>'编辑优惠', 'ctl'=>'afzn/company/youhui:edit', 'nav'=>'afzn/company/youhui:index'),
        // array('title'=>'删除优惠', 'ctl'=>'afzn/company/youhui:delete', 'nav'=>'afzn/company/youhui:index'),
        // array('title'=>'报名查看', 'ctl'=>'afzn/company/youhui:youhuiSign', 'nav'=>'afzn/company/youhui:index'),
        // array('title'=>'查看报名', 'ctl'=>'afzn/company/youhui:sign', 'menu'=>true),
        // array('title'=>'报名详情', 'ctl'=>'afzn/company/youhui:signDetail', 'nav'=>'afzn/company/youhui:sign'),
        // array('title'=>'更新报名', 'ctl'=>'afzn/company/youhui:signSave', 'nav'=>'afzn/company/youhui:sign'),
        // )
        // ),
        array(
            'title' => '留言管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '点评管理',
                    'ctl' => 'afzn/company/comment:company',
                    'menu' => true
                ),
                array(
                    'title' => '查看点评',
                    'ctl' => 'afzn/company/comment:detail',
                    'nav' => 'afzn/company/comment:company'
                ),
                array(
                    'title' => '回复点评',
                    'ctl' => 'afzn/company/comment:reply',
                    'nav' => 'afzn/company/comment:company'
                )
            )
        )
    )
    // array('title'=>'预约管理', 'menu'=>true,
    // 'items'=>array(
    // array('title'=>'预约管理', 'ctl'=>'afzn/company/yuyue:company', 'menu'=>true),
    // array('title'=>'预约详情', 'ctl'=>'afzn/company/yuyue:detail', 'nav'=>'afzn/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'afzn/company/yuyue:save', 'nav'=>'afzn/company/yuyue:company'),
    // array('title'=>'预约设计师', 'ctl'=>'afzn/company/yuyue:designer', 'nav'=>'afzn/company/yuyue:company'),
    // array('title'=>'预约详情', 'ctl'=>'afzn/company/yuyue:designerDetail', 'nav'=>'afzn/company/yuyue:company'),
    // array('title'=>'更新预约', 'ctl'=>'afzn/company/yuyue:designerSave', 'nav'=>'afzn/company/yuyue:company'),
    //
    // array('title'=>'我要投标', 'ctl'=>'afzn/misc/tenders:index', 'menu'=>true),
    // array('title'=>'招标详情', 'ctl'=>'afzn/misc/tenders:detail', 'nav'=>'afzn/misc/tenders:index'),
    // array('title'=>'我要投标', 'ctl'=>'afzn/misc/tenders:look', 'nav'=>'afzn/misc/tenders:index'),
    // array('title'=>'我的竞标', 'ctl'=>'afzn/misc/tenders:looked', 'menu'=>true),
    // array('title'=>'竞标跟踪', 'ctl'=>'afzn/misc/tenders:track', 'nav'=>'afzn/misc/tenders:looked'),
    // array('title'=>'竞标留言', 'ctl'=>'afzn/misc/tenders:comment', 'nav'=>'afzn/misc/tenders:looked'),
    // array('title'=>'我的管家', 'ctl'=>'afzn/company/zxb:index', 'menu'=>true),
    // array('title'=>'查看装修保', 'ctl'=>'afzn/company/zxb:lists', 'nav'=>'afzn/company/zxb:index'),
    // array('title'=>'具体步骤', 'ctl'=>'afzn/company/zxb:detail', 'nav'=>'afzn/company/zxb:index'),
    // array('title'=>'用户确定预约', 'ctl'=>'afzn/company/zxb:look', 'nav'=>'afzn/company/zxb:index'),
    // array('title'=>'提交合同', 'ctl'=>'afzn/company/zxb:hetong', 'nav'=>'afzn/company/zxb:index'),
    // array('title'=>'我的投诉', 'ctl'=>'afzn/company/zxb:plaint', 'nav'=>'afzn/company/zxb:index'),
    // array('title'=>'我的投诉列表', 'ctl'=>'afzn/company/zxb:plaintlists', 'nav'=>'afzn/company/zxb:index'),
    // array('title'=>'投诉查看修改', 'ctl'=>'afzn/company/zxb:plaintedit', 'nav'=>'afzn/company/zxb:index'),
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
                    'ctl' => 'afzn/shop:index',
                    'menu' => true
                ),
                array(
                    'title' => '商铺设置',
                    'ctl' => 'afzn/shop:base',
                    'menu' => true
                ),
                array(
                    'title' => '资料设置',
                    'ctl' => 'afzn/shop:info',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '个性域名',
                    'ctl' => 'afzn/shop:domain',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => 'SEO设置',
                    'ctl' => 'afzn/shop:seo',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '购买说明',
                    'ctl' => 'afzn/shop:gmsm',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'afzn/shop:skin',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '商铺子分类',
                    'ctl' => 'afzn/shop:catechildren',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'afzn/shop/banner:index',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'afzn/shop/banner:upload',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'afzn/shop/banner:update',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'afzn/shop/banner:delete',
                    'nav' => 'afzn/shop:base'
                ),
                array(
                    'title' => '店铺资讯',
                    'ctl' => 'afzn/shop/news:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加资讯',
                    'ctl' => 'afzn/shop/news:create'
                ),
                array(
                    'title' => '修改资讯',
                    'ctl' => 'afzn/shop/news:edit'
                ),
                array(
                    'title' => '删除资讯',
                    'ctl' => 'afzn/shop/news:delete'
                ),
                array(
                    'title' => '门店管理',
                    'ctl' => 'afzn/shop/mendian:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加门店',
                    'ctl' => 'afzn/shop/mendian:create'
                ),
                array(
                    'title' => '修改门店',
                    'ctl' => 'afzn/shop/mendian:edit'
                ),
                array(
                    'title' => '删除门店',
                    'ctl' => 'afzn/shop/mendian:delete'
                ),
                array(
                    'title' => '刷新商铺',
                    'ctl' => 'afzn/shop:refresh',
                    'nav' => 'afzn/shop:index'
                )
            )
        ),
        array(
            'title' => '财务管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '财务管理',
                    'ctl' => 'afzn/shop/money:shop',
                    'menu' => true
                ),
                array(
                    'title' => '申请提现',
                    'ctl' => 'afzn/shop/money:tixian',
                    'nav' => 'afzn/shop/money:shop'
                )
            )
        ),
        array(
            'title' => '商品管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺分类',
                    'ctl' => 'afzn/shop/vcate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'afzn/shop/vcate:create'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'afzn/shop/vcate:edit'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'afzn/shop/vcate:delete'
                ),
                array(
                    'title' => '商品管理',
                    'ctl' => 'afzn/product:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加商品',
                    'ctl' => 'afzn/product:create',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '修改商品',
                    'ctl' => 'afzn/product:edit',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '删除商品',
                    'ctl' => 'afzn/product:delete',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '商品图片',
                    'ctl' => 'afzn/product:photo',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '上传图片',
                    'ctl' => 'afzn/product:upload',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '删除图片',
                    'ctl' => 'afzn/product:deletephoto',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '更新图片',
                    'ctl' => 'afzn/product:updatephoto',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '商品规格',
                    'ctl' => 'afzn/product:spec',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '更新规格',
                    'ctl' => 'afzn/product:updatespec',
                    'nav' => 'afzn/product:index'
                ),
                array(
                    'title' => '删除规格',
                    'ctl' => 'afzn/product:deletespec',
                    'nav' => 'afzn/product:index'
                )
            )
        ),
        array(
            'title' => '维修管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '维修投标',
                    'ctl' => 'afzn/misc/truste:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'afzn/misc/truste:detail',
                    'nav' => 'afzn/misc/truste:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'afzn/misc/truste:look',
                    'nav' => 'afzn/misc/truste:index'
                ),
                array(
                    'title' => '维修竞标',
                    'ctl' => 'afzn/misc/truste:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标跟踪',
                    'ctl' => 'afzn/misc/truste:track',
                    'nav' => 'afzn/misc/truste:looked'
                )
            )
        ),
        array(
            'title' => '评论管理',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '店铺评论',
                    'ctl' => 'afzn/shop/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'afzn/shop/comment:detail',
                    'nav' => 'afzn/shop/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'afzn/shop/comment:reply',
                    'nav' => 'afzn/shop/comment:shop'
                ),
                array(
                    'title' => '商品评论',
                    'ctl' => 'afzn/product/comment:shop',
                    'menu' => true
                ),
                array(
                    'title' => '查看评论',
                    'ctl' => 'afzn/product/comment:detail',
                    'nav' => 'afzn/product/comment:shop'
                ),
                array(
                    'title' => '回复评论',
                    'ctl' => 'afzn/product/comment:reply',
                    'nav' => 'afzn/product/comment:shop'
                )
            )
        ),
        array(
            'title' => '商铺订单',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '商品订单',
                    'ctl' => 'afzn/shop/order:index',
                    'menu' => true
                ),
                array(
                    'title' => '订单详情',
                    'ctl' => 'afzn/shop/order:update',
                    'nav' => 'afzn/shop/order:index'
                ),
                array(
                    'title' => '预约管理',
                    'ctl' => 'afzn/shop/yuyue:shop',
                    'menu' => true
                ),
                array(
                    'title' => '预约详情',
                    'ctl' => 'afzn/shop/yuyue:detail',
                    'nav' => 'afzn/shop/yuyue:shop'
                ),
                array(
                    'title' => '更新预约',
                    'ctl' => 'afzn/shop/yuyue:save',
                    'nav' => 'afzn/shop/yuyue:shop'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'afzn/misc/tenders:index',
                    'menu' => true
                ),
                array(
                    'title' => '招标详情',
                    'ctl' => 'afzn/misc/tenders:detail',
                    'nav' => 'afzn/misc/tenders:index'
                ),
                array(
                    'title' => '我要投标',
                    'ctl' => 'afzn/misc/tenders:look',
                    'nav' => 'afzn/misc/tenders:index'
                ),
                array(
                    'title' => '我的竞标',
                    'ctl' => 'afzn/misc/tenders:looked',
                    'menu' => true
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'afzn/misc/tenders:tracking',
                    'nav' => 'afzn/misc/tenders:looked'
                ),
                array(
                    'title' => '竞标详情',
                    'ctl' => 'afzn/misc/tenders:track',
                    'nav' => 'afzn/misc/tenders:looked'
                )
            )
        ),
        array(
            'title' => '优惠券',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '优惠券',
                    'ctl' => 'afzn/shop/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加优惠券',
                    'ctl' => 'afzn/shop/coupon:create',
                    'nav' => 'afzn/shop/coupon:index'
                ),
                array(
                    'title' => '修改优惠券',
                    'ctl' => 'afzn/shop/coupon:edit',
                    'nav' => 'afzn/shop/coupon:index'
                ),
                array(
                    'title' => '删除优惠券',
                    'ctl' => 'afzn/shop/coupon:delete',
                    'nav' => 'afzn/shop/coupon:index'
                ),
                array(
                    'title' => '下载日志',
                    'ctl' => 'afzn/shop/coupon:downloads',
                    'menu' => true
                ),
                array(
                    'title' => '日志详情',
                    'ctl' => 'afzn/shop/coupon:downloadDetail',
                    'nav' => 'afzn/shop/coupon:downloads'
                ),
                array(
                    'title' => '更新日志',
                    'ctl' => 'afzn/shop/coupon:downloadSave',
                    'nav' => 'afzn/shop/coupon:downloads'
                ),
                array(
                    'title' => '红包列表',
                    'ctl' => 'afzn/shop/packet:items',
                    'menu' => true
                ),
                array(
                    'title' => '发布红包',
                    'ctl' => 'afzn/shop/packet:create',
                    'nav' => 'afzn/shop/packet:items'
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
                    'ctl' => 'afzn/weixin:index',
                    'menu' => true
                ),
                array(
                    'title' => '公众号设置',
                    'ctl' => 'afzn/weixin:info',
                    'nav' => 'afzn/weixin:index'
                ),
                array(
                    'title' => '接口配置',
                    'ctl' => 'afzn/weixin:config',
                    'nav' => 'afzn/weixin:index'
                ),
                array(
                    'title' => '关注回复',
                    'ctl' => 'afzn/weixin:welcome',
                    'nav' => 'afzn/weixin:index'
                ),
                array(
                    'title' => '宣传页面',
                    'ctl' => 'afzn/weixin:leaflets',
                    'nav' => 'afzn/weixin:index'
                ),
                array(
                    'title' => '微信菜单',
                    'ctl' => 'afzn/weixin/menu:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加菜单',
                    'ctl' => 'afzn/weixin/menu:create',
                    'nav' => 'afzn/weixin/menu:index'
                ),
                array(
                    'title' => '修改菜单',
                    'ctl' => 'afzn/weixin/menu:edit',
                    'nav' => 'afzn/weixin/menu:index'
                ),
                array(
                    'title' => '删除菜单',
                    'ctl' => 'afzn/weixin/menu:delete',
                    'nav' => 'afzn/weixin/menu:index'
                ),
                array(
                    'title' => '同步到微信',
                    'ctl' => 'afzn/weixin/menu:towechat',
                    'nav' => 'afzn/weixin/menu:index'
                ),
                
                array(
                    'title' => '微信素材',
                    'ctl' => 'afzn/weixin/reply:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加素材',
                    'ctl' => 'afzn/weixin/reply:create',
                    'nav' => 'afzn/weixin/reply:index'
                ),
                array(
                    'title' => '修改素材',
                    'ctl' => 'afzn/weixin/reply:edit',
                    'nav' => 'afzn/weixin/reply:index'
                ),
                array(
                    'title' => '删除素材',
                    'ctl' => 'afzn/weixin/reply:delete',
                    'nav' => 'afzn/weixin/reply:index'
                ),
                array(
                    'title' => '选择素材',
                    'ctl' => 'afzn/weixin/reply:dialog',
                    'nav' => 'afzn/weixin/reply:index'
                ),
                array(
                    'title' => '关键字设置',
                    'ctl' => 'afzn/weixin/keyword:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加关键字',
                    'ctl' => 'afzn/weixin/keyword:create',
                    'nav' => 'afzn/weixin/keyword:index'
                ),
                array(
                    'title' => '修改关键字',
                    'ctl' => 'afzn/weixin/keyword:edit',
                    'nav' => 'afzn/weixin/keyword:index'
                ),
                array(
                    'title' => '删除关键字',
                    'ctl' => 'afzn/weixin/keyword:delete',
                    'nav' => 'afzn/weixin/keyword:index'
                )
            )
        ),
        array(
            'title' => '微网站',
            'menu' => true,
            'items' => array(
                array(
                    'title' => '微网站',
                    'ctl' => 'afzn/weixin/msite:index',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'afzn/weixin/msite:tmpl',
                    'menu' => true
                ),
                array(
                    'title' => '模板设置',
                    'ctl' => 'afzn/weixin/msite:access',
                    'nav' => 'afzn/weixin/msite:index'
                ),
                array(
                    'title' => '预览微官网',
                    'ctl' => 'afzn/weixin/msite/banner:index',
                    'nav' => 'afzn/weixin/msite:index'
                ),
                array(
                    'title' => '轮转广告',
                    'ctl' => 'afzn/weixin/msite/banner:index',
                    'nav' => 'afzn/weixin/msite:index'
                ),
                array(
                    'title' => '上传广告',
                    'ctl' => 'afzn/weixin/msite/banner:upload',
                    'nav' => 'afzn/weixin/msite:index'
                ),
                array(
                    'title' => '更新广告',
                    'ctl' => 'afzn/weixin/msite/banner:update',
                    'nav' => 'afzn/weixin/msite:index'
                ),
                array(
                    'title' => '删除广告',
                    'ctl' => 'afzn/weixin/msite/banner:delete',
                    'nav' => 'afzn/weixin/msite:index'
                ),
                array(
                    'title' => '分类管理',
                    'ctl' => 'afzn/weixin/msite/cate:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加分类',
                    'ctl' => 'afzn/weixin/msite/cate:create',
                    'nav' => 'afzn/weixin/msite/cate:index'
                ),
                array(
                    'title' => '修改分类',
                    'ctl' => 'afzn/weixin/msite/cate:edit',
                    'nav' => 'afzn/weixin/msite/cate:index'
                ),
                array(
                    'title' => '删除分类',
                    'ctl' => 'afzn/weixin/msite/cate:delete',
                    'nav' => 'afzn/weixin/msite/cate:index'
                ),
                array(
                    'title' => '文章管理',
                    'ctl' => 'afzn/weixin/msite/article:index',
                    'menu' => true
                ),
                array(
                    'title' => '添加文章',
                    'ctl' => 'afzn/weixin/msite/article:create',
                    'nav' => 'afzn/weixin/msite/article:index'
                ),
                array(
                    'title' => '修改文章',
                    'ctl' => 'afzn/weixin/msite/article:edit',
                    'nav' => 'afzn/weixin/msite/article:index'
                ),
                array(
                    'title' => '删除文章',
                    'ctl' => 'afzn/weixin/msite/article:delete',
                    'nav' => 'afzn/weixin/msite/article:index'
                )
            )
        ),
		/*array('title'=>'分销管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'分销设置', 'ctl'=>'afzn/upm/task:index', 'menu'=>true),
                array('title'=>'设置分销', 'ctl'=>'afzn/upm/task:info', 'nav'=>'afzn/upm/task:index', 'key'=>'f_task'),
                array('title'=>'查看任务', 'ctl'=>'afzn/upm/task:detail', 'nav'=>'afzn/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分铺统计', 'ctl'=>'afzn/upm/task:count', 'nav'=>'afzn/upm/task:index', 'key'=>'f_task'),
                array('title'=>'分销日志', 'ctl'=>'afzn/upm/tasklog:index', 'menu'=>true, 'key'=>'f_log'),
                array('title'=>'分销统计', 'ctl'=>'afzn/upm/tasklog:tongji', 'menu'=>true, 'key'=>'f_tongji'),
            )
        ),  */
        array(
            'title' => '微营销',
            'menu' => true,
            'items' => array(
                
                array(
                    'title' => '优惠券',
                    'ctl' => 'afzn/weixin/addon/coupon:index',
                    'menu' => true
                ),
                array(
                    'title' => '优惠券添加',
                    'ctl' => 'afzn/weixin/addon/coupon:create',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券修改',
                    'ctl' => 'afzn/weixin/addon/coupon:edit',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券删除',
                    'ctl' => 'afzn/weixin/addon/coupon:delete',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券预览',
                    'ctl' => 'afzn/weixin/addon/coupon:preview',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券申请',
                    'ctl' => 'afzn/weixin/addon/coupon:sign',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券展示',
                    'ctl' => 'afzn/weixin/addon/coupon:show',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'afzn/weixin/addon/coupon:sn',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'afzn/weixin/addon/coupon:sndelete',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                array(
                    'title' => '优惠券成员',
                    'ctl' => 'afzn/weixin/addon/coupon:snedit',
                    'nav' => 'afzn/weixin/addon/coupon:index'
                ),
                
                array(
                    'title' => '刮刮卡',
                    'ctl' => 'afzn/weixin/addon/scratch:index',
                    'menu' => true
                ),
                array(
                    'title' => '刮刮卡添加',
                    'ctl' => 'afzn/weixin/addon/scratch:create',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡修改',
                    'ctl' => 'afzn/weixin/addon/scratch:edit',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡删除',
                    'ctl' => 'afzn/weixin/addon/scratch:delete',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡预览',
                    'ctl' => 'afzn/weixin/addon/scratch:preview',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'afzn/weixin/addon/scratch:sn',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'afzn/weixin/addon/scratch:sndelete',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡成员',
                    'ctl' => 'afzn/weixin/addon/scratch:snedit',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'afzn/weixin/addon/scratch:goods',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'afzn/weixin/addon/scratch:goodsdelete',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'afzn/weixin/addon/scratch:goodsedit',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                array(
                    'title' => '刮刮卡奖品',
                    'ctl' => 'afzn/weixin/addon/scratch:goodscreate',
                    'nav' => 'afzn/weixin/addon/scratch:index'
                ),
                
                array(
                    'title' => '大转盘',
                    'ctl' => 'afzn/weixin/addon/lottery:index',
                    'menu' => true
                ),
                array(
                    'title' => '大转盘添加',
                    'ctl' => 'afzn/weixin/addon/lottery:create',
                    'nav' => 'afzn/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘修改',
                    'ctl' => 'afzn/weixin/addon/lottery:edit',
                    'nav' => 'afzn/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘删除',
                    'ctl' => 'afzn/weixin/addon/lottery:delete',
                    'nav' => 'afzn/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘预览',
                    'ctl' => 'afzn/weixin/addon/lottery:preview',
                    'nav' => 'afzn/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'afzn/weixin/addon/lottery:sn',
                    'nav' => 'afzn/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'afzn/weixin/addon/lottery:sndelete',
                    'nav' => 'afzn/weixin/addon/lottery:index'
                ),
                array(
                    'title' => '大转盘成员',
                    'ctl' => 'afzn/weixin/addon/lottery:snedit',
                    'nav' => 'afzn/weixin/addon/lottery:index'
                ),
                
                array(
                    'title' => '砸金蛋',
                    'ctl' => 'afzn/weixin/addon/goldegg:index',
                    'menu' => true
                ),
                array(
                    'title' => '砸金蛋添加',
                    'ctl' => 'afzn/weixin/addon/goldegg:create',
                    'nav' => 'afzn/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋修改',
                    'ctl' => 'afzn/weixin/addon/goldegg:edit',
                    'nav' => 'afzn/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋删除',
                    'ctl' => 'afzn/weixin/addon/goldegg:delete',
                    'nav' => 'afzn/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋预览',
                    'ctl' => 'afzn/weixin/addon/goldegg:preview',
                    'nav' => 'afzn/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'afzn/weixin/addon/goldegg:sn',
                    'nav' => 'afzn/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'afzn/weixin/addon/goldegg:sndelete',
                    'nav' => 'afzn/weixin/addon/goldegg:index'
                ),
                array(
                    'title' => '砸金蛋成员',
                    'ctl' => 'afzn/weixin/addon/goldegg:snedit',
                    'nav' => 'afzn/weixin/addon/goldegg:index'
                ),
                
                array(
                    'title' => '红包',
                    'ctl' => 'afzn/weixin/addon/packet:index',
                    'menu' => true
                ),
                array(
                    'title' => '红包添加',
                    'ctl' => 'afzn/weixin/addon/packet:create',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包修改',
                    'ctl' => 'afzn/weixin/addon/packet:edit',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包删除',
                    'ctl' => 'afzn/weixin/addon/packet:delete',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包预览',
                    'ctl' => 'afzn/weixin/addon/packet:preview',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'afzn/weixin/addon/packet:sn',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                array(
                    'title' => '红包成员',
                    'ctl' => 'afzn/weixin/addon/packet:sndelete',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'afzn/weixin/addon/packet:logs',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                array(
                    'title' => '兑奖记录',
                    'ctl' => 'afzn/weixin/addon/packet:logsdelete',
                    'nav' => 'afzn/weixin/addon/packet:index'
                ),
                
                array(
                    'title' => '卡劵',
                    'ctl' => 'afzn/weixin/addon/card:index',
                    'menu' => true
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'afzn/weixin/addon/card:get_card',
                    'nav' => 'afzn/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵投放',
                    'ctl' => 'afzn/weixin/addon/card:wxqrcode',
                    'nav' => 'afzn/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'afzn/weixin/addon/card:show',
                    'nav' => 'afzn/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵查看',
                    'ctl' => 'afzn/weixin/addon/card:wxqrcode2',
                    'nav' => 'afzn/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵核销',
                    'ctl' => 'afzn/weixin/addon/card:consume',
                    'nav' => 'afzn/weixin/addon/card:index'
                ),
                array(
                    'title' => '卡劵删除',
                    'ctl' => 'afzn/weixin/addon/card:delete_card',
                    'nav' => 'afzn/weixin/addon/card:index'
                ),
                
                array(
                    'title' => '摇一摇',
                    'ctl' => 'afzn/weixin/addon/shake:index',
                    'menu' => true
                ),
                array(
                    'title' => '摇一摇添加',
                    'ctl' => 'afzn/weixin/addon/shake:create',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇修改',
                    'ctl' => 'afzn/weixin/addon/shake:edit',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇删除',
                    'ctl' => 'afzn/weixin/addon/shake:delete',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇预览',
                    'ctl' => 'afzn/weixin/addon/shake:preview',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'afzn/weixin/addon/shake:sn',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'afzn/weixin/addon/shake:sndelete',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇成员',
                    'ctl' => 'afzn/weixin/addon/shake:snedit',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'afzn/weixin/addon/shake:goods',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'afzn/weixin/addon/shake:goodsdelete',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'afzn/weixin/addon/shake:goodsedit',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '摇一摇奖品',
                    'ctl' => 'afzn/weixin/addon/shake:goodscreate',
                    'nav' => 'afzn/weixin/addon/shake:index'
                ),
                array(
                    'title' => '微助力',
                    'ctl' => 'afzn/weixin/addon/help:index',
                    'menu' => true
                ),
                array(
                    'title' => '微助力添加',
                    'ctl' => 'afzn/weixin/addon/help:create',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力修改',
                    'ctl' => 'afzn/weixin/addon/help:edit',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力删除',
                    'ctl' => 'afzn/weixin/addon/help:delete',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力预览',
                    'ctl' => 'afzn/weixin/addon/help:preview',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'afzn/weixin/addon/help:sn',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'afzn/weixin/addon/help:sndelete',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力成员',
                    'ctl' => 'afzn/weixin/addon/help:snedit',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '查看我的助力',
                    'ctl' => 'afzn/weixin/addon/help:snlist',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'afzn/weixin/addon/help:goods',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'afzn/weixin/addon/help:goodsdelete',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'afzn/weixin/addon/help:goodsedit',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微助力奖品',
                    'ctl' => 'afzn/weixin/addon/help:goodscreate',
                    'nav' => 'afzn/weixin/addon/help:index'
                ),
                array(
                    'title' => '微接力',
                    'ctl' => 'afzn/weixin/addon/relay:index',
                    'menu' => true
                ),
                array(
                    'title' => '微接力添加',
                    'ctl' => 'afzn/weixin/addon/relay:create',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力修改',
                    'ctl' => 'afzn/weixin/addon/relay:edit',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力删除',
                    'ctl' => 'afzn/weixin/addon/relay:delete',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力预览',
                    'ctl' => 'afzn/weixin/addon/relay:preview',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'afzn/weixin/addon/relay:sn',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'afzn/weixin/addon/relay:sndelete',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力成员',
                    'ctl' => 'afzn/weixin/addon/relay:snedit',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '查看我的接力',
                    'ctl' => 'afzn/weixin/addon/relay:snlist',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'afzn/weixin/addon/relay:goods',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'afzn/weixin/addon/relay:goodsdelete',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'afzn/weixin/addon/relay:goodsedit',
                    'nav' => 'afzn/weixin/addon/relay:index'
                ),
                array(
                    'title' => '微接力奖品',
                    'ctl' => 'afzn/weixin/addon/relay:goodscreate',
                    'nav' => 'afzn/weixin/addon/relay:index'
                )
            )
        )
    )
);
