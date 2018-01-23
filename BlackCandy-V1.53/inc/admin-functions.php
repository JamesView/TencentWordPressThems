<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/30/2016
 * Time: 19:48
 */

/*
    ==================================================
    默认关闭后台导航栏
    ==================================================
*/
add_filter('show_admin_bar', '__return_false');
/*
    ==================================================
    Login Page
    ==================================================
*/
//添加登录页背景图
function customLoginHead() {
    echo '<link rel="stylesheet" tyssspe="text/css" href="' . get_bloginfo('template_directory') . '/assets/css/login.css" />';
}
add_action('login_head', 'customLoginHead');
function customLoginFooter() {
    echo '<script src="'.'https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"'.'></script>';
    echo '<script src="'.get_bloginfo('template_directory').'/assets/js/login.js"'.'></script>';
}
add_action('login_footer', 'customLoginFooter');

/*
 * This theme styles the visual editor to resemble the theme style,
 * specifically font, colors, icons, and column width.
 */
add_editor_style("assets/css/editor-style.css");
