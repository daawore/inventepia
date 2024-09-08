<?php
	function router_lieu_stock($mobile) {
		if(!empty($_GET)) {
			if(!empty($_GET['page'])) 
			{
				//Page de recherche des unités
				if($_GET['page']=='find_lieu_stock')
				{
					$titre = "LIEUX DE STOCKAGE";
					$contenu = file_get_contents('./vue/lieu_stock/find_lieu_stock.php');
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
				if (($_POST['page']=='form_add_lieu_stock')or($_POST['page']=='form_modify_lieu_stock')or($_POST['page']=='form_delete_lieu_stock')or($_POST['page']=='form_visual_lieu_stock'))
				{
					if ($_POST['page']=='form_add_lieu_stock')
					{
						$titre_dialog = "AJOUT D'UN LIEU DE STOCKAGE";
					}
					else if ($_POST['page']=='form_modify_lieu_stock')
					{
						$titre_dialog = "MODIFICATION D'UN LIEU DE STOCKAGE";
					}
					else if ($_POST['page']=='form_delete_lieu_stock')
					{
						$titre_dialog = "SUPPRESSION D'UN LIEU DE STOCKAGE";
					}
					else if ($_POST['page']=='form_visual_lieu_stock')
					{
						$titre_dialog = "LIEU DE STOCKAGE";
					}
					
					$contenu_dialog = file_get_contents('./vue/lieu_stock/form_lieu_stock.php');
					require './vue/lieu_stock/form_lieu_stock.php';
					
					$titre = "";
					$contenu = "";
				}
			}
					
			if (!empty($_POST['action'])) 
			{
				//Action d'ajout d'une unité
				if ($_POST['action']=='add_lieu_stock')
				{
					if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'aj_lieu_stock'))
					{
						echo ajoute_lieu_stock();
					}
					else
					{
						echo "Vous ne disposez pas du droit d'ajout d'un lieu de stockage";
					}
				}
				//Action de modification d'une unité
				else if ($_POST['action']=='modify_lieu_stock')
				{
					if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'modif_lieu_stock'))
					{
						echo modifie_lieu_stock();
					}
					else
					{
						echo "Vous ne disposez pas du droit de modification d'un lieu de stockage";
					}
				}
				//Action de suppression d'une unité
				else if ($_POST['action']=='delete_lieu_stock')
				{
					if  (check_droit_utilisateur($_SESSION['id_utilisateur'], 'sup_lieu_stock'))
					{
						echo supprime_lieu_stock();
					}
					else
					{
						echo "Vous ne disposez pas du droit de suppression d'un lieu de stockage";
					}
				}
				//Action de récupération des informations des unités
				else if ($_POST['action']=='get_lieux_stock')
				{
					$crit = '';
					
					if(!empty($_POST['id_lieu_stock'])) 
					{
						if ($crit!='')
						{
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_lieu_stock="'.$_POST['id_lieu_stock'].'")';
					}
					if(!empty($_POST['id_region'])) 
					{
						if ($crit!='')
						{
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_region='.$_POST['id_region'].')';
					}
					if(!empty($_POST['id_departement'])) 
					{
						if ($crit!='')
						{
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_departement='.$_POST['id_departement'].')';
					}
					if(!empty($_POST['id_arrondissement'])) 
					{
						if ($crit!='')
						{
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_arrondissement='.$_POST['id_arrondissement'].')';
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
					if(!empty($_POST['localite'])) 
					{
						if ($crit!='')
						{
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(localite LIKE "%'.$_POST['localite'].'%")';
					}
					if ($crit == '')
					{
						echo read_data_table('inventepia_view_lieu_stock_complet', '*', null, 'libelle_fr', true);
					}
					else
					{
						echo read_data_table('inventepia_view_lieu_stock_complet', '*', $crit, 'libelle_fr', true);
					}
				}
			}
		}
	}