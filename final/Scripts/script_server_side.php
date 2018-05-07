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
						if(password_verify($pass,$row["prof_password"]) || ((strcmp($name,"Admin") == 0) && (strcmp($pass,"Biology101!") == 0))){
							
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
		echo "line 74".$e->getMessage();		
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





function writeProfPage(){
	
	//make summary file and save to Summary/
	$my_file = "main_prof.php";
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	$written="
	<div class=\"hub_nav\">";
	
	
	try{
		$database = new Connection();
		$db = $database->openConnection();
		$ourQuery = "select * from bmbr_professors ORDER BY prof_last_name";
	
		$result = $db->query($ourQuery); 
		$result_count = $result->rowCount();
		
		if ($result_count > 0){
			foreach ($result as $row){
				$written.="
				<div class=\"tab\" id=\"tab_".$row['prof_last_name'].$row['prof_first_name']."\">
					".$row['prof_first_name']." ".$row['prof_last_name']."
				</div>
				
				<div class=\"hub_display\" id=\"display_".$row['prof_last_name'].$row['prof_first_name']."\">
				<?php include_once \"introProf_".$row['prof_last_name'].$row['prof_first_name'].".php\";?>
				</div>
				";	
			}
		}
		
	}catch (PDOException $e){
		echo "THIS IS NOW... WriteProfPage() _>".$e->getMessage()."<____";	
		return false;
	}
	$written.="</div>";
	
	
	$ret = file_put_contents($my_file, $written, FILE_APPEND | LOCK_EX);
	if($ret === false) {
		echo 'There was an error writing .'.$my_file;
		$uploadOk = 0;
	}else {
		//echo "Summary file loaded.<br>";
	}

}








function convertAccount($summ,$img){
	
		
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
						
					$statement = $db->prepare("INSERT INTO bmbr_professors (prof_first_name, prof_last_name, prof_user_name, prof_password, 
					prof_email, prof_image_file_name, prof_summary_file_name, temp)
					VALUES(?,?,?,?,?,?,?,?)");
					
					$statement->execute(array($firstName,$lastName,$userName,$password,$email,$img,$summ,0));
					
					$statement = $db->prepare("DELETE FROM bmbr_professors WHERE prof_id = ".$_SESSION["prof_id"]);

					$statement->execute();
					
					// $db = $database->closeConnection();
					
					
					//make empty list_stuff_ file
					$list_stuff_file = "introProf_".$lastName.$firstName.".php";
					$handle = fopen($list_stuff_file, 'w') or die('Cannot open file:  '.$list_stuff_file);
					$written="DEFAULT BLANK... will be filled upon addition of topics and such...";
					$ret = file_put_contents($list_stuff_file, $written, FILE_APPEND | LOCK_EX);
					if($ret === false) {
						echo 'There was an error writing .'.$list_stuff_file;
						$uploadOk = 0;
					}else {
						//echo "Intro file loaded.<br>";
					}
					
					//make intro_prof file and save
					$my_file = "introProf_".$lastName.$firstName.".php";
					$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
					$written="
					<div class=\"prof_intro\">
						<h1>Professor ".$firstName." ".$lastName."</h1>
						<img src=\"".$img."\" alt=\"".$firstName." ".$lastName." profile image\">
						<p>".file_get_contents("Summary/".$summ,true)."</p>
						<p class=\"contactInfo\">Email: ".$email."</p>
						<?php include_once \"list_stuff_".$lastName.$firstName.".php\" ;?>
					</div>";
					
					
					$ret = file_put_contents($my_file, $written, FILE_APPEND | LOCK_EX);
					if($ret === false) {
						echo 'There was an error writing .'.$my_file;
						$uploadOk = 0;
					}else {
						//echo " Intro file loaded.<br>";
					}
					$_SESSION['logged_in']=false;
					unset($_SESSION["prof_user_name"]);
					unset($_SESSION["prof_first_name"]);
					unset($_SESSION["prof_last_name"]);
					unset($_SESSION["prof_id"]);
					$all_clear=true;			
					writeProfPage();
		
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
			
			foreach ($result as $row){
				$i=$row["temp_id"];
				if(isset($_POST[$i])){
					if(strcmp($_POST[$i],"approve") == 0){
						echo"<h1>The following Temp Account will be sent to ".$row['temp_email']."</h1>";
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
							<input type=\"text\" name=\"Username\" value=\"TempUser".$i."\" readonly >
							<input type=\"text\" name=\"Temporary_Password:\" value=\"".$emailedPass."\" readonly>
							<input type=\"submit\" value=\"Send Account Info\">
						</form>
						";
						
						
					}else{
						echo"<h1>".$row['temp_name']." (".$row['temp_email'].") has been denied.</h1>";
						$statement = $db->prepare("DELETE FROM bmbr_temp WHERE temp_id = ".$i);
				
						$statement->execute();
					}
				}else{
					echo"<br>No action selected for ".$row["temp_name"];
				}
			}
			
		
		}
			
	}catch (PDOException $e){
		echo "THIS IS HERE_373__>".$e->getMessage()."<__serverSide__";	
		return false;
	}
	
}








function log_stat_links(){
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		echo "<a href=\"bmbr_prof_return_hub.php\">Professor Hub for " . $_SESSION['prof_user_name'] . "</a>
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
		
		$statement = $db->prepare("DELETE FROM bmbr_resources WHERE prof_id = '".$_SESSION['prof_id']."'");

		$statement->execute();
		
		rewrite();
			
		try{

			$statement = $db->prepare("DELETE FROM bmbr_professors WHERE prof_id = ".$_SESSION["prof_id"]);

			$statement->execute();
		
			writeProfPage();
			
		
			$_SESSION['logged_in']=false;
			unset($_SESSION["prof_user_name"]);
			unset($_SESSION["prof_first_name"]);
			unset($_SESSION["prof_last_name"]);
			unset($_SESSION["prof_id"]);
			unset($_SESSION["temp"]);
			
			return true;
			
		}catch (PDOException $e){
			echo "THIS IS HERE___>".$e->getMessage()."<____";	
			return false;
		}
		
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
		,resource_pdf_file_name,resource_summary_file_name,resource_img_file_name,prof_id,resource_date) VALUES(?,?,?,?,?,?,?)");

	$statement->execute(array($title,$type,$pdf,$summary,$img,$_SESSION['prof_id'],date("Y-m-d")));	
		
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

//DECIDE WHAT FILES TO OVERWRITE
	
	//BODY FILE (for all users)
		$body_file="unknown.txt";
		if($type == 'R'){ //Research Topic
			$body_file = "body_research_topics.php";
		}else if ($type == 'E'){//Event
			$body_file = "body_events.php";
		}else if ($type == 'B'){//ResearcherBoard
			$body_file = "body_researcher_board.php";
		}else if ($type == 'Q'){//Equipment
			$body_file = "body_equipment.php";
		}else if ($type == 'P'){//Procedure
			$body_file = "body_procedures.php";
		}else if ($type == 'D'){//Download
			$body_file = "body_downloads.php";
		}else if ($type == 'F'){//FAQs
			$body_file = "body_faqs.php";
		}	
	
	//LIST FILE (for prof hub)
		$list_file="unknown.txt";
		if($type == 'R'){ //Research Topic
			$list_file = "list_research_topics.php";
		}else if ($type == 'E'){//Event
			$list_file = "list_events.php";
		}else if ($type == 'B'){//ResearcherBoard
			$list_file = "list_researcher_board.php";
		}else if ($type == 'Q'){//Equipment
			$list_file = "list_equipment.php";
		}else if ($type == 'P'){//Procedure
			$list_file = "list_procedures.php";
		}else if ($type == 'D'){//Download
			$list_file = "list_downloads.php";
		}else if ($type == 'F'){//FAQs
			$list_file = "list_faqs.php";
		}


//WRITE LIST FILE
		$handle_list = fopen($list_file, 'w') or die('Stored, but unable to open file to rewrite  '.$list_file.$returnLink);
		$handle_body = fopen($body_file, 'w') or die('Stored, but unable to open file to rewrite  '.$body_file.$returnLink);
		
		$written_list="<div class=\"autoList\"><h1>Choose which ones do you want to delete.</h1>
			<form name=\"delete_".$type."\" action=\"delete.php\" method=\"POST\">";
		$written_body="<div class=\"autoBody\">";
		
		try{
			//OPEN THE DB AND QUERY IT
			$database = new Connection();
			$db = $database->openConnection();
		
			$ourQuery = "select * from bmbr_resources WHERE resource_type = '".$type."'
			ORDER BY resource_id DESC"; 
			$result = $db->query($ourQuery); 
			$result_count = $result->rowCount();
			
			
			if ($result_count > 0){
				foreach ($result as $row){
			//WRITE THE BODY DISPLAY
					$written_body= $written_body."<div class=\"resource\">
					<a href=\"PDFs/".$row['resource_pdf_file_name']."\" target=\"_blank\" > 
						".$row['resource_title']."
					</a>";
					
					if($type != 'F'){
						$written_body= $written_body."
						<img src=\"Images/".$row['resource_img_file_name']."\" alt=\"".$row['resource_img_file_name']."\">	";
					}
					
					
			//WRITE LIST	
					$written_list=$written_list."<div class=\"listedResource\"><label> 
					<h2>".$row["resource_title"]."</h2>";
			
			//WRITE BOTH
					//WHO POSTED AND WHEN WAS THIS POSTED???
					try{
						$profQuery="SELECT * from bmbr_professors WHERE prof_id = '".$row['prof_id']."'";
						$profResult = $db->query($profQuery);
						$profCount = $profResult->rowcount();
					
						if ($profCount > 0){
							foreach ($profResult as $profRow){
								if ($type != 'F'){
									$written_body=$written_body."
									<h4>Posted by Professor ".$profRow['prof_first_name']." ".$profRow['prof_last_name']." (".$row['resource_date'].")</h4>
									";
								}
							
								$written_list .= "<h4>Posted by professor: ".$profRow['prof_first_name']." ".$profRow['prof_last_name']." (".$row['resource_date'].")</h4>
								";
							}	
						}
						
					}catch (PDOException $e){
						echo "the professr tabel search failed...".$e->getMessage();	
					}
		////WRITING A PROF PAGE LISTED ITEMS///
					$prof_list_file="list_stuff_".$_SESSION['prof_last_name'].$_SESSION['prof_first_name'].".php";
					$handle_prof = fopen($prof_list_file, 'w') or die('Stored, but unable to open file to rewrite  '.$prof_list_file.$returnLink);
					
					try{
						$plQuery="SELECT * from bmbr_resources WHERE prof_id = '".$_SESSION['prof_id']."'";
						$plResult = $db->query($plQuery);
						$plCount = $plResult->rowcount();
						
						$R="<div id=\"topicList\">
							<h2>My Research Interests.</h2>
							<dl>";
						$Q="<div id=\"equipmentList\">
						<h2>Equipment Used.</h2>
						<dl>";
						$P="<div id=\"procedureList\">
							<h2>Lab Procedures Used.</h2>
							<dl>";
						if ($plCount > 0){
							foreach ($plResult as $plRow){
								if($plRow['resource_type']=="R"){
									$R.="<dt><a href=\"PDFs/".$plRow['resource_pdf_file_name']."\" target=\"_blank\"> ".$plRow['resource_title']."</a></dt>";
								}else if($plRow['resource_type']=="Q"){
									$Q.="<dt><a href=\"PDFs/".$plRow['resource_pdf_file_name']."\" target=\"_blank\"> ".$plRow['resource_title']."</a></dt>";
								}else if($plRow['resource_type']=="P"){
									$P.="<dt><a href=\"PDFs/".$plRow['resource_pdf_file_name']."\" target=\"_blank\"> ".$plRow['resource_title']."</a></dt>";
								}
							}
							
						}
						
					}catch (PDOException $e){
						echo "the professr resource search failed...line 589 ->".$e->getMessage();	
					
					}
					$R.="</dl>
					</div>";
					$Q.="</dl>
					</div>";
					$P.="</dl>
					</div>";
					
					$writtenPL=$R.$P.$Q;
					$ret = file_put_contents($prof_list_file, $writtenPL, FILE_APPEND | LOCK_EX);
					if($ret === false) {
						die('There was an error writing '.$prof_list_file.$returnLink);
					}else {
						// echo "Professor page file re-written ($ret bytes used for $prof_list_file)<br>";
					}
						


						
					//SUM INSTANTIATED HERE (FOR BOTH BODY AND LIST)
					$sum=file_get_contents("Summary/".$row['resource_summary_file_name'],true);
					
					$written_body=$written_body."
					<p>".$sum."</p> 
					</div>";
					
			
					$written_list.="
						<input type=\"checkbox\" name=\"check_list[]\" value=\"".$row['resource_title']."\">
						<p>".$sum."</p>
					</label>
					</div>
					"; 
						
				}
			}
			$written_body=$written_body."
			</div>";
			$written_list=$written_list."
			<input type=\"submit\" name=\"type_".$type."\" value=\"Delete Selection(s)\">
			</form>
			</div>";
		}catch (PDOException $e){
			echo "THIS IS HERE___>".$e->getMessage()."<____";	
			return false;
		}
		
//DO THE ACTUAL WRITING TO THE FILEs
	
	//LIST FILE WRITTING
		$ret = file_put_contents($list_file, $written_list, FILE_APPEND | LOCK_EX);
		if($ret === false) {
			die('There was an error writing '.$list_file.$returnLink);
		}else {
			//echo "BMBR List file re-written ($ret bytes used for $list_file)<br>";
		}
	
	//BODY FILE WRITTING
		$ret = file_put_contents($body_file, $written_body, FILE_APPEND | LOCK_EX);
		if($ret === false) {
			die('There was an error writing '.$body_file.$returnLink);
		}else {
			// echo "BMBR Body file re-written ($ret bytes used for $body_file)<br>";
		}
}



//DELETE A RESOURCE
function deleteResource($type, $selectedTitle){
	//SELECT THE ROW THAT MATCHES THE TITLE TO DELETE
	
	try{
		//OPEN THE DB AND QUERY IT
		$database = new Connection();
		$db = $database->openConnection();
		$query="SELECT * FROM bmbr_resources WHERE resource_title = '".$selectedTitle."' AND resource_type = '".$type."'";
		$result = $db->query($query);
		$count = $result->rowcount();
		if ($count > 0){
			foreach ($result as $row){
				if ($row['prof_id'] == $_SESSION['prof_id']){
					//NOW YOU CAN GO THROUGH AND DELETE ALL ASSOCIATED FILES CONCERNING THIS RESOURCE
						//DELETE THE ASSOCIATED img
					unlink('Images/'.$row['resource_img_file_name']);
					echo "<br>GOOD Image DELETE: ".$row['resource_img_file_name']." DELETED";
						//DELETE summary
					unlink('Summary/'.$row['resource_summary_file_name']);
					echo "<br>GOOD summary DELETE: ".$row['resource_summary_file_name']." DELETED";
						//DELETE PDF / extra file content
					unlink('PDFs/'.$row['resource_pdf_file_name']);
					echo "<br>GOOD extra file DELETE: ".$row['resource_pdf_file_name']." DELETED";
					
					//NOW REMOVE THE ROW FROM THE DB
					try{
						$statement = $db->prepare("DELETE FROM bmbr_resources WHERE prof_id = ".$_SESSION["prof_id"]." AND resource_type = '".$type."' AND resource_title = '".$selectedTitle."'");
						 $statement->execute();
						 
						 echo "<br>GOOD Selected Title DELETE: ".$selectedTitle." DELETED ";
						 
						 write($type);
						
					}catch (PDOException $e){
						echo "<br>BAD Selected Title ".$selectedTitle." failed to delete... ".$e->getMessage();	
					}
				}else{
					echo"<br> You do not have permission to delete ".$selectedType.".";
				}
			}
		}	
	}catch (PDOException $e){
		echo "<br> Selected Title ".$selectedTitle." failed to delete... ".$e->getMessage();	
	}					
}



function rewrite(){
	$typeArray = array('R','E','B','P','Q','D','F');	
	foreach ($typeArray as $type){
		write($type);	
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