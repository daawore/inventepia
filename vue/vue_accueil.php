<!-- <div id="nom_fr_exercice_en_cours" style="text-align:center;">Exercice en cours : <?php echo $nom_fr_exercice_en_cours; ?></div>
<div class="div_grand_tableau">
    <table id="table_bilan_exercice_en_cours" align="center" class="tableau_bord">
        <thead>
            <tr>
                <th width="60%" style="text-align:left;">Rubrique</th>
                <th width="40%" style="text-align:right;">Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr class="rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Inscription</span></td>
                <td id="epargne" style="width:100px;text-align:right"><span><?php echo $tot_inscription; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Bilan du secours</span></td>
                <td id="secours" style="text-align:right"><span><?php echo $bilan_secours; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Secours cotisé</span></td>
                <td id="secours" style="text-align:right"><span><?php echo $tot_secours; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_output">
                <td><i class="fa fa-arrow-up"></i><span>Aides accordées</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_aide; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Projet social</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_projet_social; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Bilan de l'épargne</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $bilan_epargne; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Epargne cotisée</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_epargne; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_output">
                <td><i class="fa fa-arrow-up"></i><span>Prêts accordés</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_pret; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Remboursements des prêts</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_remb_pret; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Epargne scolaire</span></td>
                <td id="epargne_scol" style="text-align:right"><span><?php echo $tot_epargne_scolaire; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Don</td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_don; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Bilan des échecs</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $bilan_echec; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_output">
                <td><i class="fa fa-arrow-up"></i><span>Echecs</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_echec; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Remboursements des échecs</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_remb_echec; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Reste des échecs attendu</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo "en attente"; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Bilan des sanctions</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $bilan_sanction; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Sanctions</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_sanction; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Sanctions payées</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_paie_sanction; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Sanctions non payées</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_sanction_non_payee; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Bilan du projet rentable</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $bilan_projet_rentable; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Projet rentable cotisé</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_projet_rentable; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_output">
                <td><i class="fa fa-arrow-up"></i><span>Investissements</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_inves; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Retour sur investissements</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_retour_inves; ?></span></td>
            </tr>
            <tr class="sous_rubrique_etat rubrique_finance_neutral">
                <td><i class="fa-regular fa-square"></i><span>Investissements encore en cours</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo "en attente"; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_enter">
                <td><i class="fa fa-arrow-down"></i><span>Autres entrées</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_autre_entree; ?></span></td>
            </tr>
            <tr class="rubrique_etat rubrique_finance_output">
                <td><i class="fa fa-arrow-up"></i><span>Autres sorties</span></td>
                <td id="epargne" style="text-align:right"><span><?php echo $tot_autre_sortie; ?></span></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>BILAN</td>
                <td id="epargne" style="text-align:right"><?php echo $bilan; ?></td>
            </tr>
        </tfoot>
    </table>
</div> -->