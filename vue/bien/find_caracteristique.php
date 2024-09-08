<script type='text/javascript' src="vue/bien/find_caracteristique.js"></script>
<script type='text/javascript' src="vue/bien/caracteristique.js"></script>
<div id="div_rech_caracteristiques" style="width:100%; float:left; position:relative;">
	<form id="form_rech_caracteristiques" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container" style="padding:5px">
            <div class="form-floating form-floating-sm col" style="padding:5px">
                <input class="form-control" placeholder="Libellé en français" id="libelle_fr_caracteristique_rech" name="libelle_fr_caracteristique_rech" type="text" required />
                <label for="libelle_fr_caracteristique_rech">Libellé en français</label>
            </div>
            <div class="form-floating form-floating-sm col" style="padding:5px">
                <input class="form-control" placeholder="Libellé en anglais" id="libelle_en_caracteristique_rech" name="libelle_en_caracteristique_rech" type="text" />
                <label for="libelle_en_caracteristique_rech">Libellé en anglais</label>
            </div>
            <div class="form-floating form-floating-sm col" style="padding:5px">
                <select class="form-select" placeholder="Type" id="type_caracteristique_rech" name="type_caracteristique_rech">
                    <option value=""></option>
                    <option value="alpha">Alphanumérique</option>
                    <option value="number">Numérique</option>
                </select>
                <label for="type_caracteristique_rech">Type</label>
            </div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" onclick="load_caracteristiques_for_form_find_caracteristique();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" onclick="load_form_caracteristique('add', null);"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
		</div>
	</form>
</div>
<div id="div_caracteristiques" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_caracteristiques" style="width:100%;">
		<thead>
			<tr>
				<th width="5%" style="text-align:center">Id</th>
				<th width="25%" style="text-align:left">Libellé en français</th>
				<th width="10%" style="text-align:left">Abréviation en français</th>
				<th width="25%" style="text-align:left">Libellé en anglais</th>
				<th width="10%" style="text-align:left">Abréviation en anglais</th>
				<th width="15%" style="text-align:left">Type</th>
				<th width="10%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	table_to_datatable("#table_caracteristiques");
</script>