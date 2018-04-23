<?php
	$page_title="A Prof Page";
	$banner_id="banner_none";
	$banner_writing="<h1>A Prof Page</h1>";
	include_once "html_top.html"; 
?>

<main>

	<h2>Add Procedure Information</h2>
	<form action="prof_procedure_response.php" method="POST">
		Procedure Name: <input type="text" name="name" /><br/>
		Procedure Summary: <textarea name="summary" placeholder="Please describe Procedure here. (Optional)"></textarea></br>
		Optional PDF file: <input type="file" id="procedure_file" name="pdf_file"/><br/>
	    <input type="submit" value="Submit"/>
	</form>
	
</main>

<?php include_once "html_bottom.html"; ?>