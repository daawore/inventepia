function load_action_for_form_caracteristique(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_caracteristique";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_caracteristique";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
	} 
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_caracteristique";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
	}
	
	if ((mode_parms == "visual") || (mode_parms == "delete")) {
		make_form_readonly(document.getElementById("caracteristique_form"));
	}
}
function load_caracteristique_for_form_caracteristique(mode_parms, parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var caracteristique = JSON.parse(xhr.responseText);
				if (caracteristique.length == 1) {
					document.getElementById("id_caracteristique").value = caracteristique[0].id_caracteristique;
					document.getElementById("libelle_fr").value = caracteristique[0].libelle_fr;
					document.getElementById("abrev_fr").value = caracteristique[0].abrev_fr;
					document.getElementById("libelle_en").value = caracteristique[0].libelle_en;
					document.getElementById("abrev_en").value = caracteristique[0].abrev_en;
					document.getElementById("type").value = caracteristique[0].type;
					if (caracteristique[0].type == "singselect" || caracteristique[0].type == "multiselect") {
						load_modalites_for_form_caracteristique(mode_parms, parms);
					}
				}
				else {
					alert("La caractéristique recherchée n'a pas été trouvée");
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
	xhr.send("action=get_caracteristiques&id_caracteristique=" + urlParams.get("id_caracteristique"));
}
function load_modalites_for_form_caracteristique(mode_parms, parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var modalites = JSON.parse(xhr.responseText);
				if (modalites.length > 0) {
					for (var i = 0; i < modalites.length; i++) {
						add_new_modalite_for_form_modalite_caracteristique();
						document.getElementById('table_modalites_caracteristique').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#id_modalite").value = modalites[i].id_modalite;
						document.getElementById('table_modalites_caracteristique').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#libelle_fr_modalite").value = modalites[i].libelle_fr;
						document.getElementById('table_modalites_caracteristique').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#libelle_en_modalite").value = modalites[i].libelle_en;
					}
				}
				else {
					// alert("La caractéristique recherchée n'a pas été trouvée");
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
	xhr.send("action=get_modalites_caracteristiques&id_caracteristique=" + urlParams.get("id_caracteristique"));
}

function add_new_modalite_for_form_modalite_caracteristique() {
	var row = document.getElementById('table_modalites_caracteristique').getElementsByTagName("tbody").item(0).insertRow(-1);
	//Cellule pour l'ID
	cellule1 = row.insertCell(-1);
	cellule2 = row.insertCell(-1);
	cellule3 = row.insertCell(-1);

	cellule1.innerHTML = 
		'<div class="form-floating form-floating-sm row" style="padding:5px">' +
		'	<input id="id_modalite" name="id_modalite[]" type="hidden">' +
		'	<input class="form-control-sm col-12" placeholder="Modalité en français" id="libelle_fr_modalite" name="libelle_fr_modalite[]" type="text" />' +
		'</div>';
	cellule2.innerHTML = 
		'<div class="form-floating form-floating-sm row" style="padding:5px">' +
		'	<input class="form-control-sm col-12" placeholder="Modalité en anglais" id="libelle_en_modalite" name="libelle_en_modalite[]" type="text" />' +
		'</div>';
	cellule3.innerHTML = 
		"<button class=\"btn btn-danger\" style=\"margin:2px;\" onclick='this.parentNode.parentNode.remove();' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
	return row;
}

function load_form_caracteristique(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
					load_caracteristique_for_form_caracteristique(mode_parms, parms);
				}
				load_action_for_form_caracteristique(mode_parms);
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_" + mode_parms + "_caracteristique");
}


function save_caracteristique() {
	if (document.getElementById("caracteristique_form").checkValidity() == true) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					if (xhr.responseText == "1") {
						alert("Opération effectuée avec succès");
					}
					else {
						alert("Erreur avec le message" + xhr.responseText);
					}
				}
				catch (e) {
				  alert("Erreur avec le message" + e); 
				}
			}
		}
		
		xhr.open("POST", "index.php");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(serializeForm(document.getElementById("caracteristique_form")));
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}