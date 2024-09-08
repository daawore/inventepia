<?php
function router_utilisateur($mobile)
{
	if(!empty($_GET))
	{
		if(!empty($_GET['page'])) 
		{
			//Page de recherche d'utilisateurs
			if($_GET['page']=='find_utilisateur')
			{
				$titre = "UTILISATEURS";
				$contenu = file_get_contents('./vue/utilisateur/find_utilisateur.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
			//Page de recherche de profils
			else if($_GET['page']=='find_profil')
			{
				$titre = "PROFILS UTILISATEUR";
				$contenu = file_get_contents('./vue/utilisateur/find_profil.php');
				$type_gabarit = "simple";
				require './vue/vue_gabarit.php';
			}
		}
		else if(!empty($_GET['page'])) 
		{
			
		}
	}
	else if (!empty($_POST))
	{
		if(!empty($_POST['page']))
		{
			//Page d'ajout, modification, suppression ou visualisation d'un utilisateur
			if (($_POST['page']=='form_add_utilisateur')or($_POST['page']=='form_modify_utilisateur')or($_POST['page']=='form_delete_utilisateur')or($_POST['page']=='form_visual_utilisateur')or($_POST['page']=='form_change_pass_utilisateur')or($_POST['page']=='form_reinit_pass_utilisateur'))
			{
				if ($_POST['page']=='form_add_utilisateur')
				{
					$titre_dialog = "AJOUT D'UN UTILISATEUR";
				}
				else if ($_POST['page']=='form_modify_utilisateur')
				{
					$titre_dialog = "MODIFICATION D'UN UTILISATEUR";
				}
				else if ($_POST['page']=='form_delete_utilisateur')
				{
					$titre_dialog = "SUPPRESSION D'UN UTILISATEUR";
				}
				else if ($_POST['page']=='form_visual_utilisateur')
				{
					$titre_dialog = "UTILISATEUR";
				}
				else if ($_POST['page']=='form_change_pass_utilisateur')
				{
					$titre_dialog = "CHANGEMENT DU MOT DE PASSE";
				}
				else if ($_POST['page']=='form_reinit_pass_utilisateur')
				{
					$titre_dialog = "REINITIALISATION DU MOT DE PASSE";
				}
				
				$contenu_dialog = file_get_contents('./vue/utilisateur/form_utilisateur.php');
				require './vue/utilisateur/form_utilisateur.php';
				
				$titre = "";
				$contenu = "";
			}

			//Page d'ajout, modification, suppression ou visualisation d'un profil
			if (($_POST['page']=='form_add_profil')or($_POST['page']=='form_modify_profil')or($_POST['page']=='form_delete_profil')or($_POST['page']=='form_visual_profil'))
			{
				if ($_POST['page']=='form_add_profil')
				{
					$titre_dialog = "AJOUT D'UN PROFIL";
				}
				else if ($_POST['page']=='form_modify_profil')
				{
					$titre_dialog = "MODIFICATION D'UN PROFIL";
				}
				else if ($_POST['page']=='form_delete_profil')
				{
					$titre_dialog = "SUPPRESSION D'UN PROFIL";
				}
				else if ($_POST['page']=='form_visual_profil')
				{
					$titre_dialog = "PROFIL";
				}
				
				$contenu_dialog = file_get_contents('./vue/utilisateur/form_profil.php');
				require './vue/utilisateur/form_profil.php';
				
				$titre = "";
				$contenu = "";
			}
			
			
			//Page de changement du mot de passe d'un utilisateur
			/* if (($_POST['page']=='form_change_pass_utilisateur'))
			{
				$titre_dialog = "CHANGEMENT DU MOT DE PASSE D'UN UTILISATEUR";
				$username = $_SESSION['username'];
				$contenu_dialog = file_get_contents('./vue/utilisateur/form_change_pass_utilisateur.php');
				require './vue/utilisateur/form_change_pass_utilisateur.php';
				
				$titre = "";
				$contenu = "";
			} */
			
			//Page de reinitialisation du mot de passe d'un utilisateur
			/* if (($_POST['page']=='form_reinit_pass_utilisateur'))
			{
				$titre_dialog = "REINITIALISATION DU MOT DE PASSE D'UN UTILISATEUR";
				
				$contenu_dialog = file_get_contents('./vue/utilisateur/form_reinit_pass_utilisateur.php');
				require './vue/utilisateur/form_reinit_pass_utilisateur.php';
				
				$titre = "";
				$contenu = "";
			} */
		}
				
		if (!empty($_POST['action'])) 
		{
			//Action d'ajout d'un utilisateur
			if ($_POST['action']=='add_utilisateur')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_utilisateur'))
				{
					echo ajoute_utilisateur();
				}
				else
				{
					echo "Vous ne disposez pas du droit d'ajout d'un utilisateur";
				}
			}
			//Action de modification d'un utilisateur
			else if ($_POST['action']=='modify_utilisateur')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_utilisateur'))
				{
					echo modifie_utilisateur();
				}
				else
				{
					echo "Vous ne disposez pas du droit de modification d'un utilisateur";
				}
			}
			//Action de suppression d'un utilisateur
			else if ($_POST['action']=='delete_utilisateur')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_utilisateur'))
				{
					echo supprime_utilisateur();
				}
				else
				{
					echo "Vous ne disposez pas du droit de suppression d'un utilisateur";
				}
			}
			//Action de reinitialisation du mot de passe d'un utilisateur
			else if ($_POST['action']=='reinit_pass_utilisateur')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'reinit_pass_utilisateur'))
				{
					echo reinit_pass_utilisateur();
				}
				else
				{
					echo "Vous ne disposez pas du droit de reinitialisation du mot de passe d'un utilisateur";
				}
			}
			//Action de changement du mot de passe d'un utilisateur
			else if ($_POST['action']=='change_pass_utilisateur')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'change_pass_utilisateur'))
				{
					echo change_pass_utilisateur();
				}
				else
				{
					echo "Vous ne disposez pas du droit de changer le mot de passe";
				}
			}
			//Action d'ajout d'un profil
			else if ($_POST['action']=='add_profil')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_profil'))
				{
					echo ajoute_profil();
				}
				else
				{
					echo "Vous ne disposez pas du droit d'ajout d'un profil utilisateur";
				}
			}
			//Action de modification d'un profil
			else if ($_POST['action']=='modify_profil')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_profil'))
				{
					echo modifie_profil();
				}
				else
				{
					echo "Vous ne disposez pas du droit de modification d'un profil utilisateur";
				}
			}
			//Action de suppression d'un profil
			else if ($_POST['action']=='delete_profil')
			{
				if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_profil'))
				{
					echo supprime_profil();
				}
				else
				{
					echo "Vous ne disposez pas du droit de suppression d'un profil utilisateur";
				}
			}
			//Action de récupération des informations des utilisateurs
			else if ($_POST['action']=='get_utilisateurs')
			{
				$crit = '';
				
				if(isset($_POST['utilisateur_connecte'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_utilisateur="'.$_SESSION['id_utilisateur'].'")';
				}

				if(!empty($_POST['id_utilisateur'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_utilisateur="'.$_POST['id_utilisateur'].'")';
				}
								
				if(!empty($_POST['nom_prenom'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.'AND';
					}
					$crit = $crit.'(nom_prenom_utilisateur LIKE "%'.$_POST['nom_prenom'].'%")';
				}
				
				if(!empty($_POST['username'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.'AND';
					}
					$crit = $crit.'(username_utilisateur LIKE "%'.$_POST['username'].'%")';
				}
				
				if ($crit == '')
				{
					echo read_data_table('inventepia_view_utilisateur_complet', '*', null, 'nom_prenom_utilisateur', true);
				}
				else
				{
					echo read_data_table('inventepia_view_utilisateur_complet', '*', $crit, 'nom_prenom_utilisateur', true);
				}
			}
			//Action de récupération des informations des types d'utilisateurs
			else if ($_POST['action']=='get_types_utilisateurs') {
				$crit = '';
				if(!empty($_POST['id_type_utilisateur'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_type_utilisateur="'.$_POST['id_type_utilisateur'].'")';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_type_utilisateur', '*', null, 'libelle_fr', true);
				}
				else {
					echo read_data_table('inventepia_type_utilisateur', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des profils
			else if ($_POST['action']=='get_profils')
			{
				$crit = '';
				
				if(!empty($_POST['id_profil'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_profil="'.$_POST['id_profil'].'")';
				}
								
				if(!empty($_POST['libelle_fr'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.'AND';
					}
					$crit = $crit.'(libelle_fr LIKE "%'.$_POST['libelle_fr'].'%")';
				}
				
				if(!empty($_POST['libelle_en'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.'AND';
					}
					$crit = $crit.'(libelle_en LIKE "%'.$_POST['libelle_en'].'%")';
				}
				
				if ($crit == '')
				{
					echo read_data_table('inventepia_view_profil_complet', '*', null, 'libelle_fr', true);
				}
				else
				{
					echo read_data_table('inventepia_view_profil_complet', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des profils non rattachés à un utilistaeur
			else if ($_POST['action']=='get_profils_utilisateur_dispo') {
				$crit = '';
				if(!empty($_POST['id_utilisateur'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'id_profil NOT IN (SELECT id_profil FROM inventepia_view_profil_utilisateur_complet WHERE id_utilisateur='.$_POST['id_utilisateur'].')';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_view_profil_complet', '*', null, 'libelle_fr', true);
				}
				else {
					echo read_data_table('inventepia_view_profil_complet', '*', $crit, 'libelle_fr', true);
				}
			}
			//Action de récupération des informations des profils rattachés à un utilistaeur
			else if ($_POST['action']=='get_profils_utilisateur') {
				$crit = '';
				if(!empty($_POST['id_utilisateur'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'id_utilisateur='.$_POST['id_utilisateur'];
				}
				if ($crit == '') {
					echo read_data_table('inventepia_view_profil_utilisateur_complet', '*', null, 'libelle_fr_profil', true);
				}
				else {
					echo read_data_table('inventepia_view_profil_utilisateur_complet', '*', $crit, 'libelle_fr_profil', true);
				}
			}
			//Action de récupération des informations des droits d'un profil
			else if ($_POST['action']=='get_droits_profil')
			{
				$crit = '';
				
				if(!empty($_POST['id_profil'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_profil='.$_POST['id_profil'].')';
				}
				
				{
					if(!empty($_POST['id_droit'])) 
					{
						if ($crit!='')
						{
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_droit="'.$_POST['id_droit'].'")';
					}
				}
								
				if ($crit == '')
				{
					echo read_data_table('inventepia_view_droit_profil_complet', '*', null, 'libelle_fr_droit', true);
				}
				else
				{
					echo read_data_table('inventepia_view_droit_profil_complet', '*', $crit, 'libelle_fr_droit', true);
				}
			}
			//Action de récupération des informations des droits non rattachés à un profil
			else if ($_POST['action']=='get_droits_dispo') {
				$crit = '';
				if(!empty($_POST['id_profil'])) {
					if ($crit!='') {
						$crit = $crit.' AND ';
					}
					$crit = $crit.'id_droit NOT IN (SELECT id_droit FROM inventepia_droit_profil WHERE id_profil='.$_POST['id_profil'].')';
				}
				if ($crit == '') {
					echo read_data_table('inventepia_droit', '*', null, 'libelle_fr', true);
				}
				else {
					echo read_data_table('inventepia_droit', '*', $crit, 'libelle_fr', true);
				}
			}
		}
	}
}