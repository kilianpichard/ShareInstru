<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script crossorigin="anonymous" src="https://kit.fontawesome.com/b320a9314d.js"></script>
  <title>Accueil</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
</head>
<body>
<nav>
  <img class="logo" src="assets/logoB.png">
  <div class="links">
    <a class="nav" href="accueil.php">
      ACCUEIL
    </a>
    <a class="nav" href="annonces.php">
      ANNONCES
    </a>
    <a class="nav" href="#">
      FONCTIONNEMENT
    </a>
  </div>
    <?php
    session_start();
    include("header.php");
    ?>
</nav>
<div class="content">
<h1>Comment ShareInstru Fonctionne ?</h1>
<h4>ShareInstru est une plateforme communautaire d'échange d'instruments de musique</h4>
<h4>Suivez ces quelques étapes pour trouver votre instrument à emprunter !</h4>
<div class="flexRow infos">
  <div class="content card">
    <img class="icon" src="data:image/png;base64,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">
    <div class="flex instrument">
      <h3>Trouvez un Instrument</h3>
    </div>
    <div class="divider"></div>
    <div class="info">
      Grace à la recherche ou en regardant toutes les annonces
    </div>
  </div>
  <div class="content card">
    <img class="icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAAFV0lEQVR4nO3dTWwUZRgH8P8z+9FSKNCKCW084NdRm1DsR/DQelBSuo1pAuFk5CBdwBSJeCRZb3qg0pjCLrF6MSF+nGhLIyG0CTVlaxuqSVGDkKgx0QpILP3c2ffxsIuWdfuxM7O77+48v1N333ffd2b+7AzPzHQKCCGEEEIIIYQQQoh8YgYVc5uTsj7JeKTWZ3LVDwB+agj2v1JsbU7zZnPwhOotAD8FYHNxtjkra9+Qqc/3+e/dmdvoYc9jhkfdBHA3pvjZ5X0Kuc2cnp1pDg2bmW+Z1TkWyHgkUGYyXmdwOwE1ALY5NbamFIBpBkYNoi9/rij9bP/+L+J2B3UkkGgk8Cor7gGhetnbSwBmk3NsBcAA7qeZv1DbyvHoLn/KMOhg3aG+b2CD7UCiZwPHmfhUYiyKEtDNHrrS8MaFPwBgPBLYZjL/CeBOQ7D/8eWfLeQ2DoWMiaqJJ+LMLUx4G4xnAMyz4gONRwYuZLYV/2ProD4a3tvO4FMAFDG9UxfsO00EtjNmoaBQSAH4BUB4PFLba2L7aYCOkEHnx8617K47dHHSyriG1QUa6tm3iUA9AAjEJ+oP932QLozbFaV/ARRlxqVibAOAXR0TsYbgwFFifASgTClP2GrdYnmXldxVdQH8dUNw4MWV+jGDiulbs9r6jEcCZabimyBUE/Oe+sMDX2U6vuVvCBO3AwADXenar51pe/5auPV6NNK6MBpuvTzyYVt1un6FYj3rs6ujb44JZwGAyWi3Mo/lQADsBABaUpfTjxw/D6au+d8fbCRg1OtT3Tbmyr91rg8pSm4PtdPSNFY+NNLbVg6gDMBMQ+fg36ntQ580lQL0ZH2w79Pm0LBJHvoYQK2VuXSQyfoo4l8TP1GVlbksBVJqcknyx8V07c0HhxcAnhoLB94a62nZznF1AsBVK3PpIJP18Rv0cJuUpGtfi51d1qripA4w8R7lMa6DqFJ5Y8ezNVcu5Gp9snZycXfH4C0AWT0zmku5Wp+sfUOENRKIZiQQzdg9htDVM3srHFmSAjBjqrmWzsHF8UigbD6uSlJfA8CSSVsNj/UTE3YDqfQZdMvmGAWj0u+dHAo1vWyCb/gM2pz6OtFL2TqDbjeQu6mnql1ix0qvl52qt0SOIZqRQDQjgWhGAtGMBKIZCUQzEohmcnAraWZSq+DU91P769LPKVoFMhRq8iar3i2Vfs89AE8DiSuUZkxN+wyaT/kI6dDPSVoFkrxXdkey2v3+4fulJpeYwIMVbmDLez8n5f0YkqvfuygUeQ1kpLetPBppvZHPZdBNXgNJ3ixR7HfJZ0SHY8j/rqmscE1B936OyGsgvg2L8+ZcyZLPQMo1FQUQbhdKPydZOqCuduu+29ndNnn/X5Z4VNZ2WbpX1q6q1HWvrF1XqeteWUulLtZNAtGMBKKZbBaGulfW7qnUda+spVJ3EanUi4xU6g71c4pU6g70c5JU6g70c5IcQzQjgWhGAtGMVOrO9XOEVOoO9HOSVOoOk0q9yLi2UteVKyt1nbmyUteZHEM0I4FoxhWB+DYszgP8Y76XYz1cUan/dl/NtXSu/GxhnbiiUq/0eycBvGR7xXIgK4HUvHZpFsCaD07OVz+dueIYUkgkEM1IIJqRQDQjgWhGAtGMpUAWvP8+cH7TUKhJh1+t1saSWv0PFazF8mMtroUD3wH8HIBuI67eWyTS/lpDthnk9xlG7CQx3mSgvzHYH8h0DMv/ukmpo2zQFQDHlMc45rM6UFGJJf6wHihmIP6ulRFsPfhl7FzgBaXwPsA1dscqEjGAv2Xik40dF6P5XhghhBBCCCGEEEKIIvMPu8YbsxME2q4AAAAASUVORK5CYII=">
    <div class="flex instrument">
      <h3>Verifiez ses disponibilités</h3>
    </div>
    <div class="divider"></div>
    <div class="info">
      Regardez si cet instrument est disponible aux dates souhaitées et planifiez un rendez-vous avec le prêteur afin de le récupérer !
    </div>
  </div>
  <div class="content card">
    <img class="icon" src="data:image/png;base64,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"> <div class="flex instrument">
    <h3>Retrouvez le préteur</h3>
  </div>
    <div class="divider"></div>
    <div class="info">
      Récuperez votre instrument auprès du préteur dans un endroit fixé ensemble, et profitez de cet instrument le temps de l'emprunt !
    </div>
  </div>
</div>
</div>
</body>
</html>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');

  a{
    text-decoration: none;
    text-transform: uppercase;
    color: black;
  }
  nav:hover>*>a{
    color:white;
  }
  html{
    overflow-x: hidden;
  }
  * {
    font-family: 'Open Sans', sans-serif;
    padding: 0;
    margin: 0;
  }
  .pl {
    padding-left: 10px;
  }
  .navigation, nav,form,.flexRow {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  form{
    margin-top:20px;
  }
  .navigation {
    padding-right: 20px;
  }
  .navigation > * {
    margin: 3px;
  }
  body{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }
  nav:hover {
    position: fixed;
    top: 0;
    width: 100%;
    padding: 10px;
    background: #414141;
    color: white;
    height: 40px;
    box-shadow: 0px 10px 35px -18px rgba(0,0,0,0.2);
    transition: all .5s ease;
  }
  nav {
    position: fixed;
    top: 0;
    width: 100%;
    padding: 10px;
    background: white;
    color: #414141;
    height: 40px;
    box-shadow: 0px 10px 35px -18px rgba(0,0,0,0.2);
    transition: all .5s ease;
  }
  nav:hover .logo{
    filter:brightness(500%);
  }
  nav .logo{
    filter:brightness(100%);
  }
  a.nav:hover, nav a.nav, nav:hover a.nav:hover{
    border-bottom: 1px solid #414141;
    transition: all .3s ease;
  }
  a.nav, nav:hover a.nav{
    border-bottom: 1px solid white;
    transition: all .3s ease;
  }
  .avatar {
    height: 30px;
    width: 30px;
    border-radius: 100px;
    border: 3px solid white;
    padding: 2px;
  }
  .avatarAnnonce {
    height: 30px;
    width: 30px;
    border-radius: 100px;
    border: 2px solid #c8984c;
    margin-right: 5px;
    padding: 2px;
  }
  .links{
      width: 500px;
      display: flex;
      justify-content: space-around;
      align-items: center;
      position: absolute;
      margin-left: auto;
      margin-right: auto;
      left: 0;
      right: 0;
  }
  a.nav:hover{
    border-bottom: 1px solid #414141;
    transition: all .3s ease;
  }
  a.nav{
    border-bottom: 1px solid white;
    transition: all .3s ease;
  }

  .spacer {
    height: 40px;
    background: #c8984c;
    width: 1px;
  }
  .divider {
    height: 1px;
    background: #c8984c;
    width: 90%;
  }
  .content {
    padding-top: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top:60px;
    margin-bottom: 20px;
  }
  input{
    padding:10px;
    border: 3px solid #c8984c;
    border-radius: 10px;
    margin:2.5px;
    outline: none;
  }
  select{
    width: 150px;
    border: 3px solid #c8984c;
    border-radius: 10px !important;
    height: 41px;
    background-color: white;
    outline: none;
    margin:2.5px;
  }
  .new{
    margin-top:60px;
    margin-left: 20px;
  }
  .flexRow{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
  }
  .instru{
    height: 150px;
  }
  .preview{
    height: 200px;
    width: 350px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3px;
    margin-top: 10px;
    border: 3px solid #c8984c;
    border-radius: 20px;
  }
  button.full{
    background: #c8984c;
    padding:10px;
    border-radius: 10px;
    border: 0;
    color:white;
    font-size: 15px;
  }
  .user{
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 90%;
  }
  .instrument{
    margin:5px;
  }
  .light{
    background: white;
    padding:10px;
    border: 1px solid white !important;
    border-radius: 10px;
    border: 0;
    color:#434852;
    font-size: 15px;
    transition: all .3s ease;
  }
  .light:hover{
    border: 1px solid #434852 !important;
    transition: all .3s ease;
  }
  .annonce{
    width: 90%;
    justify-content: flex-start;
    padding:10px;
  }
  .card{
    border-radius: 20px !important;
    background: white;
    box-shadow: 0px 2px 10px 0px rgba(0,0,0,0.2);
    padding: 10px !important;
    margin:15px;
    width: 390px;
    transition: all .3s ease;
  }
  .card.recherche{
    width: auto !important;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  .flex{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  .details{
    width: 90%;
  }
  .info{
    padding:15px !important;
    height: 150px;
    overflow: hidden;
    width: 90% !important;
  }
  .cat{
    margin:5px;
  }
  body{
    background: #F9F9F9;
  }
  .cat:hover{
    box-shadow: 0px 10px 12px 0px rgba(0,0,0,0.2);
    transition: all .3s ease;
    background: #c8984c;
    color:white;
    cursor : pointer;
  }
  img{
    transition: all .3s ease;
  }
  .cat:hover > img{
    filter: invert(1);
    transition: all .3s ease;
  }
  .icon{
    height:50px;
    margin-bottom: 10px;
  }
  .categories{
    flex-wrap: wrap;
    padding:40px;
    align-items: center;
    justify-content: center;
  }
  .logo{
    height: 40px;
  }
</style>


