function load_action_for_form_profil(mode_parms) {
	if (mode_parms == "add") {
		document.getElementById("action").value = "add_profil";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "modify") {
		document.getElementById("action").value = "modify_profil";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
	}
	else if (mode_parms == "delete") {
		document.getElementById("action").value = "delete_profil";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
	}
	if ((mode_parms == "visual") || (mode_parms == "delete")) {
		make_form_readonly(document.getElementById("profil_form"));
	}
	
}

function load_droits_dispo_for_form_profil() {
	document.getElementById("select_droits_dispo").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var droits_dispo = JSON.parse(xhr.responseText);
				if (droits_dispo.length != 0) {
					for (var i = 0; i < droits_dispo.length; i++) {
						add_droit_dispo_for_form_profil("?id_droit=" + droits_dispo[i].id_droit + "&libelle_fr_droit=" + droits_dispo[i].libelle_fr);
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
	xhr.send("action=get_droits_dispo&id_profil=" + document.getElementById("id_profil").value);
}

function load_droits_profil_for_form_profil() {
	document.getElementById("select_droits_profil").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var droits_profil = JSON.parse(xhr.responseText);
			}
			catch (e) {
			  alert("Parsing error : " + e); 
			}
			if (droits_profil.length != 0) {
				for (var i = 0; i < droits_profil.length; i++) {
					add_droit_profil_for_form_profil("?id_droit=" + droits_profil[i].id_droit + "&libelle_fr_droit=" + droits_profil[i].libelle_fr_droit);
				}
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_droits_profil&id_profil=" + document.getElementById("id_profil").value);
}

function add_droit_profil_for_form_profil(parms) {
	const urlParams = new URLSearchParams(parms);
	var opt = document.createElement('option');
    opt.value = urlParams.get("id_droit");
    opt.innerHTML = urlParams.get("libelle_fr_droit");
    document.getElementById("select_droits_profil").appendChild(opt);
}


function del_droit_profil_for_form_profil(parms) {
	const urlParams = new URLSearchParams(parms);
	if (document.getElementById('table_droits_profil').getElementsByTagName("tbody").item(0).rows.length > 0) {
		var i = 0;
		while ((i < document.getElementById('table_droits_profil').getElementsByTagName("tbody").item(0).rows.length) && (document.getElementById('table_droits_profil').getElementsByTagName("tbody").item(0).rows[i].cells[0].innerHTML != urlParams.get("id_droit"))) {
			i++;
		}
		if (i < document.getElementById('table_droits_profil').getElementsByTagName("tbody").item(0).rows.length) {
			document.getElementById('table_droits_profil').getElementsByTagName("tbody").item(0).deleteRow(i);
		}
	}
}

function add_droit_dispo_for_form_profil(parms) {
    const urlParams = new URLSearchParams(parms);
	var opt = document.createElement('option');
    opt.value = urlParams.get("id_droit");
    opt.innerHTML = urlParams.get("libelle_fr_droit");
    document.getElementById("select_droits_dispo").appendChild(opt);
}

function del_droit_dispo_for_form_profil(parms) {
	const urlParams = new URLSearchParams(parms);
	if (document.getElementById('table_droits_dispo').getElementsByTagName("tbody").item(0).rows.length > 0) {
		var i = 0;
		while ((i < document.getElementById('table_droits_dispo').getElementsByTagName("tbody").item(0).rows.length) && (document.getElementById('table_droits_dispo').getElementsByTagName("tbody").item(0).rows[i].cells[0].innerHTML != urlParams.get("id_profil"))) {
			i++;
		}	
		if (i < document.getElementById('table_droits_dispo').getElementsByTagName("tbody").item(0).rows.length) {
			document.getElementById('table_droits_dispo').getElementsByTagName("tbody").item(0).deleteRow(i);
		}
	}
}

function add_select_droit_for_form_profil() {
	var opt = document.createElement('option');
    opt.value = document.getElementById('select_droits_dispo').options[document.getElementById('select_droits_dispo').selectedIndex].value;
    opt.text = document.getElementById('select_droits_dispo').options[document.getElementById('select_droits_dispo').selectedIndex].text;
    document.getElementById("select_droits_profil").appendChild(opt);
    sortSelect(document.getElementById("select_droits_profil"));
    document.getElementById('select_droits_dispo').options[document.getElementById('select_droits_dispo').selectedIndex] = null;
    sortSelect(document.getElementById("select_droits_dispo"));
}

function remove_select_droit_for_form_profil() {
	var opt = document.createElement('option');
    opt.value = document.getElementById('select_droits_profil').options[document.getElementById('select_droits_profil').selectedIndex].value;
    opt.text = document.getElementById('select_droits_profil').options[document.getElementById('select_droits_profil').selectedIndex].text;
    document.getElementById("select_droits_dispo").appendChild(opt);
    sortSelect(document.getElementById("select_droits_dispo"));
    document.getElementById('select_droits_profil').options[document.getElementById('select_droits_profil').selectedIndex] = null;
    sortSelect(document.getElementById("select_droits_profil"));
}

function load_profil_for_form_profil(id_profil_parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var profil = JSON.parse(xhr.responseText);
				if (profil.length == 1) {
					document.getElementById("id_profil").value = profil[0].id_profil;
					document.getElementById("libelle_fr_profil").value = profil[0].libelle_fr;
					document.getElementById("libelle_en_profil").value = profil[0].libelle_en;
					load_droits_dispo_for_form_profil();
					load_droits_profil_for_form_profil();
				}
			}
			catch (e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_profils&id_profil=" + id_profil_parms);
}

function load_form_profil(mode_parms, id_profil_parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				load_action_for_form_profil(mode_parms);
                if (mode_parms == "add") {
                    load_droits_dispo_for_form_profil();
                }
				if (["modify", "visual", "delete"].indexOf(mode_parms) != -1) {
                    load_profil_for_form_profil(id_profil_parms);
				}
				// document.getElementById('mydialog').showModal();
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch (e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_" + mode_parms + "_profil");
}

function save_profil() {
	if (document.getElementById("profil_form").checkValidity() == true) {
		xhr = new XMLHttpRequest();
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
				  alert("Parsing error : " + e); 
				}
			}
		}
		xhr.open("POST", "index.php");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		var params = "";
		params = serializeForm(document.getElementById("profil_form"));
		if (document.getElementById('select_droits_dispo').options.length > 0) {
			i = 0;
			while (i < document.getElementById('select_droits_dispo').options.length) {
				params = params + "&id_droits_dispo[]=" + document.getElementById('select_droits_dispo').options[i].value;
				i++;
			}
		}
		if (document.getElementById('select_droits_profil').options.length > 0) {
			i = 0;
			while (i < document.getElementById('select_droits_profil').options.length) {
				params = params + "&id_droits_profil[]=" + document.getElementById('select_droits_profil').options[i].value;
				i++;
			}
		}
		xhr.send(params);
	}
	else{
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}