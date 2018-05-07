<?php
	$page_title="AddBoardTopic";
	$banner_id="banner_none";
	$banner_writing="<h1>Deleted Research Topic</h1>";
	include_once "html_top.html"; 
?>

<?php
rewrite(); //for testing
echo "First HELLO IN RESEARCH TOPIC<br>";
	if(!empty($_POST['type_R'])){//to run PHP script on submit THIS 
		echo "HELLO SECOND";
		if(!empty($_POST['check_list'])){
			echo "<br> HELLO Third";
			// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected){
				echo $selected."</br>";
			}
		}else{
			echo "YOU have selected Nothing";
		}
	}
?>
<?php 
	include_once "html_bottom.html";
?>