<?php 
$server ="localhost";
$login ="root";
$db= "espace_membre";
$password="";
$pdo = new PDO('mysql:dbname='.$db';host='.$server.'',$login,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);