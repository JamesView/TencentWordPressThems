<?php get_header(); ?>

<?php if (cs_get_option('i_carousel_switcher')): ?>
<div class="container-fluid carousel-wrap" >
	<div class="row">
		<?php get_template_part('template-parts/carousel'); ?>
	</div>
</div>
<?php endif; ?>
<?php if (cs_get_option('i_notice_switcher') && cs_get_option('i_carousel_type') != 'one'): ?>
	<div class="notice">
		<div class="container">
			<div class="row notice-wrap">
				<i class="fa fa-bullhorn"></i>
				<?php if (cs_get_option('i_notice_groups')): ?>
					<ul>
						<?php foreach (cs_get_option('i_notice_groups') as $key => $value): ?>
							<?php if ($value['i_notice_group_switcher']): ?>
								<li class="notice-item">
									<a target="blank" href="<?php echo $value['i_notice_group_url']?>" title="<?php echo $value['i_notice_group_content']?>">
										<?php echo $value['i_notice_group_content']?>
									</a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<?php echo "<ul>请在后台公告栏处自定义公告栏内容</ul>"; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php if (cs_get_option('i_notice_switcher') && cs_get_option('i_carousel_type') == 'one'): ?>
	<div class="container">
		<div class="row">
			<div class="notice">
				<div class="notice-wrap">
					<i class="fa fa-bullhorn"></i>
					<?php if (cs_get_option('i_notice_groups')): ?>
						<ul>
							<?php foreach (cs_get_option('i_notice_groups') as $key => $value): ?>
								<?php if ($value['i_notice_group_switcher']): ?>
									<li class="notice-item">
										<a target="blank" href="<?php echo $value['i_notice_group_url']?>" title="<?php echo $value['i_notice_group_content']?>">
											<?php echo $value['i_notice_group_content']?>
										</a>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php else: ?>
						<?php echo "请在后台公告栏处自定义公告栏内容"; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<main class="container" id="main">
	<div class="row">
		<?php if (cs_get_option('i_layout_index_type') == "dcolumn"): ?>
			<div class="md-8-5 sm-8">
				<div class="row">
					<?php
						$categoriesNot = cs_get_option('i_category_not_in');
						$categoryNot = array();
						if ($categoriesNot) {
							foreach($categoriesNot as $value) {
								array_push($categoryNot, (int)$value);
							}
						}
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
							"post__not_in" => get_option("sticky_posts"),     // 置顶文章不显示在文章列表中
							'posts_per_page' => cs_get_option('i_posts_per_page'),
							'paged' => $paged,
							'category__not_in' => $categoryNot,
						);
						query_posts($args);
					?>
					<?php if (have_posts()) : ?>
						<div class="post-wrap">
							<?php while (have_posts()) : the_post(); ?>
								<?php get_template_part('template-parts/post/content', get_post_format()); ?>
								<?php if ($wp_query->current_post == cs_get_option('i_advertisement_article_list_after') -1): ?>
									<?php if (cs_get_option('i_advertisement_switcher')): ?>
										<div class="post-advertisement">
											<?php echo cs_get_option('i_advertisement_article_list'); ?>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>
						<?php get_template_part('template-parts/pagination'); ?>
					<?php endif; wp_reset_query();?>
				</div>
			</div>
			<div class="md-3-5 sm-4">
				<div class="row" style="padding-left: 10px;">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php endif; ?>
		<!-- cascade -->
		<?php if (cs_get_option('i_layout_index_type') == "cascade"): ?>
			<?php
				$categoriesNot = cs_get_option('i_category_not_in');
				$categoryNot = array();
				if ($categoriesNot) {
					foreach($categoriesNot as $value) {
						array_push($categoryNot, (int)$value);
					}
				}
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					"post__not_in" => get_option("sticky_posts"),     // 置顶文章不显示在文章列表中
					'posts_per_page' => cs_get_option('i_posts_per_page'),
					'paged' => $paged,
					'category__not_in' => $categoryNot,
				);
				query_posts($args);
			?>
			<?php if (have_posts()) : ?>
				<div class="cascade-layout row-mobile" style="overflow: hidden;">
                    <div class="post-wrap">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="md-4 sm-4">
                                <?php get_template_part('template-parts/post/content', 'card'); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
				</div>
                <?php get_template_part('template-parts/pagination'); ?>
			<?php endif; wp_reset_query();?>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>

