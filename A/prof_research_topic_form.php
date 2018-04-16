<?php
	$page_title="A Prof Page";
	$banner_id="banner_none";
	$banner_writing="<h1>A Prof Page</h1>";
	include_once "html_top.html"; 
?>
<main>

	<h2>Add Research Topic Information</h2>
	<form action="prof_research_topic_response.php" method="POST">
		Research Topic Title: <input type="text" name="name" /><br/>
		Tag Image: <input type="file" id="research_topic_image" name="img_file"/><br/>
		Research Topic Summary: <textarea name="summary" placeholder="Please describe Research Topic here."></textarea></br>
		Optional PDF file: <input type="file" id="research_topic_file" name="pdf_file"/><br/>
	    <input type="submit" value="Submit"/>
	</form>

</main>

<?php 
	include_once "html_bottom.html";
?>