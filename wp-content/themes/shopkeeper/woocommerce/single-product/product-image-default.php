<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

	if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
	global $post, $product, $shopkeeper_theme_options;

    $modal_class = "fresco zoom";
	$zoom_class = "";

	if ( (isset($shopkeeper_theme_options['product_gallery_zoom'])) && ($shopkeeper_theme_options['product_gallery_zoom'] == "1" ) ) {
		$zoom_class = "easyzoom el_zoom";
	}	
	

?>

<?php
    
//Featured

$featured_image_title 				= esc_html( get_the_title( get_post_thumbnail_id() ) );
$featured_image_src 				= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_thumbnail' );
$featured_image_data_src			= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_single' );
$featured_image_data_src_original 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$featured_image_link  				= has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : wc_placeholder_img_src();

$featured_attachment_meta 			= wp_get_attachment(get_post_thumbnail_id());

$post_custom_values 	= get_post_custom( $post->ID );
$page_product_youtube 	= isset($post_custom_values['page_product_youtube']) ? esc_attr( $post_custom_values['page_product_youtube'][0]) : '';
$embed_code 			= wp_oembed_get( $page_product_youtube );

?>

<div class="product-images-layout product-images-default images">

	<div class="product_images">
	    
	    <div class="swiper-container product-images-carousel woocommerce-product-gallery__wrapper">

	        <div class="swiper-wrapper">

				<?php

	            // Featured
				
				?>

	            <div class="swiper-slide ">
		           
			            <div class="<?php echo $zoom_class; ?> woocommerce-product-gallery__image">
		                	
		                	<a 

		                	data-fresco-group="product-gallery" 
		                	data-fresco-options="ui: 'outside', thumbnail: '<?php echo esc_url($featured_image_data_src[0]); ?>'" 
		                	data-fresco-group-options="overflow: true, thumbnails: 'vertical', onClick: 'close'" 
		                	data-fresco-caption="<?php echo esc_html($featured_attachment_meta['caption']); ?>" 

		                	class="<?php echo $modal_class; ?>" 

		                	href="<?php echo esc_url($featured_image_link); ?>"

		                	>			                    
								
								<?php if ( has_post_thumbnail() ) { ?>
									<img src="<?php echo esc_url($featured_image_src[0]); ?>" data-src="<?php echo esc_url($featured_image_data_src[0]); ?>" alt="<?php echo $featured_image_title; ?>" class="swiper-lazy wp-post-image">
		                        <?php } else { ?>
		                        	<img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" data-src="<?php echo esc_url(wc_placeholder_img_src()); ?>" class="swiper-lazy">
		                        <?php } ?>
		                        
		                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
		                	</a>
		                </div>
	                	       
	        	</div><!-- /.swiper-slide -->
		
				<?php
	            
				// Gallery
	            
	            $attachment_ids = $product->get_gallery_image_ids();
	            
	            if ( $attachment_ids ) {
	                
	                foreach ( $attachment_ids as $attachment_id ) {
	        
	                    $gallery_image_title       			= esc_attr( get_the_title( $attachment_id ) );
	                    $gallery_image_src         			= wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
						$gallery_image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
						$gallery_image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
						$gallery_image_link        			= wp_get_attachment_url( $attachment_id );
					    
					    $gallery_attachment_meta			= wp_get_attachment($attachment_id);
						
						?>

	                    <div class="swiper-slide">

		                    <div class="<?php echo $zoom_class; ?>">

	                            <a 

	                            data-fresco-group="product-gallery" 
	                            data-fresco-options="thumbnail: '<?php echo esc_url($gallery_image_data_src[0]); ?>'" 
	                            data-fresco-caption="<?php echo esc_html($gallery_attachment_meta['caption']); ?>" 

	                            class="<?php echo $modal_class; ?>" 

	                            href="<?php echo esc_url($gallery_image_link); ?>"

	                            >
	                        
	                                <img src="<?php echo esc_url($gallery_image_src[0]); ?>" data-src="<?php echo esc_url($gallery_image_data_src[0]); ?>" alt="<?php echo esc_html($gallery_image_title); ?>" class="swiper-lazy">
	                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
	                        
	                            </a>
		                        
		                    </div>

	                    </div><!-- /.swiper-slide -->
	                    
	                	<?php
					
	                }
	                
	            }

				// Youtube Video

				if ( $page_product_youtube ) : ?>
					
					<div class="swiper-slide"><a data-fresco-group="product-gallery" class="<?php echo $modal_class; ?>" href="<?php echo esc_url($page_product_youtube); ?>"><?php echo $embed_code; ?></a>
					</div>

				<?php endif; ?>
	                
	    	</div> <!-- /swiper-wrapper -->

		</div> <!-- /swiper-container -->
	    
	</div> <!-- /product_images -->

</div> <!-- /product-images-default -->


<!-- Mobile Gallery -->

<div class="product-images-layout-mobile product-images-default-mobile">
	    
    <div class="product_images">
		
		<?php

        //Featured
		
		?>

		<div class="images">
			<div class="product-image featured">
            	<a data-fresco-group="product-gallery-mobile" data-fresco-options="ui: 'outside'" data-fresco-group-options="overflow: true, thumbnails: 'vertical', onClick: 'close'" data-fresco-caption="<?php echo esc_html($featured_attachment_meta['caption']); ?>" class="<?php echo $modal_class; ?>" href="<?php echo esc_url($featured_image_link); ?>">	                
					<?php if ( has_post_thumbnail() ) { ?>
						<img src="<?php echo esc_url($featured_image_data_src[0]); ?>" alt="<?php echo $featured_image_title; ?>">
                    <?php } else { ?>
                    	<img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" data-src="<?php echo esc_url(wc_placeholder_img_src()); ?>">
                    <?php } ?>
            	</a>	           
            </div>	            
		</div>

			
		<?php
       
        // Gallery

        if ( $attachment_ids && count($attachment_ids) >= 1 ) : ?> 

			<div class="product-image mobile">
				<?php if ( has_post_thumbnail() ) { ?>			
		        	<a href="<?php echo esc_url($featured_image_link); ?>">		                
						<span class="mobile-gallery-bg" style="background-image: url(<?php echo esc_url($featured_image_data_src[0]); ?>)"></span>
		        	</a>
	        	<?php } else { ?>
	        		<a href="<?php echo esc_url($featured_image_link); ?>">		                
						<span class="mobile-gallery-bg" style="background-image: url(<?php echo esc_url(wc_placeholder_img_src()); ?>)"></span>
		        	</a>
	        	<?php } ?>
		 	</div>

		 	<?php

            foreach ( $attachment_ids as $attachment_id ) {
    
                $mobile_image_title       			= esc_attr( get_the_title( $attachment_id ) );
                $mobile_image_src         			= wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$mobile_image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
				$mobile_image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
				$mobile_image_link        			= wp_get_attachment_url( $attachment_id );
			    
			    $mobile_attachment_meta				= wp_get_attachment($attachment_id);

				?>					
  
				<div class="product-image">                        
                    <a data-fresco-group="product-gallery-mobile" data-fresco-caption="<?php echo esc_html($mobile_attachment_meta['caption']); ?>" class="<?php echo $modal_class; ?>" href="<?php echo esc_url($mobile_image_link); ?>">                    
						<span class="mobile-gallery-bg" style="background-image: url(<?php echo esc_url($mobile_image_data_src[0]); ?>)"></span>
                    </a>                     
                </div>
                
            <?php

            }

        endif;

        // Youtube Video

        if ( $page_product_youtube ) : ?>
		
			<div class="product-image video"><?php echo $embed_code; ?></div>
			
			<div class="product-video-icon">					
				<a data-fresco-group="product-gallery-mobile" class="<?php echo $modal_class; ?>" href="<?php echo esc_url($page_product_youtube); ?>"><i class="spk-icon-video-player"></i></a>
			</div>			

		<?php endif; ?>
        
    </div> <!-- /product_images -->
 
</div> <!-- / product-images-default-mobile -->