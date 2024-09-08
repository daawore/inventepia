<script type='text/javascript' src="vue/commande/find_commande.js"></script>
<script type='text/javascript' src="vue/commande/commande.js"></script>
<div id="div_rech_commandes" style="width:100%; float:left; position:relative;">
	<form id="form_rech_commandes" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container" style="padding:5px">
			<div class="row" style="padding:5px">
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Reférence" id="reference_rech" name="reference_rech" type="text" />
					<label for="reference_rech">Reférence</label>
				</div>
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Intitulé" id="intitule_rech" name="intitule_rech" type="text" />
					<label for="intitule_rech">Intitulé</label>
				</div>
			</div>
			<div class="row" style="padding:5px">
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Consistance" id="consistance_rech" name="consistance_rech" type="text" />
					<label for="consistance_rech">Consistance</label>
				</div>
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<select class="form-control" placeholder="Type de commande" id="id_type_commande_rech" name="id_type_commande_rech"></select>
					<label for="id_type_commande_rech">Type de commande</label>
				</div>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" name="rech_btn" id="rech_btn" onclick="load_commandes_for_form_find_commande();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" name="nouvelle_commande_btn" id="nouvelle_commande_btn" onclick="load_form_commande('add', null);"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
		</div>
	</form>
</div>
<div id="div_commandes" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_commandes" style="width:100%;">
		<thead>
			<tr>
				<th width="5%" style="text-align:center">Id</th>
				<th width="5%" style="text-align:left">Référence</th>
				<th width="5%" style="text-align:center">Date de signature</th>
				<th width="5%" style="text-align:left">Type</th>
				<th width="8%" style="text-align:left">Intitulé FR</th>
				<th width="8%" style="text-align:left">Prestataire</th>
				<th width="5%" style="text-align:right">Montant TTC</th>
				<th width="5%" style="text-align:right">TVA</th>
				<th width="5%" style="text-align:right">Montant HT</th>
				<th width="5%" style="text-align:right">IR</th>
				<th width="5%" style="text-align:right">Net à percevoir</th>
				<th width="5%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	load_types_commandes_for_form_find_commande();
	table_to_datatable("#table_commandes");
</script>