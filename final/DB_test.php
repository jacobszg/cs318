<?php
	$page_title="DB_TEST";
	$banner_id="banner_none";
	$banner_writing="<h1>TESTING A DATABASE</h1>";
	include_once "html_top.html"; 
?>
<main>
<?php

	include_once "dao.php";
	try{
	
		$database = new Connection();
		$db = $database->openConnection();
		
		$ourQuery = "select * from bmbr_professors";
		$result = $db->query($ourQuery); 
		
		foreach ($result as $row){
			echo $row["prof_last_name"];
		}
	}catch (PDOException $e){
		
		echo $e->getMessage();	
		
	}

?>
</main>
<?php include_once "html_bottom.html"; ?>