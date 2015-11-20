<?php

/**
 * Create HTML list of nav menu items
 * Replacement for the native Walker
 *
 * Work for WordPress 3.7+
 */
class Totomo_Bootstrap_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Use a fixed class 'dropdown-menu' for compatible with Bootstrap
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of page. Used for padding.
	 * @param array  $args
	 *
	 * @return void
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="dropdown-menu">';
	}

	/**
	 * Start the element output.
	 *
	 * @see   Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$classes      = empty( $item->classes ) ? array() : ( array ) $item->classes;
		$item_classes = array();

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$item_classes[] = 'dropdown';
			$title          .= ' <b class="caret"></b>';
			$attributes     .= ' class="dropdown-toggle" data-toggle="dropdown"';
		}

		$active_classes = array(
			'current-menu-item',
			'current-menu-parent',
			'current-menu-ancestor',
		);

		$classes = array_intersect( $classes, $active_classes );
		if ( ! empty( $classes ) ) {
			$item_classes[] = 'active';
		}

		$item_classes = empty( $item_classes ) ? '' : ' class="' . implode( ' ', $item_classes ) . '"';
		$output .= '<li' . $item_classes . '>';

		$item_output = '<a' . $attributes . '>' . $title . '</a>';
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Extend WordPress Walker Page to output pages in Bootstrap format
 */
class Totomo_Bootstrap_Page_Walker extends Walker_Page {
	/**
	 * Use class 'dropdown-menu'
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of page. Used for padding.
	 * @param array  $args
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="dropdown-menu">';
	}

	/**
	 * Output markup for a list item in Bootstrap format
	 *
	 * @param string $output       Passed by reference. Used to append additional content.
	 * @param object $page         Page data object.
	 * @param int    $depth        Depth of page. Used for padding.
	 * @param int    $current_page Page ID.
	 * @param array  $args
	 */
	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		$has_dropdown = isset( $args['pages_with_children'][$page->ID] );

		// CSS classes
		$css_class = $has_dropdown ? array( 'dropdown' ) : array();
		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if (
				in_array( $page->ID, $_current_page->ancestors )
				|| ( $page->ID == $current_page )
				|| ( $_current_page && $page->ID == $_current_page->post_parent )
			) {
				$css_class[] = 'active';
			}
		} elseif ( $page->ID == get_option( 'page_for_posts' ) ) {
			$css_class[] = 'active';
		}
		$css_class = empty( $css_class ) ? '' : ' class="' . implode( ' ', array_unique( $css_class ) ) . '"';

		// Attributes for <a>
		$attributes = $has_dropdown ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

		// Page title
		if ( '' === $page->post_title ) {
			$page->post_title = sprintf( __( '#%d (no title)', 'totomo' ), $page->ID );
		}

		$title = apply_filters( 'the_title', $page->post_title, $page->ID );

		if ( $has_dropdown ) {
			$title .= ' <b class="caret"></b>';
		}

		$output .= '<li' . $css_class . '><a href="' . esc_url( get_permalink( $page->ID ) ) . '"' . $attributes . '>' . $title . '</a>';
	}
}

/**
 * Call back function to display pages in the menu
 *
 * @param array|string $args
 *
 * @return void
 */
function totomo_bootstrap_menu_callback( $args = array() ) {
	$menu      = '';
	$list_args = array(
		'echo'     => false,
		'title_li' => '',
		'walker'   => new Totomo_Bootstrap_Page_Walker,
	);

	// Show Home in the menu
	$class = is_front_page() && ! is_paged() ? 'class="active"' : '';
	$menu .= '<li ' . $class . '><a href="' . trailingslashit( home_url() ) . '">' . __( 'Home', 'totomo' ) . '</a></li>';

	// If the front page is a page, add it to the exclude list
	if ( get_option( 'show_on_front' ) == 'page' ) {
		$list_args['exclude'] = get_option( 'page_on_front' );
	}

	$menu .= wp_list_pages( $list_args );

	if ( $menu ) {
		$menu = '<ul class="' . esc_attr( $args['menu_class'] ) . '" id="' . esc_attr( $args['menu_id'] ) . '">' . $menu . '</ul>';
	}

	$menu = '<div class="' . esc_attr( $args['container_class'] ) . '" id="' . esc_attr( $args['container_id'] ) . '">' . $menu . '</div>';
	echo $menu;
}

