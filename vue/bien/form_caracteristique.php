<script type='text/javascript' src="./vue/bien/bien.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="caracteristique_form" name="caracteristique_form" method="POST" >
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_caracteristique" id="id_caracteristique">
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en français" id="libelle_fr" name="libelle_fr" type="text" required/>
                    <label for="libelle_fr">Libellé en français</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <input class="form-control" placeholder="Abréviation en français" id="abrev_fr" name="abrev_fr" type="text"/>
                    <label for="abrev_fr">Abréviation en français</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en français" id="libelle_en" name="libelle_en" type="text"/>
                    <label for="libelle_en">Libellé en anglais</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <input class="form-control" placeholder="Abréviation en anglais" id="abrev_en" name="abrev_en" type="text"/>
                    <label for="abrev_en">Abréviation en anglais</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <select class="form-select" placeholder="Type" id="type" name="type" required onchange="">
                        <option value="alpha">Alphanumérique</option>
                        <option value="number">Numérique</option>
                        <option value="singselect">Sélection unique</option>
                        <option value="multiselect">Sélection multiple</option>
                    </select>
                    <label for="type">Type</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px;">
                    <button type="button" class="btn btn-secondary" name="add_modalite" id="add_modalite" value="Ajouter une modalité" onclick="add_new_modalite_for_form_modalite_caracteristique();">Ajouter une modalité</button>
                    <table style="width:100%; margin: 0 auto;" id="table_modalites_caracteristique">
                        <thead>
                            <tr>
                                <th>Modalité en français</th>
                                <th>Modalité en anglais</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>
                                    <div class="form-floating form-floating-sm row" style="padding:5px">
                                        <input id="id_modalite" name="id_modalite[]" type="hidden">
                                        <input class="form-control-sm col-12" placeholder="Modalité" id="libelle_fr_modalite" name="libelle_fr_modalite[]" type="text"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-floating form-floating-sm row" style="padding:5px">
                                        <input class="form-control-sm col-12" placeholder="Modalité" id="libelle_en_modalite" name="libelle_en_modalite[]" type="text"/>
                                    </div>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <input class="btn btn-primary" type="button" name="add_btn" id="add_btn" value="Ajouter" onclick="save_caracteristique();" hidden="true"/>
                <input class="btn btn-primary" type="button" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_caracteristique();" hidden="true" />
                <input class="btn btn-danger" type="button" name="del_btn" id="del_btn" value="Supprimer" onclick="save_caracteristique();" hidden="true"/>
            </div>
        </form>
    </div>
</div>