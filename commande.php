<?php
include ("utile.php");
include ("connexion.php");
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop : Commande</title>

</head>
<body>

<?php
	$connex = connexionPDO();
	require("header.php");
?>

<?php
	if (isset($_SESSION["nom"]) && isset($_SESSION["panier"]))
	{
		$connex->exec("INSERT INTO commande(no_client, etat) VALUES (" . $_SESSION["id"] . ", 'R');");
		$res = $connex->query("SELECT MAX(no_commande) FROM commande");
		foreach ($_SESSION["panier"] as $value)
		{
			$connex->exec("INSERT INTO commande(no_client, etat) VALUES (" . $_SESSION["id"] . ", 'R');");
		}
		header("Location: https://www.paypal.com/fr/home");
	}
	else if (!isset($_SESSION["nom"]))
		header("Location: login.php");
?>
	
<?php
	require("footer.php");
?>

</body>
</html>