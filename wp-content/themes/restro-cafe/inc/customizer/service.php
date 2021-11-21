<?php
/**
 * Services section
 */
// Services section
$wp_customize->add_section(
	'restro_cafe_services',
	array(
		'title' => esc_html__( 'Services', 'restro-cafe' ),
		'panel' => 'restro_cafe_home_panel',
	)
);

$wp_customize->add_setting(
	'restro_cafe_services_section_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => $default['restro_cafe_services_section_title'],
		'transport'	=> 'refresh',
	)
);

$wp_customize->add_control(
	'restro_cafe_services_section_title',
	array(
		'section'		=> 'restro_cafe_services',
		'label'			=> esc_html__( 'Title:', 'restro-cafe' ),
		'active_callback' => 'restro_cafe_if_services_not_disabled'
	)
);

$wp_customize->selective_refresh->add_partial( 
	'restro_cafe_services_section_title', 
	array(
        'selector'            => '#shop-now .section-title',
		'render_callback'     => 'restro_cafe_services_section_partial_title',
	) 
);


// Services enable settings
$wp_customize->add_setting(
	'restro_cafe_services',
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
	'restro_cafe_services',
	array(
		'section'		=> 'restro_cafe_services',
		'label'			=> esc_html__( 'Content type:', 'restro-cafe' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'restro-cafe' ),
		'type'			=> 'select',
		'choices'		=> $choices,
	)
);

for ( $i=1; $i <= 3; $i++ ) { 

	// Services icon setting
	$wp_customize->add_setting(
		'restro_cafe_services_icons_' . $i,
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'	=> 'postMessage',

		)
	);

	$wp_customize->add_control(
		'restro_cafe_services_icons_' . $i,
		array(
			'section'		=> 'restro_cafe_services',
			'label'			=> esc_html__( 'icon ', 'restro-cafe' ) . $i,
			'description' => sprintf( __('Please input icon as eg: fa-archive. Find Font-awesome icons %1$shere%2$s', 'restro-cafe'), '<a href="' . esc_url( 'https://fontawesome.com/v4.7.0/cheatsheet/' ) . '" target="_blank">', '</a>' ),
			'active_callback' => 'restro_cafe_if_services_not_disabled',
			'type'			=> 'text'
		)
	);
	
	// Services page setting
	$wp_customize->add_setting(
		'restro_cafe_services_page_' . $i,
		array(
			'sanitize_callback' => 'restro_cafe_sanitize_dropdown_pages',
			'default' => 0,
		)
	);

	$wp_customize->add_control(
		'restro_cafe_services_page_' . $i,
		array(
			'section'		=> 'restro_cafe_services',
			'label'			=> esc_html__( 'Page ', 'restro-cafe' ) . $i,
			'type'			=> 'dropdown-pages',
			'active_callback' => 'restro_cafe_if_services_page'
		)
	);
}