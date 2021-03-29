<?php

  include("pdo_oracle.php");

  function Connexion(){
    $login = 'instruments';
    $mdp = 'Esha2ohCheu5eij3';
    $db = 'mysql:host=localhost;dbname=instruments_bd';
    return OuvrirConnexionPDO($db,$login,$mdp);
  }

  get();

  function sql($req){
    $conn = Connexion();
    LireDonneesPDO1($conn, $req ,$tab);
    $conn = null;
    return $tab;
  }

function get(){
  $req = 'SELECT MARQUE.MAR_NOM, UTILISATEUR.UTI_NOM,UTILISATEUR.UTI_PRENOM,VILLE.VIL_NOM,VILLE.VIL_CP, INS_NOM, INS_DESCRIPTION,INS_PHOTO,UTI_PHOTO,CAT_FAMILLE,INS_NUMERO FROM `INSTRUMENT` as instru
  join MARQUE using (MAR_NUMERO)
  join VILLE using (VIL_NUMERO)
  join UTILISATEUR USING (UTI_NUMERO)
  join CATEGORIE using (CAT_NUMERO)
  ORDER BY IN_DATE_AJOUT desc';
  send($req);
}

  function send($req){
    $new = sql($req);
    for ($i=0;$i<sizeof($new);$i++) {
      echo(utf8_encode($new[$i]["MAR_NOM"] . '|' . $new[$i]["UTI_NOM"] . '|' . $new[$i]["UTI_PRENOM"] . '|' . $new[$i]["VIL_NOM"] . '|' . $new[$i]["INS_NOM"]
        . '|' . $new[$i]["INS_DESCRIPTION"] . '|' . $new[$i]["INS_PHOTO"] . '|' . $new[$i]["UTI_PHOTO"] . '|' . $new[$i]["CAT_FAMILLE"] . '|' . $new[$i]["VIL_CP"] .'|'.$new[$i]["INS_NUMERO"].'//||//'));
    }
  }
?>
