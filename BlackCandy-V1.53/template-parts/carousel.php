<div id="carousel" class="owl-carousel">
    <?php if (cs_get_option('i_carousel_customize')): ?>
        <!-- customize carousel-->
        <?php foreach (cs_get_option('i_carousel_customize') as $key => $value): ?>
            <?php if (isset($value['i_carousel_customize_switcher']) && $value['i_carousel_customize_switcher'] == true): ?>
                <a class="carousel-item" target="blank" href="<?php echo $value['i_carousel_customize_url']; ?>" title="<?php echo $value['i_carousel_customize_title']; ?>" rel="carousel">
                    <img src="<?php echo $value['i_carousel_customize_img']; ?>" alt="<?php echo $value['i_carousel_customize_title']; ?>">
                    <div class="carousel-info <?php if (cs_get_option('i_carousel_info_switcher')){echo "hidden";} ?>">
                        <div class="carousel-info-title">
                            <?php echo $value['i_carousel_customize_title']; ?>
                        </div>
                    </div>
                    <div class="carousel-overlay"></div>
                </a>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif; ?>
    <?php
        $sticky = get_option('sticky_posts');
        $args = array();
        if ( !empty($sticky) ) {
            rsort( $sticky );
            $sticky = array_slice( $sticky, 0);
            $args = array('post__in' => $sticky);
        } elseif (is_null(cs_get_option('i_carousel_customize'))) {
            $args = array('posts_per_page' => cs_get_option('i_carousel_default_numbers'));
        }
        $carousel = new WP_Query($args);
    ?>
    <?php if (!empty($sticky) || is_null(cs_get_option('i_carousel_customize'))): ?>
        <?php if ($carousel->have_posts()) : ?>
            <?php while ($carousel->have_posts()) : $carousel->the_post(); ?>
                <!-- image -->
                <?php if (cs_get_option('i_carousel_type') == 'image'): ?>
                    <a class="carousel-item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                        <?php get_template_part('template-parts/thumbnail'); ?>
                        <div class="carousel-info <?php if (cs_get_option('i_carousel_info_switcher')){echo "hidden";} ?>">
                            <div class="carousel-info-meta">
                                <?php
                                $category = get_the_category();
                                if($category[0]){
                                    echo '<span class="carousel-info-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</span>';
                                }
                                ?>
                                <span class="carousel-info-time">
                                <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
                            </span>
                            </div>
                            <div class="carousel-info-title">
                                <?php the_title(); ?>
                            </div>
                        </div>
                        <div class="carousel-overlay"></div>
                    </a>
                <?php endif; ?>
                <?php if (cs_get_option('i_carousel_type') == 'one'): ?>
                    <a class="carousel-item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                        <?php get_template_part('template-parts/thumbnail'); ?>
                        <div class="carousel-info <?php if (cs_get_option('i_carousel_info_switcher')){echo "hidden";} ?>">
                            <div class="carousel-info-meta">
                                <?php
                                $category = get_the_category();
                                if($category[0]){
                                    echo '<span class="carousel-info-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</span>';
                                }
                                ?>
                                <span class="carousel-info-time">
                                <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
                            </span>
                            </div>
                            <div class="carousel-info-title">
                                <?php the_title(); ?>
                            </div>
                        </div>
                        <div class="carousel-overlay"></div>
                    </a>
                <?php endif; ?>
                <?php if (cs_get_option('i_carousel_type') == 'slide'): ?>
                    <a class="carousel-item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                        <?php get_template_part('template-parts/thumbnail'); ?>
                        <div class="carousel-info <?php if (cs_get_option('i_carousel_info_switcher')){echo "hidden";} ?>">
                            <div class="carousel-info-meta">
                                <?php
                                $category = get_the_category();
                                if($category[0]){
                                    echo '<span class="carousel-info-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</span>';
                                }
                                ?>
                                <span class="carousel-info-time">
                        <?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
                    </span>
                            </div>
                            <div class="carousel-info-title">
                                <?php the_title(); ?>
                            </div>
                        </div>
                        <div class="carousel-overlay"></div>
                    </a>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; wp_reset_postdata(); ?>
    <?php endif; ?>
</div>
