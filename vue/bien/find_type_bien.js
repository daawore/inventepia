function load_categories_for_form_find_type_bien() {
	document.getElementById("id_categorie_rech").innerHTML = "<option value=''></option>";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var categories = JSON.parse(xhr.responseText);
				if (categories.length != 0) {
					for (var i = 0; i < categories.length; i++) {
						document.getElementById('id_categorie_rech').options.add(new Option(categories[i].libelle_fr, categories[i].id_categorie_bien));
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
function load_types_biens_for_form_find_type_bien() {
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var types_biens = JSON.parse(xhr.responseText);
				var new_types_biens = [];
				if (types_biens.length <= 0) {
					alert("Aucun type de bien trouvé pour ces critères");
				}
				else {
					for (var i = 0; i < types_biens.length; i++) {
						action_html =  "<div style=\"white-space: nowrap;\">";
						action_html += "<button class=\"btn btn-secondary\" style=\"margin:2px;\" onclick='load_form_type_bien(" + '"visual", "?id_type_bien=' +  types_biens[i].id_type_bien + '"' + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_type_bien(" + '"modify", "?id_type_bien=' +  types_biens[i].id_type_bien + '"' + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>";
						action_html += "<button class=\"btn btn-danger\" style=\"margin:2px;\" onclick='load_form_type_bien(" + '"delete", "?id_type_bien=' +  types_biens[i].id_type_bien + '"' + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
						action_html += "</div>";
						new_types_biens.push([
							types_biens[i].id_type_bien,
							types_biens[i].libelle_fr_categorie_bien,
							types_biens[i].libelle_fr,
							types_biens[i].libelle_en,
							(function(data) {if (data == 1) {return "Oui"} else {return "Non"}})(types_biens[i].quantifiable),
							(function(data) {if (data == 1) {return "Oui"} else {return "Non"}})(types_biens[i].perissable),
							(function(data) {if (data == 1) {return "Oui"} else {return "Non"}})(types_biens[i].attribuable),
							action_html
						]);
					}
				}
				var table = $('#table_types_biens').DataTable();
				table.clear();
				table.rows.add(new_types_biens).draw();
			} 
			catch(e) {
			alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_types_biens";
	if (document.getElementById('id_categorie_rech').value != ""){
		parms = parms + "&id_categorie=" + document.getElementById('id_categorie_rech').value;
	}
	if (document.getElementById('libelle_type_bien_rech').value != ""){
		parms = parms + "&libelle_fr=" + document.getElementById('libelle_type_bien_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}