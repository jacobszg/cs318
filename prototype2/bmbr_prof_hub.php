<?php include_once "Scripts/script_hub.html"?>

<?php 
if(isset($_SESSION["logged_in"]) && $_SESSION["temp"] == 0 ){
	requestApprovals();
	echo "<h1>Hello Professor ".$_SESSION["prof_last_name"]."!</h1>";
	echo"<div class=\"hub_nav\">
		<div class=\"tab\" id=\"tab_A\" tabindex=\"0\">
			Research Topics<a href=\"prof_add_research_topic_form.php\"> Add </a> <a href=\"prof__form.php\"> Remove </a> 
		</div>
		
		<div class=\"hub_display\" id=\"display_A\">
			";
		include_once "list_research_topics.php";
		
		echo"</div>
		
		<div class=\"tab\" id=\"tab_B\">
			Events <a href=\"prof_add_event_form.php\"> Add </a> <a href=\"prof__form.php\"> Remove </a> 
		</div>
		
		<div class=\"hub_display\" id=\"display_B\">
			";
		include_once "list_events.php";
		
		echo"
		</div>
		
		<div class=\"tab\" id=\"tab_C\">
			Bulletin Board Topics <a href=\"prof__form.php\"> Add </a> <a href=\"prof__form.php\"> Remove </a> 
		</div>
		
		<div class=\"hub_display\" id=\"display_C\">
			";
		include_once "list_researcher_board.php";
		
		echo"
		</div>
		
		<div class=\"tab\" id=\"tab_D\">
			Equipment<a href=\"prof__form.php\"> Add </a> <a href=\"prof__form.php\"> Remove </a> 
		</div>
		
		<div class=\"hub_display\" id=\"display_D\">
			";
		include_once "list_equipment.php";
		
		echo"
		</div>	
		
		<div class=\"tab\" id=\"tab_E\">
			Procedures<a href=\"prof__form.php\"> Add </a> <a href=\"prof__form.php\"> Remove </a> 
		</div>
		
		<div class=\"hub_display\" id=\"display_E\">
			";
		include_once "list_procedures.php";
		
		echo"
		</div>
		
		<div class=\"tab\" id=\"tab_F\">
			Downloads <a href=\"prof__form.php\"> Add </a> <a href=\"prof__form.php\"> Remove </a> 
		</div>
		
		<div class=\"hub_display\" id=\"display_G\">
			";
		include_once "list_downloads.php";
		
		echo"
		</div>
	</div>
";
	
}else{
	include_once "prof_first_sign_in_form.php";	
}

?>

 

<?php include_once "Scripts/script_hub.html"?> 

