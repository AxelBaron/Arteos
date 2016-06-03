<?php include "header-admin.php"; ?>
    <h1>ArtEos - Administration : Créer un nouveau regroupement d'évènements</h1>

        <form class="form" action="traitement-ajouter-evenement_groupe.php" method="POST" enctype="multipart/form-data">

            <p> Nom : <input type="text" placeholder="Nom du nouveau regroupement" name="nom" required /></p>
            <p>Date de début du regroupement d'évènements: <input type="date" placeholder="Date du début du festival" name="date_debut" required /></p>
            <p>Date de fin du regroupement d'évènements: <input type="date" placeholder="Date de la fin du festival" name="date_fin" required /></p>

            <p>Ce regroupement est un :</p>
            <select required name="_id_type_gp">
              <option value=""></option>
               <?php
                    $req="SELECT id_type_gp, nom FROM type_groupe";
                        $liste = $pdo->query($req);
                        while ($data= $liste->fetch()) {
                            if($data['nom']== "Concert"){
                                $nom = "Festivals de musique";
                                 $id= $data['id_type_gp'];
                                echo "<option value='$id'>".$nom."</option>";
                            }

                            if($data['nom']=="Sports"){
                                $nom = "Evénements sportifs";
                                 $id= $data['id_type_gp'];
                                echo "<option value='$id'>".$nom."</option>";
                            }

                            if($data['nom']=="Arts de la scène"){
                                $nom = "Festivals d'arts de la scène";
                                 $id= $data['id_type_gp'];
                                echo "<option value='$id'>".$nom."</option>";
                            }
                        }
                ?>
            </select>
            <br />
            <br />
            <textarea class='input-block-level' id='summernote' name='txt' rows='18' ></textarea>
            <input type="submit" value="Continuer" />
	  	</form>
    </section>

	</div>
<?php include "footer-admin.php"; ?>
