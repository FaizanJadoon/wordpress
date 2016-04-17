<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    echo '<p class="nocomments">'.__( 'This post is password protected. Enter the password to view comments.', 'liveblog' ).'</p>';
	return;
}
?>
	<?php if ( have_comments() ) : ?>
		<div id="comments" class="comments-area clearfix">
			<h3 class="comments-count section-heading uppercase"><span><?php comments_number(__('No Comments','liveblog'), __( '1 Comment', 'liveblog' ), __( '% Comments', 'liveblog' ) );?></span></h3>
			<?php	
				if (get_option('page_comments')) {
					$comment_pages = paginate_comments_links('echo=0');
					if($comment_pages){
					 echo '<div class="commentnavi pagination">'.$comment_pages.'</div>';
					}
				}
			?>
			<ol class="commentlist">
				<?php
					wp_list_comments( array(
						'callback'      => 'liveblog_comment',
						'type'      => 'comment',
						'short_ping' => true,
						'avatar_size'=> 60,
					) );
				?>
				<?php
					wp_list_comments( array(
						'type'      => 'pingback',
						'short_ping' => true,
						'avatar_size'=> 60,
					) );
				?>
			</ol>
			<?php	
				if (get_option('page_comments')) {
					$comment_pages = paginate_comments_links('echo=0');
					if($comment_pages){
					 echo '<div class="commentnavi pagination">'.$comment_pages.'</div>';
					}
				}
			?>
		</div><!-- #comments -->

	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		
	<?php endif; ?>
	<?php endif; ?>
	<?php global $aria_req; $comments_args = array(
		// remove "Text or HTML to be displayed after the set of comment fields"
		'title_reply'=>'<h4 class="section-heading uppercase"><span>'.__('Leave a Reply','liveblog').'</span></h4>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => $fields =  array(
			  'author' =>
				'<p class="comment-form-author"><label for="author">' . __( 'Name ', 'liveblog' ) .
				( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="19"' . $aria_req . ' /></p>',

			  'email' =>
				'<p class="comment-form-email"><label for="email">' . __( 'Email ', 'liveblog' ) . 
				( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="19"' . $aria_req . ' /></p>',

			  'url' =>
				'<p class="comment-form-url"><label for="url">' . __( 'Website', 'liveblog' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="19" /></p>',
			),
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( 'Comments ', 'liveblog' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'label_submit' => __( 'Submit ', 'liveblog' ),
	);
	?>
	<?php comment_form($comments_args); ?>