<?php
/**
 * Template part for displaying front page about.
 *
 * @package Moral
 */
// Get default  mods value.
$default = restro_cafe_get_default_mods();

// Get the content type.
$about = get_theme_mod( 'restro_cafe_about', 'disable' );

// Bail if the section is disabled.
if ( 'disable' === $about ) {
    return;
}


    $about_id = get_theme_mod( 'restro_cafe_about_page' );
    $query = new WP_Query( array( 'post_type' => 'page', 
        'p' => absint( $about_id )
         ) );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $img_url     = get_the_post_thumbnail_url( $about_id, 'large' );
            $about_title   = get_the_title();
            $content = get_the_content();
            $btn_url     = get_permalink();
        }
        wp_reset_postdata();
    }
$btn_txt = get_theme_mod( 'restro_cafe_about_btn_txt');
?>


<div id="about-us" class="relative page-section">
    <div class="wrapper">
        <article class="has-post-thumbnail">
            <div class="featured-image" style="background-image: url('<?php echo esc_url($img_url); ?>');">
                <a href="<?php echo esc_url($btn_url ); ?>" class="post-thumbnail-link"></a>
            </div><!-- .featured-image -->

            <div class="entry-container">
                <?php if (!empty($about_title) || !empty($about_subtitle)): ?>
                    <div class="section-header">
                        <?php if (!empty($about_title)): ?>
                            <h2 class="section-title"><a href="<?php echo esc_url($btn_url); ?> "><?php echo esc_html($about_title); ?> </a></h2>
                        <?php endif ?>
                        
                    </div><!-- .section-header -->
                <?php endif ?>
                
                    <div class="entry-content">
                        <p><?php 
                            $excerpt = get_the_content();
                             echo wp_trim_words( $content, 60); 
                         ?></p>
                    </div><!-- .entry-content -->
               
                <?php if (!empty($btn_txt)): ?>
                <div class="read-more">
                    <a href="<?php echo esc_url($btn_url ); ?>" class="btn"><?php echo esc_html($btn_txt);?></a>
                </div><!-- .read-more -->
            <?php endif; ?>
            </div><!-- .entry-container -->
        </article>
    </div><!-- .wrapper -->
</div><!-- #about-us -->