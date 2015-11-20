<?php
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function totomo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'totomo_customize_register' );

/**
 * totomo Theme Customizer
 *
 * @package totomo
 */

if ( !class_exists( 'WP_Customize_Control' ) ) {
	return;
}

class Totomo_Customize_Divider_Control extends WP_Customize_Control {
	public $type = 'divider';
	public function render_content() {
		?>
		<hr>
		<?php
	}
}

/**
 * Main class for customizer
 *
 * @author Totomo <fitwp.com>
 * @since  1.0
 */
class Totomo_customizer {
	/**
	 * Class constructor
	 *
	 * @return Totomo_Customizer
	 */
	function __construct() {
		add_action( 'customize_register', array( $this, 'register' ) );
	}

	/**
	 * Register customizer sections, controls, etc.
	 *
	 * @param $wp_customize
	 *
	 * @return void
	 */
	function register( $wp_customize ) {

		// Section General
		$wp_customize->add_section( 'general', array(
			'title'    => __( '[Totomo] Logo', 'totomo' ),
		) );

		// Logo
		$wp_customize->add_setting( 'logo', array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'logo',
				array(
					'label'    => __( 'Logo', 'totomo' ),
					'section'  => 'general',
					'settings' => 'logo',
					'context'  => 'totomo_custom_logo',
					'priority' => 11,
				)
			)
		);

		// Divider
		$wp_customize->add_setting( 'divider', array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => '__return_false',
		) );
		$wp_customize->add_control(
			new Totomo_Customize_Divider_Control(
				$wp_customize,
				'divider',
				array(
					'label'    => __( 'Logo', 'totomo' ),
					'section'  => 'homepage',
					'settings' => 'divider',
					'type'	   => 'divider',
					'priority' => 101,
				)
			)
		);

		// Section Social
		$wp_customize->add_section( 'social', array(
			'title'    => __( '[Totomo] Social', 'totomo' ),
		) );

		$social_sites = array( 'facebook', 'twitter', 'google', 'flickr', 'pinterest', 'youtube', 'vimeo', 'tumblr', 'skype', 'github', 'linkedin', 'instagram' );

		foreach( $social_sites as $social_site ) {
			$wp_customize->add_setting( "social[$social_site]", array(
					'type'              => 'theme_mod',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_url_raw'
			) );

			$wp_customize->add_control( "social[$social_site]", array(
					'label'   => ucwords( $social_site ) . __( " Url:", 'totomo' ),
					'section' => 'social',
					'type'    => 'text',
			) );
		}
	}
}
new Totomo_Customizer;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function totomo_customize_preview_js() {
	wp_enqueue_script( 'totomo_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'totomo_customize_preview_js' );
