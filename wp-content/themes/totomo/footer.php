<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package totomo
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container" role="contentinfo">
		<div class="credit">
			<?php
			/**
			 * Fires before the Totomo footer text for footer customization.
			 *
			 * @since 1.0
			 */
			do_action( 'totomo_credits' );
			?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'totomo' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'totomo' ); ?>" target="_blank"><?php printf( __( 'Proudly powered by %s', 'totomo' ), 'WordPress' ); ?></a>.
			<?php printf( __( 'Theme: %1$s by %2$s.', 'totomo' ), 'Totomo', '<a href="' . esc_url( 'http://wpthemes9.com' ) . '" target="_blank">WPThemes9</a>' ); ?>
		</div>
		<div class="divider-half"></div>

		<?php
		if ( $socials = get_theme_mod( 'social' ) ) {
			echo '<div class="social-icons">';
				$socials = $socials ? array_filter( $socials ) : array();
				foreach ( $socials as $social => $name ) {
					printf(
						'<a href="%s" target="_blank" class="icon-social fa fa-%s"></a>',
						esc_url( $name ), $social
					);
				}
			echo '</div>';
		}
		?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
