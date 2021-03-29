﻿<?php
// E.Porcq  pdo_oracle.php  11/10/2016

/*  Exemple
	$db_username = "ETU000";
	$db_password = "ETU000";
	//$db = "oci:dbname=info;charset=AL32UTF8"; // fonctionne si tnsname.ora est complet (base UTF8)
	//$db = "oci:dbname=info;charset=WE8ISO8859P15"; // fonctionne si tnsname.ora est complet
	// $db = "oci:dbname=spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr;charset=AL32UTF8"; // fonctionne si tnsname.ora est complet (base UTF8)
	$db = fabriquerChaineConnex(); // plus général (fonctionne toujours)

	$conn = ConnecterPDO($db,$db_username,$db_password);
*/

//---------------------------------------------------------------------------------------------
function OuvrirConnexionPDO($db,$db_username,$db_password)
{
	try
	{
		$conn = new PDO($db,$db_username,$db_password);
		$res = true;
	}
	catch (PDOException $erreur)
	{
		echo $erreur->getMessage();
	}
	return $conn;
}
//---------------------------------------------------------------------------------------------
function majDonneesPDO($conn,$sql)
{
	$stmt = $conn->exec($sql);
	return $stmt;
}
//---------------------------------------------------------------------------------------------
function preparerRequetePDO($conn,$sql)
{
	$cur = $conn->prepare($sql);
	return $cur;
}
//---------------------------------------------------------------------------------------------
function ajouterParamPDO($cur,$param,$contenu,$type='texte',$taille=0) // fonctionne avec preparerRequetePDO
{
// Sur Oracle, on peut tout passer sans préciser le type. Sur MySQL ???
//	if ($type == 'nombre')
//		$cur->bindParam($param, $contenu, PDO::PARAM_INT);
//	else
		//$cur->bindParam($param, $contenu, PDO::PARAM_STR, $taille);
	$cur->bindParam($param, $contenu);
	return $cur;
}
//---------------------------------------------------------------------------------------------
function majDonneesPrepareesPDO($cur) // fonctionne avec ajouterParamPDO
{
	$res = $cur->execute();
	return $res;
}
//---------------------------------------------------------------------------------------------
function majDonneesPrepareesTabPDO($cur,$tab) // fonctionne directement après preparerRequetePDO
{
	$res = $cur->execute($tab);
	return $res;
}
//---------------------------------------------------------------------------------------------
function LireDonneesPDO1($conn,$sql,&$tab)
{
	$i=0;
	foreach  ($conn->query($sql,PDO::FETCH_ASSOC) as $ligne)     
		$tab[$i++] = $ligne;
	$nbLignes = $i;
	return $nbLignes;
}
//---------------------------------------------------------------------------------------------
function LireDonneesPDO2($conn,$sql,&$tab)
{
	$i=0;
	$cur = $conn->query($sql);
	while ($ligne = $cur->fetch(PDO::FETCH_ASSOC))
		$tab[$i++] = $ligne;
	$nbLignes = $i;
	return $nbLignes;
}
//---------------------------------------------------------------------------------------------
function LireDonneesPDO3($conn,$sql,&$tab)
{
  $cur = $conn->query($sql);
  //$tab = $cur->fetchall(PDO::FETCH_BOTH); // nom de colonnne + numéro
  $tab = $cur->fetchall(PDO::FETCH_ASSOC); // nom de colonnne
  return count($tab);
}
//---------------------------------------------------------------------------------------------
function LireDonneesPDOPreparee($cur,&$tab)
{
  $res = $cur->execute();
  $tab = $cur->fetchall(PDO::FETCH_ASSOC);
  return count($tab);
}
//---------------------------------------------------------------------------------------------
// fonctions supplementaires
//---------------------------------------------------------------------------------------------
function fabriquerChaineConnexPDO()
{
	//$hote = '10.103.0.20';
	//$hote = '127.0.0.1';
	$hote = 'kiutoracle18.unicaen.fr';
	$port = '1521'; // port par défaut
	$service = 'info';
	//$service = 'XE';

	$db =
	"oci:dbname=(DESCRIPTION =
	(ADDRESS_LIST =
		(ADDRESS =
			(PROTOCOL = TCP)
			(Host = ".$hote .")
			(Port = ".$port."))
	)
	(CONNECT_DATA =
		(SID = ".$service.")
	)
	)";
	return $db;
}

 ?>