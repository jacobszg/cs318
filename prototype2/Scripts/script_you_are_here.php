<?php
	$file_name = ($_SERVER['PHP_SELF']);
	if (strpos($file_name, "bmbr_home.php")){
			echo "<a href=\"bmbr_home.php\">
                <span id=\"you_are_here\">Home</span>
            </a>
            <a href=\"bmbr_events.php\">Events</a>
            <a href=\"bmbr_professors.php\">Professors</a>
            <a href=\"bmbr_researcher_hub.php\"> Researcher Hub </a>
            <a href=\"bmbr_faq.php\">FAQ</a>";
	}elseif (strpos($file_name, "bmbr_events.php")){
		 echo "<a href=\"bmbr_home.php\"> Home </a>
		 <a href=\"bmbr_events.php\">
                <span id=\"you_are_here\">Events</span>
            </a>
            <a href=\"bmbr_professors.php\">Professors</a>
             <a href=\"bmbr_researcher_hub.php\">Researcher Hub</a>
            <a href=\"bmbr_faq.php\">FAQ</a>";
	}elseif (strpos($file_name, "bmbr_professors.php")){
			echo "<a href=\"bmbr_home.php\"> Home </a>
            <a href=\"bmbr_events.php\">Events</a>
            <a href=\"bmbr_professors.php\">
                <span id=\"you_are_here\">Professors</span>
            </a>
			<a href=\"bmbr_researcher_hub.php\">Researcher Hub</a>
            <a href=\"bmbr_faq.php\">FAQ</a>";
	}elseif (strpos($file_name, "bmbr_researcher_hub.php")){
			echo "<a href=\"bmbr_home.php\"> Home </a>
            <a href=\"bmbr_events.php\">Events</a>
            <a href=\"bmbr_professors.php\">Professors</a>
            <a href=\"bmbr_researcher_hub.php\">
                <span id=\"you_are_here\">Researcher Hub</span>
            </a>
            <a href=\"bmbr_faq.php\">FAQ</a>";
	}elseif (strpos($file_name, "bmbr_faq.php")){
			echo "<a href=\"bmbr_home.php\"> Home </a>
            <a href=\"bmbr_events.php\">Events</a>
            <a href=\"bmbr_professors.php\">Professors</a>
            <a href=\"bmbr_researcher_hub.php\">Researcher-Hub</a>
			<a href=\"bmbr_faq.php\">
                <span id=\"you_are_here\">FAQ</span>
            </a>";
	}else{
		echo "<a href=\"bmbr_home.php\"> Home </a>
            <a href=\"bmbr_events.php\">Events</a>
            <a href=\"bmbr_professors.php\">Professors</a>
            <a href=\"bmbr_researcher_hub.php\">Researcher-Hub</a>
			<a href=\"bmbr_faq.php\">FAQ</a>";
	}
?>