//HAMBURGER MENU TOGGLE GRAPHIC (Stacked to X to Stacked again)
function change_toggle(x) {
	x.classList.toggle("change");

}

//DROP DOWN MENU
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function drop_toggle() {
	document.getElementById("peekaboo_nav_list").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
	if (event.target.matches('.hamburger_icon')) {
		if (document.getElementsByClassName("peekaboo_content").style.display = "none") {
			document.getElementsByClassName("peekaboo_content").style.display = "block";
		} else {
			document.getElementsByClassName("peekaboo_content").style.display = "none";
		}
	} else if (!event.target.matches('.hamburger_icon')) {
		var dropdowns = document.getElementsByClassName("peekaboo-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			}
		}
	}
}

function validateLogin() {
    var x = document.forms["login"]["user_name"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}

function disableEquipmentFile() {
    var x = document.getElementById("equipment_file");
    x.disabled = true;
}
