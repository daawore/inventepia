<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" data-bs-theme="auto">
<!--  -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js" integrity="sha512-2/YdOMV+YNpanLCF5MdQwaoFRVbTmrJ4u4EpqS/USXAQNUDgI5uwYi6J98WVtJKcfe1AbgerygzDFToxAlOGEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

		<link rel="stylesheet" type="text/css" href="contenu/css/style.css" />
		<link rel="stylesheet" type="text/css" href="contenu/css/style_menu.css" />

        <link rel="icon" type="image/png" sizes="16x16" href="contenu/img/logo_16x16.png">
        
		<script type='text/javascript' src="contenu/js/script.js"></script>
        <script type='text/javascript' src="vue/unite/unite.js"></script>
        <script type='text/javascript' src="vue/lieu_stock/lieu_stock.js"></script>
        <script type='text/javascript' src="vue/commande/commande.js"></script>
        <script type='text/javascript' src="vue/bien/bien.js"></script>
        <script type='text/javascript' src="vue/bien/caracteristique.js"></script>
        <script type='text/javascript' src="vue/bien/type_bien.js"></script>
        <script type='text/javascript' src="vue/personnel/personnel.js"></script>
        <script type='text/javascript' src="vue/utilisateur/utilisateur.js"></script>
		<script type='text/javascript' src="vue/utilisateur/profil.js"></script>

        <title><?php echo $titre.' - InventEPIA'; ?></title>
    </head>
    
    <body>
		<div id="liveAlertPlaceholder"></div>
		<div id="loader" class="non_imprimable">
  			<div class="spinner"></div>
		</div>
		<div id="div_menu" class="non_imprimable;" style="position:relative;">
			<?php
				if (!isset($show_menu) || (isset($show_menu) && $show_menu==true)) {
					include './vue/vue_menu.php';
				}
			?>
		</div>
		<div id="div_msg" class="non_imprimable" style="position:relative; display:block;">
			<?php
				if (isset($msg)) {
					echo '<p style="color:red;">'.$msg.'</p>';
				}
			?>
		</div>
		<div id="div_infos_connect" class="non_imprimable" style="position:relative; display:block; text-align:right;">
			<?php
				if (!isset($show_infos_connect) ||(isset($show_infos_connect) && $show_infos_connect==true)) {
					include './vue/vue_simple_infos_connect.php';
				}
			?>
		</div>
		<div id="div_titre" style="position:relative; display:block; text-align:center;">
			<h2><?php echo $titre; ?></h2>
		</div>
		<dialog id="my_load_dialog"></dialog>
		<div id="div_contenu" style="position:relative; display:block;">
			<?php
				if (isset($contenu)) {
					echo $contenu;
				}
				else if (isset($file_to_load)) {
					require $file_to_load;
				}
				else {
					require 'vue/vue_accueil.php';
				}
			?>
		</div>
		<div class="modal fade" id="id-modal-form" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
			<!-- Contenu chargé dynamiquement pour les fenêtre modale -->
		</div>
		<dialog id="liveAlertPlaceholder_modal">
		</dialog>
    </body>
</html>
<script type="text/javascript">
	
</script>