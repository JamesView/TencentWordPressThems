<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 16:07
 */

add_action('widgets_init', 'widgetWechatInit');

function widgetWechatInit() {
    register_widget('widgetWechat');
}

class widgetWechat extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetWechat() {
        $widget_ops = array('classname' => 'widget-wechat', 'description' => '添加网站关注微信公众号');
        // init widgetProfile
        parent::__construct('widget-wechat', "微信公众号", $widget_ops);
    }

    /**
     * How to display the widgetProfile on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );
        /* Our variables from the widget settings. */
        $title = apply_filters('widget_name', $instance['title'] );
        echo $before_widget;
        echo $this->showWidget($title);
        echo $after_widget;
    }

    /**
     * Update the widget settings.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
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
            'title' => '微信公众号',
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <!-- widget title: -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">标题</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <?php
    }

    function showWidget($title) {
        ?>
        <div class="widget-title"><?php echo $title; ?></div>
        <div class="widget-wechat-body">
            <div class="widget-wechat-img">
                <img src="<?php echo cs_get_option('i_follow_wechat') ?>" alt="wechat" >
            </div>
            <div class="widget-wechat-content">
                <h4 class="widget-wechat-title"><?php echo cs_get_option('i_follow_wechat_name'); ?></h4>
                <p class="widget-wechat-account">微信号：<?php echo cs_get_option('i_follow_wechat_id'); ?></p>
                <p class="widget-wechat-description"><?php echo cs_get_option('i_follow_wechat_description'); ?></p>
            </div>
        </div>
    <?php }
}?>
