<?php

	function tronquer_texte($texte, $longeur_max = 100)
	{
 		if (strlen($texte) > $longeur_max)
 		{
			$texte = substr($texte, 0, $longeur_max);
			$texte .= "...";
		}
		return $texte;
	}

	function MailDansBase($mail)
	{
		$connex = connexionPDO();
		$res = $connex->query("SELECT * FROM client WHERE email='$mail';");
		$res = $res->fetchAll(PDO::FETCH_ASSOC);
		if (empty($res))
			return (FALSE);
		return (TRUE);
	}

	function form_fill($var)
	{
		if (empty($var))
			return ("");
		else
			return ($var);
	}
?>