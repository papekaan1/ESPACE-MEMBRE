<?php   
    //Verifier si une session est demarré sinon on demarre un 
    if(session_status()== PHP_SESSION_NONE){
      session_start();
    }
 ?>
<!DOCTYPE html>   
<html lang="fr-FR ">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>StarBootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Super Projet</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <!-- LE test pour voir si on 1 clé authentification pour afficher le bouton deconnecté -->
              <?php   if(isset($_SESSION['auth'])):?>

                <li><a href="logout.php"> Se déconnecter </a></li>
              <?php   else: ?>
                <li><a href="register.php"> S'Inscrire</a></li>
                <li><a href="login.php">Se Connecter</a></li>
                <li><a href="#contact">Contact</a></li>
              <?php   endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
   <div class="container">
   <?php  if(isset($_SESSION['flash'])): ?>
        <?php   foreach($_SESSION['flash'] as $type => $message): ?>
              <div class="alert alert-<?= $type;?>">  
                        <?= $message; ?>
              </div>
        <?php   endforeach; ?>
        <?php 
            // Destruction de la session pour le message flash
          unset($_SESSION['flash']); 
        ?>
    <?php   endif;  ?>
   