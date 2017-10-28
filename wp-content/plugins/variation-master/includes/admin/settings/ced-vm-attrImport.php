<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$notifications = array();

if(isset($_POST['attribute-terms'])){
	if(isset($_FILES)){
		ini_set('memory_limit', '64M');
		set_time_limit(0);
		$uploadedfile = $_FILES['import-attr-terms'];
		if (is_array($uploadedfile)) {
			if($uploadedfile['error'] == 0){
				$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','application/octet-stream', 'application/csv');
				if(in_array($uploadedfile['type'],$mimes)){
					$filetmp = $uploadedfile['tmp_name'];
					if (($handle = fopen($filetmp, "r")) !== FALSE) {
						$attributes = explode("\n",file_get_contents($filetmp));
						if(is_array($attributes) && count($attributes)){
							
							$attr_values_array = array();
							$attr_header_array = isset( $attributes[0] ) ? explode(",",$attributes[0]) : array();
							unset($attributes[0]);
							$attributes = array_values($attributes);
							
							foreach ($attributes as $attribute_values){
								$attr_values_array = explode(',', $attribute_values);
								if(is_array($attr_values_array) && count($attr_values_array)){
									$message = ced_vm_update_add_attr_terms($attr_values_array);
									if(!empty($message))
										$notifications[] = $message;
								}
							}
						}
						fclose($handle);
					}
					unlink($filetmp);
				}else{
					$notifications[] = __('Please Select A .CSV File For Importing','variation-master');
				}
			}
		}
	}else{
		$notifications[] = __('Please Select A CSV File For Importing','variation-master');
	}
}
?>
<?php if(count($notifications)){ ?>
    <?php foreach ($notifications as $message): ?>
    	<div class="updated notice">
    		<p><?php echo $message;?></p>
    	</div>
    <?php endforeach;?>
<?php } ?>
</br>
<form method="GET" action="">
	<a type="button" class="button button-primary" href="?page=ced-vm-settings&tab=import-export&export=attrcsv"><?php _e('Export Attributes','variation-master');?></a>
	<input type="text" class="ced-vm-colorpicker">
	<p><?php _e('Export the available attributes csv file from here!','variation-master');?></p>
	<p><?php _e('Edit the csv file, by entering the display type ( valid values are: 0 - none | 1 - image | 2 - color )','variation-master')?></p>
	<p><?php _e('Enter the image url/color code, you can find the color code with the help of color-picker available in this page','variation-master')?></p>
	<p><?php _e('After editing please Import the edited file, after successfull importing you can check the imported color and image from ')?><a href="<?php echo admin_url( 'edit.php?post_type=product&page=product_attributes' );?>"><?php _e('Here','variation-master');?></a></p>
	<div style="clear: both"></div>
</form>
</br>
<form enctype="multipart/form-data" method="post" action="">
	<input class="" type="file" value="import-attr-terms" name="import-attr-terms">
	<button type="submit" class="button button-primary" value="attribute-terms" name="attribute-terms"><?php _e('Import Attribute','variation-master');?></button>
</form>
</br>
