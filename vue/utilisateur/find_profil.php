<script type='text/javascript' src="vue/utilisateur/find_profil.js"></script>
<script type='text/javascript' src="vue/utilisateur/profil.js"></script>
<div id="div_rech_profils" style="width:100%; float:left; position:relative;">
	<form id="rech_form" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container">
			<div class="form-floating form-floating-sm" style="padding:5px">
				<input class="form-control" placeholder="Libellé du profil" id="lib_profil_rech" name="lib_profil_rech" type="text" />
				<label for="lib_profil_rech">Libellé du profil</label>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" name="rech_btn" id="rech_btn" onclick="load_profils_for_form_find_profil();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" name="nouveau_profil_btn" id="nouveau_profil_btn" onclick="nouveau_profil_find_profil();"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
	</form>
</div>
<div id="div_profils" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_profils" style="width:100%;">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom du profil</th>
				<th>Droits du profil</th>
				<th>Utilisateurs du profil</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	table_to_datatable("#table_profils");
</script>