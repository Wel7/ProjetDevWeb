<?php
include_once("modele/conducteurDAO.modele.php");
include_once("modele/adminDAO.modele.php");
session_start();
if (isset($_POST["identifiant"]) && isset($_POST["password"])) {
    $verif = new AdminDAO();
    include("vue\login.view.php");
    if ($verif->verifAdmin($_POST["identifiant"], $_POST["password"])) {
        unset($_POST["password"]);
        unset($verif);
        $_SESSION["identifiant"] = $_POST["identifiant"];
        echo "Gg bro t un admin";

    } else {
        $verif = new ConducteurDAO();
        if ($verif->verifCon($_POST["identifiant"], $_POST["password"])) {
            unset($_POST["password"]);
            unset($verif);
            $_SESSION["identifiant"] = $_POST["identifiant"];
            echo "Gg bro t un user";
        } else {
            echo "Mot de passe ou identifiant invalide";
        }
    }
}
?>