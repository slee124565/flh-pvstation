<?php
if ( post_password_required() ) {
	return;
}
?>
<?php if ( have_comments() ) : ?>
	<div class="comments content-box">
	<h2 class="comments-title"><?php comments_number( __( 'Comments', 'totomo' ), __( '1 Comment', 'totomo' ), __( '% Comments', 'totomo' ) ); ?></h2>

	<ul class="comment-list">
		<?php wp_list_comments( array( 'callback' => 'totomo_comment' ) ); ?>
	</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="navigation comment-navigation" role="navigation">
			<h5 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'totomo' ); ?></h5>

			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'totomo' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'totomo' ) ); ?></div>
		</nav>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'totomo' ); ?></p>
	<?php endif; ?>
	</div>
<?php endif; ?><!-- have_comments -->

<?php
if ( comments_open() ) {
	$commenter    = wp_get_current_commenter();
	$aria_req     = get_option( 'require_name_email' ) ? " aria-required='true'" : '';
	$comment_args = array(
		'title_reply'          => __( 'Leave a comment', 'totomo' ),
		'id_submit'            => 'comment-reply',
		'label_submit'         => __( 'Post Comment', 'totomo' ),
		'fields'               => apply_filters( 'comment_form_default_fields', array(
			'author' => '<fieldset class="name-container">
							<input type="text" id="author" class="tb-my-input" name="author" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" size="32"' . $aria_req . ' placeholder="' . __( 'Name*', 'totomo' ) . '">
						</fieldset>',
			'email'  => '<fieldset class="email-container">
							<input type="text" id="email" class="tb-my-input" name="email" tabindex="2" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="32"' . $aria_req . ' placeholder="' . __( 'Email*', 'totomo' ) . '">
						</fieldset>',
			'url'    => '<fieldset class="url-container">
							<input type="text" id="url" class="tb-my-input" name="url" tabindex="3" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="32"' . $aria_req . ' placeholder="' . __( 'Url', 'totomo' ) . '">
						</fieldset>',
		) ),
		'comment_field'        => '<fieldset class="message">
								<textarea id="comment-message" name="comment" rows="8" tabindex="4" placeholder="' . __( 'Write your mesage here... ', 'totomo' ) . '"></textarea>
							</fieldset>',
		'comment_notes_after'  => '',
		'comment_notes_before' => '<p>' . __( 'Hey, so you decided to leave a comment! That\'s great. Just fill in the required fields and hit submit. Note that your comment will need to be reviewed before its published.', 'totomo' ) . '</p>',
	);
	comment_form( $comment_args );
}
?>
