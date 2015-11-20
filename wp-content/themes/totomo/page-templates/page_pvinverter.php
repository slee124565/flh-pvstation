<?php
/**
 * Template Name: PVInverter
 *
 * This is the template for PVStation or PVInverter page
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package totomo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        <h2> PVInverter Template Page</h2>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'pvstation' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
