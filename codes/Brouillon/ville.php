<?php


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


    }else{
        echo "Ville non défini";
        echo $_POST['ville'];
    }
} else {
    echo "erreur validation";
}
?>

