<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Moral
 */

if ( is_woocommerce() && ( is_shop() ||is_product_category() || is_product_tag() ) ) {
	$archive_sidebar = get_theme_mod( 'restro_cafe_woo_global_archive_sidebar', 'right' ); 
	if ( 'no' === $archive_sidebar ) {
		return;
	}
} elseif ( restro_cafe_is_woocommerce_activated() && ( is_product() || is_cart() || is_checkout() || is_account_page() ) ) {
    $restro_cafe_post_sidebar_meta = get_post_meta( get_the_ID(), 'restro-cafe-select-sidebar', true );
	$global_post_sidebar = get_theme_mod( 'restro_cafe_woo_global_singular_layout', 'right' ); 

	if ( ! empty( $restro_cafe_post_sidebar_meta ) && ( 'no' === $restro_cafe_post_sidebar_meta ) ) {
		return;
	} elseif ( empty( $restro_cafe_post_sidebar_meta ) && 'no' === $global_post_sidebar ) {
		return;
	}
}

if ( ! is_active_sidebar( 'woocommerce' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'woocommerce' ); ?>
</aside><!-- #secondary -->