<?php
include ("utile.php");
include ("connexion.php");
$connex = connexionPDO();

if (isset($_POST["submit"]))
{
	$pass = hash("sha256", $_POST["pass"]);
	$sql = "SELECT * FROM client WHERE email='" . $_POST["mail"] . "' AND mot_de_passe='" . $pass . "'";
	$res = $connex->query($sql);
	$res = $res->fetch(PDO::FETCH_ASSOC);
	if (empty($res))
		$AFF = "Mot de passe ou email incorrect.";
	else
	{
		session_start();
		$_SESSION["id"] = $res["id_client"];
		$_SESSION["nom"] = $res["nom"];
		$_SESSION["prenom"] = $res["prenom"];
		$_SESSION["civilite"] = $res["civilite"];
		if (isset($_SESSION["panier"]))
			header("Location: panier.php");
		else
			header("Location: index.php");
	}
}

?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop : login</title>

</head>
<body>

<?php
	require("header.php");
?>
	<section>
		<header><h3>Identification</h3></header>
		<?php
			if (isset($AFF))
				echo "<p>$AFF</p>";
		?>
			<form id="login" method="post" action="login.php">
			<label for="edtMail">E-mail :</label>
			<input type="mail" id="edtMail" name="mail" required /> </br>
			<label for="edtPass">Mot de passe :</label>
			<input type="password" id="edtPass" name="pass" required /> </br>
			<input type="submit" id="btnSubmit" name="submit" value="Envoyer" />
		</form>
	</section>

<?php
	require("footer.php");
?>

</body>
</html>