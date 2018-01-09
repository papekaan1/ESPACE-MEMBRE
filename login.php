<?php 	
		if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
				require 'include/db.php';
				require 'include/function.php';
				$req = $pdo->prepare('SELECT * FROM users WHERE  username = :username OR email = :username AND confirmed_at IS NOT NULL ');
				$req->execute(['username' => $_POST['username']]);
				//la Verfication du mot de passe Crypté
				$user= $req->fetch();
				session_start(); 
				if(!empty($user)){
				if(sha1($_POST['password']) == $user->password){
					$_SESSION['auth'] = $user;
					$_SESSION['flash']['success'] = "Bienvenue Chez Kane's Money !!!!  ";
					header('Location:compte.php');
					exit();
				}else{
					$_SESSION['flash']['danger'] = 'Identifiant ou Mot depasse incorrecte'; 
				}
				}else{
					$_SESSION['flash']['danger'] = "Merci de demander a KANE's Money de vous donnez un compte !!!";
				}

		}
 ?>
<?php 	require 'include/header.php' ?>
<h1> Se Connecter </h1>

<form action="login.php" method="POST">
	<div class="form-group">
	<label for="">Pseudo ou email </label>
	<input type="text" name="username" class="form-control" />
	</div>

	<div class="form-group">
	<label for="">Mot de passe <a href="forget.php">(Mot de passe oublier)</a></label>
	<input type="password" name="password" class="form-control" />
	</div>
	
	<button type="submit" class=" btn btn-primary">Se connecter </button>
	
</form>

<?php 	require 'include/footer.php' ?>