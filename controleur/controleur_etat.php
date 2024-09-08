<?php
function router_etat($mobile)
{
	if(!empty($_GET))
	{
		if(!empty($_GET['page'])) 
		{
			if($_GET['page']=='form_finance_global')
			{
				$titre = "TABLEAU DE BORD";
				
				$rows_exercice_en_cours = read_data_table('exercice', '*', 'exercice_en_cours=true', 'annee_exercice DESC', null);
				
				if ($row_exercice_en_cours = $rows_exercice_en_cours->fetch())
				{
					$nom_fr_exercice_en_cours = $row_exercice_en_cours['nom_fr_exercice'];
					
					//Déterminantion du bilan de chaque caisse
					$rows_bilan_caisse = read_data_table('view_bilan_caisse', '*', 'id_exercice='.$row_exercice_en_cours['id_exercice'], null, null);
					if ($row_bilan_caisse = $rows_bilan_caisse->fetch())
					{
						$tot_inscription = number_format($row_bilan_caisse['tot_inscription'], 0, ',', ' ');
						$tot_secours = number_format($row_bilan_caisse['tot_secours'], 0, ',', ' ');
						$tot_aide = number_format($row_bilan_caisse['tot_aide'], 0, ',', ' ');
						$bilan_secours = number_format($row_bilan_caisse['tot_secours'] - $row_bilan_caisse['tot_aide'], 0, ',', ' ');;
						$tot_projet_social = number_format($row_bilan_caisse['tot_projet_social'], 0, ',', ' ');
						$tot_epargne = number_format($row_bilan_caisse['tot_epargne'], 0, ',', ' ');
						$tot_pret = number_format($row_bilan_caisse['tot_pret'], 0, ',', ' ');
						$tot_remb_pret = number_format($row_bilan_caisse['tot_remb_pret'], 0, ',', ' ');
						$bilan_epargne = number_format($row_bilan_caisse['tot_epargne'] - $row_bilan_caisse['tot_pret'] + $row_bilan_caisse['tot_remb_pret'], 0, ',', ' ');
						$tot_epargne_scolaire = number_format($row_bilan_caisse['tot_epargne_scolaire'], 0, ',', ' ');
						$tot_don = number_format($row_bilan_caisse['tot_don'], 0, ',', ' ');
						$tot_echec = number_format($row_bilan_caisse['tot_echec'], 0, ',', ' ');
						$tot_remb_echec = number_format($row_bilan_caisse['tot_remb_echec'], 0, ',', ' ');
						$bilan_echec = number_format($row_bilan_caisse['tot_remb_echec'] - $row_bilan_caisse['tot_echec'], 0, ',', ' ');
						$tot_sanction = number_format($row_bilan_caisse['tot_sanction'], 0, ',', ' ');
						$tot_paie_sanction = number_format($row_bilan_caisse['tot_paie_sanction'], 0, ',', ' ');
						$tot_sanction_non_payee = number_format($row_bilan_caisse['tot_sanction'] - $row_bilan_caisse['tot_paie_sanction'], 0, ',', ' ');
						$bilan_sanction = $tot_paie_sanction;
						$tot_projet_rentable = number_format($row_bilan_caisse['tot_projet_rentable'], 0, ',', ' ');
						$tot_inves = number_format($row_bilan_caisse['tot_inves'], 0, ',', ' ');
						$tot_retour_inves = number_format($row_bilan_caisse['tot_retour_inves'], 0, ',', ' ');
						$bilan_projet_rentable = number_format($row_bilan_caisse['tot_projet_rentable'] - $row_bilan_caisse['tot_inves'] + $row_bilan_caisse['tot_retour_inves'], 0, ',', ' ');
						$tot_autre_entree = number_format($row_bilan_caisse['tot_autre_entree'], 0, ',', ' ');
						$tot_autre_sortie = number_format($row_bilan_caisse['tot_autre_sortie'], 0, ',', ' ');
					
						$bilan = number_format($row_bilan_caisse['tot_inscription'] + $row_bilan_caisse['tot_secours'] + $row_bilan_caisse['tot_projet_rentable'] + $row_bilan_caisse['tot_projet_social'] + $row_bilan_caisse['tot_epargne'] + $row_bilan_caisse['tot_epargne_scolaire'] + $row_bilan_caisse['tot_don'] - $row_bilan_caisse['tot_aide'] - $row_bilan_caisse['tot_echec'] + $row_bilan_caisse['tot_remb_echec'] + $row_bilan_caisse['tot_paie_sanction'] - $row_bilan_caisse['tot_pret'] + $row_bilan_caisse['tot_remb_pret'] + $row_bilan_caisse['tot_autre_entree'] - $row_bilan_caisse['tot_autre_sortie'] - $row_bilan_caisse['tot_inves'] + $row_bilan_caisse['tot_retour_inves'], 0, ',', ' ');
					}
				}
				else
				{
					$nom_fr_exercice_en_cours = 'Aucun exercice défini';
				}
				
				if ($mobile == true) {
					require 'vue/vue_gabarit.php';
				}
				else {
					require 'vue/vue_gabarit.php';
				}
			}
			
			if($_GET['page']=='form_finance_assise')
			{
				$rows_exercice_en_cours = read_data_table('exercice', '*', 'exercice_en_cours=true', 'annee_exercice DESC', null);
				
				if ($row_exercice_en_cours = $rows_exercice_en_cours->fetch())
				{
					$id_exercice_en_cours = $row_exercice_en_cours['id_exercice'];
					$nom_fr_exercice_en_cours = $row_exercice_en_cours['nom_fr_exercice'];
				}
				else
				{
					$nom_fr_exercice_en_cours = 'Aucun exercice défini';
				}
								
				$titre = "ETAT DES FINANCES PAR ASSISE";
				$type_gabarit = "simple";
				$contenu = file_get_contents('vue/etat/form_finance_assise.php');
				require 'vue/vue_gabarit.php';
			}
			
			if($_GET['page']=='form_finance_membre')
			{
				$rows_exercice_en_cours = read_data_table('exercice', '*', 'exercice_en_cours=true', 'annee_exercice DESC', null);
				
				if ($row_exercice_en_cours = $rows_exercice_en_cours->fetch())
				{
					$id_exercice_en_cours = $row_exercice_en_cours['id_exercice'];
					$nom_fr_exercice_en_cours = $row_exercice_en_cours['nom_fr_exercice'];
				}
				else
				{
					$nom_fr_exercice_en_cours = 'Aucun exercice défini';
				}
				
				$titre = "ETAT DES FINANCES PAR MEMBRE";
				$type_gabarit = "simple";
				$contenu = file_get_contents('./vue/etat/form_finance_membre.php');
				require './vue/vue_gabarit.php';
			}

			if($_GET['page']=='rapproch_ecrits_tresor_assise')
			{
				$rows_exercice_en_cours = read_data_table('exercice', '*', 'exercice_en_cours=true', 'annee_exercice DESC', null);
				
				if ($row_exercice_en_cours = $rows_exercice_en_cours->fetch())
				{
					$id_exercice_en_cours = $row_exercice_en_cours['id_exercice'];
					$nom_fr_exercice_en_cours = $row_exercice_en_cours['nom_fr_exercice'];
				}
				else
				{
					$nom_fr_exercice_en_cours = 'Aucun exercice défini';
				}
				
				$titre = "RAPPROCHEMENT ECRITS-TRESOR";
				$type_gabarit = "simple";
				$contenu = file_get_contents('./vue/etat/rapproch_ecrits_tresor_assise.php');
				require './vue/vue_gabarit.php';
			}
		}
	}
	
	if(!empty($_POST))
	{
		if(!empty($_POST['action'])) 
		{
			if($_POST['action']=='finance_global')
			{
				$rows_exercice_en_cours = read_data_table('exercice', '*', 'exercice_en_cours=true', 'annee_exercice DESC', null);
				if ($row_exercice_en_cours = $rows_exercice_en_cours->fetch())
				{
					echo read_data_table('view_bilan_caisse', '*', 'id_exercice='.$row_exercice_en_cours['id_exercice'], null, true);
				}
			}
			
			if($_POST['action']=='finance_assise')
			{
				if(!empty($_POST['id_membre']))
				{
					echo read_data_table('view_bilan_caisse_by_membre_assise', '*', 'id_exercice='.$_POST['id_exercice'].' AND id_membre='.$_POST['id_membre'], 'numero_assise ASC', true);
				}
				else
				{
					echo read_data_table('view_bilan_caisse_by_assise', '*', 'id_exercice='.$_POST['id_exercice'], 'numero_assise ASC', true);
				}
			}
			
			if($_POST['action']=='finance_membre')
			{
				$crit = '(1=1)';
				
				if(!empty($_POST['id_assise']))
				{
					$table = 'view_bilan_caisse_by_membre_assise';
					$crit = $crit.' AND id_exercice='.$_POST['id_exercice'].' AND id_assise='.$_POST['id_assise'];
					
					if(!empty($_POST['id_membre'])) {
						$crit = $crit.' AND id_membre='.$_POST['id_membre'];
					}
				}
				else
				{	
					$table = 'view_bilan_caisse_by_membre';
					$crit = $crit.' AND id_exercice='.$_POST['id_exercice'];
				}

				echo read_data_table($table, '*', $crit, 'nom_membre ASC', true);
			}

			if($_POST['action']=='get_rapproch_ecrits_tresor_assise')
			{
				echo read_data_table('view_rapproch_ecrits_tresor_by_assise', '*', 'id_exercice='.$_POST['id_exercice'], 'numero_assise ASC', true);
			}

			if($_POST['action']=='get_bilan_autres_es_assoc')
			{
				$crit = '';
				
				if(!empty($_POST['id_exercice'])) 
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_exercice='.$_POST['id_exercice'].')';
				}
				
				if(!empty($_POST['id_assise']))
				{
					if ($crit!='')
					{
						$crit = $crit.' AND ';
					}
					$crit = $crit.'(id_assise='.$_POST['id_assise'].')';

					if ($crit == '')
					{
						echo read_data_table('view_bilan_autres_es_assoc_by_assise', '*', null, 'numero_assise ASC', true);
					}
					else
					{
						echo read_data_table('view_bilan_autres_es_assoc_by_assise', '*', $crit, 'numero_assise ASC', true);
					}
				}
				else
				{
					if ($crit == '')
					{
						echo read_data_table('view_bilan_autres_es_assoc_by_exercice', '*', null, null, true);
					}
					else
					{
						echo read_data_table('view_bilan_autres_es_assoc_by_exercice', '*', $crit, null, true);
					}
				}
			}
		}
	}
}