<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/30/2016
 * Time: 19:41
 */

/*
    ==================================================
    小功能：隐藏js/css附加的WP版本号
    ==================================================
*/
function removeWpVersion( $src ) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
        $src = str_replace($wp_version, $wp_version + 6.25, $src);
    }
    return $src;
}
if (cs_get_option('i_function_version_switcher')) {
    remove_action('wp_head', 'wp_generator');
    add_filter( 'script_loader_src', 'removeWpVersion' );
    add_filter( 'style_loader_src', 'removeWpVersion' );
}
/*
    ==================================================
    小功能：禁止/移除前台自动加载的emjo脚本（自带表情）
    ==================================================
*/
function disableEmojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disableEmojisTinymce' );
}
if (cs_get_option('i_function_emoji_switcher')) {
    add_action('init', 'disableEmojis');
}
function disableEmojisTinymce( $plugins ) {
    return array_diff($plugins, array('wpemoji'));
}
/*
    ==================================================
    小功能：移除head头部多余代码
    ==================================================
*/
if (cs_get_option('i_function_element_switcher')) {
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    // 移除wp-json
    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');
    remove_action('wp_head', 'rest_output_link_wp_head', 10 );
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10 );
}
/*
    ==================================================
    小功能：移除head头部多余代码
    ==================================================
*/
if (cs_get_option('i_function_embed_switcher')) {
    function disable_embeds_init() {
        global $wp;
        $wp->public_query_vars = array_diff( $wp->public_query_vars, array( 'embed', ) );
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
        add_filter( 'embed_oembed_discover', '__return_false' );
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
        add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
        add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    }
    add_action( 'init', 'disable_embeds_init', 9999 );
    function disable_embeds_tiny_mce_plugin( $plugins ) {
        return array_diff( $plugins, array( 'wpembed' ) );
    }
    function disable_embeds_rewrites( $rules ) {
        foreach ( $rules as $rule => $rewrite ) {
            if ( false !== strpos( $rewrite, 'embed=true' ) ) {
                unset( $rules[ $rule ] );
            }
        }
        return $rules;
    }
    function disable_embeds_remove_rewrite_rules() {
        add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
        flush_rewrite_rules();
    }
    register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
    function disable_embeds_flush_rewrite_rules() {
        remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
        flush_rewrite_rules();
    }
    register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );
}
/*
    ==================================================
    小功能：显示分页页码
    ==================================================
*/
function paginationNav($range = 9){
    global $paged, $wp_query, $max_page;
    if ( !$max_page ) {
        $max_page = $wp_query->max_num_pages;
    }
    if($max_page > 1){
        if(!$paged){
            $paged = 1;
        }
//        if($paged != 1){
//            echo "<a href='" . get_pagenum_link(1) . "' class='home' title='跳转到首页'> 返回首页 </a>";
//        }
        echo "<div class='previous pull-left'>";
            previous_posts_link('上一页');
        echo "</div>";

        echo "<div class='count d-inline-display'>第 $paged / $max_page 页</div>";
//        if($max_page > $range){
//            if($paged < $range){
//                for($i = 1; $i <= ($range + 1); $i++){
//                    echo "<a href='" . get_pagenum_link($i) ."'";
//                    if($i==$paged)echo " class='current'";echo ">$i</a>";
//                }
//            }
//            elseif($paged >= ($max_page - ceil(($range/2)))) {
//                for($i = $max_page - $range; $i <= $max_page; $i++){
//                    echo "<a href='" . get_pagenum_link($i) ."'";
//                    if($i==$paged)echo " class='current'";echo ">$i</a>";
//                }
//            }
//            elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
//                for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
//                    echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged)
//                        echo " class='current'";echo ">$i</a>";
//                }
//            }
//        }
//        else{
//            for($i = 1; $i <= $max_page; $i++){
//                echo "<a href='" . get_pagenum_link($i) ."'";
//                if($i==$paged)
//                    echo " class='current'";echo ">$i</a>";
//            }
//        }
        echo "<div class='next pull-right'>";
            next_posts_link(' 下一页 ');
        echo "</div>";
//        if($paged != $max_page){
//            echo "<a href='" . get_pagenum_link($max_page) . "' class='back' title='跳转到最后一页'> 最后一页 </a>";
//        }
    }
}
//
//if (cs_get_option('i_function_lazyload_switcher')) {
//    add_filter ('the_content', 'lazyloadImagesReplace');
//    function lazyloadImagesReplace($content) {
//        if(!is_feed()) {
//        $content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-original=\"\$2\" \$3>\n<noscript>\$0</noscript>",$content);
////            $content=str_replace("src", "data-original", $content);
//        }
//        return $content;
//    }
//}
