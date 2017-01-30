<?php
/* ------------------------------------------------------------------------- *
 *  Team Item
/* ------------------------------------------------------------------------- */

/**
 * All the options in an array, needed to create the widget output
 *
 * @since 1.0.4.3
 *
 * @var array $widget_options All the options needed to display this widget
 *     @param key $widget_options['wid']          Widget ID
 *     @param key $widget_options['title']        Widget title
 *     @param key $widget_options['title_output'] Widget title with `after_title` & `before_title`
 *     @param key $widget_options['description']  Member description, a paragraph
 *     @param key $widget_options['position']     Member position in company
 *     @param key $widget_options['avatar']       Member avatar image URL
 *     @param key $widget_options['avatar_url']   Member URL on avatar
 *     @param key $widget_options['allowed_html'] Allowed html tags for description
 *     @param key $widget_options['social_links'] An array containg social links for this member
 */
$widget_options = array(
	'wid'          => $wid,
	'title'        => $title,
	'title_output' => $title_output,
	'description'  => $description,
	'position'     => $position,
	'avatar'       => $avatar,
	'avatar_url'   => $avatar_url,
	'avatar_trg'   => $avatar_trg,
	'allowed_html' => $allowed_html,
	'social_links' => $social_links
);

/**
 * @since 1.0.4.3
 *
 * Hooked:
 * bx_ext_item__team_thumbnail   - 10
 * bx_ext_item__team_title       - 20
 * bx_ext_item__team_position    - 30
 * bx_ext_item__team_description - 40
 * bx_ext_item__team_social      - 50
 *
 * @see ../inc/partials/items/team-item.php
 */
do_action( 'bx_ext_item__team', $widget_options );
