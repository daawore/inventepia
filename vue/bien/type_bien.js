function load_action_for_form_type_bien(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_type_bien";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_type_bien";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
	} 
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_type_bien";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
	}
	
	if ((mode_parms == "visual") || (mode_parms == "delete")) {
		make_form_readonly(document.getElementById("type_bien_form"));
	}
}

function load_caracteristiques_dispo_for_form_type_bien() {
	document.getElementById("select_caracteristiques_dispo").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var caracteristiques_dispo = JSON.parse(xhr.responseText);
				if (caracteristiques_dispo.length != 0) {
					for (var i = 0; i < caracteristiques_dispo.length; i++) {
						add_caracteristique_dispo_for_form_type_bien("?id_caracteristique=" + caracteristiques_dispo[i].id_caracteristique + "&libelle_fr=" + caracteristiques_dispo[i].libelle_fr);
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
	xhr.send("action=get_caracteristiques_dispo&id_type_bien=" + document.getElementById("id_type_bien").value);
}

function load_caracteristiques_type_bien_for_form_type_bien() {
	document.getElementById("select_caracteristiques_type_bien").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var caracteristiques_type_bien = JSON.parse(xhr.responseText);
			}
			catch (e) {
			  alert("Parsing error : " + e); 
			}
			if (caracteristiques_type_bien.length != 0) {
				for (var i = 0; i < caracteristiques_type_bien.length; i++) {
					add_caracteristique_type_bien_for_form_type_bien("?id_caracteristique=" + caracteristiques_type_bien[i].id_caracteristique + "&libelle_fr=" + caracteristiques_type_bien[i].libelle_fr_caracteristique);
				}
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_caracteristiques_types_biens&id_type_bien=" + document.getElementById("id_type_bien").value);
}

function add_caracteristique_type_bien_for_form_type_bien(parms) {
	const urlParams = new URLSearchParams(parms);
	var opt = document.createElement('option');
    opt.value = urlParams.get("id_caracteristique");
    opt.innerHTML = urlParams.get("libelle_fr");
    document.getElementById("select_caracteristiques_type_bien").appendChild(opt);
}


function del_caracteristique_type_bien_for_form_type_bien(parms) {
	const urlParams = new URLSearchParams(parms);
	if (document.getElementById('table_caracteristiques_type_bien').getElementsByTagName("tbody").item(0).rows.length > 0) {
		var i = 0;
		while ((i < document.getElementById('table_caracteristiques_type_bien').getElementsByTagName("tbody").item(0).rows.length) && (document.getElementById('table_caracteristiques_type_bien').getElementsByTagName("tbody").item(0).rows[i].cells[0].innerHTML != urlParams.get("id_caracteristique"))) {
			i++;
		}
		if (i < document.getElementById('table_caracteristiques_type_bien').getElementsByTagName("tbody").item(0).rows.length) {
			document.getElementById('table_caracteristiques_type_bien').getElementsByTagName("tbody").item(0).deleteRow(i);
		}
	}
}

function add_caracteristique_dispo_for_form_type_bien(parms) {
    const urlParams = new URLSearchParams(parms);
	var opt = document.createElement('option');
    opt.value = urlParams.get("id_caracteristique");
    opt.innerHTML = urlParams.get("libelle_fr");
    document.getElementById("select_caracteristiques_dispo").appendChild(opt);
}

function del_caracteristique_dispo_for_form_type_bien(parms) {
	const urlParams = new URLSearchParams(parms);
	if (document.getElementById('table_caracteristiques_dispo').getElementsByTagName("tbody").item(0).rows.length > 0) {
		var i = 0;
		while ((i < document.getElementById('table_caracteristiques_dispo').getElementsByTagName("tbody").item(0).rows.length) && (document.getElementById('table_caracteristiques_dispo').getElementsByTagName("tbody").item(0).rows[i].cells[0].innerHTML != urlParams.get("id_caracteristique"))) {
			i++;
		}	
		if (i < document.getElementById('table_caracteristiques_dispo').getElementsByTagName("tbody").item(0).rows.length) {
			document.getElementById('table_caracteristiques_dispo').getElementsByTagName("tbody").item(0).deleteRow(i);
		}
	}
}

function add_select_caracteristique_for_form_type_bien() {
	const selectElement = document.getElementById('select_caracteristiques_dispo');
	const selectedValues = [];
	//Ajouter les options sélectionnées dans celles du type de bien
	for (let i = 0; i < selectElement.options.length; i++) {
		if (selectElement.options[i].selected) {
			selectedValues.push(selectElement.options[i].value);
			var opt = document.createElement('option');
			opt.value = selectElement.options[i].value;
			opt.text = selectElement.options[i].text;
			document.getElementById("select_caracteristiques_type_bien").appendChild(opt);
		}
	}
	// Supprimer les options sélectionnées dans les dispo
	for (let i = 0; i < selectedValues.length; i++) {
		for (let j = 0; j < selectElement.options.length; j++) {
			if (selectedValues[i] == selectElement.options[j].value) {
				selectElement.options.remove(selectElement.options[j].index);
			}
		}
	}
}
 
function remove_select_caracteristique_for_form_type_bien() {
	const selectElement = document.getElementById('select_caracteristiques_type_bien');
	const selectedValues = [];
	//Ajouter les options sélectionnées dans celles du type de bien
	for (let i = 0; i < selectElement.options.length; i++) {
		if (selectElement.options[i].selected) {
			selectedValues.push(selectElement.options[i].value);
			var opt = document.createElement('option');
			opt.value = selectElement.options[i].value;
			opt.text = selectElement.options[i].text;
			document.getElementById("select_caracteristiques_dispo").appendChild(opt);
		}
	}
	// Supprimer les options sélectionnées dans les dispo
	for (let i = 0; i < selectedValues.length; i++) {
		for (let j = 0; j < selectElement.options.length; j++) {
			if (selectedValues[i] == selectElement.options[j].value) {
				selectElement.options.remove(selectElement.options[j].index);
			}
		}
	}
}

function load_categories_biens_for_form_type_bien() {
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

function load_type_bien_for_form_type_bien(mode_parms, parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var type_bien = JSON.parse(xhr.responseText);
				if (type_bien.length == 1) {
					document.getElementById("id_type_bien").value = type_bien[0].id_type_bien;
					document.getElementById("id_categorie_bien").value = type_bien[0].id_categorie_bien;
					document.getElementById("libelle_fr").value = type_bien[0].libelle_fr;
					document.getElementById("libelle_en").value = type_bien[0].libelle_en;
					document.getElementById("quantifiable").value = type_bien[0].quantifiable;
					document.getElementById("perissable").value = type_bien[0].perissable;
					document.getElementById("attribuable").value = type_bien[0].attribuable;
					load_caracteristiques_dispo_for_form_type_bien();
					load_caracteristiques_type_bien_for_form_type_bien();
				}
				else {
					alert("Le type de bien recherché n'a pas été trouvé");
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
	xhr.send("action=get_types_biens&id_type_bien=" + urlParams.get("id_type_bien"));
}

function load_form_type_bien(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				load_action_for_form_type_bien(mode_parms);
				load_categories_biens_for_form_type_bien();
                if (mode_parms == "add") {
                    load_caracteristiques_dispo_for_form_type_bien();
                }
				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
                    load_type_bien_for_form_type_bien(mode_parms, parms);
				}
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_" + mode_parms + "_type_bien");
}


function save_type_bien() {
	if (document.getElementById("type_bien_form").checkValidity() == true) {
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
		var params = "";
		params = serializeForm(document.getElementById("type_bien_form"));
		if (document.getElementById('select_caracteristiques_dispo').options.length > 0) {
			i = 0;
			while (i < document.getElementById('select_caracteristiques_dispo').options.length) {
				params += "&id_caracteristiques_dispo[]=" + document.getElementById('select_caracteristiques_dispo').options[i].value;
				i++;
			}
		}
		if (document.getElementById('select_caracteristiques_type_bien').options.length > 0) {
			i = 0;
			while (i < document.getElementById('select_caracteristiques_type_bien').options.length) {
				params += "&id_caracteristiques_type_bien[]=" + document.getElementById('select_caracteristiques_type_bien').options[i].value;
				i++;
			}
		}
		xhr.send(params);
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}