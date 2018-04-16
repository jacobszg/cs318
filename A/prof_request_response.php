<?php
	$page_title="Prof-Login";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor Login</h1>";
	include_once "html_top.html"; 
?>

<main>

	<h2>Ask for a Professor Account</h2>
	<form action="prof_register_response.php" method="POST">
		First Name: <input type="text" name="first_name" /><br/>
		Last Name: <input type=	"text" name="last_name" /><br/>
		Username: <input type="text" name="user_name" /><br />
		Email: <input type="text" name="email[]" /><br />
		Email (again): <input type="text" name="email[]" /><br />
		Password: <input type="password" name="pword[]" /><br />
		Password (again): <input type="password" name="pword[]" /><br />
	    <input type="submit" value="Register" />

</main>

<?php include_once "html_bottom.html"; ?>