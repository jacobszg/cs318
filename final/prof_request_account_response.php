<?php
	$page_title="Prof-Login";
	$banner_id="banner_none";
	$banner_writing="<h1>Professor Login</h1>";
	include_once "html_top.html"; 
?>

<main>
<?php

	$name=$_POST["name"];
	$email=$_POST["email"];
	
	if (no_special_char($name) && valid_email($email)){
		
		if(addTempProf()){
			echo "<h1 style=\"color:white\">Request Sent.</h1><p style=\"font-size:16pt\">Please contact the current <a style=\"color:white\" href=\"bmbr_professors.php\">faculty members</a> with any further questions.</p>"; 
		}else{
			
			echo "Request Not Processed"; //this should never fire
			
		}
		
	}else{
		echo "<h2>Ask for a Professor Account</h2>
			<div class=\"error\"
				<p>Please enter your name and UWEC email below to request a professor account.</p> 
				<form name=\"request_account\" action=\"prof_request_account_response.php\" onsubmit=\"return(validateRequest())\" method=\"POST\">
					Name: <input type=\"text\" name=\"name\" placeholder=\"Full Name\" autofocus /><br/>
					UWEC email: <input type=\"text\" name=\"email\" placeholder=\"  UWEC email \"/><br/>
					<input type=\"submit\" value=\"Request an Account\" />
				</form>
			</div>";
	}
	
?>

</main>

<?php include_once "html_bottom.html"; ?>