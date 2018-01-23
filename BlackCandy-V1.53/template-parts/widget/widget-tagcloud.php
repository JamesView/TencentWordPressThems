<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 16:45
 */

add_action('widgets_init', 'widgetTagcloudInit');

function widgetTagcloudInit() {
    register_widget('widgetTagcloud');
}

class widgetTagcloud extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetTagcloud() {
        $widget_ops = array('classname' => 'widget-tagcloud', 'description' => '显示标签云');
        // init widgetProfile
        parent::__construct('widget-tagcloud', "标签云", $widget_ops);
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
            'title' => '标签云',
            'limit'   => '12',
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">标题</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>">标签数</label>
            <input id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo $instance['limit']; ?>" style="width:100%;" />
        </p>
        <?php
    }

    function showWidget($title, $limit) {
        ?>
        <div class="widget-title"><?php echo $title; ?></div>
        <div class="tagcloud">
            <?php
            $args = array(
                'number'                    => $limit,
                'format'                    => 'flat',
                'orderby'                   => 'name',
                'order'                     => 'ASC',
                'exclude'                   => null,
                'include'                   => null,
                'topic_count_text_callback' => 'default_topic_count_text',
                'link'                      => 'view',
                'taxonomy'                  => 'post_tag',
                'echo'                      => true,
            );
            wp_tag_cloud($args);
            ?>
        </div>
    <?php }
}?>
