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


/**
 * Blog Section
 */
add_action( 'bx_ext_part__blog', 'bx_ext_part__blog_wrap_start', 10 );
add_action( 'bx_ext_part__blog', 'bx_ext_part__blog_overlay',    20 );
add_action( 'bx_ext_part__blog', 'bx_ext_part__blog_container',  30 );
add_action( 'bx_ext_part__blog', 'bx_ext_part__blog_wrap_end',  999 );

add_action( 'bx_ext_part__blog_container', 'bx_ext_part__blog_container_start', 10 );
add_action( 'bx_ext_part__blog_container', 'bx_ext_part__blog_items',           20 );
add_action( 'bx_ext_part__blog_container', 'bx_ext_part__blog_container_end',  999 );

add_action( 'bx_ext_part__blog_items', 'bx_ext_part__blog_items_header', 10 );
add_action( 'bx_ext_part__blog_items', 'bx_ext_part__blog_items_posts',  20 );

add_action( 'bx_ext_part__blog_items_header', 'bx_ext_part__blog_items_header_start',          10 );
add_action( 'bx_ext_part__blog_items_header', 'bx_ext_part__blog_items_header_title',          20 );
add_action( 'bx_ext_part__blog_items_header', 'bx_ext_part__blog_items_header_description',    30 );
add_action( 'bx_ext_part__blog_items_header', 'bx_ext_part__blog_items_header_end',           999 );

add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_start',  10 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_sizers', 20 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_loop',   30 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_end',   999 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_js',   1010 );

add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_start',   10 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_thumb',   20 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_title',   30 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_excerpt', 40 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_meta',    50 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_end',    999 );
