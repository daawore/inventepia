<script type='text/javascript' src="vue/personnel/find_personnel.js"></script>
<script type='text/javascript' src="vue/personnel/personnel.js"></script>
<div id="div_rech_personnels" style="width:100%; float:left; position:relative;">
	<form id="form_rech_personnels" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container">
			<div class="row" style="padding:5px">
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Matricule" id="matricule_rech" name="matricule_rech" type="text" />
					<label for="matricule_rech">Matricule</label>
				</div>
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Noms et prénoms" id="nom_prenom_rech" name="nom_prenom_rech" type="text" />
					<label for="nom_prenom_rech">Noms et prénoms</label>
				</div>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" name="rech_btn" id="rech_btn" onclick="load_personnels_for_form_find_personnel();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" name="nouvelle_personnel_btn" id="nouvelle_personnel_btn" onclick="load_form_personnel('add', null);"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
		</div>
	</form>
</div>
<div id="div_personnels" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_personnels" style="width:100%;">
		<thead>
			<tr>
				<th width="20%" style="text-align:center">Id</th>
				<th width="30%" style="text-align:left">Matricule</th>
				<th width="30%" style="text-align:left">Noms et prénoms</th>
				<th width="20%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	table_to_datatable("#table_personnels");
</script>