<?php

/**
 * Blog section section
 */
// Blog section section
$wp_customize->add_section(
	'restro_cafe_blog_section',
	array(
		'title' => esc_html__( 'Blog section', 'restro-cafe' ),
		'description' => esc_html__( 'Recommended image ratio: 4:3', 'restro-cafe' ),
		'panel' => 'restro_cafe_home_panel',
	)
);

// Blog section enable settings
$wp_customize->add_setting(
	'restro_cafe_blog_section',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'disable'
	)
);

$wp_customize->add_control(
	'restro_cafe_blog_section',
	array(
		'section'		=> 'restro_cafe_blog_section',
		'label'			=> esc_html__( 'Content type:', 'restro-cafe' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'restro-cafe' ),
		'type'			=> 'select',
		'choices'		=> array( 
				'disable' => esc_html__( '--Disable--', 'restro-cafe' ),
				'recent-posts' => esc_html__( 'Recent Posts', 'restro-cafe' ),
		 	)
	)
);

// Blog section title setting
$wp_customize->add_setting(
	'restro_cafe_blog_section_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => $default['restro_cafe_blog_section_title'],
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'restro_cafe_blog_section_title',
	array(
		'section'		=> 'restro_cafe_blog_section',
		'label'			=> esc_html__( 'Title:', 'restro-cafe' ),
		'active_callback' => 'restro_cafe_if_blog_section_not_disabled'
	)
);

$wp_customize->selective_refresh->add_partial( 
	'restro_cafe_blog_section_title', 
	array(
        'selector'            => '#latest-news .section-title',
		'render_callback'     => 'restro_cafe_blog_section_partial_title',
	) 
);
