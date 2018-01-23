<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 10:33
 */

// 屏蔽WordPress默认小工具
add_action( 'widgets_init', 'unregisterWidgets' );
function unregisterWidgets() {
    unregister_widget( 'WP_Widget_Archives' );
//    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Categories' );
//    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_RSS' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Tag_Cloud' );
    unregister_widget( 'WP_Nav_Menu_Widget' );
}

include(TEMPLATEPATH.'/template-parts/widget/widget-profile.php');
include(TEMPLATEPATH.'/template-parts/widget/widget-advertisement.php');
include(TEMPLATEPATH.'/template-parts/widget/widget-hotpost.php');
include(TEMPLATEPATH.'/template-parts/widget/widget-comment.php');
include(TEMPLATEPATH.'/template-parts/widget/widget-wechat.php');
include(TEMPLATEPATH.'/template-parts/widget/widget-tagcloud.php');
include(TEMPLATEPATH.'/template-parts/widget/widget-follow.php');