<?php

include("pdo_oracle.php");
include("util_chap11.php");

$proxy="http://proxy.unicaen.fr:3128";


if(isset($_POST['valider'])){
    if(!empty($_POST['ville'])){

$ville = $_POST['ville'];
    
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

//Connexion à la base de donnée

$secretkey = "b56ea98n";

$user="instruments";
$mdp="Esha2ohCheu5eij3";

$instance = "mysql:host=localhost;dbname=instruments_bd";


	$conn = OuvrirConnexionPDO($instance,$user,$mdp);
	if ($conn)
		echo ("<hr/> Connexion réussie à la base de données <br/>");
	else
		echo ("<hr/> Connexion impossible à la base de données <br/>");



	//Verifier si la ville est pas déjà dans la base

	$req = "SELECT vil_numero from VILLE where vil_nom like '$ville'";
	$nb = LireDonneesPDO1($conn,$req,$tab);



	if($nb == 0){

	//Recupérer le numero de ville maximum
	$req = "SELECT max(vil_numero)+1 as max from VILLE";
	$nb = LireDonneesPDO1($conn,$req,$tab);
	$numero = $tab[0]['max'];

	$req = "INSERT INTO VILLE(vil_numero,vil_nom,vil_cp,vil_lattitude,vil_longitude) values ('$numero','$ville','$postal','$latitude','$longitude')";

	$cur=preparerRequetePDO($conn,$req);
	$res=majDonneesPrepareesPDO($cur);
	echo "La ville a bien été ajouté.";

	}


    }else{
        echo "Ville non défini";
        echo $_POST['ville'];
    }
} else {
    echo "erreur validation";
}
?>

