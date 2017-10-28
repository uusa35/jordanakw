<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Plugin class for managing admin interfaces.
 *
 * @class    CED_variation_master_admin_interface
 * 
 * @version  1.0.0
 * @package  variation-master/includes/admin
 * @category Class
 * @author   makewebbetter <webmaster@makewebbetter.com>
 * @since    1.0.0
 */

require_once CED_VM_DIRPATH.'includes/admin/class-ced-vm-variation-gallery.php';

if( !class_exists( 'CED_variation_master_admin_interface' ) ){
	
	class CED_variation_master_admin_interface{
		
		private static $_instance;
		
		public static function getInstance() {
		
			if( !self::$_instance instanceof self )
				self::$_instance = new self;
		
			return self::$_instance;
		
		}
		
		public function __construct(){
			
			add_action( 'admin_enqueue_scripts', array($this,'ced_vm_enqueue_product_page_scripts') );
			$ced_vm_variation_gallery_manager = CED_variation_master_variation_gallery::getInstance();
			
			//adding tab in admin menu.
			add_action( 'admin_menu', array($this, 'ced_vm_add_settings_page') );
			
			//for downloading exported csv..
			add_action('admin_init', array($this,'ced_vm_export_csv_download') );
			
			//adding tab for variation swatch images.
			add_action('woocommerce_product_data_tabs', array( $this ,'ced_variation_master_variation_product_tab' ) ) ;
			
			//custom tab fields.
			add_action('woocommerce_product_data_panels',  array( $this ,'ced_variation_master_customTabFields' ) ) ;
			
			//saving custom tab data..
			add_action( 'woocommerce_process_product_meta', array( $this ,'ced_variation_master_saveCustomTabFields' ) );
			
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			
			if ( ! empty( $attribute_taxonomies ) ) {
				foreach ( $attribute_taxonomies as $attribute ) {
					add_action( 'pa_' . $attribute->attribute_name . '_add_form_fields', array( $this, 'ced_vm_add_image_color_selector' ) );
					add_filter('manage_edit-'.'pa_' . $attribute->attribute_name.'_columns', array( $this,'ced_vm_add_preview_column') );
					add_filter('manage_pa_' . $attribute->attribute_name.'_custom_column', array( $this,'ced_vm_preview_column_content'),10, 3 );
					add_action( 'pa_' . $attribute->attribute_name .'_edit_form_fields', array( $this, 'ced_vm_edit_attr_fields' ), 10 );
				}
			}
			
			add_action( 'created_term', array( $this, 'ced_vm_save_attr_extra_fields' ), 10, 3 );
			add_action( 'edit_term', array( $this, 'ced_vm_save_attr_extra_fields' ), 10, 3 );
			
			//custom tab fields.
			add_action( "wp_ajax_ced_vm_update_term_data", array( $this ,'ced_variation_master_customTabFields' ) );
		}
		
		/**
		 * function for exporting csv file.
		 * 
		 * @since 1.0.0
		 */
		function ced_vm_export_csv_download(){
		
			if(isset($_GET["export"])){
					
				if($_GET["export"] == "gallerycsv"){
		
					$filename = 'variations_gallery.csv';
					$data_array = $this->get_gallery_export_data();
		
					if(isset($data_array)){
		
						$fp = fopen('php://memory', 'w');
		
						if( is_array( $data_array ) && count($data_array) ) {
							foreach( $data_array as $productData ){
								if(is_array($productData))
									fputcsv($fp, $productData,',');
							}
						}
						fseek($fp, 0);
		
						header('Content-Type: application/csv');
						header('Content-Disposition: attachment; filename="'.$filename.'";');
						fpassthru($fp);
					}
					exit;
				}
				elseif($_GET["export"] == "attrcsv"){
						
					$filename = 'attribute_terms.csv';
		
					$attribute_taxonomies = wc_get_attribute_taxonomies();
		
					$fp = fopen('php://memory', 'w');
					
					$csv_header = array('Attribute ID','Attribute Name','Attribute Term','Diplay Type(0=>none|1=>image|2=>color code)','Image Url','Color Code');
					
					fputcsv($fp, $csv_header,',');
					
					foreach ( $attribute_taxonomies as $attribute ) {
						$terms = get_terms( array( 'taxonomy' => 'pa_'.$attribute->attribute_name ), array('hide_empty' => false) );
							
						$temp_array = array();
						foreach ($terms as $val){
								
							$temp_array['attribute_id']=$attribute->attribute_id;
							$temp_array['attribute_name']=$attribute->attribute_name;
							$temp_array['term_name']=$val->name;
							$temp_array['term_display_type'] = get_woocommerce_term_meta( $val->term_id, 'display_type');
							$temp_array['term_imgUrl'] = get_woocommerce_term_meta( $val->term_id, 'slctd_img');
							$temp_array['term_color_code'] = get_woocommerce_term_meta( $val->term_id, 'slctd_clr');
		
							fputcsv($fp, $temp_array,',');
						}
					}
					fseek($fp, 0);
		
					header('Content-Type: application/csv');
					header('Content-Disposition: attachment; filename="'.$filename.'";');
					fpassthru($fp);
		
					exit;
				}
			}
		}
		
		/**
		 * function for fetching variations data for exporting in csv.
		 * 
		 * @since 1.0.0
		 */
		function get_gallery_export_data(){
		
			$csv_array = array();
		
			require_once CED_VM_DIRPATH.'includes/library/class-ced-vm-getvariationfields.php';
		
			$product_ids = get_posts(array('posts_per_page'=>-1,'post_type'=>'product','fields'=>'ids'));
		
			$counter = 0;
			foreach ($product_ids as $product_id) {
		
				$_product = wc_get_product($product_id);
					
				if($_product->is_type('variable')){
		
					$variations		=	$_product->get_available_variations();
		
					if(is_array($variations) && count($variations)){
							
						foreach($variations as $variation){
		
							$variation_id = $variation['variation_id'];
							$csvfieldobject = new CEDVMgetvariationfields($variation_id,$product_id,$variation['attributes']);
		
							if(!$counter){
								$csv_array[] = $csvfieldobject->get_csv_header();
							}
		
							$csv_array[] = $csvfieldobject->get_csv_fields();
							$counter++;
						}
					}
				}
			}
			return $csv_array;
		}
		
		/**
		 * adding attribute fields for swatches.
		 * 
		 * @since 1.0.0
		 */
		function ced_vm_edit_attr_fields( $term ){
			$id = $term->term_id;
			$dt = get_woocommerce_term_meta( $id, 'display_type', true );
			$color_code = get_woocommerce_term_meta( $id, 'slctd_clr', true );
			$image = get_woocommerce_term_meta( $id, 'slctd_img', true );
			if(empty($image))
				$image = wc_placeholder_img_src();
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php _e( 'Display type', 'variation-master' ); ?></label></th>
				<td>
					<select id="ced-vm-display-type" name="ced-vm-display-type" class="postform">
						<option value="0" <?php selected($dt,0);?>><?php _e( 'None', 'variation-master' ); ?></option>
						<option value="1" <?php selected($dt,1);?>><?php _e( 'Image', 'variation-master' ); ?></option>
						<option value="2" <?php selected($dt,2);?>><?php _e( 'Color', 'variation-master' ); ?></option>
					</select>
				</td>
			</tr>
			<tr class="form-field ced-vm-attr-colorpickerdiv ced-vm-dt-option" <?php if($dt != 2): echo 'style="display:none";'; endif;?>>
				<th scope="row" valign="top"><label><?php _e( 'Select Color', 'variation-master' ); ?></label></th>
				<td>
					<input type="text" name="ced_vm_slctdclr" class="ced-vm-colorpicker" value="<?php echo $color_code; ?>"/>
				</td>
			</tr>
			<tr class="form-field ced-vm-attr-image-uploader ced-vm-dt-option" <?php if($dt != 1): echo 'style="display:none";'; endif;?>>
				<th scope="row" valign="top"><label><?php _e( 'Select/Upload Image', 'variation-master' ); ?></label></th>
				<td>
					<input type="hidden" class="ced-vm-selected-attr-img" name="ced-vm-selected-attr-img" value="<?php echo $image;?>">
					<img class="ced-vm-slctd-img" src="<?php echo $image;?>" alt="<?php _e('Select Image','variation-master')?>" height="50px" width="50px">
					<button class="ced-vm-image-picker" type="button"><?php _e('Browse','variation-master');?></button>
				</td>
			</tr>
			<?php 
		}
		
		/**
		 * saving added attribute fields for swatches.
		 *
		 * @since 1.0.0
		 */
		function ced_vm_save_attr_extra_fields( $term_id, $tt_id = '', $taxonomy = '' ){
			if ( isset( $_POST['ced-vm-display-type'] ) ) {
				
				$dt = absint( $_POST['ced-vm-display-type'] );
				update_woocommerce_term_meta( $term_id, 'display_type', absint( $_POST['ced-vm-display-type'] ) );
				
				if($dt == 2){
					update_woocommerce_term_meta( $term_id, 'slctd_clr', esc_attr( $_POST['ced_vm_slctdclr'] ) );
				}else if($dt == 1){
					update_woocommerce_term_meta( $term_id, 'slctd_img', esc_attr( $_POST['ced-vm-selected-attr-img'] ) );
				}
			}
		}
		
		/**
		 * displaying table content on attribute edit for swatches.
		 *
		 * @since 1.0.0
		 */
		function ced_vm_preview_column_content( $columns, $column, $id ){
			
			if ( 'thumb' == $column ) {
				
				$dt = get_woocommerce_term_meta( $id, 'display_type', true );
				
				if($dt == 2){
					
					$color_code = get_woocommerce_term_meta( $id, 'slctd_clr', true );
					
					$columns .= '<div style="height:48px; width:48px; background-color:'.$color_code.';" ></div>';
					
				} else{
				
					$img_url = get_woocommerce_term_meta( $id, 'slctd_img', true );
					
					if ( $img_url ) {
						$image = $img_url;
					} else {
						$image = wc_placeholder_img_src();
					}
					$image = str_replace( ' ', '%20', $image );
					
					$columns .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'Thumbnail', 'variation-master' ) . '" class="ced-vm-attr-thumb" height="48" width="48" />';
				}
		
			}
			return $columns;
		}
		
		/**
		 * adding table column on attribute listing for swatches.
		 *
		 * @since 1.0.0
		 */
		function ced_vm_add_preview_column( $columns ){
			$new_columns = array();

			if ( isset( $columns['cb'] ) ) {
				$new_columns['cb'] = $columns['cb'];
				unset( $columns['cb'] );
			}
	
			$new_columns['thumb'] = __( 'Image', 'variation-master' );
	
			return array_merge( $new_columns, $columns );
		}
		
		/**
		 * adding custom fields on attribute term editing for swatches.
		 *
		 * @since 1.0.0
		 */
		function ced_vm_add_image_color_selector(){?>
			<div class="form-field term-display-type-wrap">
				<label for="ced-vm-display-type"><?php _e( 'Display type', 'variation-master' ); ?></label>
				<select id="ced-vm-display-type" name="ced-vm-display-type" class="postform">
					<option value="0"><?php _e( 'None', 'variation-master' ); ?></option>
					<option value="1"><?php _e( 'Image', 'variation-master' ); ?></option>
					<option value="2"><?php _e( 'Color', 'variation-master' ); ?></option>
				</select>
				<div class="ced-vm-attr-image-uploader ced-vm-dt-option" style="display: none;">
					<input type="hidden" class="ced-vm-selected-attr-img" name="ced-vm-selected-attr-img">
					<img class="ced-vm-slctd-img" src="<?php echo wc_placeholder_img_src();?>" alt="<?php _e('Select Image','variation-master')?>" height="50px" width="50px">
					<button class="ced-vm-image-picker" type="button"><?php _e('Browse','variation-master');?></button>
				</div>
				<div class="ced-vm-attr-colorpickerdiv ced-vm-dt-option"  style="display: none;">
					<input type="text" name="ced_vm_slctdclr" class="ced-vm-colorpicker" />
				</div>
			</div>
			<?php 
		}
		
		/**
		 * settings page of variation manager.
		 *
		 * @since 1.0.0
		 */
		function ced_vm_add_settings_page(){
			
			add_menu_page('Variation Master', 'Variation Master ', 'manage_woocommerce', 'ced-vm-settings', array($this, 'ced_vm_settings_callback'),CED_VM_GALLERYPATH.'variation.png',55.567 );
		}
		
		/**
		 * callback function of settings page of variation master.
		 *
		 * @since 1.0.0
		 */
		function ced_vm_settings_callback(){
			
			require_once CED_VM_DIRPATH.'includes/admin/templates/ced-vm-settings-page.php';
		}
		
		/**
		 * loading conditional admin scripts.
		 *
		 * @since 1.0.0
		 */
		function ced_vm_enqueue_product_page_scripts(){
			
			global $wp_query, $post;
			
			$screen       = get_current_screen();
			$screen_id    = $screen ? $screen->id : '';
			$wc_screen_id = sanitize_title( __( 'WooCommerce', 'woocommerce' ) );
			$suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			$screen_page = $screen ? $screen->base : '';
			
			if( $screen_page == 'toplevel_page_ced-vm-settings' )
				wp_enqueue_style( 'ced-variation-master-style', CED_VM_CSSPATH. 'admin/variation-master-style.css' );
			
			//condition for the product edit page only.
			if ( in_array( $screen_id, array( 'product', 'edit-product' ) ) ){
				
				wp_enqueue_style( 'wp-color-picker' );
				wp_register_script( 'ced-vm-product-edit', CED_VM_JSPATH . 'admin/product_edit.js', array( 'jquery','wp-color-picker' ), CED_VM_VERSION );
				wp_localize_script( 'ced-vm-product-edit', 'ced_vm_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
				wp_enqueue_script( 'ced-vm-product-edit' );
				
				wp_enqueue_style( 'ced-vm-product-edit-style', CED_VM_CSSPATH. 'admin/ced-vm-product-edit-style.css' );
			}
			
			if ( in_array( $screen_page, array( 'edit-tags' ) ) || in_array( $screen_page, array( 'term') ) ){
				
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_media();
				
				wp_register_script( 'ced-vm-tags-edit', CED_VM_JSPATH . 'admin/edit-tags.js', array( 'jquery','wp-color-picker' ), CED_VM_VERSION );
				wp_enqueue_script( 'ced-vm-tags-edit' );
			}
			
			if( $screen_id == "toplevel_page_ced-vm-settings"){
				
				wp_enqueue_style( 'wp-color-picker' );
				
				wp_register_script( 'ced-vm-import-export', CED_VM_JSPATH . 'admin/import-export.js', array( 'jquery','wp-color-picker' ), CED_VM_VERSION );
				wp_localize_script( 'ced-vm-import-export', 'ced_vm_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
				wp_enqueue_script( 'ced-vm-import-export' );

			}
		}
		
		/**
		 * adding tab for variable products.
		 * 
		 * @since 1.0.0
		 */
		public function ced_variation_master_variation_product_tab( $tabs ){
			
			$tabs['swatches'] = array(
							'label'  => __( 'Variation Swatches', 'variation-master' ),
							'target' => 'ced-vm-variation-swatch-data',
							'class'  => array( 'show_if_variable','ced-vm-term-swatches' ),
						);
			
			return $tabs;
		}
		
		/**
		 * tab fields for swatches for variable products.
		 * 
		 * @since 1.0.0
		 */
		public function ced_variation_master_customTabFields(){
			
			if(is_ajax()){
				if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
					$post_id = $_POST['post_id'];
					$post = get_post($post_id);
				}
			}else{
				global $post;
			}
			
			$_product 		= 	wc_get_product($post->ID);
			
			if($_product->is_type('variable')){
					
				require_once CED_VM_DIRPATH.'includes/admin/templates/product-custom-tab-fields.php';
			}else{
				// not an variable product.....
			}
			if(is_ajax()){
				exit;
			}
		}
		
		/**
		 * saving custom fields of variable products for swatches.
		 *
		 * @since 1.0.0
		 */
		function ced_variation_master_saveCustomTabFields( $post_id ){
			$_product = wc_get_product( $post_id );
			$ced_vm_swatch_array = array();
			if( $_product->is_type('variable') ){
				$disabled_swatch = isset($_POST["ced-vm-disable_swatch"]) ? 1 : 0;
				$ced_vm_swatch_array['disabled'] = $disabled_swatch;
				$attributes	=	$_product->get_variation_attributes();
				if(is_array($attributes)){
					foreach ( $attributes as $attribute_name => $options ){
						$tmp_attr_data_array = array();
						$attrName = sanitize_title( $attribute_name );
						$tmp_attr_data_array['label'] = isset($_POST["ced_vm_label_$attrName"])&& !empty($_POST["ced_vm_label_$attrName"]) ? sanitize_title( $_POST["ced_vm_label_$attrName"] ) : wc_attribute_label( $attribute_name ) ;
						$tmp_attr_data_array['dt'] = isset($_POST["ced_vm_dt_$attrName"]) ? intval( $_POST["ced_vm_dt_$attrName"] ) : 1 ;
						$ds1 = isset($_POST["ced_vm_ds_$attrName"]) ? intval( $_POST["ced_vm_ds_$attrName"] ) : 1 ;
						$ds2 = isset($_POST["ced_vm_ds2_$attrName"]) ? intval( $_POST["ced_vm_ds2_$attrName"] ) : 1 ;
						$tmp_attr_data_array['ds'] = array('ds'=>$ds1, 'ds2'=>$ds2);
						$tmp_attr_data_array['dn'] = isset($_POST["ced_vm_dn_$attrName"]) ? sanitize_title( $_POST["ced_vm_dn_$attrName"] ) : 1 ;
						
						if ( is_array( $options ) ) {
							$tmp_option_array = array();
							if ( taxonomy_exists( sanitize_title( $attribute_name ) ) ) {
								$terms = get_terms( sanitize_title($attribute_name), array('menu_order' => 'ASC') );
								foreach ( $terms as $term ) {
									if ( in_array( $term->slug, $options ) ){
										$tmp_term_name = esc_attr( $term->slug );
										$tmp_option_array[$tmp_term_name]['gat'] = isset($_POST["ced_vm_gat_$tmp_term_name"]) ? intval( $_POST["ced_vm_gat_$tmp_term_name"] ) : 0 ;
										$tmp_option_array[$tmp_term_name]['dt'] = isset($_POST["ced_vm_sdt_$tmp_term_name"]) ? intval( $_POST["ced_vm_sdt_$tmp_term_name"] ) : 1 ;
										if( $tmp_option_array[$tmp_term_name]['dt'] == 1 ){
											$tmp_option_array[$tmp_term_name]['image'] = isset($_POST["ced-vm-input-scimg-$tmp_term_name"]) ? sanitize_text_field( $_POST["ced-vm-input-scimg-$tmp_term_name"] ) : '' ;
										}else{
											$tmp_option_array[$tmp_term_name]['color'] = isset($_POST["ced_vm_slctclr_$tmp_term_name"]) ? sanitize_text_field( $_POST["ced_vm_slctclr_$tmp_term_name"] ) : '' ;
										}
									}
								}
							}else{
								foreach ( $options as $option ){
									$tmp_term_name = esc_attr( $option );
									$tmp_option_array[$tmp_term_name]['dt'] = isset($_POST["ced_vm_sdt_$tmp_term_name"]) ? intval( $_POST["ced_vm_sdt_$tmp_term_name"] ) : 1 ;
										if( $tmp_option_array[$tmp_term_name]['dt'] == 1 ){
											$tmp_option_array[$tmp_term_name]['image'] = isset($_POST["ced-vm-input-scimg-$tmp_term_name"]) ? sanitize_text_field( $_POST["ced-vm-input-scimg-$tmp_term_name"] ) : '' ;
										}else{
											$tmp_option_array[$tmp_term_name]['color'] = isset($_POST["ced_vm_slctclr_$tmp_term_name"]) ? sanitize_text_field( $_POST["ced_vm_slctclr_$tmp_term_name"] ) : '' ;
										}
								}
							}
							$tmp_attr_data_array['options_data'] = $tmp_option_array;
						}
						$ced_vm_swatch_array[$attrName] = $tmp_attr_data_array;
					}
				}else{
					//not available attributes..
				}
				update_post_meta( $post_id, 'ced_vm_product_swatch_data', $ced_vm_swatch_array );
			}else{
				// not an variable product.....
			}
		}
	}
}