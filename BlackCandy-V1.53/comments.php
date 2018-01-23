<?php
/**
* The template for displaying Comments.
*
*/

?>
<div class="comments">
	<?php
		$aria_req = '';
		$args = array(
			//fields是控制姓名、邮件、站点这几个表单
			'fields'=> array(
				'author' =>
				    '<p class="comment-form-author">' .
				    '<input id="author" name="author" placeholder = "昵称" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				    '" size="30"' . $aria_req . ' /></p>',
				'email' =>
					'<p class="comment-form-email">'.
					'<input id="email" name="email" placeholder = "邮箱" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' /></p>',
				'url' =>
					'<p class="comment-form-url">' .
					'<input id="url" name="url" placeholder = "网址" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" /></p>',
			),
		//以下不属于fields数组的东西
		'comment_notes_before' =>'',
		'comment_notes_after' => '',
		'title_reply' => '留言',
		'label_submit'=>'确定',

	);
		comment_form($args); 
	?>
	<div class="comments-title">
		<?php comments_number('写下你的评论吧', '评论(1)', '评论(%)');?>
	</div>
	<ul class="comments-list">
		<?php wp_list_comments('reverse_top_level=true&&reverse_children=true&&callback=listComments'); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-below" role="navigation">
		<div class="nav-inside">
			<?php paginate_comments_links('prev_next=0');?>
		</div>
	</nav>
	<?php endif; ?>
</div>