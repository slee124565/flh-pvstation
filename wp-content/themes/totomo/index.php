<?php
/**
 * The main template file.
 *
 * @package totomo
 */

get_header(); ?>

<div id="main-grid" class="row">
	<div id="primary" class="content-area col-md-12">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					get_template_part( 'content' );
				?>

			<?php endwhile; ?>

			<?php
			$args = array(
				'prev_text' => '',
				'next_text' => '',
			);
			echo '<div class="blog-pagination">' . paginate_links( $args ) . '</div>' ; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #main-grid -->
<?php get_footer(); ?>
