
 <?php 
  require_once 'include/function.php';
  session_start();
 	/*DEBUT TRAITEMENT DES DONNEES */
 		//verifiez si les donnez on etait poster avec empty
 	if (!empty($_POST)) {
 		//validation des champ  
 	$erreurs = array();
 		require_once 'include/db.php';
 	//la verifiaction du champ username et l"exp reguliere
 	if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/' , $_POST['username'])) {
 		$erreurs['username'] = "Votre pseudo'est pas valable(Alpha_Num)";

 	}else{
 		$req=$pdo->prepare('SELECT id FROM users WHERE username = ?');
 		$req->execute([$_POST['username']]);
 		$user = $req->fetch();
 		if($user){
 			$erreurs['username'] = 'ce pseudo est déja pris'; 
 		}

 	}
 	//verifiaction si le champ email est rempli
 	if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
 		$erreurs['email']= " Votre email n'est pas valide";
 	}else{
 		$req=$pdo->prepare('SELECT id FROM users WHERE email = ?');
 		$req->execute([$_POST['email']]);
 		$user = $req->fetch();
 		if($user){
 			$erreurs['email'] = 'ce email est déja utilisé pour un autre client'; 
 		}

 	}
 	//Verification des mot de passe 
 	if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
 	
 		$erreurs['password']= " Votre Mot de passe n'est pas valide";

 	}
 	/*FIN TRAITEMENT DES DONNEES*/
 	/*DEBUT CONNEXION A LA BASE DE DONNEES*/
 	//Inscription de l'user dans la base de donnée
 	if (empty($erreurs)) {
 	
 		$req =$pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token= ?");
 		$password = sha1($_POST['password']);
 		$token = str_ramdom(10);	
 		$req->execute([$_POST['username'], $password, $_POST['email'], $token]);
 		$user_id = $pdo->lastInsertId();
 		//l'envoi du mail 
 		mail($_POST['email'], "Confirmation de votre compte", "cliquer ici pour valider\n\nhttp://127.0.0.1/projects/Geek/ESP%20MEMB/confirm.php?id=$user_id&token=$token");
 			//sama message flas 
 			$_SESSION['flash']['success'] = "un mail de confirmation vous a etez envoyer !!!";
 			header('Location: login.php');
 			exit();
 	}
 	 
 	}
/*FIN TRAITEMENT DES DONNEES */
  ?>
 <?php require 'include/header.php' ?>
<h1>S'incrire</h1>
		<?php 	if(!empty($erreurs)): ?>
			<div class="alert alert-danger">
			<p>	Vous n'avez pas rempli le formulaire correctement </p>
			<ul>	
				<?php 	foreach($erreurs as $erreur): ?>
					<li> <?= $erreur; ?></li>
				<?php 	endforeach; ?>
			</ul>
			</div>
		<?php 	endif ?>
<form action="register.php" method="POST">
	<div class="form-group">
	<label for="">Pseudo</label>
	<input type="text" name="username" class="form-control" />
	</div>

	<div class="form-group">
	<label for="">Email</label>
	<input type="text" name="email" class="form-control"/>
	</div>

	<div class="form-group">
	<label for="">Mot de passe</label>
	<input type="password" name="password" class="form-control" />
	</div>
	<div class="form-group">
	<label for="">Confirmez Mot de Passe</label>
	<input type="password" name="password_confirm" class="form-control"/>
	</div>
	<button type="submit" class=" btn btn-primary">M'inscrire</button>
	
</form>

<?php require 'include/footer.php' ?>