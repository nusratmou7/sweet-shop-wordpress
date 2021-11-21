<?php
/**
 * Template part for displaying front page menus.
 *
 * @package Moral
 */

// Get default  mods value.
$menus = get_theme_mod( 'restro_cafe_menus', 'disable' );

if ( 'disable' === $menus ) {
    return;
}

$default = restro_cafe_get_default_mods();
$menus_background = get_theme_mod( 'restro_cafe_menus_section_background' );
$menus_title = get_theme_mod( 'restro_cafe_menus_section_title' , $default['restro_cafe_menus_section_title'] );
?>

<div id="our-menus" class="relative page-section" style="background-image: url('<?php echo esc_url($menus_background); ?>');">
    <div class="overlay"></div>
    <div class="wrapper">
    <?php if (!empty($menus_title)): ?>
    	<div class="section-header">
            <h2 class="section-title"><?php echo esc_html($menus_title); ?></h2>
        </div><!-- .section-header -->
    <?php endif ?>
        
    <div class="col-2 clear">
		<?php
		if ($menus== 'page') {

		        $menu_id = array();
		        for ( $i=1; $i <= 4; $i++ ) { 
		            $menu_id[] = get_theme_mod( "restro_cafe_menus_{$menus}_" . $i );
		        }

		        $args = array(
		            'post_type' => $menus,
		            'post__in' => (array)$menu_id,   
	                'orderby'   => 'post__in',
		            'posts_per_page' => 4,
		            'ignore_sticky_posts' => true,
		        );
		    $query = new WP_Query( $args );
		    $i=1;
		    if ( $query->have_posts() ) :
		        while ( $query->have_posts() ) :
		            $query->the_post();
		            ?>
		            <article>
		                <div class="menu-item-wrapper">
		                    <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url('full') ?>');">
		                        <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
		                    </div>
		                    <div class="entry-container">
		                        <header class="entry-header">
		                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		                        </header>

		                        <div class="entry-content">
		                           <?php the_excerpt(); ?>
		                        </div><!-- .entry-content -->
		                    </div><!-- .entry-container -->
		                </div><!-- .menu-item-wrapper -->
		            </article>
		        <?php 
		    	endwhile;
		        wp_reset_postdata();
		    endif; 
		} else {
				if ( class_exists( 'WooCommerce' ) ) {
	    	    $args = array( 'posts_per_page' => 4 );
			    $products = wc_get_products( $args );
			    if ( $products ) :
			    	foreach ( $products as $product ) {
		    	       $url = $product->get_permalink();
		    	        $thumbnail_id = $product->get_image_id();
		    	        $img_url = wp_get_attachment_url( $thumbnail_id );
		    	        $name  = $product->get_name();

		    	        
		    	        ?>
		    	        <article>
			                <div class="menu-item-wrapper">
			                    <div class="featured-image" style="background-image: url('<?php echo esc_url( $img_url ); ?>');">
			                        <a href="<?php echo esc_url( $url ); ?>" class="post-thumbnail-link"></a>
			                    </div>
			                    <div class="entry-container">
			                        <header class="entry-header">
			                            <h2 class="entry-title"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $name );?></a></h2>
			                        </header>

			                        <div class="entry-content">
			                          <p><?php echo esc_html( $product->get_short_description() ); ?></p>
			                        </div><!-- .entry-content -->
			                    </div><!-- .entry-container -->
		                    	<span class="price">
			                        <span class="woocommerce-Price-amount amount">
			                            <span class="woocommerce-Price-currencySymbol"><?php echo $product->get_price_html(); ?></span>
			                        </span>
			                    </span><!-- .price -->
			                </div><!-- .menu-item-wrapper -->
			            </article>	    	        
			    	<?php
			    	}
			    endif;  
			}
		}
		?>
		
	</div><!-- .wrapper -->
</div><!-- #product-menus -->
</div>