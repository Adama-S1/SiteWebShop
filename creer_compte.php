<?php
include ("utile.php");
include ("connexion.php");
$connex = connexionPDO();

if (isset($_POST["submit"]))
{

	if(MailDansBase(addslashes($_POST["mail"])))
		$AFF = "E-mail déja utilisé, veuillez en changer.";
	else
	{
		$pass = hash("sha256", $_POST["pass"]);
		$sql = "INSERT INTO client(email, mot_de_passe, civilite, nom, prenom, adresse, code_postal, ville, pays, telephone) VALUES ('" . $_POST["mail"] . "','" . $pass . "','" . $_POST["civilite"] . "','" . $_POST["nom"] . "','" . $_POST["prenom"] . "','" . $_POST["adresse"] . "'," . $_POST["cp"] . ",'" . $_POST["ville"] . "','" . $_POST["pays"] . "'," . $_POST["tel"] . ");";
		$connex->exec($sql);
		//mail($_POST["mail"], "Incription", "Vous etes inscrit, utilisez votre email et votre mot de passe pour vous connecter sur notre site bonne journée.");
		header("Location: login.php");
	}
}

?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop : compte</title>

</head>
<body>

<?php
	require("header.php");
?>
	<section>
		<header><h3>Créer un compte</h3></header>
		<?php
			if (isset($AFF))
				echo "<p>$AFF</p>";
		?>
			<form id="creer-compte" method="post" action="creer_compte.php">
			<label for="edtMail">E-mail :</label>
			<input type="mail" id="edtMail" name="mail" required /> </br>
			<label for="edtPass">Mot de passe :</label>
			<input type="password" id="edtPass" name="pass" required /> </br>
			<label for="edtCiv">Civilité :</label>
       						<select name="civilite" id="civilite">
           						<option value="M.">M.</option>
           						<option value="Mme.">Mme.</option>
           						<option value="Mlle.">Mlle.</option>
       						</select> </br>
			<label for="edtNom">Nom :</label>
			<input type="text" id="edtNom" name="nom" required /> </br>
			<label for="edtPrenom">Prenom :</label>
			<input type="text" id="edtPrenom" name="prenom" required /> </br>
			<label for="edtAdresse">Adresse :</label>
			<input type="text" id="edtAdresse" name="adresse" required /> </br>
			<label for="edtCP">Code Postal :</label>
			<input type="number" id="edtCP" name="cp" required /> </br>
			<label for="edtVille">Ville :</label>
			<input type="text" id="edtVille" name="ville" required /> </br>
			<label for="edtPays">Pays :</label>
			<input type="text" id="edtPays" name="pays" required /> </br>
			<label for="edtTel">Téléphone :</label>
			<input type="number" id="edtTel" name="tel" required /> </br>
			<input type="submit" id="btnSubmit" name="submit" value="Envoyer" />

		</form>
		<p>Merci de renseigner tous les champs.</p>
	</section>

<?php
	require("footer.php");
?>

</body>
</html>