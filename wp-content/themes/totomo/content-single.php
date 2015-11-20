<?php
/**
 * @package totomo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		printf( '<h1 class="entry-title"><a href="%s" rel="bookmark" title="%s">%s</a></a></h1>', esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), get_the_title() );
		?>
	</header>
	<div class="entry-content">
		<?php
			totomo_posted_on();
			the_content();
			echo get_the_tag_list( '<div class="tags-links">#', '# ', '</div>' );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
