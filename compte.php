<?php 	
		session_start();
		require 'include/function.php';
		connect_seul();
		if(!empty($_POST)){
			if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
				$_SESSION['flash']['danger'] = "Les mot de passe ne sont pas identiques";

			}else{
				//Recuperation et mise a jour des mot de dpasse 
				$user_id = $_SESSION['auth']->id;
				//$password = sha1($_POST['password']);
				require_once 'include/db.php';
			   $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([sha1($_POST['password']), $user_id]);
			   $_SESSION['flash']['success'] = "Votre mot de passe a été bien mis à jour ";
			}
		}
		require 'include/header.php'
 ?>
		<!-- Message de Bienvenue -->
<h2 class="text-center text-success">Bonjour <?= $_SESSION['auth']->username ?></h2>

<form action="" method="POST">

	<div class="form-group">
	<label for="">Mot de passe</label>
	<input type="password" name="password" class="form-control" />
	</div>
	<div class="form-group">
	<label for="">Confirmez Mot de Passe</label>
	<input type="password" name="password_confirm" class="form-control"/>
	</div>
	<button type="submit" class=" btn btn-primary"> Changer Votre Mot de passe</button>
	
</form>


<?php 	require 'include/footer.php' ?>