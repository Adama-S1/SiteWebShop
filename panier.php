<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop : Commande</title>
</head>
<body>


<?php
	include_once('header.php');	
	include_once('utile.php');
	include('connexion.php');
	if (!isset($_SESSION["panier"]))
		$_SESSION["panier"] = array();
	if (isset($_POST["submit"]))
	{
		$article =  array("id-article"=>$_POST["id"], "qte"=>$_POST["quantite"]);
		$ins = 0;
		$i = 0;
		foreach ($_SESSION["panier"] as $val)
		{
			if (array_search($article["id-article"], $val) != FALSE)
			{
				$_SESSION["panier"][$i]["qte"] += $_POST["quantite"];
				$ins = 1;
			}
			$i++;

		}
		if ($ins == 0)
			array_push($_SESSION["panier"], $article);

	}
	if (isset($_GET["sup"]))
	{
		$i = 0;
		foreach ($_SESSION["panier"] as $val)
		{
			if (array_search($_GET["sup"], $val) != FALSE)
				array_splice($_SESSION["panier"], $i, 1);
			$i++;

		}
	}
	$connex = connexionPDO();
?>


	<section>
		<header><h2>Mon panier</h2></header>
		
			
			<?php
		if (!empty($_SESSION["panier"]))
		{
		    echo "<table id=\"cart-table\">
				<thead>
				<tr>
					<th>désignation</th>
					<th>quantité</th>
					<th>prix unitaire</th>
					<th>prix total</th>
					<th>supprimer</th>
				</tr>
				</thead>
				<tbody>";
	
			$prix_total = 0;
		foreach ($_SESSION["panier"] as $value)
		{
			$res = $connex->query("SELECT id_article, designation, prix, tva FROM article WHERE id_article=" . $value["id-article"] . ";");
			$res = $res->fetch(PDO::FETCH_ASSOC);
			echo "<tr>
				<td><a href=\"vue_produit.php?id=" . $res["id_article"] . "\"><strong>" . $res["designation"] . "</strong></a></td>
				<td>" . $value["qte"] . "</td>
				<td>" . $res["prix"] . " €</td>
				<td>" . ($res["prix"] * $value["qte"]) . " €</td>
				<td><a href='panier.php?sup=" . $value["id-article"] . "'> <img src='images/delete.png' alt='delete'/></a></td>
				</tr>";
				$tva = $res["tva"];
				$prix_total += $res["prix"] * $value["qte"];

		}
				echo "</tbody>
		    </table>";
		    $tva = $prix_total * ($tva / 100);
		    $tva = number_format($tva, 2);
			echo "<p id='total-achat'> Prix HT: $prix_total €</br>
										TVA: $tva € </br>
										Total TTC: " . ($prix_total + $tva) . "
					</p>";
			echo "<input type='hidden'  name='prix'  value=$prix_total/>
			<form id=\"form-panier\" action=\"commande.php\" method=\"post\" enctype=\"multipart/form-data\">
				<p>
					<input value=\"Valider votre commande »\" type=\"submit\"  />
				</p>
		    </form>";			
		}
		else
		{
			echo "<div id=\"empty-cart\">
				<p><img src=\"images/poubelle.png\" alt=\"vide\" /></p>
				<p>Votre panier est vide</p>
			</div>";
		}
			?>
	</section>

<?php
	include_once('footer.php');
?>

</body>
</html>