function load_action_for_form_unite(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_unite";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_unite";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
	} 
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_unite";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
	}
	
	if ((mode_parms == "visual") || (mode_parms == "delete")) {
		make_form_readonly(document.getElementById("unite_form"));
	}
}

function load_unite_for_form_unite(parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var unite = JSON.parse(xhr.responseText);
				if (unite.length == 1) {
					document.getElementById("id_unite").value = unite[0].id_unite;
					document.getElementById("libelle_fr").value = unite[0].libelle_fr;
					document.getElementById("libelle_en").value = unite[0].libelle_en;
				}
				else {
					alert("L'unité recherchée n'a pas été trouvée");
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
	xhr.send("action=get_unites&id_unite=" + urlParams.get("id_unite"));
}


function load_form_unite(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				load_action_for_form_unite(mode_parms);

				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
					load_unite_for_form_unite(parms);
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
	xhr.send("page=form_" + mode_parms + "_unite");
}


function save_unite() {
	if (document.getElementById("unite_form").checkValidity() == true) {
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
		xhr.send(serializeForm(document.getElementById("unite_form")));
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}