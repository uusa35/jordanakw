<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$notifications2 = array();

if(isset($_POST['import-gallery'])){
	
	if(isset($_FILES)){
		ini_set('memory_limit', '64M');
  		set_time_limit(0);
  		$uploadedfile = $_FILES['import-variation'];
  		if (is_array($uploadedfile)) {
  			if($uploadedfile['error'] == 0){
  				$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','application/octet-stream','application/csv');
  				if(in_array($uploadedfile['type'],$mimes)){
  					
  					$filetmp = $uploadedfile['tmp_name'];
  					if (($handle = fopen($filetmp, "r")) !== FALSE) {
  						$variations = explode("\n",file_get_contents($filetmp));
  						if(is_array($variations) && count($variations)){
  							
  							$variation_data_array = array();
  							$variation_header_array = isset( $variations[0] ) ? explode(",",$variations[0]) : array();
  							unset($variations[0]);
  							$variations = array_values($variations);
  							
  							foreach($variations as $variation_data){
  								$variation_data_array = explode(",",$variation_data);
  								$message = ced_vm_update_add_variation($variation_data_array);
  								if(!empty($message))
  									$notifications2[] = $message;
  							}
  						}
  						fclose($handle);
  					}
  					unlink($filetmp);
  				}else{
					$notifications2[] = __('Please Select A .CSV File For Importing','variation-master');
				}
  			}else{
  				$notifications2[] = __('Error In Uploaded File, Please Try Again Later.','variation-master');
  			}
  		}
	}else{
		$notifications2[] = __('Please Select A CSV File For Importing','variation-master');
	}
}
?>
<?php if(count($notifications2)){ ?>
    <?php foreach ($notifications2 as $message2): ?>
    	<div class="updated notice">
    		<p><?php echo $message2;?></p>
    	</div>
    <?php endforeach;?>
<?php } ?>
</br>
<form method="GET" action="">
	<a type="button" class="button button-primary" href="?page=ced-vm-settings&tab=import-export&export=gallerycsv"><?php _e('Export Variations','variation-master');?></a>
	<p><?php _e('Export the available variations gallery images csv file from here!','variation-master');?></p>
	<p><?php _e('Edit the csv file, by entering the valid image urls seperated by | symbol, and import the edited file.','variation-master')?></p>
</form>
</br>
<form enctype="multipart/form-data" method="post" action="">
	<input class="" type="file" value="import-variation" name="import-variation">
	<button type="submit" class="button button-primary" value="import-gallery" name="import-gallery"><?php _e('Import Variation Gallery Images','variation-master');?></button>
</form>