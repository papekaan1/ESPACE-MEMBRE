<?php 
//fonction pour deguber 
function debug($variable){
	echo '<pre>'. print_r($variable, true).'</pre';
}
 //Fonction creation compte de confirmation 
function str_ramdom($length){
 
	$alphabet="123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
	return  substr(str_shuffle(str_repeat($alphabet,$length)),0 , $length);
}

//verification de l'authentification 
function connect_seul(){
    //Verifier si une session est demarré sinon on demarre un 
    if(session_status()== PHP_SESSION_NONE){
      session_start();
  }
      //test de la session authentification 
	if(!isset($_SESSION['auth'])){
		$_SESSION['flash']['danger'] = " Acces  à  cette page est Interdit ";
		header('Location:login.php');
		exit();
	}
}
