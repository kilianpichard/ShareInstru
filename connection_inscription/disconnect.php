<?php
session_start();
$_SESSION['UTI_NOM'] = null;
$_SESSION['UTI_PRENOM'] = null;
$_SESSION['UTI_PHOTO'] =null;
header('Location: https://dev-instruments.users.info.unicaen.fr/Acceuil/accueil.php');
?>