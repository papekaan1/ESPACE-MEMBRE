<?php 	

		$user_id = $_GET['id'];
		$token = $_GET['token'];
		require 'include/db.php';
		//selection des donnes dans la base
		$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
		$req->execute([$user_id]);
		$user = $req->fetch();
		//Demarrage du session start 
			$_SESSION['auth'] = $user;
			//Verification de l'id et du token 
		if($user && $user->confirmation_token==$token){
		
				session_start();
				$pdo->prepare('UPDATE users SET confirmation_token = NULL,confirmed_at = NOW() WHERE id= ?')->execute([$user_id]);
				$_SESSION['flash']['success'] = "Votre compte a été bien Validé !!!";
				
				//la redirection de l'utilisateur 
				header('location:login.php');

		}else{
			session_start();
			//Dans le cas ou il reclik sur le code de cofirmation
			$_SESSION['flash']['danger'] = " Ce code n'est plus Valide ";   
			header('Location:login.php');
		}




 ?>