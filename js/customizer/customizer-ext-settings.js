/* Customizer Settings Manager */
( function( api ) {

	var api = wp.customize;

	/**
	 * Drag & Drop section title
	 *
	 * @since 1.0.4.3
	 * @type {Object}
	 */
	api.sectionConstructor['dragdrop'] = api.Section.extend( {
		/**
		 * No events for this type of section
		 *
		 * @return {Void}
		 */
		attachEvents: function () {},

		/**
		 * Always make the section active.
		 *
		 * @return {Boolean}
		 */
		isContextuallyActive: function () {
			return true;
		}
	} );

	/**
	 * Tabs for color and background controls
	 *
	 * @since 1.0.4.3
	 * @type {Object}
	 */
	api.controlConstructor['section-tabs'] = api.Control.extend( {
		/**
		 * When the control is ready, initialize it
		 *
		 * @return {Void}
		 */
		ready: function() {
			var control = this;
			control.tabsInit();
		},

		/**
		 * Hide or show tab items on click
		 *
		 * @return {Void}
		 */
		tabsInit: function() {
			var control = this,
			    items = api.section( control.section() );
			    bg = '_bg_', color = '_color_'

			control.container.on( 'click', '.bx-cz-tab-colors', function( e ) {
				control.tabsItemsDisplay( items, [ color, bg ] );
			});

			control.container.on( 'click', '.bx-cz-tab-background', function( e ) {
				control.tabsItemsDisplay( items, [ bg, color ] );
			});
		},

		/**
		 * Show or hide tab items based on type
		 *
		 * @param  {Object} items All the controls associated with this section
		 * @param  {Array}  types Control types, only background and color for now
		 * @return {Void}
		 */
		tabsItemsDisplay: function( items, types ) {
			_.each( items.controls(), function( item, i ) {
				if( item.id.indexOf( types[ 0 ] ) >= 0 ) {
					item.activate({ duration: 0 });
				}
				if( item.id.indexOf( types[ 1 ] ) >= 0 ) {
					item.deactivate({ duration: 0 });
				}
			}, items );
		}
	} );

	/**
	 * Assign/create a custom section for Front Page sections
	 *
	 * @since 1.0.4.3
	 * @type {Object}
	 */
	api.sectionConstructor['front-page'] = api.Section.extend({
		/**
		 * When ready, initialize section
		 *
		 * @return {Void}
		 */
		ready: function() {
			var section = this;

			/**
			 * Show hide controls based on expanded/collapsed state
			 * of section
			 *
			 * @type {Event}
			 */
			section.expanded.bind( 'toggleSectionExpansion', function( e, c ) {
				if( e || c ) {
					_.each( section.controls(), function( control, i ) {
						if( control.id.indexOf( '_bg_' ) >= 0 || control.id.indexOf( '_color_' ) >= 0 ) {
							control.deactivate({ duration: 0 });
						}
					}, section );
				}
			});
		},
	});

	/**
	 * Live previewing colors and other settngs
	 *
	 * @since 1.0.0
	 * @type {Mixed}
	 */
	var bx_ext_styles_template = wp.template( 'businessx-ext-czr-settings-output' ),
	    bx_ext_simple_settings = _.map( bx_ext_customizer_settings, function( element, index ) { return index } ),
	    bx_ext_settings_keys   = bx_ext_simple_settings,
	    bx_ext_settings_values = bx_ext_simple_settings;

	// Update function
	function bx_ext_update_css() {
		var new_settings,
		    settings = _.object( bx_ext_settings_keys, bx_ext_customizer_settings );

		_.each( bx_ext_settings_values, function( new_value ) {
			settings[ new_value ] = api( new_value )();
		} );

		new_settings = bx_ext_styles_template( settings );

		api.previewer.send( 'bx-ext-update-settings', new_settings );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( bx_ext_settings_values, function( new_value ) {
		api( new_value, function( new_value ) {
			new_value.bind( bx_ext_update_css );
		} );
	} );

} )( wp.customize );
