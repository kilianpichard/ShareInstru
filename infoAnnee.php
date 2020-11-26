<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tour de France</title>
</head>
<body onload="initView()">
  <div>
           <span>
              <select name="annee" id="annee" onchange="affichage()">
                <option> </option>
                    <?php require 'infoAnneeBDD.php';
                    remplirOption(getAnnee()); ?>
                </select>
                <button onclick="classementDisplay(true)" id="cButton">Classement</button>
                <button onclick="etapesDisplay(true)" id="eButton">Etapes</button>
                <button onclick="participantsDisplay(true)" id="pButton">Participants</button>
                <button onclick="abandonsDisplay(true)" id="aButton">Abandons</button>
        </span>
    <div id="result">
      <div id="classement">
        <table border="1">
          <thead>
          <tr>
            <th>Rang</th>
            <th>n° Dossard</th>
            <th>Courreur</th>
            <th>Nationalité</th>
            <th>Temps Total</th>
          </tr>
          </thead>
          <tbody id="tabclass">
          </tbody>
        </table>
        </table>
      </div>
      <div id="etape">
        <table border="1">
          <thead>
          <tr>
            <th>Étape</th>
            <th>Catégorie</th>
            <th>Ville de Départ</th>
            <th>Ville d'arrivée</th>
            <th>Vainceur</th>
            <th>Date</th>
          </tr>
          </thead>
          <tbody id="table">
          </tbody>
        </table>
      </div>
      <div id="participants">
        <table border="1">
          <thead>
          <tr>
            <th>N° Dossard</th>
            <th>Coureur</th>
            <th>Sponsor</th>
            <th>Nationalité</th>
          </tr>
          </thead>
          <tbody id="tabParticipants">
          </tbody>
        </table>
        </table></div>
      <div id="abandons">
        <table border="1">
          <thead>
          <tr>
            <th>Etape</th>
            <th>N° Dossard</th>
            <th>Coureur</th>
            <th>Raison de l'abandon</th>
            <th>Commentaire</th>
          </tr>
          </thead>
          <tbody id="tabAbandons">
          </tbody>
        </table>
        </table>
      </div>
    </div>
  </div>
</body>
</html>

<script src="infoAnnee.js"></script>
<script>
  function affichage() {
    // Creation du classement général
    if (<?php echo json_encode(getClassement()); ?> !=null)
    {
      var tab = document.getElementById('tabclass');

      //Récuperation du classement de toutes les années + filtre en fonction de l'année choisie
      var classementAnneeChoisie = JSON.parse(<?php echo json_encode(getClassement()); ?>).filter(classement => classement.ANNEE == document.getElementById('annee').value );
      tab.innerText = ""

      //Creation d'une ligne pour chaque coureur du classement
      classementAnneeChoisie.forEach((classement, index) => {
        var row = document.createElement('tr');
        var rang = document.createElement('td');
        var ndossard = document.createElement('td');
        var coureur = document.createElement('td');
        var nat = document.createElement('td');
        var temps = document.createElement('td');

        rang.innerText = index + 1;
        ndossard.innerText = classement.N_DOSSARD;
        coureur.innerText = classement.NOM + ' ' + classement.PRENOM;
        nat.innerText = classement.NATIONALITE;
        temps.innerText = formatTemps(classement.TEMPS_TOTAL);

        row.appendChild(rang);
        row.appendChild(ndossard);
        row.appendChild(coureur);
        row.appendChild(nat)
        row.appendChild(temps);
        tab.appendChild(row);
      });
    }
    // Creation des étapes
    if (<?php echo json_encode(getEtapes()); ?> !=null)
    {
      var tab = document.getElementById('table');
      //Récuperation des étapes de toutes les années + filtre en fonction de l'année choisie
      var etapeAnnee = JSON.parse(<?php echo json_encode(getEtapes()); ?>).filter(etape => etape.ANNEE == document.getElementById('annee').value);
      tab.innerText = "";
      var buffer;

      //Creation d'une ligne pour chaque étape
      etapeAnnee.forEach((etape, index) => {
        var row = document.createElement('tr');
        var n_etape = document.createElement('td');
        var vd = document.createElement('td');
        var va = document.createElement('td');
        var vainceur = document.createElement('td');
        var cat = document.createElement('td');
        var date = document.createElement('td');

        //Si les étapes sont en contre la montre par equipe, une ligne pour chaque coureur or on veux l'equipe,
        // donc if pour avoir qu'une seule ligne et l'équipe vainceur
        if (buffer != etape.ETAPE) {
          cat.innerText = etape.CAT_CODE;
          buffer = etape.ETAPE;
          n_etape.innerText = etape.ETAPE;
          vd.innerText = etape.VILLE_D;
          va.innerText = etape.VILLE_A;
          date.innerText = etape.DATETAPE;
          //Si contre la montre equipe, affichage de l'équipe vainceur,
          // sinon du coureur gagnant
          if (etape.CAT_CODE == "CME") {
            vainceur.innerText = "Equipe : " + etape.SPONSOR;
          } else {
            vainceur.innerText = etape.COUREUR;
          }

          row.appendChild(n_etape);
          row.appendChild(cat);
          row.appendChild(vd);
          row.appendChild(va);
          row.appendChild(vainceur);
          row.appendChild(date);
          tab.appendChild(row);
        }
      });
    }
    // Creation des partitipants
    if (<?php echo json_encode(getParticipants()); ?> !=null)
    {
      //Récuperation des participants de toutes les années + filtre en fonction de l'année choisie
      var participantsAnnee = JSON.parse(<?php echo json_encode(getParticipants()); ?>).filter(participant => participant.ANNEE == document.getElementById('annee').value);
      var tab = document.getElementById('tabParticipants');
      tab.innerText = "";
      //Creation d'une ligne dans le tableau pour chaque participant
      participantsAnnee.forEach((participant) => {
        var row = document.createElement('tr');
        var dossard = document.createElement('td');
        var coureur = document.createElement('td');
        var sponsor = document.createElement('td');
        var nat = document.createElement('td');

        dossard.innerText = participant.N_DOSSARD;
        coureur.innerText = participant.COUREUR;
        sponsor.innerText = participant.SPONSOR;
        nat.innerText = participant.NATIONALITE;

        row.appendChild(dossard);
        row.appendChild(coureur);
        row.appendChild(sponsor);
        row.appendChild(nat);
        tab.appendChild(row);
      });
    }
    // Creations des abandons
    if (<?php echo json_encode(getAbandons()); ?> !=null)
    {
      //Récuperation des abandons de toutes les années + filtre en fonction de l'année choisie
      var abandonAnnee = JSON.parse(<?php echo json_encode(getAbandons()); ?>).filter(abandon => abandon.ANNEE == document.getElementById('annee').value);
      var tab = document.getElementById('tabAbandons');
      tab.innerText = "";
      //Creation d'une ligne pour chaque coureur ayant abandonné
      abandonAnnee.forEach((abandon) => {
        var row = document.createElement('tr');
        var dossard = document.createElement('td');
        var coureur = document.createElement('td');
        var raison = document.createElement('td');
        var commentaire = document.createElement('td');
        var etape = document.createElement('td');

        dossard.innerText = abandon.N_DOSSARD;
        coureur.innerText = abandon.COUREUR;
        raison.innerText = abandon.LIBELLE;
        commentaire.innerText = abandon.COMMENTAIRE;
        etape.innerText = abandon.ETAPE;

        row.appendChild(etape);
        row.appendChild(dossard);
        row.appendChild(coureur);
        row.appendChild(raison);
        row.appendChild(commentaire);
        tab.appendChild(row);
      });

      //Si aucun onglet n'est déjà séléctionné
      if (!document.getElementById('pButton').disabled == true && !document.getElementById('cButton').disabled == true
        && !document.getElementById('eButton').disabled == true && !document.getElementById('aButton').disabled == true) {
        classementDisplay(true);
      }

    }
  }
</script>
