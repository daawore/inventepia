<script type='text/javascript' src="./vue/commande/commande.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="commande_form" name="commande_form" method="POST">
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <div id="div_infos_commande">
                    <input type="hidden" name="id_commande" id="id_commande">
                    <div class="row" style="padding:5px">
                        <div class="form-floating form-floating-sm col" style="padding:5px">
                            <input class="form-control" placeholder="Référence" id="reference" name="reference" type="text" required />
                            <label for="reference">Référence</label>
                        </div>
                        <div class="form-floating form-floating-sm col" style="padding:5px">
                            <input class="form-control" placeholder="Date de signature" id="date_signature" name="date_signature" type="date" required />
                            <label for="date_signature">Date de signature</label>
                        </div>
                    </div>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <input class="form-control" placeholder="Intitulé en français" id="intitule_fr" name="intitule_fr" type="text" required />
                        <label for="intitule_fr">Intitulé en français</label>
                    </div>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <input class="form-control" placeholder="Intitulé en anglais" id="intitule_en" name="intitule_en" type="text" />
                        <label for="intitule_en">Intitulé en anglais</label>
                    </div>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <select class="form-control" placeholder="Type de commande" id="id_type_commande" name="id_type_commande" required></select>
                        <label for="id_type_commande">Type de commande</label>
                    </div>
                    <nav>
                        <div class="nav nav-tabs" id="pills-tab" role="tablist">
                            <button class="nav-link active" id="nav-autres-infos-tab" data-bs-toggle="tab" data-bs-target="#nav-autres-infos" type="button" role="tab" aria-controls="nav-autres-infos" aria-selected="true">Autres informations</button>
                            <button class="nav-link" id="nav-articles-tab" data-bs-toggle="tab" data-bs-target="#nav-articles" type="button" role="tab" aria-controls="nav-articles" aria-selected="false">Articles</button>
                            <button class="nav-link" id="nav-etapes-suivi-tab" data-bs-toggle="tab" data-bs-target="#nav-etapes-suivi" type="button" role="tab" aria-controls="nav-etapes-suivi" aria-selected="false">Etapes de suivi</button>
                            <button class="nav-link" id="nav-enreg-etapes-tab" data-bs-toggle="tab" data-bs-target="#nav-enreg-etapes" type="button" role="tab" aria-controls="nav-enreg-etapes" aria-selected="false">Enregistrement des étapes</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent" style="background-color:inherit;">
                        <div class="tab-pane fade show active" style="background-color:inherit;" id="nav-autres-infos" role="tabpanel" aria-labelledby="nav-autres-infos-tab" tabindex="0">
                            <div class="form-floating form-floating-sm col" style="padding:5px">
                                <textarea class="form-control" placeholder="Consistance en français" rows="3" id="consistance_fr" name="consistance_fr" required></textarea>
                                <label for="consistance_fr">Consistance en français</label>
                            </div>
                            <div class="form-floating form-floating-sm col" style="padding:5px">
                                <textarea class="form-control" placeholder="Consistance en anglais" rows="3" id="consistance_en" name="consistance_en"></textarea>
                                <label for="consistance_en">Consistance en anglais</label>
                            </div>
                            <div class="form-floating form-floating-sm col" style="padding:5px">
                                <input class="form-control" placeholder="Raison sociale du prestataire" id="raison_sociale_prestataire" name="raison_sociale_prestataire" type="text" />
                                <label for="raison_sociale_prestataire">Raison sociale du prestataire</label>
                            </div>
                            <div class="form-floating form-floating-sm col" style="padding:5px">
                                <input class="form-control" placeholder="Nom et prénom du prestataire" id="nom_prenom_prestataire" name="nom_prenom_prestataire" type="text" />
                                <label for="nom_prenom_prestataire">Nom et prénom du prestataire</label>
                            </div>
                            <div class="row" style="padding:5px">
                                <div class="form-floating form-floating-sm col" style="padding:5px">
                                    <input class="form-control" placeholder="Montant TTC" id="montant_ttc" name="montant_ttc" type="text" oninput="formatInputToMonetaire(this)" />
                                    <label for="montant_ttc">Montant TTC</label>
                                </div>
                                <div class="form-floating form-floating-sm col" style="padding:5px">
                                    <input class="form-control" placeholder="TVA" id="tva" name="tva" type="text" oninput="formatInputToMonetaire(this)" />
                                    <label for="tva">TVA</label>
                                </div>
                            </div>
                                <div class="form-floating form-floating-sm col" style="padding:5px">
                                    <input class="form-control" placeholder="Montant HT" id="montant_ht" name="montant_ht" type="text" oninput="formatInputToMonetaire(this)" />
                                    <label for="montant_ht">Montant HT</label>
                                </div>
                                <div class="row" style="padding:5px">
                                <div class="form-floating form-floating-sm col" style="padding:5px">
                                    <input class="form-control" placeholder="IR" id="ir" name="ir" type="text" oninput="formatInputToMonetaire(this)" />
                                    <label for="ir">IR</label>
                                </div>
                                <div class="form-floating form-floating-sm col" style="padding:5px">
                                    <input class="form-control" placeholder="Net à percevoir" id="montant_a_percevoir" name="montant_a_percevoir" type="text" oninput="formatInputToMonetaire(this)" />
                                    <label for="montant_a_percevoir">Net à percevoir</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" style="background-color:inherit;" id="nav-articles" role="tabpanel" aria-labelledby="nav-articles-tab" tabindex="0">
                            <?php
                                if (!in_array($_POST['page'], array("form_start_suivi_commande", "form_enreg_etapes_commande"))) {
                            ?>
                            <div id="div_articles_commande" class="div_grand_tableau" style="text-align:center;">
                                <div class="form-floating form-floating-sm" style="padding:5px; text-align:center">
                                    <button type="button" class="btn btn-secondary" name="add_article" id="add_article" value="Ajouter un article" onclick="add_article_for_form_commande();">Ajouter un article</button>
                                </div>
                                <table class="table table-striped form-floating" id="table_articles_commande" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th width="6%" style="text-align:center">ID</th>
                                            <th width="6%" style="text-align:center">N°</th>
                                            <th width="26%" style="text-align:left">Désignation</th>
                                            <th width="10%" style="text-align:center">Unité</th>
                                            <th width="5%" style="text-align:right">Quantité</th>
                                            <th width="10%" style="text-align:right">Prix TTC</th>
                                            <th width="10%" style="text-align:right">Prix HT</th>
                                            <th width="10%" style="text-align:right">Prix total TTC</th>
                                            <th width="10%" style="text-align:right">Prix total HT</th>
                                            <th width="10%" style="text-align:left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot id="tfoot_op_ord_assise">
                                        <tr>
                                            <td colspan="7">Total</td>
                                            <td>
                                                <div class="mb-3" style="padding:5px">
                                                    <input class="form-control" placeholder="Montant TTC" id="tot_prix_tot_ttc" name="tot_prix_tot_ttc" type="text" readonly="readonly" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3" style="padding:5px">
                                                    <input class="form-control" placeholder="Montant HT" id="tot_prix_tot_ht" name="tot_prix_tot_ht" type="text" readonly="readonly" />
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" style="background-color:inherit;" id="nav-etapes-suivi" role="tabpanel" aria-labelledby="nav-etapes-suivi-tab" tabindex="0">
                            <?php
                                if (in_array($_POST['page'], array("form_start_suivi_commande"))) {
                            ?>
                            <div class="div_etapes_commande" style="padding:5px">
                                <div class="row">
                                    <div class="mb-3 col-5" style="padding:5px">
                                        <label for="etapes_commande_dispo">Etapes</label>
                                        <select class="form-select" size="8" multiple aria-label="Multiple select example" placeholder="Etapes" id="etapes_commande_dispo" name="etapes_commande_dispo">
                                        </select>
                                    </div>
                                    <div class="form-floating form-floating-sm justify-content-center col-1">
                                        <button type="button" class="btn btn-primary" name="add_etape_btn" id="add_etape_btn" value="Ajouter" onclick="add_etape_commande();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-right rech-fa'></i></button>
                                        <button type="button" class="btn btn-danger" name="remove_etape_btn" id="remove_etape_btn" value="Enlever" onclick="remove_etape_commande();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-left rech-fa'></i></button>
                                    </div>
                                    <div class="col-6 row">
                                        <div class="mb-3 col-10" style="padding:5px">
                                            <label for="etapes_commande">Etapes de la commande</label>
                                            <select class="form-select" size="8" multiple aria-label="Multiple select example" placeholder="Etapes de la commande" id="etapes_commande" name="etapes_commande">
                                            </select>
                                        </div>
                                        <div class="form-floating form-floating-sm justify-content-center col-2">
                                            <button type="button" class="btn btn-primary" name="move_up_etape_btn" id="move_up_etape_btn" value="Monter" onclick="move_up_etape_commande();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-up rech-fa'></i></button>
                                            <button type="button" class="btn btn-danger" name="move_down_etape_btn" id="move_down_etape_btn" value="Descendre" onclick="move_down_etape_commande();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-down rech-fa'></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <table style="width:100%; margin: 0 auto;">
                                    <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td class="align-items-center">
                                            
                                        </td>
                                    </tr>
                                </table> -->
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" style="background-color:inherit;" id="nav-enreg-etapes" role="tabpanel" aria-labelledby="nav-enreg-etapes-tab" tabindex="0">
                            <?php
                                if (in_array($_POST['page'], array("form_enreg_etapes_commande"))) {
                            ?>
                            <table class="table table-striped form-floating" id="table_enreg_etapes_commande" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center">N°</th>
                                        <th width="70%" style="text-align:left">Etape</th>
                                        <th width="25%" style="text-align:center">Exécution</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <input type="hidden" name="action" id="action">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="button" name="add_btn" id="add_btn" value="Ajouter" onclick="save_commande();"  hidden="true"/>
                <input class="btn btn-primary" type="button" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_commande();" hidden="true" />
                <input class="btn btn-danger" type="button" name="del_btn" id="del_btn" value="Supprimer" onclick="save_commande();" hidden="true"/>
                <input class="btn btn-primary" type="button" name="start_suivi_btn" id="start_suivi_btn" value="Démarrerr le suivi" onclick="save_commande();" hidden="true"/>
                <input class="btn btn-primary" type="button" name="enreg_etapes_btn" id="enreg_etapes_btn" value="Enregistrer les étapes exécutées" onclick="save_commande();" hidden="true"/>
            </div>
        </form>
    </div>
</div>