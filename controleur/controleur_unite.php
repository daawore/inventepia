<?php
function router_unite($mobile)
{
	if(!empty($_GET))
	{
		if(!empty($_GET['page'])) 
		{
			//Page de recherche des unités
			if($_GET['page']=='find_unite')
			{
				$titre = "UNITES";
				$contenu = file_get_contents('./vue/unite/find_unite.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
		}
	}
	else if (!empty($_POST))
	{
		if(!empty($_POST['page']))
		{
			//Page d'ajout, modification, suppression ou visualisation d'une unité
			if (($_POST['page']=='form_add_unite')or($_POST['page']=='form_modify_unite')or($_POST['page']=='form_delete_unite')or($_POST['page']=='form_visual_unite'))
			{
				if ($_POST['page']=='form_add_unite')
				{
					$titre_dialog = "AJOUT D'UNE UNITE";
				}
				else if ($_POST['page']=='form_modify_unite')
				{
					$titre_dialog = "MODIFICATION D'UNE UNITE";
				}
				else if ($_POST['page']=='form_delete_unite')
				{
					$titre_dialog = "SUPPRESSION D'UNE UNITE";
				}
				else if ($_POST['page']=='form_visual_unite')
				{
					$titre_dialog = "UNITE";
				}
				
				$contenu_dialog = file_get_contents('./vue/unite/form_unite.php');
				require './vue/unite/form_unite.php';
				
				$titre = "";
				$contenu = "";
			}
		}
				
		if (!empty($_POST['action'])) 
		{
			//Action d'ajout d'une unité
			if ($_POST['action']=='add_unite')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_unite'))
				{
					echo ajoute_unite();
				}
				else
				{
					echo "Vous ne disposez pas du droit d'ajout d'une unité";
				}
			}
			//Action de modification d'une unité
			else if ($_POST['action']=='modify_unite')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_unite'))
				{
					echo modifie_unite();
				}
				else
				{
					echo "Vous ne disposez pas du droit de modification d'une unité";
				}
			}
			//Action de suppression d'une unité
			else if ($_POST['action']=='delete_unite')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_unite'))
				{
					echo supprime_unite();
				}
				else
				{
					echo "Vous ne disposez pas du droit de suppression d'une unité";
				}
			}
			//Action de récupération des informations des unités
			else if ($_POST['action']=='get_unites')
			{
				$crit = '';
				
				if(!empty($_POST['id_unite'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_unite="'.$_POST['id_unite'].'")';
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
				if(!empty($_POST['libelle'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(libelle_fr LIKE "%'.$_POST['libelle'].'%" OR libelle_en LIKE "%'.$_POST['libelle'].'%")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_unite', '*', null, 'libelle_fr', true);
				}
				else
				{
					echo read_data_table('inventepia_unite', '*', $crit, 'libelle_fr', true);
				}
			}
		}
	}
}