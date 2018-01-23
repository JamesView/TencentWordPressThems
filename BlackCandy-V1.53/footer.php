<?php
/**
 * The template for displaying the footer
 */
?>

<footer id="footer">
	<div class="container" style="position: relative; margin-top: 22px;" data-position="c478d56bd13b8e71">
		<?php if (cs_get_option('i_footer_theme_switcher')): ?>
			<div class="footer-theme hidden-xs">
				<h4><?php echo get_bloginfo('name')."<span class=\"hidden-xs\">：</span>"; ?></h4>
				<span><?php echo bloginfo('description'); ?></span>
			</div>
		<?php endif; ?>
		<?php if (cs_get_option('i_footer_feature_switcher')): ?>
			<div class="footer-feature">
				<h4>功能<span class="hidden-xs">：</span></h4>
				<?php wp_nav_menu(array('theme_location' => 'footer', 'container' => 'ul', 'menu_class' => 'footer-menu')); ?>
			</div>
		<?php endif; ?>

		<?php if (cs_get_option('i_follow_switcher')): ?>
			<ul class="footer-follow">
				<li class="follow-wechat">
					<a>
						<i class="fa fa-wechat"></i>
					</a>
					<div class="follow-wechat-popup">
						<img src="<?php echo cs_get_option( 'i_follow_wechat' ); ?> " alt="wechat">
					</div>
				</li>
				<li class="follow-weibo">
					<a target="blank" href="<?php echo cs_get_option('i_follow_weibo') ?>">
						<i class="fa fa-weibo"></i>
					</a>
				</li>
				<li class="follow-qq">
					<a href="tencent://AddContact/?fromId=50&fromSubId=1&subcmd=all&uin=<?php echo cs_get_option('i_follow_qq') ?>" target="_blank">
						<i class="fa fa-qq"></i>
					</a>
				</li>
				<li class="follow-rss">
					<a href="<?php echo site_url(); ?>/feed/atom" target="_blank">
						<i class="fa fa-rss"></i>
					</a>
				</li>
			</ul>
		<?php endif ?>

		<?php if (cs_get_option('i_footer_friends_switcher')): ?>
			<div class="footer-friends hidden-xs">
				<?php getFooterFriends(cs_get_option('i_footer_friends_location')); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="container">
        <?php echo cs_get_option('i_code_footer'); ?>
    </div>
	<div class="copyright">
		<div class="container">
			<p>
				Copyright © <?php echo cs_get_option('i_site_date'); ?>-2016
				<?php echo bloginfo('name') ?> - <?php echo cs_get_option('i_site_description'); ?> / 版本 V <?php echo cs_get_option('i_site_version'); ?>
				<span style="margin-right: 12px;" class="hidden-xs">
					<?php echo cs_get_option('i_site_record'); ?>
				</span>
				<script>
					<?php echo cs_get_option('i_seo_statistics'); ?>
				</script>
			</p>
		</div>
	</div>
<!--	--><?php //var_dump(cs_get_option('i_footer_friends_location')); ?>
</footer>
<?php wp_footer(); ?>

<div class="overlay"></div>

<div class="scrollTop">
	<i class="fa fa-arrow-up"></i>
</div>
</body>
</html>