function load_types_commandes_for_form_find_commande() {
	document.getElementById("id_type_commande_rech").innerHTML = "<option value=''></option>";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var types_commandes = JSON.parse(xhr.responseText);
				if (types_commandes.length != 0) {
					for (var i = 0; i < types_commandes.length; i++) {
						document.getElementById('id_type_commande_rech').options.add(new Option(types_commandes[i].libelle_fr, types_commandes[i].id_type_commande));
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
	xhr.send("action=get_types_commandes");
}

function load_commandes_for_form_find_commande() {
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var commandes = JSON.parse(xhr.responseText);
				var new_commandes = [];
				if (commandes.length <= 0) {
					alert("Aucune commande trouvée pour ces critères");
				}
				else {
					for (var i = 0; i < commandes.length; i++) {
						action_html =  "<div style=\"white-space: nowrap;\">";
						action_html += "<button class=\"btn btn-secondary\" style=\"margin:2px;\" onclick='load_form_commande(" + '"visual", "?id_commande=' +  commandes[i].id_commande + '"' + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_commande(" + '"modify", "?id_commande=' +  commandes[i].id_commande + '"' + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>";
						action_html += "<button class=\"btn btn-danger\" style=\"margin:2px;\" onclick='load_form_commande(" + '"delete", "?id_commande=' +  commandes[i].id_commande + '"' + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_commande(" + '"start_suivi", "?id_commande=' +  commandes[i].id_commande + '"' + ");' title='Démarrer le suivi'><i class='fa-solid fa-play size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\" onclick='load_form_commande(" + '"enreg_etapes", "?id_commande=' +  commandes[i].id_commande + '"' + ");' title='Enregistrer les étapes exécutées'><i class='fa-solid fa-record-vinyl size-fa'></i></button>";
						action_html += "</div>";
						new_date_signature = "";
						if ((commandes[i].date_signature != null) && (commandes[i].date_signature != "0000-00-00")) {
							new_date_signature = Intl.DateTimeFormat('fr-FR').format(new Date(commandes[i].date_signature.toString()));
						}
						new_commandes.push([
							commandes[i].id_commande,
							commandes[i].reference,
							new_date_signature,
							commandes[i].libelle_fr_type_commande,
							commandes[i].intitule_fr,
							commandes[i].raison_sociale_prestataire,
							(function(data){if (data==null || data==''){return '';} else {return parseInt(data).toLocaleString();}})(commandes[i].montant_ttc),
							(function(data){if (data==null || data==''){return '';} else {return parseInt(data).toLocaleString();}})(commandes[i].tva),
							(function(data){if (data==null || data==''){return '';} else {return parseInt(data).toLocaleString();}})(commandes[i].montant_ht),
							(function(data){if (data==null || data==''){return '';} else {return parseInt(data).toLocaleString();}})(commandes[i].ir),
							(function(data){if (data==null || data==''){return '';} else {return parseInt(data).toLocaleString();}})(commandes[i].montant_a_percevoir),
							action_html
						]);
					}
				}
				var table = $('#table_commandes').DataTable();
				table.clear();
				table.rows.add(new_commandes).draw();
			} 
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_commandes";
	if (document.getElementById('reference_rech').value != "") {
		parms = parms + "&reference=" + document.getElementById('reference_rech').value;
	}
	if (document.getElementById('intitule_rech').value != "") {
		parms = parms + "&intitule=" + document.getElementById('intitule_rech').value;
	}
	if (document.getElementById('consistance_rech').value != "") {
		parms = parms + "&consistance=" + document.getElementById('consistance_rech').value;
	}
	if (document.getElementById('id_type_commande_rech').value != null && document.getElementById('id_type_commande_rech').value != "") {
		parms = parms + "&id_type_commande=" + document.getElementById('id_type_commande_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}