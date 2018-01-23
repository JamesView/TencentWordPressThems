<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 11/15/2016
 * Time: 18:51
 */
//在加载管理员界面的时候调用create_meta_box函数
add_action('admin_menu', 'createMetaBox');
//在保存文章的时候调用save_postdata函数来保存自定义数据
add_action('save_post', 'savePostdata');

$thumbnailMetaBox = array(
    "thumbnailUrl" => array(
        "name"=>"thumbnailUrl",
    )
);
function createMetaBox(){
    if(function_exists('add_meta_box')){
        add_meta_box('thumbnailMetaBox','外链特色图','thumbnailMetaBox','post','side','high');
    }
}
function thumbnailMetaBox(){
    global $post,$thumbnailMetaBox;
    foreach($thumbnailMetaBox as $value){
        $metaBoxValue = get_post_meta($post->ID, $value['name'], true);
        echo '<input type="hidden" name="'.$value['name'].'_noncename" id="'.$value['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'"/>';
        echo '<img style="display:block;width:100%;height:auto;margin-bottom: 12px;" src="'.$metaBoxValue.'"/>';
        echo '<input style="width:100%;" value="'.$metaBoxValue.'" name="'.$value['name'].'"/>';
    }
}
function savePostdata($post_id){
    global $post,$thumbnailMetaBox;
    foreach($thumbnailMetaBox as $value){
//        if(!wp_verify_nonce( $_POST[$value['name'].'_noncename'], plugin_basename(__FILE__) )){
//            return $post_id;
//        }
        if('page' == $_POST['post_type']){
            if(!current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }else{
            if(!current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }
        $data = $_POST[$value['name']];
        if(get_post_meta($post_id, $value['name']) == "")
            add_post_meta($post_id, $value['name'], $data, true);
        elseif($data != get_post_meta($post_id, $value['name'], true))
            update_post_meta($post_id, $value['name'], $data);
        elseif($data == "")
            delete_post_meta($post_id, $value['name'], get_post_meta($post_id, $value['name'], true));
    }
}