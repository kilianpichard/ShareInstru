<?php
session_start();
echo"<div class='navigation'>";
if(!strlen($_SESSION["UTI_NOM"])!=0){
     echo"<div id='login'>"
     ." <a href='../connection_inscription/create.html'>"
        ."<button class='light'>S'inscrire</button>"
     ." </a>"
     ." <a href='../connection_inscription/login.html'>"
     ."   <button class='full'>Se Connecter</button>"
     ." </a>"
     ." </div>";
}else{
   echo " <a href='../connection_inscription/disconnect.php'>"
    ."   <button class='full'>Déconnexion</button>"
    ." </a>";
    echo($_SESSION["UTI_NOM"]." ".$_SESSION["UTI_PRENOM"]);
    echo"<img class='avatarAnnonce' src='".$_SESSION["UTI_PHOTO"]."'>";
}
   echo" </div>";
?>
