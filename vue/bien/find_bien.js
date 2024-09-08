function load_categories_bien_for_form_find_bien() {
	document.getElementById("id_categorie_bien_rech").innerHTML = "<option value=''></option>";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var categories = JSON.parse(xhr.responseText);
				if (categories.length != 0) {
					for (var i = 0; i < categories.length; i++) {
						document.getElementById('id_categorie_bien_rech').options.add(new Option(categories[i].libelle_fr, categories[i].id_categorie_bien));
					}
				}
			}
			catch(e) {
				alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_categories_biens");
}
function load_biens_for_form_find_bien() {
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var biens = JSON.parse(xhr.responseText);
				var new_biens = [];
				if (biens.length <= 0) {
					alert("Aucun bien trouvé pour ces critères");
				}
				else {
					for (var i = 0; i < biens.length; i++) {
						action_html =  "<div style=\"white-space: nowrap;\">";
						action_html += "<button class=\"btn btn-secondary\" style=\"margin:2px;\" onclick='load_form_bien(" + '"visual", "?id_bien=' +  biens[i].id_bien + '"' + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_bien(" + '"modify", "?id_bien=' +  biens[i].id_bien + '"' + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>";
						action_html += "<button class=\"btn btn-danger\" style=\"margin:2px;\" onclick='load_form_bien(" + '"delete", "?id_bien=' +  biens[i].id_bien + '"' + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
						action_html += "</div>";
						new_biens.push([
							biens[i].id_bien,
							biens[i].libelle_fr_categorie_bien,
							biens[i].libelle_fr_type_bien,
							biens[i].designation,
							biens[i].quantite,
							biens[i].nom_prenom_detenteur,
							biens[i].date_attribution,
							(function(value1, value2, value3, value4){if (value2!=null){return value1 + " n°" + value2 + " du " + (new Date(value3)).toLocaleDateString() + " | " + value4}else{return ""}})(biens[i].abrev_fr_type_commande, biens[i].reference_commande,  biens[i].date_signature_commande, biens[i].intitule_fr_commande),
							action_html
						]);
					}
				}
				var table = $('#table_biens').DataTable();
				table.clear();
				table.rows.add(new_biens).draw();
			} 
			catch(e) {
			alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_biens";
	if (document.getElementById('id_categorie_bien_rech').value != ""){
		parms = parms + "&id_categorie_bien=" + document.getElementById('id_categorie_bien_rech').value;
	}
	if (document.getElementById('designation_bien_rech').value != ""){
		parms = parms + "&designation=" + document.getElementById('designation_bien_rech').value;
	}
	if (document.getElementById('matricule_detenteur_bien_rech').value != ""){
		parms = parms + "&matricule_detenteur=" + document.getElementById('matricule_detenteur_bien_rech').value;
	}
	if (document.getElementById('nom_prenom_detenteur_bien_rech').value != ""){
		parms = parms + "&nom_prenom_detenteur=" + document.getElementById('nom_prenom_detenteur_bien_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}