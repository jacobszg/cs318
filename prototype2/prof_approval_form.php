<?php
	$page_title="Prof-Login";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor Login</h1>";
	include_once "html_top.html"; 
?>

<main>

	<h2>Ask for a Professor Account</h2>
	<p>Please enter your name and UWEC email below to request a professor account.</p> 
	<form action="prof_request_response.php" method="POST">
		Name: <input type="text" name="name" /><br/>
		UWEC email: <input type=	"text" name="email" /><br/>
	    <input type="submit" value="Request an Account" />

</main>

<?php include_once "html_bottom.html"; ?>