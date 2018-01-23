<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/30/2016
 * Time: 19:43
 */

/*
    ==================================================
    文章外链跳转伪静态版
    ==================================================
*/
function linkJump($content){
    preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/', $content, $matches);
    if ($matches) {
        foreach ($matches[2] as $val) {
            if (strpos($val, '://') !== false && strpos($val, home_url()) === false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i', $val) && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i', $val)) {
                $content = str_replace("href=\"$val\"", "href=\"" . home_url() . "/go/?url=" .$val. "\" rel=\"nofollow\"", $content);
            }
        }
    }
    return $content;
}
if (cs_get_option('i_seo_link_rule') == true) {
    add_filter('the_content','linkJump',999);
}
/*
    ==================================================
    评论外链跳转
    ==================================================
*/
if (cs_get_option('i_seo_link_rule') == true) {
    add_filter('get_comment_author_link', 'addRedirectCommentLink', 5);
    add_filter('comment_text', 'addRedirectCommentLink', 99);
}
function addRedirectCommentLink($text = ''){
    $text=str_replace('href="', 'target="_blank" rel="nofollow" href="'.get_option('home').'/go/?url=', $text );
    $text=str_replace("href='", "target='_blank' rel='nofollow' href='".get_option('home')."/go/?url=", $text );
    return $text;
}
/*
    ==================================================
    自定义标题
    ==================================================
*/
function getTitle() {
    global $paged;
    if (is_home() && !is_paged()) {
        $title=get_bloginfo("name")."-".get_bloginfo("description");
    } else {
        $title=wp_title("-",true,"right");bloginfo("name");
        $title=' - '.$title.get_bloginfo("description");
    }
    if ($paged<2) {
        echo $title;
    } else {
        echo "$title &#8211; 第 $paged 页";
    }
}
/*
    ==================================================
    自定义keywords&description
    ==================================================
*/
function getKeywords() {
    $keywords = "";
    if (is_home() || is_front_page()) {
        $keywords = cs_get_option('i_seo_keywords');
    } else if (is_single()) {
        $categories = get_the_category(get_the_ID());
        $tags = wp_get_post_tags(get_the_ID());
        foreach ($categories as $category ) {
            $keywords = $keywords.$category->name.", ";
        }
        foreach ($tags as $tag ) {
            $keywords = $keywords.$tag->name.", ";
        }
        $keywords = $keywords.cs_get_option('i_seo_keywords');
    } else if (is_category() || is_tag()) {
        $keywords = single_term_title( '', false );
    } else {
        $keywords = wp_title(",",true, "right");
    }

    echo $keywords;
}

function getDescription() {
    if (is_single()) {
        $description = mb_strimwidth(strip_tags(apply_filters('the_content', get_post(get_the_ID())->post_content)), 0, 166, "");
    } else {
        $description = cs_get_option('i_seo_description');
    }
    echo $description;
}
/*
    ==================================================
    去除分类category代码
    ==================================================
*/
if (cs_get_option('i_seo_category_switcher')) {
    add_action( 'load-themes.php',  'no_category_base_refresh_rules');
    add_action('created_category', 'no_category_base_refresh_rules');
    add_action('edited_category', 'no_category_base_refresh_rules');
    add_action('delete_category', 'no_category_base_refresh_rules');
    function no_category_base_refresh_rules() {
        global $wp_rewrite;
        $wp_rewrite -> flush_rules();
    }
// Remove category base
    add_action('init', 'no_category_base_permastruct');
    function no_category_base_permastruct() {
        global $wp_rewrite, $wp_version;
        if (version_compare($wp_version, '3.4', '<')) {
            // For pre-3.4 support
            $wp_rewrite -> extra_permastructs['category'][0] = '%category%';
        } else {
            $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
        }
    }
// Add our custom category rewrite rules
    add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
    function no_category_base_rewrite_rules($category_rewrite) {
        //var_dump($category_rewrite); // For Debugging
        $category_rewrite = array();
        $categories = get_categories(array('hide_empty' => false));
        foreach ($categories as $category) {
            $category_nicename = $category -> slug;
            if ($category -> parent == $category -> cat_ID)// recursive recursion
                $category -> parent = 0;
            elseif ($category -> parent != 0)
                $category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
            $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
        }
        // Redirect support from Old Category Base
        global $wp_rewrite;
        $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
        $old_category_base = trim($old_category_base, '/');
        $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';
        //var_dump($category_rewrite); // For Debugging
        return $category_rewrite;
    }
// Add 'category_redirect' query variable
    add_filter('query_vars', 'no_category_base_query_vars');
    function no_category_base_query_vars($public_query_vars) {
        $public_query_vars[] = 'category_redirect';
        return $public_query_vars;
    }
// Redirect if 'category_redirect' is set
    add_filter('request', 'no_category_base_request');
    function no_category_base_request($query_vars) {
        //print_r($query_vars); // For Debugging
        if (isset($query_vars['category_redirect'])) {
            $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
            status_header(301);
            header("Location: $catlink");
            exit();
        }
        return $query_vars;
    }
}