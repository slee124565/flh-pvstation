<?php
/**
 * @package totomo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$post_format   = get_post_format( get_the_ID() );
	$empty_content = array( 'link', 'quote' );

	// Show Entry Header Post Format
	totomo_post_formats();

	if ( ! in_array( $post_format, $empty_content ) ) {

		printf( '
			<header class="entry-header">
				<h2 class="entry-title"><a href="%s" rel="bookmark" title="%s">%s</a></h2>
			</header>',
			esc_url( get_permalink() ),
			the_title_attribute( 'echo=0' ),
			get_the_title()
		);
		?>

		<div class="entry-content">
		<?php
			totomo_posted_on();

			$main_content = apply_filters( 'the_content', get_the_content( __( 'Read More', 'totomo' ) ) );
			if ( 'audio' == $post_format || 'video' == $post_format ) {
				$media = get_media_embedded_in_content( $main_content, array( 'audio', 'video', 'object', 'embed', 'iframe' ) );
				if ( ! empty( $media ) ) {
					foreach ( $media as $embed_html ) {
						$main_content = str_replace( $embed_html, '', $main_content );
					}
				}
			}

			echo $main_content;
		?>
		</div><!-- .entry-content -->
	<?php
	}
	?>
</article><!-- #post-## -->
