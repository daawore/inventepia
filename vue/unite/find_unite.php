<script type='text/javascript' src="vue/unite/find_unite.js"></script>
<script type='text/javascript' src="vue/unite/unite.js"></script>
<div id="div_rech_unites" style="width:100%; float:left; position:relative;">
	<form id="form_rech_unites" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container">
			<div class="form-floating form-floating-sm col" style="padding:5px">
				<input class="form-control" placeholder="Libellé" id="libelle_rech" name="libelle_rech" type="text" />
				<label for="libelle_rech">Libellé</label>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" name="rech_btn" id="rech_btn" onclick="load_unites_for_form_find_unite();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" name="nouvelle_unite_btn" id="nouvelle_unite_btn" onclick="load_form_unite('add', null);"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
		</div>
	</form>
</div>
<div id="div_unites" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_unites" style="width:100%;">
		<thead>
			<tr>
				<th width="20%" style="text-align:center">Id</th>
				<th width="30%" style="text-align:left">Libellé FR</th>
				<th width="30%" style="text-align:left">Libellé EN</th>
				<th width="20%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	table_to_datatable("#table_unites");
</script>