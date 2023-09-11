<?php 
function image_validation($image){
	$image_name = $image['image']['name'];
	$image_size = $image['image']['size'];
	$image_temp = $image['image']['tmp_name'];
	$image_type = $image['image']['type'];
	if(empty($image_name)){
		return "Please select a file";
	}

	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$file_type = $finfo->file($image_temp);
	$allowed_image_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
	if(!in_array($file_type, $allowed_image_types) ){
		return "Your choosen file is not a valid image type";
	}

	$upload_max_size = 2 * 1024 * 1024; // 2MB
	if($image_size > $upload_max_size){
		return "Image must not be larger than 2MB";
	}

	$str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz";
	$length = 10;
	$shuffled_str = str_shuffle($str);
	$new_name = substr($shuffled_str, 0, $length);

	$extension = pathinfo($image_name, PATHINFO_EXTENSION);	
	$image_name = $new_name.".".$extension;
	
	$images = glob("uploads/*.*");
	if(in_array("uploads/".$image_name, $images)){
		return "Image already exists in the folder";
	}

	$move_file = move_uploaded_file($image_temp, "uploads/".$image_name);
	if($move_file == false){
		return "File not saved. Please try again";
	}
	return "success";
}