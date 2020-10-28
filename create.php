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
	$date = date("Y-m-d");
	echo $date;


	$pseudo = "";
	$nom = "";
	$prenom = "";
	$naissance = "";
	$email = "";
	$password = "";
	$portable = "";
	$fixe = "";



	if(!empty($_POST["pseudo"])){$pseudo = $_POST['pseudo'];}  
	if(!empty($_POST["nom"])){$nom = $_POST['nom'];}
	if(!empty($_POST["prenom"])){$prenom = $_POST['prenom'];}  
	if(!empty($_POST["naissance"])){$nom = $_POST['naissance'];}  
	if(!empty($_POST["email"])){$email = $_POST['email'];}  
	if(!empty($_POST["password"])){$password = $_POST['password'];}
	if(!empty($_POST["portable"])){$portable = $_POST['portable'];}
	if(!empty($_POST["fixe"])){$fixe = $_POST['fixe'];}      


	$req = "INSERT INTO utilisateur (util_pseudo, util_nom, util_prenom, util_date_naissance, util_date_inscription, util_email, util_mdp, util_portable, util_fixe) values ('$pseudo','$nom','$prenom','$naissance','$date','$email','$password','$portable','$fixe')";

	$cur=preparerRequetePDO($conn,$req);
	$res=majDonneesPrepareesPDO($cur);
	echo "Succès, l'utilisateur a été bien ajouté à la base de données.";

?>