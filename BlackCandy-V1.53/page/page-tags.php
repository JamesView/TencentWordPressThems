<?php
/**
 * Template Name: 标签
 */
get_header(); ?>
<main class="container" id="main">
	<div class="page-tags page-common row">
		<h1 class="page-title">标签云</h1>
		<?php
		$args = array(
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
</main>

<?php get_footer(); ?>