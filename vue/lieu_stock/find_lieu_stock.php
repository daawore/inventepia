<script type='text/javascript' src="vue/lieu_stock/find_lieu_stock.js"></script>
<script type='text/javascript' src="vue/lieu_stock/lieu_stock.js"></script>
<div id="div_rech_lieux_stock" style="width:100%; float:left; position:relative;">
	<form id="form_rech_lieux_stock" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container">
			<div class="form-floating form-floating-sm col" style="padding:5px">
				<input class="form-control" placeholder="Libellé" id="libelle_rech" name="libelle_rech" type="text" />
				<label for="libelle_rech">Libellé</label>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" name="rech_btn" id="rech_btn" onclick="load_lieux_stock_for_form_find_lieu_stock();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" name="nouveau_lieu_stock_btn" id="nouveau_lieu_stock_btn" onclick="load_form_lieu_stock('add', null);"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
		</div>
	</form>
</div>
<div id="div_lieux_stock" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_lieux_stock" style="width:100%;">
		<thead>
			<tr>
				<th width="10%" style="text-align:center">Id</th>
				<th width="15%" style="text-align:left">Libellé FR</th>
				<th width="15%" style="text-align:left">Lobellé EN</th>
				<th width="15%" style="text-align:left">Région</th>
				<th width="15%" style="text-align:left">Département</th>
				<th width="15%" style="text-align:left">Arrondissement</th>
				<th width="15%" style="text-align:left">Localité</th>
				<th width="15%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	table_to_datatable("#table_lieux_stock");
</script>