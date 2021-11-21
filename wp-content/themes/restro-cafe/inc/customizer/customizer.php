<?php
/**
 * Moral Theme Customizer
 *
 * @package Moral
 */

/**
 * Get all the default values of the theme mods.
 */
function restro_cafe_get_default_mods() {
	$restro_cafe_default_mods = array(
		
		// CTA
		'restro_cafe_cta_title' => __( 'BEST GRILLED STEAK', 'restro-cafe' ),
		'restro_cafe_cta_btn_txt' => __( 'Shop Now', 'restro-cafe' ),

		// About
		'restro_cafe_about_title' => __( 'WELCOME EATING WELL', 'restro-cafe' ),
		'restro_cafe_about_btn_txt' => __( 'Continue Reading', 'restro-cafe' ),
		

		// Menus
		'restro_cafe_menus_section_title' => __('WEEKLY SPECIALS', 'restro-cafe'),


		// Sliders
		'restro_cafe_slider_custom_btn' => __( 'Know More', 'restro-cafe' ),
		
		// Services
		'restro_cafe_services_section_title' => __( 'WHAT WE OFER', 'restro-cafe' ),
		

		// Blog section
		'restro_cafe_blog_section_title' => __( 'SPECIAL TIPS & RECIPES', 'restro-cafe' ),

		// Footer copyright
		'restro_cafe_copyright_txt' => sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'restro-cafe' ), 'Restro Cafe', '<a href="' . esc_url( 'http://moralthemes.com/' ) . '">Moral Themes</a>' ),
	);

	return apply_filters( 'restro_cafe_default_mods', $restro_cafe_default_mods );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function restro_cafe_customize_register( $wp_customize ) {
	/**
	 * Separator custom control
	 *
	 * @version 1.0.0
	 * @since  1.0.0
	 */
	class Restro_Cafe_Multi_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'restro-cafe-separator';

		/**
		 * Control type
		 *
		 * @var string
		 */
		public $content = '';

		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			if ( 'restro-cafe-separator' === $this->type ) : ?>
				<p><hr style="border-color: #222; opacity: 0.2;"></p>
			<?php endif; ?>

			<?php if ( 'restro-cafe-custom' === $this->type ) : ?>
				<?php echo wp_kses_post( $this->content );?>
			<?php endif; 
		}
	}

	/**
	 * The radio image customize control extends the WP_Customize_Control class.  This class allows
	 * developers to create a list of image radio inputs.
	 *
	 * Note, the `$choices` array is slightly different than normal and should be in the form of
	 * `array(
		 *	$value => array( 'color' => $color_value ),
		 *	$value => array( 'color' => $color_value ),
	 * )`
	 *
	 */

	/**
	 * Radio color customize control.
	 *
	 * @since  3.0.0
	 * @access public
	 */
	class Restro_Cafe_Customize_Control_Radio_Color extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 *
		 * @since  3.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'radio-color';

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  3.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();

			// We need to make sure we have the correct color URL.
			foreach ( $this->choices as $value => $args )
				$this->choices[ $value ]['color'] = esc_attr( $args['color'] );

			$this->json['choices'] = $this->choices;
			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
		}

		/**
		 * Don't render the content via PHP.  This control is handled with a JS template.
		 *
		 * @since  4.0.0
		 * @access public
		 * @return bool
		 */
		protected function render_content() {}

		/**
		 * Underscore JS template to handle the control's output.
		 *
		 * @since  3.0.0
		 * @access public
		 * @return void
		 */
		public function content_template() { ?>

			<# if ( ! data.choices ) {
				return;
			} #>

			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<# _.each( data.choices, function( args, choice ) { #>
				<label>
					<input type="radio" value="{{ choice }}" name="_customize-{{ data.type }}-{{ data.id }}" {{{ data.link }}} <# if ( choice === data.value ) { #> checked="checked" <# } #> />

					<span class="screen-reader-text">{{ args.label }}</span>
					
					<# if ( 'custom' != choice ) { #>
						<span class="color-value" style="background-color: {{ args.color }}"></span>
					<# } else { #>
						<span class="color-value custom-color-value"></span>
					<# } #>
				</label>
			<# } ) #>
		<?php }
	}

	$wp_customize->register_control_type( 'Restro_Cafe_Customize_Control_Radio_Color' );

	class Restro_Cafe_Customize_Control_Sort_Sections extends WP_Customize_Control {

	  	/**
	   	* Control Type
	   	*/
	  	public $type = 'sortable';
	  
		/**
		* Add custom parameters to pass to the JS via JSON.
		*
		* @access public
		* @return void
		*/
	  	public function to_json() {
		  	parent::to_json();

	    	$choices = $this->choices;
	      	$choices = array_filter( array_merge( array_flip( $this->value() ), $choices ) );
		  	$this->json['choices'] = $choices;
		  	$this->json['link']    = $this->get_link();
		  	$this->json['value']   = $this->value();
		  	$this->json['id']      = $this->id;
	  	}

	  	/**
	   	* Render Settings
	   	*/
	  	public function content_template() { ?>
		  	<# if ( ! data.choices ) {
		  		return;
		  	} #>

		    <# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>

		    <# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

		    <ul class="restro-cafe-sortable-list">

		      	<# _.each( data.choices, function( args, choice ) { #>

		        <li>
		            <input class="restro-cafe-sortable-input sortable-hideme" name="{{choice}}" type="hidden"  value="{{ choice }}" />
		            <span class ="menu-item-handle sortable-span">{{args.name}}</span>
		          <i title="<?php esc_attr_e( 'Drag and Move', 'restro-cafe' );?>" class="dashicons dashicons-menu restro-cafe-drag-handle"></i>
		          <i title="<?php esc_attr_e( 'Edit', 'restro-cafe' );?>" class="dashicons dashicons-edit restro-cafe-edit" data-jump="{{args.section_id}}"></i>
		        </li>

		        <# } ) #>

		        <li class="sortable-hideme">
		          <input class="restro-cafe-sortable-value" {{{ data.link }}} value="{{data.value}}" />
		        </li>

		    </ul>
	  	<?php
	  	}
	}

	$wp_customize->register_control_type( 'Restro_Cafe_Customize_Control_Sort_Sections' );

	class Restro_Cafe_Customize_Control_Range_Value extends WP_Customize_Control {
		public $type = 'range-value';

		/**
		* Add custom parameters to pass to the JS via JSON.
		*
		* @access public
		* @return void
		*/
	  	public function to_json() {
		  	parent::to_json();

		  	$this->json['link']    		= $this->get_link();
		  	$this->json['value']  		= $this->value();
		  	$this->json['id']      		= $this->id;
		  	$this->json['input_attrs']      		= $this->input_attrs;
	  	}

		/**
		 * Render the control's content.
		 *
		 */
		public function content_template() {
			?>
			<label>
		    	<# if ( data.label ) { #>
					<span class="customize-control-title">{{ data.label }}</span>
				<# } #>
				<div class="range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
					<span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="{{{ data.value }}}" 
						<# _.each( data.input_attrs, function( input_value, attr ) { #>
							{{{attr}}} = {{{input_value}}}
		        		<# } ) #>
						{{{ data.link }}}>
					<span class="range-slider__value">0</span></span>
				</div>
		    	<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
			</label>
			<?php
		}
	}

	$wp_customize->register_control_type( 'Restro_Cafe_Customize_Control_Range_Value' );

	$default = restro_cafe_get_default_mods();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'restro_cafe_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'restro_cafe_customize_partial_blogdescription',
		) );
	}

	/**
	 *
	 * 
	 * Header panel
	 *
	 * 
	 */
	// Header panel
	$wp_customize->add_panel(
		'restro_cafe_header_panel',
		array(
			'title' => esc_html__( 'Header', 'restro-cafe' ),
			'priority' => 100
		)
	);


	// Header section
	$wp_customize->add_section(
		'restro_cafe_header_section',
		array(
			'title' => esc_html__( 'Header Menu', 'restro-cafe' ),
			'panel' => 'nav_menus',
		)
	);

	// Header menu sticky enable settings
	$wp_customize->add_setting(
		'restro_cafe_make_menu_transparent',
		array(
			'sanitize_callback' => 'restro_cafe_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'restro_cafe_make_menu_transparent',
		array(
			'section'		=> 'restro_cafe_header_section',
			'label'			=> esc_html__( 'Make menu transparent.', 'restro-cafe' ),
			'type'			=> 'checkbox',
		)
	);


	// Your latest posts title setting
	$wp_customize->add_setting(	
		'restro_cafe_your_latest_posts_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => esc_html__( 'Blogs', 'restro-cafe' ),
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'restro_cafe_your_latest_posts_title',
		array(
			'section'		=> 'static_front_page',
			'label'			=> esc_html__( 'Title:', 'restro-cafe' ),
			'active_callback' => 'restro_cafe_is_latest_posts'
		)
	);

	$wp_customize->selective_refresh->add_partial( 
		'restro_cafe_your_latest_posts_title', 
		array(
	        'selector'            => '.home.blog #page-header .page-title',
			'render_callback'     => 'restro_cafe_your_latest_posts_partial_title',
    	) 
    );
	
	
	/**
	 *
	 * 
	 * Front sections panel
	 *
	 * 
	 */

	$wp_customize->add_panel(
		'restro_cafe_home_panel',
		array(
			'title' => esc_html__( 'Homepage Options', 'restro-cafe' ),
			'priority' => 105
		)
	);
	
	require get_parent_theme_file_path('/inc/customizer/slider.php');

	require get_parent_theme_file_path('/inc/customizer/service.php');

	require get_parent_theme_file_path('/inc/customizer/cta.php');

	require get_parent_theme_file_path('/inc/customizer/about.php');

	require get_parent_theme_file_path('/inc/customizer/menu.php') ;

	require get_parent_theme_file_path('/inc/customizer/blog.php');


	// Theme Options

	require get_parent_theme_file_path('/inc/customizer/theme-option.php');
	
}
add_action( 'customize_register', 'restro_cafe_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function restro_cafe_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function restro_cafe_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function restro_cafe_customize_preview_js() {
	wp_enqueue_script( 'restro-cafe-customizer', get_theme_file_uri( '/assets/js/customizer.js' ), array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'restro_cafe_customize_preview_js' );

/**
 * Binds JS handlers for Customizer controls.
 */
function restro_cafe_customize_control_js() {


	wp_enqueue_style( 'restro-cafe-customize-style', get_theme_file_uri( '/assets/css/customize-controls.css' ), array(), '20151215' );

	wp_enqueue_script( 'restro-cafe-customize-control', get_theme_file_uri( '/assets/js/customize-control.js' ), array( 'jquery', 'customize-controls' ), '20151215', true );
	$localized_data = array( 
		'refresh_msg' => esc_html__( 'Refresh the page after Save and Publish.', 'restro-cafe' ),
		'reset_msg' => esc_html__( 'Warning!!! This will reset all the settings. Refresh the page after Save and Publish to reset all.', 'restro-cafe' ),
	);

	wp_localize_script( 'restro-cafe-customize-control', 'localized_data', $localized_data );
}
add_action( 'customize_controls_enqueue_scripts', 'restro_cafe_customize_control_js' );



require get_parent_theme_file_path( '/inc/customizer/sanitize-callback.php' );

require get_parent_theme_file_path( '/inc/customizer/active-callback.php' );

require get_parent_theme_file_path( '/inc/customizer/partial-refresh.php' );
