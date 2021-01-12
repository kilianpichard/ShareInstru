<?php

include("util_php/pdo_oracle.php");
include("util_php/util_chap11");

//Clé secrete pour chiffre le mot de passe
$secretkey = "b56ea98n";

//Connexion a la BDD
$user="instruments";
$mdp="Esha2ohCheu5eij3";
$instance = "mysql:host=localhost;dbname=instruments_bd";
	$conn = OuvrirConnexionPDO($instance,$user,$mdp);
	if ($conn)
		echo ("<hr/> Connexion réussie à la base de données <br/>");
	else
		echo ("<hr/> Connexion impossible à la base de données <br/>");


	//Récupération date du jour
	date_default_timezone_set('Europe/Paris');
	$date = date("Y-m-d");
	echo $date;

	$ville = 5;	
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
	
	$req = "SELECT max(uti_numero)+1 as max from UTILISATEUR";
	$nb = LireDonneesPDO1($conn,$req,$tab);

	
	echo "<br>";
	$numero = $tab[0]['max'];
	echo "<br>";
	

	//Affichage pour vérifier les données que l'on a rentré
	echo "num :".$numero;echo "<br>";
	echo "ville :".$ville;echo "<br>";
	echo "pseudo :".$pseudo;echo "<br>";
	echo "nom :".$nom;echo "<br>";
	echo "prenom :".$prenom;echo "<br>";
	echo "inscription :".$date;echo "<br>";
	echo "naissance :".$naissance;echo "<br>";
	echo "protable :".$portable;echo "<br>";
	echo "fixe :".$fixe;echo "<br>";
	

	$req = "INSERT INTO UTILISATEUR(uti_numero,vil_numero,uti_pseudo,uti_nom,uti_prenom,uti_date_naissance,uti_date_inscription, uti_email, uti_mdp, uti_portable, uti_tel_fixe) values ('$numero','$ville','$pseudo','$nom','$prenom','$naissance','$date','$email','$password','$portable','$fixe')";

	$cur=preparerRequetePDO($conn,$req);
	$res=majDonneesPrepareesPDO($cur);
	echo "Succès, l'utilisateur a été bien ajouté à la base de données.";

?>