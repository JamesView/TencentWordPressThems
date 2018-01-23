<?php
get_header(); ?>

<main class="container">
	<div class="row">
        <section class="archive-header">
            <div class="archive-header-title">
                <?php the_archive_title() ?>
            </div>
             <?php the_archive_description() ?>
        </section>
        <?php if (have_posts()) : ?>
            <div class="archive-body">
                <div class="row">
                    <div class="post-wrap">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php if (cs_get_option('i_layout_archive_type') == "column"): ?>
                                <?php get_template_part('template-parts/post/content-aside'); ?>
                            <?php else: ?>
                                <div class="md-4">
                                    <?php get_template_part('template-parts/post/content-card'); ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <?php get_template_part('template-parts/pagination'); ?>
                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>
	</div>
</main>

<?php get_footer(); ?>