<?php
/**
 * Template part for displaying front page slider.
 *
 * @package Moral
 */

// Get default  mods value.
$slider = get_theme_mod( 'restro_cafe_slider', 'disable' );

if ( 'disable' === $slider ) {
    return;
}

$default = restro_cafe_get_default_mods();
$slider_readmore = get_theme_mod( 'restro_cafe_slider_custom_btn' );
?>
	<div id="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1500, "dots": true, "arrows":true, "autoplay": false, "draggable": true, "fade": false }'>
		<?php
		        $slider_id = array();
		        for ( $i=1; $i <= 3; $i++ ) { 
		            $slider_id[] = get_theme_mod( "restro_cafe_slider_page_" . $i );
		        }

		        $args = array(
		            'post_type' => 'page',
		            'post__in' => (array)$slider_id,   
	                'orderby'   => 'post__in',
		            'posts_per_page' => 3,
		            'ignore_sticky_posts' => true,
		        );

		    $query = new WP_Query( $args );
		    $i=1;
		    if ( $query->have_posts() ) :
		        while ( $query->have_posts() ) :
		            $query->the_post();
		            ?>
		        <article style="background-image:url('<?php the_post_thumbnail_url('full'); ?>');">
                    <div class="overlay"></div>
                    <div class="wrapper">
                        <div class="featured-content-wrapper">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </header>

                            <div class="entry-content">
                                <?php 
	                                $excerpt = get_the_content();
	                                 echo wp_trim_words( $excerpt, 20); 
                                 ?>
                            </div><!-- .entry-content-->
                            <?php if (!empty($slider_readmore)) : ?>
	                            <div class="read-more">
	                                <a href="<?php the_permalink(); ?>" class="btn"><?php echo esc_html($slider_readmore ); ?></a>
	                            </div><!-- .read-more -->
                        	<?php endif; ?>
                        </div><!-- .featured-content-wrapper -->
                    </div><!-- .wrapper -->
                </article>
		        <?php 
		    	endwhile;
		        wp_reset_postdata();
		    endif;    
		?>
	</div><!-- #featured-slider -->
