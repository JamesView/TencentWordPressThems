<div class="post post-type-aside">
	<div class="post-left">
		<?php get_template_part('template-parts/thumbnail'); ?>
	</div>
	<div class="post-right">
		<div class="post-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
		<div class="post-body">
			<a href="<?php the_permalink(); ?>"><?php echo get_post_excerpt('', 100); ?></a>
		</div>
		<ul class="post-meta">
			<li class="post-meta-author">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank">
					<?php echo get_avatar( get_the_author_meta('email'), '' ); ?>
					<?php echo get_the_author() ?>
				</a>
			</li>
			<li class="post-meta-view">
				<i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?>
			</li>
			<li class="post-meta-categories">
				<i class="fa fa-bookmark"></i>

				<?php echo getOneCategory(get_the_category()); ?>
			</li>
			<li class="post-meta-time">
				<?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
			</li>
			<li class="post-meta-like">
				<i class="fa fa-thumbs-o-up"></i>
				<span class="count">
					<?php if(get_post_meta($post->ID,'bigfa_ding',true)): ?>
						<?php echo get_post_meta($post->ID,'bigfa_ding',true); ?>
					<?php else: ?>
						<?php echo '0'; ?>
					<?php endif; ?>
				</span>
			</li>
		</ul>

	</div>	
</div>