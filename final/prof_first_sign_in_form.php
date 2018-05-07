
<h2>Please Fill out the form to finalize and save your account</h2><hr>
<form name="first_sign_in_form" action="prof_first_sign_in_response.php" onsubmit="return(validateFirstSignIn())" method="POST" enctype="multipart/form-data">
	New Username: <input type="text" name="user_name" placeholder="UserName" autofocus /><br />
	Your First Name: <input type="text" name="first_name" placeholder="First"/><br />
	Your Last Name: <input type="text" name="last_name" placeholder="Last" /><br />
	New Password: <input type="password" name="password1" /><br />
	New Password (again): <input type="password" name="password2" /><br />
	Email: <input type="text" name="email" value="<?php echo $_SESSION["prof_email"]?>"><br />
	Profile Image:<input type="file" id="profile" name="profile"/><br/>
	What is your role in the Biology Lab? 
	<textarea name="summary" placeholder="Please describe your role in the Biology Lab here in one paragraph or less. Keep in mind formating will not keep."></textarea></br>
	<input type="submit" value="Submit" />
</form>
