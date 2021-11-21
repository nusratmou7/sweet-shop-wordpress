<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Moral
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	$archive_img_enable = get_theme_mod( 'restro_cafe_enable_archive_featured_img', true );

	if ( has_post_thumbnail() && $archive_img_enable ) { ?>
		<div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
	        <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
	    </div><!-- .featured-image -->
	<?php } ?>
	<div class="entry-container">
		<div class="entry-meta">
			<?php 
			$archive_date_enable = get_theme_mod( 'restro_cafe_enable_archive_date', true );
			if ( $archive_date_enable ) {
				restro_cafe_posted_on(); 
			}
			?>
			<span class="cat-links">
				<?php restro_cafe_cats();  ?>
			</span>
	    </div><!-- .entry-meta -->
		<header class="entry-header">
	        <?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
	    </header>

	    <div class="entry-content">
	        <?php
				$archive_content_type = get_theme_mod( 'restro_cafe_enable_archive_content_type', 'excerpt' );
				if ( 'excerpt' === $archive_content_type ) {
					the_excerpt();					
				} else {
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
				}
			?>
	    	
	    	<?php restro_cafe_tags(); ?>

	    </div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
