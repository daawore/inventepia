function load_profils_for_form_find_profil()
{
	//Vidage du tableau des profils
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var profils = JSON.parse(xhr.responseText);
				var new_profils = [];
				if (profils.length <= 0) {
					alert("Aucun profil trouvé pour ces critères");
				}
				else {
					for (var i = 0; i < profils.length; i++) {
						action_html = 
							"<div style=\"white-space: nowrap;\">" 
								+ "<button class=\"btn btn-secondary\" style=\"margin:2px;\" onclick='load_form_profil(" + '"visual",' + profils[i].id_profil + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>"
								+ "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_profil(" + '"modify",' + profils[i].id_profil + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>"
								+ "<button class=\"btn btn-danger\" style=\"margin:2px;\" onclick='load_form_profil(" + '"delete",' + profils[i].id_profil + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>"
							+ "</div>";
						new_profils.push([
							profils[i].id_profil,
							profils[i].libelle_fr,
							profils[i].ens_lib_fr_droits,
							profils[i].utilisateurs_profil,
							action_html
						]);
					}
				}
				var table = $('#table_profils').DataTable();
				table.clear();
				table.rows.add(new_profils).draw();
			}
			catch (e) {
			  alert("Parsing error:" + e); 
			}
		}
	}
	
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_profils";
	if (document.getElementById('lib_profil_rech').value != "" && document.getElementById('lib_profil_rech').value != null) {
		parms = parms + "&libelle_fr=" + document.getElementById('lib_profil_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}