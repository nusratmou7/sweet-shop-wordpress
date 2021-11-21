<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
					<?php while ( have_posts() ) : the_post(); ?>
                		<div class="single-post-wrapper">
							<?php get_template_part( 'template-parts/content', 'page' );
						?>
						</div>
						<?php
						$post_pagination_enable = get_theme_mod( 'restro_cafe_enable_single_page_pagination', false );
						if ( $post_pagination_enable ) {
							the_post_navigation( array(
								'prev_text'          => '<span class="icon">' .  restro_cafe_get_svg( array( 'icon' => 'left-arrow' ) ) . '</span>' . '<span>%title</span>',
								'next_text'          => '<span class="icon">' . restro_cafe_get_svg( array( 'icon' => 'left-arrow' ) ) . '</span><span>%title</span>',
							) );
						}
						$single_comment_enable = get_theme_mod( 'restro_cafe_enable_single_comment', true );
						if ( $single_comment_enable ) {

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						}

					endwhile; // End of the loop.
					?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
    </div><!-- #inner-content-wrapper-->

<?php
get_footer();
