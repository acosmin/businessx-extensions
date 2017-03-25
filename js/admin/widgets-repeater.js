(function( wp, $, undefined ){

	//if ( ! wp || ! wp.customize ) { return; }

	/* Namespace */
	var api = wp.customize;

	api.BxExtWidget = api.BxExtWidget || {};

	/**
	 * Repeater Backbone model
	 *
	 * @since       1.0.0
	 * @constructor
	 * @augments    Backbone.Model
	 */
	api.BxExtWidget.Repeater = Backbone.Model.extend({
		defaults : {
			beforeEl : false
		},
		/**
		 * Initialize model
		 *
		 * @todo Make the widget name and list part dynamic
		 * @return {Function}
		 */
		initialize : function() {
			var idNumber = this.getIDnumber( this.get( 'widget' ) ),
			    random = this.random();

			this.set( 'key', random );
			this.set( 'name', 'widget-bx-item-pricing[' + idNumber + '][list]');
			this.set( 'wid', 'widget-bx-item-pricing-' + idNumber + '-list' );
			this.set( 'id', random );
		},

		/**
		 * Get widget ID number
		 *
		 * @param  {Object}  widget The current widget object
		 * @return {Integer}        ID Number
		 */
		getIDnumber : function( widget ) {
			return widget.attr('id').match( /[^-]*$/g )[ 0 ];
		},

		/**
		 * Random id for repeater element
		 *
		 * @return {String} A random 6 letters/digits id, starting with a letter.
		 */
		random : function() {
			var retId,
			    alphabet     = "abcdefghijklmnopqrstuvwxyz";
			    randomLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
			    uniqidSeed   = Math.floor(Math.random() * 0x75bcd15);

			var formatSeed = function(seed, reqWidth) {
				seed = parseInt(seed, 10).toString(16);
				if (reqWidth < seed.length) {
					return seed.slice(seed.length - reqWidth);
				}
				if (reqWidth > seed.length) {
					return Array(1 + (reqWidth - seed.length))
						.join('0') + seed;
				}
				return seed;
			};

			uniqidSeed++;

			retId = formatSeed(parseInt(new Date().getTime() / 1000, 10), 3);
			retId += formatSeed(uniqidSeed, 2);
			retId = randomLetter + retId;

			return retId;
		}
	});

	/**
	 * Repeater Backbone view
	 *
	 * @since       1.0.0
	 * @constructor
	 * @augments    Backbone.View
	 */
	api.BxExtWidget.RepeaterView = Backbone.View.extend({

		/**
		 * Setting up this view with our own class name and wrapper tag
		 *
		 * @todo change class name
		 * @type {String}
		 */
		tagName   : 'li',
		className : 'bx-pricing-repeatable-item bx-bs bx-clearfix',

		/**
		 * Events for this view
		 *
		 * @type {Object}
		 */
		events : {},

		/**
		 * Initialize Backbone view
		 *
		 * @return {Function}
		 */
		initialize : function() {
			var widget = this.model.get( 'widget' );

			this.displayElement( widget );
			this.actualize( widget );
		},

		/**
		 * Template for this view
		 *
		 * @return {Function}
		 */
		template : wp.template( 'acbuilder-repeater' ),

		/**
		 * Render template for this view
		 *
		 * @return {Function}
		 */
		render : function() {
			var tmpl = this.template( this.model.toJSON() );
			this.$el.html( tmpl );

			return this;
		},

		/**
		 * Display the created element
		 *
		 * @todo   change class name
		 * @param  {Object} widget Widget selector
		 * @return {HTML}          Rendere element HTML
		 */
		displayElement : function( widget ) {
			if( this.model.get( 'beforeEl' ) ) {
				$( widget.context ).parents('.bx-pricing-repeatable-item').after( this.render().el );
			} else {
				widget.find( '.bx-pricing-repeatable-items' ).append( this.render().el );
			}
		},

		/**
		 * Actualize the widget based on events
		 * @param  {Object} widget Widget selector
		 * @return {Mixed}
		 */
		actualize : function( widget ) {
			var changeEvents = [
				'acbuilder-element-added',
			];

			_.each( changeEvents, function( changeEvent ) {
				this.listenTo( this, changeEvent, function( e ) {
					widget.find( '.acbuilder-change' ).trigger( 'change' );
				});
			}, this );
		}
	});

	/**
	 * Add a new repeater element
	 *
	 * @todo the values part
	 * @since 1.0.0
	 */
	$( document ).on( 'click', '.acbuilder-repeater-add', function( e ) {
		var widgetObj = $( this ).parents( '.widget' ),
		    theModel, theView, values;

		values = {
			widget : widgetObj,
			value  : '',
		};

		// Add the new element
		theModel = new api.BxExtWidget.Repeater( values );
		theView  = new api.BxExtWidget.RepeaterView({ model : theModel });

		// Trigger event when an element is being added
		theView.trigger( 'acbuilder-element-added', this );

		e.preventDefault();
	});

	/**
	 * Remove a repeater element
	 *
	 * @todo change class names
	 * @since v1.0.0
	 */
	$( document ).on( 'click', '.acbuilder-repeater-remove', function ( e ) {
		var widgetObj = $( this ).parents( '.widget' );

		// Remove the element
		$( this ).parents('li.bx-pricing-repeatable-item').remove();

		// Trigger change
		widgetObj.find( '.acbuilder-change' ).trigger( 'change' );

		e.preventDefault();
	});

	/**
	 * Do on widget-added event
	 *
	 * @todo change class names
	 * @since 1.0.0
	 */
	$( document ).on( 'widget-added', function( e, obj ) {

		/**
		 * Initialize jQuery UI Sortable module on our current elements
		 */
		$( obj.get() ).find( '.bx-pricing-repeatable-items' ).sortable({

			// Sortable options
			helper : 'clone',
			items  : '> li.bx-pricing-repeatable-item',
			cursor : 'move',
			axis   : 'y',

			/**
			 * Trigger change if the sortable elment is in the right place
			 * at the end of sortable process. Also, make the "Apply" button
			 * trigger if it appears.
			 *
			 * @param  {Event}    event This sortable event, on stop
			 * @param  {Object}   ui    Current UI sortable object
			 * @return {Function}
			 */
			stop : function( event, ui ) {
				var widgetObj = ui.item.parents('.widget'),
				    saveBtn   = widgetObj.find('.widget-control-save');

				// Trigger change
				widgetObj.find( '.acbuilder-change' ).trigger( 'change' );

				// Make "Apply" button disappear
				if( typeof saveBtn !== 'undefined' ) {
					saveBtn.click();
				}
			}

		});
	});

})( window.wp, jQuery );
