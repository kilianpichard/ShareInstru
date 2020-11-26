<?php
include("../util_php/pdo_oracle.php");

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
  $req = 'SELECT cat_nom FROM `categorie` order by cat_nom';
  $cat = sql($req);
  for ($i=0;$i<sizeof($cat);$i++)
  {
    if($i == sizeof($cat)-1){
      echo utf8_encode($cat[$i]['cat_nom']);
    }else{
      echo utf8_encode($cat[$i]['cat_nom']).',';
    }
  }
function getCat(){
  $req = 'SELECT cat_nom FROM `categorie` order by cat_nom';
  $cat = (sql($req));
  echo("ok");
  return $cat;
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
