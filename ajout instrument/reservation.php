<?php
include("util_php/pdo_oracle.php");
include("util_php/util_chap11");

echo "test";

$user="instruments";
$mdp="Esha2ohCheu5eij3";
$instance = "mysql:host=localhost;dbname=instruments_bd";
echo "test";


	$conn = OuvrirConnexionPDO($instance,$user,$mdp);

	echo "test";

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

		echo "<option>test</option>";
		$req = "SELECT MAR_NUMERO, MAR_NOM FROM MARQUE";
		echo "<option>test2</option>";
		
		LireDonneesPDO1($conn, $req, $donnees);


		echo "<option>test3</option>";


		echo "<option selected disabled>non selectionné</option>";
		foreach ($donnees as $marque) {
			echo "<option value='" .$marque['MAR_NUMERO'] ."'>" .$marque['MAR_NOM']."</option>";
		}
	}
?>


<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>ajout location</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <script src="script.js"></script>
</head>
<body>

<div class ="wrap">
	<h2>Ajout location</h2>
	
	<form method="post" action="reservation.php">

		<label for="peudo">Categorie</label>
			<select name="categorie" id="categorie" required>
			<option value="">-- Choisissez une catégorie --</option>
    		<option value="1">Instruments à Vent</option>
    		<option value="2">Instruments à Percussion</option>
    		<option value="3">Instruments à Corde</option>
			</select>

		<label for="peudo">Type</label>
			<select name="Type" id="type" required>
			<option value="">-- Choisissez le type d'instrument --</option>
    		<option value="1">Instruments à Vent</option>
    		<option value="2">Instruments à Percussion</option>
    		<option value="3">Instruments à Corde</option>
			</select>
		
		<label for="nom">Marque</label>
			<select name="selMarque" size="1">
				<?php MenuDeroulantMarque($conn) ?>
			</select>


		
		<input type="text" name="marque" id="marque" placeholder="marque.." required>

		<label>Nom</label>
		<input type="text" name="nom" id="nom" placeholder="nom.." required>

		<label>Description</label>
		<input type="text" name="description" id="description" placeholder="description..">

		<label>Prix (€/jours)</label>
		<input type="number" name="prix" id="prix" placeholder="10€"
		step="any">

		<label>Photo(s)</label>
		<input type="file" name="photo" id="photo" accept="image/png, image/jpeg">

		<input type="submit" name="submit" id="submit" value="Envoyer">
	</form>
</body>
</html>


