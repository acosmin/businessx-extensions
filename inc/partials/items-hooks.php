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
