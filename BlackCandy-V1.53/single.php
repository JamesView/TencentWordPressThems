<?php get_header(); ?>

<main class="container" id="pjax-content">
	<div class="row">
	<div class="md-8-5 sm-8">
		<div class="row" id="main">
			<?php if (have_posts()) :
				the_post(); update_post_caches($posts); ?>
					<article class="article <?php if (cs_get_option('i_article_indent_switcher')){echo "article-indent";}?>" id="post-<?php the_ID(); ?>">
						<div class="article-img">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="article-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</div>
						<div class="article-meta">
							<span class="article-meta-time">
								<?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
							</span>
							<i class="fa fa-bookmark"></i>
							<?php the_category(' '); ?>
							<?php comments_popup_link('0', '1 ', '% ', 'article-meta-comment', '评论已关闭'); ?>
                            <!-- user edit -->
                            <?php if (is_user_logged_in()): ?>
                                <i class="fa fa-edit"></i>
                                <?php edit_post_link(); ?>
                            <?php endif; ?>
                            <!-- baidu push -->
                            <?php if (cs_get_option('i_push_baidu_switcher')): ?>
                                <span class="article-push-baidu">
                                    <?php if (is_user_logged_in()): ?>
                                        <?php if(get_post_meta(get_the_ID(),'pushBaidu',true)): ?>
                                            <span style="color:#00aa00">已推送到百度</span>
                                        <?php else: ?>
                                                <span style="color:#ff0000">未推送到百度</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                            <div class="article-meta-tags">
								<?php the_tags(' ', ' '); ?>
							</div>
						</div>
						<div class="article-body">
							<?php the_content(); ?>
						</div>
                        <!-- advertisement -->
                        <?php if (cs_get_option('i_advertisement_switcher')): ?>
                            <div class="article-advertisement">
                                <script>
                                    <?php echo cs_get_option('i_advertisement_article_tail'); ?>
                                </script>
                            </div>
                        <?php endif; ?>
                        <!-- copyright -->
                        <?php if (cs_get_option('i_article_copyright_switcher')): ?>
                            <p class="article-copyright">
                                转载原创文章请注明，转载自:
                                <a href="<?php echo home_url(); ?>">
                                    <?php echo bloginfo('name'); ?>
                                </a> -
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                                (<?php the_permalink(); ?>)
                            </p>
                        <?php endif; ?>
						<?php if (cs_get_option("i_article_support_switcher")): ?>
                            <div class="article-support">
                                <div class="article-support-title">
                                    <?php echo cs_get_option('i_article_support_description'); ?>
                                </div>
                                <div class="article-support-img">
                                    <div class="article-support-zhifubao">
                                        <img src="<?php echo cs_get_option('i_article_support_zhifubao')?>">
                                        <div class="article-support-img-title">
                                            支付宝支付
                                        </div>
                                    </div>
                                    <div class="article-support-wechat">
                                        <img src="<?php echo cs_get_option('i_article_support_wechat')?>">
                                        <div class="article-support-img-title">
                                            微信支付
                                        </div>
                                    </div>
                                </div>
                                <div class="article-support-button">
                                    <a class="btn">赞赏</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- like -->
                        <?php if (cs_get_option('i_article_like_switcher')): ?>
                            <div class="article-like">
                                <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">
                                    <?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])): ?>
                                        <i class="fa fa-thumbs-up"></i>
                                    <?php else: ?>
                                        <i class="fa fa-thumbs-o-up"></i>
                                    <?php endif; ?>
                                    <span class="count">
									<?php if(get_post_meta($post->ID,'bigfa_ding',true)): ?>
                                        <?php echo get_post_meta($post->ID,'bigfa_ding',true); ?>
                                    <?php else: ?>
                                        <?php echo '0'; ?>
                                    <?php endif; ?>
								</span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <!-- share -->
                        <?php if (cs_get_option('i_article_share_switcher')): ?>
                            <div class="article-share">
                                <span class="article-share-title">
                                    分享到：
                                </span>
                                <span class="bdsharebuttonbox">
                                <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                                <a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
                                <a href="#" class="bds_more" data-cmd="more"></a>
                                </span>
                                <script>
                                window._bd_share_config={
                                    "common":{
                                        "bdSnsKey":{},
                                        "bdText":"",
                                        "bdMini":"1",
                                        "bdMiniList":false,
                                        "bdPic":"",
                                        "bdStyle":"2",
                                        "bdSize":"24"},
                                        "share":{}
                                    };
                                <?php if (cs_get_option('i_function_https_switcher')): ?>
                                    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                                <?php else: ?>
                                with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                                <?php endif; ?>
                                </script>
                            </div>
                        <?php endif; ?>
					</article>
					<?php setPostViews(get_the_ID());?>
			<?php endif; ?>
			<section id="post-link">
				<div class="md-6 post-link-previous">
					<?php echo (get_previous_post() ? previous_post_link('上一篇: %link') : "已经是最旧一篇" ); ?>
				</div>
				<div class="md-6 post-link-next">
					<?php echo (get_next_post() ? next_post_link('下一篇: %link') : "已经是最后一篇"); ?>
				</div>
			</section>
			<?php
				if(comments_open()){
					comments_template();
				}else{
					echo "<h5>评论已经关闭</h5>";
				}
			?>
		</div>
	</div>
	<div class="md-3-5 sm-4">
		<div class="row" style="padding-left: 10px;">
			<?php get_sidebar(); ?>
		</div>
	</div>
	</div>
</main>
<?php get_footer(); ?>