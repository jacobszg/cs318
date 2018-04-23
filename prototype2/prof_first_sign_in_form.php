
<h2>Please Fill out the form to finalize and save your account</h2><hr>
<form name="first_sign_in_form" action="prof_first_sign_in_response.php" onsubmit="return(validateFirstSignIn())" method="POST">
	New Username: <input type="text" name="user_name" placeholder="UserName" autofocus /><br />
	Your First Name: <input type="text" name="first_name" placeholder="First"/><br />
	Your Last Name: <input type="text" name="last_name" placeholder="Last" /><br />
	New Password: <input type="password" name="password1" /><br />
	New Password (again): <input type="password" name="password2" /><br />
	Email: <input type="text" name="email" value="<?php echo $_SESSION["prof_email"]?>"><br />
	<input type="submit" value="Submit" />
</form>
