function load_utilisateurs_for_form_find_utilisateur()
{
	//Vidage du tableau des utilisateurs
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var utilisateurs = JSON.parse(xhr.responseText);
				var new_utilisateurs = [];
				if (utilisateurs.length <= 0) {
					alert("Aucun utilisateur trouvé pour ces critères");
				}
				else {
					for (var i = 0; i < utilisateurs.length; i++) {
						action_html = 
							"<div style=\"white-space: nowrap;\">"
								+ "<button class=\"btn btn-secondary\" style=\"margin:2px;\" onclick='load_form_utilisateur(\"visual\", " + utilisateurs[i].id_utilisateur + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>"
								+ "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_utilisateur(\"modify\", " + utilisateurs[i].id_utilisateur + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>"
								+ "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_utilisateur(\"reinit_pass\", " + utilisateurs[i].id_utilisateur + ");' class='text_Action_Tableau'>Reinit pass</button>" 
								+ "<button class=\"btn btn-danger\" style=\"margin:2px;\" onclick='load_form_utilisateur(\"delete\" ," + utilisateurs[i].id_utilisateur + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>"
							+ "</div>";
						new_utilisateurs.push([
							utilisateurs[i].id_utilisateur,
							utilisateurs[i].username_utilisateur,
							utilisateurs[i].nom_prenom_utilisateur,
							utilisateurs[i].email_utilisateur,
							utilisateurs[i].libs_fr_profil_utilisateur,
							action_html
						]);
					}
				}
				var table = $('#table_utilisateurs').DataTable();
				table.clear();
				table.rows.add(new_utilisateurs).draw();
			}
			catch (e) {
			  alert("Parsing error:" + e); 
			}
		}
	}
	
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_utilisateurs";
	if (document.getElementById('username_rech').value != "") {
		parms = parms + "&username=" + document.getElementById('username_rech').value;
	}
	if (document.getElementById('nom_prenom_rech').value != "") {
		parms = parms + "&nom_prenom=" + document.getElementById('nom_prenom_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}