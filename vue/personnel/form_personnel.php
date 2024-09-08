<script type='text/javascript' src="./vue/personnel/personnel.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="personnel_form" name="personnel_form" method="POST">
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_personnel" id="id_personnel">
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Matricule" id="matricule_personnel" name="matricule_personnel" type="text" required="required" />
                    <label for="matricule_personnel">Matricule</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Noms et prénoms" id="nom_prenom_personnel" name="nom_prenom_personnel" type="text" required="required" />
                    <label for="nom_prenom_personnel">Noms et prénoms</label>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <input class="btn btn-primary" type="button" name="add_btn" id="add_btn" value="Ajouter" onclick="save_personnel();"  hidden="true"/>
                <input class="btn btn-primary" type="button" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_personnel();" hidden="true" />
                <input class="btn btn-danger" type="button" name="del_btn" id="del_btn" value="Supprimer" onclick="save_personnel();" hidden="true"/>
            </div>
        </form>
    </div>
</div>