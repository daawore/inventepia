<script type='text/javascript' src="vue/bien/find_type_bien.js"></script>
<script type='text/javascript' src="vue/bien/type_bien.js"></script>
<div id="div_rech_types_biens" style="width:100%; float:left; position:relative;">
	<form id="form_rech_types_biens" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container" style="padding:5px">
			<div class="row" style="padding:5px">
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<select class="form-select" placeholder="Catégorie" id="id_categorie_rech" name="id_categorie_rech"></select>
					<label for="id_categorie_rech">Catégorie</label>
				</div>
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Libellé" id="libelle_type_bien_rech" name="libelle_type_bien_rech" type="text" />
					<label for="libelle_type_bien_rech">Libellé</label>
				</div>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" onclick="load_types_biens_for_form_find_type_bien();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" onclick="load_form_type_bien('add', null);"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
		</div>
	</form>
</div>
<div id="div_types_biens" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_types_biens" style="width:100%;">
		<thead>
			<tr>
				<th width="5%" style="text-align:center">Id</th>
				<th width="22%" style="text-align:left">Catégorie</th>
				<th width="22%" style="text-align:left">Libellé en  français</th>
				<th width="22%" style="text-align:left">Libellé en  anglais</th>
				<th width="8%" style="text-align:left">Quantifiable ?</th>
				<th width="8%" style="text-align:left">Périssable ?</th>
				<th width="8%" style="text-align:left">Attribuable ?</th>
				<th width="5%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	load_categories_for_form_find_type_bien();
	table_to_datatable("#table_types_biens");
</script>