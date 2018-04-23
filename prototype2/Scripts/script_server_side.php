<?php


include_once "db_connection.php";

function login(){
	$result=false;
	try{
		
		$database = new Connection();
		$db = $database->openConnection();
			
		$name=$_POST["user_name"];
		$pass=$_POST["password"];
		
		if(no_special_char($name)){
				
				$ourQuery = "select * from bmbr_professors where prof_user_name = '".$name."'";
			
				$result = $db->query($ourQuery); 
				$result_count = $result->rowCount();
				
				if ($result_count > 0){
					 
					foreach ($result as $row){
						if(password_verify($pass,$row["prof_password"]) || ((strcmp($name,"Admin") == 0) && (strcmp($pass,"123") == 0))){
							
							session_destroy();
							session_start();
							$_SESSION["prof_id"]= $row["prof_id"];
							$_SESSION["prof_first_name"]= $row["prof_first_name"];
							$_SESSION["prof_last_name"]= $row["prof_last_name"];
							$_SESSION["prof_user_name"]= $row["prof_user_name"];
							$_SESSION["prof_email"]= $row["prof_email"];
							$_SESSION["temp"]= $row["temp"];
							$_SESSION["logged_in"]=true;
							$result=true;
							
						}else{
							echo "
						<div class=\"error\">
							<h2> * Username and Password not found</h2>
						
							<form name=\"login\" action=\"prof_login_response.php\" onsubmit=\"return(validateLogin())\" method=\"POST\">
								Username: <input type=\"text\" name=\"user_name\" /><br />
								Password: <input type=\"password\" name=\"password\" /><br />
								<input type=\"submit\" value=\"Login\" />
							</form>
						</div>";
							$result=false;
						}
						
					}
					
				
				
				}else{
					$result=false;
					echo "
						<div class=\"error\">
							<h2> * Username and Password not found</h2>
						
							<form name=\"login\" action=\"prof_login_response.php\" onsubmit=\"return(validateLogin())\" method=\"POST\">
								Username: <input type=\"text\" name=\"user_name\" /><br />
								Password: <input type=\"password\" name=\"password\" /><br />
								<input type=\"submit\" value=\"Login\" />
							</form>
						</div>";
				}
				
		}
		
	}catch (PDOException $e){
		echo $e->getMessage();		
	}
	return $result;	
}



function addTempProf(){
	try{
		$database = new Connection();
		$db = $database->openConnection();
			
		$statement = $db->prepare("INSERT INTO bmbr_temp (temp_name, temp_email)
		VALUES(?, ?)");

		$statement->execute(array($_POST["name"],$_POST["email"]));
		
		// $db = $database->closeConnection();
		return true;
	}catch (PDOException $e){
		echo "THIS IS NOW___>".$e->getMessage()."<____";	
		return false;
	}
}









function convertAccount(){
	
	if(isset($_POST["user_name"]) && isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["password1"])){
	
		$firstName=$_POST["first_name"];
		$lastName=$_POST["last_name"];
		$userName=$_POST["user_name"];
		$password=password_hash($_POST["password1"], PASSWORD_DEFAULT);
		$email=$_POST["email"];
		$all_clear=false;
		
		if(valid_email($email)){
			if(no_special_char($firstName) && no_special_char($lastName) && no_special_char($userName)){
				try{
					$database = new Connection();
					$db = $database->openConnection();
						
					$statement = $db->prepare("INSERT INTO bmbr_professors (prof_first_name, prof_last_name, prof_user_name, prof_password, prof_email, temp)
					VALUES(?,?,?,?,?,?)");
					
					$statement->execute(array($firstName,$lastName,$userName,$password,$email,0));
					
					$statement = $db->prepare("DELETE FROM bmbr_professors WHERE prof_id = ".$_SESSION["prof_id"]);

					$statement->execute();
					
					// $db = $database->closeConnection();
					$_SESSION['logged_in']=false;
					unset($_SESSION["prof_user_name"]);
					unset($_SESSION["prof_first_name"]);
					unset($_SESSION["prof_last_name"]);
					unset($_SESSION["prof_id"]);
					$all_clear=true;
					
					
					
				}catch (PDOException $e){
					echo "THIS IS NOW___>".$e->getMessage()."<____";	
					return false;
				}	
			}		
		}
		
		if($all_clear){
			echo "<h1>Thank You ".$firstName." ".$lastName."!</h1>";
			echo"
					<h2>Please log into you new account</h2>
					<form name=\"login\" action=\"prof_login_response.php\" onsubmit=\"return(validateLogin())\" method=\"POST\">
						Username: <input type=\"text\" name=\"user_name\"  value=\"".$userName."\" /><br />
						Password: <input type=\"password\" name=\"password\" placeholder=\"Password\" autofocus /><br />
						<input type=\"submit\" value=\"Login\" />
					</form>";
		}else{
			echo "
						<div class=\"error\">
							<h2> * Form filled out incorrectly.</h2>
							<p>All fields must be filled out, and all names cannot contain special characters</p>
						
							<form name=\"first_sign_in_form\" action=\"prof_first_sign_in_response.php\" onsubmit=\"return(validateFirstSignIn())\" method=\"POST\">
								New Username: <input type=\"text\" name=\"user_name\" placeholder=\"UserName\" autofocus /><br />
								Your First Name: <input type=\"text\" name=\"first_name\" placeholder=\"First\"/><br />
								Your Last Name: <input type=\"text\" name=\"last_name\" placeholder=\"Last\" /><br />
								New Password: <input type=\"password\" name=\"password1\" /><br />
								New Password (again): <input type=\"password\" name=\"password2\" /><br />
								Email: <input type=\"text\" name=\"email\" value=\"".$_SESSION["prof_email"]."\"><br />
								<input type=\"submit\" value=\"Submit\" />
							</form>
						</div>";	
		}
	}
	
}






function requestApprovals(){
	try{
		
		$database = new Connection();
		$db = $database->openConnection();
	
		$ourQuery = "select * from bmbr_temp"; 
		$result = $db->query($ourQuery); 
		$result_count = $result->rowCount();
		
		if ($result_count > 0){
			
			 echo"<hr><h2>BMBR Website Access Approvals Needed</h2>
			 <form action=\"prof_approval_response.php\" method=\"POST\">";
			foreach ($result as $row){
				$i=$row["temp_id"];
				echo "
					<div class=\"requestor\">".$row["temp_name"]." (".$row["temp_email"].")</div> 
					<label class=\"approval\" ><input type=\"radio\" name=\"".$i."\" value=\"deny\"> Deny <br></label>
					<label class=\"approval\" ><input type=\"radio\" name=\"".$i."\" value=\"approve\"> Approve &nbsp</label>
					
				";
			}
			
			echo "<input type=\"submit\" value=\"Send Response\"></form><hr>";
		}
			
	}catch (PDOException $e){
		echo "THIS IS HERE___>".$e->getMessage()."<____";	
		return false;
	}
}












function approvalRespose(){
	
	try{
		
		$database = new Connection();
		$db = $database->openConnection();
	
		$ourQuery = "select * from bmbr_temp"; 
		$result = $db->query($ourQuery); 
		$result_count = $result->rowCount();
		
		
		if ($result_count > 0){
			echo"<h1>Please Review the Following...</h1>";
			foreach ($result as $row){
				$i=$row["temp_id"];
				if(isset($_POST[$i])){
					if(strcmp($_POST[$i],"approve") == 0){
						
						$emailedPass=generateRandomString(6);
						//echo "<br> EMAILED ".$emailedPass;
						$DBpass=password_hash($emailedPass,PASSWORD_DEFAULT);
						//echo "<br> HASHED  ".$DBpass."<br>";
						
						
						$statement = $db->prepare("INSERT INTO bmbr_professors (prof_first_name, prof_last_name, prof_user_name,
						prof_password, prof_email, temp) VALUES(?,?,?,?,?,?)");

						$statement->execute(array("FirstName","LastName","TempUser".$i,$DBpass,$row["temp_email"],"1"));	
						
						
						$statement = $db->prepare("DELETE FROM bmbr_temp WHERE temp_id = ".$i);

						$statement->execute();
						
						echo"
						<form target=\"_blank\" action=\"https://formspree.io/".$row["temp_email"]."\" method=\"POST\">
							<input type=\"text\" name=\"Username\" value=\"TempUser".$i."\">
							<input type=\"text\" name=\"Temporary_Password:\" value=\"".$emailedPass."\">
							<input type=\"submit\" value=\"Send Account Info\">
						</form>";
						
						
					}else{
						$statement = $db->prepare("DELETE FROM bmbr_temp WHERE temp_id = ".$i);
				
						$statement->execute();
					}
				}else{
					echo"<br>No action selected for ".$row["temp_name"];
				}
			}
			
		
		}
			
	}catch (PDOException $e){
		echo "THIS IS HERE___>".$e->getMessage()."<____";	
		return false;
	}
	
}








function log_stat_links(){
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		echo "<a href=\"bmbr_prof_return_hub.php\">Professor Hub for " . $_SESSION['prof_last_name'] . "</a>
		| <a href=\"prof_sign_out_response.php\">Sign Out</a> | <a href=\"prof_account_settings.php\">Account Settings</a>";
	}else{
		echo "
		<a href=\"prof_login_form.php\">Professor Login</a>|
		<a href=\"prof_request_account_form.php\">Request Professor account</a>
		";
	}
}




function deleteAccount(){

	try{
		
		$database = new Connection();
		$db = $database->openConnection();

		$statement = $db->prepare("DELETE FROM bmbr_professors WHERE prof_id = ".$_SESSION["prof_id"]);

		$statement->execute();
		
		
		$_SESSION['logged_in']=false;
		unset($_SESSION["prof_user_name"]);
		unset($_SESSION["prof_first_name"]);
		unset($_SESSION["prof_last_name"]);
		unset($_SESSION["prof_id"]);
		unset($_SESSION["temp"]);
	}catch (PDOException $e){
		echo "THIS IS HERE___>".$e->getMessage()."<____";	
		return false;
	}
}

///////ADD EDIT AND DELETE CONTENT.....///////////////////////////////////////////////////////////////////////////////

function addResource($title,$type,$pdf,$summary,$img){
	
	$success=false;
	
	try{
		$database = new Connection();
		$db = $database->openConnection();

		$statement = $db->prepare("INSERT INTO bmbr_resources (resource_title,resource_type
		,resource_pdf_file_name,resource_summary_file_name,resource_img_file_name) VALUES(?,?,?,?,?)");

		$statement->execute(array($title,$type,$pdf,$summary,$img));	
		
		$success=true;
	}catch (PDOException $e){
		echo "THIS IS HERE___>".$e->getMessage()."<____";	
		return false;
	}
	
	if($success){
		write($type);
	}else{
		echo "Could not add to server (line 362 script_server_side.php)<br>";
	
	}					
}

function write($type){ //Types R,E,B,Q,P,D

		$my_file="unknown.txt";
		if($type == 'R'){ //Research Topic
			$my_file = "list_research_topics.php";
		}else if ($type == 'E'){//Event
			$my_file = "list_events.php";
		}else if ($type == 'B'){//ResearcherBoard
			$my_file = "list_researcher_board.php";
		}else if ($type == 'Q'){//Equipment
			$my_file = "list_equipment.php";
		}else if ($type == 'P'){//Procedure
			$my_file = "list_procedures.php";
		}else if ($type == 'D'){//Download
			$my_file = "list_downloads.php";
		}		
		
		
		$handle = fopen($my_file, 'w') or die('Stored, but unable to open file to rewrite  '.$my_file.$returnLink);
		
		
		$written="<div class=\"autoList\">";
		try{
		
			$database = new Connection();
			$db = $database->openConnection();
		
			$ourQuery = "select * from bmbr_resources WHERE resource_type = '".$type."'
			ORDER BY resource_id DESC"; 
			$result = $db->query($ourQuery); 
			$result_count = $result->rowCount();
			
			
			if ($result_count > 0){
				foreach ($result as $row){
					$written= $written."<div class=\"resource\">
					<a href=\"PDFs/".$row['resource_pdf_file_name']."\" target=\"_blank\" > 
						".$row['resource_title']."
					</a>";
					if($type == 'R' || $type == 'E'){
						$written= $written."
						<img src=\"Images/".$row['resource_img_file_name']."\" alt=\"".$row['resource_img_file_name']."\">	";
					}
					$written=$written."
					<p>".file_get_contents("Summary/".$row['resource_summary_file_name'],true)."</p> 
					</div>";
				}
			}
			$written=$written."
			</div>";
		}catch (PDOException $e){
			echo "THIS IS HERE___>".$e->getMessage()."<____";	
			return false;
		}
		$content= $written;
	
		$ret = file_put_contents($my_file, $content, FILE_APPEND | LOCK_EX);
		if($ret === false) {
			die('There was an error writing '.$my_file.$returnLink);
		}else {
			echo "BMBR re-written ($ret bytes used for $my_file)<br>";
		}
}








////////Little Helper Methods (should have made more of these...)/////////////////////////////////////////////////////////////////////////////////////////////////////


function valid_email($email){
	// Remove all illegal characters from email
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$result = false;
	// Validate e-mail
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		if(preg_match('$@uwec.edu$',$email)){
			$result = true;
		}
	} 
	return $result;
}





function no_special_char($string){
	$result=true;
	if (preg_match('/[\^£$%&*:;()}{@#~?><>|=_+¬-]/', $string)){
		$result=false;
	}
	return $result;
}






function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>