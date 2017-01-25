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
