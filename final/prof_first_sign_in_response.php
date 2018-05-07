<?php
	$page_title="Prof-Request";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor</h1>";
	include_once "html_top.html"; 
?>

<?php
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
	$target_dir = "Images/";

	$target_file = $target_dir.$_POST['last_name'].".".$_POST['first_name'].".profile.".basename($_FILES["profile"]["name"]);
	
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["profile"]["tmp_name"]);
		echo $check."<br><br>";
		if($check !== false) {
			echo "Profile File is an image - " . $check["mime"] . ".<br>";
			$uploadOk = 1;
		} else {
			echo "Profile File is not an image.<br>";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, Profile file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["profile"]["size"] > 6*1048576) {//50KB should be more than fine..NOT WORKING?
		echo "Sorry, your Profile file is too large.<br>";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for your profile photo.<br>";
		$uploadOk = 0;
	}
	
	//make summary file and save to Summary/
	$my_file = $_POST['last_name']."-".$_POST['first_name']."-about_me_summary.txt";
	$handle = fopen("Summary/".$my_file, 'w') or die('Cannot open a new file:  '.$my_file.$returnLink);
	$summary = $_POST["summary"];
	
		// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Your profile image file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		//LOAD SUMMARY
		$ret = file_put_contents('Summary/'.$my_file, $summary, FILE_APPEND | LOCK_EX);
		if($ret === false) {
			echo 'There was an error writing .'.$my_file;
			$uploadOk = 0;
		}else {
			echo "Summary file ".$my_file." loaded.<br>";
		}
		
		//LOAD img FILE
		if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) { //////////////////////////////////////THS IS BUGGY////
			echo "The file ". basename( $_FILES["profile"]["name"]). " has been uploaded as your profile image.<br>";
			convertAccount($my_file, $target_file);
		}
	}
		
?>
<?php include_once "html_bottom.html"; ?>