<?php
	$page_title="Prof-Request";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor</h1>";
	include_once "html_top.html"; 
?>

<main>

	<h2>Ask for a Professor Account</h2>
	<p>Please enter your name and UWEC email below to request a professor account.</p> 
	<form name="request_account" action="prof_request_account_response.php" onsubmit="return(validateRequest())" method="POST">
		Name: <input type="text" name="name" placeholder="Full Name" autofocus /><br/>
		UWEC email: <input type="text" name="email" placeholder=" UWEC email "/><br/>
	    <input type="submit" value="Request an Account" />
	</form>

</main>

<?php include_once "html_bottom.html"; ?>