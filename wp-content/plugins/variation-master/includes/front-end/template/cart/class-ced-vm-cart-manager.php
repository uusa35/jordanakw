<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * class for extending variation change funcitonality on cart page.
 *
 * @class    CED_variation_master_cart_manager
 * 
 * @version  1.0.0
 * @package  variation-master/includes/front-end/template/cart
 * @category Class
 * @author   makewebbetter <webmaster@makewebbetter.com>
 * @since    1.0.0
 */

if( !class_exists( 'CED_variation_master_cart_manager' ) ){
	
	class CED_variation_master_cart_manager{
		
		private static $_instance;
		
		public static function getInstance() {
		
			if( !self::$_instance instanceof self )
				self::$_instance = new self;
		
			return self::$_instance;
		
		}
		
		public function __construct(){
			
			$general_settings = get_option('ced-vm-settings',true);
			
			if(!is_array($general_settings)){
				return;
			}else{
				$is_cart_enabled = isset($general_settings['this']) ? intval($general_settings['this']) : 1;
					
				if(!$is_cart_enabled){
					return;
				}else{

					add_action( 'wp_enqueue_scripts', array($this,'ced_vm_enque_cart_script') );
					add_action( 'woocommerce_after_cart', array($this,'ced_vm_add_product_container') );
					add_filter( 'woocommerce_cart_item_name', array($this,'ced_vm_add_variation_update_link'), 1, 2 );
				}
			} 
		}
		
		/**
		 * variation-manager script for cart page.
		 * 
		 * @since 1.0.0
		 */
		public function ced_vm_enque_cart_script(){
			
			if( is_cart() ){
				$woo_ver = WC()->version;
				if($woo_ver < '3.0.0' && $woo_ver < '2.7.0'){
					wp_register_script('ced-vm-cart-manager', CED_VM_JSPATH . "template/cart/ced-vm-cart-manager-old.js",
					array( 'jquery'), CED_VM_VERSION , TRUE);
					wp_localize_script( 'ced-vm-cart-manager', 'ced_vm_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
				}
				else
				{
					wp_register_script('ced-vm-cart-manager', CED_VM_JSPATH . "template/cart/ced-vm-cart-manager.js",
					array( 'jquery','flexslider'), CED_VM_VERSION , TRUE);
					wp_localize_script( 'ced-vm-cart-manager', 'ced_vm_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ,
						'flexslider'                => apply_filters( 'woocommerce_single_product_carousel_options', array(
							'rtl'            => is_rtl(),
							'animation'      => 'slide',
							'smoothHeight'   => false,
							'directionNav'   => false,
							'controlNav'     => 'thumbnails',
							'slideshow'      => false,
							'animationSpeed' => 500,
							'animationLoop'  => false, // Breaks photoswipe pagination if true.
						) ),
						'zoom_enabled'       => get_theme_support( 'wc-product-gallery-zoom' ),
						'photoswipe_enabled' => get_theme_support( 'wc-product-gallery-lightbox' ),
						'flexslider_enabled' => get_theme_support( 'wc-product-gallery-slider' ) ) );
				}
				wp_enqueue_script('ced-vm-cart-manager');
				wp_enqueue_script('wc-add-to-cart-variation');
				
				wp_enqueue_style( 'ced-vm-cart-style', CED_VM_CSSPATH.'template/cart/ced-vm-cart-style.css' );
			}
		}
		
		/**
		 * container for displaying variation options.
		 * 
		 * @since 1.0.0
		 */
		public function ced_vm_add_product_container(){
		
			echo '<div class="ced-vm-overlay">
					<div id="ced-vm-variation-container" class="ced-vm-product-detail-container ">
					</div>
				<div id="ced-vm-cart-loader" class="ced_vm_cart_product_loader">
						<img alt="Loading.." src="'.CED_VM_GALLERYPATH.'loader.gif">
					</div></div>';
		}
		
		/**
		 * adding update variation symbol on cart page.
		 * 
		 * @since 1.0.0
		 */
		public function ced_vm_add_variation_update_link( $cart_item = null, $cart_item_key = null ){
			$variationHtml = '';
			if( is_cart() ){
					
				$item_data = $cart_item_key['data'];
				$product_id = $cart_item_key['product_id'];
				$variation_id = $cart_item_key['variation_id'];
					
				$_product = wc_get_product($product_id);
					
				$variationHtml = $cart_item;
			
				if( $_product->is_type('variable') ){
					
					$variationHtml .= '<div class="ced-vm-cart-update"><img src="'.CED_VM_GALLERYPATH.'edit.png" alt=" "><a href="javascript:void(0)" class="changemenow" vID="'.$_product->get_id().'" variation_id="'.$variation_id.'">'.__('update','variation-master').'</a></div>';						
				}
				return $variationHtml;
			}else{
				return $cart_item;
			}
		}
	}
}
?>