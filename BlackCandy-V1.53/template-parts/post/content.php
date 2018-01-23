<div class="post post-style-standard">
	<div class="post-top">
		<div class="post-title">
			<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
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
		<a class="post-img" href=" <?php echo the_permalink(); ?>">
            <?php get_template_part('template-parts/thumbnail'); ?>
            <div class="post-img-overlay"></div>
		</a>
	</div>
	<div class="post-bottom hidden-xs">
		<div class="post-body">
			<div class="post-quote-left">
				<i class="fa fa-quote-left"></i>
			</div>
			<a href="<?php the_permalink(); ?>"><?php echo get_post_excerpt(); ?></a>
			<div class="post-quote-right">
				<i class="fa fa-quote-right"></i>
			</div>
		</div>
	</div>
</div>