<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/31/2016
 * Time: 17:02
 */

add_action('widgets_init', 'widgetAdvertisementInit');

function widgetAdvertisementInit() {
    register_widget('widgetAdvertisement');
}

class widgetAdvertisement extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetAdvertisement() {
        $widget_ops = array('classname' => 'widget-advertisement', 'description' => '增加侧边栏广告栏');
        // init widgetProfile
        parent::__construct('widget-advertisement', "广告栏", $widget_ops);
    }

    /**
     * How to display the widgetProfile on the screen.
     */
    function widget( $args, $instance ) {
        extract( $args );
        echo $this->showWidget();
    }
    function showWidget() {
        ?>
        <?php if (cs_get_option('i_advertisement_switcher')): ?>
            <div class="sidebar-advertisement">
                <?php echo cs_get_option('i_advertisement_sidebar'); ?>
            </div>
        <?php endif; ?>

    <?php }
}?>
