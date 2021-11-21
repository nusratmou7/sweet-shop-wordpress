<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Moral
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function restro_cafe_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// When menu is sticky.
	$menu_transparent = get_theme_mod( 'restro_cafe_make_menu_transparent', true );
	if ( $menu_transparent ) {
		$classes[] = 'menu-transparent';
	}

	// When menu is sticky.
	$menu_sticky = get_theme_mod( 'restro_cafe_make_menu_sticky', false );
	if ( $menu_sticky ) {
		$classes[] = 'menu-sticky';
	}

	// When  color scheme is light or dark.
	$color_scheme = get_theme_mod( 'restro_cafe_theme_color_scheme', 'lite' );
	$classes[] = esc_attr( $color_scheme ) . '-version';
	
	// When global archive layout is checked.
	if ( is_archive() || restro_cafe_is_latest_posts() || is_404() || is_search() ) {
		if ( restro_cafe_is_woocommerce_activated() && ( is_woocommerce() || is_shop() || is_product_category() || is_product_tag() ) ) {
			if ( ! is_active_sidebar( 'woocommerce' ) ) {
				$classes[] = 'no-sidebar';
			} else {
				$archive_sidebar = get_theme_mod( 'restro_cafe_woo_global_archive_sidebar', 'right' ); 
				$classes[] = esc_attr( $archive_sidebar ) . '-sidebar';
			}
		} else {
			if ( ! is_active_sidebar( 'sidebar-1' ) ) {
				$classes[] = 'no-sidebar';
			} else {
				$archive_sidebar = get_theme_mod( 'restro_cafe_archive_sidebar', 'right' ); 
				$classes[] = esc_attr( $archive_sidebar ) . '-sidebar';
			}
		}
	} else if ( is_single() ) { // When global post sidebar is checked.
		if ( restro_cafe_is_woocommerce_activated() && ( is_woocommerce() || is_product() ) ) {
			if ( ! is_active_sidebar( 'woocommerce' ) ) {
				$classes[] = 'no-sidebar';
			} else {
				$restro_cafe_post_sidebar_meta = get_post_meta( get_the_ID(), 'restro-cafe-select-sidebar', true );
		    	if ( ! empty( $restro_cafe_post_sidebar_meta ) ) {
					$classes[] = esc_attr( $restro_cafe_post_sidebar_meta ) . '-sidebar';
		    	} else {
					$global_post_sidebar = get_theme_mod( 'restro_cafe_woo_global_singular_layout', 'right' ); 
					$classes[] = esc_attr( $global_post_sidebar ) . '-sidebar';
		    	}
			}
	    } else {
	    	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
				$classes[] = 'no-sidebar';
			} else {
	    		$restro_cafe_post_sidebar_meta = get_post_meta( get_the_ID(), 'restro-cafe-select-sidebar', true );
		    	if ( ! empty( $restro_cafe_post_sidebar_meta ) ) {
					$classes[] = esc_attr( $restro_cafe_post_sidebar_meta ) . '-sidebar';
		    	} else {
					$global_post_sidebar = get_theme_mod( 'restro_cafe_global_post_layout', 'right' ); 
					$classes[] = esc_attr( $global_post_sidebar ) . '-sidebar';
		    	}
		    }
	    }
	} elseif ( restro_cafe_is_frontpage_blog() || is_page() ) {
		if ( restro_cafe_is_woocommerce_activated() && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
			if ( ! is_active_sidebar( 'woocommerce' ) ) {
				$classes[] = 'no-sidebar';
			} else {
				$restro_cafe_post_sidebar_meta = get_post_meta( get_the_ID(), 'restro-cafe-select-sidebar', true );
		    	if ( ! empty( $restro_cafe_post_sidebar_meta ) ) {
					$classes[] = esc_attr( $restro_cafe_post_sidebar_meta ) . '-sidebar';
		    	} else {
					$global_post_sidebar = get_theme_mod( 'restro_cafe_woo_global_singular_layout', 'right' ); 
					$classes[] = esc_attr( $global_post_sidebar ) . '-sidebar';
		    	}
		    }
	    } else {
	    	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
				$classes[] = 'no-sidebar';
			} else {
				if ( restro_cafe_is_frontpage_blog() ) {
					$page_id = get_option( 'page_for_posts' );
				} else {
					$page_id = get_the_ID();
				}

		    	$restro_cafe_page_sidebar_meta = get_post_meta( $page_id, 'restro-cafe-select-sidebar', true );
				if ( ! empty( $restro_cafe_page_sidebar_meta ) ) {
					$classes[] = esc_attr( $restro_cafe_page_sidebar_meta ) . '-sidebar';
				} else {
					$global_page_sidebar = get_theme_mod( 'restro_cafe_global_page_layout', 'right' ); 
					$classes[] = esc_attr( $global_page_sidebar ) . '-sidebar';
				}
			}
	    }
	} 

	// Site layout classes
	$site_layout = get_theme_mod( 'restro_cafe_site_layout', 'wide' );
	$classes[] = esc_attr( $site_layout ) . '-layout';

	return $classes;
}
add_filter( 'body_class', 'restro_cafe_body_classes' );

function restro_cafe_post_classes( $classes ) {
	if ( restro_cafe_is_page_displays_posts() ) {
		// Search 'has-post-thumbnail' returned by default and remove it.
		$key = array_search( 'has-post-thumbnail', $classes );
		unset( $classes[ $key ] );
		
		$archive_img_enable = get_theme_mod( 'restro_cafe_enable_archive_featured_img', true );

		if( has_post_thumbnail() && $archive_img_enable ) {
			$classes[] = 'has-post-thumbnail';
		} else {
			$classes[] = 'no-post-thumbnail';
		}
	}

  $classes[] = 'animated animatedFadeInUp';
  
	return $classes;
}
add_filter( 'post_class', 'restro_cafe_post_classes' );

/**
 * Excerpt length
 * 
 * @since Moral 1.0.0
 * @return Excerpt length
 */
function restro_cafe_excerpt_length( $length ){
	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'restro_cafe_archive_excerpt_length', 60 );
	return $length;
}
add_filter( 'excerpt_length', 'restro_cafe_excerpt_length', 999 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function restro_cafe_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'restro_cafe_pingback_header' );



/**
 * Checks to see if we're on the homepage or not.
 */
function restro_cafe_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Your latest posts".
 */
function restro_cafe_is_latest_posts() {
	return ( is_front_page() && is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Posts page".
 */
function restro_cafe_is_frontpage_blog() {
	return ( is_home() && ! is_front_page() );
}

/**
 * Checks to see if the current page displays any kind of post listing.
 */
function restro_cafe_is_page_displays_posts() {
	return ( restro_cafe_is_frontpage_blog() || is_search() || is_archive() || restro_cafe_is_latest_posts() );
}

/**
 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
 * which should be used in theme templates.
 *
 * @since  1.0.0
 * @access public
 * @param  array $args Arguments to pass to Breadcrumb_Trail.
 * @return void
 */
function restro_cafe_breadcrumb( $args = array() ) {
	$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

	if ( ! is_object( $breadcrumb ) )
		$breadcrumb = new Breadcrumb_Trail( $args );

	return $breadcrumb->trail();
}

/**
 * Pagination in archive/blog/search pages.
 */
function restro_cafe_posts_pagination() { 
	$archive_pagination = get_theme_mod( 'restro_cafe_archive_pagination_type', 'numeric' );
	if ( 'disable' === $archive_pagination ) {
		return;
	}
	if ( 'numeric' === $archive_pagination ) {
		the_posts_pagination( array(
            'prev_text'          => restro_cafe_get_svg( array( 'icon' => 'left-arrow' ) ) . '<span class="meta-nav screen-reader-text">' . esc_html__( 'Previous', 'restro-cafe' ).'</span>',
            'next_text'          => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Next', 'restro-cafe' ) .'</span>' . restro_cafe_get_svg( array( 'icon' => 'left-arrow' ) ),
        ) );
	} elseif ( 'older_newer' === $archive_pagination ) {
        the_posts_navigation( array(
            'prev_text'          => '<span class="icon">' . restro_cafe_get_svg( array( 'icon' => 'left-arrow' ) ) . '</span><span>'. esc_html__( 'Older', 'restro-cafe' ) .'</span>',
            'next_text'          => '<span class="icon">' . restro_cafe_get_svg( array( 'icon' => 'left-arrow' ) ) . '</span><span>'. esc_html__( 'Newer', 'restro-cafe' ) .'</span>',
        )  );
	}
}




// Add auto p to the palces where get_the_excerpt is being called.
add_filter( 'get_the_excerpt', 'wpautop' );



if ( ! function_exists( 'restro_cafe_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function restro_cafe_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'restro_cafe_is_yww_activate' ) ) {
	/**
	 * Check if YITH WooCommerce Wishlist is activated.
	 */
	function restro_cafe_is_yww_activate() {
		return class_exists( 'YITH_WCWL' ) ? true : false;
	}
}
