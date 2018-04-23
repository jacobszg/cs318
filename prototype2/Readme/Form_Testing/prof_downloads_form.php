
<?php
	define ("PAGE_TITLE","form_template");
	include_once "html_top.html"; 
?>

<main>

	<h2>Professor Sign Up</h2>
	<form action="form_action_template.php" method="POST">
		First Name: <input type="text" name="first_name" /><br/>
		Last Name: <input type="text" name="last_name" /><br/>
		Username: <input type="text" name="user_name" /><br />
		Email: <input type="text" name="email[]" /><br />
		Email (again): <input type="text" name="email[]" /><br />
		Password: <input type="password" name="pword[]" /><br />
		Password (again): <input type="password" name="pword[]" /><br />
	    <input type="submit" value="Register" />

</main>

<?php include_once "html_bottom.html"; ?>