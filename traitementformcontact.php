 <?php include('admin/connectionbdd.php') ?>

 <?php 	
	$mailto = "grassetlolita@live.fr";
	$nomprenom = $_POST['nomprenom'];
	$sujet = $_POST['sujet'];
	$mail = $_POST['mail'];
	$messagecontact = $_POST['messagecontact'];

	filter_var($nomprenom,FILTER_SANITIZE_STRING);
	filter_var($sujet,FILTER_SANITIZE_STRING);
	filter_var($mail,FILTER_SANITIZE_EMAIL);
	filter_var($messagecontact,FILTER_SANITIZE_STRING);

	$newsujet = "Site Arteos : ".$sujet;
	$newmessagecontact = $messagecontact."\n \nCe message vous a été envoyé via le formulaire de contact du site arteos.fr.";

	$entete = 'From: '.$mail."\r\n".
	'Reply-To: '.$mail."\r\n".
	'X-Mailer: PHP/'.phpversion(); 

	mail($mailto, $newsujet, $newmessagecontact, $entete);
?>
