<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Moral
 */

if ( is_archive() || restro_cafe_is_latest_posts() || is_404() || is_search() ) {
	$archive_sidebar = get_theme_mod( 'restro_cafe_archive_sidebar', 'right' ); 
	if ( 'no' === $archive_sidebar ) {
		return;
	}
} elseif ( is_single() ) {
    $restro_cafe_post_sidebar_meta = get_post_meta( get_the_ID(), 'restro-cafe-select-sidebar', true );
	$global_post_sidebar = get_theme_mod( 'restro_cafe_global_post_layout', 'right' ); 

	if ( ! empty( $restro_cafe_post_sidebar_meta ) && ( 'no' === $restro_cafe_post_sidebar_meta ) ) {
		return;
	} elseif ( empty( $restro_cafe_post_sidebar_meta ) && 'no' === $global_post_sidebar ) {
		return;
	}
} elseif ( restro_cafe_is_frontpage_blog() || is_page() ) {
	if ( restro_cafe_is_frontpage_blog() ) {
		$page_id = get_option( 'page_for_posts' );
	} else {
		$page_id = get_the_ID();
	}
	
    $restro_cafe_page_sidebar_meta = get_post_meta( $page_id, 'restro-cafe-select-sidebar', true );
	$global_page_sidebar = get_theme_mod( 'restro_cafe_global_page_layout', 'right' ); 

	if ( ! empty( $restro_cafe_page_sidebar_meta ) && ( 'no' === $restro_cafe_page_sidebar_meta ) ) {
		return;
	} elseif ( empty( $restro_cafe_page_sidebar_meta ) && 'no' === $global_page_sidebar ) {
		return;
	}
}

if ( restro_cafe_is_woocommerce_activated() && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
	get_sidebar( 'shop' );
} else {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
	?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
<?php }
