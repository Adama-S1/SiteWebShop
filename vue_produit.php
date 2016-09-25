<?php
include ("utile.php");
include ("connexion.php");
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop : produit</title>

</head>
<body>

<?php
	require("header.php");
	$connex = connexionPDO();
?>
<section>
<?php
	if (isset($_GET["id"]))
	{
		$sql = "SELECT * FROM article WHERE id_article = " . $_GET["id"] . ";";
		$res = $connex->query($sql);
		$res = $res->fetch(PDO::FETCH_ASSOC);
		if (!empty($res))
		{
			echo "<article id=\"detail-produit\">";

			echo "<header><h2>" . $res["designation"] . "</h2></header>";

			echo "<p>" . $res["description"] . "</p>"
				 . "<img src=\"" . $res["img_article"] . "\" alt=\"" . $res["designation"] . "\" />"
				. "<p><strong>" . $res["prix"] . " €</strong></p>";

			echo "<form id=\"form-produit\" method=\"post\" action=\"panier.php\">";
        		echo "<p>
        				<input type='hidden'  name='id'  value='" . $res["id_article"] . "'/>
       					<label for=\"number\">Quantité :</label>
       						<select name=\"quantite\" id=\"id_quantite\">
           						<option value=\"1\">1</option>
           						<option value=\"2\">2</option>
           						<option value=\"3\">3</option>
          						<option value=\"4\">4</option>
           						<option value=\"5\">5</option>
       						</select>
   					</p>";
   				 echo "<p>
     					<input type=\"submit\" id=\"btnSubmit\" name=\"submit\" value=\"Ajouter au panier\" />
					   </p>
  				   </form>";


			echo "</article>";
		}
		else
		{
			echo "<article id=\"detail-produit\">";
			echo "<header>OOPS !</header>";
			echo "<img src=\"../images/erreur.png\" alt=\"erreur produit introuvable\">";
			echo "<p><strong>Produit introuvable !</strong></p>";
		}
	}
	else
		header("Location: index.php");

?>
</section>

<?php
	require("footer.php");
?>

</body>
</html>