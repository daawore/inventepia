<?php
// define('bd_host', "185.98.131.91:3306");
define('bd_host', "localhost:3306");
define('bd_name', "rgaec1906150_13fzpk");
define('bd_user', "rgaec1906150_13fzpk");
define('bd_password', "did@01Genny");
function db_connect()
{
	try {
		$bdd = new PDO('mysql:host=' . bd_host . ';dbname=' . bd_name . ';charset=utf8', bd_user, bd_password);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $bdd;
	} catch (Exception $e) {
		die("Erreur : " . $e->getmessage());
	}
}
function mark_connect()
{
	$bdd = db_connect();
	$bdd->exec('CALL inventepia_mark_connect(' . $_SESSION['id_utilisateur'] . ', "' . $_SESSION['username_utilisateur'] . '", "' . $_SESSION['nom_prenom_utilisateur'] . '");');
}
function mark_disconnect()
{
	$bdd = db_connect();
	$bdd->exec('CALL inventepia_mark_disconnect(' . $_SESSION['id_utilisateur'] . ', "' . $_SESSION['username_utilisateur'] . '", "' . $_SESSION['nom_prenom_utilisateur'] . '");');
}
function gen_sql_mark_mouchard($action_fr, $action_en, $details_fr, $details_en)
{
	// $bdd_in->exec('CALL inventepia_mark_mouchard(' . $_SESSION['id_utilisateur'] . ', "' . $_SESSION['username_utilisateur'] . '", "' . $_SESSION['nom_prenom_utilisateur'] . '", "' . $action_fr . '", "' . $action_en . '", "' . $details_fr . '", "' . $details_en . '");');
	return 'CALL inventepia_mark_mouchard(' . $_SESSION['id_utilisateur'] . ', "' . $_SESSION['username_utilisateur'] . '", "' . $_SESSION['nom_prenom_utilisateur'] . '", "' . $action_fr . '", "' . $action_en . '", "' . $details_fr . '", "' . $details_en . '");';
}
function check_droit_utilisateur($id_utilisateur, $id_droit)
{
	$bdd = db_connect();
	$req = $bdd->query('SELECT inventepia_check_droit_utilisateur(' . $id_utilisateur . ', "' . $id_droit . '") AS result');
	if ($row = $req->fetch()) {
		return $row['result'];
	}
	$req->closeCursor();
}
function get_data($sql, $json_format = null)
{
	$bdd = db_connect();
	$req = $bdd->query($sql);
	if ($json_format == null) {
		return $req;
	} else {
		$rows = array();
		while ($row = $req->fetch()) {
			$rows[] = $row;
		}
		return json_encode($rows);
	}
}
function read_data_table($table, $items, $cond = null, $order = null, $json_format = null)
{
	$bdd = db_connect();
	$sql = 'SELECT ' . $items . ' FROM ' . $table;
	if ($cond != null) {
		$sql = $sql . ' WHERE ' . $cond;
	}
	if ($order != null) {
		$sql = $sql . ' ORDER BY ' . $order;
	}
	$req = $bdd->query($sql);
	if ($json_format == null) {
		return $req;
	} else {
		$rows = array();
		while ($row = $req->fetch()) {
			$rows[] = $row;
		}
		return json_encode($rows);
	}
}

function ajoute_unite() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_unite SET
					libelle_fr="' . $_POST['libelle_fr'] . '",
					libelle_en="' . $_POST['libelle_en'] . '"; ';
			$sql .= gen_sql_mark_mouchard("Ajout d'une unité", "Adding a unit", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_unite() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_unite SET
					libelle_fr="' . $_POST['libelle_fr'] . '",
					libelle_en="' . $_POST['libelle_en'] . '"
				WHERE id_unite=' . $_POST['id_unite'].'; ';
			$sql .= gen_sql_mark_mouchard("Modification d'une unité", "Modifying a unit", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_unite() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_unite WHERE id_unite=' . $_POST['id_unite'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'une unité", "Deleting a unit", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function ajoute_lieu_stock() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_lieu_stock SET
					id_arrondissement=' . $_POST['id_arrondissement_lieu_stock'] . ',
					localite="' . $_POST['localite_lieu_stock'] . '",
					libelle_fr="' . $_POST['libelle_fr_lieu_stock'] . '",
					libelle_en="' . $_POST['libelle_en_lieu_stock'] . '",
					observation="' . $_POST['observation_lieu_stock'] . '"; ';
			$sql .= gen_sql_mark_mouchard("Ajout d'un lieu de stockage", "Adding a storage location", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_lieu_stock() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_lieu_stock SET
					id_arrondissement=' . $_POST['id_arrondissement_lieu_stock'] . ',
					localite="' . $_POST['localite_lieu_stock'] . '",
					libelle_fr="' . $_POST['libelle_fr_lieu_stock'] . '",
					libelle_en="' . $_POST['libelle_en_lieu_stock'] . '",
					observation="' . $_POST['observation_lieu_stock'] . '"
				WHERE id_lieu_stock=' . $_POST['id_lieu_stock'].'; ';
			$sql .= gen_sql_mark_mouchard("Modification d'un lieu de stockage", "Modifying a storage location", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_lieu_stock() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_lieu_stock WHERE id_lieu_stock=' . $_POST['id_lieu_stock'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'un lieu de stockage", "Deleting a storage location", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function ajoute_commande() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_commande SET
					reference="'.$_POST['reference'].'",
					date_signature='.(function(){if ($_POST['date_signature'] == '') {return 'null';} else {return '"'.$_POST['date_signature'].'"';}})().',
					intitule_fr="'.$_POST['intitule_fr'].'",
					intitule_en="'.$_POST['intitule_en'].'",
					consistance_fr="'.$_POST['consistance_fr'].'",
					consistance_en="'.$_POST['consistance_en'].'",
					raison_sociale_prestataire="'.$_POST['raison_sociale_prestataire'].'",
					nom_prenom_prestataire="'.$_POST['nom_prenom_prestataire'].'",
					id_type_commande='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})($_POST['id_type_commande']).',
					montant_ttc='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['montant_ttc'])).',
					tva='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['tva'])).',
					montant_ht='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['montant_ht'])).',
					ir='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['ir'])).',
					montant_a_percevoir='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['montant_a_percevoir'])).'; ';

			if (!empty($_POST['numero_article'])) {
				if (count($_POST['numero_article']) > 0) {
					//Récupération de l'ID de la commande
					$sql .= 'SET @new_id_commande = LAST_INSERT_ID();';
					for ($numero = 0; $numero < count($_POST['numero_article']); $numero++) {
						if (($_POST['id_article'])[$numero] == null || ($_POST['id_article'])[$numero] == '') {
							$sql .= 
								'INSERT INTO inventepia_article_commande SET
									id_commande=@new_id_commande,
									numero_article='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['numero_article'])[$numero])).',
									designation="'.($_POST['designation_article'])[$numero].'",
									id_unite='.($_POST['id_unite_article'])[$numero].',
									quantite='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['quantite_article'])[$numero])).',
									prix_unitaire_ttc='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['prix_unitaire_ttc_article'])[$numero])).',
									prix_unitaire_ht='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['prix_unitaire_ht_article'])[$numero])).'; ';
						}
					}
				}
			}
			$sql .= gen_sql_mark_mouchard("Ajout d'une commande", "Adding a order", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_commande() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			//Requête permettant d'ajouter la commande dans la table commande
			$sql =
				'UPDATE inventepia_commande SET
					reference="'.$_POST['reference'].'",
					date_signature='.(function(){if ($_POST['date_signature'] == '') {return 'null';} else {return '"'.$_POST['date_signature'].'"';}})().',
					intitule_fr="'.$_POST['intitule_fr'].'",
					intitule_en="'.$_POST['intitule_en'].'",
					consistance_fr="'.$_POST['consistance_fr'].'",
					consistance_en="'.$_POST['consistance_en'].'",
					raison_sociale_prestataire="'.$_POST['raison_sociale_prestataire'].'",
					nom_prenom_prestataire="'.$_POST['nom_prenom_prestataire'].'",
					id_type_commande='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})($_POST['id_type_commande']).',
					montant_ttc='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['montant_ttc'])).',
					tva='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['tva'])).',
					montant_ht='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['montant_ht'])).',
					ir='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['ir'])).',
					montant_a_percevoir='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', $_POST['montant_a_percevoir'])).'
				WHERE id_commande='.$_POST['id_commande'].'; ';
				
			//Requête permettant de supprimer tous les articles qui ne sont plus dans la commande
			$sql .= 'DELETE FROM inventepia_article_commande WHERE (id_commande='.$_POST['id_commande'].')';
			if (empty($_POST['numero_article'])) {
				$sql .= '; ';
			}
			else {
				if (count($_POST['numero_article']) > 0) {
					$cond_delete = '';
					for ($numero = 0; $numero < count($_POST['numero_article']); $numero++) {
						if (($_POST['id_article'])[$numero] != null && ($_POST['id_article'])[$numero] != '') {
							if ($cond_delete == '') {
								$cond_delete .= ' AND id_article NOT IN ('.($_POST['id_article'])[$numero];
							}
							else {
								$cond_delete .= ', '.($_POST['id_article'])[$numero];
							}
						}
					}
					if ($cond_delete != '') {
						$cond_delete .= ')';
					}
					$sql .= $cond_delete.';';
					
					for ($numero = 0; $numero < count($_POST['numero_article']); $numero++) {
						if (($_POST['id_article'])[$numero] == null || ($_POST['id_article'])[$numero] == '') {
							$sql .= 
								'INSERT INTO inventepia_article_commande SET
									id_commande='.$_POST['id_commande'].',
									numero_article='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['numero_article'])[$numero])).',
									designation="'.($_POST['designation_article'])[$numero].'",
									id_unite='.($_POST['id_unite_article'])[$numero].',
									quantite='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['quantite_article'])[$numero])).',
									prix_unitaire_ttc='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['prix_unitaire_ttc_article'])[$numero])).',
									prix_unitaire_ht='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['prix_unitaire_ht_article'])[$numero])).'; ';
						}
						else {
							$sql .= 
								'UPDATE inventepia_article_commande SET
									id_commande='.$_POST['id_commande'].',
									numero_article='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['numero_article'])[$numero])).',
									designation="'.($_POST['designation_article'])[$numero].'",
									id_unite='.($_POST['id_unite_article'])[$numero].',
									quantite='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['quantite_article'])[$numero])).',
									prix_unitaire_ttc='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['prix_unitaire_ttc_article'])[$numero])).',
									prix_unitaire_ht='.(function($value){if ($value=="" || $value==null){return "null";} else {return $value;}})(str_replace(' ', '', ($_POST['prix_unitaire_ht_article'])[$numero])).'
								WHERE id_article='.($_POST['id_article'])[$numero].'; ';
						}
					}
				}
			}
			$sql .= gen_sql_mark_mouchard("Modification d'une commande", "Modifying a order", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_commande() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_commande WHERE id_commande=' . $_POST['id_commande'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'une commande", "Deleting a order", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}

function demarrer_suivi_commande() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			//Requête permettant de supprimer toutes les étapes qui ne sont plus dans la commande
			$sql = 'DELETE FROM inventepia_etape_commande WHERE (id_commande='.$_POST['id_commande'].')';
			if (empty($_POST['id_etape_commande'])) {
				$sql .= '; ';
			}
			else {
				if (count($_POST['id_etape_commande']) > 0) {
					$cond_delete = '';
					for ($numero = 0; $numero < count($_POST['id_etape_commande']); $numero++) {
						if (($_POST['id_etape_commande'])[$numero] != null && ($_POST['id_etape_commande'])[$numero] != '') {
							if ($cond_delete == '') {
								$cond_delete .= ' AND id_etape_commande NOT IN ('.($_POST['id_etape_commande'])[$numero];
							}
							else {
								$cond_delete .= ','.($_POST['id_etape_commande'])[$numero];
							}
						}
					}
					if ($cond_delete != '') {
						$cond_delete .= ')';
					}
					$sql .= $cond_delete.';';
					
					for ($numero = 0; $numero < count($_POST['id_etape_commande']); $numero++) {
						if (($_POST['id_etape_commande'])[$numero] != null && ($_POST['id_etape_commande'])[$numero] != '') {
							$sql .= '
								INSERT INTO inventepia_etape_commande SET
									id_commande='.$_POST['id_commande'].',
									id_etape_commande='.($_POST['id_etape_commande'])[$numero].',
									numero_ordre_etape='.($_POST['numero_ordre_etape'])[$numero].'
								ON DUPLICATE KEY UPDATE
									id_commande='.$_POST['id_commande'].',
									id_etape_commande='.($_POST['id_etape_commande'])[$numero].',
									numero_ordre_etape='.($_POST['numero_ordre_etape'])[$numero].'; ';
						}
					}
				}
			}
			$sql .= gen_sql_mark_mouchard("Démarrage du suivi d'une commande", "Starting an order follow-up", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}

function enregistrer_etapes_commande() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			if (count($_POST['id_etape_commande']) > 0) {
				$sql = '';
				for ($numero = 0; $numero < count($_POST['id_etape_commande']); $numero++) {
					if (($_POST['id_etape_commande'])[$numero] != null && ($_POST['id_etape_commande'])[$numero] != '') {
						if (($_POST['etape_execute'])[$numero] == '1') {
							$value_execute = 'true';
							$sql .= gen_sql_mark_mouchard("Enregistrement de l'exécution de l'étape [".($_POST['libelle_fr_etape_commande'])[$numero]."] de la commande [".$_POST['reference']."]", "Recording the step execution [".($_POST['libelle_fr_etape_commande'])[$numero]."] de la commande [".$_POST['reference']."]", "", "");
						}
						else {
							$value_execute = 'false';
							$sql .= gen_sql_mark_mouchard("Annulation de l'exécution de l'étape [".($_POST['libelle_fr_etape_commande'])[$numero]."] de la commande [".$_POST['reference']."]", "Canceling the step execution [".($_POST['libelle_fr_etape_commande'])[$numero]."] de la commande [".$_POST['reference']."]", "", "");
						}
						$sql .= '
							UPDATE inventepia_etape_commande SET
								execute='.$value_execute.'
							WHERE
								id_commande='.$_POST['id_commande'].' AND
								id_etape_commande='.($_POST['id_etape_commande'])[$numero].'; ';
					}
				}
			}
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function ajoute_personnel() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_personnel SET
					matricule="'.$_POST['matricule_personnel'].'",
					nom_prenom="'.$_POST['nom_prenom_personnel'].'"; ';
			$sql .= gen_sql_mark_mouchard("Ajout d'un personnel", "Adding a personnel", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_personnel() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_personnel SET
					matricule="'.$_POST['matricule_personnel'].'",
					nom_prenom="'.$_POST['nom_prenom_personnel'].'"
				WHERE id_personnel=' . $_POST['id_personnel'].'; ';
			$sql .= gen_sql_mark_mouchard("Modification d'un personnel", "Modifying a personnel", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_personnel() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_personnel WHERE id_personnel='.$_POST['id_personnel'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'un personnel", "Deleting a personnel", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}

function ajoute_bien() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_bien SET
					id_type_bien="' . $_POST['id_type_bien'] . '",
					designation="' . $_POST['designation_bien'] . '",
					quantite="' . $_POST['quantite_bien'] . '"';
			if (!empty($_POST['id_etat_bien'])) {
				$sql .= ',
					id_etat="'.$_POST['id_etat_bien'].'"';
			}
			else {
				$sql .= ',
					id_etat=null';
			}
			if (!empty($_POST['observation_bien'])) {
				$sql .= ',
					observation="'.$_POST['observation_bien'].'"';
			}
			else {
				$sql .= ',
					observation=null';
			}
			if (!empty($_POST['id_detenteur_bien'])) {
				$sql .= ',
					id_detenteur='.$_POST['id_detenteur_bien'].',
					date_attribution='.(function() {if ($_POST['date_attribution_bien'] == '') {return 'null';} else {return '"'.$_POST['date_attribution_bien'].'"';}})();
			}
			else {
				$sql .= ',
					id_detenteur=null,
					date_attribution=null';
			}
			if (!empty($_POST['id_commande_bien'])) {
				$sql .= ',
					id_commande='.$_POST['id_commande_bien'];
			}
			else {
				$sql .= ',
					id_commande=null';
			}
			if (!empty($_POST['id_article_commande_bien'])) {
				$sql .= ',
					id_article_commande='.$_POST['id_article_commande_bien'];
			}
			else {
				$sql .= ',
					id_article_commande=null';
			}
			$sql .= '; ';
			
			//Requêtes permettant de modifier ou d'ajouter les caractéristiques du bien
			if (!empty($_POST['id_caracteristique'])) {
				if (count($_POST['id_caracteristique']) > 0) {
					//Récupératon de l'ID du bien
					$sql .= 'SET @new_id_bien = LAST_INSERT_ID();';
					for ($numero = 0; $numero < count($_POST['id_caracteristique']); $numero++) {
						$sql .= '
							INSERT INTO inventepia_valeur_caracteristique_bien SET
								id_bien=@new_id_bien,
								id_type_bien='.$_POST['id_type_bien'].',
								id_caracteristique='.($_POST['id_caracteristique'])[$numero].',
								valeur="'.($_POST['valeur'])[$numero].'"
							ON DUPLICATE KEY UPDATE
								valeur="'.($_POST['valeur'])[$numero].'"; ';
					}
				}
			}
			$sql .= gen_sql_mark_mouchard("Ajout d'un bien", "Adding a property", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_bien() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_bien SET
					id_type_bien="' . $_POST['id_type_bien'] . '",
					designation="' . $_POST['designation_bien'] . '",
					quantite="' . $_POST['quantite_bien'] . '"';
			if (!empty($_POST['id_etat_bien'])) {
				$sql .= ',
					id_etat="'.$_POST['id_etat_bien'].'"';
			}
			else {
				$sql .= ',
					id_etat=null';
			}
			if (!empty($_POST['observation_bien'])) {
				$sql .= ',
					observation="'.$_POST['observation_bien'].'"';
			}
			else {
				$sql .= ',
					observation=null';
			}
			if (!empty($_POST['id_detenteur_bien'])) {
				$sql .= ',
					id_detenteur='.$_POST['id_detenteur_bien'].',
					date_attribution='.(function() {if ($_POST['date_attribution_bien'] == '') {return 'null';} else {return '"'.$_POST['date_attribution_bien'].'"';}})();
			}
			else {
				$sql .= ',
					id_detenteur=null,
					date_attribution=null';
			}
			if (!empty($_POST['id_commande_bien'])) {
				$sql .= ',
					id_commande='.$_POST['id_commande_bien'];
			}
			else {
				$sql .= ',
					id_commande=null';
			}
			if (!empty($_POST['id_article_commande_bien'])) {
				$sql .= ',
					id_article_commande='.$_POST['id_article_commande_bien'];
			}
			else {
				$sql .= ',
					id_article_commande=null';
			}
			$sql .= '
				WHERE id_bien='.$_POST['id_bien'].'; ';
			
			//Requête permettant de supprimer toutes les caractéristique qui ne sont plus celles du bien
			$sql .= '
				DELETE FROM inventepia_valeur_caracteristique_bien
				WHERE
					(id_bien='.$_POST['id_bien'].') AND
					(id_caracteristique NOT IN
						(
							SELECT id_caracteristique
							FROM inventepia_caracteristique_type_bien
							WHERE id_type_bien IN (SELECT id_type_bien FROM inventepia_bien WHERE id_bien = '.$_POST['id_bien'].')
						)
					);';
			
			//Requêtes permettant de modifier ou d'ajouter les caractéristiques du bien
			if (empty($_POST['id_caracteristique'])) {
				// $sql .= '; ';
			}
			else {
				if (count($_POST['id_caracteristique']) > 0) {
					for ($numero = 0; $numero < count($_POST['id_caracteristique']); $numero++) {
						if (trim(($_POST['valeur'])[$numero]) == '') {
							$sql .= '
								DELETE FROM inventepia_valeur_caracteristique_bien
								WHERE
									(id_bien='.$_POST['id_bien'].') AND
									(id_caracteristique='.($_POST['id_caracteristique'])[$numero].');';
						}
						else {
							$sql .= '
								INSERT INTO inventepia_valeur_caracteristique_bien SET
									id_bien='.$_POST['id_bien'].',
									id_type_bien='.$_POST['id_type_bien'].',
									id_caracteristique='.($_POST['id_caracteristique'])[$numero].',
									valeur="'.($_POST['valeur'])[$numero].'"
								ON DUPLICATE KEY UPDATE
									valeur="'.($_POST['valeur'])[$numero].'"; ';
						}
					}
				}
			}

			$sql .= gen_sql_mark_mouchard("Modification d'un bien", "Modifying a property", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_bien() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_bien WHERE id_bien='.$_POST['id_bien'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'un bien", "Deleting a property", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}


function ajoute_caracteristique() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_caracteristique SET
					libelle_fr="' . $_POST['libelle_fr'] . '",
					abrev_fr="' . $_POST['abrev_fr'] . '",
					libelle_en="' . $_POST['libelle_en'] . '",
					abrev_en="' . $_POST['abrev_en'] . '",
					type="' . $_POST['type'] . '"; ';
			$sql .= gen_sql_mark_mouchard("Ajout d'une caractéristique", "Adding a caracteristic", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_caracteristique() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_caracteristique SET
					libelle_fr="' . $_POST['libelle_fr'] . '",
					abrev_fr="' . $_POST['abrev_fr'] . '",
					libelle_en="' . $_POST['libelle_en'] . '",
					abrev_en="' . $_POST['abrev_en'] . '",
					type="' . $_POST['type'] . '"
				WHERE id_caracteristique=' . $_POST['id_caracteristique'].'; ';
			
			
			$cond_delete = '';
			if (isset($_POST['libelle_fr_modalite'])) {
				if (count($_POST['libelle_fr_modalite']) > 0) {
					$cond_delete = '';
					for ($numero = 0; $numero < count($_POST['libelle_fr_modalite']); $numero++) {
						if (($_POST['id_modalite'])[$numero] != null && ($_POST['id_modalite'])[$numero] != '') {
							if ($cond_delete == '') {
								$cond_delete .= '('.($_POST['id_modalite'])[$numero];
							}
							else {
								$cond_delete .= ', '.($_POST['id_modalite'])[$numero];
							}
						}
					}
					if ($cond_delete != '') {
						$cond_delete .= ')';
					}
				}

				$sql .= '
					DELETE FROM inventepia_modalite_caracteristique
					WHERE
						id_caracteristique=' . $_POST['id_caracteristique'];
						
				if ($cond_delete != '') {
					$sql .= '
						AND id_modalite NOT IN '.$cond_delete;
				}
				$sql .= ';';

				if (isset($_POST['id_modalite'])) {
					$id_modalite = $_POST['id_modalite'];
					for ($numero = 0; $numero < count($id_modalite); $numero++) {
						if ($id_modalite[$numero] != null && $id_modalite[$numero] != '') {
							$sql .= '
								UPDATE inventepia_modalite_caracteristique SET
									id_caracteristique=' . $_POST['id_caracteristique'] . ',
									libelle_fr="' . ($_POST['libelle_fr_modalite'])[$numero] . '",
									libelle_en="' . ($_POST['libelle_en_modalite'])[$numero] . '"
								WHERE id_modalite='.$id_modalite[$numero].';';
						}
						else {
							$sql .= '
								INSERT INTO inventepia_modalite_caracteristique SET
									id_caracteristique=' . $_POST['id_caracteristique'] . ',
									libelle_fr="' . ($_POST['libelle_fr_modalite'])[$numero] . '",
									libelle_en="' . ($_POST['libelle_en_modalite'])[$numero] . '";';
						}
					}
				}
			}
			$sql .= gen_sql_mark_mouchard("Modification d'une caractéristique", "Modifying a caracteristic", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_caracteristique() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_caracteristique WHERE id_caracteristique=' . $_POST['id_caracteristique'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'une caractéristique", "Deleting a caracteristic", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}

function ajoute_type_bien(){
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_type_bien SET
					id_categorie_bien=' . $_POST['id_categorie_bien'] . ',
					libelle_fr="' . $_POST['libelle_fr'] . '",
					libelle_en="' . $_POST['libelle_en'] . '",
					quantifiable=' . $_POST['quantifiable'] . ',
					perissable=' . $_POST['perissable'] . ',
					attribuable=' . $_POST['attribuable'] . '; ';

			if (isset($_POST['id_caracteristiques_type_bien'])) {
				$id_caracteristiques_type_bien = $_POST['id_caracteristiques_type_bien'];
				$sql .= 'SET @new_id_type_bien = LAST_INSERT_ID();';
				for ($numero = 0; $numero < count($id_caracteristiques_type_bien); $numero++) {
					$sql .= '
						INSERT INTO inventepia_caracteristique_type_bien SET
							id_type_bien=@new_id_type_bien,
							id_caracteristique=' . $id_caracteristiques_type_bien[$numero] . '; ';
				}
			}
			$sql .= gen_sql_mark_mouchard("Ajout d'un type de bien", "Add a property type", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}

function modifie_type_bien() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql ='
				UPDATE inventepia_type_bien SET
					id_categorie_bien=' . $_POST['id_categorie_bien'] . ',
					libelle_fr="' . $_POST['libelle_fr'] . '",
					libelle_en="' . $_POST['libelle_en'] . '",
					quantifiable=' . $_POST['quantifiable'] . ',
					perissable=' . $_POST['perissable'] . ',
					attribuable=' . $_POST['attribuable'] . '
				WHERE id_type_bien=' . $_POST['id_type_bien'] . '; ';
			
			$cond_delete = '';
			if (count($_POST['id_caracteristiques_type_bien']) > 0) {
				$cond_delete = '';
				for ($numero = 0; $numero < count($_POST['id_caracteristiques_type_bien']); $numero++) {
					if (($_POST['id_caracteristiques_type_bien'])[$numero] != null && ($_POST['id_caracteristiques_type_bien'])[$numero] != '') {
						if ($cond_delete == '') {
							$cond_delete .= '('.($_POST['id_caracteristiques_type_bien'])[$numero];
						}
						else {
							$cond_delete .= ', '.($_POST['id_caracteristiques_type_bien'])[$numero];
						}
					}
				}
				if ($cond_delete != '') {
					$cond_delete .= ')';
				}
			}

			$sql .= '
				DELETE FROM inventepia_caracteristique_type_bien
				WHERE
					id_type_bien=' . $_POST['id_type_bien'];
					
			if ($cond_delete != '') {
				$sql .= '
					AND id_caracteristique NOT IN '.$cond_delete;
			}
			$sql .= ';';

			if (isset($_POST['id_caracteristiques_type_bien'])) {
				$id_caracteristiques_type_bien = $_POST['id_caracteristiques_type_bien'];
				for ($numero = 0; $numero < count($id_caracteristiques_type_bien); $numero++) {
					$sql .= '
						INSERT INTO inventepia_caracteristique_type_bien SET
							id_type_bien=' . $_POST['id_type_bien'] . ',
							id_caracteristique=' . $id_caracteristiques_type_bien[$numero] . '
						ON DUPLICATE KEY UPDATE
							id_type_bien=' . $_POST['id_type_bien'] . ',
							id_caracteristique=' . $id_caracteristiques_type_bien[$numero] . ';';
				}
			}
			$sql .= gen_sql_mark_mouchard("Modification d'un type de bien", "Modifying a property type", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_type_bien(){
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_type_bien WHERE type_bien=' . $_POST['type_bien'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'un type de bien", "Deleting a property type", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function ajoute_utilisateur() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'INSERT INTO inventepia_utilisateur SET
					id_utilisateur=(SELECT MAX(id_utilisateur)+1 FROM inventepia_utilisateur AS new_id_utilisateur),
					username_utilisateur="'.$_POST['username'] . '",
					nom_prenom_utilisateur="'.$_POST['nom_prenom'] . '",
					id_type_utilisateur='.$_POST['id_type_utilisateur'].',
					email_utilisateur="'.$_POST['email'] . '",
					pass_utilisateur=SHA2("' . $_POST['pass'] . '", 256); ';
			$sql .= gen_sql_mark_mouchard("Ajout d'un utilisateur", "Adding a user", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_utilisateur() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_utilisateur SET
					username_utilisateur="' . $_POST['username'] . '",
					nom_prenom_utilisateur="' . $_POST['nom_prenom'] . '",
					email_utilisateur="' . $_POST['email'] . '",
					id_type_utilisateur=' . $_POST['id_type_utilisateur'].'
				WHERE id_utilisateur=' . $_POST['id_utilisateur'].'; ';
			$sql .= 'DELETE FROM inventepia_utilisateur_profil WHERE id_utilisateur=' . $_POST['id_utilisateur'] . '; ';
			if (isset($_POST['id_profils_utilisateur'])) {
				$id_profils_utilisateur = $_POST['id_profils_utilisateur'];
				for ($numero = 0; $numero < count($id_profils_utilisateur); $numero++) {
					$sql .= 'INSERT INTO inventepia_utilisateur_profil SET id_utilisateur=' . $_POST['id_utilisateur'] . ', id_profil="' . $id_profils_utilisateur[$numero] . '"; ';
				}
			}
			$sql .= gen_sql_mark_mouchard("Modification d'un utilisateur", "Modifying a user", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_utilisateur() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_utilisateur WHERE id_utilisateur=' . $_POST['id_utilisateur'];
			$sql .= gen_sql_mark_mouchard("Suppression d'un utilisateur", "Deleting a user", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function reinit_pass_utilisateur() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_utilisateur SET
					pass_utilisateur=SHA2("' . $_POST['pass'] . '", 256)
				WHERE id_utilisateur=' . $_POST['id_utilisateur'].'; ';
			$sql .= gen_sql_mark_mouchard("Reinitialisation du mot de passe d'un utilisateur", "Resetting a user's password", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function change_pass_utilisateur() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			if ($_POST['new_pass1'] != $_POST['new_pass2']) {
				return "Les deux saisies du nouveau mot de passe sont différentes";
			}
			else {
				$result = read_data_table('inventepia_utilisateur', '*', 'id_utilisateur="' . $_SESSION["id_utilisateur"] . '" AND pass_utilisateur=SHA2("' . $_POST["old_pass"] . '", 256)');
				if ($result->fetchColumn() >= 1) {
					$sql =
						'UPDATE inventepia_utilisateur SET
							pass_utilisateur=SHA2("' . $_POST['new_pass1'] . '", 256)
						WHERE id_utilisateur="' . $_POST['id_utilisateur'] . '"; ';
					$sql .= gen_sql_mark_mouchard("Changement du mot de passe", "Password change", "", "");
					$bdd->exec($sql);
					$bdd->commit();
					return '1';
				} else {
					return 'Ancien mot de passe incorrect';
				}
			}
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function ajoute_profil(){
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'SET @new_id_profil = (SELECT MAX(id_profil)+1 FROM inventepia_profil AS new_id_profil); ';
			$sql .=
				'INSERT INTO inventepia_profil SET
					id_profil=@new_id_profil,
					libelle_fr="' . $_POST['libelle_fr_profil'] . '",
					libelle_en="' . $_POST['libelle_en_profil'] . '"; ';
			
			if (isset($_POST['id_droits_profil'])) {
				$id_droits_profil = $_POST['id_droits_profil'];
				for ($numero = 0; $numero < count($id_droits_profil); $numero++) {
					$sql .= 'INSERT INTO inventepia_droit_profil SET id_profil=@new_id_profil, id_droit="' . $id_droits_profil[$numero] . '"; ';
				}
			}
			$sql .= gen_sql_mark_mouchard("Ajout d'un profil", "Adding a profile", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function modifie_profil() {
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql =
				'UPDATE inventepia_profil SET
					libelle_fr="' . $_POST['libelle_fr_profil'] . '",
					libelle_en="' . $_POST['libelle_en_profil'] . '"
				WHERE id_profil=' . $_POST['id_profil'] . '; ';
			$sql .= 'DELETE FROM inventepia_droit_profil WHERE id_profil=' . $_POST['id_profil'] . '; ';
			if (isset($_POST['id_droits_profil'])) {
				$id_droits_profil = $_POST['id_droits_profil'];
				for ($numero = 0; $numero < count($id_droits_profil); $numero++) {
					$sql .= 'INSERT INTO inventepia_droit_profil SET id_profil=' . $_POST['id_profil'] . ', id_droit="' . $id_droits_profil[$numero] . '"; ';
				}
			}
			$sql .= gen_sql_mark_mouchard("Modification d'un profil", "Modifying a profile", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}
function supprime_profil(){
	if (!empty($_POST)) {
		try {
			$bdd = db_connect();
			$bdd->beginTransaction();
			$sql = 'DELETE FROM inventepia_profil WHERE id_profil=' . $_POST['id_profil'].'; ';
			$sql .= gen_sql_mark_mouchard("Suppression d'un profil", "Deleting a profile", "", "");
			$bdd->exec($sql);
			$bdd->commit();
			return '1';
		} catch (Exception $e) {
			$bdd->rollback();
			die('Erreur : ' . $e->getMessage());
		}
	}
}