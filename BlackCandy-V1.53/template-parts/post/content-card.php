<div class="post post-style-card">
	<div class="post-top">
		<div class="post-title">
			<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
		</div>
        <div class="post-top-meta">
            <?php if (is_category()): ?>
                <span class="post-tag">
                    <i class="fa fa-tag"></i>
                    <?php echo getOneTag(get_the_tags()); ?>
                </span>
            <?php else: ?>
                <span class="post-category">
                    <i class="fa fa-bookmark"></i>
                    <?php echo getOneCategory(get_the_category()); ?>
                </span>
            <?php endif; ?>
            <span class="post-time">
                <i class="fa fa-clock-o"></i>
                <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
            </span>
        </div>
		<a class="post-img" href=" <?php echo the_permalink(); ?>">
			<?php get_template_part('template-parts/thumbnail'); ?>
			<div class="post-img-overlay"></div>
		</a>
	</div>
	<div class="post-bottom">
		<div class="post-body">
			<a href="<?php the_permalink(); ?>"><?php echo get_post_excerpt('', 58); ?></a>
		</div>
		<div class="post-meta-author">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank">
                <?php echo get_avatar( get_the_author_meta('email'), '' ); ?>
                <span><?php echo get_the_author() ?></span>
            </a>
		</div>
	</div>
	<ul class="post-meta">
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
		<li class="post-meta-view">
			<i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?>
		</li>
		<li>
			<i class="fa fa-comments"></i>
			<?php
				$args = array(
					'post_id' => get_the_id(), // use post_id, not post_ID
				    'count' => true //return only the count
				);
				$comments = get_comments($args);
				echo $comments
			?>
		</li>
	</ul>
</div>