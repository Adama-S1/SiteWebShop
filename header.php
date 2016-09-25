<?php
session_start();
?>

<header>
	
	<h1><a href="index.php">Bienvenue sur SiteWebShop !</a></h1>
	
	
	<nav id="menu">
		<ul>
			<li><a href="index.php">accueil</a></li>
			<?php
				if (isset($_SESSION["nom"]))
				{
					echo "<li>Bonjour " . $_SESSION["civilite"] . " " . $_SESSION["nom"] ."</li>";
					echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
				}
				else
				{
					echo "<li><a href='login.php'>login</a></li>";
					echo "<li><a href='creer_compte.php'>créer compte</a></li>";
				}
			?>
			<li><a href="panier.php">panier</a></li>
		</ul>
	</nav>
	
	<form id="search" action="recherche.php" method="post" enctype="multipart/form-data">
			<p>
				<label for="searchText">Rechercher :</label>
				<input id="searchText" name="query" type="text" value="" />
				<input id ="searchBtn" type="submit" class="bouton" value="OK" />
			</p>
		</form>
	
	
		<nav id="menu-categorie">
		<ul>
			<li class="smenu"><a href="categorie.php?cat=all">tous les produits</a></li>
			<li class="smenu"><a href="categorie.php?cat=1">vetements</a></li>
			<li class="smenu"><a href="categorie.php?cat=2">accessoires</a></li>
			<li class="smenu"><a href="categorie.php?cat=3">posters</a></li>
			<li class="smenu"><a href="categorie.php?cat=4">dvd</a></li>
		</ul>
		</nav>
</header>

<?php
	if (isset($aff))
		unset($aff);
?>