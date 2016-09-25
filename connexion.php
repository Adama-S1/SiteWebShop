<?php
	function connexionPDO()
	{
		try
		{
			$connex = new PDO("mysql:host=localhost;dbname=sitewebshop" , "root", "");
			$connex->exec("SET CHARACTER SET utf-8");
		}
		catch (PDOException $e)
		{
			echo "Connexion echouee : " . $e->getMessage();
			die();
		}
		return $connex;
	}
?>