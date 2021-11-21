<?php

/**
 * Menus section
 */
// Menus section
$wp_customize->add_section(
	'restro_cafe_menus',
	array(
		'title' => esc_html__( 'Menus', 'restro-cafe' ),
		'panel' => 'restro_cafe_home_panel',
	)
);
$wp_customize->add_setting(
	'restro_cafe_menus_section_background',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_image',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'restro_cafe_menus_section_background',
		array(
			'section'		=> 'restro_cafe_menus',
			'label'			=> esc_html__( 'Background Image ', 'restro-cafe' ),
			'active_callback' => 'restro_cafe_if_menus_not_disabled',
		)
	)
);

// Menus section title setting
	$wp_customize->add_setting(
		'restro_cafe_menus_section_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => $default['restro_cafe_menus_section_title'],
		)
	);

	$wp_customize->add_control(
		'restro_cafe_menus_section_title',
		array(
			'section'		=> 'restro_cafe_menus',
			'label'			=> esc_html__( 'Section Title ', 'restro-cafe' ),
			'active_callback' => 'restro_cafe_if_menus_not_disabled',
			'type'       => 'text',
		)
	);

// Menus enable settings
$wp_customize->add_setting(
	'restro_cafe_menus',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'disable'
	)
);



	
$choices =  array( 
				'disable' => esc_html__( '--Disable--', 'restro-cafe' ),
				'page' => esc_html__( 'Page', 'restro-cafe' ),
		 	);
if ( restro_cafe_is_woocommerce_activated() ) {
		$choices['recent-products'] = esc_html__( 'Recent products', 'restro-cafe' );
	}

$wp_customize->add_control(
	'restro_cafe_menus',
	array(
		'section'		=> 'restro_cafe_menus',
		'label'			=> esc_html__( 'Content type:', 'restro-cafe' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'restro-cafe' ),
		'type'			=> 'select',
		'choices'		=> $choices,
	)
);
for ( $i=1; $i <= 4; $i++ ) { 
	
	// Menus page setting
	$wp_customize->add_setting(
		'restro_cafe_menus_page_' . $i,
		array(
			'sanitize_callback' => 'restro_cafe_sanitize_dropdown_pages',
			'default' => 0,
		)
	);

	$wp_customize->add_control(
		'restro_cafe_menus_page_' . $i,
		array(
			'section'		=> 'restro_cafe_menus',
			'label'			=> esc_html__( 'Page ', 'restro-cafe' ) . $i,
			'type'			=> 'dropdown-pages',
			'active_callback' => 'restro_cafe_if_menus_page'
		)
	);
}