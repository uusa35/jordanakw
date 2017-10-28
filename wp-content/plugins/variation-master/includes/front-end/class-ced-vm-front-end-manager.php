<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Plugin class for managing front end operations.
 *
 * @class    CED_variation_master_shop_interface
 * 
 * @version  1.0.0
 * @package  variation-master/includes/front-end
 * @category Class
 * @author   makewebbetter <webmaster@makewebbetter.com>
 * @since    1.0.0
 */

require_once CED_VM_DIRPATH.'includes/front-end/template/cart/class-ced-vm-cart-manager.php';

if( !class_exists( 'CED_variation_master_shop_interface' ) ){
	
	class CED_variation_master_shop_interface{
		
		private static $_instance;
		
		public static function getInstance() {
		
			if( !self::$_instance instanceof self )
				self::$_instance = new self;
		
			return self::$_instance;
		
		}
		
		public function __construct(){
			
			$ced_vm_cart_manager_Instance = CED_variation_master_cart_manager::getInstance();
			add_action( 'wp_enqueue_scripts', array($this,'ced_vm_enque_single_page_scripts') );
			
			$general_settings = get_option('ced-vm-settings',true);
				
			if(!is_array($general_settings)){
				return;
			}else{
				$is_gallery_enabled = isset($general_settings['pwg']) ? intval($general_settings['pwg']) : 1;
					
				if(!$is_gallery_enabled){
					return;
				}else{
						
					add_action( 'wp_enqueue_scripts', array($this,'ced_vm_enque_single_page_gallery_scripts') );
				}
			}
		}
		
		/**
		 * enqueuing single page scripts.
		 *
		 * @since 1.0.0
		 */
		public function ced_vm_enque_single_page_scripts(){
			
			if(is_single()){
					
				wp_register_script('ced-vm-single-swatches', CED_VM_JSPATH . "template/single/ced-vm-single-swatches.js",
				array( 'jquery' ), CED_VM_VERSION , TRUE);
				
				wp_localize_script( 'ced-vm-single-swatches', 'ced_vm_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
				
				wp_enqueue_script('ced-vm-single-swatches');
					
				wp_enqueue_style ( 'ced-vm-single-page-css', CED_VM_CSSPATH . 'template/single/ced_vm_single_page.css' );
			}
		}
		
		/**
		 * variation gallery script.
		 * 
		 * @since 1.0.0
		 */
		public function ced_vm_enque_single_page_gallery_scripts(){
				
			if(is_single()){
				
				$woo_ver = WC()->version;
				if($woo_ver < '3.0.0' && $woo_ver < '2.7.0'){
					wp_register_script('ced-vm-single-gallery', CED_VM_JSPATH . "template/single/ced-vm-single-gallery-old.js",
					array( 'jquery' ), CED_VM_VERSION , TRUE);
					
					wp_localize_script( 'ced-vm-single-gallery', 'ced_vm_gallery_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
				}
				else
				{
					
					wp_register_script('ced-vm-single-gallery', CED_VM_JSPATH . "template/single/ced-vm-single-gallery.js",
					array( 'jquery','flexslider' ), CED_VM_VERSION , TRUE);
					
					wp_localize_script( 'ced-vm-single-gallery', 'ced_vm_gallery_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
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
				
				
				wp_enqueue_script('ced-vm-single-gallery');
			}
		}
		
	}
}
?>