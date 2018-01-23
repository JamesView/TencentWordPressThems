<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 10/30/2016
 * Time: 16:46
 */
if(get_post_meta(get_the_ID(), "thumbnailUrl", true)): ?>
    <img src="<?php echo get_post_meta(get_the_ID(), "thumbnailUrl", true); ?>">
<?php elseif (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
<?php else: ?>
    <img src="<?php echo catchFirstImg(); ?>" alt="<?php the_title(); ?>">
<?php endif; ?>
