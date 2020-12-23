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


	if(!empty($_POST["pseudo"])){$pseudo = $_POST['pseudo'];} 
	if(!empty($_POST["password"])){$password = $_POST['password'];}  


	$password = hash_hmac('md5',"$password","$secretkey");


	echo $pseudo;
	echo "<br/>";
	echo $password;


	date_default_timezone_set('Europe/Paris');
	$date = date("Y-m-d H-i-s");

	$req = "SELECT util_numero FROM utilisateur where util_pseudo = '$pseudo' and util_mdp = '$password'";
	$nb = LireDonneesPDO1($conn,$req,$tab);

	$n_util = $tab[0]['util_numero'];
	$log_type = "page-login";

	if($nb == 1){ 

	print_r($tab);

	$req1 = "REPLACE INTO Log (log_numero, log_date, log_type) values ('$n_util','$date','$log_type')";
	$cur=preparerRequetePDO($conn,$req1);
	$res=majDonneesPrepareesPDO($cur);
	echo "<br/> connexion réussis";
	}
	else header('Location: https://dev-instruments.users.info.unicaen.fr/login.html');
	


?>