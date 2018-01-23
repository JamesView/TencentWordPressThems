<?php
/**
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="keywords" content="<?php getKeywords(); ?>">
	<meta name="description" content="<?php getDescription(); ?>">
	<title><?php getTitle(); ?></title>
	<link rel="shortcut icon" href="<?php echo cs_get_option('i_favicon_url'); ?>" type="image/x-icon">
	<?php wp_head(); ?>
	<style type="text/css">
		<?php echo cs_get_option('i_code_css'); ?>
		<?php echo getThemeColor(); ?>
	</style>
	<script>
		var carouselSwitcher = "<?php echo cs_get_option('i_carousel_switcher'); ?>";
		var carouselType = "<?php echo cs_get_option('i_carousel_type'); ?>";
		var carouselMouseSwitcher = "<?php echo cs_get_option('i_carousel_mousewheel_switcher'); ?>";
		var siteUrl = "<?php echo site_url(); ?>";
		var imgUrl = "<?php echo get_stylesheet_directory_uri()."/assets/images"; ?>";
		var fancyboxSwitcher = "<?php echo cs_get_option('i_function_fancybox_switcher'); ?>";
		var isHomePage = "<?php echo is_home(); ?>";
		var pagType	= "<?php echo cs_get_option('i_pagination_type'); ?>";
	</script>
<!--	<base target="_blank">-->
</head>
<body <?php body_class(); ?>>
<header id="header">
	<nav class="container">
		<div class="row-mobile">
			<div class="logo">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo cs_get_option('i_logo_url')?>" alt="">
				</a>
			</div>
			<div class="mobile-logo">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo cs_get_option('i_mobile_logo_url')?>" alt="">
				</a>
			</div>
			<?php if (cs_get_option('i_site_title_switcher')): ?>
				<span class="site-title"> <?php bloginfo('name'); ?> </span>
			<?php endif; ?>
			<?php
				wp_nav_menu(array(
					'theme_location' => 'header',
					'container' => 'ul',
					'menu_class' => 'header-menu',
					'walker'	=> new CCWalker(),
					)
				);
			?>
			<?php if (cs_get_option('i_admin_login_switcher')): ?>
				<div class="admin-login">
					<a href="<?php echo home_url(); ?>/wp-admin" target="_blank" class="btn-login">
						<?php if (is_user_logged_in()): ?>
							<?php echo "管理"; ?>
						<?php else: ?>
							<?php echo "登录"; ?>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>
			<?php get_search_form(); ?>
			<div class="search-button">
				<i class="fa fa-search"></i>
			</div>
			<div class="menu-button">
				<i class="fa fa-bars"></i>
			</div>
		</div>
	</nav>
	<div class="mobile-menu-wrap">
		<div class="mobile-menu">
			<?php wp_nav_menu(array('theme_location' => 'header', 'container' => 'ul', 'menu_class' => 'mobile-menu-nav')); ?>
		</div>
		<?php if (cs_get_option('i_admin_login_switcher')): ?>
			<div class="mobile-admin-login">
				<a href="<?php echo home_url(); ?>/wp-admin" target="_blank" class="btn-login">
					<?php if (is_user_logged_in()): ?>
						<?php echo "管理"; ?>
					<?php else: ?>
						<?php echo "登录"; ?>
					<?php endif; ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</header>
</body>