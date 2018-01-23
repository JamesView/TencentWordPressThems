<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/30/2016
 * Time: 19:38
 */

/*
    ==================================================
    百度实时推送
    ==================================================
*/
function pushBaidu($post_id){
    if(get_post_meta($post_id,'pushBaidu',true) == 1) {
        return;
    }
    $PostUrl = get_permalink($post_id);
    $urls=array($PostUrl);
    $api = cs_get_option('i_push_baidu_api');
    $ch = curl_init();
    $options =  array(
        CURLOPT_URL => $api,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => implode("\n", $urls),
        CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
    );
    curl_setopt_array($ch, $options);
//    $result = curl_exec($ch);
//    $request = new WP_Http;
//    $result = $request->request($api, array('method' => 'POST','body' => $PostUrl, 'headers' => 'Content-Type: text/plain') );
//    $result = json_decode($result['body'],true);
    $result = json_decode(curl_exec($ch),true);
    //如果推送成功则在文章新增自定义栏目Baidusubmit，值为1
    if (array_key_exists('success',$result)) {
        add_post_meta($post_id, 'pushBaidu', 1, true);
    } else {
        add_post_meta($post_id, 'pushBaidu', 0, true);
    }
}
if (cs_get_option('i_push_baidu_switcher')) {
    add_action('publish_post', 'pushBaidu', 0);
}
