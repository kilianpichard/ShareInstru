<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script crossorigin="anonymous" src="https://kit.fontawesome.com/b320a9314d.js"></script>
  <title>Présentation</title>

  <link rel="stylesheet" href="styleFiche.css">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
</head>
<body>
<nav>
  <img class="logo" src="logoB.png">
  <div class="links">
    <a class="nav" href="../Acceuil/accueil.php">
      ACCUEIL
    </a>
    <a class="nav" href="../Acceuil/annonces.php">
      ANNONCES
    </a>
    <a class="nav" href="../Acceuil/fonctionnement.php">
      FONCTIONNEMENT
    </a>
  </div>
  <?php
      session_start();
      include("../Acceuil/header.php");
      ?>
</nav>
<div class="content">
  <!-- TITRE ET PHOTOS INSTRUMENT -->
    <span class="top">
  <div class="cadre_instrument">
    <div class="name">
      <h1 id="instruName">Marimba (4 Octaves) Bergerault</h1>
    </div>

    <span id="marimba1" class="target"></span>
    <span id="marimba2" class="target"></span>
    <span id="marimba3" class="target"></span>
    <span id="marimba4" class="target"></span>
    <div class="cadre_diapo">
      <div class="interieur_diapo">
        <div class=description>
          <img src="marimba1.jpg" id="img1" alt>
        </div>
        <div class=description>
          <img src="marimba2.jpg" id="img2" alt>
        </div>
        <div class=description>
          <img src="marimba3.jpg" id="img3" alt>
        </div>
        <div class=description>
          <img src="marimba4.jpg" id="img4" alt>
        </div>
      </div>
      <ul class="navigation_diapo">
        <li>
          <a href="#marimba1">
            <img src="marimba1.jpg" id="img1b" alt>
          </a>
        </li>
        <li>
          <a href="#marimba2">
            <img src="marimba2.jpg" id="img2b" alt>
          </a>
        </li>
        <li>
          <a href="#marimba3">
            <img src="marimba3.jpg" id="img3b" alt>
          </a>
        </li>
        <li>
          <a href="#marimba4">
            <img src="marimba4.jpg" id="img4b" alt>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="cadre_reservation">
    <div class="inner_reservation">
      <h1 class="prix"><span class="prixParHeure" id="prix">10 €  </span>/ heure</h1>
      <div class="remplissage">
        <input class="date_reserve" type="date"/>
          <span class="date">
            <div class="start_hour">
              <label for="heure_debut">Début</label>
              <input name="heure_debut" type="time"/>
            </div>
            <div class="end_hour">
              <label for="heure_fin">Fin</label>
              <input name="heure_fin" type="time"/>
            </div>
          </span>
        <hr class="divider">
        <input type="submit" class="reserver" value="Réserver"/>
      </div>
    </div>
  </div></span>
    <div class="divider"></div>
  <!-- DESCRIPTION -->
  <div class="desc">
    <h1>Description</h1>
    <p id="desc">
      Marimba d'étude BERGERAULT PERFORMER MP43, 4 octaves 1/3 La03 à Do49, chassis bois naturel verni, accord 442 HZ,
      lames padouk, largeur lames de 60 à 40 mm, épaisseur des lames 24 mm, longueur 147 cm, largeur bouts : 78 - 37 cm,
      piétement fonte d'alum inium peinture epoxy bronze martelé à roulettes, démontable, hauteur réglable de 84 à 97 cm
      par
      vérin hydraulique, système "easy lift" à gaz.<br/>
    </p>
  </div>
      <div class="divider"></div>
  <!-- PROFIL PROPRIETAIRE -->
  <div class="cadre_owner">
    <h1><a href=""><img class="avatar_prop" src="noah.jpg" id="user"></a> Proposé par <span id="name"></span></h1>
    <p id="userDesc">

    </p>
    <button onclick="lirePlus()" id="lectureSup">Lire plus</button>
  </div>
    <div class="divider"></div>
  <!-- CARTE INTERACTIVE -->
  <div id="googleMap" class="map"></div>
  <!-- Carte temporaire, pour l'instant google maps, mais requiert une clé API payante -->
</div>
<script>
  const queryString = window.location.search;
  let search = queryString.split('?')[1];
  var xhr2 = new XMLHttpRequest();
  xhr2.open('GET', 'ficheInstru.php?id='+search, true);
  var New = function () {
    if (xhr2.readyState === 4 && xhr2.status === 200) {
      let tab = (xhr2.response.split('|'));
      console.log(tab);

      document.getElementById('instruName').innerText = tab[4] + " - "+tab[0];
      document.getElementById('img1').src = tab[6];
      document.getElementById('img1b').src = tab[6];
      document.getElementById('user').src = tab[7];
      document.getElementById('desc').innerText = tab[5];
      document.getElementById('name').innerText = tab[1] + ' ' +tab[2];
      document.getElementById('userDesc').innerText = tab[8];
      document.getElementById('prix').innerText = tab[9];
    }
  };
  xhr2.addEventListener("readystatechange", New, false);
  xhr2.send(null);


  function myMap() {
    var mapProp = {
      center: new google.maps.LatLng(49.14915, -0.35335),
      zoom: 15,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
  }

  function lirePlus() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("lectureSup");

    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Lire plus";
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Lire moins";
      moreText.style.display = "inline";
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBckK-Tj4z1IIEf4fxd-afDwwdev4tpvR0&callback=myMap"
        type="text/javascript"></script>
</body>
</html>