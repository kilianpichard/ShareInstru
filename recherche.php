<?php
include("pdo_oracle.php");
  function Connexion(){
    $login = 'instruments';
    $mdp = 'Esha2ohCheu5eij3';

    $db = 'mysql:host=localhost;dbname=instruments_bd';
    return OuvrirConnexionPDO($db,$login,$mdp);
  }

  if($_REQUEST["function"]=="cuivres"){
    getCuivre();
  }else if($_REQUEST["function"]=="new"){
    getNew();
  }

  function sql($req){
    $conn = Connexion();
    LireDonneesPDO1($conn, $req ,$tab);
    $conn = null;
    return $tab;
  }

function getCuivre(){
  $req = 'SELECT MARQUE.MAR_NOM, UTILISATEUR.UTI_NOM,UTILISATEUR.UTI_PRENOM,VILLE.VIL_NOM, INS_NOM, INS_DESCRIPTION,INS_PHOTO,UTI_PHOTO FROM `INSTRUMENT` as instru
join MARQUE using (MAR_NUMERO)
join VILLE using (VIL_NUMERO)
join UTILISATEUR USING (UTI_NUMERO)
join CATEGORIE using (CAT_NUMERO)';
  $new = sql($req);
  for ($i=0;$i<sizeof($new);$i++){
    echo($new[$i]["MAR_NOM"].'|'.$new[$i]["UTI_NOM"].'|'.$new[$i]["UTI_PRENOM"].'|'.$new[$i]["VIL_NOM"].'|'.$new[$i]["INS_NOM"]
      .'|'.utf8_encode($new[$i]["INS_DESCRIPTION"]).'|'.$new[$i]["INS_PHOTO"].'|'.$new[$i]["UTI_PHOTO"].'/////');
  }

}

function remplirOption($tab)
{
  for ($i=0;$i<sizeof($tab);$i++)
  {
    echo '<option value="'.utf8_encode($tab[$i]["cat_nom"]).'">'.utf8_encode($tab[$i]['cat_nom']);
    echo '</option>';
  }
}
?>
