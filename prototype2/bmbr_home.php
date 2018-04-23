<?php
	$page_title="Welcome";
	$banner_id="banner_home";
	$banner_writing=
			"<h2>Welcome!</h2>
			<p>\"Everything is theoretically impossible, until it is done.\"</p>
            <p class=\"quoted_person\">-Robert A. Heinlein</p>";
	include_once "html_top.html"; 
?>

<main>
	<h1 class="main_title" id="home_title">Research Topics</h1>
		

	<?php include_once "list_research_topics.php";?>

</main>

<?php include_once "html_bottom.html"; ?>