<?php
/**
 *
 * Active callbacks.
 * 
 */

/**
 * Check if the Cta is enabled
 */
function restro_cafe_if_cta_enabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'restro_cafe_cta' )->value();
}

/**
 * Check if the Cta is page
 */
function restro_cafe_if_cta_page( $control ) {
	return 'page' === $control->manager->get_setting( 'restro_cafe_cta' )->value();
}

/**
 * Check if the about is enabled
 */
function restro_cafe_if_about_enabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'restro_cafe_about' )->value();
}

/**
 * Check if the about is page
 */
function restro_cafe_if_about_page( $control ) {
	return 'page' === $control->manager->get_setting( 'restro_cafe_about' )->value();
}

/**
 * Check if the services is not disabled
 */
function restro_cafe_if_services_not_disabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'restro_cafe_services' )->value();
}

/**
 * Check if the services is page
 */
function restro_cafe_if_services_page( $control ) {
	return 'page' === $control->manager->get_setting( 'restro_cafe_services' )->value();
}

/**
 * Check if the menus is not disabled
 */
function restro_cafe_if_menus_not_disabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'restro_cafe_menus' )->value();
}


/**
 * Check if the menus is page
 */
function restro_cafe_if_menus_page( $control ) {
	return 'page' === $control->manager->get_setting( 'restro_cafe_menus' )->value();
}


/**
 * Check if the slider is not disabled
 */
function restro_cafe_if_slider_not_disabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'restro_cafe_slider' )->value();
}

/**
 * Check if the slider is page
 */
function restro_cafe_if_slider_page( $control ) {
	return 'page' === $control->manager->get_setting( 'restro_cafe_slider' )->value();
}
/**
 * Check if the blog section is not disabled
 */
function restro_cafe_if_blog_section_not_disabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'restro_cafe_blog_section' )->value();
}

/**
 * Check if custom color scheme is enabled
 */
function restro_cafe_if_custom_color_scheme( $control ) {
	return 'custom' === $control->manager->get_setting( 'restro_cafe_color_scheme' )->value();
}


