<?php
/* ------------------------------------------------------------------------- *
 *  Team Item
/* ------------------------------------------------------------------------- */

/**
 * @since 1.0.4.3
 * @param array $widget_options All the options needed to display this widget
 *     @param key $widget_options['wid']          Widget ID
 *     @param key $widget_options['title']        Widget title
 *     @param key $widget_options['title_output'] Widget title with `after_title` & `before_title`
 *     @param key $widget_options['description']  Member description, a paragraph
 *     @param key $widget_options['position']     Member position in company
 *     @param key $widget_options['avatar']       Member avatar URL
 *     @param key $widget_options['allowed_html'] Allowed html tags for description
 *     @param key $widget_options['social_links'] An array containg social links for this member
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
