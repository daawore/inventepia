<script type='text/javascript' src="./vue/bien/type_bien.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="type_bien_form" name="bien_form" method="POST" >
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_type_bien" id="id_type_bien">
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <select class="form-select" placeholder="Catégorie" id="id_categorie_bien" name="id_categorie_bien" required></select>
                    <label for="id_categorie_bien">Catégorie</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en français" id="libelle_fr" name="libelle_fr" type="text" required/>
                    <label for="libelle_fr">Libellé en français</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en anglais" id="libelle_en" name="libelle_en" type="text"/>
                    <label for="libelle_en">Libellé en anglais</label>
                </div>
                <nav>
                    <div class="nav nav-tabs" id="pills-tab" role="tablist">
                        <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Informations générales</button>
                        <button class="nav-link" id="nav-caracteristiques-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Caractéristiques</button>
                    </div>
                </nav>
                <div class="tab-content" style="background-color:inherit;" id="nav-tabContent">
                    <div class="tab-pane fade show active" style="background-color:inherit;" id="nav-home" role="tabpanel" aria-labelledby="nav-general-tab" tabindex="0">
                        <div class="form-floating form-floating-sm" style="padding:5px">
                            <select class="form-select" placeholder="Quantifiable ?" id="quantifiable" name="quantifiable" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                            <label for="quantifiable">Quantifiable ?</label>
                        </div>
                        <div class="form-floating form-floating-sm" style="padding:5px">
                            <select class="form-select" placeholder="Périssable ?" id="perissable" name="perissable" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                            <label for="perissable">Périssable ?</label>
                        </div>
                        <div class="form-floating form-floating-sm" style="padding:5px">
                            <select class="form-select" placeholder="Attribuable ?" id="attribuable" name="attribuable" required>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                            <label for="attribuable">Attribuable ?</label>
                        </div>
                    </div>
                    <div class="tab-pane fade" style="background-color:inherit;" id="nav-profile" role="tabpanel" aria-labelledby="nav-caracteristiques-tab" tabindex="0">
                        <div id="div_caracteristiques" style="padding:5px">
                            <table style="width:100%; margin: 0 auto;">
                                <tr>
                                    <td>
                                        <div class="mb-3" style="padding:5px">
                                            <label for="select_caracteristiques_dispo">Caractéristiques disponibles</label>
                                            <select class="form-select" size="10" multiple aria-label="Multiple select example" placeholder="Caractéristiques disponibles" id="select_caracteristiques_dispo" name="select_caracteristiques_dispo">
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-floating form-floating-sm" style="padding:5px; text-align:center; vertical-align:middle;">
                                            <button type="button" class="btn btn-primary" onclick="add_select_caracteristique_for_form_type_bien();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-right rech-fa'></i></button>
                                            <button type="button" class="btn btn-danger" onclick="remove_select_caracteristique_for_form_type_bien();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-left rech-fa'></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3" style="padding:5px">
                                            <label for="select_caracteristiques_type_bien">Caratctéristiques du type de bien</label>
                                            <select class="form-select" size="10" multiple aria-label="Multiple select example" placeholder="Caractéritiques du type de bien" id="select_caracteristiques_type_bien" name="select_caracteristiques_type_bien">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <input class="btn btn-primary" type="button" name="add_btn" id="add_btn" value="Ajouter" onclick="save_type_bien();" hidden="true"/>
                <input class="btn btn-primary" type="button" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_type_bien();" hidden="true" />
                <input class="btn btn-danger" type="button" name="del_btn" id="del_btn" value="Supprimer" onclick="save_type_bien();" hidden="true"/>
            </div>
        </form>
    </div>
</div>