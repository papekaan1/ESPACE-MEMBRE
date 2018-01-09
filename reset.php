<?php 
	if(isset($_GET['id']) && isset($_GET['token'])){
		require 'include/db.php';
		require 'include/function.php';
		$req= $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > date_sub(NOW(), INTERVAL 30 MINUTE) ');
		$req->execute([$_GET['id'],$_GET['token']]);
		$user= $req->fetch();
		if($user){
			//test l'existence de l'utilisateur
			if(!empty($_POST) && $_POST['password']== $_POST['password_confirm']){
				$password= sha1($_POST['password']);
				$user_id = $user->id;
				$pdo->prepare('UPDATE users SET password= ?, reset_token= NULL, reset_at = NULL WHERE id=?')->execute([sha1($_POST['password']),$user_id]);

				session_start();
				$_SSSION['flash']['success'] = " Votre mot de passe a bien été modifié ";
				//Connection automatique de l'utilisateur 
				$_SESSION['auth'] = $user;
				//Redirection vers son compte 

				header('Location:compte.php');
				exit();

			}

		}else{
			session_start();
			$_SESSION['flash']['danger']= " Ce code n'est pas valide ";
			header('Location:login.php');
			exit();
		}

	}else{
		header('Location:login.php'); 
	}
 ?>
<?php 	require 'include/header.php' ?>
<h1> Votre Nouveau Mot de passe </h1>

<form action="" method="POST">

	<div class="form-group">
	<label for="">Mot de passe </a></label>
	<input type="password" name="password" class="form-control" />
	</div>

	<div class="form-group">
	<label for="">Confirmer Mot de passe</label>
	<input type="password" name="password_confirm" class="form-control" />
	</div>
	
	<button type="submit" class=" btn btn-primary">Réinitialisez</button>
	
</form>

<?php 	require 'include/footer.php' ?>