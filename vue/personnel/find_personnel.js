function load_personnels_for_form_find_personnel() {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var personnels = JSON.parse(xhr.responseText);
				var new_personnels = [];
				if (personnels.length <= 0) {
					alert("Aucun personnel trouvé pour ces critères");
				}
				else {
					for (var i = 0; i < personnels.length; i++) {
						action_html  = "<div style=\"white-space: nowrap;\">";
						action_html += "<button class=\"btn btn-secondary\" style=\"margin:2px;\"  onclick='load_form_personnel(" + '"visual", "?id_personnel=' +  personnels[i].id_personnel + '"' + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\"  onclick='load_form_personnel(" + '"modify", "?id_personnel=' +  personnels[i].id_personnel + '"' + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>";
						action_html += "<button class=\"btn btn-danger\" style=\"margin:2px;\"  onclick='load_form_personnel(" + '"delete", "?id_personnel=' +  personnels[i].id_personnel + '"' + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
						action_html += "</div>";
						new_personnels.push([
							personnels[i].id_personnel,
							personnels[i].matricule,
							personnels[i].nom_prenom,
							action_html
						]);
					}
				}
				var table = $('#table_personnels').DataTable();
				table.clear();
				table.rows.add(new_personnels).draw();
			} 
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_personnels";
	if (document.getElementById('matricule_rech').value != ""){
		parms = parms + "&matricule=" + document.getElementById('matricule_rech').value;
	}
	if (document.getElementById('nom_prenom_rech').value != ""){
		parms = parms + "&nom_prenom=" + document.getElementById('nom_prenom_rech').value;
	}
	showLoader();
	setTimeout(function() {
		xhr.send(parms);
	}, 500);
	hideLoader();
}