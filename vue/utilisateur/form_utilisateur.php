<script type='text/javascript' src="./vue/utilisateur/utilisateur.js"></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="id-form-modal-title">
                <!-- Titre du formulaire -->
                <?php echo $titre_dialog; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="utilisateur_form" name="utilisateur_form" method="POST" onsubmit="return false;">
            <div class="modal-body" id="id-form-modal-body">
                <!-- Corps du formulaire -->
                <input type="hidden" name="id_utilisateur" id="id_utilisateur" >
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Nom d'utilisateur" id="username" name="username" type="text" required="required" />
                    <label for="username">Nom d'utilisateur</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="Nom et prénom" id="nom_prenom" name="nom_prenom" type="text" required="required" />
                    <label for="nom_prenom">Nom et prénom</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <input class="form-control" placeholder="E-Mail" id="email" name="email" type="text" required="required" />
                    <label for="email">E-Mail</label>
                </div>
                <div class="form-floating form-floating-sm col" style="padding:5px">
                    <select class="form-control" placeholder="Type d'utilisateur" id="id_type_utilisateur" name="id_type_utilisateur" required="required" ></select>
                    <label for="id_type_utilisateur">Type d'utilisateur</label>
                </div>
                <?php
                    if ($_POST['page'] == "form_add_utilisateur" || $_POST['page'] == "form_reinit_pass_utilisateur") {
                ?>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <input class="form-control" placeholder="Mot de passe" id="pass" name="pass" type="password" required="required" />
                        <label for="pass">Mot de passe</label>
                    </div>
                <?php
                    }
                ?>
                <?php
                    if ($_POST['page'] == "form_change_pass_utilisateur") {
                ?>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <input class="form-control" placeholder="Ancien mot de passe" id="old_pass" name="old_pass" type="password" />
                        <label for="old_pass">Ancien mot de passe</label>
                    </div>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <input class="form-control" placeholder="Nouveau mot de passe" id="new_pass1" name="new_pass1" type="password" />
                        <label for="new_pass1">Nouveau mot de passe</label>
                    </div>
                    <div class="form-floating form-floating-sm col" style="padding:5px">
                        <input class="form-control" placeholder="Nouveau mot de passe (répété)" id="new_pass2" name="new_pass2" type="password" />
                        <label for="new_pass2">Nouveau mot de passe (répété)</label>
                    </div>
                <?php
                    }
                ?>
                <div id="div_profils" style="padding:5px">
                    <table style="width:100%; margin: 0 auto;">
                        <tr>
                            <td>
                                <div class="mb-3" style="padding:5px">
                                    <label for="select_profils_dispo">Profils disponibles</label>
                                    <select class="form-select" multiple aria-label="Multiple select example" placeholder="Profils disponibles" id="select_profils_dispo" name="select_profils_dispo">
                                        <option selected>Open this select menu</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-floating form-floating-sm" style="padding:5px; text-align:center; vertical-align: middle;">
                                    <button type="button" class="btn btn-primary" onclick="add_select_profil_for_form_utilisateur();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-right rech-fa'></i></button>
                                    <button type="button" class="btn btn-danger" onclick="remove_select_profil_for_form_utilisateur();" style="padding:5px; display:block; text-align:center; vertical-align:middle;"><i class='fa-solid fa-arrow-left rech-fa'></i></button>
                                </div>
                            </td>
                            <td>
                                <div class="mb-3" style="padding:5px">
                                    <label for="select_profils_utilisateur">Profils de l'utilisateur</label>
                                    <select class="form-select" multiple aria-label="Multiple select example" placeholder="Profils de l'utilisateur" id="select_profils_utilisateur" name="select_profils_utilisateur">
                                        <option selected>Open this select menu</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer" id="id-form-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="action" id="action">
                <input class="btn btn-primary" type="button" name="add_btn" id="add_btn" value="Ajouter" onclick="save_utilisateur();"  hidden="true"/>
                <input class="btn btn-primary" type="button" name="modif_btn" id="modif_btn" value="Modifier" onclick="save_utilisateur();" hidden="true" />
                <input class="btn btn-danger" type="button" name="del_btn" id="del_btn" value="Supprimer" onclick="save_utilisateur();" hidden="true"/>
                <input class="btn btn-primary" type="button" name="reinit_pass_btn" id="reinit_pass_btn" value="Reinitialiser le pass" onclick="save_utilisateur();" hidden="true"/>
                <input class="btn btn-primary" type="button" name="change_pass_btn" id="change_pass_btn" value="Changer le pass" onclick="save_utilisateur();" hidden="true"/>
            </div>
        </form>
    </div>
</div>