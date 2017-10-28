<?php
/**
 * variation custom fields.
 * 
 * @version 1.0.0 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="ced-vm-variation-swatch-data" class="panel woocommerce_options_panel"><?php 
	$attributes	=	$_product->get_variation_attributes();
	$visible_attributes = array();
	if(is_array($attributes) && count($attributes)): 
	$product_swatch_data_array = get_post_meta( $post->ID, 'ced_vm_product_swatch_data', true );
	if(!is_array($product_swatch_data_array))
		$product_swatch_data_array = array();
	
	$disable_swatch = isset($product_swatch_data_array['disabled']) ? intval($product_swatch_data_array['disabled']) : 0;
	?>
	<div class="ced-vm-enable-swatch">
		<?php _e('Disable Swatches','variation-master');?>
		<input type="checkbox" name="ced-vm-disable_swatch" <?php checked($disable_swatch);?>>
	</div>
	<div id="ced-vm-accordion">
		<?php foreach ( $attributes as $attribute_name => $options ) : ?>
			<?php $tmp_title = sanitize_title( $attribute_name ); ?>
			<div class="ced-vm-panel">
				<div class="ced-vm-panel-heading">
					<h4><?php echo wc_attribute_label( $attribute_name ); ?></h4>
				</div>
				<div class="ced-vm-collapse">
					<table class="ced-vm-label-data">
						<tr>
							<td><?php _e('Label','variation-master');?></td>
							<?php $labelValue = isset($product_swatch_data_array[$tmp_title]['label']) ? sanitize_title($product_swatch_data_array[$tmp_title]['label']) : ''; ?>
							<td><input type="text" value="<?php echo $labelValue; ?>" name="ced_vm_label_<?php echo sanitize_title( $attribute_name ); ?>"></td>
						</tr>
						<tr>
							<td><?php _e('Display Type','variation-master');?></td>
							<?php $dtslct = isset($product_swatch_data_array[$tmp_title]['dt']) ? intval($product_swatch_data_array[$tmp_title]['dt']) : 1; ?>
							<td>
								<select name="ced_vm_dt_<?php echo sanitize_title( $attribute_name ); ?>">
									<option value="1" <?php if($dtslct == 1): echo 'selected=selected'; endif; ?> ><?php _e('Default(Select)','variation-master');?></option>
									<option value="2" <?php if($dtslct == 2): echo 'selected=selected'; endif; ?>><?php _e('Image/Color','variation-master');?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td><?php _e('Display Size','variation-master');?></td>
							<?php $dslct = isset($product_swatch_data_array[$tmp_title]['ds']['ds']) ? intval($product_swatch_data_array[$tmp_title]['ds']['ds']) : 1; ?>
							<?php $ds2slct = isset($product_swatch_data_array[$tmp_title]['ds']['ds2']) ? intval($product_swatch_data_array[$tmp_title]['ds']['ds2']) : 1; ?>
							<td>
								<select class="ced-vm-ds1" name="ced_vm_ds_<?php echo sanitize_title( $attribute_name ); ?>">
									<option value="1" <?php if($dslct == 1): echo 'selected=selected'; endif; ?>><?php _e('20px * 20px','variation-master');?></option>
									<option value="2" <?php if($dslct == 2): echo 'selected=selected'; endif; ?>><?php _e('40px * 40px','variation-master');?></option>
									<option value="3" <?php if($dslct == 3): echo 'selected=selected'; endif; ?>><?php _e('60px * 60px','variation-master');?></option>
									<option value="4" <?php if($dslct == 4): echo 'selected=selected'; endif; ?>><?php _e('Default global size','variation-master');?></option>
								</select>
								<select name="ced_vm_ds2_<?php echo sanitize_title( $attribute_name ); ?>" class="ced-vm-selectsecnd">
									<option value="1" <?php if($ds2slct == 1): echo 'selected=selected'; endif; ?>><?php _e('square','variation-master');?></option>
									<option value="2" <?php if($ds2slct == 2): echo 'selected=selected'; endif; ?>><?php _e('circle','variation-master');?></option>
									<option value="3" <?php if($ds2slct == 3): echo 'selected=selected'; endif; ?>><?php _e('rectangle','variation-master');?></option>
								
								</select>
							</td>
						</tr>
						<tr>
							<td><?php _e('Display Name','variation-master');?></td>
							<?php $dnslct = isset($product_swatch_data_array[$tmp_title]['dn']) ? intval($product_swatch_data_array[$tmp_title]['dn']) : 1; ?>
							<td>
								<select name="ced_vm_dn_<?php echo sanitize_title( $attribute_name ); ?>">
									<option value="1" <?php if($dnslct == 1): echo 'selected=selected'; endif; ?>><?php _e('Yes','variation-master');?></option>
									<option value="0" <?php if($dnslct == 0): echo 'selected=selected'; endif; ?>><?php _e('No','variation-master');?></option>
								</select>
							</td>
						</tr>
					</table>
					<div class="ced-vm-sub-accordion">
						<div class="ced-vm-sub-panel">
						<?php $tmp_options_data_array = isset($product_swatch_data_array[$tmp_title]['options_data']) ? $product_swatch_data_array[$tmp_title]['options_data'] : array();?>
							<?php if ( is_array( $options ) ) { ?>
								<?php if ( taxonomy_exists( sanitize_title( $attribute_name ) ) ) { ?>
									<?php $terms = get_terms( sanitize_title($attribute_name), array('menu_order' => 'ASC') ); ?>
									<?php foreach ( $terms as $term ) { ?>
										<?php if ( in_array( $term->slug, $options ) ) :?>
											<div class="ced-vm-sub-panel-heading">	
												<h4><?php echo esc_attr( $term->slug ); ?></h4>
											</div>
											<?php $termName = esc_attr( $term->slug ); ?>
											<div class="ced-vm-sub-collapse">
												<table class="ced-vm-attr-option">
												<?php $tmpgat = isset($tmp_options_data_array[$termName]['gat']) ? $tmp_options_data_array[$termName]['gat'] : 0; ?>
														<?php $tmpdtslctType = isset($tmp_options_data_array[$termName]['dt'])  ? $tmp_options_data_array[$termName]['dt'] : 1; ?>
														<?php $tmpdtslctimg = isset($tmp_options_data_array[$termName]['image']) ? $tmp_options_data_array[$termName]['image'] : wc_placeholder_img_src(); ?>
														<?php $tmpdtslctclr = isset($tmp_options_data_array[$termName]['color']) ? $tmp_options_data_array[$termName]['color'] : ''; ?>
													<tr>
														<td><?php _e('Enable This','variation-master');?></td>
														<td>
															<select class="ced_vm_global_at" name="ced_vm_gat_<?php echo esc_attr( $term->slug ); ?>">
																<option value="0" <?php if($tmpgat == 0): echo 'selected=selected'; endif; ?> ><?php _e('Later','variation-master');?></option>
																<option value="1" <?php if($tmpgat == 1): echo 'selected=selected'; endif; ?>><?php _e('Yes','variation-master');?></option>
															</select>
														</td>
													</tr>
													<tr>
														<td><?php _e('Display Type','variation-master')?></td>
														<td>
															<select class="ced-vm-dtslct" name="ced_vm_sdt_<?php echo esc_attr( $term->slug ); ?>">
																<option value="1" <?php if($tmpdtslctType == 1): echo 'selected=selected'; endif; ?> ><?php _e('Image','variation-master');?></option>
																<option value="0" <?php if($tmpdtslctType == 0): echo 'selected=selected'; endif; ?>><?php _e('Color','variation-master');?></option>
															</select>
														</td>
													</tr>
													<tr class="ced-vm-sci" <?php if(!$tmpdtslctType): echo 'style="display:none;"'; endif;?>>
														<td><?php _e('Select/Upload Image','variation-master')?></td>
														<td><img height="30px" width="30px" src="<?php echo $tmpdtslctimg;?>" alt="<?php _e('Select Image','variation-master');?>" class="ced-vm-scimage_<?php echo esc_attr( $term->slug ); ?>">
															<input type="hidden" value="<?php echo $tmpdtslctimg;?>" class="ced-vm-input-scimg-<?php echo esc_attr( $term->slug ); ?>" name="ced-vm-input-scimg-<?php echo esc_attr( $term->slug ); ?>">
															<button type="button" data-attrname="<?php echo esc_attr( $term->slug ); ?>" class="ced-vm-scimage-upload"><?php _e('Browse','variation-master')?></button>
														</td>
													</tr>
													<tr class="ced-vm-scc" <?php if($tmpdtslctType): echo 'style="display:none;"'; endif;?>>
														<td><?php _e('Choose Color','variation-master')?></td>
														<td><input type="text" value="<?php echo $tmpdtslctclr;?>" name="ced_vm_slctclr_<?php echo esc_attr( $term->slug ); ?>" class="ced-vm-colorpicker" /></td>
													</tr>
												</table>
											</div>
										<?php endif;?>
									<?php } ?>
								<?php }else{?>
									<?php foreach ( $options as $option ) : ?>
										<div class="ced-vm-sub-panel-heading">	
											<h4><?php echo esc_attr( $option ); ?></h4>
										</div>
										<?php $termName = esc_attr( $option ); ?>
										<div class="ced-vm-sub-collapse">
											<table class="ced-vm-attr-option">
												<tr>
													<td><?php _e('Display Type','variation-master')?></td>
													<?php $tmpdtslctType = isset($tmp_options_data_array[$termName]['dt']) ? $tmp_options_data_array[$termName]['dt'] : 1; ?>
													<?php $tmpdtslctimg = isset($tmp_options_data_array[$termName]['image']) ? $tmp_options_data_array[$termName]['image'] : wc_placeholder_img_src(); ?>
													<?php $tmpdtslctclr = isset($tmp_options_data_array[$termName]['color']) ? $tmp_options_data_array[$termName]['color'] : ''; ?>
													<td>
														<select class="ced-vm-dtslct" name="ced_vm_sdt_<?php echo esc_attr( $option ); ?>">
															<option value="1" <?php if($tmpdtslctType == 1): echo 'selected=selected'; endif; ?>><?php _e('Image','variation-master');?></option>
															<option value="0" <?php if($tmpdtslctType == 0): echo 'selected=selected'; endif; ?>><?php _e('Color','variation-master');?></option>
														</select>
													</td>
												</tr>
												<tr class="ced-vm-sci" <?php if(!$tmpdtslctType){echo 'style="display: none"';}?>>
													<td><?php _e('Select/Upload Image','variation-master')?></td>
													<td><img height="30px" width="30px" src="<?php echo $tmpdtslctimg;?>" alt="<?php _e('Select Image','variation-master');?>" class="ced-vm-scimage_<?php echo esc_attr( $option ); ?>">
														<input type="hidden" value="<?php echo $tmpdtslctimg;?>" class="ced-vm-input-scimg-<?php echo esc_attr( $option ); ?>" name="ced-vm-input-scimg-<?php echo esc_attr( $option ); ?>">
														<button type="button" data-attrname="<?php echo esc_attr( $option ); ?>" class="ced-vm-scimage-upload"><?php _e('Browse','variation-master')?></button>
													</td>
												</tr>
												<tr class="ced-vm-scc" <?php if($tmpdtslctType){echo 'style="display: none"';}?>>
													<td><?php _e('Choose Color','variation-master')?></td>
													<td><input type="text" value="<?php echo $tmpdtslctclr;?>" name="ced_vm_slctclr_<?php echo esc_attr( $option ); ?>" class="ced-vm-colorpicker" /></td>
												</tr>
											</table>
										</div>
									<?php endforeach;?>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</div>
<?php else:?>
<div style="text-align: center">
	<h4><?php _e('No available variation for swath images','variation-master');?></h4>
</div>
<?php endif;?>