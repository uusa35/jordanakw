var ajax_url = ced_vm_params.ajax_url;

jQuery(document).ready(function(){
	/**
	 *  script for swatch images..
	 */
	jQuery(document.body).on('click','#ced-vm-accordion .ced-vm-panel-heading',function(){
			var k = jQuery(this).next().slideToggle('slow');
			jQuery('.ced-vm-collapse').not(k).slideUp('slow');
		});
	jQuery(document.body).on('click','.ced-vm-sub-accordion .ced-vm-sub-panel-heading',function(){
			var m = jQuery(this).next().slideToggle('slow');
			jQuery('.ced-vm-sub-collapse').not(m).slideUp('slow');	
	});
	
	// adding the color picker for attributes swatches..
	jQuery('.ced-vm-colorpicker').wpColorPicker();
	
	// using media library for selecting attributes swatch images..
	jQuery(document).on('click','.ced-vm-scimage-upload',function(e){
		var attrName = jQuery(this).attr('data-attrname');
		e.preventDefault();
		var image = wp.media({ 
            title: 'Upload Image',
            multiple: false
        }).open()
        .on('select', function(e){
            
            var uploaded_image = image.state().get('selection').first();
            var image_url = uploaded_image.toJSON().url;
            
            jQuery('.ced-vm-scimage_'+attrName).attr('src',image_url);
            jQuery('.ced-vm-input-scimg-'+attrName).val(image_url);
        });
	});
	
	// toggle the colorpicker and image select option based on the swatch type select.
	jQuery(document).on('change','.ced-vm-dtslct',function(){
		
		var slctdOption = jQuery(this).val();
		if(slctdOption==0){
			jQuery(this).closest('tr').parent().find('.ced-vm-scc').show();
			jQuery(this).closest('tr').parent().find('.ced-vm-sci').hide();
		}else{
			jQuery(this).closest('tr').parent().find('.ced-vm-scc').hide();
			jQuery(this).closest('tr').parent().find('.ced-vm-sci').show();
		}
	});
	
	//----------End of swatch images script ---------------------//
	
	// always load updated attributes terms..
	jQuery(".ced-vm-term-swatches a").on('click',function(){
		
		var post_id = jQuery("#post_ID").val();
		var wrapper_div = jQuery("#ced-vm-variation-swatch-data");
		
		jQuery( '#woocommerce-product-data' ).block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});
		
		jQuery.ajax({
			  url: ajax_url,
			  cache: false,
			  type: "POST",
			  headers : { "cache-control": "no-cache" },
			  data: {
				'action': 'ced_vm_update_term_data',
				'post_id' : post_id,
			  },
			  success:function(response) {
				  
				  wrapper_div.empty().replaceWith( response );
				  jQuery('.ced-vm-colorpicker').wpColorPicker();
				  jQuery( '#woocommerce-product-data' ).unblock();
			  }
		});
	});
	
	
	/**
	 * variation gallery images script start..
	 */
	//adding gallery images for each variation.
	jQuery(document).on('click','.add-variation-gallery-image',function(event){

		event.preventDefault();

		var $el = jQuery( this ).find('a');
		var loop = jQuery(this).attr('data-loop');

		// Product gallery file uploads
		var product_gallery_frame;
		var $image_gallery_ids = jQuery(this).parent().find('.ced-vm-variation-gallery');
		var $product_images    = jQuery(this).parent().find('.ced-vm-variation-gallery-container').find('ul.product_images');

		// If the media frame already exists, reopen it.
		if ( product_gallery_frame ) {
			product_gallery_frame.open();
			return;
		}

		// Create the media frame.
		product_gallery_frame = wp.media.frames.product_gallery = wp.media({
			// Set the title of the modal.
			title: $el.data( 'choose' ),
			button: {
				text: $el.data( 'update' )
			},
			states: [
				new wp.media.controller.Library({
					title: $el.data( 'choose' ),
					filterable: 'all',
					multiple: true
				})
			]
		});

		// When an image is selected, run a callback.
		product_gallery_frame.on( 'select', function() {
			var selection = product_gallery_frame.state().get( 'selection' );
			var attachment_ids = $image_gallery_ids.val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if ( attachment.id ) {
					attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
					var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

					$product_images.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="javascript:void(0)" class="ced-vm-delete-gallery-image" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>' );
				}
			});

			$image_gallery_ids.val( attachment_ids );
		});

		// Finally, open the modal.
		product_gallery_frame.open();
		
		jQuery( this ).closest( '#variable_product_options' ).find( '.woocommerce_variation' ).addClass( 'variation-needs-update' );

		jQuery( 'button.cancel-variation-changes, button.save-variation-changes' ).removeAttr( 'disabled' );
	
		jQuery( '#variable_product_options' ).trigger( 'woocommerce_variations_defaults_changed' );

	});
	
	//deleting product gallery image.
	jQuery(document).on('click',".ced-vm-delete-gallery-image",function(e){
		
		e.preventDefault();
		
		var $imageToDelete = jQuery(this).parent().parent().parent();
		var attchmntId = jQuery($imageToDelete).attr('data-attachment_id');
		
		jQuery($imageToDelete).fadeOut();
		
		var attrValues = jQuery($imageToDelete).parent().parent().find(".ced-vm-variation-gallery").val();
		var attrArray = attrValues.split(',');

		attrArray = jQuery.grep(attrArray, function(value) {
			  return value != attchmntId;
			});
		
		jQuery($imageToDelete).parent().parent().find(".ced-vm-variation-gallery").val(attrArray);
		
		jQuery( this ).closest( '#variable_product_options' ).find( '.woocommerce_variation' ).addClass( 'variation-needs-update' );

		jQuery( 'button.cancel-variation-changes, button.save-variation-changes' ).removeAttr( 'disabled' );
	
		jQuery( '#variable_product_options' ).trigger( 'woocommerce_variations_defaults_changed' );
		
	});
});