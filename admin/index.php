<?php
	include "connectionbdd.php"; 
	if(isset($_POST['login'], $_POST['mdp'])){
		
		//Si le nom d'utulisateur et le mot de passe n'est pas vide
		if(!empty($_POST['login']) && !empty($_POST['mdp'])){
			
			//Stock le nom d'utilisateur et le mot de passe dans des variables
			$login = $_POST['login'];
			$mdp = $_POST['mdp'];
			$mdp = sha1($mdp);
			
			//Prépare et éxécute la connexion à la base de données avec les informations reçues
			$login_q = $pdo->prepare("SELECT * FROM admin WHERE usager = :login AND mdp = :mdp");
			$login_q->execute(array('login' => $login, 'mdp' => $mdp));
			
			//Stock les informations correspondants
			$user = $login_q->fetch(PDO::FETCH_OBJ);
			
			//Si les informations correspondes (Login + Mdp)
			if($user){
				//Encryptage du mot de page pour le token
				$token = md5($user->admin_id);
				
				//Création d'un token d'une durée de 1 heure
				setcookie('token', $token, time()+3600);
			
				$admin_id = $user->admin_id;
				
				//Mise à jour de la base de données pour ajouté le token et sa durée
				$setToken_q = $pdo->prepare("UPDATE admin SET jeton = :token, jeton_date = NOW() WHERE admin_id = :user_id");
				$setToken_q->execute(array('token' => $token, 'user_id' => $admin_id));
				
				$token = null;
				
				header('Location: gestionprincipal.php');
			
				exit();
				
				print_r($user);
			}else{
				echo("L'utilisateur n'existe pas !");
			}
			
			
		}
	}else if(isset($_COOKIE['token']) && !empty($_COOKIE['token'])){
	//S'il existe déja un cookie token, redirige vers gestionprincipal.php
	header('Location: gestionprincipal.php'); # Redirection
 
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Connexion Administration</title>
	<link rel="stylesheet" type="text/css" href="css/style_admin.css"/>
</head>
<body id="body_connexion">
<div id="container" >
		
		<form method="post" action="index.php">
			<div id='conteneur_logo_connexion'>
				<img src="../images/logo.png" alt="logoArtEos" width="100%" height="100%">
				<h3 id="h3_connexion" >Connexion à l'administration</h3>
			</div>
			<label for="login">Identifiant :</label>
			
			<input type="text" name="login" id="login" required placeholder="Votre identifiant" />
			
			<label for="username">Mot de passe :</label>
					
			<input type="password" id="mdp" name="mdp" required placeholder="Votre mot de passe">
			
			<div id="lower">
					
				<input type="submit" value="Connexion">
			
			</div>
		
		</form>
		
	</div>
</body>
</html>
