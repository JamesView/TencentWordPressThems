<?php get_header(); ?>

<main class="container">
    <section class="search-title">
        <?php if (have_posts()): ?>
            <h3 class="page-title">搜索：<?php echo get_search_query();?></h3>
        <?php else : ?>
            <h3 class="page-title">什么也没找到，请尝试用其他关键字搜索</h3>
        <?php endif; ?>
    </section>
    <div class="row">
        <?php if (have_posts()): ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php if (cs_get_option('i_layout_archive_type') == "column"): ?>
                    <?php get_template_part('template-parts/post/content-aside'); ?>
                <?php else: ?>
                    <div class="md-4">
                        <?php get_template_part('template-parts/post/content', "card"); ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>

