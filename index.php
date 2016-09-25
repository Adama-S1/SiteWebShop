
<?php
include ("utile.php");
include ("connexion.php");
?>

<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop</title>

</head>
<body>
<!-- DEBUT de la page -->
<?php
	$connex = connexionPDO();
	require("header.php");
?>


	<section>
				

				<header>Bienvenue <span class="ss-titre">Nous sommes le <?php echo date("j/n/Y"); ?> </span></header>
				<p>La boutique en ligne <strong>openSHOP</strong> est un travail réalisé par <em>Thomas Jouannic</em> & <em>Jérome Saunier</em> 
				puis modifié et adapté <strong>au cours de Sites Web Avancés</strong>.</p>
				<p>Dans la partie haute, vous trouverez un moyen pour vous identifiez ou créer un compte si vous n'en n'avez aucun. Le champ de recherche 
				vous permet d'afficher simplement les produits correspondants à ce que vous souhaitez. Vous pouvez aussi naviguer entre les différentes 
				catégorie de produits en cliquant sur celle que vous désirez voir.</p>
				<p>Bonne naviguation !</p>
	</section>
	<section>
		<header>
					<h2>Au hasard...</h2>
		</header>
				<!--Affichage de 3 articles au hasard -->
				<ul id="product-list">
<?php
		$sql = "SELECT * FROM article ORDER BY RAND() LIMIT 3";
		$res = $connex->query($sql);
		$res = $res->fetchAll(PDO::FETCH_ASSOC);

		foreach ($res as $val)
		{
			echo "<li class=\"product\">";
			echo "<h3>" . $val["designation"] . "</h3>" . 
					"<p><img src= \"" . $val["img_article"] . "\" alt=\"" . $val["designation"] . "\" />" . "</p>" . "
					<p><strong>" . $val["prix"] . " €</strong></p>
					<p>" . tronquer_texte($val["description"]) . "</p>
					<p><a href=\"vue_produit.php?id=" . $val["id_article"] . "\"><strong>voir les détails...</strong></a></p>";
			echo "</li>";
		}
?>
				</ul>	
	</section>

	
<?php
	require("footer.php");
?>

</body>
</html>