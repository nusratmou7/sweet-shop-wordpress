<?php
/**
 * Template part for displaying front page services.
 *
 * @package Moral
 */

// Get default  mods value.
$services = get_theme_mod( 'restro_cafe_services', 'disable' );

if ( 'disable' === $services ) {
    return;
}

$default = restro_cafe_get_default_mods();
$services_section_title = get_theme_mod( 'restro_cafe_services_section_title', $default['restro_cafe_services_section_title'] );

?>


<div id="our-services" class="relative page-section same-background">
    <div class="wrapper">
        <?php if (!empty($services_section_title)) : ?>
            <div class="section-header">
                <?php if (!empty($services_section_title)): ?>
                    <h2 class="section-title"><?php echo esc_html($services_section_title); ?></h2>  
                <?php endif ?>  
            </div><!-- .section-header -->
        <?php endif; ?>

        <!-- supports col-1, col-2,col-3, col-4 -->
        <div class="col-3 clear">
        <?php
                $service_id = array();
                for ( $i=1; $i <= 3; $i++ ) { 
                    $service_id[] = get_theme_mod( "restro_cafe_services_page_" . $i );
                }

                $args = array(
                    'post_type' => 'page',
                    'post__in' => (array)$service_id,   
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
                    <article>
                        <div class="service-item-wrapper">
                            <?php
                            $services_post_icon= get_theme_mod( 'restro_cafe_services_icons_' . $i ); if (!empty($services_post_icon)): ?>
                                <div class="service-icon">
                                <a href="<?php the_permalink(); ?>"><i class="fa <?php echo esc_attr($services_post_icon); ?>"></i></a>
                            </div><!-- .service-icon -->   
                            <?php endif ?>
                        
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </header>

                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-content -->
                        </div><!-- .service-item-wrapper -->
                    </article>
                <?php $i++;
                endwhile;
                wp_reset_postdata();
            endif; 
        ?>
        </div><!-- .col-3 -->
    </div><!-- .wrapper -->
</div><!-- #our-services -->