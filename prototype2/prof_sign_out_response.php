
<?php
	$page_title="Sign Out";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor Sign Out</h1>";
	include_once "html_top.html";
?>
<main>

<?php 
	echo "<h1>You are now signed out.</h1>";
	$_SESSION['logged_in']=false;
	unset($_SESSION["prof_user_name"]);
	unset($_SESSION["prof_first_name"]);
	unset($_SESSION["prof_last_name"]);
	unset($_SESSION["prof_id"]);

?>

</main>
<?php 
	include_once "html_bottom.html"; 
?>