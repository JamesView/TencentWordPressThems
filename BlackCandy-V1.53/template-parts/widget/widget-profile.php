<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 10:30
 */
add_action('widgets_init', 'widgetProfileInit');

function widgetProfileInit() {
    register_widget('WidgetProfile');
}

class widgetProfile extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetProfile() {
        $widget_ops = array('classname' => 'widget-profile', 'description' => '作者信息简介');
        // init widgetProfile
        parent::__construct('widget-profile', "作者信息", $widget_ops);
    }

    /**
     * How to display the widgetProfile on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );
        /* Our variables from the widget settings. */
        $type = $instance['type'];
        echo $this->showWidget($type);
    }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['type'] = $new_instance['type'];
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
            'type' => 'elegant',
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'type' ); ?>">样式</label>
            <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat" style="width:100%;">
                <option value="brief" <?php if ( 'brief' == $instance['type'] ) echo 'selected="selected"'; ?>>简约</option>
                <option value="elegant" <?php if ( 'elegant' == $instance['type'] ) echo 'selected="selected"'; ?>>精美卡片</option>
            </select>
        </p>
        <?php
    }

    function showWidget($type) {
?>
        <?php
            global $post;
            $authorID = $post->post_author;
        ?>
        <?php if ($type == "brief"): ?>
            <div class="widget widget-profile-brief">
                <div class="widget-profile-top">
                    <div class="widget-profile-avatar">
                        <?php echo get_avatar($authorID, 60);?>
                    </div>
                    <div class="widget-profile-user">
                        <a href="<?php echo get_the_author_meta('user_url',  $authorID); ?>" target="_blank">
                            <?php echo get_the_author_meta('nickname',  $authorID); ?>
                        </a>
                    </div>
                    <div class="widget-profile-article">
                        共发表了<?php echo count_user_posts($authorID);?>篇文章
                    </div>
                </div>
                <div class="widget-profile-description">
                    <?php echo get_the_author_meta('description',  $authorID); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="widget widget-profile-elegant">
                <div class="widget-profile-avatar">
                    <?php echo get_avatar($authorID, 60);?>
                </div>
                <div class="widget-profile-user">
                    <a href="<?php echo get_the_author_meta('user_url',  $authorID); ?>" target="_blank">
                        <?php echo get_the_author_meta('nickname',  $authorID); ?>
                    </a>
                </div>
                <div class="widget-profile-article">
                    共发表了<?php echo count_user_posts($authorID);?>篇文章
                </div>
                <div class="widget-profile-description">
                    <?php echo get_the_author_meta('description',  $authorID); ?>
                </div>
            </div>
        <?php endif; ?>

<?php }
}?>