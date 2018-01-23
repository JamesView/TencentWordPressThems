<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/30/2016
 * Time: 19:45
 */

/*
    ==================================================
    首页每页文章数设置
    ==================================================
*/

/**
 * judge the element within an array
 * @param $array
 * @param $element
 * @return bool
 */
function hasElement($array, $element) {
    if (empty($array)) {
        return false;
    }
    foreach ($array as $value) {
        if ($value == $element) {
            return true;
        }
    }
    return false;
}
function getFooterFriends($location) {
    $args = array(
        'limit'			   => cs_get_option('i_friends_nums'),
        'title_li'         => '',
        'show_images'	   => 0,
        'show_name'		   => 1,
        'categorize'       => 0,
        'link_before'	   => '<span>',
        'link_after'	   => '</span>',
    );
    if ( (is_home() || is_front_page()) && hasElement($location, "index")) {
        echo "<h4>友情链接<span class=\"hidden-xs\">：</span></h4>";
        return wp_list_bookmarks($args);
    } else if (is_page() && hasElement($location, "page")) {
        echo "<h4>友情链接<span class=\"hidden-xs\">：</span></h4>";
        return wp_list_bookmarks($args);
    } else if (is_single() && hasElement($location, "article")){
        echo "<h4>友情链接<span class=\"hidden-xs\">：</span></h4>";
        return wp_list_bookmarks($args);
    } else if (is_archive() && hasElement($location, "archive")) {
        echo "<h4>友情链接<span class=\"hidden-xs\">：</span></h4>";
        return wp_list_bookmarks($args);
    }
    return;
}
/*
    ==================================================
    首页每页文章数设置
    ==================================================
*/
function customPostsPerPage($query) {
    if ($query->is_home() && $query->is_main_query()) {
        $query->set("posts_per_page", cs_get_option('i_posts_per_page'));
    }
}
add_action("pre_get_posts", "customPostsPerPage");

/*
    ==================================================
    获取WordPress所有分类名字和ID
    ==================================================
*/
function getCategory() {
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categories = $wpdb->get_results($request);
    $res = array();
    foreach ($categories as $category) { //调用菜单
        $res[$category->term_id] = $category->name;
    }
    return $res;
}
/*
    ==================================================
    修改时间格式
    ==================================================
*/
function timeago($ptime) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  date('Y-m-d', $ptime),
        30 * 24 * 60 * 60       =>  date('m-d', $ptime),
        7 * 24 * 60 * 60        =>  date('m-d', $ptime),
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        if ($etime < 7 * 24 * 60 * 60){
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . $str;
            }
        } else {
            return $str;
        }
    };
}

/*
    ==================================================
    控制摘要字数
    ==================================================
*/
function get_post_excerpt($post='', $excerpt = ''){
    if ($excerpt) {
        $excerpt_length = $excerpt;
    } else {
        $excerpt_length = is_null(cs_get_option('i_posts_excerpt_length')) ? 100 : cs_get_option('i_posts_excerpt_length');
    }
    if(!$post) $post = get_post();
    $post_excerpt = $post->post_excerpt;
    if($post_excerpt == ''){
        $post_content = $post->post_content;
        $post_content = do_shortcode($post_content);
        $post_content = wp_strip_all_tags( $post_content );

        $post_excerpt = mb_strimwidth($post_content,0,$excerpt_length,'…','utf-8');
    }

    $post_excerpt = wp_strip_all_tags( $post_excerpt );
    $post_excerpt = trim( preg_replace( "/[\n\r\t ]+/", ' ', $post_excerpt ), ' ' );

    return $post_excerpt;
}

/*
    ==================================================
    统计浏览数目
    ==================================================
*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return ($count+1).'';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if (is_singular()) {
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
/*
    ==================================================
    获取文章的第一张图片地址
    ==================================================
*/
function catchFirstImg() {
    global $post, $posts;
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

    if(empty($matches[1])) {
        $firstImg = cs_get_option('i_thumbnail_default');
    } else {
        $firstImg = $matches [1][0];
    }
    return $firstImg;
}
/*
    ==================================================
    标签云所包含的文章数量
    ==================================================
*/
function tagNum($text) {
    $text = preg_replace_callback('|<a (.+?)</a>|i', 'tagNumCallback', $text);
    return $text;
}
function tagNumCallback($matches) {
    $text=$matches[1];
    preg_match('|title=(.+?)style|i',$text ,$a);
    preg_match("/[0-9]+/",$a[0],$b);
    return "<a ".$text ."<span>(".$b[0].")</span></a>";
}
add_filter('wp_tag_cloud', 'tagNum', 1);
/*
    ==================================================
    点赞
    ==================================================
*/
add_action('wp_ajax_nopriv_addLike', 'addLike');
add_action('wp_ajax_addLike', 'addLike');
function addLike(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        }
        else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }

        echo get_post_meta($id,'bigfa_ding',true);
    }
    die;
}
add_action('wp_ajax_nopriv_subLike', 'subLike');
add_action('wp_ajax_subLike', 'subLike');
function subLike(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
        $expire = time() - 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);

        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        }
        else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters - 1));
        }

        echo get_post_meta($id, 'bigfa_ding', true);

    }
    die;
}
/*
    ==================================================
    index sidebar function
    ==================================================
*/
function widgetSetup(){
    $args = array(
        'name'          => '首页固定侧边栏',
        'id'            => 'sidebar-index-affix',
        'description'   => '显示在首页固定侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
    $args = array(
        'name'          => '首页侧边栏',
        'id'            => 'sidebar-index',
        'description'   => '显示在首页侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
    $args = array(
        'name'          => '文章页固定侧边栏',
        'id'            => 'sidebar-article-affix',
        'description'   => '显示在文章页固定侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
    $args = array(
        'name'          => '文章页侧边栏',
        'id'            => 'sidebar-article',
        'description'   => '显示在文章页侧边栏小工具',
        'class'         => 'custom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>'
    );
    register_sidebar($args);
}
add_action('widgets_init', 'widgetSetup');

/*
    ==================================================
    获取第一个分类
    ==================================================
*/
function getOneCategory($categories) {
    if (empty($categories)) {
        return;
    } else {
        $id = get_cat_ID($categories[0]->cat_name);
        $url = get_category_link($id);
        return "<a href='".$url."'>".$categories[0]->cat_name."</a>";
    }

}
/*
    ==================================================
    获取第一个标签
    ==================================================
*/
function getOneTag($tags) {
    if (empty($tags)) {
        return;
    } else {
        $url = get_tag_link($tags[0]->term_id);
        return "<a href='".$url."'>".$tags[0]->name."</a>";
    }

}
/*
    ==================================================
    新窗口打开文章页
    ==================================================
*/
//add_filter('the_content', 'autoBlank');
//function autoBlank($text) {
//    $link = str_replace('<a', '<a target="_blank"', $text);
//    return $link;
//}

/*
    ==================================================
    主题配色
    ==================================================
*/
function getThemeColor() {
    $color = cs_get_option('i_theme_color');
    $style = "";
    $style .= ".header-menu li a:hover, .post .post-title a:hover, #footer .footer-friends li a span:hover, #footer .footer-feature .footer-menu li a:hover, .widget-hotpost a:hover, .article-body a, .article-like .done, .comments .comments-list .comment .comment-body .comment-user a, .comments .comments-list .comment .children .comment-user a, #comment-nav-below .nav-inside .current, .widget-hotpost-brief i, .archive-header .archive-header-title{ color: $color;}
.admin-login a:hover, .carousel-info-meta .carousel-info-category, .tagcloud a:hover, .calendar_wrap table td a, .article-meta .article-meta-tags a, .article-support .article-support-button a, .comments #respond .form-submit input{background-color: $color;}
.article-body h2, .article-body h3 {border-left: 5px solid $color;}.article-like .done{border: 1px solid $color ;}";
    return $style;
}