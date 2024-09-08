function load_action_for_form_bien(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_bien";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_bien";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
	} 
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_bien";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
	}
	
	if ((mode_parms == "visual") || (mode_parms == "delete")) {
		make_form_readonly(document.getElementById("bien_form"));
	}
}

function load_etats_biens_for_form_bien() {
	document.getElementById("id_etat_bien").innerHTML = '<option value=""></option>';
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var etats = JSON.parse(xhr.responseText);
				if (etats.length != 0) {
					for (var i = 0; i < etats.length; i++) {
						document.getElementById('id_etat_bien').options.add(new Option(etats[i].libelle_fr, etats[i].id_etat));
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
	xhr.send("action=get_etats");
}
function load_categories_biens_for_form_bien() {
	document.getElementById("id_categorie_bien").innerHTML = '<option value=""></option>';
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var categories = JSON.parse(xhr.responseText);
				if (categories.length != 0) {
					for (var i = 0; i < categories.length; i++) {
						document.getElementById('id_categorie_bien').options.add(new Option(categories[i].libelle_fr, categories[i].id_categorie_bien));
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

function load_types_biens_for_form_bien() {
	document.getElementById("id_type_bien").innerHTML = '<option value=""></option>';
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var types_biens = JSON.parse(xhr.responseText);
				if (types_biens.length != 0) {
					for (var i = 0; i < types_biens.length; i++) {
						document.getElementById('id_type_bien').options.add(new Option(types_biens[i].libelle_fr, types_biens[i].id_type_bien));
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
	xhr.send("action=get_types_biens&id_categorie_bien=" + document.getElementById('id_categorie_bien').value);
}

function load_detenteurs_biens_for_form_bien() {
	document.getElementById("id_detenteur_bien").innerHTML = '<option value=""></option>';
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var personnels = JSON.parse(xhr.responseText);
				if (personnels.length != 0) {
					for (var i = 0; i < personnels.length; i++) {
						document.getElementById('id_detenteur_bien').options.add(new Option(personnels[i].nom_prenom, personnels[i].id_personnel));
					}
				}
			}
			catch(e) {
				alert("Parsing error : " + e); 
			}
		}
	}
	parms = ""
	if (document.getElementById('search_matricule_peronnel_bien').value != "") {
		parms += "&matricule=" + document.getElementById('search_matricule_peronnel_bien').value;
	}
	if (document.getElementById('search_nom_prenom_personnel_bien').value != "") {
		parms += "&nom_prenom=" + document.getElementById('search_nom_prenom_personnel_bien').value;
	}
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	// alert("parms = " + parms);
	if (parms != "") {
		xhr.send("action=get_personnels" + parms);
	}
}

function load_commandes_biens_for_form_bien() {
	document.getElementById("id_commande_bien").innerHTML = '<option value=""></option>';
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var commandes = JSON.parse(xhr.responseText);
				commandes.sort((a, b) => {
					if (a.date_signature < b.date_signature) return -1;
					if (a.date_signature > b.date_signature) return 1;
					return a.intitule_fr - b.intitule_fr;
				  });
				if (commandes.length != 0) {
					for (var i = 0; i < commandes.length; i++) {
						document.getElementById('id_commande_bien').options.add(new Option(commandes[i].abrev_fr_type_commande + " n°" + commandes[i].reference + " du " + (new Date(commandes[i].date_signature)).toLocaleDateString() + " | " + commandes[i].intitule_fr, commandes[i].id_commande));
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
	parms = "";
	if (document.getElementById('search_reference_commande_bien').value != "") {
		parms += "&reference=" + document.getElementById('search_reference_commande_bien').value;
	}
	if (document.getElementById('search_intitule_commande_bien').value != "") {
		parms += "&intitule=" + document.getElementById('search_intitule_commande_bien').value;
	}
	xhr.send("action=get_commandes" + parms);
}

function load_articles_commandes_biens_for_form_bien() {
	document.getElementById("id_article_commande_bien").innerHTML = '<option value=""></option>';
	if (document.getElementById("id_commande_bien").value != null && document.getElementById("id_commande_bien").value != '') {
		xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					var articles_commandes = JSON.parse(xhr.responseText);
					if (articles_commandes.length != 0) {
						for (var i = 0; i < articles_commandes.length; i++) {
							document.getElementById('id_article_commande_bien').options.add(new Option(articles_commandes[i].designation, articles_commandes[i].id_article));
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
		xhr.send("action=get_articles_commandes&id_commande=" + document.getElementById('id_commande_bien').value);
	}
	else {

	}
}
function load_bien_for_form_bien(mode_parms, parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var bien = JSON.parse(xhr.responseText);
				if (bien.length == 1) {
					document.getElementById("id_bien").value = bien[0].id_bien;
					document.getElementById("id_categorie_bien").value = bien[0].id_categorie_bien;
					load_types_biens_for_form_bien();
					document.getElementById("id_type_bien").value = bien[0].id_type_bien;
					document.getElementById("designation_bien").value = bien[0].designation;
					document.getElementById("quantite_bien").value = bien[0].quantite;
					document.getElementById("id_etat_bien").value = bien[0].id_etat;
					document.getElementById("search_matricule_peronnel_bien").value = bien[0].matricule_detenteur;
					document.getElementById("search_nom_prenom_personnel_bien").value = bien[0].nom_prenom_detenteur;
					load_detenteurs_biens_for_form_bien();
					document.getElementById("id_detenteur_bien").value = bien[0].id_detenteur;
					document.getElementById("date_attribution_bien").value = bien[0].date_attribution;
					document.getElementById("search_reference_commande_bien").value = bien[0].reference_commande;
					document.getElementById("search_intitule_commande_bien").value = bien[0].intitule_fr_commande;
					load_commandes_biens_for_form_bien();
					document.getElementById("id_commande_bien").value = bien[0].id_commande;
					load_articles_commandes_biens_for_form_bien();
					document.getElementById("id_article_commande_bien").value = bien[0].id_article_commande;
					document.getElementById("observation_bien").value = bien[0].observation;
				}
				else {
					alert("Le bien recherché n'a pas été trouvé");
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
	xhr.send("action=get_biens&id_bien=" + urlParams.get("id_bien"));
}

function load_caracteristiques_bien_for_form_bien(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var caracteristiques_biens = JSON.parse(xhr.responseText);
				var new_caracteristiques_biens = [];
				if (caracteristiques_biens.length <= 0) {
					alert("Aucune caractéristiques trouvée pour ce bien");
				}
				else {
					for (var i = 0; i < caracteristiques_biens.length; i++) {
						cell1 = "<input type=\"hidden\" name=\"id_caracteristique[]\" id=\"id_caracteristique\" value=" + caracteristiques_biens[i].id_caracteristique + "></input>" + caracteristiques_biens[i].libelle_fr_caracteristique;
						if (caracteristiques_biens[i].type_caracteristique == "singselect" || caracteristiques_biens[i].type_caracteristique == "multiselect") {
							opt = "<option value=\"\"></option>";
							
							xhr = new XMLHttpRequest();
							xhr.onreadystatechange = function() {
								if(xhr.readyState == 4 && xhr.status == 200) {
									try {
										var modalites_caracteristique = JSON.parse(xhr.responseText);
										if (modalites_caracteristique.length > 0) {
											for (var j = 0; j < modalites_caracteristique.length; j++) {
												opt +="<option value='" + modalites_caracteristique[j].id_modalite + "'" + (function(data1, data2){if (data1 == data2) {return "selected"}})(modalites_caracteristique[j].id_modalite, caracteristiques_biens[i].valeur) + ">" + modalites_caracteristique[j].libelle_fr + "</option>";
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
							xhr.send("action=get_modalites_caracteristiques&id_caracteristique=" + caracteristiques_biens[i].id_caracteristique);
							cell2 =
								"<select class=\"form-select\" placeholder=\"Valeur de la caractéristique\" name=\"valeur[]\" id=\"valeur\" value=\"" + (caracteristiques_biens[i].valeur || '') + "\" >" +
								opt + 
								"</select>";
						}
						else {
							cell2 = "<input class=\"form-control\" placeholder=\"Valeur de la caractéristique\" name=\"valeur[]\" id=\"valeur\" type=\"text\" value=\"" + (caracteristiques_biens[i].valeur || '') + "\" />";
						}
						new_caracteristiques_biens.push([
							cell1,
							cell2
						]);
					}
				}
				var table = $('#table_caracteristiques_biens').DataTable();
				table.clear();
				table.rows.add(new_caracteristiques_biens).draw();
			} 
			catch(e) {
			alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	const urlParams = new URLSearchParams(parms);
	if (mode_parms == "add") {
		xhr.send("action=get_caracteristiques_types_biens&id_type_bien=" + document.getElementById("id_type_bien").value);
	}
	else {
		xhr.send("action=get_valeurs_caracteristiques_biens&id_bien=" + urlParams.get("id_bien"));
	}
}

function load_form_bien(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				// load_action_for_form_bien(mode_parms);
				load_categories_biens_for_form_bien();
				load_etats_biens_for_form_bien();
				load_detenteurs_biens_for_form_bien();
				// load_commandes_biens_for_form_bien();
				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
					load_bien_for_form_bien(mode_parms, parms);
					load_caracteristiques_bien_for_form_bien(mode_parms, parms);
				}
				load_action_for_form_bien(mode_parms);
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_" + mode_parms + "_bien");
}


function save_bien() {
	if (document.getElementById("bien_form").checkValidity() == true) {
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
		xhr.send(serializeForm(document.getElementById("bien_form")));
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}