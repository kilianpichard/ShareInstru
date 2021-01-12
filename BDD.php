<?php
include("pdo_oracle.php");
  function Connexion(){
    $login = 'instruments';
    $mdp = 'Esha2ohCheu5eij3';
    $db = 'mysql:host=localhost;dbname=instruments_bd';
    return OuvrirConnexionPDO($db,$login,$mdp);
  }
  if($_REQUEST["function"]=="cat"){
    getCat();
  }else if($_REQUEST["function"]=="new"){
    getNew();
  }else if($_REQUEST["function"] == "famille"){
    getFamille();
  }

  function sql($req){
    $conn = Connexion();
    LireDonneesPDO1($conn, $req ,$tab);
    $conn = null;
    return $tab;
  }



function getCat(){
  $req = 'SELECT CAT_NOM FROM `CATEGORIE` order by CAT_NOM';
  $cat = sql($req);
  for ($i=0;$i<sizeof($cat);$i++)
  {
    if($i == sizeof($cat)-1){
      echo utf8_encode($cat[$i]['CAT_NOM']);
    }else{
      echo utf8_encode($cat[$i]['CAT_NOM']).'|';
    }
  }
}
function getFamille(){
  $req = 'SELECT DISTINCT CAT_FAMILLE FROM `CATEGORIE` order by CAT_FAMILLE';
  $cat = sql($req);
  for ($i=0;$i<sizeof($cat);$i++)
  {
    if($i == sizeof($cat)-1){
      echo utf8_encode($cat[$i]['CAT_FAMILLE']);
    }else{
      echo utf8_encode($cat[$i]['CAT_FAMILLE'].'|');
    }
  }
}

function getNew(){
  $req = 'SELECT MARQUE.MAR_NOM, UTILISATEUR.UTI_NOM,UTILISATEUR.UTI_PRENOM,VILLE.VIL_NOM, INS_NOM, INS_DESCRIPTION,INS_PHOTO,UTI_PHOTO FROM `INSTRUMENT` as instru
join MARQUE using (MAR_NUMERO)
join VILLE using (VIL_NUMERO)
join UTILISATEUR USING (UTI_NUMERO)
order by IN_DATE_AJOUT desc';
  $new = sql($req);
  for ($i=0;$i<3;$i++){
    echo($new[$i]["MAR_NOM"].'|'.$new[$i]["UTI_NOM"].'|'.$new[$i]["UTI_PRENOM"].'|'.$new[$i]["VIL_NOM"].'|'.$new[$i]["INS_NOM"]
      .'|'.utf8_encode($new[$i]["INS_DESCRIPTION"]).'|'.$new[$i]["INS_PHOTO"].'|'.$new[$i]["UTI_PHOTO"].'/separation/');
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
