<?php
/**
 * Template Name: Home Page
 *
 * @package Moral Themes
 * @subpackage Restro_Cafe
 * @since Restro Cafe 1.0.0
 */

get_header();
?>


    <?php
    	get_template_part( 'template-parts/frontpage-parts/slider' );
    	get_template_part( 'template-parts/frontpage-parts/services' );
    	get_template_part( 'template-parts/frontpage-parts/cta' );
    	get_template_part( 'template-parts/frontpage-parts/about' );
    	get_template_part( 'template-parts/frontpage-parts/menus' );
    	get_template_part( 'template-parts/frontpage-parts/blog' );
    ?>
<?php 
get_footer();