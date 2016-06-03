<?php 
include"connectionbdd.php";
$billet=$_GET['re'];
$sql="UPDATE file_upload SET couverture = 0 WHERE _id_event_ind = $billet ";
$liste = $pdo -> query($sql);
?>


<form action='traitement_modif_couv.php' method='POST'>
<?php 
echo "<p class='explication-form'>Attention, si vous avez cliqué sur 'Modifier l'image de couverture', l'ancienne image n'est plus <br/>sélectionné comme image de couverture. Veuillez choisir a nouveau une image et cliquer sur envoyer !<br/></p>";
echo '<select name="choix_couv" required>';
echo  '<option></option>';
$sql="SELECT * FROM file_upload WHERE _id_event_ind = $billet"; 
$liste = $pdo->query($sql);
while ($data= $liste->fetch()) {
	echo "<option value=\"".$data['fid']."\">".$data['f_name']."</option>";
}
echo "</select>"; 
 ?>
 <input type="submit" value="Envoyer !">
</form>
