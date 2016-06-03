<?php include('header-admin.php'); ?>

<h1>#TIM Matane administration</h1>	
<h2>Modifier l'ordre d'apparition des menus existants sur le site.</h2>
<p> Vous pouvez modifier ici l'ordre d'apparition des menus sur le site. Selectionnez l'indice coïncidant au menu choisi. L'indice 1 fera apparaître le menu le plus à gauche sur votre site. <span>Il ne peut y avoir que sept menus</span>, à vous de les organiser et de choisir dans quel ordre les faire apparaître !</p>
<p>Voir cette image d'exemple :</p>
<img src="menu.jpg" alt="exemple du menu"/> <br /><br /> <br />
<div class="liste-deroulante">



<form action="traitement-apparition-menu.php" method="POST">
	
		<fieldset>
			<legend>Gérer les indices :</legend>
			<?php 
				$sql="SELECT * FROM menu";
				$req = $pdo->query($sql);
				$position =0;

				$nb_menu =0;
				while($data = $req->fetch()){
					$nb_menu ++;
				}

				$sql="SELECT * FROM menu";
				$req = $pdo->query($sql);

				while($data = $req->fetch()){
					$position++;
					echo "<p class='border-deroulant'>".$data['nom']."  <select class='select' name='position".$position."'>";
					for($i=1; $i < $nb_menu+1; $i++) { 
						if ($data['position'] == $i) {
							echo "<option selected value='".$i."_".$data['menu_id']."'> $i </option>";
						}else{
							echo "<option value='".$i."_".$data['menu_id']."'> $i </option>";
						}
					}
					echo "</select> </p> ";
				}
			?>
		</fieldset>
		
	
		<input type="submit" name="enregistrer" id="enregistrer" value="Enregistrer"/>
	</form>
 </div>


