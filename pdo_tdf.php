<?php

include ("../Index/Ressources/pdo_oracle.php");

function Connexion(){
  $login = 'PPHP2A_05';
  $mdp = 'projtdf';

  $db = 'oci:dbname=kiutoracle18.unicaen.fr:1521/info.kiutoracle18.unicaen.fr;charset=AL32UTF8';
  return OuvrirConnexionPDO($db,$login,$mdp);
}
function sql($req){
  $conn = Connexion();
  LireDonneesPDO1($conn, $req ,$tab);
  $conn = null;
  return $tab;
}

?>
