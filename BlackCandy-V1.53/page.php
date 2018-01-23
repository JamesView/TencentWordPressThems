<?php

get_header(); ?>
    <main class="container" id="main">
        <div class="page-about page-common row">
            <?php if (have_posts()): ?>
                <?php while (have_posts()) : the_post(); ?>
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <article class="page-content">
                        <?php the_content(); ?>
                    </article>
                <?php endwhile;  ?>
            <?php endif; ?>
        </div>
    </main>
<?php get_footer(); ?><?php
