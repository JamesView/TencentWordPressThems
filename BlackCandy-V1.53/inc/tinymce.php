<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 11/11/2016
 * Time: 18:51
 */

/**
 * enable more buttons
 * @param $buttons
 * @return array
 */
function enableMoreButtons($buttons) {
    $buttons[] = 'hr';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'cleanup';
    $buttons[] = 'styleselect';
    $buttons[] = 'wp_page';
    $buttons[] = 'anchor';
    $buttons[] = 'backcolor';
    return $buttons;
}
add_filter("mce_buttons_2", "enableMoreButtons");

function addMoreButtons($buttons) {
    array_push($buttons, "btnCode", "btnPanel", "btnButton", "btnVideo", "btnMusic");
    return $buttons;
}
function addTinymcePlugin( $plugin_array ) {
    $plugin_array['tinymceJs'] = get_template_directory_uri() . '/assets/js/tinymce.js';
    return $plugin_array;
}
add_filter("mce_buttons_3", "addMoreButtons");
add_filter('mce_external_plugins', 'addTinymcePlugin');
