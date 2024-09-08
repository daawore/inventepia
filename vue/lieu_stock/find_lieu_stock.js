function load_lieux_stock_for_form_find_lieu_stock() {
	//Vidage du tableau des lieux de stockage
	showLoader();
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			try {
				var lieux_stock = JSON.parse(xhr.responseText);
				var new_lieux_stock = [];
				if (lieux_stock.length <= 0) {
					alert("Aucun lieu de stockage trouvé pour ces critères");
				}
				else {
					for (var i = 0; i < lieux_stock.length; i++) {
						action_html = "<div style=\"white-space: nowrap;\">";
						action_html += "<button class=\"btn btn-secondary\" style=\"margin:2px;\"  onclick='load_form_lieu_stock(" + '"visual", "?id_lieu_stock=' +  lieux_stock[i].id_lieu_stock + '"' + ");' title='Visualiser'><i class='fa-solid fa-eye size-fa'></i></button>";
						action_html += "<button class=\"btn btn-primary\" style=\"margin:2px;\"  onclick='load_form_lieu_stock(" + '"modify", "?id_lieu_stock=' +  lieux_stock[i].id_lieu_stock + '"' + ");' title='Modifier'><i class='fa-solid fa-pen-to-square size-fa'></i></button>";
						action_html += "<button class=\"btn btn-danger\" style=\"margin:2px;\"  onclick='load_form_lieu_stock(" + '"delete", "?id_lieu_stock=' +  lieux_stock[i].id_lieu_stock + '"' + ");' title='Supprimer'><i class='fa-solid fa-trash size-fa'></i></button>";
						action_html += "</div>";
						new_lieux_stock.push([
							lieux_stock[i].id_lieu_stock,
							lieux_stock[i].libelle_fr,
							lieux_stock[i].libelle_en,
							lieux_stock[i].libelle_fr_region,
							lieux_stock[i].libelle_departement,
							lieux_stock[i].libelle_arrondissement,
							lieux_stock[i].localite,
							action_html
						]);
					}
				}
				var table = $('#table_lieux_stock').DataTable();
				table.clear();
				table.rows.add(new_lieux_stock).draw();
			} 
			catch(e) {
			  alert("Parsing error : " + e); 
			}
		}
	}
	
	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	parms = "action=get_lieux_stock";
	
	if (document.getElementById('libelle_rech').value != "") {
		parms = parms + "&libelle_fr=" + document.getElementById('libelle_rech').value;
	}
	setTimeout(function() {
		xhr.send(parms);
	}, 1);
	hideLoader();
}