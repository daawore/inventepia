<script type='text/javascript' src="./vue/unite/unite.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="unite_form" name="unite_form" method="POST">
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_unite" id="id_unite">
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en français" id="libelle_fr" name="libelle_fr" type="text" />
                    <label for="libelle_fr">Libellé en français</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en anglais" id="libelle_en" name="libelle_en" type="text" />
                    <label for="libelle_en">Libellé en anglais</label>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <button type="button" class="btn btn-primary" name="add_btn" id="add_btn" title="Ajouter" onclick="save_unite();" hidden="true">Ajouter</button>
                <button type="button" class="btn btn-primary" name="modif_btn" id="modif_btn" title="Modifier" onclick="save_unite();" hidden="true">Modifier</button>
                <button type="button" class="btn btn-danger" name="del_btn" id="del_btn" title="Supprimer" onclick="save_unite();" hidden="true">Supprimer</button>
            </div>
        </form>
    </div>
</div>