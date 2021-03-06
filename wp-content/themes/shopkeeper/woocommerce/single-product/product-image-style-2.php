<?php	


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

$current_img = 1; // first image active - for controller navigation

?>

<div class="product-images-style-2  woocommerce-product-gallery__wrapper images">
    
    <div class="product_images">

		<?php

        //Featured
		
		?>

			<div class="product-image featured woocommerce-product-gallery__image" id="controller-navigation-image-1">
                
                <div class="<?php echo $zoom_class; ?>">
	            	
	            	<a 

	            	data-fresco-group="product-gallery" 
	            	data-fresco-options="ui: 'outside', thumbnail: '<?php echo esc_url($featured_image_data_src[0]); ?>'" 
	            	data-fresco-group-options="overflow: true, thumbnails: 'vertical', onClick: 'close'" 
	            	data-fresco-caption="<?php echo esc_html($featured_attachment_meta['caption']); ?>" 

	            	class="<?php echo $modal_class; ?>" 

	            	href="<?php echo esc_url($featured_image_link); ?>"

	            	>
	                
						<?php if ( has_post_thumbnail() ) { ?>
							<img src="<?php echo esc_url($featured_image_data_src[0]); ?>" data-src="<?php echo esc_url($featured_image_data_src[0]); ?>" alt="<?php echo $featured_image_title; ?>" class="wp-post-image">
	                    <?php } else { ?>
	                    	<img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" data-src="<?php echo esc_url(wc_placeholder_img_src()); ?>" >
	                    <?php } ?>

	            	</a>
	            	
            	</div>

            	<?php if ($featured_attachment_meta['caption'] && has_post_thumbnail() ) : ?>

            		<p class="caption">
						<?php echo $featured_attachment_meta['caption']; ?>
					</p>

				<?php endif; ?>
           
            </div> <!-- product-image featured -->
            


		<?php
        
        $attachment_ids = $product->get_gallery_image_ids();

       
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

				$current_img++; // get the current img for controller navigation

           		$gallery_image_title       			= esc_attr( get_the_title( $attachment_id ) );
                $gallery_image_src         			= wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$gallery_image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
				$gallery_image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
				$gallery_image_link        			= wp_get_attachment_url( $attachment_id );
			    
			    $gallery_attachment_meta			= wp_get_attachment($attachment_id);
				?>
                			
				<div class="product-image" id="controller-navigation-image-<?php echo $current_img; ?>">
                    <div class="<?php echo $zoom_class; ?>">
	                    
	                    <a 

	                    data-fresco-group="product-gallery" 
	                    data-fresco-options="thumbnail: '<?php echo esc_url($gallery_image_data_src[0]); ?>'" 
	                    data-fresco-caption="<?php echo esc_html($gallery_attachment_meta['caption']); ?>" 

	                    class="<?php echo $modal_class; ?>" 
	                    href="<?php echo esc_url($gallery_image_link); ?>"

	                    >
							
							<img class="desktop-image" src="<?php echo esc_url($gallery_image_data_src[0]); ?>" alt="<?php echo esc_html($gallery_image_title); ?>">
	                        <span class="mobile-gallery-bg" style="background-image: url(<?php echo esc_url($gallery_image_data_src[0]); ?>)"></span>

	                    </a>
					</div>

                    <?php if ($gallery_attachment_meta['caption']) : ?>

                		<p class="caption">
							<?php echo $gallery_attachment_meta['caption']; ?>
						</p>

					<?php endif; ?>

                </div> <!-- /product-image -->
                
                    <?php
		
		            } 
		            
		            ?>

		            <!--  Video -->

				    <?php if ( $page_product_youtube ) : ?>
						
						<?php

							$current_img++;
							$embed_code = wp_oembed_get( $page_product_youtube );

							echo '<div class="product-image video" id="controller-navigation-image-' .$current_img.'">' .$embed_code .'</div>';

							echo '<div class="product-video-icon">
							
								<a data-fresco-group="product-gallery" class="'.$modal_class.'" href="'.esc_url($page_product_youtube).'"><i class="spk-icon-video-player"></i></a>

								</div>';
						?>

					<?php endif; ?>

				<?php endif; ?>

	    <ul class="product-images-controller">

        	<?php
        		$current_img = 1;
        	?>

            <li>
            	<a href="#controller-navigation-image-1" data-number="1">
            		<span class="dot current"></span>
            	</a>
            </li>

        	<?php foreach ( $attachment_ids as $attachment_id ) { 
        			
    			$current_img++;

        		echo '<li><a href="#controller-navigation-image-'.$current_img.'" data-number="'.$current_img.'">
					<span class="dot"></span>
        		</a></li>';

        	} 

			if ( $page_product_youtube ) {

				$current_img++;

				echo '<li class="video-icon"><a href="#controller-navigation-image-'.$current_img.'"><span class="dot"><i class="fa fa-play" aria-hidden="true"></i></span></a></li>';
				
			}

			?>

		</ul> <!-- product-images-controller -->
        
    </div><!-- .product_images -->

</div> <!-- product-images-style-2 -->