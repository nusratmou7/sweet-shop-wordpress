<?php
/**
 * Template part for displaying content  in post.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Moral
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry' ); ?>>
	<?php 
	$restro_cafe_enable_single_featured_img = get_theme_mod( 'restro_cafe_enable_single_featured_img', true );
	if ( has_post_thumbnail() && $restro_cafe_enable_single_featured_img ) : ?>
		<div class="featured-image">
	        <?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</div><!-- .featured-post-image -->
	<?php endif; ?>
	<?php 
		$single_author_enable = get_theme_mod( 'restro_cafe_enable_single_author', true );
		$single_date_enable = get_theme_mod( 'restro_cafe_enable_single_date', true );
		if( $single_author_enable || $single_date_enable ) :?>
			<div class="entry-meta">
			    <?php 
			    if ( $single_author_enable ) {
			    	restro_cafe_post_author(); 
			    }

				if ( $single_date_enable ) {
		    		restro_cafe_posted_on();
		    	}
		    	
			    ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	<div class="entry-container">
	    <div class="entry-content">
	        <?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'restro-cafe' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'restro-cafe' ),
				'after'  => '</div>',
			) );
			?>
	    </div><!-- .entry-content -->
	</div><!-- .entry-container -->

	<div class="entry-meta">
	    <?php 
		    $single_category_enable = get_theme_mod( 'restro_cafe_enable_single_category', true );
			$single_tags_enable = get_theme_mod( 'restro_cafe_enable_single_tags', true );

	     if ( $single_category_enable ) : ?>
		    <span class="cat-links"><?php esc_html_e('Categories: ', 'restro-cafe'); restro_cafe_cats();  ?></span>
		<?php endif;
		if ( $single_tags_enable ) :
		 	restro_cafe_tags();
		endif;?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
