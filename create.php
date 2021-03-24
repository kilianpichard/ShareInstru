<?php

include("util_php/pdo_oracle.php");
include("util_php/util_chap11");


if(isset($_POST['submit'])){
	


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

	$ville = $_POST['ville'];
	
	
	//Verifier si la ville est pas déjà dans la base

	$req = "SELECT vil_numero from VILLE where vil_nom like '$ville'";
	$nb = LireDonneesPDO1($conn,$req,$tab);


	
	if($nb == 0){

	//Recupérer le numero de ville maximum
	$req = "SELECT max(vil_numero)+1 as max from VILLE";
	$nb = LireDonneesPDO1($conn,$req,$tab);
	$numville = $tab[0]['max'];
	
	

	$proxy="http://proxy.unicaen.fr:3128";
    $url = "https://api-adresse.data.gouv.fr/search/?q=".$ville;

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_PROXY, $proxy);
	curl_setopt($curl, CURLOPT_TIMEOUT_MS, 2000);

	$data = curl_exec($curl);
	curl_close($curl);


	//Recupération longitude
	$tmp = explode('"coordinates":',$data)[1];
	$longitude = explode(",",$tmp)[0];
	$longitude = substr($longitude,2);

	echo "<br>longitude :".$longitude;

	//Recupération longitude
	$tmp = explode('"coordinates":',$data)[1];
	$latitude = explode(",",$tmp)[1];
	$latitude = rtrim($latitude,"]}");
	$latitude = substr($latitude,1);

	echo "<br>latitude :".$latitude;

	//Récuperation code postal
	$tmp = explode('"postcode":',$data)[1];
	$tmp = explode(",",$tmp)[0];
	$postal = explode('"',$tmp)[1];
	echo "<br> code postal : ".$postal;
	

	$req = "INSERT INTO VILLE(vil_numero,vil_nom,vil_cp,vil_lattitude,vil_longitude) values ('$numville','$ville','$postal','$latitude','$longitude')";

	$cur=preparerRequetePDO($conn,$req);
	$res=majDonneesPrepareesPDO($cur);
	echo "La ville a bien été ajouté.";

	}



	$pseudo = $_POST['pseudo']; 
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];  
	$naissance = $_POST['naissance'];
	$email = $_POST['email']; 
	$password = $_POST['password'];
	$portable = $_POST['portable'];
	$fixe = $_POST['fixe']; 
	$numero = 0;


	$password = $password = hash_hmac('md5',"$password","$secretkey");

	
	//Recupérer l'util numero du dernière utilisateur
	
	$req = "SELECT max(uti_numero)+1 as max from UTILISATEUR";
	$nb = LireDonneesPDO1($conn,$req,$tab);

	
	echo "<br>";
	$numero = $tab[0]['max'];
	echo "<br>";
	
	echo "num :".$numero;echo "<br>";
	echo "ville :".$numville;echo "<br>";
	echo "pseudo :".$pseudo;echo "<br>";
	echo "nom :".$nom;echo "<br>";
	echo "prenom :".$prenom;echo "<br>";
	echo "inscription :".$date;echo "<br>";
	echo "naissance :".$naissance;echo "<br>";
	echo "protable :".$portable;echo "<br>";
	echo "fixe :".$fixe;echo "<br>";
	

	$req = "INSERT INTO UTILISATEUR(uti_numero,vil_numero,uti_pseudo,uti_nom,uti_prenom,uti_date_naissance,uti_date_inscription, uti_email, uti_mdp, uti_portable, uti_tel_fixe) values ('$numero','$numville','$pseudo','$nom','$prenom','$naissance','$date','$email','$password','$portable','$fixe')";

	$cur=preparerRequetePDO($conn,$req);
	$res=majDonneesPrepareesPDO($cur);
	echo "Succès, l'utilisateur a été bien ajouté à la base de données.";
}
?>