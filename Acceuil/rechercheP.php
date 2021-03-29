<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script crossorigin="anonymous" src="https://kit.fontawesome.com/b320a9314d.js"></script>
  <title>Recherche</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
  <script src="js/recherche.js"></script>
  <link href="css/recherche.css" rel="stylesheet">
</head>
<body>
  <nav>
      <img class="logo" src="assets/logoB.png">
      <div class="links">
        <a class="nav" href="accueil.php">
         ACCUEIL
        </a>
        <a class="nav" href="annonces.php">
         ANNONCES
        </a>
        <a class="nav" href="fonctionnement.php">
          FONCTIONNEMENT
        </a>
      </div>
      <?php
      session_start();
      include("header.php");
      ?>
  </nav>
  <!-- SELECTEUR RECHERCHE -->
  <div class="content">

    <!-- NOUVELLES ANNONCES -->
    <h1>Recherche</h1>
    <div class="selector" id="title" style="display: none">
      <h3>Annonces dans la catégorie </h3>
      <select id="cat" onchange="selectChange()"></select>
    </div>

    <div class="new">
      <p id="load">chargement...</p>
      <p id="none" style="display: none">Aucun résultat pour cette recherche</p>

      <div class="flex" id="search" style="display: none">
        <div class="card" id="1">
          <div class="spacerFlex">
            <div class="user">
              <img class="avatarAnnonce">
              <span></span>
          </div>
          <div class="flexRow locDiv">
            <p></p>
            <img class="loc" src="assets/icon-localisation.png">
          </div>
        </div>


        <div class="flexRow">
          <div class="flex">
            <div class="preview">
              <img src="" class="instru">
            </div>
            <div class="flexRow instrument">
              <h3></h3>
              <h3> - </h3>
              <h3></h3>
            </div>
          </div>
          <div class="spacer"></div>
          <div class="info"></div>
        </div>
      </div>
        <div id="other"></div>
    </div>
  </div>
  </div>
  <!-- CATEGORIES -->
</body>
</html>
