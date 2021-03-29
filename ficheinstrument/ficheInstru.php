<?php
  include("pdo_oracle.php");
  function Connexion(){
    $login = 'instruments';
    $mdp = 'Esha2ohCheu5eij3';
    $db = 'mysql:host=localhost;dbname=instruments_bd';
    return OuvrirConnexionPDO($db,$login,$mdp);
  }

  function sql($req){
    $conn = Connexion();
    LireDonneesPDO1($conn, $req ,$tab);
    $conn = null;
    return $tab;
  }

function getFiche(){
  $req = 'SELECT MARQUE.MAR_NOM, UTILISATEUR.UTI_NOM,UTILISATEUR.UTI_PRENOM,VILLE.VIL_NOM,
 INS_NOM, INS_DESCRIPTION,INS_PHOTO,UTI_PHOTO,UTI_DESCRIPT,INS_PRIX FROM `INSTRUMENT` as instru
join MARQUE using (MAR_NUMERO)
join VILLE using (VIL_NUMERO)
join UTILISATEUR USING (UTI_NUMERO)
where INS_NUMERO = '.$_REQUEST["id"].'
order by IN_DATE_AJOUT desc';
  $new = sql($req);
    echo($new[0]["MAR_NOM"].'|'.$new[0]["UTI_NOM"].'|'.$new[0]["UTI_PRENOM"].'|'. $new[0]["VIL_NOM"].
        '|'.$new[0]["INS_NOM"] .'|'.utf8_encode($new[0]["INS_DESCRIPTION"]). '|'.$new[0]["INS_PHOTO"].
        '|'.$new[0]["UTI_PHOTO"].'|'.utf8_encode($new[0]["UTI_DESCRIPT"]).'|'.$new[0]["INS_PRIX"]);
}
getFiche();
////
?>
