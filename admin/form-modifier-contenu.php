<?php include("header-admin.php"); ?>

<?php
				include("connectionbdd.php");
				$contenu_id = $_GET["contenu_id"];
				$sql="SELECT * FROM contenu
					  WHERE contenu_id = $contenu_id";
				$liste = $pdo->query($sql);
				$data = $liste->fetch();
				$id_page_ = $data['id_page_'];
			 ?>

	<h1>Administration #TIM Matane</h1>
	<h2>Modifier le contenu: <?php echo $data['titre']; ?> </h2>

	<form action="traitement-modifier-contenu.php?contenu_id=<?php echo $data['contenu_id']?>" method="POST">

		<fieldset>
			<legend>Formulaire</legend>

			<div>
				<label for="titre">Titre du contenu : </label>
				<input class="form" type="text" name="titre" value="<?php echo $data['titre']; ?>"/>
			</div>

			<div>
				<!--WYSIWYG-->
				<textarea class='input-block-level' id='summernote' name='txt' rows='18' required></textarea>
				<script>
				var editor = new TINY.editor.edit('editor', {
					id: 'tinyeditor',
					width: 600,
					height: 175,
					cssclass: 'tinyeditor',
					controlclass: 'tinyeditor-control',
					rowclass: 'tinyeditor-header',
					dividerclass: 'tinyeditor-divider',
					controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
						'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
						'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
						'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
					footer: true,
					fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
					xhtml: true,
					cssfile:'../style.css',
					content: <?php echo json_encode($data['contenu']); ?>,
					bodyid: 'editor',
					footerclass: 'tinyeditor-footer',
					toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
					resize: {cssclass: 'resize'}
				});
				</script>
				<!--FIN WYSIWYG--></textarea>
				<input type="hidden" id="contenu" name="contenu" value="" />
			</div>

			<div>
				<label for="id_page_">A quelle page voulez vous affecter ce contenu ?</label>
				<select name="id_page_" value="<?php echo $data['id_page_']; ?>">
				<option value=""></option>
					<?php

							$sql="SELECT * FROM page";
							$req = $pdo->query($sql);

							while ( $data = $req->fetch()) {
								if ($data['page_id'] == $id_page_) {
									echo "<option selected value=".$data['page_id'].">".$data["titre"]."</option>";
								}else{
									echo "<option value=".$data['page_id'].">".$data["titre"]."</option>";
								}

							 }
					?>
				</select>
			</div>

		</fieldset>
		<input type="submit" name="enregistrer" id="enregistrer" onclick="document.getElementById('contenu').value = editor.e.body.innerHTML" value="Enregistrer"/>
	</form>
	</section>
	</div>

	</body>
</html>
