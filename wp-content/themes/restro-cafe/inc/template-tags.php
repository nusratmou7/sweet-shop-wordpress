<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Moral
 */

if ( ! function_exists( 'restro_cafe_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function restro_cafe_posted_on( $echo = true ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		if ( $echo ) {
			echo '<span class="posted-on">'  . $posted_on . '</span>'; // WPCS: XSS OK.
		} else {
			return '<span class="posted-on">'  . $posted_on . '</span>'; // WPCS: XSS OK.
		}

	}
endif;

if ( ! function_exists( 'restro_cafe_tags' ) ) :
	function restro_cafe_tags() {
		if ( 'post' === get_post_type() ) {
			$archive_tag_enable = get_theme_mod( 'restro_cafe_enable_archive_tag', false );
			$single_tag_enable = get_theme_mod( 'restro_cafe_enable_single_tag', true );
			if ( ( is_single() && $single_tag_enable ) || ( restro_cafe_is_page_displays_posts() && $archive_tag_enable ) ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'restro-cafe' ) );
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . esc_html__( ' Tags: %1$s', 'restro-cafe' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}
			}
		}
	}
endif;

if ( ! function_exists( 'restro_cafe_cats' ) ) :
	function restro_cafe_cats() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) { 
			$archive_cat_enable = get_theme_mod( 'restro_cafe_enable_archive_cat', true );
			$single_cat_enable = get_theme_mod( 'restro_cafe_enable_single_cat', true );
			if ( ( is_single() && $single_cat_enable ) || ( restro_cafe_is_page_displays_posts() && $archive_cat_enable ) ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'restro-cafe' ) );
				if ( $categories_list ) {
					echo  $categories_list ; // WPCS: XSS OK.
				}
			}
		}

	}
endif;

if ( ! function_exists( 'restro_cafe_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function restro_cafe_entry_footer() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			
			$archive_comment_enable = get_theme_mod( 'restro_cafe_enable_archive_comment', false );
			if ( restro_cafe_is_page_displays_posts() && $archive_comment_enable ) {

				echo '<span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses(
							/* translators: %s: post title */
							__( ' Leave a Comment<span class="screen-reader-text"> on %s</span>', 'restro-cafe' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);
				echo '</span>';
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( ' Edit <span class="screen-reader-text">%s</span>', 'restro-cafe' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'restro_cafe_post_author' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function restro_cafe_post_author() {

		$by = esc_html__( 'By: ', 'restro-cafe' );

	
	$author_html = '<span class="byline">' . $by . '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html(         get_the_author() ) . '</a></span></span>';
	echo $author_html;

}
endif;

if ( ! function_exists( 'restro_cafe_header_image' ) ) :
/**
 * Displays header image and breadcrumb.
 *
 */
function restro_cafe_header_image() { 
	$bg_image = get_header_image();
	?>
	<div id="page-site-header" style="background-image: url(<?php if(is_singular()) {
		the_post_thumbnail_url('full');
		} else { echo esc_url( $bg_image ); } ?>); ">
		<div class="overlay"></div>
	    <div class="wrapper">
	        <header class="page-header">
	            <?php
	            if ( restro_cafe_is_latest_posts() ) :
	            	echo '<h1 class="page-title">' . esc_html( get_theme_mod( 'restro_cafe_your_latest_posts_title', esc_html__( 'Blogs', 'restro-cafe' ) ) )  . '</h1>'; 
	            elseif( restro_cafe_is_frontpage_blog() ) :
	            	echo '<h1 class="page-title">' . esc_html( single_post_title( '', false ) ) . '</h1>';
	            elseif ( is_singular() ) :
					the_title( '<h1 class="page-title">', '</h1>' );
				elseif( is_search() ) : ?>
		            <h1 class="page-title"><?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'restro-cafe' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
				<?php elseif( is_archive() ) :
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
				endif; ?>
	        </header>
	        <?php  
	        $breadcrumb_enable = get_theme_mod( 'restro_cafe_breadcrumb_enable', true );
	        if ( $breadcrumb_enable ) : 
	            ?>
	            <div id="breadcrumb-list">

	                    <?php echo restro_cafe_breadcrumb( array( 'show_on_front'   => false, 'show_browse' => false ) ); ?>

	            </div><!-- #breadcrumb-list -->
	        <?php endif; ?>
	    </div><!-- .wrapper -->
	</div><!-- #page-site-header -->
<?php
}
endif;


