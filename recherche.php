<?php
include ("utile.php");
include ("connexion.php");
?>

<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop : recherche</title>

</head>
<body>

<?php
	$connex = connexionPDO();
	require("header.php");
?>

<section>
<?php
	if (isset($_POST["query"]))
	{
		$sql = "SELECT * FROM article WHERE description LIKE '%" . addslashes($_POST["query"]) . "%' OR designation LIKE '%" . addslashes($_POST["query"]) . "%';";
		$res = $connex->query($sql);
		$res = $res->fetchAll(PDO::FETCH_ASSOC);
		if (!empty($res))
		{
			echo "<header><h2>Recherche</h2></header>";
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
			echo "<div id=\"no-result\">";
			echo "<header>OOPS !</header>";
			echo "<img src=\"images/erreur.png\" alt=\"erreur categorie introuvable\">";
			echo "<p><strong>Aucun produit ne correspond à votre recherche !</strong></p></div>";
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