<?php
/**
 * Template part for displaying front page blog section.
 *
 * @package Moral
 */

// Get default  mods value.
$blog_section = get_theme_mod( 'restro_cafe_blog_section', 'disable' );

if ( 'disable' === $blog_section ) {
	return;
}

$default = restro_cafe_get_default_mods();
?>

<div id="latest-posts" class="relative page-section same-background">
    <div class="wrapper">
        <div class="section-header">
        	<?php  
        	$section_title =  get_theme_mod( 'restro_cafe_blog_section_title', $default['restro_cafe_blog_section_title'] );
        	
            if ( ! empty( $section_title ) ) : ?>
                <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
            <?php endif; ?>

        </div><!-- .section-header -->

        <!-- supports col-1, col-2, col-3, col-4 -->

        <div class="blog-archive-wrapper col-3 clear">
        	<?php  
        	$btn_link = get_permalink( get_option( 'page_for_posts' ) );

        	if ( 'recent-posts' === $blog_section ) {
            	$args = array(
            			'posts_per_page' => 3,
            			'ignore_sticky_posts' => true,
            		);
        	}

        	$query = new WP_Query( $args );

			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post(); 

						$class = ( has_post_thumbnail() ) ? 'has-post-thumbnail' : '';
						?> 
                        <article class="<?php echo esc_attr( $class );?>">
                            <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url('large') ?>');">
                                <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
                            </div><!-- .featured-image -->

                            <div class="entry-container">
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <span class="screen-reader-text"><?php esc_html_e('Posted on', 'restro-cafe'); ?></span> 
                                        <?php restro_cafe_posted_on();?>
                                    </span>
                                    <span class="cat-links">
                                       <?php the_category(); ?>
                                    </span><!-- .cat-links -->
                                </div><!-- .entry-meta -->

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                   <?php the_excerpt(); ?>
                                </div><!-- .entry-content -->

                                <div class="read-more">
                                   <a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Read More', 'restro-cafe' ); ?>
                                </a>
                                </div><!-- .read-more -->
                            </div><!-- .entry-container -->
                        </article>

		        <?php endwhile; ?>
		        <?php wp_reset_postdata(); ?>
        	<?php endif; ?>
        </div><!-- .blog-posts-wrapper -->
    </div><!-- .wrapper -->
</div><!-- #latest-posts -->
