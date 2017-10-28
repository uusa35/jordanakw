var ajax_url = ced_vm_params.ajax_url;

jQuery(document).ready(function(){
	
	ced_vm_image_change_on_variation_popup();
	
	jQuery(".changemenow").on('click',function(){
		jQuery(".ced-vm-overlay").show();
		jQuery("#ced-vm-variation-container").hide();
		jQuery("#ced-vm-cart-loader").show();
		var proID = jQuery(this).attr('vID');
		var vID = jQuery(this).attr('variation_id');
		var $thisTR = jQuery(this).closest('td').parent();
		var extdQty = jQuery($thisTR).find('.input-text').val();
		var $cartItem = jQuery(this).parent().parent();
		var variationID = jQuery(this).attr('variation_id');	
		
		if(Math.floor(extdQty) != extdQty || !jQuery.isNumeric(extdQty))
			extdQty = 1;
		
		
		jQuery.ajax({
			  url: ajax_url,
			  cache: false,
			  type: "POST",
			  headers : { "cache-control": "no-cache" },
			  data: {
				'action': 'ced_vm_get_product_html',
				'product_id': proID,
				'variationID' : variationID,
			  },
			  success:function(response) {
				  jQuery("#ced-vm-cart-loader").hide();
				  var html = '<input type="hidden" id="ced_vm_prevproid" value="'+vID+'"><p class="close_icon"><span class="ced-vm-close-btn">&times;</span></p>';
				  
				  response = html+response;
				  
				  jQuery( '#ced-vm-variation-container' ).html(response);
				   jQuery( '.woocommerce-product-gallery' ).each( function() {
					 jQuery( this ).wc_product_gallery();
					
				  } );	
				  $form = jQuery( '#ced-vm-variation-container' ).find( '.variations_form' );
				  
				  if ($form) {
					  $form.wc_variation_form();
			      }
				  
				  //changing the add-to-cart button to update and hiding quantity field.
					var $cartDiv = jQuery('form.variations_form').find('div .woocommerce-variation-add-to-cart');
					jQuery($cartDiv).find('.input-text').hide();
					jQuery($cartDiv).find('.input-text').val(extdQty);
					$form.find( '.variations select' ).last().trigger('change');
					//$form.trigger( 'reset_data' );
					jQuery($cartDiv).find('.single_add_to_cart_button').html('Update');
					//jQuery($cartDiv).find('.single_add_to_cart_button').attr('disabled','disabled');
				  jQuery("#ced-vm-variation-container").show();
				  
			  }
		});
		
	});
	/*
	* This code is used from WooCommerce. We are using this js to implement 
	* single page flexslider
	*
	*/
	var ProductGallery = function( $target, args ) {
		this.$target = $target;
		
		this.$images = jQuery( '.woocommerce-product-gallery__image', $target );

		
		// No images? Abort.
		if ( 0 === this.$images.length ) {
			this.$target.css( 'opacity', 1 );
			return;
		}
		// Make this object available.
		$target.data( 'product_gallery', this );

		// Pick functionality to initialize...
		this.flexslider_enabled = jQuery.isFunction( jQuery.fn.flexslider ) && ced_vm_params.flexslider_enabled;
		
		// ...also taking args into account.
		if ( args ) {
			this.flexslider_enabled = false === args.flexslider_enabled ? false : this.flexslider_enabled;
			this.zoom_enabled       = false === args.zoom_enabled ? false : this.zoom_enabled;
			this.photoswipe_enabled = false === args.photoswipe_enabled ? false : this.photoswipe_enabled;
		}

		// Bind functions to this.
		this.initFlexslider       = this.initFlexslider.bind( this );
		this.onResetSlidePosition = this.onResetSlidePosition.bind( this );

		if ( this.flexslider_enabled ) {
			this.initFlexslider();
			$target.on( 'woocommerce_gallery_reset_slide_position', this.onResetSlidePosition );
		} else {
			this.$target.css( 'opacity', 1 );
		}

		
	};
	ProductGallery.prototype.initFlexslider = function() {
		var images  = this.$images,
			$target = this.$target;

		$target.flexslider( {
			selector:       '.woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image',
			animation:      ced_vm_params.flexslider.animation,
			smoothHeight:   ced_vm_params.flexslider.smoothHeight,
			directionNav:   ced_vm_params.flexslider.directionNav,
			controlNav:     ced_vm_params.flexslider.controlNav,
			slideshow:      ced_vm_params.flexslider.slideshow,
			animationSpeed: ced_vm_params.flexslider.animationSpeed,
			animationLoop:  ced_vm_params.flexslider.animationLoop, // Breaks photoswipe pagination if true.
			start: function() {
				$target.css( 'opacity', 1 );

				var largest_height = 0;

				images.each( function() {
					var height = jQuery( this ).height();

					if ( height > largest_height ) {
						largest_height = height;
					}
				} );

				images.each( function() {
					jQuery( this ).css( 'min-height', largest_height );
				} );
			}
		} );
	};
	/**
	 * Reset slide position to 0.
	 */
	ProductGallery.prototype.onResetSlidePosition = function() {
		this.$target.flexslider( 0 );
	};
	

	jQuery.fn.wc_product_gallery = function( args ) {
		new ProductGallery( this, args );
		return this;
	};
	
	jQuery(document).on('click','.reset_variations',function(){
		
		jQuery('form.variations_form').find('div .woocommerce-variation-add-to-cart .input-text').hide();
		jQuery(".ced-vm-stock-error").html('');
		jQuery(".ced-vm-stock-error").hide();
	});
	
	jQuery(document).on("click",".single_add_to_cart_button",function(e){
		
		e.preventDefault();
		
		var product_id = jQuery('#ced-vm-variation-container').find('input[name="product_id"]').val();
		var quantity = jQuery('#ced-vm-variation-container').find('input[name="quantity"]').val();
		var PrevProId = jQuery("#ced_vm_prevproid").val();
		var variation_id = jQuery('#ced-vm-variation-container').find('input[name="variation_id"]').val();
		
		var variation = {};
		
		variations_html = jQuery("#ced-vm-variation-container").find( 'select[name^=attribute]' );
		
		variations_html.each( function() {
			
			var attrName = jQuery(this).attr('name');
			var attrValue = jQuery(this).val();
			variation[attrName] = attrValue;
		});
		
		jQuery.ajax({
			  url: ajax_url,
			  cache: false,
			  type: "POST",
			  headers : { "cache-control": "no-cache" },
			  data: {
				'action': 'ced_vm_update_variation_in_cart',
				'product_id': product_id,
				'quantity':quantity,
				'PrevProId':PrevProId,
				'variation_id':variation_id,
				'variation':variation
			  },
			  success:function(response) {
				  
				  if(response==true){
					  
					  location.reload();
				  }else{
					  jQuery(".ced-vm-stock-error").html(response);
					  jQuery(".ced-vm-stock-error").show();
					  jQuery('form.variations_form').find('div .woocommerce-variation-add-to-cart .input-text').show();
				  }
			  }
		});
		
	});
	
	jQuery(document).on('click','.ced-vm-close-btn',function(){
		
		jQuery("#ced-vm-variation-container").html( ' ' );
		jQuery("#ced-vm-variation-container").hide();
		jQuery(".ced-vm-overlay").hide();
	});
});

function ced_vm_image_change_on_variation_popup()
{

	/* little trick to handle image change :: saving default image */
	var ced_caf_default_img_src = jQuery( 'div.images img' ).attr( 'src' );
	var ced_caf_default_img_alt = jQuery( 'div.images img' ).attr( 'alt' );

	/*global wc_add_to_cart_variation_params, wc_cart_fragments_params */
/*
* This code is used from WooCommerce. We are using this js to implement 
* single page variation change with flexslider
*
*/
(function ( $, window, document, undefined ) {
	/**
	 * VariationForm class which handles variation forms and attributes.
	 */
	var VariationForm = function( $form ) {
		this.$form                = $form;
		this.$attributeFields     = $form.find( '.variations select' );
		this.$singleVariation     = $form.find( '.single_variation' ),
		this.$singleVariationWrap = $form.find( '.single_variation_wrap' );
		this.$resetVariations     = $form.find( '.reset_variations' );
		this.$product             = $form.closest( '.product' );
		this.variationData        = $form.data( 'product_variations' );
		this.useAjax              = false === this.variationData;
		this.xhr                  = false;

		// Initial state.
		this.$singleVariationWrap.show();
		this.$form.unbind( 'check_variations update_variation_values found_variation' );
		this.$resetVariations.unbind( 'click' );
		this.$attributeFields.unbind( 'change ' );

		// Methods.
		this.getChosenAttributes    = this.getChosenAttributes.bind( this );
		this.findMatchingVariations = this.findMatchingVariations.bind( this );
		this.isMatch                = this.isMatch.bind( this );
		this.toggleResetLink        = this.toggleResetLink.bind( this );

		// Events.
		$form.on( 'click', '.reset_variations', { variationForm: this }, this.onReset );
		$form.on( 'reload_product_variations', { variationForm: this }, this.onReload );
		$form.on( 'hide_variation', { variationForm: this }, this.onHide );
		$form.on( 'show_variation', { variationForm: this }, this.onShow );
		$form.on( 'click', '.single_add_to_cart_button', { variationForm: this }, this.onAddToCart );
		$form.on( 'reset_data', { variationForm: this }, this.onResetDisplayedVariation );
		$form.on( 'reset_image', { variationForm: this }, this.onResetImage );
		$form.on( 'change', '.variations select', { variationForm: this }, this.onChange );
		$form.on( 'found_variation', { variationForm: this }, this.onFoundVariation );
		$form.on( 'check_variations', { variationForm: this }, this.onFindVariation );
		$form.on( 'update_variation_values', { variationForm: this }, this.onUpdateAttributes );

		// Check variations once init.
		$form.trigger( 'check_variations' );
		$form.trigger( 'wc_variation_form' );
	};

	/**
	 * Reset all fields.
	 */
	VariationForm.prototype.onReset = function( event ) {
		event.preventDefault();
		event.data.variationForm.$attributeFields.val( '' ).change();
		event.data.variationForm.$form.trigger( 'reset_data' );
	};

	/**
	 * Reload variation data from the DOM.
	 */
	VariationForm.prototype.onReload = function( event ) {
		var form           = event.data.variationForm;
		form.variationData = form.$form.data( 'product_variations' );
		form.useAjax       = false === form.variationData;
		form.$form.trigger( 'check_variations' );
	};

	/**
	 * When a variation is hidden.
	 */
	VariationForm.prototype.onHide = function( event ) {
		event.preventDefault();
		event.data.variationForm.$form.find( '.single_add_to_cart_button' ).removeClass( 'wc-variation-is-unavailable' ).addClass( 'disabled wc-variation-selection-needed' );
		event.data.variationForm.$form.find( '.woocommerce-variation-add-to-cart' ).removeClass( 'woocommerce-variation-add-to-cart-enabled' ).addClass( 'woocommerce-variation-add-to-cart-disabled' );
	};

	/**
	 * When a variation is shown.
	 */
	VariationForm.prototype.onShow = function( event, variation, purchasable ) {
		event.preventDefault();
		if ( purchasable ) {
			event.data.variationForm.$form.find( '.single_add_to_cart_button' ).removeClass( 'disabled wc-variation-selection-needed wc-variation-is-unavailable' );
			event.data.variationForm.$form.find( '.woocommerce-variation-add-to-cart' ).removeClass( 'woocommerce-variation-add-to-cart-disabled' ).addClass( 'woocommerce-variation-add-to-cart-enabled' );
		} else {
			event.data.variationForm.$form.find( '.single_add_to_cart_button' ).removeClass( 'wc-variation-selection-needed' ).addClass( 'disabled wc-variation-is-unavailable' );
			event.data.variationForm.$form.find( '.woocommerce-variation-add-to-cart' ).removeClass( 'woocommerce-variation-add-to-cart-enabled' ).addClass( 'woocommerce-variation-add-to-cart-disabled' );
		}
	};

	/**
	 * When the cart button is pressed.
	 */
	VariationForm.prototype.onAddToCart = function( event ) {
		if ( $( this ).is('.disabled') ) {
			event.preventDefault();

			if ( $( this ).is('.wc-variation-is-unavailable') ) {
				window.alert( wc_add_to_cart_variation_params.i18n_unavailable_text );
			} else if ( $( this ).is('.wc-variation-selection-needed') ) {
				window.alert( wc_add_to_cart_variation_params.i18n_make_a_selection_text );
			}
		}
	};

	/**
	 * When displayed variation data is reset.
	 */
	VariationForm.prototype.onResetDisplayedVariation = function( event ) {
		var form = event.data.variationForm;
		form.$product.find( '.product_meta' ).find( '.sku' ).wc_reset_content();
		form.$product.find( '.product_weight' ).wc_reset_content();
		form.$product.find( '.product_dimensions' ).wc_reset_content();
		form.$form.trigger( 'reset_image' );
		form.$singleVariation.slideUp( 200 ).trigger( 'hide_variation' );
	};

	/**
	 * When the product image is reset.
	 */
	VariationForm.prototype.onResetImage = function( event ) {
		event.data.variationForm.$form.wc_variations_image_update( false );
	};

	/**
	 * Looks for matching variations for current selected attributes.
	 */
	VariationForm.prototype.onFindVariation = function( event ) {
		var form              = event.data.variationForm,
			attributes        = form.getChosenAttributes(),
			currentAttributes = attributes.data;

		if ( attributes.count === attributes.chosenCount ) {

			if ( form.useAjax ) {
				if ( form.xhr ) {
					form.xhr.abort();
				}
				form.$form.block( { message: null, overlayCSS: { background: '#fff', opacity: 0.6 } } );
				currentAttributes.product_id  = parseInt( form.$form.data( 'product_id' ), 10 );
				currentAttributes.custom_data = form.$form.data( 'custom_data' );
				form.xhr                      = $.ajax( {
					url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_variation' ),
					type: 'POST',
					data: currentAttributes,
					success: function( variation ) {
						if ( variation ) {
							form.$form.trigger( 'found_variation', [ variation ] );
						} else {
							form.$form.trigger( 'reset_data' );
							form.$form.find( '.single_variation' ).after( '<p class="wc-no-matching-variations woocommerce-info">' + wc_add_to_cart_variation_params.i18n_no_matching_variations_text + '</p>' );
							form.$form.find( '.wc-no-matching-variations' ).slideDown( 200 );
						}
					},
					complete: function() {
						form.$form.unblock();
					}
				} );
			} else {

				form.$form.trigger( 'update_variation_values' );

				var matching_variations = form.findMatchingVariations( form.variationData, currentAttributes ),
					variation           = matching_variations.shift();

				if ( variation ) {

					form.$form.trigger( 'found_variation', [ variation ] );

				} else {
					form.$form.trigger( 'reset_data' );
					form.$form.find( '.single_variation' ).after( '<p class="wc-no-matching-variations woocommerce-info">' + wc_add_to_cart_variation_params.i18n_no_matching_variations_text + '</p>' );
					form.$form.find( '.wc-no-matching-variations' ).slideDown( 200 );
				}
			}
		} else {
			form.$form.trigger( 'update_variation_values' );
			form.$form.trigger( 'reset_data' );
		}

		// Show reset link.
		form.toggleResetLink( attributes.chosenCount > 0 );
	};

	/**
	 * Triggered when a variation has been found which matches all attributes.
	 */
	VariationForm.prototype.onFoundVariation = function( event, variation ) {
		var form           = event.data.variationForm,
			$sku           = form.$product.find( '.product_meta' ).find( '.sku' ),
			$weight        = form.$product.find( '.product_weight' ),
			$dimensions    = form.$product.find( '.product_dimensions' ),
			$qty           = form.$singleVariationWrap.find( '.quantity' ),
			purchasable    = true,
			variation_id   = '',
			template       = false,
			$template_html = '';

		if ( variation.sku ) {
			$sku.wc_set_content( variation.sku );
		} else {
			$sku.wc_reset_content();
		}

		if ( variation.weight ) {
			$weight.wc_set_content( variation.weight );
		} else {
			$weight.wc_reset_content();
		}

		if ( variation.dimensions ) {
			$dimensions.wc_set_content( variation.dimensions );
		} else {
			$dimensions.wc_reset_content();
		}

		form.$form.wc_variations_image_update( variation );

		if ( ! variation.variation_is_visible ) {
			template = wp.template( 'unavailable-variation-template' );
		} else {
			template     = wp.template( 'variation-template' );
			variation_id = variation.variation_id;
		}

		$template_html = template( {
			variation: variation
		} );
		$template_html = $template_html.replace( '/*<![CDATA[*/', '' );
		$template_html = $template_html.replace( '/*]]>*/', '' );

		form.$singleVariation.html( $template_html );
		form.$form.find( 'input[name="variation_id"], input.variation_id' ).val( variation.variation_id ).change();

		// Hide or show qty input
		if ( variation.is_sold_individually === 'yes' ) {
			$qty.find( 'input.qty' ).val( '1' ).attr( 'min', '1' ).attr( 'max', '' );
			$qty.hide();
		} else {
			$qty.find( 'input.qty' ).attr( 'min', variation.min_qty ).attr( 'max', variation.max_qty );
			$qty.show();
		}

		// Enable or disable the add to cart button
		if ( ! variation.is_purchasable || ! variation.is_in_stock || ! variation.variation_is_visible ) {
			purchasable = false;
		}

		// Reveal
		if ( $.trim( form.$singleVariation.text() ) ) {
			form.$singleVariation.slideDown( 200 ).trigger( 'show_variation', [ variation, purchasable ] );
		} else {
			form.$singleVariation.show().trigger( 'show_variation', [ variation, purchasable ] );
		}
	};

	/**
	 * Triggered when an attribute field changes.
	 */
	VariationForm.prototype.onChange = function( event ) {
		var form = event.data.variationForm;

		form.$form.find( 'input[name="variation_id"], input.variation_id' ).val( '' ).change();
		form.$form.find( '.wc-no-matching-variations' ).remove();

		if ( form.useAjax ) {
			form.$form.trigger( 'check_variations' );
		} else {
			form.$form.trigger( 'woocommerce_variation_select_change' );
			form.$form.trigger( 'check_variations' );
			$( this ).blur();
		}

		// Custom event for when variation selection has been changed
		form.$form.trigger( 'woocommerce_variation_has_changed' );
	};

	/**
	 * Escape quotes in a string.
	 * @param {string} string
	 * @return {string}
	 */
	VariationForm.prototype.addSlashes = function( string ) {
		string = string.replace( /'/g, '\\\'' );
		string = string.replace( /"/g, '\\\"' );
		return string;
	};

	/**
	 * Updates attributes in the DOM to show valid values.
	 */
	VariationForm.prototype.onUpdateAttributes = function( event ) {
		var form              = event.data.variationForm,
			attributes        = form.getChosenAttributes(),
			currentAttributes = attributes.data;

		if ( form.useAjax ) {
			return;
		}

		// Loop through selects and disable/enable options based on selections.
		form.$attributeFields.each( function( index, el ) {
			var current_attr_select     = $( el ),
				current_attr_name       = current_attr_select.data( 'attribute_name' ) || current_attr_select.attr( 'name' ),
				show_option_none        = $( el ).data( 'show_option_none' ),
				option_gt_filter        = ':gt(0)',
				attached_options_count  = 0,
				new_attr_select         = $( '<select/>' ),
				selected_attr_val       = current_attr_select.val() || '',
				selected_attr_val_valid = true;

			// Reference options set at first.
			if ( ! current_attr_select.data( 'attribute_html' ) ) {
				var refSelect = current_attr_select.clone();

				refSelect.find( 'option' ).removeAttr( 'disabled attached' ).removeAttr( 'selected' );

				current_attr_select.data( 'attribute_options', refSelect.find( 'option' + option_gt_filter ).get() ); // Legacy data attribute.
				current_attr_select.data( 'attribute_html', refSelect.html() );
			}

			new_attr_select.html( current_attr_select.data( 'attribute_html' ) );

			// The attribute of this select field should not be taken into account when calculating its matching variations:
			// The constraints of this attribute are shaped by the values of the other attributes.
			var checkAttributes = $.extend( true, {}, currentAttributes );

			checkAttributes[ current_attr_name ] = '';

			var variations = form.findMatchingVariations( form.variationData, checkAttributes );

			// Loop through variations.
			for ( var num in variations ) {
				if ( typeof( variations[ num ] ) !== 'undefined' ) {
					var variationAttributes = variations[ num ].attributes;

					for ( var attr_name in variationAttributes ) {
						if ( variationAttributes.hasOwnProperty( attr_name ) ) {
							var attr_val         = variationAttributes[ attr_name ],
								variation_active = '';

							if ( attr_name === current_attr_name ) {
								if ( variations[ num ].variation_is_active ) {
									variation_active = 'enabled';
								}

								if ( attr_val ) {
									// Decode entities and add slashes.
									attr_val = $( '<div/>' ).html( attr_val ).text();

									// Attach.
									new_attr_select.find( 'option[value="' + form.addSlashes( attr_val ) + '"]' ).addClass( 'attached ' + variation_active );
								} else {
									// Attach all apart from placeholder.
									new_attr_select.find( 'option:gt(0)' ).addClass( 'attached ' + variation_active );
								}
							}
						}
					}
				}
			}

			// Count available options.
			attached_options_count = new_attr_select.find( 'option.attached' ).length;

			// Check if current selection is in attached options.
			if ( selected_attr_val && ( attached_options_count === 0 || new_attr_select.find( 'option.attached.enabled[value="' + form.addSlashes( selected_attr_val ) + '"]' ).length === 0 ) ) {
				selected_attr_val_valid = false;
			}

			// Detach the placeholder if:
			// - Valid options exist.
			// - The current selection is non-empty.
			// - The current selection is valid.
			// - Placeholders are not set to be permanently visible.
			if ( attached_options_count > 0 && selected_attr_val && selected_attr_val_valid && ( 'no' === show_option_none ) ) {
				new_attr_select.find( 'option:first' ).remove();
				option_gt_filter = '';
			}

			// Detach unattached.
			new_attr_select.find( 'option' + option_gt_filter + ':not(.attached)' ).remove();

			// Finally, copy to DOM and set value.
			current_attr_select.html( new_attr_select.html() );
			current_attr_select.find( 'option' + option_gt_filter + ':not(.enabled)' ).prop( 'disabled', true );

			// Choose selected value.
			if ( selected_attr_val ) {
				// If the previously selected value is no longer available, fall back to the placeholder (it's going to be there).
				if ( selected_attr_val_valid ) {
					current_attr_select.val( selected_attr_val );
				} else {
					current_attr_select.val( '' ).change();
				}
			} else {
				current_attr_select.val( '' ); // No change event to prevent infinite loop.
			}
		});

		// Custom event for when variations have been updated.
		form.$form.trigger( 'woocommerce_update_variation_values' );
	};

	/**
	 * Get chosen attributes from form.
	 * @return array
	 */
	VariationForm.prototype.getChosenAttributes = function() {
		var data   = {};
		var count  = 0;
		var chosen = 0;

		this.$attributeFields.each( function() {
			var attribute_name = $( this ).data( 'attribute_name' ) || $( this ).attr( 'name' );
			var value          = $( this ).val() || '';

			if ( value.length > 0 ) {
				chosen ++;
			}

			count ++;
			data[ attribute_name ] = value;
		});

		return {
			'count'      : count,
			'chosenCount': chosen,
			'data'       : data
		};
	};

	/**
	 * Find matching variations for attributes.
	 */
	VariationForm.prototype.findMatchingVariations = function( variations, attributes ) {
		var matching = [];
		for ( var i = 0; i < variations.length; i++ ) {
			var variation = variations[i];

			if ( this.isMatch( variation.attributes, attributes ) ) {
				matching.push( variation );
			}
		}
		return matching;
	};

	/**
	 * See if attributes match.
	 * @return {Boolean}
	 */
	VariationForm.prototype.isMatch = function( variation_attributes, attributes ) {
		var match = true;
		for ( var attr_name in variation_attributes ) {
			if ( variation_attributes.hasOwnProperty( attr_name ) ) {
				var val1 = variation_attributes[ attr_name ];
				var val2 = attributes[ attr_name ];
				if ( val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2 ) {
					match = false;
				}
			}
		}
		return match;
	};

	/**
	 * Show or hide the reset link.
	 */
	VariationForm.prototype.toggleResetLink = function( on ) {
		if ( on ) {
			if ( this.$resetVariations.css( 'visibility' ) === 'hidden' ) {
				this.$resetVariations.css( 'visibility', 'visible' ).hide().fadeIn();
			}
		} else {
			this.$resetVariations.css( 'visibility', 'hidden' );
		}
	};

	/**
	 * Function to call wc_variation_form on jquery selector.
	 */
	$.fn.wc_variation_form = function() {
		new VariationForm( this );
		return this;
	};

	/**
	 * Stores the default text for an element so it can be reset later
	 */
	$.fn.wc_set_content = function( content ) {
		if ( undefined === this.attr( 'data-o_content' ) ) {
			this.attr( 'data-o_content', this.text() );
		}
		this.text( content );
	};

	/**
	 * Stores the default text for an element so it can be reset later
	 */
	$.fn.wc_reset_content = function() {
		if ( undefined !== this.attr( 'data-o_content' ) ) {
			this.text( this.attr( 'data-o_content' ) );
		}
	};

	/**
	 * Stores a default attribute for an element so it can be reset later
	 */
	$.fn.wc_set_variation_attr = function( attr, value ) {
		
		if ( undefined === this.attr( 'data-o_' + attr ) ) {
			this.attr( 'data-o_' + attr, ( ! this.attr( attr ) ) ? '' : this.attr( attr ) );
		}
		if ( false === value ) {
			this.removeAttr( attr );
		} else {
			this.attr( attr, value );
		}
	};

	/**
	 * Reset a default attribute for an element so it can be reset later
	 */
	$.fn.wc_reset_variation_attr = function( attr ) {
		if ( undefined !== this.attr( 'data-o_' + attr ) ) {
			this.attr( attr, this.attr( 'data-o_' + attr ) );
		}
	};

	/**
	 * Reset the slide position if the variation has a different image than the current one
	 */
	$.fn.wc_maybe_trigger_slide_position_reset = function( variation ) {

		var $form                = $( this ),
			$product             = $form.closest( '.product' ),
			$product_gallery     = $product.find( '.images' ),
			reset_slide_position = false,
			new_image_id = ( variation && variation.image_id ) ? variation.image_id : '';

		if ( $form.attr( 'current-image' ) !== new_image_id ) {
			reset_slide_position = true;
		}

		$form.attr( 'current-image', new_image_id );

		if ( reset_slide_position ) {
			$product_gallery.trigger( 'woocommerce_gallery_reset_slide_position' );
		}
	};

	/**
	 * Sets product images for the chosen variation
	 */
	$.fn.wc_variations_image_update = function( variation ) {
		
		var $form             = this,
			$product          = $form.closest( '.product' ),
			$product_gallery  = $product.find( '.images' ),
			$gallery_img      = $product.find( '.flex-control-nav li:eq(0) img' ),
			$product_img_wrap = $product_gallery.find( '.woocommerce-product-gallery__image, .woocommerce-product-gallery__image--placeholder' ).eq( 0 ),
			$product_img      = $product_img_wrap.find( '.wp-post-image' ),
			$product_link     = $product_img_wrap.find( 'a' ).eq( 0 );

		

		if ( variation && variation.image && variation.image.src && variation.image.src.length > 1 ) {
			
			$product_img.wc_set_variation_attr( 'src', variation.image.src );
			$product_img.wc_set_variation_attr( 'height', variation.image.src_h );
			$product_img.wc_set_variation_attr( 'width', variation.image.src_w );
			$product_img.wc_set_variation_attr( 'srcset', variation.image.srcset );
			$product_img.wc_set_variation_attr( 'sizes', variation.image.sizes );
			$product_img.wc_set_variation_attr( 'title', variation.image.title );
			$product_img.wc_set_variation_attr( 'alt', variation.image.alt );
			$product_img.wc_set_variation_attr( 'data-src', variation.image.full_src );
			$product_img.wc_set_variation_attr( 'data-large_image', variation.image.full_src );
			$product_img.wc_set_variation_attr( 'data-large_image_width', variation.image.full_src_w );
			$product_img.wc_set_variation_attr( 'data-large_image_height', variation.image.full_src_h );
			$product_img_wrap.wc_set_variation_attr( 'data-thumb', variation.image.src );
			$gallery_img.wc_set_variation_attr( 'src', variation.image.thumb_src );
			$product_link.wc_set_variation_attr( 'href', variation.image.full_src );
		} else {
			$product_img.wc_reset_variation_attr( 'src' );
			$product_img.wc_reset_variation_attr( 'width' );
			$product_img.wc_reset_variation_attr( 'height' );
			$product_img.wc_reset_variation_attr( 'srcset' );
			$product_img.wc_reset_variation_attr( 'sizes' );
			$product_img.wc_reset_variation_attr( 'title' );
			$product_img.wc_reset_variation_attr( 'alt' );
			$product_img.wc_reset_variation_attr( 'data-src' );
			$product_img.wc_reset_variation_attr( 'data-large_image' );
			$product_img.wc_reset_variation_attr( 'data-large_image_width' );
			$product_img.wc_reset_variation_attr( 'data-large_image_height' );
			$product_img_wrap.wc_reset_variation_attr( 'data-thumb' );
			$gallery_img.wc_reset_variation_attr( 'src' );
			$product_link.wc_reset_variation_attr( 'href' );
		}

		window.setTimeout( function() {
			$product_gallery.trigger( 'woocommerce_gallery_init_zoom' );
			$form.wc_maybe_trigger_slide_position_reset( variation );
			$( window ).trigger( 'resize' );
		}, 10 );
	};

	$(function() {
		if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
			$( '.variations_form' ).each( function() {
				$( this ).wc_variation_form();
			});
		}
	});

	/**
	 * Matches inline variation objects to chosen attributes
	 * @deprecated 2.6.9
	 * @type {Object}
	 */
	var wc_variation_form_matcher = {
		find_matching_variations: function( product_variations, settings ) {
			var matching = [];
			for ( var i = 0; i < product_variations.length; i++ ) {
				var variation    = product_variations[i];

				if ( wc_variation_form_matcher.variations_match( variation.attributes, settings ) ) {
					matching.push( variation );
				}
			}
			return matching;
		},
		variations_match: function( attrs1, attrs2 ) {
			var match = true;
			for ( var attr_name in attrs1 ) {
				if ( attrs1.hasOwnProperty( attr_name ) ) {
					var val1 = attrs1[ attr_name ];
					var val2 = attrs2[ attr_name ];
					if ( val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2 ) {
						match = false;
					}
				}
			}
			return match;
		}
	};

})( jQuery, window, document );


}