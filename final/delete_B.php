<?php
	$page_title="AddBoardTopic";
	$banner_id="banner_none";
	$banner_writing="<h1>Deleted Board Topic</h1>";
	include_once "html_top.html"; 
?>

<?php
//rewrite(); //for testing
echo "First HELLO<br>";
	if(isset($_POST['submit'])){//to run PHP script on submit
		echo "HELLO SECOND";
		if(!empty($_POST['checkboxDelete[]'])){
		// Loop to store and display values of individual checked checkbox.
			foreach($_POST['checkboxDelete[]'] as $selected){
				echo $selected."</br>";
			}
		}
	}
?>
<?php 
	include_once "html_bottom.html";
?>