<?php

include("util_php/pdo_oracle.php");
include("util_php/util_chap11");

$user="instruments";
$mdp="Esha2ohCheu5eij3";
$instance = "mysql:host=localhost;dbname=instruments_db";
	$conn = OuvrirConnexionPDO($instance,$user,$mdp);
	if ($conn)
		echo ("<hr/> Connexion réussie à la base de données <br/>");
	else
		echo ("<hr/> Connexion impossible à la base de données <br/>");


?>