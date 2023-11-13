<?php
require_once "../modele/infractionDAO.modele.php";
require_once "../modele/delitsDAO.modele.php";

session_start();
if (!isset($_SESSION["identifiant"])) {
    header("Location: login.controleur.php");
}

$delit = new DelitsDAO();
$infra = new InfractionDAO();

var_dump($_GET['id']);
if (isset($_GET['id']) && $infra->idExiste($_GET['id'])) {
    $delit->delete($_GET['id']);
    $infra->delete($_GET['id']);
} else {
    throw new ErrorException("ID d'infraction inexistant ou inaccessible");
}

header("Location: ./infractionListeAdmin.php")
    ?>