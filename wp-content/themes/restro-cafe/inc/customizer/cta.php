<?php

/**
 * CTA section
 */
// CTA section
$wp_customize->add_section(
	'restro_cafe_cta',
	array(
		'title' => esc_html__( 'CTA', 'restro-cafe' ),
		'panel' => 'restro_cafe_home_panel',
	)
);

	// CTA image setting
$wp_customize->add_setting(
	'restro_cafe_cta_background_image',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_image',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'restro_cafe_cta_background_image',
		array(
			'section'		=> 'restro_cafe_cta',
			'label'			=> esc_html__( 'Background Image:', 'restro-cafe' ),
			'active_callback' => 'restro_cafe_if_cta_enabled',
		)
	)
);

// CTA enable settings
$wp_customize->add_setting(
	'restro_cafe_cta',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'disable'
	)
);

$wp_customize->add_control(
	'restro_cafe_cta',
	array(
		'section'		=> 'restro_cafe_cta',
		'label'			=> esc_html__( 'Content type:', 'restro-cafe' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'restro-cafe' ),
		'type'			=> 'select',
		'choices'		=> array( 
				'disable' => esc_html__( '--Disable--', 'restro-cafe' ),
				'page' => esc_html__( 'Page', 'restro-cafe' ),
		 	)
	)
);

// CTA page setting
$wp_customize->add_setting(
	'restro_cafe_cta_page',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_dropdown_pages',
		'default' => 0,
	)
);

$wp_customize->add_control(
	'restro_cafe_cta_page',
	array(
		'section'		=> 'restro_cafe_cta',
		'label'			=> esc_html__( 'Page:', 'restro-cafe' ),
		'type'			=> 'dropdown-pages',
		'active_callback' => 'restro_cafe_if_cta_page'
	)
);


// CTA button text setting
$wp_customize->add_setting(
	'restro_cafe_cta_btn_txt',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => $default['restro_cafe_cta_btn_txt'],
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'restro_cafe_cta_btn_txt',
	array(
		'section'		=> 'restro_cafe_cta',
		'label'			=> esc_html__( 'Button Text:', 'restro-cafe' ),
		'active_callback' => 'restro_cafe_if_cta_enabled'
	)
);

$wp_customize->selective_refresh->add_partial( 
	'restro_cafe_cta_btn_txt', 
	array(
        'selector'            => '#cta .more-link a',
		'render_callback'     => 'restro_cafe_cta_partial_btn_txt',
	) 
);
