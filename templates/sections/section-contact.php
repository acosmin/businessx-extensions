<?php
/* ------------------------------------------------------------------------- *
 *  Contact Section Wrapper
/* ------------------------------------------------------------------------- */

	// $features_sec__bg_overlay	= get_theme_mod( 'features_bg_overlay', false );
	$contact_sec__hide          = get_theme_mod( 'contact_section_hide', 1 ) == 0 ? true : false;
	$contact_sec__title         = get_theme_mod( 'contact_section_title', esc_html__( 'Contact Us', 'businessx-extensions' ) );
	$contact_sec__description   = get_theme_mod( 'contact_section_description', esc_html__( 'This is a description for the Contact section. You can set it up in the Customizer where you can also add items for it.', 'businessx-extensions' ) );
	$contact_sec__shortcode     = get_theme_mod( 'contact_section_shortcode', __( 'Your contact form shortcode appears here...', 'businessx-extensions' ) );
	$contact_sec__social        = get_theme_mod( 'contact_section_social', '' );
	// $features_sec_helpers		= get_theme_mod( 'disable_helpers', false );
?>
<?php if( $contact_sec__hide ) : ?>
<?php do_action( 'businessx_contact_sec__before_wrapper' ); ?>
<section id="section-contact" style="background:url(http://192.168.0.105/businessx-extensions/main/wp-content/plugins/businessx-extensions/images/contact-bg.jpg) repeat;" class="grid-wrap sec-contact"<?php // businessx_section_parallax( 'features_bg_parallax', 'features_bg_parallax_img' ); ?>>
	<?php do_action( 'businessx_contact_sec__inner_wrapper_top' ); ?>
	<?php // if( $features_sec__bg_overlay ) { echo '<div class="grid-overlay"></div>'; } ?>
	<div class="grid-container grid-1 clearfix">
    	<?php do_action( 'businessx_contact_sec__inner_container_top' ); ?>
        <div class="grid-items clearfix <?php businessx_anim_classes(); ?>">

			<div class="grid-col grid-2x-col sec-contact-box sec-contact-info">

				<?php if( $contact_sec__title != '' ) : ?>
				<h2 class="section-title hs-primary-medium hb-bottom-large <?php businessx_anim_classes(); ?>"><?php echo esc_html( $contact_sec__title ); ?></h2>
				<div class="divider"></div>
				<?php endif; ?>

				<?php if( $contact_sec__description != '' ) : ?>
				<div class="section-description fs-large <?php businessx_anim_classes(); ?>">
					<?php echo businessx_ext_escape_content_filtered( $contact_sec__description ); ?>
				</div>
				<?php endif; ?>

				<?php if( $contact_sec__social != '' ) : ?>
				<div class="sec-contact-social clearfix">
					<?php echo businessx_ext_escape_content_filtered( $contact_sec__social ); ?>
				</div>
				<?php endif; ?>
				
			</div>

			<div class="grid-col grid-2x-col sec-contact-box sec-contact-form">
				<?php echo businessx_ext_escape_content_filtered( $contact_sec__shortcode ); ?>
			</div>

		</div>
		<?php do_action( 'businessx_contact_sec__inner_container_bottom' ); ?>
    </div>
    <?php do_action( 'businessx_contact_sec__inner_wrapper_bottom' ); ?>
</section>
<?php
	do_action( 'businessx_contact_sec__after_wrapper' );
	endif; // END Contact Section
