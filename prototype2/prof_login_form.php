<?php
	$page_title="Prof-Login";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor Login</h1>";
	include_once "html_top.html"; 
?>

<main>
	
	<h2>Professor Login</h2>
	<form name="login" action="prof_login_response.php" onsubmit="return(validateLogin())" method="POST">
		Username: <input type="text" name="user_name" autofocus placeholder="Username" /><br />
		Password: <input type="password" name="password" placeholder="Password"/><br />
	    <input type="submit" value="Login" />
	</form>
	
</main>

<?php 
	include_once "html_bottom.html"; 
?>