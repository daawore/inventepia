<script type='text/javascript' src="./vue/utilisateur/profil.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="profil_form" name="profil_form" method="POST" onsubmit="return false;">
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_profil" id="id_profil">
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Nom du profil en français" id="libelle_fr_profil" name="libelle_fr_profil" type="text" required="required" />
                    <label for="libelle_fr_profil">Nom du profil en français</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Nom du profil en anglais" id="libelle_en_profil" name="libelle_en_profil" type="text" required="required" />
                    <label for="libelle_en_profil">Nom du profil en anglais</label>
                </div>
                <div id="div_profils" style="padding:5px">
                    <table style="width:100%; margin: 0 auto;">
                        <tr>
                            <td>
                                <div class="mb-3" style="padding:5px">
                                    <label for="select_droits_dispo">Droits disponibles</label>
                                    <select class="form-select" multiple aria-label="Multiple select example" placeholder="Droits disponibles" id="select_droits_dispo" name="select_droits_dispo">
                                        <option selected>Open this select menu</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-floating form-floating-sm" style="padding:5px; text-align:center; vertical-align:middle;">
                                    <button type="button" class="btn btn-primary" onclick="add_select_droit_for_form_profil();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-right rech-fa'></i></button>
                                    <button type="button" class="btn btn-danger" onclick="remove_select_droit_for_form_profil();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-left rech-fa'></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="mb-3" style="padding:5px">
                                    <label for="select_droits_profil">Droits de l'utilisateur</label>
                                    <select class="form-select" multiple aria-label="Multiple select example" placeholder="Droits de l'utilisateur<" id="select_droits_profil" name="select_droits_profil">
                                        <option selected>Open this select menu</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <input type="button" class="btn btn-primary" name="add_btn" id="add_btn" value="Ajouter" onclick="save_profil();"  hidden="true"/>
                <input type="button" class="btn btn-primary" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_profil();" hidden="true" />
                <input type="button" class="btn btn-danger" name="del_btn" id="del_btn" value="Supprimer" onclick="save_profil();" hidden="true"/>
            </div>
        </form>
    </div>
</div>