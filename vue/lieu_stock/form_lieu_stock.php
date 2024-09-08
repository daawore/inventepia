<script type='text/javascript' src="./vue/lieu_stock/lieu_stock.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="lieu_stock_form" name="lieu_stock_form" method="POST">
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_lieu_stock" id="id_lieu_stock">
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en français" id="libelle_fr_lieu_stock" name="libelle_fr_lieu_stock" type="text" required="required" />
                    <label for="libelle_fr_lieu_stock">Libellé en français</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Libellé en anglais" id="libelle_en_lieu_stock" name="libelle_en_lieu_stock" type="text" required="required" />
                    <label for="libelle_en_lieu_stock">Libellé en anglais</label>
                </div>
                <div class="row" style="padding:5px">
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <select class="form-select" placeholder="Région" id="id_region_lieu_stock" name="id_region_lieu_stock" onchange="load_departements_for_form_lieu_stock();"></select>
                        <label for="id_region_lieu_stock">Région</label>
                    </div>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <select class="form-select" placeholder="Département" id="id_departement_lieu_stock" name="id_departement_lieu_stock" onchange="load_arrondissements_for_form_lieu_stock();"></select>
                        <label for="id_departement_lieu_stock">Département</label>
                    </div>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <select class="form-select" placeholder="Arrondissement" id="id_arrondissement_lieu_stock" name="id_arrondissement_lieu_stock"></select>
                        <label for="id_arrondissement_lieu_stock">Arrondissement</label>
                    </div>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Localité" id="localite_lieu_stock" name="localite_lieu_stock" type="text" required="required" />
                    <label for="localite_lieu_stock">Localité</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <textarea class="form-control" placeholder="Observations" id="observation_lieu_stock" name="observation_lieu_stock" type="text"></textarea>
                    <label for="observation_lieu_stock">Observations</label>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <input class="btn btn-primary" type="button" name="add_btn" id="add_btn" value="Ajouter" onclick="save_lieu_stock();"  hidden="true"/>
                <input class="btn btn-primary" type="button" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_lieu_stock();" hidden="true" />
                <input class="btn btn-danger" type="button" name="del_btn" id="del_btn" value="Supprimer" onclick="save_lieu_stock();" hidden="true"/>
            </div>
        </form>
    </div>
</div>