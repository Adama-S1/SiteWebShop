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
	if (isset($_GET["cat"]))
	{
		if ($_GET["cat"] == "all")
			$sql = "SELECT * FROM article ;";
		else
			$sql = "SELECT * FROM article WHERE id_categorie = " . $_GET["cat"] . ";";
		$res = $connex->query($sql);
		$res = $res->fetchAll(PDO::FETCH_ASSOC);
		if (!empty($res))
		{
			echo "<header><h2>Catégorie <span class=\"ss-titre\">n° " . $_GET["cat"] . "</span></h2></header>";
			echo "<ul id=\"product-list\">";
			foreach ($res as $val)
			{
				echo "<li class=\"product\">";
				echo "<h3>" . $val["designation"] . "</h3>" . "<img src= \"" . $val["img_article"] . "\" alt=\"" . $val["designation"] . "\" /><p><strong>" . $val["prix"] . "</strong></p><p>" . tronquer_texte($val["description"]) . "</p><p><a href=\"vue_produit.php?id=" . $val["id_article"] . "\"><strong>voir les détails...</strong></a></p>";
				echo "</li>";
			} 
			echo "</ul>";
		}
		else
		{
			echo "<article id=\"detail-produit\">";
			echo "<header>OOPS !</header>";
			echo "<img src=\"images/erreur.png\" alt=\"erreur categorie introuvable\">";
			echo "<p><strong>Categorie introuvable !</strong></p>";
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