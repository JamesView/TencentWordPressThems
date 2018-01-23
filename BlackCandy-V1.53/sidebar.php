<?php
/**
 * The template for the sidebar containing the main widget area
 */

?>
<aside id="sidebar">
	<div class="sidebar-wrap">
        <?php if (!is_active_sidebar('sidebar-index') && !is_active_sidebar('sidebar-index-affix') && !is_active_sidebar('sidebar-article') && !is_active_sidebar('sidebar-article-affix')): ?>
            <div class="widget"><p>请到[后台->外观->小工具]首页或文章页侧边栏中添加需要显示的小工具。</p></div>
        <?php else: ?>
            <?php if (is_home()): ?>
                <div class="affix">
                    <?php dynamic_sidebar('sidebar-index-affix'); ?>
                </div>
                <div class='sidebar-index'>
                    <?php dynamic_sidebar("sidebar-index"); ?>
                </div>
            <?php endif; ?>
            <?php if (is_single()): ?>
                <div class="affix">
                    <?php dynamic_sidebar('sidebar-article-affix'); ?>
                </div>
                <div class='sidebar-article'>
                    <?php dynamic_sidebar("sidebar-article"); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
	</div>
</aside>

