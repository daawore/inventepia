<?php
	function router_decoupage_administratif($mobile) {
		if (!empty($_POST)) {
			if (!empty($_POST['action'])) {
				//Action de récupération des informations des régions
				if ($_POST['action']=='get_regions'){
					$crit = '';
					if(!empty($_POST['id_region'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_region="'.$_POST['id_region'].'")';
					}
					if(!empty($_POST['libelle_fr'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(libelle_fr LIKE "%'.$_POST['libelle_fr'].'%")';
					}
					if(!empty($_POST['libelle_en'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(libelle_en LIKE "%'.$_POST['libelle_en'].'%")';
					}
					if ($crit == '') {
						echo read_data_table('inventepia_region', '*', null, 'libelle_fr', true);
					}
					else{
						echo read_data_table('inventepia_region', '*', $crit, 'libelle_fr', true);
					}
				}
                //Action de récupération des informations des départements
				else if ($_POST['action']=='get_departements'){
					$crit = '';
					if(!empty($_POST['id_departement'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_departement="'.$_POST['id_departement'].'")';
					}
					if(!empty($_POST['id_region'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_region="'.$_POST['id_region'].'")';
					}
					if(!empty($_POST['libelle'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(libelle LIKE "%'.$_POST['libelle'].'%")';
					}
					if ($crit == '') {
						echo read_data_table('inventepia_departement', '*', null, 'libelle', true);
					}
					else{
						echo read_data_table('inventepia_departement', '*', $crit, 'libelle', true);
					}
				}
                //Action de récupération des informations des arrondissements
				else if ($_POST['action']=='get_arrondissements'){
					$crit = '';
					if(!empty($_POST['id_arrondissement'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_arrondissement="'.$_POST['id_arrondissement'].'")';
					}
					if(!empty($_POST['id_departement'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(id_departement="'.$_POST['id_departement'].'")';
					}
					if(!empty($_POST['libelle'])) {
						if ($crit!='') {
							$crit = $crit.' AND ';
						}
						$crit = $crit.'(libelle LIKE "%'.$_POST['libelle'].'%")';
					}
					if ($crit == '') {
						echo read_data_table('inventepia_arrondissement', '*', null, 'libelle', true);
					}
					else{
						echo read_data_table('inventepia_arrondissement', '*', $crit, 'libelle', true);
					}
				}
			}
		}
	}