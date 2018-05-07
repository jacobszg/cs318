<?php
	$page_title="AddBoardTopic";
	$banner_id="banner_none";
	$banner_writing="<h1>Add a Researcher Board Topic</h1>";
	include_once "html_top.html"; 
?>
<?php
//VARIABLES
$field="UploadFileField";

$pdf="pdf_file_upload";
$img="img_file_upload";

$returnLink='<p><a style=\"color:white\" 
		href=\"prof_add_board_topic_form.php\">
		Return
		</a></p>';

?>
<?php

function upload($UploadFileField,$TargetDirectory,$typeArray){
	$UploadName = $_FILES[$UploadFileField]['name'];	
	$UploadName = $_SESSION["prof_last_name"].".".$UploadName;
	$UploadTmp = $_FILES[$UploadFileField]['tmp_name'];
	$UploadType = $_FILES[$UploadFileField]['type'];
	
	$targetFile=$TargetDirectory.basename($UploadName);
	$FileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
	
	$UploadName=preg_replace("#[^a-z0-9.]#i","",$UploadName);
	
	//If file already in directory
	if(file_exists($targetFile)){
	die ($_FILES[$UploadFileField]['name']." already exists. 
		$returnLink");	
	}
	
	//check if file fits passed limits to type in the array
	$goodFileType=false;
	foreach ($typeArray as &$value) {
		if($FileType == $value){
			$goodFileType=true;	
		}
	}
	if(!$goodFileType){
		$msg="";
		foreach ($typeArray as &$value) {
			$msg = $msg." ".$value;
		}
		die($TargetDirectory.
		" must be of the following type(s) (".
			$msg.")
		$returnLink");	
	}
	
	if(!$UploadTmp){
		die ("No File Selected, Please Upload Again <p><a style=\"color:white\" href=\"prof_add_board_topic_form.php\">Return</a></p>");	
	}else{
		move_uploaded_file($UploadTmp, "$TargetDirectory$UploadName");	
	}
}
////////////////////////////////////////////////////////////////////////////////

if(isset($_POST["title"]) && isset($_FILES[$pdf]) && isset($_FILES[$img]) && isset($_POST["summary"]) && $_POST['title'] != "" && $_POST['summary'] != ""){
	//upload img
	if(isset($_FILES[$img])){
		upload($img,"Images/",array("jpg","jpeg","png","gif"));
	}
	//upload pdf
	if(isset($_FILES[$pdf])){
		upload($pdf,"PDFs/",array("pdf", "html", "xlsx", "txt", "docx", "xlsm", "pptx"));
	}
	
	//make summary file and save to Summary/
	$my_file = $_SESSION['prof_last_name'].".".$_POST['title'].'.txt';
	$handle = fopen("Summary/".$my_file, 'w') or die('Cannot open file:  '.$my_file.$returnLink);
	$summary = $_POST["summary"];
	$ret = file_put_contents('Summary/'.$my_file, $summary, FILE_APPEND | LOCK_EX);
	if($ret === false) {
		die('There was an error writing .'.$_POST['title'].'.txt summary file'.$returnLink);
	}else {
	echo "<div class=\"good_post_message\">GOOD POST</div>";
	}	
	
	
	$imgFile=preg_replace("#[^a-z0-9.]#i","",$_FILES[$img]['name']);
	$pdfFile=preg_replace("#[^a-z0-9.]#i","",$_FILES[$pdf]['name']);
	
	addResource(($_POST['title']),
	"B",///////////////////////////////////////////////////THIS IS THE ONLY 'important' CHANGE BETWEEN THESE ADD FILES
	($_SESSION["prof_last_name"].".".$pdfFile),
	($my_file),
	($_SESSION["prof_last_name"].".".$imgFile));
	
}
echo"Please complete the form below in full.";
////////////////////////////////////////////
?>
<main>
	<h2>Add Board Topic Information</h2>
<?php 

	echo"
		<form name=\"FileUploadForm\" id=\"FileUploadForm\" enctype=\"multipart/form-data\" action=\"prof_add_board_topic_form.php\" method=\"POST\">
			Researcher Board Topic Title: <input type=\"text\" name=\"title\" id=\"title\" placeholder=\"Board Topic Title\"/><br/>
			Tag Image: <input type=\"file\" id=\"".$img."\" name=\"".$img."\"/><br/>
			Researcher Board Topic Summary: <textarea name=\"summary\" placeholder=\"Summarize the Board Topic here. \"></textarea></br>
			Select a PDF file: <input type=\"file\" id=\"".$pdf."\" name=\"".$pdf."\"/><br/>
			<input type=\"submit\" value=\"Upload New Researcher Board Topic\"/>
		</form>";
		
		echo"<p><a style=\"color:white\" href=\"bmbr_prof_return_hub.php\">Return</a></p>"
?>

</main>

<?php 
	include_once "html_bottom.html";
?>