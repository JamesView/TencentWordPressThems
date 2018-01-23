<?php

/**
 *
 * Codestar Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 */
require_once dirname(__FILE__).'/cs-framework/cs-framework.php';
define( 'CS_ACTIVE_FRAMEWORK',  true  ); // default true
define( 'CS_ACTIVE_METABOX',    false ); // default true
define( 'CS_ACTIVE_SHORTCODE',  false ); // default true
define( 'CS_ACTIVE_CUSTOMIZE',  false ); // default true
/*
    ==================================================
    加载css和js文件
    ==================================================
*/
function scriptEnqueue(){
    wp_enqueue_style('style', get_template_directory_uri().'/style.css', array(), '1.0.0', 'all');
    wp_enqueue_script('cdnjquery', 'https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js', array(), '2.1.4', true);
    if (!is_home()) {
        wp_enqueue_script('PrismJs', get_template_directory_uri().'/assets/js/prism.js', array(), '1.5.0', true);
        wp_enqueue_style('PrismCss', get_template_directory_uri().'/assets/css/prism.css', array(), '1.5.0', 'all');
    }
    if (cs_get_option('i_carousel_switcher') && is_home()) {
        wp_enqueue_style('owlcss', get_template_directory_uri().'/assets/css/owl.carousel.css', array(), '1.3.2', 'all');
        wp_enqueue_style('owlthemecss', get_template_directory_uri().'/assets/css/owl.carousel.css', array(), '2.1.6', 'all');
        wp_enqueue_script('owlJs', get_template_directory_uri().'/assets/js/owl.carousel.min.js', array(), '2.1.6', true);
    }
    if (cs_get_option('i_carousel_mousewheel_switcher')) {
        wp_enqueue_script('MouseWheel', 'https://cdn.bootcss.com/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js', array(), '3.1.13', true);
    }
    if (cs_get_option('i_function_fancybox_switcher') && !is_home()) {
        wp_enqueue_style('FancyboxCss', 'http://apps.bdimg.com/libs/fancybox/2.1.4/jquery.fancybox.min.css', array(), '2.1.4', 'all');
        wp_enqueue_script('FancyboxJs', 'https://apps.bdimg.com/libs/fancybox/2.1.4/jquery.fancybox.min.js', array(), '2.1.4', true);
    }
    wp_enqueue_script('js', get_template_directory_uri().'/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'scriptEnqueue');

/*
    ==================================================
    include walker file
    ==================================================
*/
include('inc/walker.php');
/*
    ==================================================
    include shortcode file
    ==================================================
*/
include('inc/shortcode.php');

function adminSetup(){
    /* 启用头部菜单 */
    add_theme_support('menus');
    register_nav_menu( 'header', 'The Header Navigation' );
    register_nav_menu( 'footer', 'The Footer Navigation' );
    /* 启用缩略图功能 */
    add_theme_support('post-thumbnails');
    /* 启动body背景功能 */
    add_theme_support('custom-background');
    /* 启动header背景功能 */
    add_theme_support('custom-header');
    /* 启动post的不同形式 */
    add_theme_support('post-formats', array('aside', 'image', 'status'));
    /* 启动search */
    add_theme_support('html5', array('search-form'));
}
add_action('after_setup_theme', 'adminSetup');

/**
 * 引入推送功能
 */
include('inc/push-baidu.php');
/**
 * 引入小功能
 */
include('inc/feature-functions.php');
/**
 * 引入常用功能
 */
include('inc/custom-functions.php');

/**
 * 引入seo功能
 */
include('inc/seo-functions.php');
/**
 * 引入后台功能
 */
include('inc/admin-functions.php');
/**
 * 引入自定义小工具功能
 */
include('inc/widget-functions.php');
/**
 * tinyMCE button
 */
include('inc/tinymce.php');
/**
 * add meta box
 */
include('inc/metabox.php');

/*
    ==================================================
    调用ssl 头像链接 
    ==================================================
*/
function get_ssl_avatar($avatar) {

    if (is_admin()) {
        $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar, 0);
    } else {
        $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
    }
    return $avatar;
}
if (cs_get_option('i_function_avatar_ssl_switcher')) {
    add_filter('get_avatar', 'get_ssl_avatar');
}
/*
    ==================================================
    modify default gravatar
    ==================================================
*/
//add_filter( 'avatar_defaults', 'defaultGravatar' );
//function defaultGravatar ($avatar_defaults) {
//    if (!cs_get_option('i_function_avatar_location')) {
//        $myAvatar = get_template_directory_uri()."/assets/images/avatar.png";
//    } else {
//        $myAvatar = cs_get_option('i_function_avatar_location');
//    }
//    $avatar_defaults[$myAvatar] = "本地头像，可以在主题配置中设置";
//    return $avatar_defaults;
//}

/*
    ==================================================
    img https
    ==================================================
*/
function img2Https($content){
    if( is_ssl() ){
        $urlArray = explode(":", site_url());
        $content = str_replace('http:'.$urlArray[1].'/wp-content/uploads', 'https:'.$urlArray[1].'/wp-content/uploads', $content);
    }
    return $content;
}
add_filter('the_content', 'img2Https');
/*
    ==================================================
    自定义评论
    ==================================================
*/
function listComments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <div class="comment-avatar">
                <?php echo get_avatar($comment->comment_author_email, $size='48',$default='<path_to_url>' ); ?>
            </div>
            <div class="comment-body" >
                <?php printf(__('<span class="comment-user">%s</span>'), get_comment_author_link()) ?>
                <?php comment_text() ?>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.') ?></em>
                    <br />
                <?php endif; ?>
                <div class="comment-meta">
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment-date">
                        <?php printf(__('%1$s'), get_comment_date('m-d-Y')); ?>
                    </a>
                    <span class="comment-action">
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        <?php edit_comment_link(__('(Edit)'),' ','') ?>
                    </span>
                </div>
            </div>
        </div>
<?php
}
add_filter('pre_option_link_manager_enabled','__return_true');
?>
