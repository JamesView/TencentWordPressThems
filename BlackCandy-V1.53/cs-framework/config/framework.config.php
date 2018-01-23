<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => '主题配置',
  'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'cs-framework',
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'framework_title' => '黑糖主题 <small>个性化配置</small>',
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// a option section for options overview  -
// ----------------------------------------
$options[]      = array(
	'name'        => 'overview',
	'title'       => '常规',
	'icon'        => 'fa fa-star',
	'fields'      => array(
        array(
            'type'  => 'notice',
            'class' => 'info',
            'content'   => '头部设置',
        ),
		array(
			'id'      => 'i_logo_url',
			'type'    => 'upload',
			'title'   => '网站logo',
			'default' => get_template_directory_uri()."/assets/images/logo.png",
			'help'    => '上传网站logo',
			'desc'     => '高度42px，建议长度不超过160px',
		),
		array(
			'id'      => 'i_mobile_logo_url',
			'type'    => 'upload',
			'title'   => '移动端网站logo',
			'default' => get_template_directory_uri()."/assets/images/logo_mobile.png",
			'help'    => '上传移动端网站logo',
			'desc'     => '上传移动端网站logo，建议大小为42 * 42',
		),
        array(
            'id'      => 'i_favicon_url',
            'type'    => 'upload',
            'title'   => '网站favicon',
            'default' => get_template_directory_uri()."/assets/images/favicon.ico",
            'help'    => '上传网站favicon',
        ),
		array(
			'id'      => 'i_site_title_switcher',
			'type'    => 'switcher',
			'title'   => '是否显示网站logo处标题',
			'default' => false,
		),
        array(
            'id'      => 'i_admin_login_switcher',
            'type'    => 'switcher',
            'title'   => '显示后台登录按钮',
            'default' => false,
        ),
        // theme color
        array(
            'id'         => 'i_theme_color',
            'type'       => 'color_picker',
            'title'      => '主题配色',
            'default'    => '#38B7EA',
            'info'       => '选择你喜欢的主题颜色',
        ),
        // post setting
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '文章列表设置',
        ),
        array(
            'id'      => 'i_thumbnail_default',
            'type'    => 'upload',
            'title'   => '默认缩略图',
            'default' => get_template_directory_uri()."/assets/images/thumbnail_default.png",
        ),
        array(
            'id' => 'i_posts_per_page',
            'type' => 'number',
            'title' => '首页每页文章数',
            'default' => 6,
        ),
        array(
            'id' => 'i_posts_excerpt_length',
            'type' => 'number',
            'title' => '摘要数量',
            'default' => 100,
        ),
        array(
            'id'           => 'i_category_not_in',
            'type'         => 'checkbox',
            'title'        => '该分类下文章不显示在文章列表中',
            'options'      => getCategory(),
        ),

  ),
);

/*
    ==================================================
    footer
    ==================================================
*/
$options[]      = array(
    'name'        => 'footer',
    'title'       => '底部设置',
    'icon'        => 'fa fa-bars',
    'fields'      => array(
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => 'footer设置',
        ),
        array(
            'id'      => 'i_footer_theme_switcher',
            'type'    => 'switcher',
            'title'   => '底部网站介绍开关',
            'default' => true,
        ),
        array(
            'id'      => 'i_footer_feature_switcher',
            'type'    => 'switcher',
            'title'   => '底部功能开关',
            'default' => true,
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '底部友情链接',
        ),
        array(
            'id'      => 'i_footer_friends_switcher',
            'type'    => 'switcher',
            'title'   => '底部友情链接开关',
            'default' => true,
        ),
        array(
            'id'           => 'i_footer_friends_location',
            'type'         => 'checkbox',
            'title'        => '底部友情链接显示位置',
            'options'      => array(
                'index'     => '首页',
                'page'      => '独立页面',
                'article'   => '文章页',
                'archive'   => '分类、标签、搜索页'
            ),
            'dependency'   => array('i_footer_friends_switcher', '==', 'true'),
        ),
        array(
            'id'        => 'i_friends_nums',
            'type'      => 'number',
            'title'     => '底部友情链接数量',
            'default'   => 3,
            'dependency' => array("i_footer_friends_switcher", "==", "true"),
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '底部网站信息',
        ),
        array(
            'id' => 'i_site_date',
            'type' => 'text',
            'title' => '建站时间',
            'default' => 2015,
        ),
        array(
            'id' => 'i_site_version',
            'type' => 'text',
            'title' => '版本号',
            'default' => '1.50',
        ),
        array(
            'id' => 'i_site_description',
            'type' => 'text',
            'title' => '网站简洁介绍',
            'default' => "为极客、创意工作者而设计",
        ),
        array(
            'id'      => 'i_site_record',
            'type'    => 'text',
            'title'   => '网站备案号',
            'default' => "京ICP备1000000号-01",
        ),
    ),
);

/*
    ==================================================
    图片轮播功能
    ==================================================
*/
$options[]   = array(
	'name'     => 'carousel',
	'title'    => '图片轮播',
	'icon'     => 'fa fa-picture-o',
	'fields'   => array(
		// follow us
		array(
			'type' => 'notice',
			'class' => 'success',
			'content' => '图片轮播'
		),
        array(
            'id' => 'i_carousel_switcher',
            'type' => 'switcher',
            'title' => '图片轮播功能开关',
            'default' => true,
        ),
        array(
            'id' => 'i_carousel_mousewheel_switcher',
            'type' => 'switcher',
            'title' => '鼠标控制轮播开关',
        ),
		array(
			'id'           => 'i_carousel_type',
			'type'         => 'radio',
			'title'        => '选择图片轮播样式',
			'options'      => array(
				'slide'     => '卡片滑动式',
				'image'     => '大图片式',
				'one'		=> '单图式'
			),
			'default'      => 'slide'
		),
        array(
            'id' => 'i_carousel_info_switcher',
            'type' => 'switcher',
            'title' => '关闭轮播图信息',
            'default'   => false,
        ),
        array(
            'id'        => 'i_carousel_default_numbers',
            'type'      => 'number',
            'title'     => '默认轮播图数量',
            'default'   => 3,
            'after'     => '<p>没有置顶文章和自定义轮播内容时默认显示轮播数量（按照时间顺序显示）</p>'
        ),
		array(
			'type' => 'notice',
			'class' => 'warning',
			'content' => '自定义(广告、标签、分类)'
		),
		// customize carousel
		array(
			'id'              => 'i_carousel_customize',
			'type'            => 'group',
			'title'           => '添加自定义链接',
			'button_title'    => '添加',
			'accordion_title' => '新添加自定义类型',
			'fields'          => array(
				array(
					'id'          => 'i_carousel_customize_title',
					'type'        => 'text',
					'title'       => '标题',
				),
				array(
					'id'          => 'i_carousel_customize_switcher',
					'type'        => 'switcher',
					'title'       => '显示开关',
					'default'     => true,
				),
				array(
					'id'          => 'i_carousel_customize_url',
					'type'        => 'text',
					'title'       => '链接地址',
                    'after'     => '<p><b>填写完整的url地址(http://....)</b></p>',
				),
				array(
					'id'      => 'i_carousel_customize_img',
					'type'    => 'upload',
					'title'   => '图片',
					'default' => get_template_directory_uri()."/assets/images/carousel_bg.png",
					'help'    => '上传背景',
				),
			)
		),
	)
);

/*
    ==================================================
    公告栏设置
    ==================================================
*/
$options[]   = array(
    'name'     => 'notice',
    'title'    => '公告栏设置',
    'icon'     => 'fa fa-bullhorn',
    'fields'   => array(
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '公告栏设置',
        ),
        array(
            'id'    => 'i_notice_switcher',
            'type'  => 'switcher',
            'title' => '公告栏开关',
            'default' => true,
        ),
//        array(
//            'id' => 'i_notice_content',
//            'type' => 'text',
//            'title' => '公告栏内容',
//            'default' => '公告栏内容',
//        ),
        // customize carousel
        array(
            'id'              => 'i_notice_groups',
            'type'            => 'group',
            'title'           => '添加自定义公告栏',
            'button_title'    => '添加',
            'accordion_title' => '新添加公告栏',
            'fields'          => array(
                array(
                    'id'          => 'i_notice_group_switcher',
                    'type'        => 'switcher',
                    'title'       => '公告栏内容',
                    'default'     => true,
                ),
                array(
                    'id'          => 'i_notice_group_content',
                    'type'        => 'textarea',
                    'title'       => '公告栏内容',
                ),
                array(
                    'id'          => 'i_notice_group_url',
                    'type'        => 'text',
                    'title'       => '链接地址',
                ),
            )
        ),
    )
);

/*
    ==================================================
    小功能
    ==================================================
*/
$options[]   = array(
    'name'     => 'function',
    'title'    => '小功能',
    'icon'     => 'fa fa-github',
    'fields'   => array(
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '去除head冗余代码',
        ),
        array(
            'id' => 'i_function_version_switcher',
            'type' => 'switcher',
            'title' => '移除wordpress版本号',
            'default' => true,
        ),
        array(
            'id' => 'i_function_emoji_switcher',
            'type' => 'switcher',
            'title' => '移除emoji',
            'default' => true,
        ),
        array(
            'id' => 'i_function_embed_switcher',
            'type' => 'switcher',
            'title' => '移除embed',
            'default' => true,
        ),
        array(
            'id' => 'i_function_element_switcher',
            'type' => 'switcher',
            'title' => '移除head头部多余元素',
            'default' => true,
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => 'HTTPS设置',
        ),
        array(
            'id' => 'i_function_https_switcher',
            'type' => 'switcher',
            'title' => '开启https',
            'default' => false,
        ),
        // avatar
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '头像设置',
        ),
        array(
            'id' => 'i_function_avatar_ssl_switcher',
            'type' => 'switcher',
            'title' => 'gravater被墙，调用ssl头像链接',
            'default' => true,
        ),
//        array(
//            'id'    =>  'i_function_avatar_location',
//            'type'    => 'upload',
//            'title'   => '上传本地头像',
//            'default' => get_template_directory_uri()."/assets/images/avatar.png",
//            'help'    => '上传本地头像',
//        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '分页设置',
        ),
        array(
            'id'            => 'i_pagination_type',
            'type'          => 'radio',
            'title'         => '选择分页形式',
            'options'       => array(
                'next'      => '下一页/上一页',
                'number'    => '页码',
                'more'		=> 'ajax加载更多',
                'infinite'  => 'ajax无限加载'
            ),
            'default'      => 'more'
        ),
        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '个性功能',
        ),
        array(
            'id'    =>  'i_function_fancybox_switcher',
            'type'  =>  'switcher',
            'title' =>  'fancybox功能开关',
            'default'   =>  false,
        )
    )
);
/*
    ==================================================
    布局
    ==================================================
*/
$options[]   = array(
    'name'     => 'layout',
    'title'    => '布局',
    'icon'     => 'fa fa-cubes',
    'fields'   => array(
        array(
            'type'  => 'notice',
            'class' => 'info',
            'content'   => '首页、分类和标签布局',
        ),
        array(
            'id'           => 'i_layout_index_type',
            'type'         => 'radio',
            'title'        => '选择首页布局',
            'options'      => array(
                'dcolumn'     => '双栏式',
                'cascade'     => '瀑布流',
            ),
            'default'      => 'dcolumn'
        ),
        array(
            'id'           => 'i_layout_archive_type',
            'type'         => 'radio',
            'title'        => '选择分类、标签和搜索结果布局',
            'options'      => array(
                'column'     => '竖排列表',
                'cascade'     => '瀑布流',
            ),
            'default'      => 'cascade'
        ),
    )
);
/*
    ==================================================
    文章页设置
    ==================================================
*/
$options[]   = array(
    'name'     => 'article',
    'title'    => '文章页',
    'icon'     => 'fa fa-book',
    'fields'   => array(
        array(
            'type'  => 'notice',
            'class' => 'info',
            'content'   => '文章页样式设置',
        ),
        array(
            'id'    =>  'i_article_indent_switcher',
            'type'  =>  'switcher',
            'title' =>  '段落首行缩进',
            'default'   =>  false,
        ),
        array(
            'id'    =>  'i_article_support_switcher',
            'type'  =>  'switcher',
            'title' =>  '显示打赏功能',
            'default'   =>  true,
        ),
        array(
            'id'    =>  'i_article_support_description',
            'type'  =>  'text',
            'title' =>  '打赏说明',
            'default'   => '「如果你觉得对你有用，欢迎点击下方按钮对我打赏」',
            'dependency' => array("i_article_support_switcher", "==", "true"),
        ),
        array(
            'id'      => 'i_article_support_zhifubao',
            'type'    => 'upload',
            'title'   => '支付宝收款二维码',
            'default' => get_template_directory_uri()."/assets/images/zhifubao_qrcode.png",
            'desc'     => '上传支付宝收款二维码图片',
            'dependency' => array("i_article_support_switcher", "==", "true"),
        ),
        array(
            'id'      => 'i_article_support_wechat',
            'type'    => 'upload',
            'title'   => '微信收款二维码',
            'default' => get_template_directory_uri()."/assets/images/wechat_qrcode.png",
            'desc'     => '上传微信收款二维码图片',
            'dependency' => array("i_article_support_switcher", "==", "true"),
        ),
        array(
            'id'    =>  'i_article_share_switcher',
            'type'  =>  'switcher',
            'title' =>  '显示分享功能',
            'default'   => true,
        ),
        array(
            'id'    =>  'i_article_copyright_switcher',
            'type'  =>  'switcher',
            'title' =>  '显示版权信息',
            'default'   => true,
        ),
        array(
            'id'    =>  'i_article_like_switcher',
            'type'  =>  'switcher',
            'title' =>  '显示点赞信息',
            'default'   => true,
        ),
    )
);
/*
    ==================================================
    关注我们
    ==================================================
*/
$options[]   = array(
  	'name'     => 'follow',
  	'title'    => '关注我们',
  	'icon'     => 'fa fa-wechat',
  	'fields'   => array(
	  	// follow us
	  	array(
			  'type' => 'notice',
			  'class' => 'warning',
			  'content' => '关注我们'
		),
		array(
		    'id' => 'i_follow_switcher',
		    'type' => 'switcher',
		    'title' => '开启底部关注我们功能',
            'default' => true,
		),
        array(
            'type' => 'notice',
            'class' => 'success',
            'content' => '微信公众号设置',
        ),
//        array(
//            'id' => 'i_sidebar_wechat_switcher',
//            'type' => 'switcher',
//            'title' => '开启侧边栏微信公众号',
//            'default' => true,
//        ),
		array(
		  'id'      => 'i_follow_wechat',
		  'type'    => 'upload',
		  'title'   => '微信公众号二维码',
		  'default' => get_template_directory_uri()."/assets/images/wechat_official_account.png",
		  'help'    => '上传微信公众号二维码',
		),
        array(
            'id' => 'i_follow_wechat_name',
            'type' => 'text',
            'title' => '微信公众号名',
            'default' => '创造狮',
        ),
        array(
            'id' => 'i_follow_wechat_id',
            'type' => 'text',
            'title' => '微信公众号ID',
            'default' => 'chuangzaoshi',
        ),
        array(
            'id' => 'i_follow_wechat_description',
            'type' => 'text',
            'title' => '微信公众号说明',
            'default' => '扫描关注我们',
        ),
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => '其他设置',
        ),
		array(
		  'id'    => 'i_follow_weibo',
		  'type'  => 'text',
		  'title' => '微博地址',
		),
		array(
		    'id'    => 'i_follow_qq',
		    'type'  => 'text',
            'default' => '164903112',
		    'title' => 'qq号',
		),
		array(
		    'id'      => 'i_follow_rss',
		    'type'    => 'switcher',
            'default' => true,
		    'title'   => 'RSS订阅',
		)
	  )
);

/*
    ==================================================
    广告设置
    ==================================================
*/
$options[]   = array(
	'name'     => 'advertisement',
	'title'    => '广告设置',
	'icon'     => 'fa fa-money',
	'fields'   => array(
		// advertisement
		array(
			'id' => 'i_advertisement_switcher',
			'type' => 'switcher',
			'title' => '一键开关闭广告功能',
			'default' => true,
		),
		array(
			'type' => 'notice',
			'class' => 'warning',
			'content' => '文章列表广告设置'
		),
		array(
			'id'   => 'i_advertisement_article_list',
			'type' => 'textarea',
			'title' => '文章列表广告代码'
		),
		array(
			'id'   => 'i_advertisement_article_list_after',
			'type' => 'number',
			'default' => 3,
			'title' => '广告位于文章列表第几篇之后（最新的文章算第一篇）'
		),
		array(
			'type' => 'notice',
			'class' => 'success',
			'content' => '文章底部广告设置'
		),
		array(
			'id'   => 'i_advertisement_article_tail',
			'type' => 'textarea',
			'title' => '文章尾部广告代码'
		),
		array(
			'id'   => 'i_advertisement_sidebar',
			'type' => 'textarea',
			'title' => '侧边栏广告代码'
		),
	)
);

/*
    ==================================================
    SEO设置
    ==================================================
*/
$options[]   = array(
    'name'     => 'seo',
    'title'    => 'SEO设置',
    'icon'     => 'fa fa-bug',
    'fields'   => array(
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '百度主动推送',
        ),
        array(
            'id'    	  => 'i_push_baidu_switcher',
            'type'      => 'switcher',
            'title'     => '百度主动推送',
        ),
        // 接口调用地址
        array(
            'id'            => 'i_push_baidu_api',
            'type'          => 'text',
            'title'         => '接口调用地址',
            'after'  		  => '<p class="cs-text-muted">在站长平台申请的接口调用地址,点击<a href="http://zhanzhang.baidu.com/linksubmit/" target="_blank">这里</a>获取</p>',
            'dependency' => array( 'i_push_baidu_switcher', '==', 'true' ),
        ),
        array(
            'id' => 'i_seo_category_switcher',
            'type' => 'switcher',
            'title' => '去除url中的category',
        ),
        array(
            'id' => 'i_seo_link_rule',
            'type' => 'switcher',
            'title' => '外链跳转',
            'after'  => '需要创建一个go新页面，链接形式是"/go"',
        ),
        array(
            'id'   => 'i_seo_keywords',
            'type' => 'text',
            'title' => '网站关键字keywords',
            'default' => '黑糖主题',
        ),
        array(
            'id'   => 'i_seo_description',
            'type' => 'textarea',
            'title' => '网站描述description',
            'default' => '黑糖(BlackCandy)主题，一款漂亮而优雅的主题，为自媒体、极客而设计！',
        ),
        array(
            'id'   => 'i_seo_statistics',
            'type' => 'textarea',
            'title' => '统计代码',
            'desc' => '支持百度统计',
        ),

    )
);

/*
    ==================================================
    自定义代码
    ==================================================
*/
$options[]   = array(
    'name'     => 'code',
    'title'    => '自定义代码',
    'icon'     => 'fa fa-code',
    'fields'   => array(
        array(
            'class' => 'info',
            'type'  => 'notice',
            'content' => '自定义代码',
        ),
        array(
            'id'   => 'i_code_footer',
            'type' => 'textarea',
            'title' => 'footer自定义代码',
            'desc'  => '显示在网站版权之前'
        ),
        array(
            'id'   => 'i_code_css',
            'type' => 'textarea',
            'title' => '自定义样式css代码',
            'desc' => '不要添加style标签',
        ),
    )
);
/*
    ==================================================
    Backup
    ==================================================
*/
$options[]   = array(
	'name'     => 'backup_section',
	'title'    => '备份',
	'icon'     => 'fa fa-shield',
	'fields'   => array(

		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => 'You can save your current options. Download a Backup and Import.',
		),

		array(
			'type'    => 'backup',
		),

	)
);


// ----------------------------------------
// dependencies                           -
// ----------------------------------------

//$options[]           = array(
//  'name'             => 'dependencies',
//  'title'            => 'Dependencies',
//  'icon'             => 'fa fa-code-fork',
//  'fields'           => array(
//
//    // ------------------------------------
//    // Basic Dependencies
//    // ------------------------------------
//    array(
//      'type'         => 'subheading',
//      'content'      => 'Basic Dependencies',
//    ),
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_1',
//      'type'         => 'text',
//      'title'        => 'If text <u>not be empty</u>',
//    ),
//
//    array(
//      'id'           => 'dummy_1',
//      'type'         => 'notice',
//      'class'        => 'info',
//      'content'      => 'Done, this text option have something.',
//      'dependency'   => array( 'dep_1', '!=', '' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_2',
//      'type'         => 'switcher',
//      'title'        => 'If switcher mode <u>ON</u>',
//    ),
//
//    array(
//      'id'           => 'dummy_2',
//      'type'         => 'notice',
//      'class'        => 'success',
//      'content'      => 'Woow! Switcher is ON',
//      'dependency'   => array( 'dep_2', '==', 'true' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_3',
//      'type'         => 'select',
//      'title'        => 'Select color <u>black or white</u>',
//      'options'      => array(
//        'blue'       => 'Blue',
//        'yellow'     => 'Yellow',
//        'green'      => 'Green',
//        'black'      => 'Black',
//        'white'      => 'White',
//      ),
//    ),
//
//    array(
//      'id'           => 'dummy_3',
//      'type'         => 'notice',
//      'class'        => 'danger',
//      'content'      => 'Well done!',
//      'dependency'   => array( 'dep_3', 'any', 'black,white' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_4',
//      'type'         => 'radio',
//      'title'        => 'If set <u>No, Thanks</u>',
//      'options'      => array(
//        'yes'        => 'Yes, Please',
//        'no'         => 'No, Thanks',
//        'not-sure'   => 'I am not sure!',
//      ),
//      'default'      => 'yes'
//    ),
//
//    array(
//      'id'           => 'dummy_4',
//      'type'         => 'notice',
//      'class'        => 'info',
//      'content'      => 'Uh why?!!!',
//      'dependency'   => array( 'dep_4_no', '==', 'true' ),
//      //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_5',
//      'type'         => 'checkbox',
//      'title'        => 'If checked <u>danger</u>',
//      'options'      => array(
//        'success'    => 'Success',
//        'danger'     => 'Danger',
//        'info'       => 'Info',
//        'warning'    => 'Warning',
//      ),
//    ),
//
//    array(
//      'id'           => 'dummy_5',
//      'type'         => 'notice',
//      'class'        => 'danger',
//      'content'      => 'Danger!',
//      'dependency'   => array( 'dep_5_danger', '==', 'true' ),
//      //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_6',
//      'type'         => 'image_select',
//      'title'        => 'If check <u>Blue box</u> (checkbox)',
//      'options'      => array(
//        'green'      => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
//        'red'        => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
//        'yellow'     => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
//        'blue'       => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
//        'gray'       => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
//      ),
//      'info'         => 'Image select field input="checkbox" model. in checkbox model unselected available.',
//    ),
//
//    array(
//      'id'           => 'dummy_6',
//      'type'         => 'notice',
//      'class'        => 'info',
//      'content'      => 'Blue box selected!',
//      'dependency'   => array( 'dep_6_blue', '==', 'true' ),
//      //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_6_alt',
//      'type'         => 'image_select',
//      'title'        => 'If check <u>Green box or Blue box</u> (checkbox)',
//      'options'      => array(
//        'green'      => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
//        'red'        => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
//        'yellow'     => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
//        'blue'       => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
//        'gray'       => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
//      ),
//      'info'         => 'Multipel Image select field input="checkbox" model. in checkbox model unselected available.',
//      'default'      => 'gray',
//      'attributes'   => array(
//        'data-depend-id' => 'dep_6_alt',
//      ),
//    ),
//
//    array(
//      'id'           => 'dummy_6_alt',
//      'type'         => 'notice',
//      'class'        => 'success',
//      'content'      => 'Green or Blue box selected!',
//      'dependency'   => array( 'dep_6_alt', 'any', 'green,blue' ),
//      //'dependency' => array( 'data-depend-id', 'any', 'value,value' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_7',
//      'type'         => 'image_select',
//      'title'        => 'If check <u>Green box</u> (radio)',
//      'options'      => array(
//        'green'      => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
//        'red'        => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
//        'yellow'     => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
//        'blue'       => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
//        'gray'       => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
//      ),
//      'info'         => 'Image select field input="radio" model. in radio model unselected unavailable.',
//      'radio'        => true,
//      'default'      => 'gray',
//    ),
//
//    array(
//      'id'           => 'dummy_7',
//      'type'         => 'notice',
//      'class'        => 'success',
//      'content'      => 'Green box selected!',
//      'dependency'   => array( 'dep_7_green', '==', 'true' ),
//      //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_7_alt',
//      'type'         => 'image_select',
//      'title'        => 'If check <u>Green box or Blue box</u> (radio)',
//      'options'      => array(
//        'green'      => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
//        'red'        => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
//        'yellow'     => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
//        'blue'       => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
//        'gray'       => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
//      ),
//      'info'         => 'Multipel Image select field input="radio" model. in radio model unselected unavailable.',
//      'radio'        => true,
//      'default'      => 'gray',
//      'attributes'   => array(
//        'data-depend-id' => 'dep_7_alt',
//      ),
//    ),
//
//    array(
//      'id'           => 'dummy_7_alt',
//      'type'         => 'notice',
//      'class'        => 'success',
//      'content'      => 'Green or Blue box selected!',
//      'dependency'   => array( 'dep_7_alt', 'any', 'green,blue' ),
//      //'dependency' => array( 'data-depend-id', 'any', 'value,value' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_8',
//      'type'         => 'image',
//      'title'        => 'Add a image',
//    ),
//
//    array(
//      'id'           => 'dummy_8',
//      'type'         => 'notice',
//      'class'        => 'success',
//      'content'      => 'Added a image!',
//      'dependency'   => array( 'dep_8', '!=', '' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_9',
//      'type'         => 'icon',
//      'title'        => 'Add a icon',
//    ),
//
//    array(
//      'id'           => 'dummy_9',
//      'type'         => 'notice',
//      'class'        => 'success',
//      'content'      => 'Added a icon!',
//      'dependency'   => array( 'dep_9', '!=', '' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    // Advanced Dependencies
//    // ------------------------------------
//    array(
//      'type'         => 'subheading',
//      'content'      => 'Advanced Dependencies',
//    ),
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_10',
//      'type'         => 'text',
//      'title'        => 'If text string <u>hello</u>',
//    ),
//
//    array(
//      'id'           => 'dep_11',
//      'type'         => 'text',
//      'title'        => 'and this text string <u>world</u>',
//    ),
//
//    array(
//      'id'           => 'dep_12',
//      'type'         => 'checkbox',
//      'title'        => 'and checkbox mode <u>checked</u>',
//      'label'        => 'Check me!'
//    ),
//
//    array(
//      'id'           => 'dummy_10',
//      'type'         => 'notice',
//      'class'        => 'info',
//      'content'      => 'Done, Multiple Dependencies worked.',
//      'dependency'   => array( 'dep_10|dep_11|dep_12', '==|==|==', 'hello|world|true' ),
//    ),
//    // ------------------------------------
//
//    // ------------------------------------
//    // Another Dependencies
//    // ------------------------------------
//    array(
//      'type'         => 'subheading',
//      'content'      => 'Another Dependencies',
//    ),
//
//    // ------------------------------------
//    array(
//      'id'           => 'dep_13',
//      'type'         => 'select',
//      'title'        => 'If color <u>black or white</u>',
//      'options'      => array(
//        'blue'       => 'Blue',
//        'black'      => 'Black',
//        'white'      => 'White',
//      ),
//    ),
//
//    array(
//      'id'           => 'dep_14',
//      'type'         => 'select',
//      'title'        => 'If size <u>middle</u>',
//      'options'      => array(
//        'small'      => 'Small',
//        'middle'     => 'Middle',
//        'large'      => 'Large',
//        'xlage'      => 'XLarge',
//      ),
//    ),
//
//    array(
//      'id'           => 'dep_15',
//      'type'         => 'select',
//      'title'        => 'If text is <u>world</u>',
//      'options'      => array(
//        'hello'      => 'Hello',
//        'world'      => 'World',
//      ),
//      'dependency'   => array( 'dep_13|dep_14', 'any|==', 'black,white|middle' ),
//    ),
//
//    array(
//      'id'           => 'dummy_11',
//      'type'         => 'notice',
//      'class'        => 'info',
//      'content'      => 'Well done, Correctly!',
//      'dependency'   => array( 'dep_15', '==', 'world' ),
//    ),
//    // ------------------------------------
//
//  ),
//);

// ------------------------------
// a seperator                  -
// ------------------------------
//$options[] = array(
//  'name'   => 'seperator_2',
//  'title'  => 'Section Examples',
//  'icon'   => 'fa fa-cog'
//);

// ------------------------------
// normal section               -
// ------------------------------
//$options[]   = array(
//  'name'     => 'normal_section',
//  'title'    => 'Normal Section',
//  'icon'     => 'fa fa-minus',
//  'fields'   => array(
//
//    array(
//      'type'    => 'content',
//      'content' => 'This section is empty, add some options...',
//    ),
//
//  )
//);

// ------------------------------
// accordion sections           -
// ------------------------------
//$options[]   = array(
//  'name'     => 'accordion_section',
//  'title'    => 'Accordion Sections',
//  'icon'     => 'fa fa-bars',
//  'sections' => array(
//
//    // sub section 1
//    array(
//      'name'     => 'sub_section_1',
//      'title'    => 'Sub Sections 1',
//      'icon'     => 'fa fa-minus',
//      'fields'   => array(
//
//        array(
//          'type'    => 'content',
//          'content' => 'This section is empty, add some options...',
//        ),
//
//      )
//    ),
//
//    // sub section 2
//    array(
//      'name'     => 'sub_section_2',
//      'title'    => 'Sub Sections 2',
//      'icon'     => 'fa fa-minus',
//      'fields'   => array(
//
//        array(
//          'type'    => 'content',
//          'content' => 'This section is empty, add some options...',
//        ),
//
//      )
//    ),
//
//    // sub section 3
//    array(
//      'name'     => 'sub_section_3',
//      'title'    => 'Sub Sections 3',
//      'icon'     => 'fa fa-minus',
//      'fields'   => array(
//
//        array(
//          'type'    => 'content',
//          'content' => 'This section is empty, add some options...',
//        ),
//
//      )
//    ),
//
//  ),
//);

// ------------------------------
// a seperator                  -
// ------------------------------
//$options[] = array(
//  'name'   => 'seperator_3',
//  'title'  => 'Others',
//  'icon'   => 'fa fa-gift'
//);

// ------------------------------
// donate                       -
// ------------------------------
//$options[]   = array(
//  'name'     => 'donate_section',
//  'title'    => 'Donate',
//  'icon'     => 'fa fa-heart',
//  'fields'   => array(
//
//    array(
//      'type'    => 'heading',
//      'content' => 'You Guys!'
//    ),
//
//    array(
//      'type'    => 'content',
//      'content' => 'If you want to see more functions and features for this framework, you can buy me a coffee. I need a lot of it when I am creating new stuff for you. Thank you in advance.',
//    ),
//
//    array(
//      'type'    => 'content',
//      'content' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=56MAQNCNELP8J" target="_blank"><img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" alt="Donate" /></a>',
//    ),
//
//  )
//);

// ------------------------------
// license                      -
// ------------------------------
$options[]   = array(
  'name'     => 'license_section',
  'title'    => '创造狮',
  'icon'     => 'fa fa-info-circle',
  'fields'   => array(

    array(
      'type'    => 'heading',
      'content' => '黑糖主题-创造狮团队'
    ),
    array(
      'type'    => 'content',
      'content' => '为自媒体、极客、创意工作者而设计的wordpress主题，详情请访问<a href="http://chuangzaoshi.com/heitang/" target="_blank">黑糖主题</a>',
    ),

  )
);

CSFramework::instance( $settings, $options );
