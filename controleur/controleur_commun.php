<?php
	function router_commun($mobile) {
		$result = true;
		if(empty($_GET) && empty($_POST)) {
			$titre = "TABLEAU DE BORD";
			if ($mobile == true) {
				require 'vue/vue_gabarit.php';
			}
			else {
				require 'vue/vue_gabarit.php';
			}
		}
		return $result;
	}