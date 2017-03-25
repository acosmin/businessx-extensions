/**
 * Customizer and Widgets page JS
 */

var $ = window.jQuery;

window.BxExtWidgets = {
	/**
	 * Initiazlie
	 *
	 * @since 1.0.4.3
	 * @return {Void}
	 */
	init : function() {
		var self = this;

		self.hideSidebars();
		self.clickEvents();
	},

	/**
	 * Hide our section widgets and sidebars if we are on
	 * the Widgets page in the Administrator panel
	 *
	 * @return {Void}
	 */
	hideSidebars : function() {
		// Hide sidebars on the right page
		if( ! $( 'body' ).hasClass( 'widgets-php' ) ) return;

		// Hide the section sidebars
		$( 'div[id*=section-]' ).each( function( i, s ) {
			$( s ).parent( '.widgets-holder-wrap' ).hide();
		});

		/**
		 * Show the right sidebars to select from when a widget
		 * title is clicked
		 */
		$( '#available-widgets .widget .widget-top' ).on( 'click', function( e ) {
			var list = $( '.widgets-chooser > ul > li' ),
			    current = $( this ).parent( '.widget' ).find( list );

			current.each( function( i, element ) {
				var elm = $( element );
				if( elm.text().indexOf( 'Section' ) >= 0 ) { elm.remove(); }
			});

			var newlist = list;
			newlist.first().addClass( 'widgets-chooser-selected' );
		});

		// Remove our section widgets from the available widgets list.
		$( '#available-widgets .widget' ).each( function( i, w ) {
			var widget = $( w );
			    thisID = widget.attr( 'id' );

			if( thisID.indexOf( 'bx-item' ) >= 0 ) widget.remove();
		});
	},

	/**
	 * Tabs toggle
	 *
	 * @see    clickEvents()
	 * @param  {Object} selector Currently clicked item
	 * @return {Void}
	 */
	tabsInit : function( selector ) {
		var sel        = $( selector ),
		    widgetID   = sel.parents( '.widget' ).attr( 'id' ),
		    tabWrap    = sel.parents( 'div.bx-widget-tabs' ),
		    active     = tabWrap.find( '.bx-wt-active-link' ).length,
		    notActive  = 'bx-tab-not-active',
		    activeTab  = 'bx-wt-active-tab',
		    activeLink = 'bx-wt-active-link',
		    contents   = 'div.bx-wt-tab-contents',
		    toggle     = 'a.bx-wt-tab-toggle',
		    next       = 'div';


		tabWrap.find( toggle ).addClass( notActive );
		tabWrap.find( contents ).addClass( notActive );

		sel.removeClass( notActive );
		sel.next( next ).removeClass( notActive );

		if( active >= 1 ) {
			var notActiveClass = '.' + notActive;
			tabWrap.find( toggle + notActiveClass ).removeClass( activeLink );
			tabWrap.find( contents + notActiveClass ).removeClass( activeTab );
		}

		sel.toggleClass( activeLink );
		sel.next( next ).toggleClass( activeTab );
	},

	mediaUpload : function( selector, remove = false ) {
		var sel       = $( selector ).closest( 'div' ),
		    upload    = wp.media({ multiple: false }),
		    img       = sel.find('.bx-iu-image'),
		    imgURL    = sel.find('.bx-iu-image-url'),
		    imgRemove = sel.find('.bx-iu-image-remove'),
		    imgUpload = sel.find('.bx-iu-image-upload');

		if( remove === false ) {
			upload.on( 'select', function( ev ) {
				var attachment = upload.state().get( 'selection' ).first(),
				    sizes      = attachment.get( 'sizes' ),
				    thumbnail  = 'post-thumbnail',
				    size, full_size;

				if ( sizes ) {
					size      = sizes[ thumbnail ] || sizes.medium;
					full_size = sizes[ thumbnail ] || sizes.full;
				}

				size      = size || attachment.toJSON();
				full_size = full_size || attachment.toJSON();

				img.attr( 'src', size.url ).css( 'display', 'block' );
				imgURL.val( full_size.url ).trigger( 'change' );
				imgUpload.css( 'display', 'none' );
				imgRemove.css( 'display', 'inline-block' );
			})
			.open();
		} else {
			img.removeAttr( 'src' ).css( 'display', 'none' );
			imgURL.val( '' ).trigger( 'change' );
			imgRemove.css( 'display', 'none' );
			imgUpload.css( 'display', 'inline-block' );
		}
	},

	/**
	 * What to do when something is clicked :)
	 *
	 * @return {Void}
	 */
	clickEvents : function() {
		var self = this;

		// Tabs toggle and init
		$( document ).on( 'click', 'a.bx-wt-tab-toggle', function( e ) {
			self.tabsInit( this );
			e.preventDefault();
		});

		// Upload media
		$( document ).on( 'click', '.bx-iu-image-upload', function( e ) {
			e.preventDefault();
			self.mediaUpload( this );
		});

		// Remove media
		$( document ).on( 'click', '.bx-iu-image-remove', function( e ) {
			e.preventDefault();
			self.mediaUpload( this, true );
		});
	},
}

$( document ).ready( function ( $ ) {
	var bxextwidgets = window.BxExtWidgets;

	/**
	 * Initialise BxExtWidgets
	 */
	bxextwidgets.init();
});

(function( $ ) {
	$(document).ready(function () {

		// Select type
		$(document).on('change', '.bx-select-type', function(event) {
			event.preventDefault();

			var bx_widget 		= $(this).parents('.widget');
			var bx_select_class	= $(this).data('bx-select-class');
			var bx_select 		= bx_widget.find('[class*='+bx_select_class+']');
			var bx_elements 	= $.makeArray( bx_select );
			var bx_selected 	= $(this).val();

			$.each(bx_elements, function( index, value ) {
				if( value.className == bx_selected ) {
					bx_select.hide();
					bx_widget.find('.' + bx_selected ).show();
				}
			});
		});

		$(document).on('click', 'div.widget[id*=bx-item] .widget-title, div.widget[id*=bx-item] .widget-action', function (event) {
			bx_widgetInit($(this).parents('.widget[id*=bx-item]'));
			event.preventDefault();
        });

		// If a widget is added do this
		$(document).on( 'widget-added', function(event, bx_widgetID) {
			if ( bx_widgetID.is('[id*=bx-item]' )) {
                bx_widgetInit(bx_widgetID);
            }
			event.preventDefault();
		});

		// If a widget is updated do this
		$(document).on('widget-updated', function(event, bx_widgetID) {
            if (bx_widgetID.is('[id*=bx-item]')) {
                bx_widgetInit( bx_widgetID );
            }
			event.preventDefault();
        });

		// Initialise widget function
		function bx_widgetInit( bx_widgetID ) {
			var thisWidgetID = bx_widgetID;
			var fieldCurrent = thisWidgetID.find( 'input.bx-is-autocomplete' );

			// Color Picker
			bx_widgetID.find('.bx-widget-color-piker').wpColorPicker({
				/*change: _.throttle(function() {
					if( $('body').hasClass('wp-customizer') ) { $(this).trigger( 'change' ); }
				}, 2000),*/
				change: _.throttle(function() {
					if( $('body').hasClass('wp-customizer') ) { $(this).trigger( 'change' ); }
				}, 200),
				palettes: false
			});

			// Icons Autocomplet
			fieldCurrent.autocomplete({
      			source: businessx_ext_widgets_customizer['bx_icons_array'],
				select: function( event, ui ) {
					var bx_icon = $(this).parent().find('.bx-is-autocomplete-icon i')
					bx_icon.removeAttr('class').addClass('fa ' +  ui.item.value);
					$(this).trigger('change');
				}
    		});
		}


	});
})( jQuery );
