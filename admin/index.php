<?php
include ("../utile.php");
include ("../connexion.php");
$connex = connexionPDO();
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="styleAdmin.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop : Admin</title>

</head>
	<body>


			<div id='container'>
				<h1>Administration de SiteWebShop</h1>
				<h2>Ajout d'article</h2>
				 <form id="formulaire_fichier" method="post" action="index.php" enctype="multipart/form-data">
    				<fieldset>
        			<legend>Transfert de fichier</legend>
        				<label for="edtDesi" id="idDesi">Designation :</label>
          				<input type="text" id="edtDesi" name="designation" required /></br></br>
          				<label for="edtDesc" id="idDesc">Description :</label>
          				<input type="text" id="edtDesc" name="description" /></br></br>          				
          				<label for=\"number\">Catégorie :</label>
       						<select name="categorie">
       							<?php
       							$res = $connex->query("SELECT * FROM categorie ;");
       							$res = $res->fetchAll(PDO::FETCH_ASSOC);

       							foreach ($res as $cat)
       								echo "<option value='" . $cat["id_categorie"] . "'>" . $cat["nom"] . "</option>";
       							?>
       						</select></br></br>
          				<label for="edtPrix" id="idPrix">Prix :</label>
          				<input type="text" id="edtPrix" name="prix" required /></br></br>
          				<label for="edtTVA" id="idTVA">TVA :</label>
          				<input type="text" id="edtTVA" name="tva" required /></br></br>
         				<label for="edtFile" id="idFile">Image :</label>
          				<input type="file" id="edtFile" name="image" required /></br></br>
    				</fieldset>
    				<p>
     				<input type="submit" id="btnSubmit" name="submit" value="Continuer" />
     				</p>
<?php
		if (isset($_POST["submit"]))
    {
      $ext_file = strtolower(substr(strrchr($_FILES['image']['name'],'.') ,1));
      $ext_ok = array( 'jpg', 'jpeg');

      if (in_array($ext_file,$ext_ok))
      {
      	$res = $connex->query("SELECT * FROM article WHERE description='" . $_POST["designation"] . "';");
      	$res = $res->fetchAll(PDO::FETCH_ASSOC);
      	if (!empty($res))
      		echo "<p>Article déjà présent.</p>";
      	else
      	{
      		$res = $connex->query("SELECT MAX(id_article) AS id FROM article;");
      		$res = $res->fetchAll(PDO::FETCH_ASSOC);
      		$id = $res[0]["id"] + 1;
      		$cat = form_fill($_POST["categorie"]);
      		$desi = form_fill($_POST["designation"]);
      		$desc = form_fill($_POST["description"]);
      		$prix = form_fill($_POST["prix"]);
      		$tva = form_fill($_POST['tva']);
      		$src = "./images/magasin/" . $_FILES["image"]["name"];
      		$connex->exec("INSERT INTO article(id_article, id_categorie, designation, prix, tva, description, img_article) VALUES($id, $cat, '$desi', $prix, $tva, '$desc', '$src');");
        	move_uploaded_file($_FILES["image"]["tmp_name"], "." . $src);

        	echo "<p>Article ajouté.</p>";
        }
      }
       else
        echo "<p>fichier imcompatible (format .jpg ou .jpeg autorisé)</p>";
    }
?>
			</div>
			<div id="container">
				<a href="../index.php">retour</a>
			</div>
	</body>
</html>