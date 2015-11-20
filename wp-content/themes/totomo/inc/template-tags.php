<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package totomo
 */

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'totomo' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'totomo_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function totomo_posted_on() {

	// Default info will be shown
	$post_format = get_post_format( get_the_ID() );
	?>
	<ul class="post-meta clearfix">
		<li>
			<time class="date fa fa-clock-o" datetime="<?php the_time( 'c' ); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time>
		</li>
		<li>
			<?php comments_popup_link( __( 'No Comments', 'totomo' ) , __( '1 Comment', 'totomo' ) , __( '% Comments', 'totomo' ), 'comments-link fa fa-comments' ); ?>
		</li>
		<li class="fa fa-tags">
			<?php the_category( ', ' ); ?>
		</li>
	</ul>
	<?php
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'totomo' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'totomo' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'totomo' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'totomo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'totomo' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'totomo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'totomo' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'totomo' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'totomo' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'totomo' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'totomo' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'totomo' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'totomo' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'totomo' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

/**
 * Display Gallery Slider
 *
 * @param integer $post_id get Id of singular
 * @param string  $thumbnail get type thumbnail
 *
 * @return void
 * @since  1.0
 */
function totomo_gallery_slider( $thumbnail ) {

	$post_id   = get_the_ID();
	$images    = array();
	$galleries = get_post_galleries( $post_id, false );
	if ( isset( $galleries[0]['ids'] ) ) {
		$images = explode( ',', $galleries[0]['ids'] );
	}

	if ( ! empty( $images ) && is_array( $images ) ) {
		?>
		<div id="slider-<?php echo $post_id;?>" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php
				foreach ( $images as $i => $image ) {
					printf( '<li data-target="#slider-%s" data-slide-to="%s"%s></li>', $post_id, $i, 0 == $i ? ' class="active"' : '');
				}
				?>
			</ol>
			<div class="carousel-inner">
				<?php
				foreach ( $images as $i => $image ) {
					printf( '<div class="item%s">%s</div>', 0 == $i ? ' active' : '', wp_get_attachment_image( $image, $thumbnail ) );
				}
				?>
			</div>
		</div>
	<?php
	}
}

/**
 * Callback function to show comment
 *
 * @param object $comment
 * @param array  $args
 * @param int    $depth
 *
 * @return void
 * @since 1.0
 */
function totomo_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> itemscope itemtype="http://schema.org/Comment">
		<article id="comment-<?php comment_ID(); ?>">
			<?php echo get_avatar( $comment, 900 ); ?>

			<ul class="comment-meta">
				<li itemprop="author" class="author">
					<?php comment_author_link(); ?>
				</li>
				<li>
					<span itemprop="datePublished"><?php printf( __( '%1$s at %2$s', 'totomo' ), get_comment_date(), get_comment_time() ) ?></span>
					<?php edit_comment_link( __( '(Edit)', 'totomo' ), '  ', '' ) ?>
				</li>
				<li class="reply-link">
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
<?php
}

/**
 * Show entry format images, video, gallery, audio, etc.
 *
 * @return void
 */
function totomo_post_formats() {
	$html      = '';
	$size      = 'totomo-thumb-blog-list';
	$thumb     = get_the_post_thumbnail( get_the_ID(), $size );
	$post_link = get_permalink();

	switch ( get_post_format() ) {
		case 'link':
			$link = get_the_content();
			if ( $link )
				$html = "<div class='link-wrapper'>$link</div>";
			break;
		case 'quote':
			$html = get_the_content();

			if ( empty( $thumb ) )
				break;

			$html .= '<a class="post-image" href="' . get_permalink() . '">';
			$html .= $thumb;
			$html .= '</a>';
			break;
		case 'gallery':

			// Show gallery
			totomo_gallery_slider( 'thumb-blog-list' );
			break;
		case 'audio':
			$content     = apply_filters( 'the_content', get_the_content( __( 'Read More', 'totomo' ) ) );
			$media       = get_media_embedded_in_content( $content, array( 'audio', 'object', 'embed', 'iframe' ) );
			$thumb_audio = '';
			if ( ! empty( $thumb ) ) {
				$html        .= '<a class="post-image" href="' . get_permalink() . '">';
				$html        .= $thumb;
				$html        .= '</a>';
				$thumb_audio = 'thumb_audio';
			}

			if ( !empty( $media ) ) : ?>
				<?php
				foreach ( $media as $embed_html ) {
					$html .= sprintf( '<div class="audio-wrapper %s">%s</div>', $thumb_audio, $embed_html );
				}
				?>
			<?php endif;

			break;
		case 'video':
			$content = apply_filters( 'the_content', get_the_content( __( 'Read More', 'totomo' ) ) );
			$media = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
			if ( !empty( $media ) ) : ?>
				<?php
				foreach ( $media as $embed_html )
				{
					$html = sprintf( '%s', $embed_html );
				}
				?>
			<?php endif;
			break;
		default:
			if ( empty( $thumb ) ) {
				return;
			}

			$html .= '<a class="post-image" href="' . get_permalink() . '">';
			$html .= $thumb;
			$html .= '</a>';
	}

	if ( $html ) {
		echo "<div class='post-format-meta'>$html</div>";
	}

	$post_format = get_post_format( get_the_ID() );
	if( 'link' == $post_format || 'quote' == $post_format ) {
		return;
	}
}

/**
 * Display post related
 *
 * @since  1.0
 * @return void
 */
function totomo_related_post() {

	$args = '';
	$args = wp_parse_args( $args, array(
		'category__in'   => wp_get_post_categories( get_the_ID() ),
		'posts_per_page' => 4,
		'post__not_in'   => array( get_the_ID() )
	) );
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) {
	?>
	<div class="related-article">
		<h2 class="box-title"><?php _e( 'Related Posts', 'totomo' ); ?></h2>
		<ul class="row">
			<?php
			while ( $related->have_posts() ) {
				$related->the_post();

				$post_thumbnail = get_the_post_thumbnail( get_the_ID(), 'thumbnail' );

				$class_format = '';
				if  ( ! $post_thumbnail )
					$class_format = 'fa-format-' . get_post_format( get_the_ID() );

				printf(
					'<li class="col-md-6">
						<a href="%s" class="post-thumbnail %s">%s</a>
						<div class="related-post-content">
							<a class="related-post-title" href="%s">
							<span class="date">%s</span></br>
							%s</a>
						</div>
					</li>',
					esc_url( get_permalink() ),
					$class_format,
					$post_thumbnail,
					esc_url( get_permalink() ),
					get_the_date(),
					get_the_title()
				);
				?>
			<?php
			}
			?>
		</ul>
	</div>
	<?php
	}
	wp_reset_postdata();
}

/**
 * Display post author box
 *
 * @since  1.0
 * @return void
 */
function totomo_get_author_box() {
	$author_id = get_the_author_meta( 'ID' );
	$author    = get_user_by( 'id', $author_id );
	$avatar    = get_avatar( $author_id, 96 );
	?>
	<div id="post-author" class="post-author-area">
		<?php echo $avatar ?>
		<div class="info">
			<h4 class="display-name"><?php the_author(); ?></h4>
			<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
		</div>
	</div>
<?php
}

/**
 * Flush out the transients used in totomo_categorized_blog.
 */
function totomo_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'totomo_categories' );
}
add_action( 'edit_category', 'totomo_category_transient_flusher' );
add_action( 'save_post',     'totomo_category_transient_flusher' );
