<nav class="navbar navbar-auto bg-auto fixed-top" style="position:relative;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">inventEPIA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Paramètres
            </a>
            <ul class="dropdown-menu dropdown-menu-auto">
              <li><a class="dropdown-item" href="#" onclick="load_form_unite('add');">Nouvelle unité de mesure</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_unite">Liste des unités de mesure</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" onclick="load_form_lieu_stock('add');">Nouveau lieu de stockage</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_lieu_stock">Liste des lieux de stockage</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" onclick="load_form_personnel('add');">Nouveau personnel</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_personnel">Liste des personnels</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Commandes
            </a>
            <ul class="dropdown-menu dropdown-menu-auto">
              <li><a class="dropdown-item" href="#" onclick="load_form_commande('add');">Nouvelle commande</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_commande">Liste des commandes</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Biens
            </a>
            <ul class="dropdown-menu dropdown-menu-auto">
              <li><a class="dropdown-item" href="#" onclick="load_form_bien('add');">Nouveau bien</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_bien">Liste des biens</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" onclick="load_form_caracteristique('add');">Nouvelle caractéristique</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_caracteristique">Liste des caractéristiques</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" onclick="load_form_type_bien('add');">Nouveau type de bien</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_type_bien">Liste des types de biens</a></li>
            </ul>
          </li><li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Accès
            </a>
            <ul class="dropdown-menu dropdown-menu-auto">
              <li><a class="dropdown-item" href="#" onclick="load_form_utilisateur('add');">Nouvel utilisateur</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_utilisateur">Liste des utilisateurs</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" onclick="load_form_utilisateur('change_pass', null);">Modification du mot de passe</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#" onclick="load_form_profil('add');">Nouveau profil</a></li>
              <li><a class="dropdown-item" href="index.php?page=find_profil">Liste des profils</a></li>
            </ul>
          </li>
        </ul>
        <!-- <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </div>
</nav>