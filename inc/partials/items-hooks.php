<?php
/**
 * Team items
 */
add_action( 'bx_ext_item__team', 'bx_ext_item__team_thumbnail',    10, 1 );
add_action( 'bx_ext_item__team', 'bx_ext_item__team_title',        20, 1 );
add_action( 'bx_ext_item__team', 'bx_ext_item__team_position',     30, 1 );
add_action( 'bx_ext_item__team', 'bx_ext_item__team_description',  40, 1 );
add_action( 'bx_ext_item__team', 'bx_ext_item__team_social',       50, 1 );

/**
 * Clients items
 */
add_action( 'bx_ext_item__clients', 'bx_ext_item__client', 10, 1 );

/**
 * About items
 */
add_action( 'bx_ext_item__about', 'bx_ext_item__about_title',   10, 1 );
add_action( 'bx_ext_item__about', 'bx_ext_item__about_excerpt', 20, 1 );

/**
 * FAQ items
 */
add_action( 'bx_ext_item__faq', 'bx_ext_item__faq_title',   10, 1 );
add_action( 'bx_ext_item__faq', 'bx_ext_item__faq_excerpt', 20, 1 );

/**
 * Testimonial items
 */
add_action( 'bx_ext_item__testimonials', 'bx_ext_item__testimonials_avatar',   10, 1 );
add_action( 'bx_ext_item__testimonials', 'bx_ext_item__testimonials_contents', 20, 1 );

add_action( 'bx_ext_item__testimonials_contents', 'bx_ext_item__testimonials_contents_start',        10, 1 );
add_action( 'bx_ext_item__testimonials_contents', 'bx_ext_item__testimonials_contents_title',        20, 1 );
add_action( 'bx_ext_item__testimonials_contents', 'bx_ext_item__testimonials_contents_testimonial',  30, 1 );
add_action( 'bx_ext_item__testimonials_contents', 'bx_ext_item__testimonials_contents_button',       40, 1 );
add_action( 'bx_ext_item__testimonials_contents', 'bx_ext_item__testimonials_contents_end',         999, 1 );
