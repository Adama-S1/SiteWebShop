<?php
session_start();

unset($_SESSION["nom"]);
unset($_SESSION["prenom"]);
unset($_SESSION["civilite"]);

if (ini_get("session.use_cookies"))
 {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
 }
session_destroy();
header("Location: index.php");
?>