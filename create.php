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


	$timezone = date_default_timezone_get();
	echo "The current server timezone is: " . $timezone;


	if(!empty($_POST["pseudo"])){$pseudo = $_POST['pseudo'];}  
	if(!empty($_POST["nom"])){$nom = $_POST['nom'];}
	if(!empty($_POST["prenom"])){$prenom = $_POST['prenom'];}  
	if(!empty($_POST["naissance"])){$nom = $_POST['naissance'];}  
	if(!empty($_POST["email"])){$email = $_POST['email'];}  
	if(!empty($_POST["password"])){$password = $_POST['password'];}
	if(!empty($_POST["portable"])){$portable = $_POST['portable'];}
	if(!empty($_POST["fixe"])){$fixe = $_POST['fixe'];}      




?>