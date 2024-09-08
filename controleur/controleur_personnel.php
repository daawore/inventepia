<?php
function router_personnel($mobile)
{
	if(!empty($_GET))
	{
		if(!empty($_GET['page'])) 
		{
			//Page de recherche des personnels
			if($_GET['page']=='find_personnel')
			{
				$titre = "PERSONNELS";
				$contenu = file_get_contents('./vue/personnel/find_personnel.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
		}
	}
	else if (!empty($_POST))
	{
		if(!empty($_POST['page']))
		{
			//Page d'ajout, modification, suppression ou visualisation d'un personnel
			if (($_POST['page']=='form_add_personnel')or($_POST['page']=='form_modify_personnel')or($_POST['page']=='form_delete_personnel')or($_POST['page']=='form_visual_personnel'))
			{
				if ($_POST['page']=='form_add_personnel')
				{
					$titre_dialog = "AJOUT D'UN PERSONNEL";
				}
				else if ($_POST['page']=='form_modify_personnel')
				{
					$titre_dialog = "MODIFICATION D'UN PERSONNEL";
				}
				else if ($_POST['page']=='form_delete_personnel')
				{
					$titre_dialog = "SUPPRESSION D'UN PERSONNEL";
				}
				else if ($_POST['page']=='form_visual_personnel')
				{
					$titre_dialog = "PERSONNEL";
				}
				
				$contenu_dialog = file_get_contents('./vue/personnel/form_personnel.php');
				require './vue/personnel/form_personnel.php';
				
				$titre = "";
				$contenu = "";
			}
		}
				
		if (!empty($_POST['action'])) 
		{
			//Action d'ajout d'un personnel
			if ($_POST['action']=='add_personnel')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_personnel'))
				{
					echo ajoute_personnel();
				}
				else
				{
					echo "Vous ne disposez pas du droit d'ajout d'un personnel";
				}
			}
			//Action de modification d'un personnel
			else if ($_POST['action']=='modify_personnel')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_personnel'))
				{
					echo modifie_personnel();
				}
				else
				{
					echo "Vous ne disposez pas du droit de modification d'un personnel";
				}
			}
			//Action de suppression d'un personnel
			else if ($_POST['action']=='delete_personnel')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_personnel'))
				{
					echo supprime_personnel();
				}
				else
				{
					echo "Vous ne disposez pas du droit de suppression d'un personnel";
				}
			}
			//Action de récupération des informations des personnels
			else if ($_POST['action']=='get_personnels')
			{
				$crit = '';
				
				if(!empty($_POST['id_personnel'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_personnel="'.$_POST['id_personnel'].'")';
				}
				if(!empty($_POST['matricule'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(matricule LIKE "%'.$_POST['matricule'].'%")';
				}
				if(!empty($_POST['nom_prenom'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(nom_prenom LIKE "%'.$_POST['nom_prenom'].'%")';
				}
				if ($crit == '')
				{
					echo read_data_table('inventepia_personnel', '*', null, 'nom_prenom', true);
				}
				else
				{
					echo read_data_table('inventepia_personnel', '*', $crit, 'nom_prenom', true);
				}
			}
		}
	}
}