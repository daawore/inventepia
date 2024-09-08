function load_unites_for_form_find_unite() {
	//Vidage du tableau des unites
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var unites = JSON.parse(xhr.responseText);
				var new_unites = [];
				if (unites.length <= 0) {
					alert("Aucune unité de mesure trouvée pour ces critères");
				}
				else {
					for (var i = 0; i < unites.length; i++) {
						action_html = "<div style=\"white-space: nowrap;\">";
						action_html += "<button class=\"btn btn-secondary\" style=\"margin:2px;\"  onclick='load_form_unite(" + '"visual", "?id_unite=' +  unites[i].id_unite + '"' + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\"  onclick='load_form_unite(" + '"modify", "?id_unite=' +  unites[i].id_unite + '"' + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>";
						action_html += "<button class=\"btn btn-danger\" style=\"margin:2px;\"  onclick='load_form_unite(" + '"delete", "?id_unite=' +  unites[i].id_unite + '"' + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
						action_html += "</div>";
						new_unites.push([
							unites[i].id_unite,
							unites[i].libelle_fr,
							unites[i].libelle_en,
							action_html
						]);
					}
				}
				var table = $('#table_unites').DataTable();
				table.clear();
				table.rows.add(new_unites).draw();
			} 
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_unites";
	
	if (document.getElementById('libelle_rech').value != "") {
		parms = parms + "&libelle=" + document.getElementById('libelle_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}