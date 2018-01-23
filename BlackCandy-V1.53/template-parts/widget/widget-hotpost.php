<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 12:44
 */

add_action('widgets_init', 'widgetHotpostInit');

function widgetHotpostInit() {
    register_widget('widgetHotpost');
}

class widgetHotpost extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetHotpost() {
        $widget_ops = array('classname' => 'widget-hotpost', 'description' => '多种样式排序的文章');
        // init widgetProfile
        parent::__construct('widget-hotpost', "文章展示", $widget_ops);
    }

    /**
     * How to display the widgetProfile on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );
        /* Our variables from the widget settings. */
        $title = apply_filters('widget_name', $instance['title'] );
        $type = $instance['type'];
        $style = $instance['style'];
        $limit = $instance['limit'];
        echo $before_widget;
        echo $this->showWidget($title, $type, $style, $limit);
        echo $after_widget;
    }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['type'] = strip_tags( $new_instance['type'] );
        $instance['style'] = strip_tags( $new_instance['style'] );
        $instance['limit'] = strip_tags( $new_instance['limit'] );
        return $instance;
    }

    /**
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() function
     * when creating your form elements. This handles the confusing stuff.
     */
    function form( $instance ) {
        /* Set up some default widget settings. */
        $defaults = array(
            'title' => '热门文章',
            'type' => 'hot',
            'style' => 'image',
            'limit' => '5',
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <!-- widget title: -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">显示标题</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <!-- type -->
        <p>
            <label for="<?php echo $this->get_field_id( 'type' ); ?>">类型</label>
            <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat" style="width:100%;">
                <option value="hot" <?php if ( 'hot' == $instance['type'] ) echo 'selected="selected"'; ?>>热门</option>
                <option value="random" <?php if ( 'random' == $instance['type'] ) echo 'selected="selected"'; ?>>随机</option>
                <option value="comment" <?php if ( 'comment' == $instance['type'] ) echo 'selected="selected"'; ?>>评论数</option>
            </select>
        </p>
        <!-- style -->
        <p>
            <label for="<?php echo $this->get_field_id( 'style' ); ?>">样式</label>
            <select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat" style="width:100%;">
                <option value="image" <?php if ( 'image' == $instance['style'] ) echo 'selected="selected"'; ?>>图片</option>
                <option value="side" <?php if ( 'side' == $instance['style'] ) echo 'selected="selected"'; ?>>侧边图片</option>
                <option value="brief" <?php if ( 'brief' == $instance['style'] ) echo 'selected="selected"'; ?>>简约</option>
            </select>
        </p>
        <!-- limit -->
        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>">显示数量</label>
            <input type="number" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo $instance['limit']; ?>" style="width:100%;" />
        </p>
        <!-- Sex: Select Box -->
        <?php
    }

    function showWidget($title, $type, $style, $limit) {
    ?>
        <div class="widget-title"><?php echo $title ?></div>
        <ul class="widget-hotpost-<?php echo $style; ?>">
            <?php
                if ($type == 'hot') {
                    $args = array(
                        'post_type'         => 'post',
                        'post_status'       => 'publish',
                        'posts_per_page' => $limit,
                        'ignore_sticky_posts' => 1, // 不考虑置顶
                        'meta_key'  => 'post_views_count',
                        'orderby' => array('meta_value_num' => 'DESC', 'date' => 'DESC')
                    );
                } else if ($type == 'random') {
                    $args = array(
                        'post_type'         => 'post',
                        'post_status'       => 'publish',
                        'posts_per_page' => $limit,
                        'ignore_sticky_posts' => 1, // 不考虑置顶
                        'orderby' => 'rand',
                    );
                } else if ($type == 'comment'){
                    $args = array(
                        'post_type'         => 'post',
                        'post_status'       => 'publish',
                        'posts_per_page' => $limit,
                        'ignore_sticky_posts' => 1, // 不考虑置顶
                        'orderby' => 'comment_count',
                    );
                }

                $hotPost = new WP_Query($args);
            ?>
            <?php if ($hotPost->have_posts()) : ?>
                <?php while ($hotPost->have_posts()) : $hotPost->the_post(); ?>
                    <?php if ($style == 'image'): ?>
                        <a href="<?php the_permalink(); ?>" class="widget-hotpost-image-item">
                            <div class="widget-hotpost-image-overlay"></div>
                            <div class="recent-post-img">
                                <?php get_template_part('template-parts/thumbnail'); ?>
                            </div>
                            <div class="widget-hotpost-image-title"><?php the_title(); ?></div>
                        </a>
                    <?php elseif ($style == 'side'): ?>
                        <li>
                            <div class="recent-post-img">
                                <?php get_template_part('template-parts/thumbnail'); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <i class="fa fa-caret-right"></i>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                            <div class="widget-hotpost-brief-time">
                                <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endwhile; wp_reset_postdata();?>
            <?php endif; ?>
        </ul>
<?php }
}?>
