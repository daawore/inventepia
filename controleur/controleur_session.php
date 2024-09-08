<?php
	function check_logout($mobile) {		
		if (isset($_GET['logout'])) {
			//Marquer dans la BD la déconnexion
			mark_disconnect();
			session_destroy();
			$show_menu = false;
			$show_infos_connect = false;
			$titre = "CONNEXION";
			$contenu = file_get_contents('./vue/vue_connect.php');
			require './vue/vue_gabarit.php';
			exit();
		}
	}
	
	function check_connect($mobile) {
		if (isset($_POST['login'])) {
			if (isset($_POST['username'])) {
				if (!empty($_POST['username']) && !empty($_POST['password'])) {
					$req = read_data_table('inventepia_utilisateur', '*', '(email_utilisateur="'.$_POST['username'].'") AND (pass_utilisateur=SHA2("'.$_POST['password'].'", 256))', null, null);
					if ($row = $req->fetch()) {
						$_SESSION['valid'] = true;
						$_SESSION['timeout'] = time();
						$_SESSION['id_utilisateur'] = $row['id_utilisateur'];
						$_SESSION['username_utilisateur'] = $row['username_utilisateur'];
						$_SESSION['nom_prenom_utilisateur'] = $row['nom_prenom_utilisateur'];
						$_SESSION['email_utilisateur'] = $row['email_utilisateur'];
						$_SESSION['id_type_utilisateur'] = $row['id_type_utilisateur'];
						//Marquer dans la BD la connexion
						mark_connect();
						header('location:index.php');
						exit();
					}
					else {
						$msg = 'Login ou mot de passe incorrect';
						$show_menu = false;
						$show_infos_connect = false;
						$titre = "CONNEXION";
						$contenu = file_get_contents('./vue/vue_connect.php');
						require './vue/vue_gabarit.php';
						exit();
					}
				}
			}
		}
		else {
			if (!isset($_SESSION['email_utilisateur'])) {
				$show_menu = false;
				$show_infos_connect = false;
				$titre = "CONNEXION";
				$contenu = file_get_contents('./vue/vue_connect.php');
				require './vue/vue_gabarit.php';
				exit();
			}
			else {
				$rows = read_data_table('inventepia_utilisateur', '*', 'email_utilisateur="'.$_SESSION['email_utilisateur'].'"', null, null);				
				if ($rows->rowCount() == 0) {
					$show_menu = false;
					$show_infos_connect = false;
					$titre = "CONNEXION";
					$contenu = file_get_contents('./vue/vue_connect.php');
					require './vue/vue_gabarit.php';
					exit();
				}
			}
		}
	}

	function check_connect_android() {
		if (isset($_POST['connect_android'])) {
			if (isset($_POST['username'])) {
				if (!empty($_POST['username']) && !empty($_POST['password'])) {
					$req = read_data_table('inventepia_utilisateur', '*', '(email_utilisateur="'.$_POST['username'].'") AND (pass_utilisateur=SHA2("'.$_POST['password'].'", 256))', null, null);
					if ($row = $req->fetch()) {
						$_SESSION['valid'] = true;
						$_SESSION['timeout'] = time();
						$_SESSION['id_utilisateur'] = $row['id_utilisateur'];
						$_SESSION['username_utilisateur'] = $row['username_utilisateur'];
						$_SESSION['nom_prenom_utilisateur'] = $row['nom_prenom_utilisateur'];
						$_SESSION['email_utilisateur'] = $row['email_utilisateur'];
						$_SESSION['id_type_utilisateur'] = $row['id_type_utilisateur'];
						//Marquer dans la BD la connexion
						mark_connect();
						echo "true";
					}
					else {
						$msg = 'Login ou mot de passe incorrect';
						$show_menu = false;
						$show_infos_connect = false;
						$titre = "CONNEXION";
						$contenu = file_get_contents('./vue/vue_connect.php');
						require './vue/vue_gabarit.php';
						exit();
					}
				}
			}
		}
		else {
			if (!isset($_SESSION['id_utilisateur'])) {
				$show_menu = false;
				$show_infos_connect = false;
				$titre = "CONNEXION";
				$contenu = file_get_contents('./vue/vue_connect.php');
				require './vue/vue_gabarit.php';
				exit();
			}
			else {
				$rows = read_data_table('inventepia_utilisateur', '*', 'email_utilisateur="'.$_SESSION['username_utilisateur'].'"', null, null);				
				if ($rows->rowCount() == 0) {
					$show_menu = false;
					$show_infos_connect = false;
					$titre = "CONNEXION";
					$contenu = file_get_contents('./vue/vue_connect.php');
					require './vue/vue_gabarit.php';
					exit();
				}
			}
		}
	}