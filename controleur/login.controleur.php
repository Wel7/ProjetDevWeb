<?php
require_once("../modele/conducteurDAO.modele.php");
require_once("../modele/adminDAO.modele.php");
require_once("../vue/login.view.php");

ini_set("display_errors", 1);
error_reporting(E_ALL);

session_start();
if (isset($_POST["identifiant"]) && isset($_POST["password"])) {
    $verif = new AdminDAO();
    if ($verif->verifAdmin($_POST["identifiant"], $_POST["password"])) {
        unset($_POST["password"]);
        unset($verif);
        $_SESSION["identifiant"] = $_POST["identifiant"];
    } else {
        $verif = new ConducteurDAO();
        if ($verif->verifCon($_POST["identifiant"], $_POST["password"])) {
            unset($_POST["password"]);
            unset($verif);
            $_SESSION["identifiant"] = $_POST["identifiant"];
            header("location: ../controleur/infractionListe.php");
        } else {
            echo "<center>Mot de passe ou identifiant invalide</center>";
        }
    }
}




?>