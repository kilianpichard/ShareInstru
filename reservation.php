<?php
include("util_php/pdo_oracle.php");
include("util_php/util_chap11");


$user="instruments";
$mdp="Esha2ohCheu5eij3";
$instance = "mysql:host=localhost;dbname=instruments_bd";



	$conn = OuvrirConnexionPDO($instance,$user,$mdp);

	if ($conn)
		echo ("<hr/> Connexion réussie à la base de données <br/>");
	else
		echo ("<hr/> Connexion impossible à la base de données <br/>");



	date_default_timezone_set('Europe/Paris');
	$date = date("Y-m-d H-i-s");

	if(!empty($_POST["pseudo"])){$pseudo = $_POST['pseudo'];}  
	if(!empty($_POST["nom"])){$nom = $_POST['nom'];}
	if(!empty($_POST["prenom"])){$prenom = $_POST['prenom'];} 

	function MenuDeroulantMarque($conn)
	{

		$req = "SELECT MAR_NUMERO, MAR_NOM FROM MARQUE";
		
		
		LireDonneesPDO1($conn, $req, $donnees);

		echo "<option selected disabled>non selectionné</option>";
		foreach ($donnees as $marque) {
			echo "<option value='" .$marque['MAR_NUMERO'] ."'>" .$marque['MAR_NOM']."</option>";
		}
	}

		function MenuDeroulantCategorie($conn)
	{

		$req = "SELECT CAT_NUMERO, CAT_NOM FROM CATEGORIE";
		LireDonneesPDO1($conn, $req, $donnees);

		echo "<option selected disabled>non selectionné</option>";
		foreach ($donnees as $categorie) {
			echo "<option value='" .$categorie['CAT_NUMERO'] ."'>" .$categorie['CAT_NOM']."</option>";
		}
	}
?>


<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>ajout location</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>

<div class ="wrap">
	<h2>Ajout location</h2>
	
	<form method="post" action="reservation.php">

		<label for="nom">Categorie</label>
			<select name="selCategorie" size="1">
				<?php MenuDeroulantCategorie($conn) ?>
			</select>
		
		<label for="nom">Marque</label>
			<select name="selMarque" size="1">
				<?php MenuDeroulantMarque($conn) ?>
			</select>

		<label>Nom</label>
		<input type="text" name="nom" id="nom" placeholder="nom.." required>

		<label>Description</label>
		<input type="text" name="description" id="description" placeholder="description..">

		<label>Ville</label>
		<input type="text" name="ville" id="ville" placeholder="ville.." required>

		<label>Prix (€/jours)</label>
		<input type="number" name="prix" id="prix" placeholder="10€"
		step="any">

		<label>Date de début</label>
		<input type="date" name="naissance" id="naissance"  min="1900-01-01" max="2050-01-01" value="2000-01-01" placeholder="date de naissance.." required>

		<label>Date de fin</label>
		<input type="date" name="naissance" id="naissance"  min="1900-01-01" max="2050-01-01" value="2000-01-01" placeholder="date de naissance.." required>

		<label>Photo(s)</label>
		<input type="file" name="photo" id="photo" accept="image/png, image/jpeg">

		<input type="submit" name="submit" id="submit" value="Envoyer">
	</form>
</body>
</html>


