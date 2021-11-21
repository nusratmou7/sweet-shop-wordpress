<?php
/**
 * Template part for displaying front page cta.
 *
 * @package Moral
 */
// Get default  mods value.
$default = restro_cafe_get_default_mods();

// Get the content type.
$cta = get_theme_mod( 'restro_cafe_cta', 'disable' );


// Bail if the section is disabled.
if ( 'disable' === $cta ) {
	return;
}

	$cta_id = get_theme_mod( 'restro_cafe_cta_page' );

	$query = new WP_Query( array( 'post_type' => 'page', 'p' => absint( $cta_id ) ) );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$img_url     = get_the_post_thumbnail_url( $cta_id, 'medium' );
			$cta_title   = get_the_title();
			$content = get_the_excerpt();
			$btn_url     = get_permalink();
		}
		wp_reset_postdata();
	}

// Get the common settings value  in custom, page and post.
$cta_background_image = get_theme_mod( 'restro_cafe_cta_background_image');
$btn_txt = get_theme_mod( 'restro_cafe_cta_btn_txt', $default['restro_cafe_cta_btn_txt'] );

?>

<div id="call-to-action" class="relative page-section" style="background-image: url('<?php echo esc_url($cta_background_image); ?>');">
    <div class="overlay"></div>
    <div class="wrapper">
    	<?php if (!empty($cta_title) ): ?>
    		<div class="section-header">
            	<?php if (!empty($cta_title)): ?>
            		<h2 class="section-title"><?php echo esc_html($cta_title); ?></h2>
            	<?php endif ?>
	            
	        </div><!-- .section-header -->
    	<?php endif ?>
       
    	<?php if (!empty($img_url)): ?>
    		<div class="offer-image">
	            <img src="<?php echo esc_url($img_url); ?>" alt="offer">
	        </div><!-- .offer-image -->
    	<?php endif ?>
        
    	<?php if (!empty($btn_txt) || ! empty( $btn_url ) ): ?>
    		<div class="order-now">
	            <a href="<?php echo esc_url($btn_url ); ?>" class="btn"><?php echo esc_html($btn_txt);?></a>
	        </div><!-- .order-now -->
    	<?php endif ?>
        
    </div><!-- .wrapper -->
</div><!-- #call-to-action -->
