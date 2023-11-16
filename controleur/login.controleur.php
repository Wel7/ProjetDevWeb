<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include_once("../modele/conducteurDAO.modele.php");
include_once("../modele/adminDAO.modele.php");
include("../vue/login.view.php");


session_abort();
session_start();
$_SESSION = [];

if (isset($_POST["identifiant"]) && isset($_POST["password"])) {
    $verif = new AdminDAO();
    if ($verif->verifAdmin($_POST["identifiant"], $_POST["password"])) {
        unset($_POST["password"]);
        unset($verif);
        $_SESSION["identifiant"] = $_POST["identifiant"];
        $_SESSION["admin"] = true; 
        header("Location: infractionListeAdmin.php");
    } else {
        $verif = new ConducteurDAO();
        if ($verif->verifCon($_POST["identifiant"], $_POST["password"])) {
            unset($_POST["password"]);
            unset($verif);
            $_SESSION["identifiant"] = $_POST["identifiant"];
            header("Location: infractionListeClient.php");
        } else {
            echo "Mot de passe ou identifiant invalide";
        }
    }
}
?>