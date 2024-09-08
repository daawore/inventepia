function load_action_for_form_utilisateur(mode_parms)
{
	if (mode_parms == "add")
	{
		document.getElementById("action").value = "add_utilisateur";
		document.getElementById("add_btn").hidden = false;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("reinit_pass_btn").hidden = true;
		document.getElementById("change_pass_btn").hidden = true;
	}
	else if (mode_parms == "modify")
	{
		document.getElementById("action").value = "modify_utilisateur";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = false;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("reinit_pass_btn").hidden = true;
		document.getElementById("change_pass_btn").hidden = true;
	}
	else if (mode_parms == "delete")
	{
		document.getElementById("action").value = "delete_utilisateur";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = false;
		document.getElementById("reinit_pass_btn").hidden = true;
		document.getElementById("change_pass_btn").hidden = true;
	}
	else if (mode_parms == "reinit_pass")
	{
		document.getElementById("action").value = "reinit_pass_utilisateur";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("reinit_pass_btn").hidden = false;
		document.getElementById("change_pass_btn").hidden = true;
	}
	else if (mode_parms == "change_pass")
	{
		document.getElementById("action").value = "change_pass_utilisateur";
		document.getElementById("add_btn").hidden = true;
		document.getElementById("modif_btn").hidden = true;
		document.getElementById("del_btn").hidden = true;
		document.getElementById("reinit_pass_btn").hidden = true;
		document.getElementById("change_pass_btn").hidden = false;
	}
	
	if ((mode_parms == "visual") || (mode_parms == "delete") || (mode_parms == "reinit_pass") || (mode_parms == "change_pass"))
	{
		make_form_readonly(document.getElementById("utilisateur_form"));
	}

	if (mode_parms == "reinit_pass") {
		document.getElementById("pass").readOnly = "";
	}

	if (mode_parms == "change_pass") {
		document.getElementById("old_pass").readOnly = "";
		document.getElementById("new_pass1").readOnly = "";
		document.getElementById("new_pass2").readOnly = "";
	}
	
}

function load_profils_dispo_for_form_utilisateur() {
	document.getElementById("select_profils_dispo").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var profils_dispo = JSON.parse(xhr.responseText);
				if (profils_dispo.length != 0) {
					for (var i = 0; i < profils_dispo.length; i++) {
						add_profil_dispo_for_form_utilisateur("?id_profil=" + profils_dispo[i].id_profil + "&libelle_fr_profil=" + profils_dispo[i].libelle_fr);
					}
				}
			}
			catch (e) {
			  alert("Erreur avec le message : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_profils_utilisateur_dispo&id_utilisateur=" + document.getElementById("id_utilisateur").value);
}

function load_profils_utilisateur_for_form_utilisateur() {
	document.getElementById("select_profils_utilisateur").innerHTML = "";
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var profils_utilisateur = JSON.parse(xhr.responseText);
			}
			catch (e) {
			  alert("Erreur avec le message suivant : " + e); 
			}
			if (profils_utilisateur.length != 0) {
				for (var i = 0; i < profils_utilisateur.length; i++) {
					add_profil_utilisateur_for_form_utilisateur("?id_profil=" + profils_utilisateur[i].id_profil + "&libelle_fr_profil=" + profils_utilisateur[i].libelle_fr_profil);
				}
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_profils_utilisateur&id_utilisateur=" + document.getElementById("id_utilisateur").value);
}

function add_profil_utilisateur_for_form_utilisateur(parms) {
	const urlParams = new URLSearchParams(parms);
	var opt = document.createElement('option');
    opt.value = urlParams.get("id_profil");
    opt.innerHTML = urlParams.get("libelle_fr_profil");
    document.getElementById("select_profils_utilisateur").appendChild(opt);
}

function del_profil_utilisateur_for_form_utilisateur(parms) {
	const urlParams = new URLSearchParams(parms);
	if (document.getElementById('table_profils_utilisateur').getElementsByTagName("tbody").item(0).rows.length > 0) {
		var i = 0;
		while ((i < document.getElementById('table_profils_utilisateur').getElementsByTagName("tbody").item(0).rows.length) && (document.getElementById('table_profils_utilisateur').getElementsByTagName("tbody").item(0).rows[i].cells[0].innerHTML != urlParams.get("id_profik"))) {
			i++;
		}
		if (i < document.getElementById('table_profils_utilisateur').getElementsByTagName("tbody").item(0).rows.length) {
			document.getElementById('table_profils_utilisateur').getElementsByTagName("tbody").item(0).deleteRow(i);
		}
	}
}

function add_profil_dispo_for_form_utilisateur(parms) {
    const urlParams = new URLSearchParams(parms);
	var opt = document.createElement('option');
    opt.value = urlParams.get("id_profil");
    opt.innerHTML = urlParams.get("libelle_fr_profil");
    document.getElementById("select_profils_dispo").appendChild(opt);
}

function del_profil_dispo_for_form_utilisateur(parms) {
	const urlParams = new URLSearchParams(parms);
	if (document.getElementById('table_profils_dispo').getElementsByTagName("tbody").item(0).rows.length > 0) {
		var i = 0;
		while ((i < document.getElementById('table_profils_dispo').getElementsByTagName("tbody").item(0).rows.length) && (document.getElementById('table_profils_dispo').getElementsByTagName("tbody").item(0).rows[i].cells[0].innerHTML != urlParams.get("id_utilisateur"))) {
			i++;
		}	
		if (i < document.getElementById('table_profils_dispo').getElementsByTagName("tbody").item(0).rows.length) {
			document.getElementById('table_profils_dispo').getElementsByTagName("tbody").item(0).deleteRow(i);
		}
	}
}

function add_select_profil_for_form_utilisateur() {
	var opt = document.createElement('option');
    opt.value = document.getElementById('select_profils_dispo').options[document.getElementById('select_profils_dispo').selectedIndex].value;
    opt.text = document.getElementById('select_profils_dispo').options[document.getElementById('select_profils_dispo').selectedIndex].text;
    document.getElementById("select_profils_utilisateur").appendChild(opt);
    sortSelect(document.getElementById("select_profils_utilisateur"));
    document.getElementById('select_profils_dispo').options[document.getElementById('select_profils_dispo').selectedIndex] = null;
    sortSelect(document.getElementById("select_profils_dispo"));
}

function remove_select_profil_for_form_utilisateur() {
	var opt = document.createElement('option');
    opt.value = document.getElementById('select_profils_utilisateur').options[document.getElementById('select_profils_utilisateur').selectedIndex].value;
    opt.text = document.getElementById('select_profils_utilisateur').options[document.getElementById('select_profils_utilisateur').selectedIndex].text;
    document.getElementById("select_profils_dispo").appendChild(opt);
    sortSelect(document.getElementById("select_profils_dispo"));
    document.getElementById('select_profils_utilisateur').options[document.getElementById('select_profils_utilisateur').selectedIndex] = null;
    sortSelect(document.getElementById("select_profils_utilisateur"));
}

function load_type_utilisateur_for_form_utilisateur() {
	document.getElementById("id_type_utilisateur").innerHTML = "";
	document.getElementById('id_type_utilisateur').options.add(new Option("", ""));
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var types_utilisateurs = JSON.parse(xhr.responseText);
				if (types_utilisateurs.length != 0) {
					for (var i = 0; i < types_utilisateurs.length; i++) {
						document.getElementById('id_type_utilisateur').options.add(new Option(types_utilisateurs[i].libelle_fr, types_utilisateurs[i].id_type_utilisateur));
					}
				}
			}
			catch(e) {
				alert("Erreur avec le message suivant : " + e); 
			}
		}
	}
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_types_utilisateurs");
}

function load_utilisateur_for_form_utilisateur(id_utilisateur_parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var utilisateur = JSON.parse(xhr.responseText);
				
				if (utilisateur.length == 1) {
					document.getElementById("id_utilisateur").value = utilisateur[0].id_utilisateur;
					document.getElementById("username").value = utilisateur[0].username_utilisateur;
					document.getElementById("nom_prenom").value = utilisateur[0].nom_prenom_utilisateur;
					document.getElementById("email").value = utilisateur[0].email_utilisateur;
					document.getElementById("id_type_utilisateur").value = utilisateur[0].id_type_utilisateur;
					load_profils_dispo_for_form_utilisateur();
					load_profils_utilisateur_for_form_utilisateur();
				}
			}
			catch (e) {
			  alert("Erreur avec le message suivant : " + e); 
			}
		}
	}
	
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	if (id_utilisateur_parms != null) {
		xhr.send("action=get_utilisateurs&id_utilisateur=" + id_utilisateur_parms);
	}
	else {
		xhr.send("action=get_utilisateurs&utilisateur_connecte");
	}
}

function load_utilisateur_for_form_reinit_pass_utilisateur(id_utilisateur_parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var utilisateur = JSON.parse(xhr.responseText);
				if (utilisateur.length == 1) {
					document.getElementById("id_utilisateur").value = utilisateur[0].id_utilisateur;
					document.getElementById("username").value = utilisateur[0].username_utilisateur;
					document.getElementById("nom_prenom").value = utilisateur[0].nom_prenom_utilisateur;
					document.getElementById("email").value = utilisateur[0].email_utilisateur;
				}
			}
			catch (e) {
			  alert("Erreur avec le message suivant : " + e); 
			}
		}
	}
	
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_utilisateurs&connected_user");
}

function load_utilisateur_for_form_change_pass_utilisateur() {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var utilisateur = JSON.parse(xhr.responseText);
				if (utilisateur.length == 1) {
					document.getElementById("id_utilisateur").value = utilisateur[0].id_utilisateur;
					document.getElementById("username").value = utilisateur[0].username_utilisateur;
					document.getElementById("nom_prenom").value = utilisateur[0].nom_prenom_utilisateur;
					document.getElementById("email").value = utilisateur[0].email_utilisateur;
				}
			}
			catch (e) {
			  alert("Erreur avec le message suivant : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=get_utilisateurs&username=" + document.getElementById("username").value);
}

function load_form_utilisateur(mode_parms, id_utilisateur_parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				load_action_for_form_utilisateur(mode_parms);
				load_type_utilisateur_for_form_utilisateur();
				if (["modify", "visual", "delete", "reinit_pass"].indexOf(mode_parms) != -1) {
					load_utilisateur_for_form_utilisateur(id_utilisateur_parms);
				}
				if (mode_parms == "change_pass") {
					load_utilisateur_for_form_utilisateur(null);
				}
				// document.getElementById('mydialog').showModal();
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch (e) {
			  alert("Erreur avec le message suivant : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_" + mode_parms + "_utilisateur");
}

function load_form_reinit_pass_utilisateur(id_utilisateur_parms) {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				document.getElementById("action").value = "reinit_pass_utilisateur";
				load_utilisateur_for_form_reinit_pass_utilisateur(id_utilisateur_parms);
				// document.getElementById('mydialog').showModal();
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch (e) {
			  alert("Erreur avec le message suivant : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_reinit_pass_utilisateur");
}


function load_form_change_pass_utilisateur(username_parms){
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				// document.getElementById("contenu_dialog").innerHTML = xhr.responseText;
				document.getElementById("id-modal-form").innerHTML = xhr.responseText;
				document.getElementById("action").value = "change_pass_utilisateur";
				load_utilisateur_for_form_change_pass_utilisateur();
				// document.getElementById('mydialog').showModal();
				(new bootstrap.Modal(document.getElementById('id-modal-form'))).show();
			}
			catch (e) {
			  alert("Erreur avec le message suivant : " + e); 
			}
		}
	}
	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_change_pass_utilisateur");
}

function save_utilisateur() {
	if (document.getElementById("utilisateur_form").checkValidity() == true) {
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
				  alert("Erreur avec le message suivant : " + e); 
				}
			}
		}
		xhr.open("POST", "index.php");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		document.getElementById("utilisateur_form");
		var params = "";
		params = serializeForm(document.getElementById("utilisateur_form"));
		if (document.getElementById('select_profils_dispo').options.length > 0) {
			i = 0;
			while (i < document.getElementById('select_profils_dispo').options.length) {
				params = params + "&id_profils_dispo[]=" + document.getElementById('select_profils_dispo').options[i].value;
				i++;
			}
		}
		if (document.getElementById('select_profils_utilisateur').options.length > 0) {
			i = 0;
			while (i < document.getElementById('select_profils_utilisateur').options.length) {
				params = params + "&id_profils_utilisateur[]=" + document.getElementById('select_profils_utilisateur').options[i].value;
				i++;
			}
		}
		xhr.send(params);
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}

function save_change_pass_utilisateur() {
	if (document.getElementById("change_pass_utilisateur_form").checkValidity() == true) {
		if (document.getElementById("new_pass1").value == document.getElementById("new_pass2").value) {
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
					  alert("Erreur avec le message suivant : " + e); 
					}
				}
			}
			xhr.open("POST", "index.php");
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			var params = "";
			params = serializeForm(document.getElementById("change_pass_utilisateur_form"));
			xhr.send(params);
		}
		else {
			alert("Les deux mots de passe répétés ne correspondent pas");
		}
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}

function save_reinit_pass_utilisateur() {
	if (document.getElementById("reinit_pass_utilisateur_form").checkValidity() == true) {
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
				  alert("Erreur avec le message suivant : " + e); 
				}
			}
		}
		xhr.open("POST", "index.php");
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		var params = "";
		xhr.send(params);
	}
	else {
		alert("Le formulaire n'est pas valide. Rassurez-vous de l'avoir correctement renseigné.");
	}
}