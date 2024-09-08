function load_action_for_form_commande(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_commande";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("start_suivi_btn").hidden = true;
		document.getElementById("enreg_etapes_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_commande";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("start_suivi_btn").hidden = true;
		document.getElementById("enreg_etapes_btn").hidden = true;
	} 
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_commande";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
		document.getElementById("start_suivi_btn").hidden = true;
		document.getElementById("enreg_etapes_btn").hidden = true;
	}
	else if (mode_parms == "start_suivi") {
		document.getElementById("action").value = "start_suivi_commande";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("start_suivi_btn").hidden = false;
		document.getElementById("enreg_etapes_btn").hidden = true;
	}
	else if (mode_parms == "enreg_etapes") {
		document.getElementById("action").value = "enreg_etapes_commande";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("start_suivi_btn").hidden = true;
		document.getElementById("enreg_etapes_btn").hidden = false;
	}
	if (["visual", "delete", "start_suivi", "enreg_etapes"].includes(mode_parms)) {
		make_form_readonly(document.getElementById("commande_form"));
	}
	if (mode_parms == "start_suivi") {
		document.getElementById("etapes_commande_dispo").disabled = "";
		document.getElementById("etapes_commande").disabled = "";
	}
	if (mode_parms == "enreg_etapes") {
		
	}
}

function load_types_commandes_for_form_commande() {
	document.getElementById("id_type_commande").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var types_commandes = JSON.parse(xhr.responseText);
				if (types_commandes.length != 0) {
					for (var i = 0; i < types_commandes.length; i++) {
						document.getElementById('id_type_commande').options.add(new Option(types_commandes[i].libelle_fr, types_commandes[i].id_type_commande));
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

function get_unites_as_html_options() {
	var result = '';
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var unites = JSON.parse(xhr.responseText);
				if (unites.length != 0) {
					for (var i = 0; i < unites.length; i++) {
						result += "<option value='" + unites[i].id_unite + "'>" + unites[i].libelle_fr + "</option>";
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
	xhr.send("action=get_unites");
	return result;
}

function load_commande_for_form_commande(parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var commande = JSON.parse(xhr.responseText);
				if (commande.length == 1) {
					document.getElementById("id_commande").value = commande[0].id_commande;
					document.getElementById("reference").value = commande[0].reference;
					document.getElementById("date_signature").value = commande[0].date_signature;
					document.getElementById("id_type_commande").value = commande[0].id_type_commande;
					document.getElementById("intitule_fr").value = commande[0].intitule_fr;
					document.getElementById("intitule_en").value = commande[0].intitule_en;
					document.getElementById("consistance_fr").value = commande[0].consistance_fr;
					document.getElementById("consistance_en").value = commande[0].consistance_en;
					document.getElementById("raison_sociale_prestataire").value = commande[0].raison_sociale_prestataire;
					document.getElementById("nom_prenom_prestataire").value = commande[0].nom_prenom_prestataire;
					document.getElementById("montant_ttc").value = formatToMonetaire(commande[0].montant_ttc || '');
					document.getElementById("tva").value = formatToMonetaire(commande[0].tva || '');
					document.getElementById("montant_ht").value = formatToMonetaire(commande[0].montant_ht || '');
					document.getElementById("ir").value = formatToMonetaire(commande[0].ir || '');
					document.getElementById("montant_a_percevoir").value = formatToMonetaire(commande[0].montant_a_percevoir || '');
				}
				else {
					alert("La commande recherchée n'a pas été trouvée");
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
	xhr.send("action=get_commandes&id_commande=" + urlParams.get("id_commande"));
}

function load_articles_commande_for_form_commande(parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var articles = JSON.parse(xhr.responseText);
				if (articles.length >= 1) {
					for (var i = 0; i < articles.length; i++) {
						add_article_for_form_commande();
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#id_article").value = articles[i].id_article;
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#numero_article").value = articles[i].numero_article;
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#designation_article").value = articles[i].designation;
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#id_unite_article").value = articles[i].id_unite;
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#quantite_article").value = formatToMonetaire(articles[i].quantite || '');
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#prix_unitaire_ttc_article").value = formatToMonetaire(articles[i].prix_unitaire_ttc || '');
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#prix_unitaire_ht_article").value = formatToMonetaire(articles[i].prix_unitaire_ht || '');
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#prix_total_ttc_article").value = formatToMonetaire((articles[i].quantite || '')*(articles[i].prix_unitaire_ttc || ''));
						document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).lastElementChild.querySelector("#prix_total_ttc_article").value = formatToMonetaire((articles[i].quantite || '')*(articles[i].prix_unitaire_ht || ''));
					}
				}
				else {
					alert("Les articles de cette commande n'ont pas été trouvées");
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
	xhr.send("action=get_articles_commandes&id_commande=" + urlParams.get("id_commande"));
}

function add_article_for_form_commande() {
	var row = document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).insertRow(-1);
	//Cellule pour l'ID
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<input class="form-control form-control-sm" placeholder="ID" id="id_article" name="id_article[]" type="text" style="text-align:center;" readonly="readonly" />' +
		'</div>';
	cell.setAttribute("style", "text-align:center");
	//Cellule pour le numéro
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<input class="form-control form-control-sm" placeholder="Numéro" id="numero_article" name="numero_article[]" type="number" style="text-align:center;" />' +
		'</div>';
	cell.setAttribute("style", "text-align:center");
	//Cellule pour la désignation
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<textarea class="form-control form-control-sm" placeholder="Désignation" id="designation_article" name="designation_article[]" style="text-align:left;"></textarea>' +
		'</div>';
	cell.setAttribute("style", "text-align:left");
	//Cellule pour l'unité
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<select class="form-select form-select-sm" placeholder="Désignation" id="id_unite_article" name="id_unite_article[]">' +
			get_unites_as_html_options() +
		'	</select>' +
		'</div>';
	cell.setAttribute("style", "text-align:center");
	//Cellule de la quantité
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<input class="form-control form-control-sm" placeholder="Quantité" id="quantite_article" name="quantite_article[]" type="text" style="text-align:right;" oninput="formatInputToMonetaire(this)" />' +
		'</div>';
	cell.setAttribute("style", "text-align:center");
	//Cellule du prix TTC
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<input class="form-control form-control-sm" placeholder="Prix unitaire TTC" id="prix_unitaire_ttc_article" name="prix_unitaire_ttc_article[]" type="text" style="text-align:right;" oninput="formatInputToMonetaire(this)" />' +
		'</div>';
	cell.setAttribute("style", "text-align:right");
	//Cellule du prix TTC
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<input class="form-control form-control-sm" placeholder="Prix unitaire HT" id="prix_unitaire_ht_article" name="prix_unitaire_ht_article[]" type="text" style="text-align:right;" oninput="formatInputToMonetaire(this)" />' +
		'</div>';
	cell.setAttribute("style", "text-align:right");
	//Cellule du prix total TTC
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<input class="form-control form-control-sm" placeholder="Prix total TTC" id="prix_total_ttc_article" name="prix_total_ttc_article[]" type="text" style="text-align:right;" oninput="formatInputToMonetaire(this)" />' +
		'</div>';
	cell.setAttribute("style", "text-align:right");
	//Cellule du prix TTC
	cell = row.insertCell(-1);
	cell.innerHTML = 
		'<div class="mb-3" style="padding:0px">' +
		'	<input class="form-control form-control-sm" placeholder="Prix total HT" id="prix_total_ht_article" name="prix_total_ht_article[]" type="text" style="text-align:right;" oninput="formatInputToMonetaire(this)" />' +
		'</div>';
	cell.setAttribute("style", "text-align:right");
	//Cellule des actions
	cell = row.insertCell(-1);
	cell.innerHTML = "<button class=\"btn btn-danger\" style=\"margin:2px;\" onclick='this.parentNode.parentNode.remove();' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
	cell.setAttribute("style", "text-align:left");
	// refresh_totaux_for_form_commande();
	return row;
}

function del_article_for_form_commande(row) {
	refresh_totaux_for_form_commande();
}

function refresh_totaux_for_form_commande() {
	tot_prix_tot_ttc = 0;
	tot_prix_tot_ht = 0;
	
	if (document.getElementById('table_articles_commande').getElementsByTagName("tbody").item(0).rows.length != 0) {
		for (var i=0; i < document.getElementsByName('prix_total_ttc_article[]').length; i++) {
			tot_prix_tot_ttc += formatToNumber(document.getElementsByName('prix_total_ttc_article[]').item(i).value);
			tot_prix_tot_ht += formatToNumber(document.getElementsByName('prix_total_ht_article[]').item(i).value);
		}
	}
	document.getElementById('tot_prix_tot_ttc').value = tot_prix_tot_ttc;
	document.getElementById('tot_prix_tot_ht').value = tot_prix_tot_ht;
}

function load_etapes_commande_dispo_for_form_commande(parms) {
	document.getElementById("etapes_commande_dispo").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var etapes_commande_dispo = JSON.parse(xhr.responseText);
				if (etapes_commande_dispo.length != 0) {
					for (var i = 0; i < etapes_commande_dispo.length; i++) {
						document.getElementById('etapes_commande_dispo').options.add(new Option(etapes_commande_dispo[i].libelle_fr, etapes_commande_dispo[i].id_etape_commande_base));
					}
				}
			}
			catch (e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	const urlParams = new URLSearchParams(parms);
	xhr.send("action=get_etapes_commande_dispo&id_commande=" + urlParams.get("id_commande"));
}

function load_etapes_commande_for_form_commande(parms) {
	document.getElementById("etapes_commande").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var etapes_commande = JSON.parse(xhr.responseText);
				etapes_commande.sort((a, b) => a.numero_ordre_etape - b.numero_ordre_etape);
				if (etapes_commande.length != 0) {
					for (var i = 0; i < etapes_commande.length; i++) {
						document.getElementById('etapes_commande').options.add(new Option(etapes_commande[i].libelle_fr_etape_commande, etapes_commande[i].id_etape_commande));
					}
				}
			}
			catch (e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	const urlParams = new URLSearchParams(parms);
	xhr.send("action=get_etapes_commande&id_commande=" + urlParams.get("id_commande"));
}

function add_etape_commande() {
	const selectedOptions = Array.from(document.getElementById("etapes_commande_dispo").selectedOptions);
	selectedOptions.forEach(option => {
		document.getElementById('etapes_commande').options.add(new Option(option.innerHTML, option.value));
		option.remove();
	});
}

function remove_etape_commande() {
	const selectedOptions = Array.from(document.getElementById("etapes_commande").selectedOptions);
	selectedOptions.forEach(option => {
		document.getElementById('etapes_commande_dispo').options.add(new Option(option.innerHTML, option.value));
		option.remove();
	});
}

function move_up_etape_commande() {
	move_option_select(document.getElementById('etapes_commande'), document.getElementById('etapes_commande').selectedIndex, "up");
}

function move_down_etape_commande() {
	move_option_select(document.getElementById('etapes_commande'), document.getElementById('etapes_commande').selectedIndex, "down");
}

function load_enreg_etapes_for_form_commande(parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var etapes_commande = JSON.parse(xhr.responseText);
				etapes_commande.sort((a, b) => a.numero_ordre_etape - b.numero_ordre_etape);
				if (etapes_commande.length >= 1) {
					for (var i = 0; i < etapes_commande.length; i++) {
						var row = document.getElementById('table_enreg_etapes_commande').getElementsByTagName("tbody").item(0).insertRow(-1);
						//Cellule pour le numéro d'ordre
						cell = row.insertCell(-1);
						cell.innerHTML = 
							etapes_commande[i].numero_ordre_etape +
							'<input type="hidden" name="id_etape_commande[]" id="id_etape_commande" value="' + etapes_commande[i].id_etape_commande + '" readOnly="readOnly"></input>' +
							'<input type="hidden" name="numero_ordre[]" id="numero_ordre" value="' + etapes_commande[i].numero_ordre_etape + '" readOnly="readOnly"></input>' ;
						cell.setAttribute("style", "text-align:center");
						//Cellule pour le libellé de l'étape
						cell = row.insertCell(-1);
						cell.innerHTML =
							etapes_commande[i].libelle_fr_etape_commande +
							'<input type="hidden" name="libelle_fr_etape_commande[]" id="libelle_fr_etape_commande" value="' + etapes_commande[i].libelle_fr_etape_commande + '"></input>';
						cell.setAttribute("style", "text-align:left");
						//Cellule des actions
						cell = row.insertCell(-1);
						change_execution_etape_for_form_commande(cell, etapes_commande[i].execute);
						cell.setAttribute("style", "text-align:center");
					}
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
	xhr.send("action=get_etapes_commande&id_commande=" + urlParams.get("id_commande"));
}

function change_execution_etape_for_form_commande(cell_execution_commande, execute) {
	if (execute == true) {
		cell_execution_commande.innerHTML =
			"<a id='lien_etape_execute' style='cursor:pointer;' onclick='change_execution_etape_for_form_commande(this.parentNode, false);' title=\"Annuler l'exécution de cette étape\"><i id='image_etape_execute' class='fa-solid fa-circle-check fa-2xl'></i></a>" +
			"<input type='hidden' name='etape_execute[]' id='etape_execute' value='1' />";
	}
	else {
		cell_execution_commande.innerHTML =
			"<a id='lien_etape_execute' style='cursor:pointer;' onclick='change_execution_etape_for_form_commande(this.parentNode, true);' title=\"Enregistrer l'exécution de cette étape\"><i id='image_etape_execute' class='fa-solid fa-xmark fa-2xl'></i></a>" +
			"<input type='hidden' name='etape_execute[]' id='etape_execute' value='0' />";
	}
}

function load_form_commande(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				load_types_commandes_for_form_commande();
				if (["modify", "visual", "delete", "start_suivi", "enreg_etapes"].indexOf(mode_parms) != -1) {
					load_commande_for_form_commande(parms);
				}
				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
					load_articles_commande_for_form_commande(parms);
				}
				if (mode_parms == "start_suivi") {
					load_etapes_commande_dispo_for_form_commande(parms);
					load_etapes_commande_for_form_commande(parms);
				}
				if (mode_parms == "enreg_etapes") {
					load_enreg_etapes_for_form_commande(parms);
				}
				load_action_for_form_commande(mode_parms);
				// document.getElementById('mydialog').showModal();
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_" + mode_parms + "_commande");
}

function save_commande() {
	if (document.getElementById("commande_form").checkValidity() == true) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					if (xhr.responseText == "1") {
						alert("Opération effectuée avec succès");
					}
					else {
						alert("Erreur avec le message : " + xhr.responseText);
					}
				}
				catch (e) {
				  alert("Parsing error:"+e); 
				}
			}
		}
		xhr.open("POST", "index.php");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		parms = serializeForm(document.getElementById("commande_form"));
		if (document.getElementById('action').value == "start_suivi_commande") {
			var i = 0;
			(Array.from(document.getElementById('etapes_commande').options)).forEach(option => {
				i += 1;
				parms += "&id_etape_commande[]=" + option.value + "&numero_ordre_etape[]=" + i;
			});
		}
		xhr.send(parms);
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}