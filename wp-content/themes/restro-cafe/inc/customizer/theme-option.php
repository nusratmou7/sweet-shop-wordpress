<?php
/**
 *
 * General settings panel
 * 
 */
// General settings panel
$wp_customize->add_panel(
	'restro_cafe_general_panel',
	array(
		'title' => esc_html__( 'Theme Options', 'restro-cafe' ),
		'priority' => 107
	)
);


/**
 * General settings
 */
// General settings
$wp_customize->add_section(
	'restro_cafe_general_section',
	array(
		'title' => esc_html__( 'General', 'restro-cafe' ),
		'panel' => 'restro_cafe_general_panel',
	)
);

// Backtop enable setting
$wp_customize->add_setting(
	'restro_cafe_back_to_top_enable',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'restro_cafe_back_to_top_enable',
	array(
		'section'		=> 'restro_cafe_general_section',
		'label'			=> esc_html__( 'Enable Scroll up.', 'restro-cafe' ),
		'type'			=> 'checkbox',
	)
);

/**
 * Global Layout
 */
// Global Layout
$wp_customize->add_section(
	'restro_cafe_global_layout',
	array(
		'title' => esc_html__( 'Global Layout', 'restro-cafe' ),
		'panel' => 'restro_cafe_general_panel',
	)
);

// Global site layout setting
$wp_customize->add_setting(
	'restro_cafe_site_layout',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'wide',
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'restro_cafe_site_layout',
	array(
		'section'		=> 'restro_cafe_global_layout',
		'label'			=> esc_html__( 'Site layout', 'restro-cafe' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			'boxed' => esc_html__( 'Boxed', 'restro-cafe' ), 
			'wide' => esc_html__( 'Wide', 'restro-cafe' ), 
		),
	)
);

// Global archive layout setting
$wp_customize->add_setting(
	'restro_cafe_archive_sidebar',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'right',
	)
);

$wp_customize->add_control(
	'restro_cafe_archive_sidebar',
	array(
		'section'		=> 'restro_cafe_global_layout',
		'label'			=> esc_html__( 'Archive Sidebar', 'restro-cafe' ),
		'description'			=> esc_html__( 'This option works on all archive pages like: 404, search, date, category, "Your latest posts" and so on.', 'restro-cafe' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			 
			'right' => esc_html__( 'Right', 'restro-cafe' ), 
			'no' => esc_html__( 'No Sidebar', 'restro-cafe' ), 
		),
	)
);

// Global page layout setting
$wp_customize->add_setting(
	'restro_cafe_global_page_layout',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'right',
	)
);

$wp_customize->add_control(
	'restro_cafe_global_page_layout',
	array(
		'section'		=> 'restro_cafe_global_layout',
		'label'			=> esc_html__( 'Global page sidebar', 'restro-cafe' ),
		'description'			=> esc_html__( 'This option works only on single pages including "Posts page". This setting can be overridden for single page from the metabox too.', 'restro-cafe' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			 
			'right' => esc_html__( 'Right', 'restro-cafe' ), 
			'no' => esc_html__( 'No Sidebar', 'restro-cafe' ), 
		),
	)
);

// Global post layout setting
$wp_customize->add_setting(
	'restro_cafe_global_post_layout',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'right',
	)
);

$wp_customize->add_control(
	'restro_cafe_global_post_layout',
	array(
		'section'		=> 'restro_cafe_global_layout',
		'label'			=> esc_html__( 'Global post sidebar', 'restro-cafe' ),
		'description'			=> esc_html__( 'This option works only on single posts. This setting can be overridden for single post from the metabox too.', 'restro-cafe' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			 
			'right' => esc_html__( 'Right', 'restro-cafe' ), 
			'no' => esc_html__( 'No Sidebar', 'restro-cafe' ), 
		),
	)
);

/**
 * Blog/Archive section 
 */
// Blog/Archive section 
$wp_customize->add_section(
	'restro_cafe_archive_settings',
	array(
		'title' => esc_html__( 'Archive/Blog', 'restro-cafe' ),
		'description' => esc_html__( 'Settings for archive pages including blog page too.', 'restro-cafe' ),
		'panel' => 'restro_cafe_general_panel',
	)
);

// Archive excerpt setting
$wp_customize->add_setting(
	'restro_cafe_archive_excerpt',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'View the post', 'restro-cafe' ),
	)
);

$wp_customize->add_control(
	'restro_cafe_archive_excerpt',
	array(
		'section'		=> 'restro_cafe_archive_settings',
		'label'			=> esc_html__( 'Excerpt more text:', 'restro-cafe' ),
	)
);

// Archive excerpt length setting
$wp_customize->add_setting(
	'restro_cafe_archive_excerpt_length',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_number_range',
		'default' => 60,
	)
);

$wp_customize->add_control(
	'restro_cafe_archive_excerpt_length',
	array(
		'section'		=> 'restro_cafe_archive_settings',
		'label'			=> esc_html__( 'Excerpt more length:', 'restro-cafe' ),
		'type'			=> 'number',
		'input_attrs'   => array( 'min' => 5 ),
	)
);

// Tag enable setting
$wp_customize->add_setting(
	'restro_cafe_enable_archive_tag',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_checkbox',
		'default' => false,
	)
);

$wp_customize->add_control(
	'restro_cafe_enable_archive_tag',
	array(
		'section'		=> 'restro_cafe_archive_settings',
		'label'			=> esc_html__( 'Enable tags.', 'restro-cafe' ),
		'type'			=> 'checkbox',
	)
);

// Pagination type setting
$wp_customize->add_setting(
	'restro_cafe_archive_pagination_type',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_select',
		'default' => 'numeric',
	)
);

$archive_pagination_description = '';
$archive_pagination_choices = array( 
			'disable' => esc_html__( '--Disable--', 'restro-cafe' ),
			'numeric' => esc_html__( 'Numeric', 'restro-cafe' ),
			'older_newer' => esc_html__( 'Older / Newer', 'restro-cafe' ),
		);
$wp_customize->add_control(
	'restro_cafe_archive_pagination_type',
	array(
		'section'		=> 'restro_cafe_archive_settings',
		'label'			=> esc_html__( 'Pagination type:', 'restro-cafe' ),
		'description'			=>  $archive_pagination_description,
		'type'			=> 'select',
		'choices'		=> $archive_pagination_choices,
	)
);

/**
 * Reset all settings
 */
// Reset settings section
$wp_customize->add_section(
	'restro_cafe_reset_sections',
	array(
		'title' => esc_html__( 'Reset all', 'restro-cafe' ),
		'description' => esc_html__( 'Reset all settings to default.', 'restro-cafe' ),
		'panel' => 'restro_cafe_general_panel',
	)
);

// Reset sortable order setting
$wp_customize->add_setting(
	'restro_cafe_reset_settings',
	array(
		'sanitize_callback' => 'restro_cafe_sanitize_checkbox',
		'default' => false,
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'restro_cafe_reset_settings',
	array(
		'section'		=> 'restro_cafe_reset_sections',
		'label'			=> esc_html__( 'Reset all settings?', 'restro-cafe' ),
		'type'			=> 'checkbox',
	)
);