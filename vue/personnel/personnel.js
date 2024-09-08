function load_action_for_form_personnel(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_personnel";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_personnel";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
	} 
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_personnel";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
	}
	
	if ((mode_parms == "visual") || (mode_parms == "delete")) {
		make_form_readonly(document.getElementById("personnel_form"));
	}
}

function load_personnel_for_form_personnel(parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var personnel = JSON.parse(xhr.responseText);
				if (personnel.length == 1) {
					document.getElementById("id_personnel").value = personnel[0].id_personnel;
					document.getElementById("matricule_personnel").value = personnel[0].matricule;
					document.getElementById("nom_prenom_personnel").value = personnel[0].nom_prenom;
				}
				else {
					alert("Le personnel recherché n'a pas été trouvé");
				}
			}
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	const urlParams = new URLSearchParams(parms);
	xhr.send("action=get_personnels&id_personnel=" + urlParams.get("id_personnel"));
}


function load_form_personnel(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				load_action_for_form_personnel(mode_parms);

				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
					load_personnel_for_form_personnel(parms);
				}
				// document.getElementById('mydialog').showModal();
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_" + mode_parms + "_personnel");
}


function save_personnel() {
	if (document.getElementById("personnel_form").checkValidity() == true) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					if (xhr.responseText == "1") {
						alert("Opération effectuée avec succès");
					}
					else {
						alert(xhr.responseText);
					}
				}
				catch (e) {
				  alert("Parsing error:"+e); 
				}
			}
		}
		
		xhr.open("POST", "index.php");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(serializeForm(document.getElementById("personnel_form")));
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}