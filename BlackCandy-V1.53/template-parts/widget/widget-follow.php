<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 11/3/2016
 * Time: 09:23
 */

add_action('widgets_init', 'widgetFollowInit');

function widgetFollowInit() {
    register_widget('widgetFollow');
}

class widgetFollow extends WP_Widget {

    /**
     * widgetProfile setup
     */
    function widgetFollow() {
        $widget_ops = array('classname' => 'widget-follow', 'description' => '关注我们功能，具体在[主题配置]->[关注我们]中设置');
        // init widgetProfile
        parent::__construct('widget-follow', "关注我们", $widget_ops);
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
        <div class="widget widget-follow">
        <table>
            <tbody>
            <tr>
                <td class="follow-wechat">
                    <i class="fa fa-wechat"></i>
                    <div class="follow-wechat-popup">
                        <img src="<?php echo cs_get_option( 'i_follow_wechat' ); ?> " alt="wechat">
                    </div>
                </td>
                <td class="follow-weibo">
                    <a target="blank" href="<?php echo cs_get_option('i_follow_weibo') ?>"><i class="fa fa-weibo"></i></a>
                </td>
                <td class="follow-qq">
                    <a target="_blank" href="tencent://AddContact/?fromId=50&fromSubId=1&subcmd=all&uin=<?php echo cs_get_option('i_follow_qq') ?>">
                        <i class="fa fa-qq"></i>
                    </a>
                </td>
                <td class="follow-rss">
                    <a target="_blank" href="/feed/atom"><i class="fa fa-rss"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    <?php }
}?>
