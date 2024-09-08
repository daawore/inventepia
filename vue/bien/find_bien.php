<script type='text/javascript' src="vue/bien/find_bien.js"></script>
<script type='text/javascript' src="vue/bien/bien.js"></script>
<div id="div_rech_biens" style="width:100%; float:left; position:relative;">
	<form id="form_rech_biens" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container" style="padding:5px">
			<div class="row" style="padding:5px">
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<select class="form-select" placeholder="Catégorie" id="id_categorie_bien_rech" name="id_categorie_bien_rech"></select>
					<label for="id_categorie_bien_rech">Catégorie</label>
				</div>
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Désignation" id="designation_bien_rech" name="designation_bien_rech" type="text" />
					<label for="designation_bien_rech">Désignation</label>
				</div>
			</div>
			<div class="row" style="padding:5px">
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Matricule du détenteur" id="matricule_detenteur_bien_rech" name="matricule_detenteur_bien_rech" type="text" />
					<label for="matricule_detenteur_bien_rech">Matricule du détenteur</label>
				</div>
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Noms et prénoms du détenteur" id="nom_prenom_detenteur_bien_rech" name="nom_prenom_detenteur_bien_rech" type="text" />
					<label for="nom_prenom_detenteur_bien_rech">Noms et prénoms du détenteur</label>
				</div>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" onclick="load_biens_for_form_find_bien();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" onclick="load_form_bien('add', null);"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
		</div>
	</form>
</div>

<div id="div_biens" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_biens" style="width:100%;">
		<thead>
			<tr>
				<th width="5%" style="text-align:center">Id</th>
				<th width="15%" style="text-align:left">Catégorie</th>
				<th width="15%" style="text-align:left">Type</th>
				<th width="21%" style="text-align:left">Désignation</th>
				<th width="7%" style="text-align:left">Quantité</th>
				<th width="13%" style="text-align:left">Détenteur</th>
				<th width="7%" style="text-align:left">Date d'attribution</th>
				<th width="17%" style="text-align:left">Commande</th>
				<th width="10%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	load_categories_bien_for_form_find_bien();
	table_to_datatable("#table_biens");
</script>