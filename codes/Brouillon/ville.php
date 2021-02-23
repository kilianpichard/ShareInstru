<?php

include("util_php/pdo_oracle.php");
include("util_php/util_chap11.php");


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

$data = curl_exec($curl);
curl_close($curl);


//Récupération latitude
$tmp = explode('"y":',$data)[1];
$latitude = explode(",",$tmp)[0];
echo "latitude :".$latitude;


//Récuperation longitude
$tmp = explode('"x":',$data)[1];
$longitude = explode(",",$tmp)[0];
echo "<br> longitude : ".$longitude;


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



	//Verifier si la ville est pas dékà dans la base

	$req = "SELECT ville_numero from VILLE where vil_nom like '$ville'";
	$nb = LireDonneesPDO1($conn,$req,$tab);
	if(nb == 0){

	//Recupérer le numero de ville maximum
	$req = "SELECT max(ville_numero)+1 as max from VILLE";
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

