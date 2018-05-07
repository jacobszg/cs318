<?php
	$page_title="Events";
	$banner_id="banner_events";
	$banner_writing="<h2>Events</h2>
			<p>\"Good fortune is what happens when opportunity meets with planning.\"</p>
            <p class=\"quoted_person\">-Thomas Edison</p>";
	include_once "html_top.html"; 
?>

<main>
	<h1 class="main_title">Events</h1>
	<h1 class="under_banner_title">Upcoming Events</h1>
	<?php include_once "body_events.php";?>
</main>

<?php include_once "html_bottom.html"; ?>