<?php
function router_bien($mobile)
{
	if(!empty($_GET))
	{
		if(!empty($_GET['page'])) 
		{
			//Page de recherche des biens
			if($_GET['page']=='find_bien')
			{
				$titre = "BIENS";
				$contenu = file_get_contents('./vue/bien/find_bien.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
			//Page de recherche des biens
			else if($_GET['page']=='find_caracteristique')
			{
				$titre = "CARACTERISTIQUES";
				$contenu = file_get_contents('./vue/bien/find_caracteristique.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
			//Page de recherche des types de biens
			else if($_GET['page']=='find_type_bien')
			{
				$titre = "TYPES DE BIENS";
				$contenu = file_get_contents('./vue/bien/find_type_bien.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
		}
	}
	else if (!empty($_POST))
	{
		if(!empty($_POST['page']))
		{
			//Page d'ajout, modification, suppression ou visualisation d'un bien
			if (($_POST['page']=='form_add_bien')or($_POST['page']=='form_modify_bien')or($_POST['page']=='form_delete_bien')or($_POST['page']=='form_visual_bien'))
			{
				if ($_POST['page']=='form_add_bien')
				{
					$titre_dialog = "AJOUT D'UN BIEN";
				}
				else if ($_POST['page']=='form_modify_bien')
				{
					$titre_dialog = "MODIFICATION D'UN BIEN";
				}
				else if ($_POST['page']=='form_delete_bien')
				{
					$titre_dialog = "SUPPRESSION D'UN BIEN";
				}
				else if ($_POST['page']=='form_visual_bien')
				{
					$titre_dialog = "BIEN";
				}
				
				$contenu_dialog = file_get_contents('./vue/bien/form_bien.php');
				require './vue/bien/form_bien.php';
				
				$titre = "";
				$contenu = "";
			}
			//Page d'ajout, modification, suppression ou visualisation d'un bien
			else if (($_POST['page']=='form_add_caracteristique')or($_POST['page']=='form_modify_caracteristique')or($_POST['page']=='form_delete_caracteristique')or($_POST['page']=='form_visual_caracteristique'))
			{
				if ($_POST['page']=='form_add_caracteristique')
				{
					$titre_dialog = "AJOUT D'UNE CARACTERISTIQUE";
				}
				else if ($_POST['page']=='form_modify_caracteristique')
				{
					$titre_dialog = "MODIFICATION D'UNE CARACTERISTIQUE";
				}
				else if ($_POST['page']=='form_delete_caracteristique')
				{
					$titre_dialog = "SUPPRESSION D'UNE CARACTERISTIQUE";
				}
				else if ($_POST['page']=='form_visual_caracteristique')
				{
					$titre_dialog = "CARACTERISTIQUE";
				}
				
				$contenu_dialog = file_get_contents('./vue/bien/form_caracteristique.php');
				require './vue/bien/form_caracteristique.php';
				
				$titre = "";
				$contenu = "";
			}
			//Page d'ajout, modification, suppression ou visualisation d'un bien
			if (($_POST['page']=='form_add_type_bien')or($_POST['page']=='form_modify_type_bien')or($_POST['page']=='form_delete_type_bien')or($_POST['page']=='form_visual_type_bien'))
			{
				if ($_POST['page']=='form_add_type_bien')
				{
					$titre_dialog = "AJOUT D'UN TYPE DE BIEN";
				}
				else if ($_POST['page']=='form_modify_type_bien')
				{
					$titre_dialog = "MODIFICATION D'UN TYPE DE BIEN";
				}
				else if ($_POST['page']=='form_delete_type_bien')
				{
					$titre_dialog = "SUPPRESSION D'UN TYPE DE BIEN";
				}
				else if ($_POST['page']=='form_visual_type_bien')
				{
					$titre_dialog = "TYPE DE BIEN";
				}
				
				$contenu_dialog = file_get_contents('./vue/bien/form_type_bien.php');
				require './vue/bien/form_type_bien.php';
				
				$titre = "";
				$contenu = "";
			}
		}
		
		if (!empty($_POST['action'])) 
		{
			//Action d'ajout d'un bien
			if ($_POST['action']=='add_bien')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_bien'))
				{
					echo ajoute_bien();
				}
				else
				{
					echo "Vous ne disposez pas du droit d'ajout d'un bien";
				}
			}
			//Action de modification d'un bien
			else if ($_POST['action']=='modify_bien')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_bien'))
				{
					echo modifie_bien();
				}
				else
				{
					echo "Vous ne disposez pas du droit de modification d'un bien";
				}
			}
			//Action de suppression d'un bien
			else if ($_POST['action']=='delete_bien')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_bien'))
				{
					echo supprime_bien();
				}
				else
				{
					echo "Vous ne disposez pas du droit de suppression d'un bien";
				}
			}
			//Action d'ajout d'une caracteristique
			else if ($_POST['action']=='add_caracteristique')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_caracteristique'))
				{
					echo ajoute_caracteristique();
				}
				else
				{
					echo "Vous ne disposez pas du droit d'ajout d'une caractéristique";
				}
			}
			//Action de modification d'un bien
			else if ($_POST['action']=='modify_caracteristique')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_caracteristique'))
				{
					echo modifie_caracteristique();
				}
				else
				{
					echo "Vous ne disposez pas du droit de modification d'une caractéristique";
				}
			}
			//Action de suppression d'un bien
			else if ($_POST['action']=='delete_caracteristique')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_caracteristique'))
				{
					echo supprime_caracteristique();
				}
				else
				{
					echo "Vous ne disposez pas du droit de suppression d'une caractéristique";
				}
			}
			//Action d'ajout d'un type de bien
			if ($_POST['action']=='add_type_bien')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_type_bien'))
				{
					echo ajoute_type_bien();
				}
				else
				{
					echo "Vous ne disposez pas du droit d'ajout d'un type de bien";
				}
			}
			//Action de modification d'un type de bien
			else if ($_POST['action']=='modify_type_bien')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_type_bien'))
				{
					echo modifie_type_bien();
				}
				else
				{
					echo "Vous ne disposez pas du droit de modification d'un type de bien";
				}
			}
			//Action de suppression d'un type de bien
			else if ($_POST['action']=='delete_type_bien')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_type_bien'))
				{
					echo supprime_type_bien();
				}
				else
				{
					echo "Vous ne disposez pas du droit de suppression d'un type de bien";
				}
			}
			//Action de récupération des informations des biens
			else if ($_POST['action']=='get_biens')
			{
				$crit = '';
				if(!empty($_POST['id_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_bien="'.$_POST['id_bien'].'")';
				}
				if(!empty($_POST['id_categorie_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_categorie_bien="'.$_POST['id_categorie_bien'].'")';
				}
				if(!empty($_POST['id_detenteur_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_detenteur="'.$_POST['id_detenteur_bien'].'")';
				}
				if(!empty($_POST['id_commande_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_commande="'.$_POST['id_commande_bien'].'")';
				}
				if(!empty($_POST['designation'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(designation LIKE "%'.$_POST['designation'].'%")';
				}
				if(!empty($_POST['matricule_detenteur'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(matricule_detenteur LIKE "%'.$_POST['matricule_detenteur'].'%")';
				}
				if(!empty($_POST['nom_prenom_detenteur'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(nom_prenom_detenteur LIKE "%'.$_POST['nom_prenom_detenteur'].'%")';
				}
				if(!empty($_POST['id_article_commande_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_article_commande="'.$_POST['id_article_commande_bien'].'")';
				}
				if(!empty($_POST['id_etat_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_etat="'.$_POST['id_etat_bien'].'")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_view_bien_complet', '*', null, 'designation', true);
				}
				else
				{
					echo read_data_table('inventepia_view_bien_complet', '*', $crit, 'designation', true);
				}
			}
			//Action de récupération des informations des caractéristiques
			else if ($_POST['action']=='get_caracteristiques')
			{
				$crit = '';
				if(!empty($_POST['id_caracteristique'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_caracteristique="'.$_POST['id_caracteristique'].'")';
				}
				if(!empty($_POST['libelle_fr'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(libelle_fr LIKE "%'.$_POST['libelle_fr'].'%")';
				}
				if(!empty($_POST['libelle_en'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(libelle_en LIKE "%'.$_POST['libelle_en'].'%")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_caracteristique', '*', null, 'id_caracteristique', true);
				}
				else
				{
					echo read_data_table('inventepia_caracteristique', '*', $crit, 'id_caracteristique', true);
				}
			}
			//Action de récupération des informations des caractéristiques de biens
			else if ($_POST['action']=='get_valeurs_caracteristiques_biens')
			{
				$crit = '';
				if(!empty($_POST['id_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_bien="'.$_POST['id_bien'].'")';
				}
				if(!empty($_POST['id_caracteristique'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_caracteristique="'.$_POST['id_caracteristique'].'")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_view_valeur_caracteristique_bien_complet', '*', null, 'id_caracteristique', true);
				}
				else
				{
					echo read_data_table('inventepia_view_valeur_caracteristique_bien_complet', '*', $crit, 'id_caracteristique', true);
				}
			}
			//Action de récupération des informations des caractéristiques de biens
			else if ($_POST['action']=='get_caracteristiques_dispo')
			{
				$crit = '';
				if(!empty($_POST['id_type_bien'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'id_caracteristique NOT IN (SELECT id_caracteristique FROM inventepia_caracteristique_type_bien WHERE id_type_bien='.$_POST['id_type_bien'].')';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_caracteristique', '*', null, 'libelle_fr', true);
				}
				else {
					echo read_data_table('inventepia_caracteristique', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des caractéristiques de biens
			else if ($_POST['action']=='get_caracteristiques_types_biens')
			{
				$crit = '';
				if(!empty($_POST['id_type_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_type_bien="'.$_POST['id_type_bien'].'")';
				}
				if(!empty($_POST['id_caracteristique'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_caracteristique="'.$_POST['id_caracteristique'].'")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_view_caracteristique_type_bien', '*', null, 'id_caracteristique', true);
				}
				else
				{
					echo read_data_table('inventepia_view_caracteristique_type_bien', '*', $crit, 'id_caracteristique', true);
				}
			}
			//Action de récupération des informations des caractéristiques
			else if ($_POST['action']=='get_modalites_caracteristiques')
			{
				$crit = '';
				if(!empty($_POST['id_modalite'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_modalite="'.$_POST['id_modalite'].'")';
				}
				if(!empty($_POST['id_caracteristique'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_caracteristique="'.$_POST['id_caracteristique'].'")';
				}
				if(!empty($_POST['libelle_fr'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(libelle_fr LIKE "%'.$_POST['libelle_fr'].'%")';
				}
				if(!empty($_POST['libelle_en'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(libelle_en LIKE "%'.$_POST['libelle_en'].'%")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_modalite_caracteristique', '*', null, 'libelle_fr', true);
				}
				else
				{
					echo read_data_table('inventepia_modalite_caracteristique', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des catégories de biens
			else if ($_POST['action']=='get_categories_biens')
			{
				$crit = '';
				if(!empty($_POST['id_categorie_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_categorie_bien="'.$_POST['id_categorie_bien'].'")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_categorie_bien', '*', null, 'libelle_fr', true);
				}
				else
				{
					echo read_data_table('inventepia_categorie_bien', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des catégories de biens
			else if ($_POST['action']=='get_types_biens')
			{
				$crit = '';
				if(!empty($_POST['id_categorie_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_categorie_bien="'.$_POST['id_categorie_bien'].'")';
				}
				if(!empty($_POST['id_type_bien'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_type_bien="'.$_POST['id_type_bien'].'")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_view_type_bien_complet', '*', null, 'libelle_fr', true);
				}
				else
				{
					echo read_data_table('inventepia_view_type_bien_complet', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des etat
			else if ($_POST['action']=='get_etats')
			{
				$crit = '';
				if(!empty($_POST['id_etat'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_etat="'.$_POST['id_etat'].'")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_etat', '*', null, 'libelle_fr', true);
				}
				else
				{
					echo read_data_table('inventepia_etat', '*', $crit, 'libelle_fr', true);
				}
			}
		}
	}
}