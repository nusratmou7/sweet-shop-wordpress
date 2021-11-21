<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Moral
 */

get_header(); ?>
	<?php restro_cafe_header_image(); ?>

    <div id="inner-content-wrapper" class="wrapper page-section">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main"> 
		        	<?php 
		        	$sticky_posts = get_option( 'sticky_posts' );  
		        	if ( ! empty( $sticky_posts ) ) :
		        	?>
                        <div class="blog-posts-wrapper sticky-post-wrapper">
        	        		<?php  
        						$sticky_query = new WP_Query( array(
        							'post__in'  => $sticky_posts,
        						) );

        						if ( $sticky_query->have_posts() ) :
        							/* Start the Loop */
        							while ( $sticky_query->have_posts() ) : $sticky_query->the_post();
        								get_template_part( 'template-parts/content', get_post_format() );
        							endwhile;
        							wp_reset_postdata();
        						endif;
        	        		?>
                        </div><!-- .blog-posts-wrapper/.sticky-post-wrapper -->
		        	<?php endif; 

	        		$page_id = get_option( 'page_for_posts' );
	        		
	        	    $restro_cafe_page_sidebar_meta = get_post_meta( $page_id, 'restro-cafe-select-sidebar', true );
	        		$global_page_sidebar = get_theme_mod( 'restro_cafe_global_page_layout', 'right' ); 

	        		if ( ! empty( $restro_cafe_page_sidebar_meta ) && ( 'no' === $restro_cafe_page_sidebar_meta ) ) {
	        			$col = 3;
	        		} elseif ( empty( $restro_cafe_page_sidebar_meta ) && 'no' === $global_page_sidebar ) {
	        			$col = 3;
	        		} else {
	        			$col = 2;
	        		}
		        	?>
                    
                    <div  id="restro-cafe-infinite-scroll" class="blog-archive-wrapper clear col-<?php echo esc_attr( $col );?>">
						<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );

							endwhile;

							wp_reset_postdata();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div><!-- .blog-posts-wrapper -->
					<?php restro_cafe_posts_pagination();?>
				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar();?>
	</div>
<?php get_footer();
