var $   = window.jQuery;
    api = wp.customize || {};

window.BxExtensions = {

	/**
	 * Setting up some variables
	 *
	 * @type {Object}
	 */
	v : {
		panel    : 'businessx_panel__sections',
		admin    : bxext_widgets_customizer.admin_url,
		icons    : bxext_widgets_customizer.icons,
		sections : bxext_widgets_customizer.sections,
		sections_position : bxext_widgets_customizer.sections_position,
		msgs     : bxext_widgets_customizer.msgs,
		actions  : $( '#customize-header-actions' ),
	},

	/**
	 * Initiazlie BxExtensions
	 *
	 * @return {Mixed}
	 */
	init : function() {
		var self = this;

		self.initFirstViewModal()
		self.initSortableSections();
		self.backup();
	},

	/**
	 * Make the front page sections sortable in our panel
	 *
	 * @return {jQueryUI.Sortable}
	 */
	initSortableSections : function() {
		var self = this,
		    list = $( self.panelSections() );

		list.sortable({
			helper : 'clone',
			items  : '> li.control-section:not(.cannot-expand)',
			cancel : 'li.ui-sortable-handle.open',
			delay  : 150,
			create : function( event, ui ) {
				/**
				 * When the sortable list is created make sure we have the right positions.
				 * Also, in case we add a new section via plugin.
				 */
				var sections = self.sectionsArray(),
				    array1   = sections,
				    array2   = self.v.sections_position,
				    is_same  = array1.length == array2.length && array1.every( function( element, index ) {
						return element === array2[ index ];
					});

				if( ! is_same ) {
					self.setSectionsPosition( sections );
				}
			},
			update : function( event, ui ) {
				// If a sections is moved, save position in a theme mod
				list.find( '.bx_drag_and_spinner' ).show();
				self.setSectionsPosition( self.sectionsArray() );

				$( '.wp-full-overlay-sidebar-content' ).scrollTop( 0 );
			},
		});
	},

	/**
	 * Panel handle DOM element
	 *
	 * @return {DOMnode}
	 */
	panelHandle : function() {
		return api.panel( this.v.panel ).container.get( 0 );
	},

	/**
	 * Return all the sections in our Front Page panel
	 *
	 * @return {DOMnode}
	 */
	panelSections : function() {
		return api.panel( this.v.panel ).contentContainer;
	},

	/**
	 * Convert our sections name to a more friendly format
	 * and add them into an array
	 *
	 * @return {Array} [description]
	 */
	sectionsArray : function() {
		var self  = this,
		    list  = self.panelSections();
		    items = $( list ).sortable( 'toArray' );

		for( var i = 0; i < items.length; i++ ) {
			items[ i ] = items[ i ].replace( 'accordion-section-', '' );
		}
		return items;
	},

	/**
	 * When a section is sorted and ajax is done refresh
	 * the previewer and remove the spinner preloader
	 *
	 * @return {Void}
	 */
	ifAjaxIsDone : function() {
		var self = this,
		    list = $( self.panelSections() );

		$.each( self.sectionsArray(), function( key, value ) {
			api.section( value ).priority( key );
		});

		list.find( '.bx_drag_and_spinner' ).hide();

		api.previewer.refresh();
	},

	/**
	 * Sets the sections position so we can remember them. Adds them
	 * into a theme mode via ajax
	 *
	 * @param  {Array} sections An array of sections with their position updated
	 * @return {Void}
	 */
	setSectionsPosition : function( sections ) {
		var self = this;

		$.ajax({
			url      : ajaxurl,
			type     : 'post',
			dataType : 'json',
			data     : {
				action: 'businessx_extensions_sections_position',
				// @todo
				businessx_extensions_sections_nonce: businessx_customizer_js_data.businessx_extensions_sections_nonce,
				items: sections
			}
		})
		.done( function( data ) {
			self.ifAjaxIsDone();
		});
	},

	/**
	 * Backup sections and widgets position
	 * @return {Mixed}
	 */
	backup : function() {
		var self    = this,
		    actions = self.v.actions,
		    msgs    = self.v.msgs,
		    _doc    = $( document ),
		    save    = actions.find( '.save' );

		// Add backup button
		actions.prepend(
			'<a href="#" class="customize-controls-close bx-backup-sections"><span class="bx-backup-pulse"></span><span class="bx-backup-bubble">' + msgs.bk_bubble + '</span></a>'
		);

		// When the backup button is clicked do this action via ajax
		_doc.on( 'click', '.bx-backup-sections', function( e ) {
			e.preventDefault();

			if( save.is( ':disabled' ) === true ) {
				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'businessx_extensions_sections_bk',
						// @todo
						businessx_extensions_sections_bk_nonce: businessx_customizer_js_data.businessx_extensions_sections_bk_nonce,
					}
				})
				.done( function( data ) {
					$( '.bx-backup-pulse' ).hide();
					alert( msgs.bk_success );
					_doc.trigger( 'bx-backup-success' );
				});
			} else {
				alert( msgs.bk_fail );
			}
		});

		// When widgets are added or updated display pulse
		_doc.on( 'widget-added widget-updated', function( e ) {
			$( '.bx-backup-pulse' ).show();
		});

		// Restore backup when a button is clicked
		_doc.on( 'click', '.bx-restore-sections', function( e ) {
			e.preventDefault();

			if( save.is(':disabled') === true ) {
				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'businessx_extensions_sections_rt',
						// @todo
						businessx_extensions_sections_rt_nonce: businessx_customizer_js_data.businessx_extensions_sections_rt_nonce,
					}
				})
				.done( function( data ) {
					alert( msgs.bk_restore_success );
					location.reload(true);
				});
			} else {
				alert( msgs.bk_fail );
			}
		});
	},

	/**
	 * Setup for Front Page with cusom template
	 * @return {Void}
	 */
	initFirstViewModal : function() {
		// Check if the modal window is ready or exists
		if( $( '#businessx-frontpage-modal' ).length > 0 ) {
			window.tb_show( bxext_frontpage_vars.modal_title, '#TB_inline?width=570&height=330&inlineId=businessx-frontpage-modal' );
			$( '#TB_window' ).css( 'z-index', '500002').addClass( 'bxext-stp-modal-window' );
			$( '#TB_overlay' ).css( 'z-index', '500001' ).addClass( 'bxext-stp-modal-overlay' );
			$( '#TB_overlay.bxext-stp-modal-overlay' ).off( 'click' );
		}

		// Insert front page on user action
		$( '#bxext-insert-frontpage' ).on( 'click', function( event ) {
			$.ajax({
				url      : ajaxurl,
				type     : 'post',
				dataType : 'json',
				data     : {
					action: 'bxext_create_frontpage',
					// @todo
					bxext_create_frontpage: businessx_customizer_js_data.bxext_create_frontpage,
				}
			})
			.done( function( data ) {
				window.tb_remove();
				location.reload( true );
			});
		});

		// Use `.bxext-stp-modal-window #TB_closeWindowButton` to dismiss on X click
		$( '#bxext-dismiss-frontpage' ).on( 'click', function( event ) {
			$.ajax({
				url      : ajaxurl,
				type     : 'post',
				dataType : 'json',
				data     : {
					action: 'bxext_dismiss_create_frontpage',
					// @todo
					bxext_create_frontpage: businessx_customizer_js_data.bxext_dismiss_create_frontpage,
				}
			})
			.done( function( data ) {
				window.tb_remove();
				location.reload( true );
			});
		});
	}

}

$( document ).ready( function( $ ) {
	var bxextensions = window.BxExtensions;

	/**
	 * Init Businessx Pro Customizer Class
	 */
	bxextensions.init();
});

/* Customizer JS */
jQuery( document ).ready( function( $ ) {

	/* Sections specific JS */
	var bx_allsections = businessx_ext_widgets_customizer[ 'bx_sections' ];

	wp.customize.section.each( function ( section ) {
		$.each( bx_allsections, function( index, value ) {

			var currentCheck			= $('#sub-accordion-section-businessx_section__slider').length,
				currentSectionID	 	= ( currentCheck > 0 ) ?
				'#sub-accordion-section-businessx_section__' + value : '#accordion-section-businessx_section__' + value,
				currentSectionTab		= $( '#accordion-section-businessx_section__' + value ),
				currentSectionSlctID	= $( currentSectionID ),
				checkParallaxOption 	= currentSectionSlctID.find( '#customize-control-' + value + '_bg_parallax input:checkbox' ),
				checkHiddenOption 		= currentSectionSlctID.find( '#customize-control-' + value + '_section_hide input:checkbox' ),
				customizeCtrlBg			= 'li[id*="customize-control-' + value + '_bg"]',
				customizeCtrlColor		= 'li[id*="customize-control-' + value + '_color"]',
				customizeCtrlBgImg		= $( '#customize-control-' + value + '_bg_image' ),
				customizeCtrlBgPrx		= $( '#customize-control-' + value + '_bg_parallax_img' ),
				theActivaClass			= 'active',
				addNewSecWidget			= '#bx-section-add-some-' + value,
				addNewWidgetSlct		= $( addNewSecWidget ),
				hiddenSectionClass		= 'bx-hidden-section',
				sectionDescription		= ' .customize-section-description-container',
				bxSectionValue			= 'businessx_section__' + value,
				bxSectionSidebar		= 'sidebar-widgets-section-' + value,
				bxSectionsItems			= $( '#accordion-panel-businessx_panel__sections_items' ),

				goBackBtnsTempl			= '<li class="customize-control" style="display: list-item"><button type="button" class="button bx-add-items" id="bx-section-go-back-' + value + '"><span class="dashicons bx-edit"></span>' + businessx_ext_widgets_customizer[ 'bx_anw_btn_go_back' ] + '</button></li>';



			// Hide widgets for specific sidebars
			var widgetsSectionSide = ( currentCheck > 0 ) ?
			'#sub-accordion-section-sidebar-widgets-section-' + value + ' .add-new-widget' :
			'#accordion-section-sidebar-widgets-section-' + value + ' .add-new-widget';

			if( section.id == bxSectionSidebar ) { // Just in the selected sidebar

				var accordionSec = ( currentCheck > 0 ) ? '#sub-accordion-section-' : '#accordion-section-';

				// Go back action for widgets
				$(document).on('click', accordionSec + section.id + ' .customize-section-title .customize-section-back', function( event ) {
					var newCurrentPanel = section.panel().replace('_items','');

					if( wp.customize.panel( newCurrentPanel ).active() ) { // Check if the parent panel is active first
						wp.customize.section( bxSectionValue ).focus();
					} else {
						alert( businessx_ext_widgets_customizer[ 'bx_wrong_page' ] );
						if( currentCheck > 0 ){
							$('#sub-accordion-section-title_tagline').find('button.customize-section-back').click().click();
						} else {
							$('#accordion-section-title_tagline').find('button.customize-section-back').click().click();
						}
						event.preventDefault();
					}

					bxSectionsItems.removeClass( 'bx-display-important' ); // Review
					$( '#available-widgets-list' ).children().show();
					$( 'div[id*=widget-tpl-bx-item-' + value +'-]' ).hide().removeClass( 'bx-display-block' );
					$( '#available-widgets-filter' ).removeClass( 'bx-search-change' ).find( 'input' ).attr( 'disabled', false );
				});

				// Change button text
				$(document).on( 'click', currentSectionID + ' .bx-add-items', function( event ) {
					$( '.add-new-widget' ).attr( 'data-bx-anw-new-title', businessx_ext_widgets_customizer[ 'bx_anw_btn_' + value ] );
				});
			}

		});
	}); // END wp.customize.section.each

});
