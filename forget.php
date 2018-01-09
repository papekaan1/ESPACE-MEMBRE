<?php 	
require 'include/function.php';
		if(!empty($_POST) && !empty($_POST['email'])){
				require 'include/db.php';
				$req = $pdo->prepare('SELECT * FROM users WHERE  email = ? AND confirmed_at IS NOT NULL ');
				$req->execute([$_POST['email']]);
				$user= $req->fetch();
					session_start();
				if($user){
						
						//Recuperation d'un nouveau code (token) 
						$reset_token=str_ramdom(10);
						var_dump($reset_token);
				$pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token,$user->id ]);
				$_SESSION['flash']['success'] = "Les instructions de rappel vous ont été envoyé  ";
				mail($_POST['email'], "Réinitialisation de votre mot de passe", "cliquer ici pour valider\n\nhttp://127.0.0.1/projects/Geek/ESP%20MEMB/reset.php?id={$user->id}&token=$reset_token");
					header('Location:login.php');
					exit();
				}else{
					$_SESSION['flash']['danger'] = 'Aucun compte ne correspond a cet adresse ***'; 
				}

		}
 ?>
<?php 	require 'include/header.php' ?>
<h1> Se Connecter </h1>

<form action="" method="POST">
	<div class="form-group">
	 <label for="">Email </label>
	<input type="email" name="email" class="form-control" required="required" />
	</div>
	<button type="submit" class=" btn btn-primary"> Réinitialiser</button>
	
</form>

<?php 	require 'include/footer.php' ?>