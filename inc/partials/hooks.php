<?php
/**
 * Map Section
 */
add_action( 'bx_ext_part__map', 'bx_ext_part__map_wrap_start', 10 );
add_action( 'bx_ext_part__map', 'bx_ext_part__map_overlay',    20 );
add_action( 'bx_ext_part__map', 'bx_ext_part__map_output',     30 );
add_action( 'bx_ext_part__map', 'bx_ext_part__map_wrap_end',  999 );

add_action( 'bx_ext_part__map_overlay', 'bx_ext_part__map_overlay_start',   10 );
add_action( 'bx_ext_part__map_overlay', 'bx_ext_part__map_overlay_content', 20 );
add_action( 'bx_ext_part__map_overlay', 'bx_ext_part__map_overlay_end',    999 );

add_action( 'bx_ext_part__map_overlay_content', 'bx_ext_part__map_overlay_content_start', 10 );
add_action( 'bx_ext_part__map_overlay_content', 'bx_ext_part__map_overlay_content_title', 20 );
add_action( 'bx_ext_part__map_overlay_content', 'bx_ext_part__map_overlay_content_icon',  30 );
add_action( 'bx_ext_part__map_overlay_content', 'bx_ext_part__map_overlay_content_end',  999 );


/**
 * Contact Section
 */
add_action( 'bx_ext_part__contact', 'bx_ext_part__contact_wrap_start', 10 );
add_action( 'bx_ext_part__contact', 'bx_ext_part__contact_overlay',    20 );
add_action( 'bx_ext_part__contact', 'bx_ext_part__contact_container',  30 );
add_action( 'bx_ext_part__contact', 'bx_ext_part__contact_wrap_end',  999 );

add_action( 'bx_ext_part__contact_container', 'bx_ext_part__contact_container_start', 10 );
add_action( 'bx_ext_part__contact_container', 'bx_ext_part__contact_items',           20 );
add_action( 'bx_ext_part__contact_container', 'bx_ext_part__contact_container_end',  999 );

add_action( 'bx_ext_part__contact_items', 'bx_ext_part__contact_items_start',   10 );
add_action( 'bx_ext_part__contact_items', 'bx_ext_part__contact_items_display', 20 );
add_action( 'bx_ext_part__contact_items', 'bx_ext_part__contact_items_end',    999 );

add_action( 'bx_ext_part__contact_items_display', 'bx_ext_part__contact_info',   10 );
add_action( 'bx_ext_part__contact_items_display', 'bx_ext_part__contact_form', 20 );

add_action( 'bx_ext_part__contact_info', 'bx_ext_part__contact_info_start',   10 );
add_action( 'bx_ext_part__contact_info', 'bx_ext_part__contact_info_output',  20 );
add_action( 'bx_ext_part__contact_info', 'bx_ext_part__contact_info_end',    999 );

add_action( 'bx_ext_part__contact_info_output', 'bx_ext_part__contact_info_output_title', 10 );
add_action( 'bx_ext_part__contact_info_output', 'bx_ext_part__contact_info_output_desc',  20 );
add_action( 'bx_ext_part__contact_info_output', 'bx_ext_part__contact_info_output_btns',  30 );

add_action( 'bx_ext_part__contact_form', 'bx_ext_part__contact_form_start',   10 );
add_action( 'bx_ext_part__contact_form', 'bx_ext_part__contact_form_output',  20 );
add_action( 'bx_ext_part__contact_form', 'bx_ext_part__contact_form_end',    999 );
