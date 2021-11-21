<?php

/**
 * Slider section
 */
// Slider section
$wp_customize->add_section(
	'restro_cafe_slider',
	array(
		'title' => esc_html__( 'Slider', 'restro-cafe' ),
		'panel' => 'restro_cafe_home_panel',
	)
);

// Slider enable settings
$wp_customize->add_setting(
	'restro_cafe_slider',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'disable'
	)
);

$choices =  array( 
				'disable' => esc_html__( '--Disable--', 'restro-cafe' ),
				'page' => esc_html__( 'Page', 'restro-cafe' ),
		 	);

$wp_customize->add_control(
	'restro_cafe_slider',
	array(
		'section'		=> 'restro_cafe_slider',
		'label'			=> esc_html__( 'Content type:', 'restro-cafe' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'restro-cafe' ),
		'type'			=> 'select',
		'choices'		=> $choices,
	)
);

// Slider custom name setting
	$wp_customize->add_setting(
		'restro_cafe_slider_custom_btn',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => $default['restro_cafe_slider_custom_btn'],
		)
	);

	$wp_customize->add_control(
		'restro_cafe_slider_custom_btn',
		array(
			'section'		=> 'restro_cafe_slider',
			'label'			=> esc_html__( 'Button text ', 'restro-cafe' ),
			'active_callback' => 'restro_cafe_if_slider_not_disabled'
		)
	);


for ( $i=1; $i <= 3; $i++ ) { 
	
	// Slider page setting
	$wp_customize->add_setting(
		'restro_cafe_slider_page_' . $i,
		array(
			'sanitize_callback' => 'restro_cafe_sanitize_dropdown_pages',
			'default' => 0,
		)
	);

	$wp_customize->add_control(
		'restro_cafe_slider_page_' . $i,
		array(
			'section'		=> 'restro_cafe_slider',
			'label'			=> esc_html__( 'Page ', 'restro-cafe' ) . $i,
			'type'			=> 'dropdown-pages',
			'active_callback' => 'restro_cafe_if_slider_page'
		)
	);
	
}