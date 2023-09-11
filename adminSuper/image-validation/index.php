<?php require "functions.php" ?>
<?php 
	if(isset($_POST['image-upload'])){
		$response = image_validation($_FILES);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="styles.css">
	<title>How to be sure that the uploaded file is an image</title>
</head>
<body>

	<form action="" method="post" enctype="multipart/form-data">
		<h2>Image upload</h2>
		<p class="info">
			Allowed image types are: [ <strong>jpg, png, gif</strong> ]
		</p>
		<p class="info">
			Allowed max-filesize is: [ <strong>2MB</strong> ] 
		</p>

		<label>Please select an image file</label>
		<input type="file" name="image">
		
		<button type="submit" name="image-upload">Upload</button>
	
		<?php 
			if(@$response == "success"){
				?>
					<p class="success">Your image file passed the validation test</p>			
				<?php
			}else{
				?>
					<p class="error"><?php echo @$response ?></p>		
				<?php
			}
		?>
	</form>
</body>
</html>
