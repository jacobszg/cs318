<?php
	$page_title="A Prof Page";
	$banner_id="banner_none";
	$banner_writing="<h1>A Prof Page</h1>";
	include_once "html_top.html"; 
?>

<main>

	<h2>Add Equipment Information</h2>
	<form action="prof_equipment_response.php"  method="POST">
		Equipment Name: <input type="text" name="name" /><br/>
		Equipment Summary: <textarea name="summary" placeholder="Please describe Equipment here."></textarea></br>
		Optional PDF file: <input type="file" id="equipment_file" name="pdf_file"/><br/>
	    <input type="submit" value="Register"/>
	</form>
	
</main>

<?php include_once "html_bottom.html"; ?>