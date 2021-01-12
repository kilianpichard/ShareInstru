<?php

include("util_php/pdo_oracle.php");
include("util_php/util_chap11");

//Cle secrete pour chiffrer les mot de passes
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


	if(!empty($_POST["pseudo"])){$pseudo = $_POST['pseudo'];} 
	if(!empty($_POST["password"])){$password = $_POST['password'];}  

	//Chiffrage du mot de pase en md5 avec clé secrète
	$password = hash_hmac('md5',"$password","$secretkey");


	echo $pseudo;
	echo "<br/>";
	echo $password;

	//Recupération date du jour
	date_default_timezone_set('Europe/Paris');
	$date = date("Y-m-d");
	
	
	//Récupération du log_numero max +1 afin d'en rajouter un (ajouter la date de connexion dans la base)
	$req = "SELECT max(log_numero)+1 as max from LOG";
	$nb = LireDonneesPDO1($conn,$req,$tab);
	$numero = $tab[0]['max'];
	
	echo "<br> numero :".$numero;

	//Comparaison du login / mot de passe rentré
	$req = "SELECT uti_numero FROM UTILISATEUR where uti_pseudo = '$pseudo' and uti_mdp = '$password'";
	$nb = LireDonneesPDO1($conn,$req,$tab);
	if($nb == 1){  // On regarde si on a 1 résultat avec les identifiants données
	$n_util = $tab[0]['uti_numero'];
	$log_type = "page-login";	
	
	echo "<br> num utilisateur :".$n_util;

	//Ajout de la connexion dans log
	$req1 = "REPLACE INTO LOG (log_numero,uti_numero, log_date, log_type) values ('$numero','$n_util','$date','$log_type')";
	$cur=preparerRequetePDO($conn,$req1);
	$res=majDonneesPrepareesPDO($cur);
	echo "<br/> connexion réussis";
	}
	else header('Location: https://dev-instruments.users.info.unicaen.fr/login.html');
	


?>