// Afficher l'icône de chargement
function showLoader() {
	document.getElementById("loader").style.display = "block";
}

// Masquer l'icône de chargement
function hideLoader() {
	setTimeout(function() {document.getElementById("loader").style.display = "none"}, 1)
}

function isMobileDevice() {
	if (navigator.userAgent.match(/iPhone/i)
		|| navigator.userAgent.match(/webOS/i)
		|| navigator.userAgent.match(/Android/i)
		|| navigator.userAgent.match(/iPad/i)
		|| navigator.userAgent.match(/iPod/i)
		|| navigator.userAgent.match(/BlackBerry/i)
		|| navigator.userAgent.match(/Windows Phone/i)
	) {
		return true;
	}
	else {
		return false;
	}
}

function serializeForm(form) {
	var input = form.getElementsByTagName("*");
	var params = "";
	for (var i = 0; i < input.length; i++) {
		if (["text", "textarea", "radio", "checkbox", "number", "select-one", "select-multiple", "date", "tel", "hidden", "password", "email"].indexOf(input[i].type) != -1) {
			if ((input[i].type != "checkbox") || (input[i].type == "checkbox" && input[i].checked == true)) {
				if (params != "") {
					params = params + "&";
				}
				params = params + input[i].name + "=" + input[i].value;
			}
		}
	}

	return params;
}

function make_form_readonly(form) {
	disabled_types = ["radio", "checkbox", "number", "select-one", "select-multiple"];
	readonly_types = ["text", "textarea", "date", "tel", "password", "email"];

	for (i = 0; i < form.length; i++) {
		if (disabled_types.indexOf(form[i].type) != -1) {
			form[i].disabled = "disabled";
		}
		else if (readonly_types.indexOf(form[i].type) != -1) {
			form[i].readOnly = "readOnly";
		}
	}
}

function formatInputToMonetaire(input) {
	input.value = formatToMonetaire(input.value);
}

function formatToMonetaire(parm) {
	return addThousandSeparators(parm.toString().replace(/[^0-9]/g, '')); // Formate la valeur avec des séparateurs de milliers
}

function formatToNumber(parm) {
	return parm.toString().replace(/[^0-9]/g, ''); // Supprime les caractères non autorisés sauf les chiffres
}

function addThousandSeparators(parm) {
	var sign = '';
	if (parm.charAt(0) === '-') {
		sign = '-';
		parm = parm.slice(1);
	}
	return sign + parm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' '); // Ajoute les séparateurs de milliers
}

function table_to_datatable(table_id){
	$(document).ready(function() {
		$(table_id).DataTable({
				"language": {
				// "lengthMenu": "Afficher _MENU_ éléments par page",
				// "zeroRecords": "Aucun résultat",
				// "info": "Page _PAGE_ sur _PAGES_",
				// "infoEmpty": "Aucune donnée disponible",
				// "infoFiltered": "(filtré à partir de _MAX_ éléments au total)",
				// "search": "Rechercher :",
				// "paginate": {
				// 	"first": "Première",
				// 	"last": "Dernière",
				// 	"next": "Suivante",
				// 	"previous": "Précédente"
				// },
				// "aria": {
				// 	"sortAscending": ": activer pour trier la colonne par ordre croissant",
				// 	"sortDescending": ": activer pour trier la colonne par ordre décroissant"
				// }

					"sProcessing":     "Traitement en cours...",
					"sSearch":         "Rechercher&nbsp;:",
					"sLengthMenu":     "Afficher _MENU_ éléments",
					"sInfo":           "Affichage de l'élément _START_ &agrave; _END_ sur _TOTAL_ éléments",
					"sInfoEmpty":      "Affichage de l'élément 0 &agrave; 0 sur 0 élément",
					"sInfoFiltered":   "(filté; de _MAX_ éléments au total)",
					"sInfoPostFix":    "",
					"sLoadingRecords": "Chargement en cours...",
					"sZeroRecords":    "Aucun élémentment &agrave; afficher",
					"sEmptyTable":     "Aucune donnée disponible dans le tableau",
					"oPaginate": {
						"sFirst":      "Premier",
						"sPrevious":   "Précédent",
						"sNext":       "Suivant",
						"sLast":       "Dernier"
					},
					"oAria": {
						"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
						"sSortDescending": ": activer pour trier la colonne par ordre décroissant"
					}
			}
		});
	});
}

function postForm(path, params, method) {
    method = method || 'post';

    var form = document.createElement('form');
    form.setAttribute('method', method);
    form.setAttribute('action', path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', key);
            hiddenField.setAttribute('value', params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}


function sortSelect(selElem) {
	var tmpAry = new Array();
	for (var i = 0; i < selElem.options.length; i++) {
		tmpAry[i] = new Array();
		tmpAry[i][0] = selElem.options[i].text;
		tmpAry[i][1] = selElem.options[i].value;
	}
	tmpAry.sort();
	while (selElem.options.length > 0) {
		selElem.options[0] = null;
	}
	for (var i = 0; i < tmpAry.length; i++) {
		var op = new Option(tmpAry[i][0], tmpAry[i][1]);
		selElem.options[i] = op;
	}
	return;
}

function move_option_select(select, index, direction) {
	// Récupérer les options dans un tableau
	const options = Array.from(select.options);

	// Supprimer l'option de sa position actuelle
	const optionToMove = options.splice(index, 1)[0];

	newIndex = index;
	if (index > 0 && direction == "up") {
		newIndex = index - 1;
	}
	if (index < select.options.length -1 && direction == "down") {
		newIndex = index +1;
	}
	
	options.splice(newIndex, 0, optionToMove);

	// Mettre à jour les options du <select>
	select.options.length = 0;
	options.forEach(option => select.add(option));
}

function show_loader() {
	document.getElementById('my_load_dialog').innerHTML = '<div><i class="fas fa-circle-notch fa-spin" style="font-size:4em; color:green;"></i></div>';
	document.getElementById('my_load_dialog').showModal();
}

function hide_loader() {
	document.getElementById('my_load_dialog').innerHTML = '';
	document.getElementById('my_load_dialog').close();
}

function ifnotnull(value, valueifnull) {
	if (value == null) { return valueifnull; }
	else { return value; }
}

function load_tableau_bord() {
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			try {
				var exercice = JSON.parse(xhr.responseText);

				if (exercice.length >= 1) {
					return exercice;
				}
			}
			catch (e) {
				alert("Parsing error:" + e);
				return null;
			}
		}
	}

	const urlParams = new URLSearchParams(window.location.search);

	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("page=form_tableau_bord");
}

function get_page_html(parms) {
	var page_html = null;

	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			try {
				page_html = xhr.responseText;
			}
			catch (e) {
				alert("Parsing error:" + e);
			}
		}
	}

	xhr.open("POST", "index.php", false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.send(parms);

	return page_html;
}

function get_exercices(parms) {
	var exercices = null;

	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			try {
				exercices = JSON.parse(xhr.responseText);
			}
			catch (e) {
				alert("Parsing error:" + e);
			}
		}
	}

	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	content_send = "action=get_exercices";
	const urlParams = new URLSearchParams(parms);

	if (urlParams.get("id_exercice") != null) { content_send = content_send + "&id_exercice=" + urlParams.get("id_exercice"); }
	if (urlParams.get("id_etat_exercice") != null) { content_send = content_send + "&id_etat_exercice=" + urlParams.get("id_etat_exercice"); }
	if (urlParams.get("exercice_en_cours") != null) { content_send = content_send + "&en_cours=" + urlParams.get("en_cours"); }
	
	xhr.send(content_send);

	return exercices;
}

function get_exercices_en_cours(parms) {
	var exercices = null;

	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			try {
				exercices = JSON.parse(xhr.responseText);
			}
			catch (e) {
				alert("Parsing error:" + e);
			}
		}
	}

	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	content_send = "action=get_exercices&id_etat_exercice=2";
	const urlParams = new URLSearchParams(parms);
	

	
	// if (urlParams.get("id_exercice") != null) { content_send = content_send + "&id_exercice=" + urlParams.get("id_exercice"); }
	// if (urlParams.get("id_etat_exercice") != null) { content_send = content_send + "&id_etat_exercice=" + urlParams.get("id_etat_exercice"); }

	xhr.send(content_send);

	return exercices;
}


function get_assises(parms) {
	var assises = null;
	
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			try {
				assises = JSON.parse(xhr.responseText);
				return assises;
			}
			catch (e) {
				alert("Parsing error:" + e);
			}
		}
	}

	xhr.open('POST', 'index.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	content_send = "action=get_assises";
	const urlParams = new URLSearchParams(parms);
	
	if (urlParams.get("id_exercice") != null) { content_send = content_send + "&id_exercice=" + urlParams.get("id_exercice"); }
	if (urlParams.get("id_assise") != null) { content_send = content_send + "&id_assise=" + urlParams.get("id_assise"); }
	if (urlParams.get("id_etat_assise") != null) { content_send = content_send + "&id_etat_assise=" + urlParams.get("id_etat_assise"); }

	xhr.send(content_send);
}

function get_types_assises(parms) {
	var types_assises = null;

	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			try {
				types_assises = JSON.parse(xhr.responseText);
			}
			catch (e) {
				alert("Parsing error:" + e);
			}
		}
	}

	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	content_send = "action=get_types_assises";
	const urlParams = new URLSearchParams(parms);

	if (urlParams.get("id_type_assise") != null) { content_send = content_send + "&id_type_assise=" + urlParams.get("id_type_assise"); }
	if (urlParams.get("id_exercice") != null) { content_send = content_send + "&id_exercice=" + urlParams.get("id_exercice"); }
	if (urlParams.get("etat_assise") != null) { content_send = content_send + "&id_etat_assise=" + urlParams.get("etat_assise"); }

	xhr.send(content_send);

	return types_assises;
}

function get_etats_assises(parms) {
	var etats_assises = null;

	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			try {
				etats_assises = JSON.parse(xhr.responseText);
			}
			catch (e) {
				alert("Parsing error:" + e);
			}
		}
	}

	xhr.open('POST', 'index.php', false);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	content_send = "action=get_etats_assises";
	const urlParams = new URLSearchParams(parms);

	if (urlParams.get("id_etat_assise") != null) { content_send = content_send + "&id_etat_assise=" + urlParams.get("id_etat_assise"); }

	xhr.send(content_send);

	return etats_assises;
}

function export_to_png(parm_table, parm_title){
	html2canvas(parm_table).then(canvas => {
		image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
		var link = document.createElement('a');
		let date_actu = new moment();
		link.download = parm_title + "_" + date_actu.format('YYYYMMDD-hhmmss') +  ".png";
		link.href = image;
		link.click();
	});
}

function printPDF1() {
	window.jsPDF = window.jspdf.jsPDF
    var printDoc = new jsPDF('l', 'mm', 'a4');
    printDoc.fromHTML($('#table_finance_membre').get(0), 10, 10, {'width': 180});
    printDoc.autoPrint();
    printDoc.output("dataurlnewwindow"); // this opens a new popup,  after this the PDF opens the print window view but there are browser inconsistencies with how this is handled
}

function printPDF_etat_finance(parm_etat) {
	window.jsPDF = window.jspdf.jsPDF;
	var doc = new jsPDF('l', 'mm', 'a4');
	var pageHeight = doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
	var pageWidth = doc.internal.pageSize.width || doc.internal.pageSize.getWidth();
	var pageMargin = 15;
	
	if (parm_etat == "finance_membre"){
		var exercice = document.getElementById("id_exercice_finance_membre_rech").options[document.getElementById("id_exercice_finance_membre_rech").selectedIndex].text;
		if (document.getElementById("id_assise_finance_membre_rech").value == "") {
			var assise = "Toutes les assises";
		}
		else {
			var assise = document.getElementById("id_assise_finance_membre_rech").options[document.getElementById("id_assise_finance_membre_rech").selectedIndex].text;
		}
	}
	else if (parm_etat == "finance_assise"){
		var exercice = document.getElementById("id_exercice_finance_assise_rech").options[document.getElementById("id_exercice_finance_assise_rech").selectedIndex].text;
		if (document.getElementById("id_membre_finance_assise_rech").value == "") {
			var membre = "Tous les membres";
		}
		else {
			var membre = document.getElementById("id_membre_finance_assise_rech").options[document.getElementById("id_membre_finance_assise_rech").selectedIndex].text;
		}
	}
	var date_actu = new moment();
	
	doc.addFileToVFS("contenu/fonts/Oswald-Regular-normal.ttf", font_Oswald);
	doc.addFont("contenu/fonts/Oswald-Regular-normal.ttf", "Oswald", "normal");
	doc.setFont("Oswald");

	//
	var totalPagesExp = "{total_pages_count_string}";
	var pageContent = function (data){
		var str = "Page " + data.pageCount;
		if (typeof doc.putTotalPages === 'function'){
			str = str + " sur " + totalPagesExp;
		}
		doc.setFontSize(8);
		doc.text(str, pageMargin, pageHeight - 8);
	};

	doc.setFontSize(20);
	if (parm_etat == "finance_membre"){
		var titre = "ETAT DES FINANCES PAR MEMBRE";
	}
	else if (parm_etat == "finance_assise") {
		var titre = "ETAT DES FINANCES PAR ASSISE";
	}
	doc.text(titre, pageWidth/2, pageMargin, {fontSize: 20, align: 'center', fontStyle: 'bold'});
	
	doc.setFontSize(10);
	doc.text(
			"Exercice : " + exercice,
		pageWidth/4,
		pageMargin + 10,
		{fontSize: 8, align: 'center', fontStyle: 'bold'}
	);
	if (parm_etat == "finance_membre"){
		doc.text(
			"Assise : " + assise,
			pageWidth*3/4,
			pageMargin + 10,
			{fontSize: 8, align: 'center', fontStyle: 'bold'}
		);
	}
	else if (parm_etat == "finance_assise") {
		doc.text(
			"Membre : " + membre,
			pageWidth*3/4,
			pageMargin + 10,
			{fontSize: 7, align: 'center', fontStyle: 'bold'}
		);
	}
	
	if (parm_etat == "finance_membre"){
		var id_table_finance = '#table_finance_membre';
		var defaultColumnWidth = Math.trunc((pageWidth - 2*pageMargin)/21);
		var columStyles_finance = {
			0: 	{cellWidth: (pageWidth - 2*pageMargin - 19*defaultColumnWidth), halign: 'left'},
			1: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			2: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			3: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			4: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			5: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			6: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			7: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			8: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			9: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			10:	{cellWidth: defaultColumnWidth, halign: 'right'},
			11:	{cellWidth: defaultColumnWidth, halign: 'right'},
			12:	{cellWidth: defaultColumnWidth, halign: 'right'},
			13:	{cellWidth: defaultColumnWidth, halign: 'right'},
			14:	{cellWidth: defaultColumnWidth, halign: 'right'},
			15:	{cellWidth: defaultColumnWidth, halign: 'right'},
			16:	{cellWidth: defaultColumnWidth, halign: 'right'},
			17:	{cellWidth: defaultColumnWidth, halign: 'right'},
			18:	{cellWidth: defaultColumnWidth, halign: 'right'}
		}
	}
	else if (parm_etat == "finance_assise"){
		var id_table_finance = '#table_finance_assise';
		var defaultColumnWidth = Math.trunc((pageWidth - 2*pageMargin)/22);
		var columStyles_finance = {
			0: 	{cellWidth: (pageWidth - 2*pageMargin - 20*defaultColumnWidth), halign: 'left'},
			1: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			2: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			3: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			4: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			5: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			6: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			7: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			8: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			9: 	{cellWidth: defaultColumnWidth, halign: 'right'},
			10:	{cellWidth: defaultColumnWidth, halign: 'right'},
			11:	{cellWidth: defaultColumnWidth, halign: 'right'},
			12:	{cellWidth: defaultColumnWidth, halign: 'right'},
			13:	{cellWidth: defaultColumnWidth, halign: 'right'},
			14:	{cellWidth: defaultColumnWidth, halign: 'right'},
			15:	{cellWidth: defaultColumnWidth, halign: 'right'},
			16:	{cellWidth: defaultColumnWidth, halign: 'right'},
			17:	{cellWidth: defaultColumnWidth, halign: 'right'},
			18:	{cellWidth: defaultColumnWidth, halign: 'right'},
			19:	{cellWidth: defaultColumnWidth, halign: 'right'}
		}
	}
	
	doc.autoTable({
		startX : pageMargin,
		startY : pageMargin + 15,
		font : "Oswald",
		align: 'center',
		html: id_table_finance,
		styles: {
			overflow: 'linebreak',
			lineColor: [0, 0, 0],
			lineWidth: 0.1,
			font : "Oswald",
			fontSize: 7,
			halign: 'center',
			valign: 'middle',
			cellPadding: 1,
		},
		headStyles: {
            fillColor: "#1d4561",
            textColor: "#FFFFFF",
            fontSize: 7,
            fontStyle: 'bold'
        },
		footStyles: {
            fillColor: "#1d4561",
            textColor: "#FFFFFF",
            fontSize: 7,
            fontStyle: 'bold'
        },
		bodyStyles: {
			//fillColor: [216, 216, 216],
			//textColor: 0
			},
		// theme: 'grid',
		// margin: [10, 10, 20, 10],
		didDrawPage: pageContent,
		columnStyles: columStyles_finance
	});
	if(typeof doc.putTotalPages === 'function'){
		doc.putTotalPages(totalPagesExp);
	}

	doc.setFontSize(8);
	doc.text(date_actu.format('DD/MM/YYYY hh:mm:ss'),  pageWidth - pageMargin, pageHeight - 8, "right");

	// save the data to this file
	if (parm_etat == "finance_membre"){
		doc.save('etat_finance_par_membre_' + exercice + "_" + assise + "_" + date_actu.format('YYYYMMDD-hhmmss') +  ".pdf");
	}
	else if (parm_etat == "finance_assise"){
		doc.save('etat_finance_par_assise_' + exercice + "_" + membre + "_" + date_actu.format('YYYYMMDD-hhmmss') +  ".pdf");
	}
}

function numStr(a, b) {
	a = '' + a;
	b = b || ' ';
	var c = '',
		d = 0;
	while (a.match(/^0[0-9]/)) {
	  a = a.substr(1);
	}
	for (var i = a.length-1; i >= 0; i--) {
	  c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
	  d++;
	}
	return c;
  }

  function makeRequest(methd, url, async, parms) {
	return new Promise(function(resolve, reject) {
	  var xhr = new XMLHttpRequest();
	  xhr.open(method, url, async);
  
	  xhr.addEventListener("load", function() {
		if (xhr.status === 200) {
		  resolve(xhr.responseText);
		} else {
		  reject(xhr.statusText);
		}
	  });
  
	  xhr.addEventListener("error", function() {
		reject("Une erreur s'est produite lors de la requête");
	  });
  
	  xhr.send(parms);
	});
  }