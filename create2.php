<?php

include("util_php/pdo_oracle.php");
include("util_php/util_chap11");

$secretkey = "b56ea98n";

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

	$ville = 0;	
	$pseudo = "";
	$numero = 0;
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
	if(!empty($_POST["naissance"])){$naissance = $_POST['naissance'];}  
	if(!empty($_POST["email"])){$email = $_POST['email'];}  
	if(!empty($_POST["password"])){$password = $_POST['password'];}
	if(!empty($_POST["portable"])){$portable = $_POST['portable'];}
	if(!empty($_POST["fixe"])){$fixe = $_POST['fixe'];}      

	$password = $password = hash_hmac('md5',"$password","$secretkey");

	
	//Recupérer l'util numero du dernière utilisateur
	
	$req = "SELECT max(uti_numero) from utilisateur";
	$nb = LireDonneesPDO1($conn,$req,$tab);
	$numero = $tab[0]['uti_numero'];
	$numero += 1;
	

	$req = "INSERT INTO utilisateur (uti_numero,vil_numero,uti_pseudo,uti_nom,uti_prenom,uti_date_naissance,uti_date_inscription, uti_email, uti_mdp, uti_portable, uti_fixe) values ('$numero','$ville','$pseudo','$nom','$prenom','$naissance','$date','$email','$password','$portable','$fixe')";

	$cur=preparerRequetePDO($conn,$req);
	$res=majDonneesPrepareesPDO($cur);
	echo "Succès, l'utilisateur a été bien ajouté à la base de données.";

?>