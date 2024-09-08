function load_action_for_form_lieu_stock(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_lieu_stock";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_lieu_stock";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
	} 
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_lieu_stock";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
	}
	
	if ((mode_parms == "visual") || (mode_parms == "delete")) {
		make_form_readonly(document.getElementById("lieu_stock_form"));
	}
}
function load_regions_for_form_lieu_stock() {
	document.getElementById("id_region_lieu_stock").innerHTML = '<option value=""></option>';
	document.getElementById("id_departement_lieu_stock").innerHTML = '<option value=""></option>';
	document.getElementById("id_arrondissement_lieu_stock").innerHTML = '<option value=""></option>';
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var regions = JSON.parse(xhr.responseText);
				if (regions.length != 0) {
					for (var i = 0; i < regions.length; i++) {
						document.getElementById('id_region_lieu_stock').options.add(new Option(regions[i].libelle_fr, regions[i].id_region));
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
	xhr.send("action=get_regions");
}
function load_departements_for_form_lieu_stock() {
	document.getElementById("id_departement_lieu_stock").innerHTML = '<option value=""></option>';
	document.getElementById("id_arrondissement_lieu_stock").innerHTML = '<option value=""></option>';
	if (document.getElementById("id_region_lieu_stock").value != null && document.getElementById("id_region_lieu_stock").value != '') {
		xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					var departements = JSON.parse(xhr.responseText);
					if (departements.length != 0) {
						for (var i = 0; i < departements.length; i++) {
							document.getElementById('id_departement_lieu_stock').options.add(new Option(departements[i].libelle, departements[i].id_departement));
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
		xhr.send("action=get_departements&id_region=" + document.getElementById('id_region_lieu_stock').value);
	}
	else {

	}
}
function load_arrondissements_for_form_lieu_stock() {
	document.getElementById("id_arrondissement_lieu_stock").innerHTML = '<option value=""></option>';
	if (document.getElementById("id_departement_lieu_stock").value != null && document.getElementById("id_departement_lieu_stock").value != '') {
		xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					var arrondissements = JSON.parse(xhr.responseText);
					if (arrondissements.length != 0) {
						for (var i = 0; i < arrondissements.length; i++) {
							document.getElementById('id_arrondissement_lieu_stock').options.add(new Option(arrondissements[i].libelle, arrondissements[i].id_arrondissement));
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
		xhr.send("action=get_arrondissements&id_departement=" + document.getElementById('id_departement_lieu_stock').value);
	}
	else {

	}
}
function load_lieu_stock_for_form_lieu_stock(parms) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var lieu_stock = JSON.parse(xhr.responseText);
				if (lieu_stock.length == 1) {
					document.getElementById("id_lieu_stock").value = lieu_stock[0].id_lieu_stock;
					document.getElementById("libelle_fr_lieu_stock").value = lieu_stock[0].libelle_fr;
					document.getElementById("libelle_en_lieu_stock").value = lieu_stock[0].libelle_en;
					load_regions_for_form_lieu_stock();
					document.getElementById("id_region_lieu_stock").value = lieu_stock[0].id_region;
					load_departements_for_form_lieu_stock();
					document.getElementById("id_departement_lieu_stock").value = lieu_stock[0].id_departement;
					load_arrondissements_for_form_lieu_stock();
					document.getElementById("id_arrondissement_lieu_stock").value = lieu_stock[0].id_arrondissement;
					document.getElementById("localite_lieu_stock").value = lieu_stock[0].localite;
					document.getElementById("observation_lieu_stock").value = lieu_stock[0].observation;
				}
				else {
					alert("Le lieu de stockage recherché n'a pas été trouvé");
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
	xhr.send("action=get_lieux_stock&id_lieu_stock=" + urlParams.get("id_lieu_stock"));
}
function load_form_lieu_stock(mode_parms, parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				load_action_for_form_lieu_stock(mode_parms);
				load_regions_for_form_lieu_stock();
				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
					load_lieu_stock_for_form_lieu_stock(parms);
				}
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
	xhr.send("page=form_" + mode_parms + "_lieu_stock");
}
function save_lieu_stock() {
	if (document.getElementById("lieu_stock_form").checkValidity() == true) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) {
				try {
					if (xhr.responseText == "1") {
						alert("Opération effectuée avec succès");
					}
					else {
						alert(xhr.responseText);
					}
				}
				catch (e) {
				  alert("Parsing error:"+e); 
				}
			}
		}
		xhr.open("POST", "index.php");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(serializeForm(document.getElementById("lieu_stock_form")));
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}