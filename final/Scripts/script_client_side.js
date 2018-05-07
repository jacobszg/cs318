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
// END MENU GRAPHICS ///////////////////////////////////////////////////////////////////////

//START FORM VALIDATION FUNCTIONS ON CLIENT SIDE ///////////////////////////////////////////////


function validateLogin() {
    var name = document.forms["login"]["user_name"].value;
	var pass = document.forms["login"]["password"].value;
    if (name == "") {
        alert("Username must be filled out");
        return false;
    }else if (pass == "") {
        alert("Password must be filled out");
        return false;
    }else{
		return true;
	}
}

function validateResearchTopic() {
    var name = document.forms["addTopic"]["name"].value;

	var name = document.forms["addTopic"]["summary"].value;

    if (name == "") {
        alert("Topic Title must be filled out");
        return false;
    }else if (summary == "") {
        alert("Summary must be filled out");
        return false;
    }else{
		return true;
	}
}

function validateRequest() {
    var name = document.forms["request_account"]["name"].value;
	var email = document.forms["request_account"]["email"].value;
    if (name == "") {
        alert("Username must be filled out");
        return false;
    }else if (email == "") {
        alert("Email must be filled out");
        return false;
    }else{
		return true;
	}
}

function validateFirstSignIn(){
	var firstName = document.forms["first_sign_in_form"]["first_name"].value;
	var lastName = document.forms["first_sign_in_form"]["last_name"].value;
	var userName = document.forms["first_sign_in_form"]["user_name"].value;
	var pass1 = document.forms["first_sign_in_form"]["password1"].value;
	var pass2 = document.forms["first_sign_in_form"]["password2"].value;
	var email = document.forms["first_sign_in_form"]["email"].value;
	var profile = document.forms["first_sign_in_form"]["profile"].value;
	var summary	= document.forms["first_sign_in_form"]["summary"].value;
	if (userName == "") {
		alert("Username name must be filled out");
		return false;
	}else if (firstName == "") {
		alert("First name must be filled out");
		return false;
	}else if (lastName == "") {
		alert("Last name must be filled out");
		return false;
	}else if (pass1 == "") {
		alert("Password must be filled out");
		return false;
	}else if(pass1.localeCompare(pass2) != 0){
		alert("Passwords must match eachother");
		return false;
	}else if (email == "") {
		alert("Email must be filled out");
		return false;
	}else if (profile == "") {
		alert("Profile photo must be selected");
		return false;
	}else if (summary == "") {
		alert("Tell us about yourself summary must be filled out");
		return false;
	}else{
		return true;
	}
	
}

function disableEquipmentFile() {
    var x = document.getElementById("equipment_file");
    x.disabled = true;
}




function confirmDelete(){
	
	return confirm('Are you sure you wish to delete your account? The material you posted will be deleted, you will no longer appear on the BMBR Professors page, and you will loose access to the Professor Hub.');
	
}
function okToDeleteResource(){
	
	return confirm('Ok to delete checked items?');
	
}




// END FORM VALIDATION//////////////////////////////////////////////////////////////////////////