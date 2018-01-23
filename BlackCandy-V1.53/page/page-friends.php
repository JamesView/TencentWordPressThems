<?php 
/**
 * Template Name: 友情链接
 */
get_header(); ?>
<main class="container">
	<div class="page-friends page-common row">
		<?php if (have_posts()): ?>
			<?php while (have_posts()) : the_post(); ?>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<article class="page-content">
					<?php the_content(); ?>
				</article>
			<?php endwhile;  ?>
		<?php endif; ?>
		<div>
			<?php
				$args = array(
					'title_li'         => '',
					'show_images'	   => 1,
					'show_name'		   => 1,
				);
			?>
			<?php wp_list_bookmarks($args); ?>
		</div>
		<?php
			if(comments_open()){
				comments_template();
			}else{
				echo "<h5>评论已经关闭</h5>";
			}
		?>
	</div>
</main>

<?php get_footer(); ?>