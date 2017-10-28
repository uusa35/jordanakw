<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!class_exists('CEDVMgetvariationfields')){
	class CEDVMgetvariationfields{
		
		public $ID;
		
		public $parent;
		
		public $variation;
		
		public $postmeta = array (
			'_sku'							=> '',
			'_virtual'						=> '',
			'_downloadable' 				=> '',
			'_weight'     					=> '',
			'_length'      					=> '',
			'_width'      					=> '',
			'_height'     					=> '',
			'_manage_stock' 				=> '',
			'_stock_status'					=> '',
			'_regular_price'				=> '',
			'_sale_price'    				=> '',
			'_price'      					=> '',
			'_variation_description'  		=> '',
			'featured_img'					=> '',
			'ced-vm-variation-gallery'   	=> '',
		);
		
		public $csvFields = array(
			'parent_id' => '',
			'variation_id'=>'',
			'parent_name' => '',
			'variation_name' => '',
			'variations' => '',
			'variation_gallery' => '',
		);
		
		public $attributes = array(
			'attributes' => '',
			'attributes_values' => '',
		);
		
		public $variation_attributes = array();
		
		public function __construct($id = null,$parent = null,$variation_attributes) {
			$this->ID = $id;
			$this->parent = $parent;
			$this->variation_attributes = $variation_attributes;
			if ($this->ID) {
				$this->ced_vm_update_product_data();
			}
		}
		
		function get_csv_header(){
			
			$columnNames = array();
			$fields = $this->csvFields;
			
			$tmp_array = array();
			foreach($fields as $fieldKey => $field){
				$tmp_array[] = ltrim($fieldKey,'_');
			}
			
			return $tmp_array;
		}
		
		function get_csv_fields(){
			
			return $this->csvFields;
		}
		
		function ced_vm_update_product_data(){
			
			$this->csvFields['parent_id'] = $this->parent;
			
			$this->csvFields['parent_name'] = get_the_title($this->parent);
			
			$this->csvFields['variation_id'] = $this->ID;
			
			$this->csvFields['variation_name'] = get_the_title($this->ID);
						
			$product_image_gallery = get_post_meta( $this->ID, 'ced-vm-variation-gallery', true );
			$variation_gallery_images = array();
				
			if(!empty($product_image_gallery)){
				$product_image_gallery_array = explode(',', $product_image_gallery);
			
				if(is_array($product_image_gallery_array)){
					foreach ($product_image_gallery_array as $imgId){
						$variation_gallery_images[] = wp_get_attachment_url($imgId);
					}
					$formatted_implode = implode('|', $variation_gallery_images);
				}
				$this->csvFields['variation_gallery'] =  $formatted_implode;
			}else{
				$this->csvFields['variation_gallery'] =  '';
			}
			
			$attributesName = array();
			$attributeValues = array();
			if(is_array($this->variation_attributes) && count($this->variation_attributes)){
				$variation_attr_array = $this->variation_attributes;
				foreach($variation_attr_array as $attrName => $attrVal){
					$attributesName[] = $attrName;
					$attributeValues[] = $attrVal;
				}
			}
			
			$imploded_attr_name = implode('|', $attributesName);
			$imploded_attr_value = implode('|', $attributeValues);
		
			$this->csvFields['variations'] = $imploded_attr_value;
		}
	}
}
?>