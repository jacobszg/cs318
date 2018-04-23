<?php
	$page_title="Login Response";
	$banner_id="banner_none";
	$banner_writing="<h1>Login response</h1>";
	include_once "html_top.html";
?>
<main>
	<form action="prof_account_delete.php" onsubmit="return(confirmDelete())" method="POST">
		<input type="submit" value="Delete Account"/> 
	</form>
</main>
<?php include_once "html_bottom.html"; ?>