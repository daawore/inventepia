<script type='text/javascript' src="vue/utilisateur/find_utilisateur.js"></script>
<script type='text/javascript' src="vue/utilisateur/utilisateur.js"></script>
<div id="div_rech_utilisateurs" style="width:100%; float:left; position:relative;">
	<form id="rech_form" name="Recherche" method="POST" onsubmit="return false;">
		<div class="grid-container">
			<div class="row" style="padding:5px">
			<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Nom d'utilisateur" id="username_rech" name="username_rech" type="text" />
					<label for="username_rech">Nom d'utilisateur</label>
				</div>
				<div class="form-floating form-floating-sm col" style="padding:5px">
					<input class="form-control" placeholder="Nom et prénom" id="nom_prenom_rech" name="nom_prenom_rech" type="text" />
					<label for="nom_prenom_rech">Nom et prénom</label>
				</div>
			</div>
			<div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
				<button type="button" class="btn btn-primary" name="rech_btn" id="rech_btn" onclick="load_utilisateurs_for_form_find_utilisateur();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
				<button type="button" class="btn btn-primary" name="nouvel_utilisateur_btn" id="nouvel_utilisateur_btn" onclick="nouvel_utilisateur_find_utilisateur();"><i class='fa-solid fa-plus rech-fa'></i></button>
			</div>
	</form>
</div>
<div id="div_utilisateurs" class="div_grand_tableau">
	<table class="table table-striped form-floating" id="table_utilisateurs" style="width:100%;">
		<thead>
			<tr>
				<th width="5%" style="text-align:center">Id</th>
				<th width="20%" style="text-align:left">Nom d'utilisateur</th>
				<th width="20%" style="text-align:left">Nom et prénom</th>
				<th width="20%" style="text-align:left">E-Mail</th>
				<th width="20%" style="text-align:left">Profils</th>
				<th width="15%" style="text-align:left">Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	table_to_datatable("#table_utilisateurs");
</script>