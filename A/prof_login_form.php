<?php
	$page_title="Prof-Login";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor Login</h1>";
	include_once "html_top.html"; 
?>

<main>
	<h2>Professor Login</h2>
	<form name="login" action="prof_login_response.php" onsubmit="return(validateLogin())" method="POST">
		Username: <input type="text" name="user_name" /><br />
		Password: <input type="password" name="password" /><br />
	    <input type="submit" value="Login" />
	</form>
	<div id="testing"></div>
	
	<script src="Scripts/jQuery.js"></script>
    <script>
        $(function(){

            $("").text("HELLLLLLLLLLLLP MEEEEEEEEEE");

        });
    </script>
	
</main>

<?php 
	include_once "html_bottom.html"; 
?>