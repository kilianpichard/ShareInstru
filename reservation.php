<?php

include("util_php/pdo_oracle.php");
include("util_php/util_chap11");

$user="instruments";
$mdp="Esha2ohCheu5eij3";
$instance = "mysql:host=localhost;dbname=instruments_bd";
	$conn = OuvrirConnexionPDO($instance,$user,$mdp);
	if ($conn)
		echo ("<hr/> Connexion réussie à la base de données <br/>");
	else
		echo ("<hr/> Connexion impossible à la base de données <br/>");



	date_default_timezone_set('Europe/Paris');
	$date = date("Y-m-d H-i-s");

	if(!empty($_POST["pseudo"])){$pseudo = $_POST['pseudo'];}  
	if(!empty($_POST["nom"])){$nom = $_POST['nom'];}
	if(!empty($_POST["prenom"])){$prenom = $_POST['prenom'];} 

?>