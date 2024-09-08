<?php
function router_commande($mobile) {
	if(!empty($_GET)) {
		if(!empty($_GET['page'])) {
			//Page de recherche des commandes
			if($_GET['page']=='find_commande') {
				$titre = "COMMANDES";
				$contenu = file_get_contents('./vue/commande/find_commande.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
		}
	}
	else if (!empty($_POST)) {
		if(!empty($_POST['page'])) {
			//Page d'ajout, modification, suppression ou visualisation d'une commande
			if (($_POST['page']=='form_add_commande')or($_POST['page']=='form_modify_commande')or($_POST['page']=='form_delete_commande')or($_POST['page']=='form_start_suivi_commande')or($_POST['page']=='form_enreg_etapes_commande')or($_POST['page']=='form_visual_commande')) {
				if ($_POST['page']=='form_add_commande') {
					$titre_dialog = "AJOUT D'UNE COMMANDE";
				}
				else if ($_POST['page']=='form_modify_commande') {
					$titre_dialog = "MODIFICATION D'UNE COMMANDE";
				}
				else if ($_POST['page']=='form_delete_commande') {
					$titre_dialog = "SUPPRESSION D'UNE COMMANDE";
				}
				else if ($_POST['page']=='form_start_suivi_commande') {
					$titre_dialog = "DEMARRAGE DU SUIVI D'UNE COMMANDE";
				}
				else if ($_POST['page']=='form_enreg_etapes_commande') {
					$titre_dialog = "ENREGISTREMENT DES ETAPES EXECUTEES D'UNE COMMANDE";
				}
				else if ($_POST['page']=='form_visual_commande') {
					$titre_dialog = "COMMANDE";
				}
				$contenu_dialog = file_get_contents('./vue/commande/form_commande.php');
				require './vue/commande/form_commande.php';
				$titre = "";
				$contenu = "";
			}
		}
				
		if (!empty($_POST['action'])) {
			//Action d'ajout d'une commande
			if ($_POST['action']=='add_commande') {
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_commande')) {
					echo ajoute_commande();
				}
				else {
					echo "Vous ne disposez pas du droit d'ajout d'une commande";
				}
			}
			//Action de modification d'une commande
			else if ($_POST['action']=='modify_commande') {
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_commande')) {
					echo modifie_commande();
				}
				else {
					echo "Vous ne disposez pas du droit de modification d'une commande";
				}
			}
			//Action de suppression d'une unité
			else if ($_POST['action']=='delete_commande') {
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_commande')) {
					echo supprime_commande();
				}
				else {
					echo "Vous ne disposez pas du droit de suppression d'une commande";
				}
			}
			//Action de démmarage du suivi d'une commande
			else if ($_POST['action']=='start_suivi_commande') {
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'demar_suivi_commande')) {
					echo demarrer_suivi_commande();
				}
				else {
					echo "Vous ne disposez pas du droit de démarrage du suivi d'une commande";
				}
			}
			//Action de d'enregistrement des étapes exécutées d'une commande
			else if ($_POST['action']=='enreg_etapes_commande') {
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'demar_suivi_commande')) {
					echo enregistrer_etapes_commande();
				}
				else {
					echo "Vous ne disposez pas du droit de démarrage du suivi d'une commande";
				}
			}
			//Action de récupération des informations des commandes
			else if ($_POST['action']=='get_commandes') {			
				$crit = '';
				if(!empty($_POST['id_commande'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_commande="'.$_POST['id_commande'].'")';
				}
				if(!empty($_POST['reference'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(reference LIKE "%'.$_POST['reference'].'%")';
				}
				if(!empty($_POST['intitule'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(intitule_fr LIKE "%'.$_POST['intitule'].'%" OR intitule_en LIKE "%'.$_POST['intitule'].'%")';
				}
				if(!empty($_POST['consistance'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(consistance_fr LIKE "%'.$_POST['consistance'].'%" OR consistance_en LIKE "%'.$_POST['consistance'].'%")';
				}
				if(!empty($_POST['id_type_commande']) && $_POST['id_type_commande'] != null) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_type_commande = '.$_POST['id_type_commande'].')';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_view_commande_complet', '*', null, 'date_signature', true);
				}
				else {
					echo read_data_table('inventepia_view_commande_complet', '*', $crit, 'date_signature', true);
				}
			}
			//Action de récupération des informations des types de commandes
			else if ($_POST['action']=='get_types_commandes') {			
				$crit = '';
				if(!empty($_POST['id_type_commande'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_type_commande="'.$_POST['id_type_commande'].'")';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_type_commande', '*', null, 'libelle_fr', true);
				}
				else {
					echo read_data_table('inventepia_type_commande', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des commandes
			else if ($_POST['action']=='get_articles_commandes') {			
				$crit = '';
				if(!empty($_POST['id_article'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_article="'.$_POST['id_article'].'")';
				}
				if(!empty($_POST['id_commande'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_commande="'.$_POST['id_commande'].'")';
				}
				if(!empty($_POST['numero_article'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(numero_articcle="'.$_POST['numero_article'].'")';
				}
				if(!empty($_POST['designation_article'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(designation LIKE "%'.$_POST['designation_article'].'%")';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_article_commande', '*', null, 'numero_article', true);
				}
				else {
					echo read_data_table('inventepia_article_commande', '*', $crit, 'numero_article', true);
				}
			}
			//Action de récupération des informations des étapes de base d'une commande
			else if ($_POST['action']=='get_etapes_commande_dispo') {
				$crit = '';
				if(!empty($_POST['id_commande'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'id_etape_commande_base NOT IN (SELECT id_etape_commande FROM inventepia_etape_commande WHERE id_commande='.$_POST['id_commande'].')';
				}
				if(!empty($_POST['id_type_commande'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'id_type_commande='.$_POST['id_type_commande'].')';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_etape_commande_base', '*', null, 'libelle_fr', true);
				}
				else {
					echo read_data_table('inventepia_etape_commande_base', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des étapes d'une commande
			else if ($_POST['action']=='get_etapes_commande') {
				$crit = '';
				if(!empty($_POST['id_commande'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'id_commande='.$_POST['id_commande'];
				}
				if ($crit == '') {
					echo read_data_table('inventepia_view_etape_commande_complet', '*', null, 'libelle_fr_etape_commande', true);
				}
				else {
					echo read_data_table('inventepia_view_etape_commande_complet', '*', $crit, 'libelle_fr_etape_commande', true);
				}
			}
		}
	}
}