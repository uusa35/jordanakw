<?php
/**
 * Variable product add to cart
 *
 * @see 	https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$_productID = absint( $product->get_id() );
$attribute_keys = array_keys( $attributes );
$vm_children = $product->get_children('visible');
$visibleVariations = isset($vm_children) ? $vm_children : array();
if(!is_array($visibleVariations))
	$visibleVariations = array();

// get term associated variation id for featured image..
$attributes_associated_variations = array();
foreach($visibleVariations as $visibleVarId){
	foreach($attribute_keys as $attrKeyName){
		
		$attrKeyName = strtolower($attrKeyName);
		$metaINFO = get_post_meta($visibleVarId, 'attribute_'.$attrKeyName, true);
		$metaInformation = array();
		$attributes_associated_variations[$attrKeyName][$metaINFO] = $visibleVarId;
	}
} 

//fetching the settings data of swatch images..
$product_swatch_data_array = get_post_meta( $_productID, 'ced_vm_product_swatch_data', true );

$ced_vm_settings = get_option('ced-vm-settings',true);
$swatchEnabled = isset($ced_vm_settings['swatch']) ? intval( $ced_vm_settings['swatch'] ) : 1 ;
$useAtrrThumb = isset($ced_vm_settings['at']) ? intval( $ced_vm_settings['at'] ) : 0 ;
$globalAttrDSType1 =  isset($ced_vm_settings['atds']['ds1']) ? intval( $ced_vm_settings['atds']['ds1'] ) : 1;
$globalAttrDSType2 =  isset($ced_vm_settings['atds']['ds2']) ? intval( $ced_vm_settings['atds']['ds2'] ) : 1;
$globalAttrCv =  isset($ced_vm_settings['atds']['cv']) ? intval( $ced_vm_settings['atds']['cv'] ) : 0;
$globalAttrCv_w =  isset($ced_vm_settings['atds']['cv_w']) ? intval( $ced_vm_settings['atds']['cv_w'] ) : 0;	
$globalSizeUsg = isset($ced_vm_settings['ced_vm_usg']) ? intval( $ced_vm_settings['ced_vm_usg'] ) : 0;

//featured image option added in 1.0.3
$ced_vm_featured = isset($ced_vm_settings['ced_vm_featured']) ? intval($ced_vm_settings['ced_vm_featured']) : 0;

$globalAttrDL = isset($ced_vm_settings['dl']) ? intval( $ced_vm_settings['dl'] ) : 1 ;
$disabled_message = isset($ced_vm_settings['dm']) ? esc_html($ced_vm_settings['dm']) : __('Not available for this combination, please choose different selection!','variation-master');
$swatchText = isset($ced_vm_settings['vas']) ? intval( $ced_vm_settings['vas'] ) : 1 ;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php $ta = count($attributes); ?>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
				<?php $tmp_AttrName = sanitize_title( $attribute_name ); ?>
				<?php $conditional_attrName = isset($product_swatch_data_array[$tmp_AttrName]['label']) ? sanitize_title($product_swatch_data_array[$tmp_AttrName]['label']) : wc_attribute_label( $attribute_name ); ?>
				<?php $conditional_dT = isset($product_swatch_data_array[$tmp_AttrName]['dt']) ? sanitize_title($product_swatch_data_array[$tmp_AttrName]['dt']) : 1; ?>
				<?php $conditional_ds = isset($product_swatch_data_array[$tmp_AttrName]['ds']['ds']) ? sanitize_title($product_swatch_data_array[$tmp_AttrName]['ds']['ds']) : 1; ?>
				<?php $conditional_ds2 = isset($product_swatch_data_array[$tmp_AttrName]['ds']['ds2']) ? sanitize_title($product_swatch_data_array[$tmp_AttrName]['ds']['ds2']) : 1; ?>
				<?php $isNameVisible = isset($product_swatch_data_array[$tmp_AttrName]['dn']) ? sanitize_title($product_swatch_data_array[$tmp_AttrName]['dn']) : 1;?>
				<?php $disableProSwatch = isset($product_swatch_data_array['disabled']) ? sanitize_title($product_swatch_data_array['disabled']) : 0;?>
				<?php if( ( $conditional_dT == 1 && !($useAtrrThumb) ) || !( $swatchEnabled ) || $disableProSwatch || !is_single()) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								if(is_ajax()){
									$selected = isset($selected_attributes['attribute_' . sanitize_title( $attribute_name )]) ? sanitize_title($selected_attributes['attribute_' . sanitize_title( $attribute_name )]) : $product->get_variation_default_attribute( $attribute_name );
								}else{
									$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
								}
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'variation-master' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
				<?php else:
                            if ( is_array( $options ) ) {
 								
                                $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
                                $tmp_options_data_array = isset($product_swatch_data_array[$tmp_AttrName]['options_data']) ? $product_swatch_data_array[$tmp_AttrName]['options_data'] : array();
                                if ( taxonomy_exists( sanitize_title( $attribute_name ) ) ) {
									$terms = get_terms( sanitize_title($attribute_name), array('menu_order' => 'ASC') );
									$eligible = true;
									foreach ( $terms as $term ) {
										if ( in_array( $term->slug, $options ) ){
											$tmp_slug_name =  esc_attr( $term->slug );
											$tmpUseGlobal = isset($tmp_options_data_array[$tmp_slug_name]['gat']) ? $tmp_options_data_array[$tmp_slug_name]['gat'] : 0;
											if ( !$tmpUseGlobal ){
												$tmpdtslctType = get_woocommerce_term_meta( $term->term_id, 'display_type', true );
												if($tmpdtslctType == 0){
													$eligible = false;
												}
											}
										}
									}
									if(!$eligible){ ?>
										<tr>
											<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
											<td class="value">
												<?php
													if(is_ajax()){
														$selected = isset($selected_attributes['attribute_' . sanitize_title( $attribute_name )]) ? sanitize_title($selected_attributes['attribute_' . sanitize_title( $attribute_name )]) : $product->get_variation_default_attribute( $attribute_name );
													}else{
														$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
													}
													wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
													echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'variation-master' ) . '</a>' ) : '';
													continue;
												?>
											</td>
										</tr>
									<?php }else{ ?>
										<tr class="ced-vm-row-wrapper">
											<td class="label"><label class="ced-vm-swatch-label" for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo $conditional_attrName; ?></label></td>
											<td class="value" value_of="<?php echo sanitize_title( $attribute_name ); ?>"><label class="ced-vm-attr-name-label" for="<?php echo sanitize_title( $attribute_name ); ?>"><ul>
			                        		<?php
                                    		//$terms = get_terms( sanitize_title($attribute_name), array('menu_order' => 'ASC') );
									
                                    		foreach ( $terms as $term ) {
                                        		if ( in_array( $term->slug, $options ) ){
													$tmp_slug_name =  esc_attr( $term->slug );
											
													$tmpdtslctType = isset($tmp_options_data_array[$tmp_slug_name]['dt']) ? $tmp_options_data_array[$tmp_slug_name]['dt'] : ''; 
													$tmpdtslctimg = isset($tmp_options_data_array[$tmp_slug_name]['image']) ? $tmp_options_data_array[$tmp_slug_name]['image'] : ''; 
													$tmpdtslctclr = isset($tmp_options_data_array[$tmp_slug_name]['color']) ? $tmp_options_data_array[$tmp_slug_name]['color'] : '';
																																							
													if ( !$tmpUseGlobal ){
														
														$tmpdtslctType = get_woocommerce_term_meta( $term->term_id, 'display_type', true );
														$tmpdtslctclr = get_woocommerce_term_meta( $term->term_id, 'slctd_clr', true );
														$tmpdtslctimg = get_woocommerce_term_meta( $term->term_id, 'slctd_img', true );
														
														$conditional_ds2 = $globalAttrDSType2;
														$conditional_ds = $globalAttrDSType1;
														$isNameVisible = $globalAttrDL;
													}
													
													if($ced_vm_featured){
														$term_var_id = isset($attributes_associated_variations[$attribute_name][$term->slug]) ? intval($attributes_associated_variations[$attribute_name][$term->slug]) : 0;
														if($term_var_id){
															$tmpvarproduct = wc_get_product($term_var_id);
															if(!is_wp_error($tmpvarproduct) && !empty($tmpvarproduct)){
																
																$tmpimage_url = wp_get_attachment_image_src( get_post_thumbnail_id( $term_var_id ), 'single-post-thumbnail' );
																$tmpimage_url = is_array($tmpimage_url) ? wp_get_attachment_image_src( get_post_thumbnail_id( $term_var_id ), 'single-post-thumbnail' ) : array();
																$imgURL = isset($tmpimage_url[0]) ? $tmpimage_url[0] : null;
																if(!is_null($imgURL) || $imgURL != null){
																	$tmpdtslctimg = $imgURL;
																	$tmpdtslctType = 1;
																}
															}
														}
													}													
													
													$html = '';
													if($tmpdtslctType == 1){
														
														$html = get_image_html($tmpdtslctimg,$conditional_ds2,$conditional_ds);
													}else{
														$html = get_color_html($tmpdtslctclr,$conditional_ds);
													}
													
													$conditional_class = '';
													$swatchsize = 40;
					                        		$swatchsize_w = 40;
													
													if($globalSizeUsg){
														$conditional_ds = $globalAttrDSType1;
														$conditional_ds2 = $globalAttrDSType2;
													}
													
													$style = get_custom_style($tmpdtslctType,$tmpdtslctclr,$conditional_ds2,$conditional_ds);
													
													if($conditional_ds == 1){
													$swatchsize = 20;
													$swatchsize_w = 20;
													}else if ($conditional_ds == 3){
														$swatchsize = 60;
														$swatchsize_w = 60;
													}else if($conditional_ds > 3){
															if($conditional_ds2 == 3)
															{
																if($globalAttrDSType1 == 1)
																{
																	$swatchsize = 20;
																	$swatchsize_w = 20;
																}
																if($globalAttrDSType1 == 2)
																{
																	$swatchsize = 40;
																	$swatchsize_w = 40;
																}
																if($globalAttrDSType1 == 3)
																{
																	$swatchsize = 60;
																	$swatchsize_w = 60;
																}
																if($globalAttrDSType1 == 4)
																{
																	if($conditional_ds2 == 3 && $globalAttrDSType2 == 3)
																	{
																		$swatchsize = $globalAttrCv;
																		$swatchsize_w = $globalAttrCv_w;
																		$style .= "border-radius: 5px;";
																	}
																	else
																	{
																		$swatchsize = $globalAttrCv;
																		$swatchsize_w = $globalAttrCv;
																	}
																}
															}
															else
															{		
																if($globalAttrDSType1 == 1)
																{
																	$swatchsize = 20;
																	$swatchsize_w = 20;
																}	
																
																if($globalAttrDSType1 == 2)
																{
																	$swatchsize = 40;
																	$swatchsize_w = 40;
																}	
																
																if($globalAttrDSType1 == 3)
																{
																	$swatchsize = 60;
																	$swatchsize_w = 60;
																}	
																
																if($globalAttrDSType1 == 4)
																{	
																	if($conditional_ds2 == 3)
																	{
																		$swatchsize = $globalAttrCv;
																		$swatchsize_w = $globalAttrCv_w;
																		$style .= "border-radius: 5px;";
																	}	
																	else 
																	{
																		$swatchsize = $globalAttrCv;
																		$swatchsize_w = $globalAttrCv;
																	}	
																}	
															}	
													}
													/* if($conditional_ds2 != 3 || $conditional_ds != 4)
													{
														$swatchsize_w = $swatchsize;
													} */	
													
													$swatchsize = intval($swatchsize);
													$swatchsize_w = intval($swatchsize_w);
													
													if($swatchsize){
														$style .= " height: ".$swatchsize."px; width: ".$swatchsize_w."px;";
													}
													
													/* if($conditional_ds == 3){
														$conditional_class = 'ced-vm-swatch-wrapper-60';
													}else if ($conditional_ds == 2){
														$conditional_class = 'ced-vm-swatch-wrapper-40';
													} */
													
													if($selected == esc_attr( $term->slug ) )
														$conditional_class .= ' ced-vm-border';
													if($swatchText == 1){
		                                        		echo '<li><label class="ced-vm-attr-label" for="attr_img_'.esc_attr( $term->slug ).'"><div class="ced-vm-swatch-wrapper '.$conditional_class.'" style="'.$style.'"><span>'.ced_print_attribue_label_on_simple( $term->name , $isNameVisible ) .'</span><input type="radio" id="attr_img_'.esc_attr( $term->slug ).'" value="' . esc_attr( $term->slug ) . '"  name="attribute_'. sanitize_title($attribute_name).'" '.checked( $selected, esc_attr( $term->slug ), false ).'>' .$html.'</div><span class="ced-vm-disabled-hover">'.$disabled_message.'</span></label></li>';
		                                        	}else{
		                                        		echo '<li><label class="ced-vm-attr-label" for="attr_img_'.esc_attr( $term->slug ).'"><span>'.ced_print_attribue_label_on_simple( $term->name , $isNameVisible ) .'</span><div class="ced-vm-swatch-wrapper '.$conditional_class.'" style="'.$style.'"><input type="radio" id="attr_img_'.esc_attr( $term->slug ).'" value="' . esc_attr( $term->slug ) . '"  name="attribute_'. sanitize_title($attribute_name).'" '.checked( $selected, esc_attr( $term->slug ), false ).'>' .$html.'</div><span class="ced-vm-disabled-hover">'.$disabled_message.'</span></label></li>';
 													}
												} 
		                                    }
										}
                                	} else {

									if( $conditional_dT == 1 ){?>
										<tr>
											<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
											<td class="value">
												<?php
													$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
													wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
													echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
												?>
											</td>
										</tr>
										<?php 
										continue;
									}else{?>
									<?php $conditional_ds = isset($product_swatch_data_array[$tmp_AttrName]['ds']['ds']) ? sanitize_title($product_swatch_data_array[$tmp_AttrName]['ds']['ds']) : 1; ?>
									<?php $conditional_ds2 = isset($product_swatch_data_array[$tmp_AttrName]['ds']['ds2']) ? sanitize_title($product_swatch_data_array[$tmp_AttrName]['ds']['ds2']) : 1; 
									
									?>
										<tr class="ced-vm-row-wrapper">
											<td class="label"><label class="ced-vm-swatch-label" for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo $conditional_attrName; ?></label></td>
											<td class="value" value_of="<?php echo sanitize_title( $attribute_name ); ?>"><label class="ced-vm-attr-name-label" for="<?php echo sanitize_title( $attribute_name ); ?>"><ul>
					                        <?php
					                        foreach ( $options as $option ){
					                        	$tmp_slug_name =  esc_attr( $option );
					                        	$tmpdtslctType = isset($tmp_options_data_array[$tmp_slug_name]['dt']) ? $tmp_options_data_array[$tmp_slug_name]['dt'] : '';
					                        	$tmpdtslctimg = isset($tmp_options_data_array[$tmp_slug_name]['image']) ? $tmp_options_data_array[$tmp_slug_name]['image'] : '';
					                        	$tmpdtslctclr = isset($tmp_options_data_array[$tmp_slug_name]['color']) ? $tmp_options_data_array[$tmp_slug_name]['color'] : '';
					                        		
					                        	$html = '';
					                        	
					                        	$swatchsize = 40;
					                        	$swatchsize_w = 40;
					                        		
					                        	if($globalSizeUsg){
													$conditional_ds = $globalAttrDSType1;
													$conditional_ds2 = $globalAttrDSType2;
												}
												
												$style = get_custom_style($tmpdtslctType,$tmpdtslctclr,$conditional_ds2,$conditional_ds);
												
												if($conditional_ds == 1){
													$swatchsize = 20;
													$swatchsize_w = 20;
												}else if ($conditional_ds == 3){
													$swatchsize = 60;
													$swatchsize_w = 60;
												}else if($conditional_ds > 3){
														if($conditional_ds2 == 3)
														{
															if($globalAttrDSType1 == 1)
															{
																$swatchsize = 20;
																$swatchsize_w = 20;
															}
															if($globalAttrDSType1 == 2)
															{
																$swatchsize = 40;
																$swatchsize_w = 40;
															}
															if($globalAttrDSType1 == 3)
															{
																$swatchsize = 60;
																$swatchsize_w = 60;
															}
															if($globalAttrDSType1 == 4)
															{
																if($conditional_ds2 == 3 && $globalAttrDSType2 == 3)
																{
																	$swatchsize = $globalAttrCv;
																	$swatchsize_w = $globalAttrCv_w;
																	$style .= "border-radius: 5px;";
																}
																else
																{
																	$swatchsize = $globalAttrCv;
																	$swatchsize_w = $globalAttrCv;
																}
															}
														}
														else
														{		
															if($globalAttrDSType1 == 1)
															{
																$swatchsize = 20;
																$swatchsize_w = 20;
															}	
															
															if($globalAttrDSType1 == 2)
															{
																$swatchsize = 40;
																$swatchsize_w = 40;
															}	
															
															if($globalAttrDSType1 == 3)
															{
																$swatchsize = 60;
																$swatchsize_w = 60;
															}	
															
															if($globalAttrDSType1 == 4)
															{	
																if($conditional_ds2 == 3)
																{
																	$swatchsize = $globalAttrCv;
																	$swatchsize_w = $globalAttrCv_w;
																	$style .= "border-radius: 5px;";
																}	
																else 
																{
																	$swatchsize = $globalAttrCv;
																	$swatchsize_w = $globalAttrCv;
																}	
															}	
														}	
												}
													
												/* 	
												
												if($conditional_ds2 != 3 || $conditional_ds != 4)
												{
													$swatchsize_w = $swatchsize;
												}	
												 */
												$swatchsize = intval($swatchsize);
												$swatchsize_w = intval($swatchsize_w);
					                        	
					                        	if($swatchsize){
					                        		$style .= " height: ".$swatchsize."px; width: ".$swatchsize_w."px;";
					                        	}
					                        	
					                        	if($ced_vm_featured){
													$tmpAttrName = strtolower($attribute_name);
					                        		$term_var_id = isset($attributes_associated_variations[$tmpAttrName][$option]) ? intval($attributes_associated_variations[$tmpAttrName][$option]) : 0;
					                        		if($term_var_id){
					                        			$tmpvarproduct = wc_get_product($term_var_id);
					                        			if(!is_wp_error($tmpvarproduct) && !empty($tmpvarproduct)){
					                        	
					                        				$tmpimage_url = wp_get_attachment_image_src( get_post_thumbnail_id( $term_var_id ), 'single-post-thumbnail' );
					                        				$tmpimage_url = is_array($tmpimage_url) ? wp_get_attachment_image_src( get_post_thumbnail_id( $term_var_id ), 'single-post-thumbnail' ) : array();
					                        				$imgURL = isset($tmpimage_url[0]) ? $tmpimage_url[0] : null;
					                        				if(!is_null($imgURL) || $imgURL != null){
					                        					$tmpdtslctimg = $imgURL;
					                        					$tmpdtslctType = 1;
					                        				}
					                        			}
					                        		}
					                        	}
					                        	
					                        
					                        	if($tmpdtslctType){
					                        		$html = get_image_html($tmpdtslctimg,$conditional_ds2,$conditional_ds);
					                        	}else{
					                        		$html = get_color_html($tmpdtslctclr,$conditional_ds);
					                        	}
					                        	$conditional_class = '';
					                        	//$conditional_class = ($conditional_ds == 3) ? 'ced-vm-swatch-wrapper-60' : ($conditional_ds == 2) ? 'ced-vm-swatch-wrapper-40' : '';
					                        	if($selected == esc_attr( $option ) )
					                        		$conditional_class .= ' ced-vm-border';
					                        	if($swatchText == 1){
					                        		echo '<li><label class="ced-vm-attr-label" for="attr_img_'.esc_attr( $option ).'"><div class="ced-vm-swatch-wrapper '.$conditional_class.'" style="'.$style.'"><span>'.ced_print_attribue_label_on_simple( esc_attr( $option ) , $isNameVisible ) .'</span><input type="radio" id="attr_img_'.esc_attr( $option ).'" value="' .esc_attr( $option ) . '" name="attribute_'. sanitize_title($attribute_name).'" '.checked( $selected, esc_attr( $option ), false ).'>'.$html. '</div><span class="ced-vm-disabled-hover">'.$disabled_message.'</span></label></li>';
					                        	}else{
					                        		echo '<li><label class="ced-vm-attr-label" for="attr_img_'.esc_attr( $option ).'"><span>'.ced_print_attribue_label_on_simple( esc_attr( $option ) , $isNameVisible ) .'</span><div class="ced-vm-swatch-wrapper '.$conditional_class.'" style="'.$style.'"><input type="radio" id="attr_img_'.esc_attr( $option ).'" value="' .esc_attr( $option ) . '" name="attribute_'. sanitize_title($attribute_name).'" '.checked( $selected, esc_attr( $option ), false ).'>'.$html. '</div><span class="ced-vm-disabled-hover">'.$disabled_message.'</span></label></li>';
												}
											}
									}
                                }
                            }
                            echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
                        ?>
                        </ul>
                    </label>
							<?php
								$args = array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected'=>$selected );
								$args = wp_parse_args( apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ), array(
									'options'          => false,
									'attribute'        => false,
									'product'          => false,
									'selected' 	       => false,
									'name'             => '',
									'id'               => '',
									'class'            => '',
									'show_option_none' => __( 'Choose an option', 'woocommerce' )
								) );
						
								$options   = $args['options'];
								$product   = $args['product'];
								$attribute = $args['attribute'];
								$name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
								$id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
								$class     = $args['class'];
						
								if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
									$attributes = $product->get_variation_attributes();
									$options    = $attributes[ $attribute ];
								}
						
								$html = '<select style="display:none" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';
						
								if ( $args['show_option_none'] ) {
									$html .= '<option value="">' . esc_html( $args['show_option_none'] ) . '</option>';
								}
						
								if ( ! empty( $options ) ) {
									if ( $product && taxonomy_exists( $attribute ) ) {
										// Get terms if this is a taxonomy - ordered. We need the names too.
										$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );
						
										foreach ( $terms as $term ) {
											if ( in_array( $term->slug, $options ) ) {
												$html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</option>';
											}
										}
									} else {
										foreach ( $options as $option ) {
											// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
											$html .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
										}
									}
								}
						
								$html .= '</select>';
								echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args );
							?>
						</td>
					</tr>
					<?php endif;?>
		        <?php endforeach;?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
?>