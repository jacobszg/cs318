<?php
	$page_title="Login Response";
	$banner_id="banner_none";
	$banner_writing="<h1>Login response</h1>";
	include_once "html_top.html";
?>
<main>
<?php
	if (login() == true){
		include_once "bmbr_prof_hub.php";
	}
?>
</main>
<?php include_once "html_bottom.html"; ?>
	
		