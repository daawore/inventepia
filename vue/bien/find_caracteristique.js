function load_caracteristiques_for_form_find_caracteristique() {
	//Vidage du tableau des caractéristiques des biens
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var caracteristiques = JSON.parse(xhr.responseText);
				var new_caracteristiques = [];
				if (caracteristiques.length <= 0) {
					alert("Aucune caractéristique trouvée pour ces critères");
				}
				else {
					for (var i = 0; i < caracteristiques.length; i++) {
						action_html = "<div style=\"white-space: nowrap;\">";
						action_html += "<button class=\"btn btn-secondary\" style=\"margin:2px;\"  onclick='load_form_caracteristique(" + '"visual", "?id_caracteristique=' +  caracteristiques[i].id_caracteristique + '"' + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\"  onclick='load_form_caracteristique(" + '"modify", "?id_caracteristique=' +  caracteristiques[i].id_caracteristique + '"' + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>";
						action_html += "<button class=\"btn btn-danger\" style=\"margin:2px;\"  onclick='load_form_caracteristique(" + '"delete", "?id_caracteristique=' +  caracteristiques[i].id_caracteristique + '"' + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
						action_html += "</div>";
						new_caracteristiques.push([
							caracteristiques[i].id_caracteristique,
							caracteristiques[i].libelle_fr,
							caracteristiques[i].abrev_fr,
							caracteristiques[i].libelle_en,
							caracteristiques[i].abrev_en,
							caracteristiques[i].type,
							action_html
						]);
					}
				}
				var table = $('#table_caracteristiques').DataTable();
				table.clear();
				table.rows.add(new_caracteristiques).draw();
			} 
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_caracteristiques";
	
	if (document.getElementById('libelle_fr_caracteristique_rech').value != "") {
		parms = parms + "&libelle_fr=" + document.getElementById('libelle_fr_caracteristique_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}