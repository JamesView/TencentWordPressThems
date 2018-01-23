<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 13:27
 */

add_action('widgets_init', 'widgetCommentInit');

function widgetCommentInit() {
    register_widget('widgetComment');
}

class widgetComment extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetComment() {
        $widget_ops = array('classname' => 'widget-comments', 'description' => '近期评论');
        // init widgetProfile
        parent::__construct('widget-comments', "近期评论", $widget_ops);
    }

    /**
     * How to display the widgetProfile on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );
        /* Our variables from the widget settings. */
        $title = apply_filters('widget_name', $instance['title'] );
        $limit = $instance['limit'];
        echo $before_widget;
        echo $this->showWidget($title, $limit);
        echo $after_widget;
    }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
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
            'title' => '近期评论',
            'limit' => '4',
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <!-- widget title: -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">标题</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <!-- limit -->
        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>">显示数量</label>
            <input type="number" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo $instance['limit']; ?>" style="width:100%;" />
        </p>
        <?php
    }

    function showWidget($title, $limit) {
    ?>
        <div class="widget-title"><?php echo $title; ?></div>
        <ul>
            <?php
            $commentArgs = array(
                'number'    => $limit,
                'status'    => 'approve',
            );
            $comments = get_comments($commentArgs);
            foreach ($comments as $key => $comment) {
                ?>
                <li class="widget-comments-item">
                    <a href="<?php echo get_permalink($comment->comment_post_ID);?>" class="widget-comment-content" >
                        <?php echo wp_trim_words($comment->comment_content, 20, null) ?>
                    </a>
                    <div class="widget-comment-meta">
                        <?php echo get_avatar($comment->comment_author_email, 8, ' ', 'ybzbxcc@163.com'); ?>
                        <a class="widget-comment-author">
                            <?php echo $comment->comment_author ?>
                        </a>
                        <span class="widget-comment-date"><?php echo timeago($comment->comment_date_gmt) ?></span>
                        <a class="widget-comment-title" href="<?php echo get_permalink($comment->comment_post_ID);?>">
                            <?php echo get_post($comment->comment_post_ID)->post_title ?>
                        </a>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
<?php }
}?>
