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
        <form id="bien_form" name="bien_form" method="POST" >
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_bien" id="id_bien">
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <select class="form-select" placeholder="Catégorie" id="id_categorie_bien" name="id_categorie_bien" required onchange="load_types_biens_for_form_bien();"></select>
                    <label for="id_categorie_bien">Catégorie</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <select class="form-select" placeholder="Type" id="id_type_bien" name="id_type_bien" required onchange="load_caracteristiques_bien_for_form_bien('add', null);"></select>
                    <label for="id_type_bien">Type</label>
                </div>
                <div class="form-floating form-floating-sm" style="padding:5px">
                    <input class="form-control" placeholder="Désignation" id="designation_bien" name="designation_bien" type="text" required/>
                    <label for="designation_bien">Désignation</label>
                </div>
            </div>
            <nav>
                <div class="nav nav-tabs" id="pills-tab" role="tablist">
                    <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Informations générales</button>
                    <button class="nav-link" id="nav-caracteristiques-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Caractéristiques</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent" style="background-color:inherit;">
                <div class="tab-pane fade show active" style="background-color:inherit;" id="nav-home" role="tabpanel" aria-labelledby="nav-general-tab" tabindex="0">
                    <div class="modal-body" id="id-form-modal-body">
                        <div class="align-items-center row" style="padding:5px;" id="ligne_id_detenteur_bien">
                            <div class="form-floating form-floating-sm col-3" style="padding:5px;" id="ligne_quantite_bien">
                                <input class="form-control" placeholder="Quantité" id="quantite_bien" name="quantite_bien" type="number"/>
                                <label for="quantite_bien">Quantité</label>
                            </div>
                            <div class="form-floating form-floating-sm col-9" style="padding:5px;" id="ligne_id_etat_bien">
                                <select class="form-select" placeholder="Etat" id="id_etat_bien" name="id_etat_bien"></select>
                                <label for="id_etat_bien">Etat</label>
                            </div>
                        </div>
                        <div class="align-items-center row" style="padding:5px;" id="ligne_id_detenteur_bien">
                            <div class="form-floating form-floating-xl col-2" style="padding:5px">
                                <input class="form-control" placeholder="Matricule à rechercher" id="search_matricule_peronnel_bien" name="search_matricule_peronnel_bien" type="text" />
                                <label for="search_matricule_peronnel_bien">Matricule à rechercher</label>
                            </div>
                            <div class="form-floating form-floating-xl col-3" style="padding:5px">
                                <input class="form-control" placeholder="Nom et prénom à rechercher" id="search_nom_prenom_personnel_bien" name="search_nom_prenom_personnel_bien" type="text" />
                                <label for="search_nom_prenom_personnel_bien">Nom et prénom à rechercher</label>
                            </div>
                            <div class="form-floating form-floating-xl col-1" style="padding:5px">
                                <button type="button" class="btn btn-primary" name="btn_search_personnel_bien" id="btn_search_personnel_bien" onclick="load_detenteurs_biens_for_form_bien();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
                            </div>
                            <div class="form-floating form-floating-xl col-6" style="padding:5px">
                                <select class="form-select" placeholder="Détenteur" id="id_detenteur_bien" name="id_detenteur_bien"></select>
                                <label for="id_detenteur_bien">Détenteur</label>
                            </div>
                        </div>
                        <div class="form-floating form-floating-sm" style="padding:5px;" id="ligne_date_attribution_bien">
                            <input class="form-control" placeholder="Date d'attribution" id="date_attribution_bien" name="date_attribution_bien" type="date"/>
                            <label for="date_attribution_bien">Date d'attribution</label>
                        </div>
                        <div class="align-items-center row" style="padding:5px;" id="ligne_rech_commande_bien">
                            <div class="form-floating form-floating-xl col-5" style="padding:5px">
                                <input class="form-control" placeholder="Référence de la commande à rechercher" id="search_reference_commande_bien" name="search_reference_commande_bien" type="text" />
                                <label for="search_reference_commande_bien">Référence de la commande à rechercher</label>
                            </div>
                            <div class="form-floating form-floating-xl col-6" style="padding:5px">
                                <input class="form-control" placeholder="Intitulé de la commande à rechercher" id="search_intitule_commande_bien" name="search_intitule_commande_bien" type="text" />
                                <label for="search_intitule_commande_bien">Intitulé de la commande à rechercher</label>
                            </div>
                            <div class="form-floating form-floating-xl col-1" style="padding:5px">
                                <button type="button" class="btn btn-primary" name="btn_search_commande_bien" id="btn_search_commande_bien" onclick="load_commandes_biens_for_form_bien();"><i class='fa-solid fa-magnifying-glass rech-fa'></i></button>
                            </div>
                        </div>
                        <div class="form-floating form-floating-sm" style="padding:5px;" id="ligne_id_commande_bien">
                            <select class="form-select" placeholder="Commande" id="id_commande_bien" name="id_commande_bien" onchange="load_articles_commandes_biens_for_form_bien();"></select>
                            <label for="id_commande_bien">Commande</label>
                        </div>
                        <div class="form-floating form-floating-sm" style="padding:5px;" id="ligne_id_article_commande_bien">
                            <select class="form-select" placeholder="Article de la commande" id="id_article_commande_bien" name="id_article_commande_bien"></select>
                            <label for="id_article_commande_bien">Article de la commande</label>
                        </div>
                        <div class="form-floating form-floating-sm" style="padding:5px;" id="ligne_observation_bien">
                            <textarea class="form-control" placeholder="Observations" id="observation_bien" name="observation_bien"></textarea>
                            <label for="observation_bien">Observations</label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="nav-profile" style="background-color:inherit;" role="tabpanel" aria-labelledby="nav-caracteristiques-tab" tabindex="0">
                    <table class="table table-striped form-floating" id="table_caracteristiques_biens" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="50%" style="text-align:left">Caractéristique</th>
                                <th width="50%" style="text-align:left">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <input class="btn btn-primary" type="button" name="add_btn" id="add_btn" value="Ajouter" onclick="save_bien();" hidden="true"/>
                <input class="btn btn-primary" type="button" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_bien();" hidden="true" />
                <input class="btn btn-danger" type="button" name="del_btn" id="del_btn" value="Supprimer" onclick="save_bien();" hidden="true"/>
            </div>
        </form>
    </div>
</div>
<script type='text/javascript'>
	load_categories_bien_for_form_find_bien();
	table_to_datatable("#table_caracteristiques_biens");
</script>