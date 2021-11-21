<?php

/**
 * About section
 */
// About section
$wp_customize->add_section(
	'restro_cafe_about',
	array(
		'title' => esc_html__( 'About', 'restro-cafe' ),
		'panel' => 'restro_cafe_home_panel',
	)
);

// About enable settings
$wp_customize->add_setting(
	'restro_cafe_about',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'disable'
	)
);

$wp_customize->add_control(
	'restro_cafe_about',
	array(
		'section'		=> 'restro_cafe_about',
		'label'			=> esc_html__( 'Content type:', 'restro-cafe' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'restro-cafe' ),
		'type'			=> 'select',
		'choices'		=> array( 
				'disable' => esc_html__( '--Disable--', 'restro-cafe' ),
				'page' => esc_html__( 'Page', 'restro-cafe' ),
		 	)
	)
);

// About page setting
$wp_customize->add_setting(
	'restro_cafe_about_page',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_dropdown_pages',
		'default' => 0,
	)
);

$wp_customize->add_control(
	'restro_cafe_about_page',
	array(
		'section'		=> 'restro_cafe_about',
		'label'			=> esc_html__( 'Page:', 'restro-cafe' ),
		'type'			=> 'dropdown-pages',
		'active_callback' => 'restro_cafe_if_about_page'
	)
);
// About custom name setting
	$wp_customize->add_setting(
		'restro_cafe_about_btn_txt',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => $default['restro_cafe_about_btn_txt'],
		)
	);

	$wp_customize->add_control(
		'restro_cafe_about_btn_txt',
		array(
			'section'		=> 'restro_cafe_about',
			'label'			=> esc_html__( 'Button text ', 'restro-cafe' ),
			'active_callback' => 'restro_cafe_if_about_page'
		)
	);