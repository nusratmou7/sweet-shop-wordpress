/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function( $, api ) {
    var rangeSlider = function() {
        var slider = $('.range-slider'),
            range = $('.range-slider__range'),
            value = $('.range-slider__value');

        slider.each(function() {

            value.each(function() {
                var value = $(this).prev().attr('value');
                var suffix = ($(this).prev().attr('suffix')) ? $(this).prev().attr('suffix') : '';
                $(this).html(value + suffix);
            });

            range.on('input', function() {
                var suffix = ($(this).attr('suffix')) ? $(this).attr('suffix') : '';
                $(this).next(value).html(this.value + suffix );
            });
        });
    };

    wp.customize.bind('ready', function() {
        
        rangeSlider();

    	// Show message on change.
        var restro_cafe_settings = ['restro_cafe_slider_num', 'restro_cafe_featured_num', 'restro_cafe_popular_num', 'restro_cafe_cta_tab_num', 'restro_cafe_testimonial_num', 'restro_cafe_reset_settings', 'restro_cafe_partner_num', 'restro_cafe_blog_section_num'];
        _.each( restro_cafe_settings, function( restro_cafe_setting ) {
            wp.customize( restro_cafe_setting, function( setting ) {
                var storemallNotice = function( value ) {
                    var name = 'needs_refresh';
                    if ( value && restro_cafe_setting == 'restro_cafe_reset_settings' ) {
                        setting.notifications.add( 'needs_refresh', new wp.customize.Notification(
                            name,
                            {
                                type: 'warning',
                                message: localized_data.reset_msg,
                            }
                        ) );
                    } else if( value ){
                        setting.notifications.add( 'reset_name', new wp.customize.Notification(
                            name,
                            {
                                type: 'info',
                                message: localized_data.refresh_msg,
                            }
                        ) );
                    } else {
                        setting.notifications.remove( name );
                    }
                };

                setting.bind( storemallNotice );
            });
        });

        /* === Radio Image Control === */
        api.controlConstructor['radio-color'] = api.Control.extend( {
            ready: function() {
                var control = this;

                $( 'input:radio', control.container ).change(
                    function() {
                        control.setting.set( $( this ).val() );
                    }
                );
            }
        } );

        // Sortable sections
        jQuery( "body" ).on( 'hover', '.restro-cafe-drag-handle', function() {
            jQuery( 'ul.restro-cafe-sortable-list' ).sortable({
                handle: '.restro-cafe-drag-handle',
                axis: 'y',
                update: function( e, ui ){
                    jQuery('input.restro-cafe-sortable-input').trigger( 'change' );
                }
            });
        });

        /* On changing the value. */
        jQuery( "body" ).on( 'change', 'input.restro-cafe-sortable-input', function() {
            /* Get the value, and convert to string. */
            this_checkboxes_values = jQuery( this ).parents( 'ul.restro-cafe-sortable-list' ).find( 'input.restro-cafe-sortable-input' ).map( function() {
                return this.value;
            }).get().join( ',' );

            /* Add the value to hidden input. */
            jQuery( this ).parents( 'ul.restro-cafe-sortable-list' ).find( 'input.restro-cafe-sortable-value' ).val( this_checkboxes_values ).trigger( 'change' );

        });

        // Deep linking for counter section to about section.
        jQuery('.restro-cafe-edit').click(function(e) {
            e.preventDefault();
            var jump_to = jQuery(this).attr( 'data-jump' );
            wp.customize.section( jump_to ).focus()
        });

        // Deep linking for counter section to about section.
        jQuery('.restro-cafe-slider-jump-to-menu').click(function(e) {
            e.preventDefault();
            wp.customize.panel( 'nav_menus' ).focus()
        });

         // Deep linking for to widget area section.
        jQuery('.restro-cafe-widget-jump-to-widget').click(function(e) {
            e.preventDefault();
            wp.customize.section( 'sidebar-widgets-homepage-area' ).focus()
        });
    });
})( jQuery, wp.customize );
