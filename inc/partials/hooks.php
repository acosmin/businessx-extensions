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

add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_start',    10 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_sizers',   20 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_loop',     30 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_end',     999 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_js',     1010 );
add_action( 'bx_ext_part__blog_items_posts', 'bx_ext_part__blog_items_posts_action', 1020 );

add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_start',   10 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_thumb',   20 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_title',   30 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_excerpt', 40 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_meta',    50 );
add_action( 'bx_ext_part__blog_items_posts_loop_post', 'bx_ext_part__blog_items_posts_loop_post_end',    999 );


/**
 * Team Section
 */
add_action( 'bx_ext_part__team', 'bx_ext_part__team_wrap_start', 10 );
add_action( 'bx_ext_part__team', 'bx_ext_part__team_overlay',    20 );
add_action( 'bx_ext_part__team', 'bx_ext_part__team_container',  30 );
add_action( 'bx_ext_part__team', 'bx_ext_part__team_wrap_end',  999 );

add_action( 'bx_ext_part__team_container', 'bx_ext_part__team_container_start', 10 );
add_action( 'bx_ext_part__team_container', 'bx_ext_part__team_items',           20 );
add_action( 'bx_ext_part__team_container', 'bx_ext_part__team_container_end',  999 );

add_action( 'bx_ext_part__team_items', 'bx_ext_part__team_items_header',  10 );
add_action( 'bx_ext_part__team_items', 'bx_ext_part__team_items_members', 20 );

add_action( 'bx_ext_part__team_items_header', 'bx_ext_part__team_items_header_start',          10 );
add_action( 'bx_ext_part__team_items_header', 'bx_ext_part__team_items_header_title',          20 );
add_action( 'bx_ext_part__team_items_header', 'bx_ext_part__team_items_header_description',    30 );
add_action( 'bx_ext_part__team_items_header', 'bx_ext_part__team_items_header_end',           999 );

add_action( 'bx_ext_part__team_items_members', 'bx_ext_part__team_items_members_start',     10 );
add_action( 'bx_ext_part__team_items_members', 'bx_ext_part__team_items_members_display',   20 );
add_action( 'bx_ext_part__team_items_members', 'bx_ext_part__team_items_members_end',      999 );


/**
 * Cliens Section
 */
add_action( 'bx_ext_part__clients', 'bx_ext_part__clients_wrap_start', 10 );
add_action( 'bx_ext_part__clients', 'bx_ext_part__clients_overlay',    20 );
add_action( 'bx_ext_part__clients', 'bx_ext_part__clients_container',  30 );
add_action( 'bx_ext_part__clients', 'bx_ext_part__clients_js',         40 );
add_action( 'bx_ext_part__clients', 'bx_ext_part__clients_wrap_end',  999 );

add_action( 'bx_ext_part__clients_container', 'bx_ext_part__clients_container_start', 10 );
add_action( 'bx_ext_part__clients_container', 'bx_ext_part__clients_items',           20 );
add_action( 'bx_ext_part__clients_container', 'bx_ext_part__clients_container_end',  999 );

add_action( 'bx_ext_part__clients_items', 'bx_ext_part__clients_items_header',  10 );
add_action( 'bx_ext_part__clients_items', 'bx_ext_part__clients_items_helper',  20 );
add_action( 'bx_ext_part__clients_items', 'bx_ext_part__clients_items_display', 30 );

add_action( 'bx_ext_part__clients_items_header', 'bx_ext_part__clients_items_header_start',          10 );
add_action( 'bx_ext_part__clients_items_header', 'bx_ext_part__clients_items_header_title',          20 );
add_action( 'bx_ext_part__clients_items_header', 'bx_ext_part__clients_items_header_description',    30 );
add_action( 'bx_ext_part__clients_items_header', 'bx_ext_part__clients_items_header_end',           999 );

add_action( 'bx_ext_part__clients_items_display', 'bx_ext_part__clients_items_display_start',     10 );
add_action( 'bx_ext_part__clients_items_display', 'bx_ext_part__clients_items_display_carousel',  20 );
add_action( 'bx_ext_part__clients_items_display', 'bx_ext_part__clients_items_display_arrows',    30 );
add_action( 'bx_ext_part__clients_items_display', 'bx_ext_part__clients_items_display_end',      999 );


/**
 * Portfolio Section
 */
add_action( 'bx_ext_part__portfolio', 'bx_ext_part__portfolio_wrap_start', 10 );
add_action( 'bx_ext_part__portfolio', 'bx_ext_part__portfolio_overlay',    20 );
add_action( 'bx_ext_part__portfolio', 'bx_ext_part__portfolio_container',  30 );
add_action( 'bx_ext_part__portfolio', 'bx_ext_part__portfolio_wrap_end',  999 );

add_action( 'bx_ext_part__portfolio_container', 'bx_ext_part__portfolio_container_start', 10 );
add_action( 'bx_ext_part__portfolio_container', 'bx_ext_part__portfolio_items',           20 );
add_action( 'bx_ext_part__portfolio_container', 'bx_ext_part__portfolio_container_end',  999 );

add_action( 'bx_ext_part__portfolio_items', 'bx_ext_part__portfolio_items_header',   10 );
add_action( 'bx_ext_part__portfolio_items', 'bx_ext_part__portfolio_items_projects', 20 );
add_action( 'bx_ext_part__portfolio_items', 'bx_ext_part__portfolio_items_js',       30 );

add_action( 'bx_ext_part__portfolio_items_header', 'bx_ext_part__portfolio_items_header_start',          10 );
add_action( 'bx_ext_part__portfolio_items_header', 'bx_ext_part__portfolio_items_header_title',          20 );
add_action( 'bx_ext_part__portfolio_items_header', 'bx_ext_part__portfolio_items_header_description',    30 );
add_action( 'bx_ext_part__portfolio_items_header', 'bx_ext_part__portfolio_items_header_end',           999 );

add_action( 'bx_ext_part__portfolio_items_projects', 'bx_ext_part__portfolio_items_projects_start',     10 );
add_action( 'bx_ext_part__portfolio_items_projects', 'bx_ext_part__portfolio_items_projects_sizers',    20 );
add_action( 'bx_ext_part__portfolio_items_projects', 'bx_ext_part__portfolio_items_projects_display',   30 );
add_action( 'bx_ext_part__portfolio_items_projects', 'bx_ext_part__portfolio_items_projects_end',      999 );
