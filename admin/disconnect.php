<?php
	include_once 'connectionbdd.php';
	 
	$token = '';
	if(isset($_COOKIE['token']) && !empty($_COOKIE['token']))
		$token = $_COOKIE['token']; # Récupération des Cookies & Ou Sessions
	 
	$insert_q = $pdo->prepare("UPDATE admin SET jeton = '', jeton_date = '' WHERE jeton = :token"); 
	$insert_q->execute(array(
		'token' => $token
	));
	 
	setcookie('token', '', time()-3600); # Destruction des cookie
	
	header('Location: index.php'); # Redirection
?>
