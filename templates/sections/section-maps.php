<?php
/* ------------------------------------------------------------------------- *
 *  Maps Section Wrapper
/* ------------------------------------------------------------------------- */

	// Vars
	$maps_sec__hide          = get_theme_mod( 'maps_section_hide', 1 ) == 0 ? true : false;

?>
<?php if( $maps_sec__hide ) : ?>
<?php do_action( 'businessx_maps_sec__before_wrapper' ); ?>
<section id="section-contact" class="sec-maps">
	<div class="sec-maps-overlay">
		<div class="smo-center">
			<h2 class="smo-title"><a href="#" class="smo-open-map">Find us on the map</a></h2>
			<a href="#" class="smo-icon smo-open-map"><?php businessx_icon( 'map' ); ?></a>
		</div>
	</div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45193.04410541707!2d25.97487315579!3d44.932175799049126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b249a43bf5be3f%3A0x55c12fa0a13e08ce!2sPloie%C8%99ti+Vest!5e0!3m2!1sen!2sro!4v1485270083315" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
<?php
	do_action( 'businessx_maps_sec__after_wrapper' );
	endif; // END Contact Section
