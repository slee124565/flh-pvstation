<li <?php comment_class(); ?> itemscope itemtype="<?php esc_url( 'http://schema.org/Comment' ); ?>">
	<article id="comment-<?php comment_ID(); ?>">
		<?php echo get_avatar( $comment, 55 ); ?>

		<ul class="comment-meta">
			<li itemprop="author">
				<?php comment_author_link(); ?>
			</li>
			<li>
				<span itemprop="datePublished"><?php printf( __( '%1$s at %2$s', 'totomo' ), get_comment_date(), get_comment_time() ) ?></span>
				<?php edit_comment_link( __( '(Edit)', 'totomo' ), '  ', '' ) ?>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</li>
		</ul>

		<div class="comment-body">
			<div itemprop="text"><?php comment_text() ?></div>
		</div>

		<?php if ( $comment->comment_approved == '0' ): ?>
			<div class="comment-waiting"><?php _e( '&nbsp;&nbsp;Your comment is awaiting moderation.', 'totomo' ) ?></div>
		<?php endif; ?>

	</article>
