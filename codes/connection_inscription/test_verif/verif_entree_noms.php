<?php

function verifAccent($verif){

	//source tableau: https://stackoverflow.com/questions/3371697/replacing-accented-characters-php
	$unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A',
						'Æ'=>'AE', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',
						'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Œ'=>'OE', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U',
						'Ü'=>'U', 'Ŭ'=>'U', 'Ý'=>'Y', 'Ÿ'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'á'=>'a', 'ã'=>'a', 'å'=>'a',
						'æ'=>'ae', 'ì'=>'i', 'í'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'õ'=>'o', 'ø'=>'o', 'œ'=>'oe',
						'ú'=>'u', 'ŭ'=>'u', 'ý'=>'y', 'þ'=>'b' );

	return strtr( $verif, $unwanted_array);
}

function changerApo($verif){

	$change_apo = array("’"=>"'", "ʾ"=>"'", "′"=>"'", "ˊ"=>"'", "‘"=>"'", "ʿ"=>"'", "‵"=>"'", "ˋ"=>"'", "΄"=>"'", "ʹ"=>"'", "՝"=>"'", "՛"=>"'", "՜"=>"'", "ՙ"=>"'");

	return strtr( $verif, $change_apo);
}


function apoSeule($verif){
	if(preg_match("/' [a-zA-Z]$/u", $verif)){
		$verif = str_replace("' ", "'", $verif);
	}
	if(preg_match("/^[a-zA-Z] '/u", $verif)){
		$verif = str_replace(" '", "'", $verif);
	}
	if(preg_match("''", $verif)){
		$verif = str_replace("''", "' '", $verif);
	}
	return $verif;
}

function convertirEnNom($verif){

	$verif = str_replace("/ {2,}/", " ", $verif);
	return verifAccent(mb_strtoupper(apoSeule(changerApo(espaceNomPrenom(tiretNomPrenom($verif)))), 'UTF-8'));
}

function convertirEnPrenom($verif){

	$verif = str_replace("--", "-", $verif);
	$verif = str_replace("/ {2,}/", " ", $verif);
	$verif = apoSeule(changerApo(espaceNomPrenom(tiretNomPrenom($verif))));
	$verif = str_replace(" ", "€-", $verif);
	$verif = str_replace("'", "$-", $verif);
	$verif = str_replace("’", "$-", $verif);
	if(strpos($verif, "-") !== false){
		$tab = explode("-", $verif);
		for($i = 0; $i < count($tab); $i++){
			$tab[$i] = verifAccent(mb_strtolower($tab[$i], 'UTF-8'));
			$res = verifAccent(mb_strtoupper(mb_substr($tab[$i], 0, 1, 'UTF-8'), 'UTF-8'));
			$res .= mb_substr($tab[$i], 1, mb_strlen($tab[$i], 'UTF-8')-1, 'UTF-8');
			$tab[$i] = $res;
		}
		$verif = implode("-", $tab);
		$verif = str_replace("€-", " ", $verif);
		$verif = str_replace("$-", "'", $verif);
	}
	else{
		$verif = verifAccent(mb_strtolower($verif, 'UTF-8'));
		$res = verifAccent(mb_strtoupper(mb_substr($verif, 0, 1, 'UTF-8'), 'UTF-8'));
		$res .= mb_substr($verif, 1, mb_strlen($verif, 'UTF-8')-1, 'UTF-8');
		$verif = $res;
	}

	return $verif;

}

function nomCorrect($verif){

	$regex1="~^[a-zA-Z\-'\s']+$~u";
	$regex2="$(.--.){2}$";
	$regex3="/[a-zA-Z]/";
	$regex4="/'{3,}/";
	$regex5="/-{3,}/";

	if (mb_strlen($verif, 'UTF-8') > 30 || preg_match($regex4, $verif) || preg_match($regex5, $verif)) {
		//echo "incorrect (plus long que 30 ou plus de 3 apo)<br/>";
		return false;
	}
	else if(preg_match($regex2, $verif)){
			//echo "incorrect (plus de 2 tirets ou double slash)<br/>";
			return false;
		}
	else if(preg_match($regex1, convertirEnNom($verif)) && preg_match($regex3, convertirEnNom($verif))){
		return true;
	}
	else {
		//echo "incorrect (charactères autres que az'- ou pas pas de lettre)<br/>";
		return false;
	}
}

function espaceNomPrenom ($nom) {

 $cpt;
 $indesirable = "/^ /";
 $indesirable2 = "/ $/";
 $indesirable3 = "/[ ]{2,}/";
 $indesirable4 = "/ - /";

 	if (preg_match($indesirable, $nom) || preg_match($indesirable2, $nom) || preg_match($indesirable3, $nom) || preg_match($indesirable4, $nom)) {
 		$nom = preg_replace($indesirable,"", $nom);
 		$nom = preg_replace($indesirable2, "", $nom);
 		$nom = preg_replace($indesirable3," ", $nom);
 		$nom = preg_replace($indesirable4,"-", $nom);
 		//echo $nom ,"</br>";
 		//echo "ERREUR: le Nom/Prénom ne peut comporter un tiret au début ou à la fin, et plus de deux tirets dans son contenu";
 	} // else {
 	//	echo $nom;
 	//}
 	return $nom;
}

function tiretNomPrenom ($nom) {

 $cpt;
 $indesirable = "/^-/";
 $indesirable2 = "/-$/";
 $indesirable3 = "/[--]{3,}/";

 	if (preg_match($indesirable, $nom) || preg_match($indesirable2, $nom) || preg_match($indesirable3, $nom)) {
 		$nom = preg_replace($indesirable,"", $nom);
 		$nom= preg_replace($indesirable2, "", $nom);
 		$nom = preg_replace($indesirable3,"-", $nom);
 		//echo $nom ,"</br>";
 		//echo "ERREUR: le Nom/Prénom ne peut comporter un tiret au début ou à la fin, et plus de deux tirets dans son contenu";
 	} //else {
 	//	return true;
 	//}
 	return $nom;
}

// TESTS DE VALIDATION
/*
$tab_test = array("Ébé-ébé",
"ébé-ébé",
"ébé-Ébé",
"éÉé-Ébé",
"'éÉ'é-É'bé'",
"'éæé-É'bé'",
"'éæé-É'Ŭé'",
"'é !é-É'Ŭé'",
"éé''éé--uù  gg",
'éé"éé--uù  gg',
"Éééé--gg--gg",
"DE LA TR€UC",
"DE LA TRUC",
"ééééééééééééééééééééééééééééééééééééééééééééééé",
"ùùùùùùùùùùùùùùùùùùùù",
"-péron-de - la   branche-",
"pied-de-biche",
"Ferdinand--SaintMalo ALAnage",
"Ferdinand--SaintMalo-ALAnage",
"aa--bb--cc",
"A' ' b",
"A'",
"'",
"x",
"A '' b",
"bénard     ébert",
"ÆøœŒøñ",
"\a",
"\\a",
"b\\a",
"b\a",
"Æ'-'nO",
"çççç ççç ÇÇÇÇ ÇÇÇ ",
"àâäéèêëïîôöùûüÿç",
"ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ",
"a΄aʹa՝a՛a՜a՚aՙa ",
"ٽڿ۳",
"ϴЭщ",
"Éèàùîôê-éèàùîôê",
"a    a       b",
"ª");

$compteur = 2;
for($i = 0; $i < count($tab_test); $i++){

	echo "$compteur. ";
	if(nomCorrect($tab_test[$i])){
		$nom = convertirEnNom($tab_test[$i]);
		$prenom = convertirEnPrenom($tab_test[$i]);
		echo "nom : $nom ||| prénom = $prenom <br/>";
	}
	$compteur = $compteur + 1;
}
*/
?>